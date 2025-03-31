<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuenta extends Model
{
    use HasFactory;

    protected $fillable = ['empresa_id', 'parent_id', 'numero', 'nombre', 'tipo', 'haber', 'cargo'];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    public function parent()
    {
        return $this->belongsTo(Cuenta::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Cuenta::class, 'parent_id');
    }

    public function lineasPolizas()
    {
        return $this->hasMany(LineaPoliza::class);
    }

    // Método para actualizar saldos de la cuenta basado en una línea de póliza
    public function actualizarSaldo($cargo, $abono)
    {
        $this->cargo += $cargo;
        $this->haber += $abono;
        $this->save();
        
        // Si tiene padre, actualizar también el saldo del padre
        if ($this->parent_id) {
            $this->parent->actualizarSaldo($cargo, $abono);
        }
    }
}
