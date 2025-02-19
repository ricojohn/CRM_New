<?php

namespace App\Livewire\Client\ClientList;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;

class ClientTable extends Component
{
    use WithPagination;

    public $search = '';

    protected $paginationTheme = 'bootstrap';
    
    public function render()
    {
        
        $clients = DB::table('q8_clients')
        ->where('company_name', 'like', '%' . $this->search . '%')
        // ->orderBy('first_name', 'ASC')
        // ->paginate($this->perPage);
        ->paginate(10);


        // dd($employees);

        return view('livewire.client.client-list.client-table',[
            'clients' => $clients,
        ]);
    }

    public function addClient(){
        // Trigger modal
        $this->dispatch('openClientModal');
    }


}
