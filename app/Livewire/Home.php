<?php

namespace App\Livewire;

use App\Models\Client;
use App\Models\Product;
use App\Models\Proveedor;
use App\Models\Sale;
use Carbon\Carbon;
use Livewire\Component;

class Home extends Component
{

    public $currentComponent = 'home';

    public function changeComponent($component)
    {
        $this->currentComponent = $component;
    }
    public function render()
    {

        $products = Product::with('category')->paginate(10);
        $ventas = Sale::with('client')->latest()->take(10)->get();
        // $ventas = Sale::with(['client', 'saleDetails'])->latest()->take(10)->get();
        //obtener cantidad de clientes
        $clientesCount = Client::count();
        $proveedoresCount = Proveedor::count();
        $totalVentasMesActual = Sale::whereMonth('created_at', Carbon::now()->month)
        ->whereYear('created_at', Carbon::now()->year)
        ->sum('total');
        $productsCount = Product::count();
        return view('livewire.home', compact('products', 'clientesCount', 'ventas', 'productsCount', 'totalVentasMesActual', 'proveedoresCount'));  
    }
}
