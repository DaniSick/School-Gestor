<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ContenedorPoliza;
use App\Models\Empresa;

class ContenedoresPolizasView extends Component
{
    public $empresa_id;
    public $contenedores;

    public function mount($empresa_id)
    {
        $this->empresa_id = $empresa_id;
        $this->cargarContenedores();
    }

    public function cargarContenedores()
    {
        $this->contenedores = ContenedorPoliza::where('empresa_id', $this->empresa_id)
            ->with(['tipoPoliza'])
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function delete($id)
    {
        $contenedor = ContenedorPoliza::findOrFail($id);
        
        if ($contenedor->finalizado) {
            session()->flash('error', 'No se puede eliminar un contenedor finalizado.');
            return;
        }
        
        try {
            // Eliminar primero las líneas del contenedor para evitar errores de integridad
            $contenedor->lineasPolizas()->delete();
            // Luego eliminar el contenedor
            $contenedor->delete();
            
            session()->flash('success', 'Contenedor y sus líneas eliminados con éxito.');
        } catch (\Exception $e) {
            session()->flash('error', 'Error al eliminar el contenedor: ' . $e->getMessage());
        }
        
        $this->cargarContenedores();
    }

    public function render()
    {
        return view('livewire.contenedores-polizas-view', [
            'empresas' => Empresa::all(),
        ]);
    }
}
