<?php

namespace App\Livewire\Provedor;

use App\Models\Proveedor as ModelsProveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Proveedor extends Component
{

    use WithPagination;
    protected $paginationTheme = 'tailwind';

    public $prueba = 'asfda';
    public $search = '';

    public function cambiarValor(){
        $this->prueba = $this->search;
    }


    public function destroy(ModelsProveedor $proveedor)
    {
        DB::beginTransaction();
        try {
            $proveedor->delete();
            DB::commit();
            return redirect()->route('proveedores.index')->with('success', 'Proveedor eliminado correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error al eliminar el proveedor.');
        }
    }

    public function updatingSearch()
    {
        $this->resetPage(); // Reinicia la paginación al buscar
    }


    

     //llama la vista donde se muestra el formulario de editar proveedor
     public function edit(ModelsProveedor $proveedor)   
     {
        return view('livewire.provedor.edit-proveedor',compact('proveedor'));
     }

    public function render()
    {
        // if($this->search != ''){
        //     $proveedores = ModelsProveedor::where('name', 'like', '%' . $this->search . '%')
        //     ->orWhere('email', 'like', '%' . $this->search . '%')
        //     ->paginate(7);
        //     return view('livewire.provedor.proveedor', compact('proveedores'));
        // }else{
        //     $proveedores = ModelsProveedor::paginate(7);
        //     return view('livewire.provedor.proveedor', compact('proveedores'));
        // }
        $proveedores = ModelsProveedor::where('name', 'like', '%' . $this->search . '%')
        ->orWhere('email', 'like', '%' . $this->search . '%')
        ->orderBy('name', 'asc')
        ->paginate(7);


        // $proveedores = ModelsProveedor::paginate(7);
        return view('livewire.provedor.proveedor', compact('proveedores'));
        }
}
