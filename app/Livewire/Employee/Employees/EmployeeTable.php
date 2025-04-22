<?php

namespace App\Livewire\Employee\Employees;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\q8_employee;
use Livewire\Attributes\Validate;



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

    public $employee_id, $first_name, $last_name, $email, $password, $department, $position,
           $phone, $address,$employment_date, $access, $status,$salary; 

    protected  function rules()
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'password' => 'required',
            'email' => 'required|email|unique:q8_employee,email',
            'department' => 'required',
            'position' => 'required',
            'phone' => 'required|max:11',
            'address' => 'required',
            'dob' => 'required', // Optional: custom format validation
            'employment_date' => 'required',
            'access' => 'required',
            'status' => 'required',
            'photo' => 'required|image',
            'salary' => 'required|numeric', 
        ];
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function mount(){
        $this->employee_id = 'Q8-' . date('mdyhis') . rand(1, 10);
        $this->status = 'Active';
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


        return view('livewire.employee.employees.employee-table',[
            'employees' => $employees,
            'departments' => $departments,
        ]);
    }

    public function openEmployeeModal(){
        $this->reset();
        $this->resetValidation();
        $this->mount();
        // Trigger modal open
        $this->dispatch('openEmployeeModal');
    }

    public function addEmployee(){

        // Validate Inputs
        $this->validate();

        // Insert Employee
        try {
            $filename = null;
            $filename = 'uploads/' . now()->format('ymdhis') . rand(1, 100) . '.' . $this->photo->getClientOriginalExtension();
            

            q8_employee::create([
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
            $this->photo->storeAs('public', $filename);
            // Message
            $this->dispatch('query', ['status' => 'bg-success', 'message' => 'Employee Added']);
            // Trigger modal close
            $this->dispatch('closeEmployeeModal');
        } catch (\Throwable $th) {
            // Message
            $this->dispatch('query', ['status' => 'bg-danger', 'message' => 'Failed', 'errorMessage' => $th->getMessage()]);
        }
    }
}
