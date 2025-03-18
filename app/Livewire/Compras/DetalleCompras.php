<?php

namespace App\Livewire\Compras;

use App\Models\Purshase;
use Livewire\Component;

class DetalleCompras extends Component
{
    public $purshase;
    public $id;

    public function mount($compraId){
        $this->purshase = Purshase::with(['supplier', 'details.product'])->findOrFail($compraId);
        // $this->purshase = Purshase::findOrFail($compraId);
        $this->id = $compraId;
    
    }

    public function render()
    {
        return view('livewire.compras.detalle-compras');
    }
}
