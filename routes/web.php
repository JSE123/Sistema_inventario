<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SalesController;
use App\Livewire\Clientes\AddClient;
use App\Livewire\Clientes\Clientes;
use App\Livewire\Clientes\Edit;
use App\Livewire\Compras\CreatePurshase;
use App\Livewire\Compras\CreateQuotation;
use App\Livewire\Home;
use App\Livewire\Perfil;
use App\Livewire\Productos\EditProducto;
use App\Livewire\productos\GestionProductos;
use App\Livewire\Provedor\AddProveedor;
use App\Livewire\Provedor\EditProveedor;
use App\Livewire\Provedor\Proveedor;
use App\Livewire\TestComponent;
use App\Livewire\Ventas\AddSale;
use App\Livewire\Ventas\Index;
use App\Livewire\Ventas\Sale;
use Faker\Guesser\Name;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;

Route::get('/',[Home::class, "render"])->middleware('auth')->name('home');
Route::get('/perfil', [Perfil::class, 'render'])->name('profile')->middleware('auth');

Route::middleware(['guest'])->group(function () {
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login']);
});

Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');


Route::prefix('clientes')->middleware(['auth'])->group(function () {
    Route::get('/', function(){
        return view('livewire.clientes.index');
    })->name('clientes.index');
    Route::get('/agregar', [AddClient::class, 'render'])->name('clientes.add');
    Route::get('create', [AddClient::class, 'render'])->name('clientes.create');
    Route::post('store', [AddClient::class, 'store'])->name('clientes.store');
    Route::get('/edit/{cliente}', [Clientes::class, 'edit'])->name('clientes.edit');
    Route::put('/{cliente}', [Edit::class, 'update'])->name('clientes.update');
    Route::delete('/{cliente}', [Clientes::class, 'destroy'])->name('clientes.delete');
});

Route::prefix('productos')->middleware(['auth'])->group(function () {
    //carga la vista principal de gestion producto donde se muestra un listado de productos
    Route::get('/', function(){
        return view('livewire.productos.index');
    })->name('productos.index');
    // Route::get('/', [GestionProductos::class, 'render'])->name('productos.index');
    

    Route::get('/agregar', [ProductController::class, 'create'])->name('products.create');
    


    //guarda el producto que se quiere agregar
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    
    //mostrar vista para editr productos
    Route::get('/{product}', [GestionProductos::class, 'edit'])->name('products.edit');
    


    //guardar los cambios
    Route::put('/{product}', [EditProducto::class, 'update'])->name('product.update');
    
    //ruta para eliminar producto
    Route::delete('/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
});


Route::prefix('ventas')->middleware(['auth'])->group(function () {
    //carga la vista principal de gestion de ventas donde se muestra un listado de ventas
    Route::get('/', function () {
        return view('livewire.ventas.index');
    })->name('ventas.index');
    
    //guarda la venta que se quiere agregar
    Route::post('/create', [SalesController::class, 'store'])->name('ventas.store');
    
    //guardar los cambios
    Route::put('/{product}', [ProductController::class, 'update'])->name('products.update');
    
    //ruta para eliminar producto
    Route::delete('/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

    //generar informe de ventas
    // Route::get('/informe', [ReportController::class, 'ventasInforme'])->name('ventas.report');
    // Route::get('/informe/reporteVenta', [ReportController::class, 'ventasInforme'])->name('ventas.report');
    Route::get('/reportes/ventas/pdf', [ReportController::class, 'ventasPDF'])->name('sales.report.pdf');

    Route::get('/reportes/ventas/excel', [ReportController::class, 'ventasExcel'])->name('reportes.ventas.excel');


});

Route::prefix('proveedores')->middleware(['auth'])->group(function () {
    Route::get('/', function(){
        return view('livewire.provedor.index');
    })->name('proveedores.index');
    Route::get('create', [AddProveedor::class, 'render'])->name('proveedores.create');
    Route::post('store', [AddProveedor::class, 'store'])->name('proveedores.store');
    Route::get('edit/{proveedor}', [Proveedor::class, 'edit'])->name('proveedores.edit');
    Route::put('/{proveedor}', [EditProveedor::class, 'update'])->name('proveedores.update');
    Route::delete('/{proveedor}', [Proveedor::class, 'destroy'])->name('proveedores.delete');
});

Route::prefix("compras")->middleware(['auth'])->group(function(){
    Route::get('/', function(){
        return view('livewire.compras.index');
    })->name('compras.index');

    Route::get('/crear', [CreateQuotation::class, 'render'])->name('compras.create');
    Route::get('/crear', [CreatePurshase::class, 'render'])->name('compras.add');
    Route::post('/store', [CreatePurshase::class, 'store'])->name('compras.store');
});