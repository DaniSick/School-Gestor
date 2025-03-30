<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Empresa;

class EmpresaEdit extends Component
{
    public $empresaId, $nombre, $razon_social, $rfc, $direccion, $telefono, $email, $representante_legal, $fecha_creacion, $estatus;

    public function mount($id)
    {
        $empresa = Empresa::findOrFail($id);
        $this->empresaId = $empresa->id;
        $this->nombre = $empresa->nombre;
        $this->razon_social = $empresa->razon_social;
        $this->rfc = $empresa->rfc;
        $this->direccion = $empresa->direccion;
        $this->telefono = $empresa->telefono;
        $this->email = $empresa->email;
        $this->representante_legal = $empresa->representante_legal;
        $this->fecha_creacion = $empresa->fecha_creacion;
        $this->estatus = $empresa->estatus;
    }

    public function update()
    {
        $this->validate([
            'nombre' => 'required|string|unique:empresas,nombre,' . $this->empresaId,
            'razon_social' => 'required|string',
            'rfc' => 'required|string|unique:empresas,rfc,' . $this->empresaId,
            'direccion' => 'required|string',
            'telefono' => 'required|string',
            'email' => 'required|email',
            'representante_legal' => 'required|string',
            'fecha_creacion' => 'required|date',
        ]);

        $empresa = Empresa::findOrFail($this->empresaId);
        $empresa->update([
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

        session()->flash('success', 'Empresa actualizada con éxito.');
        return redirect()->route('empresas.view');
    }

    public function render()
    {
        return view('livewire.empresa-edit');
    }
}
