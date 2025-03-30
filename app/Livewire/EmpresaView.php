<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Empresa;

class EmpresaView extends Component
{
    public $empresas;

    public function mount()
    {
        $this->empresas = Empresa::all();
    }

    public function delete($id)
    {
        $empresa = Empresa::findOrFail($id);
        $empresa->delete();

        session()->flash('success', 'Empresa eliminada con éxito.');
        $this->empresas = Empresa::all(); // Refrescar la lista
    }

    public function render()
    {
        return view('livewire.empresa-view', ['empresas' => $this->empresas]);
    }
}
