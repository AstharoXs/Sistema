<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Categoria;

class Producto extends Model{
    
    public function Categoria(): BelongsTo{
        return $this->belongsTo(Categoria::class, 'id_categoria');  
    }

    protected $fillable = [
        'nom_producto',
        'detalle_producto',
        'cant_producto',
        'valor_producto',
        'foto_producto',
        'estado_producto',
        'id_categoria',
    ];
}