<?php

namespace App\Livewire\Twilio;
use App\Services\TwilioService;
use Livewire\Component;

class TwilioCall extends Component
{
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
        return view('livewire.twilio.twilio-call');
    }
}
