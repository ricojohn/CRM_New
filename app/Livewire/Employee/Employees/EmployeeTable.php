<?php

namespace App\Livewire\Employee\Employees;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;



class EmployeeTable extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search = '';
    // public $perPage = 10;

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


        // dd($employees);


        return view('livewire.employee.employees.employee-table',[
            'employees' => $employees,
        ]);
    }

    public function addEmployee(){
        // Trigger modal
        $this->dispatch('openEmployeeModal');
    }
}
