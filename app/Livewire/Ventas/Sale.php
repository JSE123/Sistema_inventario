<?php

namespace App\Livewire\Ventas;

use App\Models\Sale as ModelsSale;
use Livewire\Component;

class Sale extends Component
{
    public $currentComponent = 'sales';
    public $selectedSaleId;

    
    public $sales;
    
    public function changeComponent($component, $id = null)
    {
        if($id){
            $this->setSaleId($id);
        }   
        $this->currentComponent = $component;
    }

    public function setSaleId($id){
        $this->selectedSaleId = $id;
    }

    public function mount()
    {
        $this->sales = ModelsSale::with('saleDetails')->get();
    }

    public function render()
    {
        return view('livewire.ventas.sales');
    }
}
