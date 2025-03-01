<?php

namespace App\Livewire\Clientes;

use App\Models\Client;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Clientes extends Component
{
    use WithPagination;
    protected $paginationTheme = 'tailwind';

    // public $clients;
    public $search;


    public $prueba = '';

    public function cambiarValor(){
        $this->prueba = $this->search;
    }

    public function index(Request $request){
        // $customers = Customer::all();

        $busqueda = $request->input('busqueda');
        $customers = Client::when($busqueda, function ($query, $busqueda) {
            return $query->where('name', 'like', "%{$busqueda}%");
        })->get();
        return view('pages.customer', compact('busqueda','customers'));
    }

    //llama la vista donde se muestra el formulario de editar nuevo cliente
    public function edit(Client $cliente)
    {
        return view('livewire.clientes.edit',compact('cliente'));
    }

    public function destroy(Client $cliente)
    {
        DB::beginTransaction();
        try {
            $cliente->delete();
            DB::commit();
            return redirect()->route('clientes.index')->with('success', 'Cliente eliminado correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error al eliminar el cliente.');
        }
    }
    public function render()
    {
        $clients = Client::where('name', 'ILIKE', '%' . $this->search . '%')
        ->orWhere('email', 'ILIKE', '%' . $this->search . '%')
        ->orWhere('phone', 'ILIKE', '%' . $this->search . '%')
        ->orderBy('name', 'asc')    
        ->paginate(6);
        
        return view('livewire.clientes.clientes', compact('clients'));
    }

}
