<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\TipoPoliza;

class TipoPolizaCreate extends Component
{
    public $empresa_id;
    public $tipo;
    public $descripcion;

    public function mount($empresa_id)
    {
        $this->empresa_id = $empresa_id;
    }

    public function save()
    {
        $this->validate([
            'tipo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        TipoPoliza::create([
            'empresa_id' => $this->empresa_id,
            'tipo' => $this->tipo,
            'descripcion' => $this->descripcion,
        ]);

        session()->flash('success', 'Tipo de póliza creado con éxito.');
        return redirect()->route('tipos-polizas.view', ['empresa_id' => $this->empresa_id]);
    }

    public function render()
    {
        return view('livewire.tipo-poliza-create');
    }
}
