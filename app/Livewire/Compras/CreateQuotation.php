<?php

namespace App\Livewire\Compras;

use App\Livewire\Provedor\Proveedor;
use App\Models\Product;
use App\Models\Proveedor as ModelsProveedor;
use Livewire\Component;

class CreateQuotation extends Component
{
    public function render()
    {

        //obtener productos
        $products = Product::all();
        //obtener proveedores
        $suppliers = ModelsProveedor::all();
        return view('livewire.compras.create-quotation', compact('products', 'suppliers'));
    }
}
