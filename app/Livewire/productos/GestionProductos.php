<?php

namespace App\Livewire\productos;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class GestionProductos extends Component
{   
    use WithPagination;
    protected $paginationTheme = 'tailwind';

    public $currentComponent = 'products';




    public $search = '';

    public $prueba = '';

    public function cambiarValor(){
        $this->prueba = $this->search;
    }

    public function updatingSearch()
    {
        $this->resetPage(); // Reinicia la paginación al buscar
    }


    //funcion para cambiar el componente actual
    public function changeComponent($component)
    {
        $this->currentComponent = $component;
    }

    public function edit(Product $product)
    {
        return view('livewire.productos.edit-producto', compact('product'));
    }


    

    public function render()
    {
        // $products = Product::when($this->search, function ($query) {
        //     $query->where('name', 'like', '%' . $this->search . '%');
        // })->paginate(7);

        $lowStockProducts = Product::where('stock', '<=', 5)->get();

        $products = Product::where('name', 'ILIKE', '%' . $this->search . '%')
        ->orWhere('description', 'ILIKE', '%' . $this->search . '%')
        ->orderBy('name', 'asc')    
        ->paginate(7);
        return view('livewire.productos.gestion-productos', compact('products', 'lowStockProducts'));
    }
}
