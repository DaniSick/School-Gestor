<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Cuenta;

class CuentaEdit extends Component
{
    public $cuentaId, $empresa_id, $numero, $nombre, $tipo, $parent_id, $fondo;

    public function mount($id)
    {
        $cuenta = Cuenta::findOrFail($id);
        $this->cuentaId = $cuenta->id;
        $this->empresa_id = $cuenta->empresa_id;
        $this->numero = $cuenta->numero;
        $this->nombre = $cuenta->nombre;
        $this->tipo = $cuenta->tipo;
        $this->parent_id = $cuenta->parent_id;
        $this->fondo = $cuenta->fondo;
    }

    public function update()
    {
        $this->validate([
            'empresa_id' => 'required|exists:empresas,id',
            'numero' => 'required|string|unique:cuentas,numero,' . $this->cuentaId . ',id,empresa_id,' . $this->empresa_id,
            'nombre' => 'required|string',
            'tipo' => 'required|in:acumulativa,detalle',
            'parent_id' => 'nullable|exists:cuentas,id',
            'fondo' => 'nullable|numeric|min:0',
        ]);

        $cuenta = Cuenta::findOrFail($this->cuentaId);
        $cuenta->update([
            'empresa_id' => $this->empresa_id,
            'numero' => $this->numero,
            'nombre' => $this->nombre,
            'tipo' => $this->tipo,
            'parent_id' => $this->parent_id,
            'fondo' => $this->fondo,
        ]);

        session()->flash('success', 'Cuenta actualizada con éxito.');
        return redirect()->route('cuentas.view', ['empresa_id' => $this->empresa_id]);
    }

    public function render()
    {
        return view('livewire.cuenta-edit');
    }
}
