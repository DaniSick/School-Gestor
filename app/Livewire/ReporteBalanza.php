<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Empresa;
use App\Models\Cuenta;
use App\Models\ContenedorPoliza;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class ReporteBalanza extends Component
{
    public $empresa_id;
    public $fecha_inicio;
    public $fecha_fin;
    public $mostrar_sin_movimientos;
    public $empresa;
    public $cuentas;

    public function mount($empresa_id, $fecha_inicio, $fecha_fin, $mostrar_sin_movimientos = 0)
    {
        $this->empresa_id = $empresa_id;
        $this->fecha_inicio = $fecha_inicio;
        $this->fecha_fin = $fecha_fin;
        $this->mostrar_sin_movimientos = $mostrar_sin_movimientos;
        
        $this->empresa = Empresa::findOrFail($empresa_id);
        
        // Cargar cuentas y calcular sus saldos
        $this->cargarCuentas();
    }
    
    protected function cargarCuentas()
    {
        // Consultar todas las cuentas de la empresa
        $query = Cuenta::where('empresa_id', $this->empresa_id)
                       ->where('tipo', 'detalle')
                       ->orderBy('numero');
        
        // Si no se deben mostrar cuentas sin movimientos, filtrar solo aquellas con movimientos
        if (!$this->mostrar_sin_movimientos) {
            $query->where(function($q) {
                $q->where('cargo', '>', 0)
                  ->orWhere('haber', '>', 0);
            });
        }
        
        $this->cuentas = $query->get();
        
        // Calcular saldos para el periodo seleccionado
        $this->calcularSaldos();
    }
    
    public function calcularSaldos()
    {
        $fechaInicio = Carbon::parse($this->fecha_inicio);
        $fechaFin = Carbon::parse($this->fecha_fin);
        
        foreach ($this->cuentas as $cuenta) {
            // Obtener movimientos de la cuenta en el período
            $movimientos = $cuenta->lineasPolizas()
                ->whereHas('contenedorPoliza', function($q) use ($fechaInicio, $fechaFin) {
                    $q->whereBetween('fecha', [$fechaInicio, $fechaFin])
                      ->where('finalizado', true);
                })
                ->get();
            
            // Calcular totales
            $cuenta->total_cargo_periodo = $movimientos->sum('cargo');
            $cuenta->total_abono_periodo = $movimientos->sum('abono');
            $cuenta->saldo_actual = $cuenta->cargo - $cuenta->haber;
        }
    }
    
    public function descargarPDF()
    {
        // Recargar los datos para asegurar cálculos correctos
        $this->cargarCuentas();
        
        // Preparar datos para la vista PDF
        $cuentasPreparadas = $this->cuentas->map(function($cuenta) {
            return [
                'numero' => $cuenta->numero,
                'nombre' => $cuenta->nombre,
                'total_cargo_periodo' => $cuenta->total_cargo_periodo,
                'total_abono_periodo' => $cuenta->total_abono_periodo,
                'saldo_actual' => $cuenta->saldo_actual
            ];
        });
        
        $data = [
            'empresa' => $this->empresa,
            'cuentas' => $cuentasPreparadas,
            'fecha_inicio' => Carbon::parse($this->fecha_inicio)->format('d/m/Y'),
            'fecha_fin' => Carbon::parse($this->fecha_fin)->format('d/m/Y'),
            'fecha_generacion' => now()->format('d/m/Y H:i:s')
        ];
        
        $pdf = PDF::loadView('reportes.balanza-pdf', $data);
        return response()->streamDownload(
            fn () => print($pdf->output()),
            "balanza_general_{$this->empresa->id}_{$this->fecha_inicio}_{$this->fecha_fin}.pdf"
        );
    }

    public function render()
    {
        return view('livewire.reporte-balanza', [
            'empresa' => $this->empresa,
            'cuentas' => $this->cuentas
        ]);
    }
}
