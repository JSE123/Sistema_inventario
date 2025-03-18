<?php

namespace App\Livewire\Compras;

use App\Models\Product;
use App\Models\Proveedor;
use App\Models\Purshase;
use App\Models\Purshase_detail;
use App\Models\PurshaseDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Livewire\Component;

class CreatePurshase extends Component
{


    public $proveedorBusqueda = '';// almacena el valor de la busqueda del proveedor que hace el usuario
    public $proveedores = [];// se almacenan los proveedores que coinciden con la busqueda
    public $proveedorSeleccionado = null;// se almacena el proveedor seleccionado


    public $productoBusqueda = '';// almacena el valor de la busqueda del producto que hace el usuario
    public $products = [];// se almacenan los productos que coinciden con la busqueda
    public $productoSeleccionado = null;// se almacena el producto seleccionado

    public $cart = [];
    public $cantidad = 0;
    public $fecha;

    public function buscarProveedor(){
        if(strlen($this->proveedorBusqueda) > 2){
            $this->proveedores = Proveedor::where('name', 'ilike', '%' . $this->proveedorBusqueda . '%')->limit(5)->get();
        }else{
            $this->proveedores = [
            ];
        }
    }

    public function seleccionarProveedor($proveedorId){
        $proveedor = Proveedor::find($proveedorId);
        if($proveedor){
            $this->proveedorSeleccionado = $proveedor;
            $this->proveedorBusqueda = $proveedor->name;
            $this->proveedores = [];
        }
    }

    public function buscarProducto(){
        if(strlen($this->productoBusqueda) > 2){
            $this->products = Product::where('name', 'ilike', '%' . $this->productoBusqueda . '%')->limit(5)->get();
        }else{
            $this->products = [];
        }
    }

    public function seleccionarProducto($productoId){
        $producto = Product::find($productoId);
        if($producto){
            $this->productoSeleccionado = $producto;
            $this->productoBusqueda = $producto->name;
            $this->products = [];
        }
    }

    //funcion que agrega el producto seleccionado al carrito para ser mostrado en la table de productos
    public function agregarProductoAlCarrito(){
        if($this->productoSeleccionado){
            // $this->cart[] = [
            //     'id' => $this->productoSeleccionado->id,
            //     'name' => $this->productoSeleccionado->name,
            //     'cantidad' => $this->cantidad,
            //     'precio' => $this->productoSeleccionado->price,
            //     'total' => $this->cantidad * $this->productoSeleccionado->price
            // ]; 
            $this->productoSeleccionado = null;
            $this->productoBusqueda = '';
        }
    }

    public function agregarProducto(){
        //verificar se ha seleccionado un producto y la cantidad es mayor a 0
        if($this->productoSeleccionado && $this->cantidad > 0){
            $product = Product::find($this->productoSeleccionado->id);
            
            $this->cart[] = [
                'id' => $this->productoSeleccionado->id,
                'name' => $this->productoSeleccionado->name,
                'price' => $this->productoSeleccionado->price,
                'cantidad' => $this->cantidad,
                'total' => $this->cantidad * $this->productoSeleccionado->price,
            ];
            $this->productoSeleccionado = null;
            $this->productoBusqueda = '';
        }else{
            session()->flash('error', 'Debes seleccionar un producto y la cantidad');
        }
    }

    public function store(){
    // verificar si se ha seleccionado proveedor y productos
        if($this->proveedorSeleccionado && count($this->cart) > 0){
            DB::beginTransaction();
            try{
                //crear la compra

                $compra = Purshase::create([
                    'supplier_id' => $this->proveedorSeleccionado->id,
                    'total' => array_sum(array_column($this->cart, 'total'))
                ]);
                // $compra = $this->proveedorSeleccionado->compras()->create([
                //     // 'fecha' => now(),
                //     'total' => array_sum(array_column($this->cart, 'total'))
                // ]);

                //crear los detalles de la compra
                foreach($this->cart as $item){
                    PurshaseDetail::create([
                        'purshase_id' => $compra->id,
                        'product_id' => $item['id'],
                        'quantity' => $item['cantidad'],
                        'unit_price' => $item['price'],
                        'total' => $item['total']
                    ]);
                    //actualizar el stock del producto
                    $producto = Product::find($item['id']);
                    $producto->stock += $item['cantidad'];
                    $producto->save();
                }
                DB::commit();

                //limpiar variables
                $this->proveedorSeleccionado = null;
                $this->proveedorBusqueda = '';
                $this->productoSeleccionado = null;
                $this->productoBusqueda = '';
                $this->cart = [];
                $this->cantidad = 0;
                session()->flash('message', 'Compra realizada con exito');
                return redirect()->route('compras.index');
                
            }catch(\Exception $e){
                DB::rollBack();
                session()->flash('error', 'Ocurrio un error al registrar la compra');
            }
        }else{
            session()->flash('error', 'Debes seleccionar un proveedor y productos');
        }
    }
    public function render()
    {
        return view('livewire.compras.create-purshase');
    }
}
