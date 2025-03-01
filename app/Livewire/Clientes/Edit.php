<?php

namespace App\Livewire\Clientes;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Edit extends Component
{

    public function update( Request $request, Client $cliente){
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:clients,email,' . $cliente->id,
            'phone' => 'nullable',
            'address' => 'nullable'
        ]);
        DB::beginTransaction();
        try{
            $cliente->update($request->all());
            DB::commit();
            return redirect()->route('clientes.index')->with('success', 'Cliente actualizado correctamente.');
        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error', 'Error al actualizar el cliente.');
        }
    }
    public function render()
    {
        return view('livewire.clientes.edit');
    }
}
