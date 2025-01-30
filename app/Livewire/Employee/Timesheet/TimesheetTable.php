<?php

namespace App\Livewire\Employee\Timesheet;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\q8_checkinout;
use App\Models\q8_employee;
use Illuminate\Support\Facades\Log;


class TimesheetTable extends Component
{
    public $search_date;
    public $employees = [];
    public $timesheet = [];
    public $headers = [];
    public $days = [];

    public function mount()
    {
        // $this->search_date = now()->format('Y-m-d');
        $this->search_date = '2024-12-09';
        $this->loadTimesheet();
        $this->dispatch('search_date');
    }

    public function loadTimesheet()
    {
        $search_start = Carbon::parse($this->search_date)->format('m-d-Y');
        $search_end = Carbon::parse($this->search_date)->addDays(6)->format('m-d-Y');

        $this->employees = q8_employee::with(['checkInOuts' => function($query) use ($search_start, $search_end) {
            $query->whereBetween('date', [
                $search_start,
                $search_end
            ]);
        }])->select('employee_id', 'first_name', 'last_name', 'position')
        ->orderBy('first_name', 'asc')
        ->get();

        $this->headers = [];
        $this->days = [];

        // Header Date
        for ($i = 0; $i < 7; $i++) {
            $date = Carbon::parse($this->search_date)->addDays($i);
            $this->headers[] = $date->format('m-d-Y');
            $this->days[] = $date->format('l');
        }

        // Body
        foreach ($this->employees as $employee) {
            $total_hours = 0;
            $total_minutes = 0;
            $total_seconds = 0;

            $timesheet_data = [];

            if (count($employee->checkInOuts)  > 0) {
                

                
            }

            $this->timesheet[$employee->employee_id] = [
                'name' => $employee->first_name . ' ' . $employee->last_name,
                'position' => $employee->position,
                'data' => $timesheet_data,
            ];
            
        }
        $this->dispatch('search_date');
    }

    public function updateTimeSheet()
    {
        $this->loadTimesheet();
    }
    

    public function render()
    {
        return view('livewire.employee.timesheet.timesheet-table');
    }
}
