<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\TipoPoliza;
use App\Models\Empresa;

class TiposPolizasView extends Component
{
    public $empresa_id;
    public $tiposPolizas;

    public function mount($empresa_id)
    {
        $this->empresa_id = $empresa_id;
        $this->tiposPolizas = TipoPoliza::where('empresa_id', $empresa_id)->get();
    }

    public function delete($id)
    {
        $tipoPoliza = TipoPoliza::findOrFail($id);
        $tipoPoliza->delete();

        // Refrescar la lista después de eliminar
        $this->tiposPolizas = TipoPoliza::where('empresa_id', $this->empresa_id)->get();
        session()->flash('success', 'Tipo de póliza eliminado con éxito.');
    }

    public function render()
    {
        return view('livewire.tipos-polizas-view', [
            'empresas' => Empresa::all(),
            'tiposPolizas' => $this->tiposPolizas,
        ]);
    }
}
