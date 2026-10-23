<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Producto;

class Categoria extends Model{
    protected $table = 'categorias';

    protected $fillable = ['nom_categoria'];

    public function Producto(): HasMany{
        return $this->hasMany(Producto::class, 'id_categoria');
    }
}