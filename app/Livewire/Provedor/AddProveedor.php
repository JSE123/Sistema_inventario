<?php

namespace App\Livewire\Provedor;

use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class AddProveedor extends Component
{

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:proveedors',
            'email' => 'required|email|unique:proveedors',
            'address' => 'required',
        ]);
        DB::beginTransaction();
        try{
    
            Proveedor::create($request->all());     
            DB::commit();
    
            // $this->reset(['name', 'email', 'address']);
            
            session()->flash('message', 'Proveedor creado correctamente.');
            return redirect()->route('proveedores.index');

        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error', 'Error al agregar el proveedor.');


        }
    }


    public function render()
    {
        return view('livewire.provedor.add-proveedor');
    }
}
