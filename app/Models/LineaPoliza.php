<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LineaPoliza extends Model
{
    use HasFactory;

    protected $table = 'lineas_polizas';
    
    protected $fillable = [
        'contenedor_poliza_id', 
        'cuenta_id', 
        'descripcion', 
        'cargo', 
        'abono'
    ];

    public function contenedorPoliza()
    {
        return $this->belongsTo(ContenedorPoliza::class, 'contenedor_poliza_id');
    }

    public function cuenta()
    {
        return $this->belongsTo(Cuenta::class);
    }
    
    // Cuando se crea o actualiza una línea, actualizar los totales del contenedor
    protected static function booted()
    {
        static::created(function ($lineaPoliza) {
            $lineaPoliza->contenedorPoliza->actualizarTotales();
        });
        
        static::updated(function ($lineaPoliza) {
            $lineaPoliza->contenedorPoliza->actualizarTotales();
        });
        
        static::deleted(function ($lineaPoliza) {
            $lineaPoliza->contenedorPoliza->actualizarTotales();
        });
    }
}
