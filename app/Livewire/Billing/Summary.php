<?php

namespace App\Livewire\Billing;

use Livewire\Component;
use App\Models\q8_invoice;
use Livewire\WithPagination;

class Summary extends Component
{
    use WithPagination;
    public $search = '';
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $invoices = q8_invoice::
        orderBy('id', 'desc')
        ->paginate(10);

        return view('livewire.billing.summary',[
            'invoices' => $invoices,
        ]);
    }
}
