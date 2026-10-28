<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MovimientosInventario extends Model
{
    protected $table = 'movimientos_inventario';

    protected $fillable = [
        'id_producto',
        'usuario_id',
        'tipo',
        'cantidad',
        'observacion',
    ];

    public function producto(): BelongsTo
    {
        return $this->belongsTo(Producto::class, 'id_producto');
    }

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}
