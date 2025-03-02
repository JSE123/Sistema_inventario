<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function store(Request $request){
        // Validación de datos
        $request->validate([
            'name' => 'required|string|max:255|min:4',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'costo' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        try {
            DB::transaction(function () use ($request) {
                Product::create([
                    'name' => $request->name,
                    'description' => $request->description,
                    'price' => $request->price,
                    'costo' => $request->costo,
                    'stock' => $request->stock,
                    'stock_min' => 5,
                    'category_id' => $request->category_id,
                ]);
            });
    
            return redirect()->route('productos.index')->with('success', 'Producto agregado correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al agregar el producto.');
        }

        // Crear y guardar el producto en la base de datos
      

        // Redireccionar con mensaje de éxito
        // return redirect()->route('gestionProductos')->with('success', 'Producto agregado correctamente.');
    }

    public function getCategoryById($id){

    }
    public function create(){
        $categories = Category::all(); // Obtener todas las categorías
        return view('livewire.productos.agregar-producto', compact('categories'));
    }


    public function index(){
        $products = Product::with('category')->get(); 

        return view('livewire.productos.gestionProductos', compact('products'));
    }

     // Mostrar el formulario de edición
     public function edit(Product $product)
     {
         $categories = Category::all(); // Obtener todas las categorías
         return view('pages.editarProducto', compact('product', 'categories'));
     }
     // Actualizar el producto en la base de datos
    public function update(Request $request, Product $product)
    {
        // Validar los datos
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'stock_min' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        // Actualizar producto
        $product->update($validated);

        return redirect()->route('gestionProductos')->with('success', 'Producto actualizado correctamente.');
        // return redirect()->route('products.index')->with('success', 'Producto actualizado correctamente.');
    }

    // Método para eliminar un producto
    public function destroy(Product $product)
    {
        $product->delete(); // Eliminar el producto
        

        return redirect()->route('productos.index')->with('success', 'Producto eliminado correctamente.');
    }
}
