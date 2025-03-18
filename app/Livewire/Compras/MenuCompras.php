<?php

namespace App\Livewire\Compras;

use App\Models\Purshase;
use Livewire\Component;
use Livewire\WithPagination;

class MenuCompras extends Component
{
 
    use WithPagination;
    protected $paginationTheme = 'tailwind';

    public $componente = "menu-compras";
    public $compraId = null;

    public function cambiarComponente($nombre, $id = null){
        if($id){
            $this->setCompraId($id);
        }
        $this->componente = $nombre;
    }

    public function setCompraId($id){
        
        $this->compraId = $id;
    }

    public function render()
    {
        $compras = Purshase::with("supplier")->paginate(7);
        return view('livewire.compras.menu-compras', compact("compras"));
    }
}
