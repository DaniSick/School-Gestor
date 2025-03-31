<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Empresa;

class ReportesView extends Component
{
    public $empresa_id;
    public $tipo_reporte = 'balanza';
    public $fecha_inicio;
    public $fecha_fin;
    public $mostrar_cuentas_sin_movimientos = false;

    public function mount($empresa_id = null)
    {
        $this->empresa_id = $empresa_id ?: optional(Empresa::first())->id;
        $this->fecha_inicio = now()->startOfMonth()->format('Y-m-d');
        $this->fecha_fin = now()->format('Y-m-d');
    }

    public function generarReporte()
    {
        if ($this->tipo_reporte === 'balanza') {
            return redirect()->route('reportes.balanza', [
                'empresa_id' => $this->empresa_id,
                'fecha_inicio' => $this->fecha_inicio,
                'fecha_fin' => $this->fecha_fin,
                'mostrar_sin_movimientos' => $this->mostrar_cuentas_sin_movimientos ? 1 : 0
            ]);
        } else {
            return redirect()->route('reportes.diario', [
                'empresa_id' => $this->empresa_id,
                'fecha_inicio' => $this->fecha_inicio,
                'fecha_fin' => $this->fecha_fin
            ]);
        }
    }

    public function render()
    {
        return view('livewire.reportes-view', [
            'empresas' => Empresa::all()
        ]);
    }
}
