<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Cuenta;

class CuentasView extends Component
{
    public $cuentas;

    public function mount()
    {
        $this->cuentas = Cuenta::all();
    }

    public function render()
    {
        return view('livewire.cuentas-view', ['cuentas' => $this->cuentas]);
    }
}
