<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Cuenta;

class CuentaCreate extends Component
{
    public $empresa_id, $numero, $nombre, $tipo, $parent_id, $fondo;

    public function save()
    {
        $this->validate([
            'empresa_id' => 'required|exists:empresas,id',
            'numero' => 'required|string|unique:cuentas,numero',
            'nombre' => 'required|string',
            'tipo' => 'required|in:acumulativa,detalle',
            'parent_id' => 'nullable|exists:cuentas,id',
            'fondo' => 'nullable|numeric|min:0',
        ]);

        Cuenta::create([
            'empresa_id' => $this->empresa_id,
            'numero' => $this->numero,
            'nombre' => $this->nombre,
            'tipo' => $this->tipo,
            'parent_id' => $this->parent_id,
            'fondo' => $this->fondo,
        ]);

        session()->flash('success', 'Cuenta creada con éxito.');
        return redirect()->route('cuentas.view', ['empresa_id' => $this->empresa_id]);
    }

    public function render()
    {
        return view('livewire.cuenta-create');
    }
}
