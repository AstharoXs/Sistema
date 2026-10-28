<?php

namespace App\Models;

use App\Models\Producto;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model{
    protected $table = 'categorias';

    protected $fillable = ['nom_categoria'];

    public function Producto(): HasMany{
        return $this->hasMany(Producto::class, 'id_categoria');
    }
}