<?php

namespace App\Livewire\Productos;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request;
use Livewire\Component;

class EditProducto extends Component
{
    public function update(Request $request, Product $product){
        $request->validate([
            'name' => 'required|string|max:255|min:4',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'costo' => 'required|numeric|min:0',
            'stock_min' => 'required|integer|min:0',
        ]);
        DB::beginTransaction();
        try{
            $product->update($request->all());
            DB::commit();
            return redirect()->route('productos.index')->with('success', 'Producto editado correctamente.');
        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error', 'Error al editar el producto.');
        }

    }

    public function render()
    {
        return view('livewire.productos.edit-producto');
    }
}
