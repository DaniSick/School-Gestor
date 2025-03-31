<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Empresa;

class EmpresaCreate extends Component
{
    public $nombre, $razon_social, $rfc, $direccion, $telefono, $email, $representante_legal, $fecha_creacion, $estatus = true;

    public function save()
    {
        $this->validate([
            'nombre' => 'required|string|unique:empresas,nombre',
            'razon_social' => 'required|string',
            'rfc' => 'required|string|unique:empresas,rfc',
            'direccion' => 'required|string',
            'telefono' => 'required|string',
            'email' => 'required|email',
            'representante_legal' => 'required|string',
            'fecha_creacion' => 'required|date',
        ]);

        $empresa = Empresa::create([
            'nombre' => $this->nombre,
            'razon_social' => $this->razon_social,
            'rfc' => $this->rfc,
            'direccion' => $this->direccion,
            'telefono' => $this->telefono,
            'email' => $this->email,
            'representante_legal' => $this->representante_legal,
            'fecha_creacion' => $this->fecha_creacion,
            'estatus' => $this->estatus,
        ]);

        // Cargar cuentas predeterminadas
        $empresa->cargarCuentasPredeterminadas();

        session()->flash('success', 'Empresa registrada con éxito.');
        return redirect()->route('empresas.view');
    }

    public function render()
    {
        return view('livewire.empresa-create');
    }
}
