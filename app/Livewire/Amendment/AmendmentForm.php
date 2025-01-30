<?php

namespace App\Livewire\Amendment;

use Livewire\Component;
// use Livewire\Attributes\Validate; 

class AmendmentForm extends Component
{
    public $activity = '';
    public $date = '';
    public $startTime = '';
    public $endTime = '';
    public $reason = '';
    public $attachment = '';

    public function render()
    {
        return view('livewire.amendment.amendment-form');
    }

    public function save(){
        $validated = $this->validate([ 
            'activity' => 'required',
            'date' => 'required',
            'startTime' => 'required',
            'endTime' => 'required|after:startTime',
            'reason' => 'required',
            'attachment' => 'required|image',
        ]);
    }
}
