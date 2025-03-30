<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'razon_social',
        'rfc',
        'direccion',
        'telefono',
        'email',
        'representante_legal',
        'fecha_creacion',
        'estatus',
    ];
}
