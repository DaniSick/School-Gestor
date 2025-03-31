<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuenta extends Model
{
    use HasFactory;

    protected $fillable = ['empresa_id'];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }
}
