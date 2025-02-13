<?php

namespace App\Livewire\Ventas;

use App\Models\Sale;
use Livewire\Component;

class DetalleVenta extends Component
{
    public $sale;

    public function mount($saleId)
    {
        $this->sale = Sale::with(['client', 'saleDetails'])->findOrFail($saleId);
    }


    public function render()
    {
        return view('livewire.ventas.detalle-venta');
    }
}
