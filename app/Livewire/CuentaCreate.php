<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Cuenta;

class CuentaCreate extends Component
{
    public $empresa_id;

    public function save()
    {
        $lastCuenta = Cuenta::where('empresa_id', $this->empresa_id)->latest('id')->first();
        $nextNombre = $lastCuenta ? 'C' . str_pad($lastCuenta->id + 1, 4, '0', STR_PAD_LEFT) : 'C0001';

        Cuenta::create([
            'empresa_id' => $this->empresa_id,
            'nombre' => $nextNombre,
        ]);

        session()->flash('success', 'Cuenta creada con éxito.');
        return redirect()->route('cuentas.view', ['empresa_id' => $this->empresa_id]);
    }

    public function render()
    {
        return view('livewire.cuenta-create');
    }
}
