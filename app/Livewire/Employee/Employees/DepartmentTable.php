<?php

namespace App\Livewire\Employee\Employees;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;

class DepartmentTable extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function render()
    {
        $departments = DB::table('q8_department')
        ->where('department', 'like', '%' . $this->search . '%')
        ->orderBy('department', 'ASC')
        // ->paginate($this->perPage);
        ->paginate(5);


        return view('livewire.employee.employees.department-table',[
            'departments' => $departments,
        ]);
    }

    public function addDepartment(){
        // Trigger modal
        $this->dispatch('openDepartmentModal');
    }
}
