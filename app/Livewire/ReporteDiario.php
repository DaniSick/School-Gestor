<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Empresa;
use App\Models\ContenedorPoliza;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class ReporteDiario extends Component
{
    public $empresa_id;
    public $fecha_inicio;
    public $fecha_fin;
    public $empresa;
    public $contenedores;

    public function mount($empresa_id, $fecha_inicio, $fecha_fin)
    {
        $this->empresa_id = $empresa_id;
        $this->fecha_inicio = $fecha_inicio;
        $this->fecha_fin = $fecha_fin;
        
        $this->empresa = Empresa::findOrFail($empresa_id);
        
        // Obtener todos los contenedores de pólizas en el periodo
        $this->contenedores = ContenedorPoliza::where('empresa_id', $this->empresa_id)
            ->whereBetween('fecha', [$this->fecha_inicio, $this->fecha_fin])
            ->where('finalizado', true)
            ->with(['tipoPoliza', 'lineasPolizas.cuenta'])
            ->orderBy('fecha')
            ->get();
    }
    
    public function descargarPDF()
    {
        $data = [
            'empresa' => $this->empresa,
            'contenedores' => $this->contenedores,
            'fecha_inicio' => Carbon::parse($this->fecha_inicio)->format('d/m/Y'),
            'fecha_fin' => Carbon::parse($this->fecha_fin)->format('d/m/Y'),
            'fecha_generacion' => now()->format('d/m/Y H:i:s')
        ];
        
        $pdf = PDF::loadView('reportes.diario-pdf', $data);
        return response()->streamDownload(
            fn () => print($pdf->output()),
            "libro_diario_{$this->empresa->id}_{$this->fecha_inicio}_{$this->fecha_fin}.pdf"
        );
    }

    public function render()
    {
        return view('livewire.reporte-diario', [
            'empresa' => $this->empresa,
            'contenedores' => $this->contenedores
        ]);
    }
}
