<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuenta extends Model
{
    use HasFactory;

    protected $fillable = ['empresa_id', 'parent_id', 'numero', 'nombre', 'tipo', 'fondo'];

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
}
