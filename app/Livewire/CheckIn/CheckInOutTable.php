<?php

namespace App\Livewire\CheckIn;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;


class CheckInOutTable extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['query' => '$refresh'];
    public function render()
    {
        $employee_id = auth()->user()->employee_id;
            
        $records = DB::table('q8_checkinout')
        ->where('employee_id', $employee_id)
        ->orderBy('id', 'desc')
        ->paginate(10);

        return view('livewire.check-in.check-in-out-table',([
            'records' => $records,
            ])
        );
    }
}
