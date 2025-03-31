<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ContenedorPoliza;

class ContenedorPolizaDetails extends Component
{
    public $contenedor;
    public $lineas;

    public function mount($id)
    {
        $this->contenedor = ContenedorPoliza::with(['tipoPoliza', 'empresa'])->findOrFail($id);
        $this->lineas = $this->contenedor->lineasPolizas()->with('cuenta')->get();
    }

    public function render()
    {
        return view('livewire.contenedor-poliza-details');
    }
}
