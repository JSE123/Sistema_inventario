<?php

namespace App\Livewire\Ventas;

use App\Models\Client;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleDetail;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

use function Laravel\Prompts\alert;

class AddSale extends Component
{
    // para clientes
    public $clienteBusqueda = '';
    public $clients = [];
    public $clienteSeleccionado = null;

    // para productos
    public $productoBusqueda = '';
    public $products = [];
    public $productSeleccionado = null;



    public $fecha;

    public $cantidad = 0;

    public $carrito = [];


    
    public function mount()
    {
        $this->fecha = now()->format('Y-m-d'); // Fecha actual en formato 'YYYY-MM-DD'
    }


    public function updatedClienteBusqueda()
    {
        $this->buscarCliente();
    }
    public function buscarCliente()
    {
        if (strlen($this->clienteBusqueda) > 2) {
            $this->clients = Client::where('name', 'like', '%' . $this->clienteBusqueda . '%')->limit(5)->get();
        } else {
            $this->clients = [];
        }
    }

    public function seleccionarCliente($clienteId)
    {
        $cliente = Client::find($clienteId);
        if ($cliente) {
            $this->clienteSeleccionado = $cliente;
            $this->clienteBusqueda = $cliente->name;
            $this->clients = []; // Limpiar sugerencias
            $this->reset('clients');
        }
    }
    public function buscarProducto()
    {
        if (strlen($this->productoBusqueda) > 1) {
            $this->products = Product::where('name', 'ILIKE', '%' . $this->productoBusqueda . '%')->limit(5)->get();
        } else {
            $this->products = [];
        }
    }

    public function seleccionarProducto($productId)
    {
        $producto = Product::find($productId);
        if ($producto) {
            $this->productSeleccionado = $producto;
            $this->productoBusqueda = $producto->name;
            // $this->carrito = array_merge($this->carrito, [$producto]);
            $this->products = []; // Limpiar sugere<<ncias
        }
    }

    // agrego producto al carrito
    public function agregarProducto(){
        if($this->productSeleccionado && $this->cantidad > 0){
             //verificar si el producto tiene stock suficiente
             $product = Product::find($this->productSeleccionado->id);
             if($product->stock < $this->cantidad){
                 session()->flash('message', 'El producto '.$product->name.' no tiene stock suficiente');
                 return;
             }
            $this->carrito[] = [
                'id' => $this->productSeleccionado->id,
                'name' => $this->productSeleccionado->name,
                'price' => $this->productSeleccionado->price,
                'cantidad' => $this->cantidad,
                'total' => $this->cantidad * $this->productSeleccionado->price,
            ];
            $this->productSeleccionado = null;
            $this->productoBusqueda = '';
            $this->cantidad = 0;
        }else{
            session()->flash('error', 'Debes seleccionar un producto y la cantidad');
        }
    }

    public function store(){
        ("buscarCliente: $this->clienteBusqueda");


    }

    public function registrarVenta(){
        if(!empty($this->clienteSeleccionado && !empty($this->carrito))){
            
            $total = 0;
            $sale_details = null;
            //guardar venta
            $sale = Sale::create([
                'client_id' => $this->clienteSeleccionado->id,
                'total' => $total
            ]);

            //calcular el total de la venta
            foreach($this->carrito as $item){
               
                $total += $item['total'];
            }

            // $venta = $this->clienteSeleccionado->sales()->create([
            //     'total' => $total
            // ]);
            
            // guardar venta 
            $sale = Sale::create([
                'client_id' => $this->clienteSeleccionado->id,
                'total' => $total
            ]);

            //guardar detalles de la venta
            foreach($this->carrito as $item){
                // $venta->products()->attach($item['id'], ['cantidad' => $item['cantidad']]);
                $sale_details = SaleDetail::create([
                    'product_id' => $item['id'],
                    'sale_id' => $sale->id,
                    'quantity' => $item['cantidad'],
                    'sub_total' => $item['total']
                ]);
            }

            // decrementar stock
            foreach($this->carrito as $item){
                $product = Product::find($item['id']);
                $product->stock -= $item['cantidad'];
                $product->save();
            }
            

            $this->carrito = [];
            $this->clienteSeleccionado = null;
            $this->clienteBusqueda = '';
            session()->flash('message', 'Venta registrada correctamente');
            return redirect()->route('ventas.index');
        }else{
            session()->flash('message', 'Debes seleccionar un cliente y al menos un producto');
        }
    }

    public function render()
    {

        return view('livewire.ventas.add-sale');
    }

    
}
