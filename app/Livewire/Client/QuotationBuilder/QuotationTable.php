<?php

namespace App\Livewire\Client\QuotationBuilder;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;

class QuotationTable extends Component
{
    use WithPagination;

    public $search = '';

    protected $paginationTheme = 'bootstrap';
    
    public function render()
    {
        return view('livewire.client.quotation-builder.quotation-table');
    }

    public function createQuote(){
        // Trigger modal
        $this->dispatch('openQuoteModal');
    }
}
