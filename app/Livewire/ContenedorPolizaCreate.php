<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ContenedorPoliza;
use App\Models\LineaPoliza;
use App\Models\TipoPoliza;
use App\Models\Cuenta;
use Illuminate\Support\Collection;

class ContenedorPolizaCreate extends Component
{
    public $empresa_id;
    public $tipo_poliza_id;
    public $descripcion;
    public $fecha;
    
    public $cuentasDisponibles = [];
    public $totalCargos = 0;
    public $totalAbonos = 0;
    
    // Para la nueva línea
    public $cuenta_id;
    public $lineaDescripcion;
    public $cargo;
    public $abono;
    
    // Colección de líneas temporales
    public Collection $lineas;
    
    protected $rules = [
        'tipo_poliza_id' => 'required|exists:tipos_polizas,id',
        'descripcion' => 'required|string|max:255',
        'fecha' => 'required|date',
    ];
    
    protected $messages = [
        'tipo_poliza_id.required' => 'Debe seleccionar un tipo de póliza.',
        'descripcion.required' => 'La descripción es obligatoria.',
        'fecha.required' => 'La fecha es obligatoria.',
    ];

    public function mount($empresa_id)
    {
        $this->empresa_id = $empresa_id;
        $this->fecha = now()->format('Y-m-d');
        $this->lineas = collect([]);
        $this->cargarCuentas();
    }
    
    public function cargarCuentas()
    {
        $this->cuentasDisponibles = Cuenta::where('empresa_id', $this->empresa_id)
            ->where('tipo', 'detalle')
            ->orderBy('numero')
            ->get();
    }
    
    public function agregarLinea()
    {
        $this->validate([
            'cuenta_id' => 'required|exists:cuentas,id',
            'lineaDescripcion' => 'nullable|string',
            'cargo' => 'required_without:abono|numeric|min:0',
            'abono' => 'required_without:cargo|numeric|min:0',
        ]);
        
        // Verificar que no se tenga cargo y abono a la vez
        if ($this->cargo > 0 && $this->abono > 0) {
            session()->flash('error', 'Una línea no puede tener cargo y abono simultáneamente.');
            return;
        }
        
        // Agregar línea a la colección temporal
        $cuenta = Cuenta::find($this->cuenta_id);
        $this->lineas->push([
            'cuenta_id' => $this->cuenta_id,
            'cuenta_numero' => $cuenta->numero,
            'cuenta_nombre' => $cuenta->nombre,
            'descripcion' => $this->lineaDescripcion,
            'cargo' => $this->cargo ?: 0,
            'abono' => $this->abono ?: 0,
        ]);
        
        // Actualizar totales
        $this->totalCargos += $this->cargo ?: 0;
        $this->totalAbonos += $this->abono ?: 0;
        
        // Limpiar campos
        $this->cuenta_id = '';
        $this->lineaDescripcion = '';
        $this->cargo = '';
        $this->abono = '';
    }
    
    public function actualizarLinea($index)
    {
        if (!isset($this->lineas[$index])) {
            return;
        }
        
        $linea = $this->lineas[$index];
        
        // Verificar que no se tenga cargo y abono a la vez
        if ($linea['cargo'] > 0 && $linea['abono'] > 0) {
            session()->flash('error', 'Una línea no puede tener cargo y abono simultáneamente.');
            return;
        }
        
        // Recalcular totales
        $this->recalcularTotales();
        
        session()->flash('success', 'Línea actualizada correctamente.');
    }
    
    public function recalcularTotales()
    {
        $this->totalCargos = 0;
        $this->totalAbonos = 0;
        
        foreach ($this->lineas as $linea) {
            $this->totalCargos += floatval($linea['cargo']);
            $this->totalAbonos += floatval($linea['abono']);
        }
    }
    
    public function quitarLinea($index)
    {
        if (isset($this->lineas[$index])) {
            $this->lineas->forget($index);
            $this->recalcularTotales();
        }
    }
    
    public function guardarContenedor()
    {
        $this->validate();
        
        if ($this->lineas->isEmpty()) {
            session()->flash('error', 'Debe agregar al menos una línea al contenedor.');
            return;
        }
        
        if ($this->totalCargos != $this->totalAbonos) {
            session()->flash('error', 'Los totales de cargos y abonos deben ser iguales para guardar el contenedor.');
            return;
        }
        
        // Crear el contenedor
        $contenedor = ContenedorPoliza::create([
            'empresa_id' => $this->empresa_id,
            'tipo_poliza_id' => $this->tipo_poliza_id,
            'descripcion' => $this->descripcion,
            'fecha' => $this->fecha,
            'total_cargos' => $this->totalCargos,
            'total_abonos' => $this->totalAbonos,
            'finalizado' => true,
        ]);
        
        // Crear las líneas
        foreach ($this->lineas as $linea) {
            $lineaPoliza = LineaPoliza::create([
                'contenedor_poliza_id' => $contenedor->id,
                'cuenta_id' => $linea['cuenta_id'],
                'descripcion' => $linea['descripcion'],
                'cargo' => $linea['cargo'],
                'abono' => $linea['abono'],
            ]);
            
            // Actualizar saldo de la cuenta
            $cuenta = Cuenta::find($linea['cuenta_id']);
            $cuenta->actualizarSaldo($linea['cargo'], $linea['abono']);
        }
        
        session()->flash('success', 'Contenedor de pólizas creado con éxito.');
        return redirect()->route('contenedores-polizas.view', ['empresa_id' => $this->empresa_id]);
    }

    public function render()
    {
        return view('livewire.contenedor-poliza-create', [
            'tiposPolizas' => TipoPoliza::where('empresa_id', $this->empresa_id)->get(),
        ]);
    }
}
