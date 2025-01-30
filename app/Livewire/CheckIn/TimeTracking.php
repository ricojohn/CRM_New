<?php

namespace App\Livewire\CheckIn;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\error;

class TimeTracking extends Component
{
    public $datetoday;
    public $datenow;
    public $dateMinusOne;
    public $timenow;
    public $checkinbtn = ''; // Visible by default
    public $checkoutbtn = 'd-none'; // Hidden by default
    public $timeTracking;
    public function mount()
    {
        // Get current date and time
        $this->datetoday = Carbon::now()->format('m-d-Y');
        $this->datenow = Carbon::now()->format('F-d-Y');
        $this->dateMinusOne = Carbon::now()->subDay()->format('m-d-Y');
        

        $employee_id = auth()->user()->employee_id;

        // Query the database
        $this->timeTracking = DB::table('q8_checkinout')
            ->where('employee_id', $employee_id)
            ->where(function ($query) {
                $query->where('date', $this->datetoday)
                      ->orWhere('date', $this->dateMinusOne);
            })
            ->orderBy('id', 'desc')
            ->first();

        // Toggle button visibility based on database record
        if ($this->timeTracking && $this->timeTracking->check_in_time != ''  && $this->timeTracking->check_out_time == null ) {
            $this->checkinbtn = 'd-none'; // Hide check-in button
            $this->checkoutbtn = ''; // Show check-out button
        }elseif($this->timeTracking && $this->timeTracking->check_in_time != ''  && $this->timeTracking->check_out_time != null ){
            $this->checkinbtn = ''; // Hide check-in button
            $this->checkoutbtn = 'd-none'; // Show check-out button
        }
    }

    public function checkIn()
    {
        $employee_id = auth()->user()->employee_id;
        $timenow = Carbon::now()->format('H:i:s');


        try {
            // Insert Date
            DB::table('q8_checkinout')->insert([
                'employee_id' => $employee_id,
                'date' => $this->datetoday,
                'check_in_time' => $timenow,
            ]);

            $this->checkinbtn = 'd-none'; // Hide check-in button
            $this->checkoutbtn = ''; // Show check-out button

            // Reload Time in
            $this->mount();
            $this->dispatch('query', ['status' => 'bg-success', 'message' => 'Check In Success', 'check' => 'in']);

        } catch (\Throwable $th) {
            //throw $th;

            $this->mount();
            $this->dispatch('query', ['status' => 'bg-danger', 'message' => 'Check In Failed', 'errorMessage' => $th->getMessage(), 'check' => 'in']);
        }

    }

    public function checkOut($id)
    {
        $employee_id = auth()->user()->employee_id;
        $timenow = Carbon::now()->format('H:i:s');

        try {
            //code...
            DB::table('q8_checkinout')
            ->where('employee_id', $employee_id)
            ->where('id', $id)
            ->where('date', $this->datetoday)
            ->update([
                'check_out_time' =>  $timenow,
                'dateout' =>  $this->datetoday,
            ]);

            $this->checkinbtn = ''; // Show check-in button
            $this->checkoutbtn = 'd-none'; // Hide check-out button

            $this->mount();
            $this->dispatch('query', ['status' => 'bg-success', 'message' => 'Check Out Success', 'check' => 'out']);
        } catch (\Throwable $th) {
            //throw $th;
            $this->mount();
            $this->dispatch('query', ['status' => 'bg-danger', 'message' => 'Check Out Failed', 'errorMessage' => $th->getMessage(), 'check' => 'out']);
        }
        
    }

    public function render()
    {
        return view('livewire.check-in.time-tracking');
    }
}
