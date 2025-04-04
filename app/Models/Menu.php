<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'parent_id', 'ruta'];

    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id');
    }
}
