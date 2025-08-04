<?php

namespace App\Livewire\Twilio;

use App\Http\Controllers\Twilio\call;
use Illuminate\Support\Facades\DB;
use App\Services\TwilioService;
use Livewire\Component;
use App\Models\CallLog;
use Livewire\WithPagination;

class TwilioCall extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }
    public $phone;
    public $status;

    public function twilio_call()
    {
        // try {
        //     $this->validate([
        //     'phone' => 'required|string',
        //     ]);

        //     $this->status = 'Calling...';

        //     $twilio = new TwilioService();
        //     $twilio->makeCall($this->phone, route('twilio.voice'));

        //     $this->status = 'Call connected ✅';
        // } catch (\Exception $e) {
        //     $this->status = 'Failed to connect call: ' . $e->getMessage();
        //     logger()->error('Twilio call error: ' . $e->getMessage());
        // }
        
    }
    
    public function render()
    {
        // Fetch call logs
        $callLogs = DB::table('calls')
        ->where('phone_number', 'like', '%' . $this->search . '%')
        ->orderBy('call_start', 'DESC')
        ->paginate(5);

        return view('livewire.twilio.twilio-call',[
            'callLogs' => $callLogs
        ]);
    }
}
