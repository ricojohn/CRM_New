<?php

namespace App\Livewire\Billing;

use Livewire\Component;
use App\Models\q8_invoice;
use App\Models\q8_invoice_details;
use Livewire\WithPagination;

class Summary extends Component
{
    use WithPagination;
    public $search = '';
    protected $paginationTheme = 'bootstrap';
    public $invoice_id;
    public $invoice_no;

    public function render()
    {
        // $invoices = q8_invoice::
        // orderBy('id', 'desc')
        // ->paginate(10);

        $invoices = q8_invoice::with('invoice_details') // Load details
        ->whereHas('invoice_details')              // Only if they have details
        ->orderBy('id', 'desc')
        ->paginate(10);

        return view('livewire.billing.summary',[
            'invoices' => $invoices,
        ]);
    }

    public function openDeleteModal($invoice_id, $invoice_no)
    {
        $this->invoice_id = $invoice_id;
        $this->invoice_no = $invoice_no;
        $this->dispatch('openModal');
    }
    
    public function deleteInvoice()
    {
        try {

            // Find the invoice by custom 'invoice_id' field
            $invoice = q8_invoice::where('invoice_id', $this->invoice_id)->firstOrFail();
            // Delete related details manually
            $invoice->invoice_details()->delete();
            // Delete the invoice itself
            $invoice->delete();

            // Message
            $this->dispatch('query', ['status' => 'bg-success', 'message' => 'Invoice# '. $this->invoice_no .' Deleted Successfully']);
            // Trigger modal close
            $this->dispatch('closeModal');
        } catch (\Throwable $th) {
            $this->dispatch('query', ['status' => 'bg-danger', 'message' => 'Failed', 'errorMessage' => $th->getMessage()]);
        }
        
    }
}
