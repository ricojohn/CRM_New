<?php

namespace App\Livewire\CheckIn;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RecordingTable extends Component
{
    public $recordings = [];

    public function mount()
    {
        
        $this->loadRecordings();
    }

    public function loadRecordings()
    {
        $employeeId = auth()->user()->employee_id;
        for ($i = 0; $i < 10; $i++) {
            $date = Carbon::now()->subDay($i)->format('Y-m-d');;
            $records = DB::table('recordings')
                ->where('date', $date)
                ->where('employee_id', $employeeId)
                ->where('status', '')
                ->orderBy('id', 'desc')
                ->get();

            if ($records->isNotEmpty()) {
                $this->recordings[$date] = $records;
            }
        }
    }

    public function render()
    {
        return view('livewire.check-in.recording-table');
    }
}
