<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoPoliza extends Model
{
    use HasFactory;

    protected $table = 'tipos_polizas'; // Asegúrate de que el nombre coincida exactamente con el de la base de datos
    protected $fillable = ['empresa_id', 'tipo', 'descripcion'];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }
}
