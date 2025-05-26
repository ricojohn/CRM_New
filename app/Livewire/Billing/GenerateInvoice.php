<?php

namespace App\Livewire\Billing;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\q8_invoice;
use App\models\q8_invoice_details;

class GenerateInvoice extends Component
{
    public $items = [];
    public $discount = 0;
    public $tax = 0;
    public $total;
    public $invoice_id;
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
            'invoice_id' => 'unique:q8_invoice,invoice_id',
            'invoice_no' => 'unique:q8_invoice,invoice_no',
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
            'invoice_id.unique' => 'Transaction  ID must be unique.',
            'invoice_no.unique' => 'Invoice Number must be unique.',
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

    public function mount()
    {
        $this->invoice_date = now()->format('Y-m-d');
        $this->invoice_id = now()->format('mdYhis');

        $lastInvoice = q8_invoice::orderBy('id', 'desc')->first();
        $auto_invoice = $lastInvoice ? $lastInvoice->invoice_no + 1 : 1;
        $this->invoice_no = "00".$auto_invoice;
        $this->dispatch('search_date');
    }

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

    public function saveInvoice()
    {
        try {
            // Validate input fields
            $this->validate();

            // Insert the invoice into the database
            q8_invoice::insert([
                'invoice_id' => $this->invoice_id,
                'invoice_no' => $this->invoice_no,
                'invoice_date' => $this->invoice_date,
                'client' => $this->selectedClient,
                'project' => $this->project,
                'due_date' => $this->due_date,
                'notes' => $this->note,
                'subtotal' => '$' . number_format(($this->total ?? 0), 2), // Calculate from item list if needed
                'email' => '', // Optional field
                'status' => 'Pending',
                'sales_representative' => '',
                'commission' => '',
            ]);

            // Insert invoice items
            foreach ($this->items as $item) {
                q8_invoice_details::insert([
                    'invoice_id'    => $this->invoice_id,
                    'invoice_no'    => $this->invoice_no,
                    'item_date'     => $item['date'] ?? null,
                    'item_desc'     => $item['description'] ?? '',
                    'item_qty'      => $item['quantity'] ?? 1,
                    'item_unitprice'=> $item['cost'] ?? 0,
                    'item_total'    => '$' . number_format(($item['price'] ?? 0), 2),
                ]);
            }


            // Clear validation errors
            $this->dispatch('validationError', ['errors' => []]);

            // Show success toast
            $this->dispatch('query', [
                'status' => 'bg-success',
                'message' => 'Invoice #' . $this->invoice_no . ' Created Successfully!',
                'errorMessage' => ''
            ]);

            // Reset form fields
            $this->reset();
            $this->mount();
            $this->dispatch('resetForm');
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
