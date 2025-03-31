<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Cuenta;

class CuentasView extends Component
{
    public $cuentas;
    public $empresa_id;

    public function mount($empresa_id)
    {
        $this->empresa_id = $empresa_id;
        $this->cuentas = Cuenta::where('empresa_id', $empresa_id)->whereNull('parent_id')->with('children')->get();
    }

    public function delete($id)
    {
        $cuenta = Cuenta::findOrFail($id);
        $cuenta->delete();

        // Refrescar las cuentas después de eliminar
        $this->cuentas = Cuenta::where('empresa_id', $this->empresa_id)->whereNull('parent_id')->with('children')->get();
        session()->flash('success', 'Cuenta eliminada con éxito.');
    }

    public function render()
    {
        return view('livewire.cuentas-view', ['cuentas' => $this->cuentas]);
    }
}
