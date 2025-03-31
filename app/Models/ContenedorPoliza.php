<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContenedorPoliza extends Model
{
    use HasFactory;

    protected $table = 'contenedores_polizas';
    
    protected $fillable = [
        'empresa_id', 
        'tipo_poliza_id', 
        'descripcion', 
        'fecha', 
        'total_cargos', 
        'total_abonos', 
        'finalizado'
    ];
    
    protected $casts = [
        'fecha' => 'date',
        'finalizado' => 'boolean',
    ];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    public function tipoPoliza()
    {
        return $this->belongsTo(TipoPoliza::class);
    }

    public function lineasPolizas()
    {
        return $this->hasMany(LineaPoliza::class, 'contenedor_poliza_id');
    }

    // Método para verificar si los totales están balanceados
    public function estanTotalesBalanceados()
    {
        return $this->total_cargos == $this->total_abonos;
    }

    // Método para calcular y actualizar totales desde las líneas
    public function actualizarTotales()
    {
        $this->total_cargos = $this->lineasPolizas->sum('cargo');
        $this->total_abonos = $this->lineasPolizas->sum('abono');
        $this->save();
        
        return $this->estanTotalesBalanceados();
    }
    
    // Método para finalizar el contenedor si los totales están balanceados
    public function finalizar()
    {
        if ($this->estanTotalesBalanceados()) {
            $this->finalizado = true;
            $this->save();
            
            // Procesar cada línea para actualizar los saldos de las cuentas
            foreach ($this->lineasPolizas as $linea) {
                $cuenta = $linea->cuenta;
                $cuenta->actualizarSaldo($linea->cargo, $linea->abono);
            }
            
            return true;
        }
        
        return false;
    }
}
