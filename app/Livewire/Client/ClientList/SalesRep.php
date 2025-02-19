<?php

namespace App\Livewire\Client\ClientList;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;

class SalesRep extends Component
{

    use WithPagination;

    public $search = '';

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $sales = DB::table('q8_salesrep')
        ->where('sales_representative', 'like', '%' . $this->search . '%')
        // ->orderBy('first_name', 'ASC')
        // ->paginate($this->perPage);
        ->paginate(10);


        // dd($employees);

        return view('livewire.client.client-list.sales-rep',[
            'sales' => $sales,
        ]);
    }

    public function addSales(){
        // Trigger modal
        $this->dispatch('openSalesModal');
    }
}
