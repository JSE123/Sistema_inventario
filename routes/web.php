<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SalesController;
use App\Livewire\Clientes\AddClient;
use App\Livewire\Home;
use App\Livewire\Perfil;
use App\Livewire\productos\GestionProductos;
use App\Livewire\TestComponent;
use App\Livewire\Ventas\AddSale;
use App\Livewire\Ventas\Index;
use App\Livewire\Ventas\Sale;
use Faker\Guesser\Name;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;

// Route::get('/', [Home::class, 'render'])->middleware('auth')->name('home');
Route::get('/',function(){
    return view('livewire.home');
})->middleware('auth')->name('home');

Route::get('/perfil', [Perfil::class, 'render'])->name('profile');

Route::get('/login', function(){
    return view('auth.login');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');



// Route::middleware(['auth'])->prefix('ventas')->group(function () {
//     // Route::get('/', [Sale::class, 'render'])->name('ventas.index');
//     Route::get('create', [AddSale::class, 'render'])->name('ventas.create');//cargar formulario para agregar nueva venta
//     Route::post('store', [AddSale::class, 'store'])->name('ventas.store');
//     Route::get('edit/{id}', [Sale::class, 'edit'])->name('ventas.edit');
//     Route::post('update/{id}', [Sale::class, 'update'])->name('ventas.update');
//     Route::get('delete/{id}', [Sale::class, 'delete'])->name('ventas.delete');
// });


Route::middleware(['auth'])->prefix('clientes')->group(function () {
    Route::get('/', [AddClient::class, 'render'])->name('clientes.index');
    Route::get('create', [AddClient::class, 'render'])->name('clientes.create');
    Route::post('store', [AddClient::class, 'store'])->name('clientes.store');
    Route::get('edit/{id}', [Sale::class, 'edit'])->name('clientes.edit');
    Route::post('update/{id}', [Sale::class, 'update'])->name('clientes.update');
    Route::get('delete/{id}', [Sale::class, 'delete'])->name('clientes.delete');
});

Route::prefix('productos')->middleware(['auth'])->group(function () {
    //carga la vista principal de gestion producto donde se muestra un listado de productos
    Route::get('/', [GestionProductos::class, 'render'])->name('productos.index');
    

    Route::get('/agregar', [ProductController::class, 'create'])->name('products.create');
    


    //guarda el producto que se quiere agregar
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    
    //mostrar vista para editr productos
    Route::get('/products/{id}', [ProductController::class, 'edit'])->name('products.edit');
    


    //guardar los cambios
    Route::put('/{product}', [ProductController::class, 'update'])->name('products.update');
    
    //ruta para eliminar producto
    Route::delete('/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
});


Route::prefix('ventas')->middleware(['auth'])->group(function () {
    //carga la vista principal de gestion de ventas donde se muestra un listado de ventas
    // Route::get('/', [SalesController::class, 'index'])->name('ventas.index');
    // Route::get('/ventas', function () {
    //     return Livewire::mount('ventas.sale');
    // })->name('ventas.index');
    Route::get('/', function () {
        return view('livewire.ventas.index');
    })->name('ventas.index');
    
    //guarda la venta que se quiere agregar
    Route::post('/create', [SalesController::class, 'store'])->name('ventas.store');
    
    //guardar los cambios
    Route::put('/{product}', [ProductController::class, 'update'])->name('products.update');
    
    //ruta para eliminar producto
    Route::delete('/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
});

Route::get('/test', [TestComponent::class, 'render'])->name('test');    