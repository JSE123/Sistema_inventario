<?php

namespace App\Livewire\Provedor;

use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class EditProveedor extends Component
{

    public function update(Request $request, Proveedor $proveedor)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:clients,email,' . $proveedor->id,
            'email' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $proveedor->update($request->all());
            DB::commit();
            return redirect()->route('proveedores.index')->with('success', 'Proveedor actualizado correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error al actualizar el proveedor.');
        }

    }
    public function render()
    {
        return view('livewire.provedor.edit-proveedor');
    }
}
