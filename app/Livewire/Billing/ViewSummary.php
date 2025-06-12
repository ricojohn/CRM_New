<?php

namespace App\Livewire\Billing;

use Livewire\Component;
use App\Models\q8_invoice;
use App\Models\q8_invoice_details;

class ViewSummary extends Component
{
    public $invoice_id;
    public $invoice;
    public $invoice_details;

    public function mount($invoice_id)
    {
        $this->invoice_id = $invoice_id;

        // Fetch the invoice details using the provided invoice_id
        $this->invoice = q8_invoice::where('invoice_id', $this->invoice_id)->first();

        // Fetch the invoice items associated with the invoice
        $this->invoice_details = q8_invoice_details::where('invoice_id', $this->invoice_id)->get();

        // If not found, abort with 404
        if (!$this->invoice) {
            abort(404, 'Invoice not found');
        }
    }
    public function render()
    {
        return view('livewire.billing.view-summary');
    }
}
