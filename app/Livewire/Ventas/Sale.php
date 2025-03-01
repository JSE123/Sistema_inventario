<?php

namespace App\Livewire\Ventas;

use App\Models\Sale as ModelsSale;
use Livewire\Component;
use Livewire\WithPagination;

class Sale extends Component
{

    use WithPagination;
    public $currentComponent = 'sales';
    public $selectedSaleId;
    protected $paginationTheme = 'tailwind';
    
    public $count = 0;
    
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
        // $this->sales = ModelsSale::with('saleDetails')->paginate(10);
    }

    public function render()
    {
        $sales = ModelsSale::with('saleDetails')->paginate(10);
        return view('livewire.ventas.sales' , compact('sales'));
    }
}
