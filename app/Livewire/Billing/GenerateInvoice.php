<?php

namespace App\Livewire\Billing;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class GenerateInvoice extends Component
{
    public $invoice_id;
    public $date_issued;
    public $due_date;
    public $selectedClient;


    public function mount()
    {
        $this->date_issued = now()->format('Y-m-d');
        $this->invoice_id = now()->format('mdYhis');
        $this->dispatch('search_date');
    }

    // In your Livewire component class (ExampleComponent.php)
    public function render()
    {
        $clients = DB::table('q8_clients')
        ->orderBy('company_name', 'ASC')
        ->get();

        $clientSelected = DB::table('q8_clients')
        ->where('company_name', '=', $this->selectedClient)
        ->get();

        $this->dispatch('search_date');
        
        return view('livewire.billing.generate-invoice',[
            'clients' => $clients,
            'clientSelected' => $clientSelected,
        ]);
    }

    public function addItem(){
        // Trigger modal
        $this->dispatch('addItem');
    }

    





}
