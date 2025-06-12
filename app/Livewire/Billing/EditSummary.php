<?php

namespace App\Livewire\Billing;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\q8_invoice;
use App\Models\q8_invoice_details;
class EditSummary extends Component
{
    public $invoice;
    public $invoice_id;
    public $invoice_details;
    public $items = [];
    public $discount = 0;
    public $tax = 0;
    public $total;
    public $invoice_no;
    public $invoice_date;
    public $due_date;
    public $selectedClient;
    public $project;
    public $note;

    protected  function rules()
    {
        return [
            'selectedClient' => 'required',
            'project' => 'required',
            'invoice_id' => 'exists:q8_invoice,invoice_id',
            'invoice_no' => 'exists:q8_invoice,invoice_no',
            'invoice_date' => 'required|date',
            'due_date' => 'required|date|after_or_equal:invoice_date',
            'items.*.date' => 'required|date',
            'items.*.description' => 'nullable|string',
            'items.*.cost' => 'required|numeric|gte:1',
            'items.*.quantity' => 'required|integer|gte:1',
        ];
    }

     protected function messages() 
    {
        return [
            'invoice_id.exists' => 'Transaction  ID must exists.',
            'invoice_no.exists' => 'Invoice Number must exists.',
            'due_date.after_or_equal' => 'Due Date must be after or equal to Invoice Date.',

            'invoice_date.required' => 'Invoice Date is required.',
            'project.required' => 'Project Name is required.',
            'selectedClient.required' => 'Client is required.',
            'items.*.date.required' => 'Date is required.',
            'items.*.cost.required' => 'Cost is required.',
            'items.*.quantity.required' => 'Quantity is required.',

            'items.*.cost.numeric' => 'Cost must be a number.',
            'items.*.cost.gte' => 'Cost must not be equal or less that Zero.',
            'items.*.quantity.gte' => 'Quantity must not be equal or less that Zero.',
        ];
    }

    public function mount($invoice_id)
    {
        $this->invoice_id = $invoice_id;
        $this->dispatch('search_date');
        // Fetch the invoice details using the provided invoice_id
        $this->invoice = q8_invoice::where('invoice_id', $this->invoice_id)->first();

        $this->invoice_no = $this->invoice->invoice_no ?? '';
        $this->invoice_date = $this->invoice->invoice_date ?? '';
        $this->due_date = $this->invoice->due_date ?? '';
        $this->project = $this->invoice->project ?? '';
        $this->selectedClient = $this->invoice->client ?? '';
        $this->note = $this->invoice->notes ?? '';

        // Fetch the invoice items associated with the invoice
        $this->invoice_details = q8_invoice_details::where('invoice_id', $this->invoice_id)->get();
        // Decode the JSON details into an array
        foreach ($this->invoice_details as $detail) {
            $this->items[] = [
                'id' => $detail->id,
                'date' => $detail->item_date,
                'cost' => $detail->item_unitprice,
                'quantity' => $detail->item_qty,
                'price' => 0,
                'description' => $detail->item_desc,
            ];
        }
        // If not found, abort with 404
        if (!$this->invoice) {
            abort(404, 'Invoice not found');
        }
    }

    public function render()
    {
        $clients = DB::table('q8_clients')
        ->orderBy('company_name', 'ASC')
        ->get();

        $this->dispatch('search_date');
        return view('livewire.billing.edit-summary', [
            'clients' => $clients,
        ]);
    }

    public function editInvoice()
    {
        try {
            // Insert or update invoice items  
            if (empty($this->items)) {
                // Show validation error toast
                $this->dispatch('query', [
                    'status' => 'bg-danger',
                    'message' => 'Items are required to update the invoice.',
                    'errorMessage' => 'Items are required to update the invoice.'
                ]);
                return;
            }

            // Check if invoice_id exists
            if (!$this->invoice_id) {
                // Show validation error toast
                $this->dispatch('query', [
                    'status' => 'bg-danger',
                    'message' => 'Invoice ID is required to update the invoice.',
                    'errorMessage' => 'Invoice ID is required to update the invoice.'
                ]);
                return;
            }

            // Check if invoice_no exists
            if (!$this->invoice_no) {
                // Show validation error toast
                $this->dispatch('query', [
                    'status' => 'bg-danger',
                    'message' => 'Invoice Number is required to update the invoice.',
                    'errorMessage' => 'Invoice Number is required to update the invoice.'
                ]);
                return;
            }

            // Validate input fields
            $this->validate();

            // Update the invoice in the database
            q8_invoice::where('invoice_id', $this->invoice_id)->update([
                'client' => $this->selectedClient,
                'project' => $this->project,
                'due_date' => $this->due_date,
                'notes' => $this->note,
            ]);

            // Step 1: Get all item IDs from Livewire request (those we want to keep)
            $currentItemIds = collect($this->items)
                ->filter(fn ($item) => isset($item['id']))
                ->pluck('id')
                ->toArray();

            // Step 2: Delete items in DB not present in current request
            q8_invoice_details::where('invoice_id', $this->invoice_id)
                ->whereNotIn('id', $currentItemIds)
                ->delete();

            // Loop through each item and either update or create it
            foreach ($this->items as $item) {
                if (isset($item['id'])) {
                    // If item ID exists, update the existing item
                
                    q8_invoice_details::where('id', $item['id'])->update([
                        'item_date' => $item['date'] ?? null,
                        'item_desc' => $item['description'] ?? '',
                        'item_qty' => $item['quantity'] ?? 1,
                        'item_unitprice' => $item['cost'] ?? 0,
                        'item_total' => '$' . number_format(($item['price'] ?? 0), 2),
                    ]);
                    continue;
                }
                // If item ID does not exist, create a new item
                q8_invoice_details::create([
                    'invoice_id' => $this->invoice_id,
                    'invoice_no' => $this->invoice_no,
                    'item_date' => $item['date'] ?? null,
                    'item_desc' => $item['description'] ?? '',
                    'item_qty' => $item['quantity'] ?? 1,
                    'item_unitprice' => $item['cost'] ?? 0,
                    'item_total' => '$' . number_format(($item['price'] ?? 0), 2),
                ]);
            }
            
            // Clear validation errors
            $this->dispatch('validationError', ['errors' => []]);

            // Show success toast
            $this->dispatch('query', [
                'status' => 'bg-success',
                'message' => 'Invoice #' . $this->invoice_no . ' Updated Successfully!',
                'errorMessage' => ''
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Show validation error toast
            $this->dispatch('query', [
                'status' => 'bg-danger',
                'message' => 'Validation Failed!',
                'errorMessage' => $e->getMessage()
            ]);

            // Emit validation errors to frontend
            $this->dispatch('validationError', ['errors' => $e->errors()]);
        }
    }


    
}
