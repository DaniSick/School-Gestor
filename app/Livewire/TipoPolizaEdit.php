<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\TipoPoliza;

class TipoPolizaEdit extends Component
{
    public $tipoPolizaId;
    public $empresa_id;
    public $tipo;
    public $descripcion;

    public function mount($id)
    {
        $tipoPoliza = TipoPoliza::findOrFail($id);
        $this->tipoPolizaId = $tipoPoliza->id;
        $this->empresa_id = $tipoPoliza->empresa_id;
        $this->tipo = $tipoPoliza->tipo;
        $this->descripcion = $tipoPoliza->descripcion;
    }

    public function update()
    {
        $this->validate([
            'tipo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        $tipoPoliza = TipoPoliza::findOrFail($this->tipoPolizaId);
        $tipoPoliza->update([
            'tipo' => $this->tipo,
            'descripcion' => $this->descripcion,
        ]);

        session()->flash('success', 'Tipo de póliza actualizado con éxito.');
        return redirect()->route('tipos-polizas.view', ['empresa_id' => $this->empresa_id]);
    }

    public function render()
    {
        return view('livewire.tipo-poliza-edit');
    }
}
