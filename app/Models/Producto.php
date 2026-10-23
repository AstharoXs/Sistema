<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Categoria;

class Producto extends Model{
    
    public function Categoria(): BelongsTo{
        return $this->belongsTo(Categoria::class, 'id_categoria');  
    }
}