<?php

namespace App\Livewire\Employee\Employees;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\q8_employee;
use Livewire\Attributes\Validate;
use Spatie\Permission\Models\Role;
use Carbon\Carbon;



class EmployeeTable extends Component
{

    use WithPagination, WithFileUploads;
    protected $paginationTheme = 'bootstrap';

    public $search = '';
    // public $perPage = 10;

    #[Validate('required', as: 'date of birth')]
    public $dob;
    #[Validate]
    public $photo;

    public $id;

    public $employee_id, $first_name, $last_name, $email, $password, $department, $position,
           $phone, $address,$employment_date, $access, $status,$salary; 

    protected  function rules()
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'password' => 'required',
            'email' => 'required|email|unique:q8_employee,email,' . $this->id,
            'department' => 'required',
            'position' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'dob' => 'required', // Optional: custom format validation
            'employment_date' => 'required',
            'access' => 'required',
            'status' => 'required',
            'photo' => $this->id ? 'nullable|image' : 'required|image',
            'salary' => 'required|numeric', 
        ];
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $employees = DB::table('q8_employee')
        ->where('first_name', 'like', '%' . $this->search . '%')
        // ->orderBy('first_name', 'ASC')
        // ->paginate($this->perPage);
        ->paginate(10);

        $departments = DB::table('q8_department')
        ->orderBy('department', 'ASC')
        ->get();

        $roles = Role::all();


        return view('livewire.employee.employees.employee-table',[
            'employees' => $employees,
            'departments' => $departments,
            'roles' => $roles,
        ]);
    }

    public function createEmployeeModal(){
        $this->reset();
        $this->resetValidation();
        $this->employee_id = 'Q8-' . date('mdyhis') . rand(1, 10);
        $this->status = 'Active';
        // $this->mount();
        // Trigger modal open
        $this->dispatch('openEmployeeModal');
    }

    public function editEmployeeModal($id){
        $this->reset();
        $this->resetValidation();
        $user = q8_employee::find($id);
        $this->id = $user->id;
        $this->employee_id = $user->employee_id;
        $this->first_name = $user->first_name;
        $this->last_name = $user->last_name;
        $this->department = $user->department;
        $this->position = $user->position;
        $this->phone = $user->phone;
        $this->address = $user->address;
        $this->dob = $user->dob;
        $this->employment_date = $user->employment_date;
        $this->email = $user->email;
        $this->password = $user->password;
        $this->photo = $user->photo;
        $this->salary = $user->salary;
        $this->access = $user->access_level;
        $this->status = $user->status;
        // Trigger modal open
        $this->dispatch('openEmployeeModal');
    }

    public function addEmployee(){

        // Validate Inputs
        $this->validate();

        // Insert Employee
        try {

            $filename = null;

            if (is_object($this->photo)) {
                $filename = now()->format('ymdhis') . rand(1, 100) . '.' . $this->photo->getClientOriginalExtension();
                $this->photo->storeAs('uploads/employeeimg', $filename, 'public');
            } else {
                $filename = $this->photo; // keep existing filename
            }

            if($this->id){
                $user = q8_employee::find($this->id);
                $user->update([
                    'first_name' => $this->first_name,
                    'last_name' => $this->last_name,
                    'department' => $this->department,
                    'position' => $this->position,
                    'phone' => $this->phone,
                    'address' => $this->address,
                    'dob' => $this->dob,
                    'employment_date' => $this->employment_date,
                    'email' => $this->email,
                    'photo' => $filename,
                    'salary' => $this->salary,
                    'access_level' => $this->access,
                ]);
            }else{
                $user = q8_employee::Create([
                    'employee_id' => $this->employee_id,
                    'first_name' => $this->first_name,
                    'last_name' => $this->last_name,
                    'department' => $this->department,
                    'position' => $this->position,
                    'phone' => $this->phone,
                    'address' => $this->address,
                    'dob' => $this->dob,
                    'employment_date' => $this->employment_date,
                    'email' => $this->email,
                    'password' => Hash::make($this->password),
                    'photo' => $filename,
                    'salary' => $this->salary,
                    'access_level' => $this->access,
                    'status' => $this->status,
                ]);
            }
            
            

            $user->syncRoles($this->access);


            $this->photo->storeAs('uploads/employeeimg',$filename, 'public');
            // Message
            $this->dispatch('query', ['status' => 'bg-success', 'message' => $this->id ? 'Employee Updated' : 'Employee Added' ]);
            // Trigger modal close
            $this->dispatch('closeEmployeeModal');
        } catch (\Throwable $th) {
            // Message
            $this->dispatch('query', ['status' => 'bg-danger', 'message' => 'Failed', 'errorMessage' => $th->getMessage()]);
        }
    }
}
