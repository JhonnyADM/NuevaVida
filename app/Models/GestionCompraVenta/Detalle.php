<?php

namespace App\Models\GestionCompraVenta;

use Illuminate\Database\Eloquent\Model;

class Detalle extends Model
{
    protected $table = 'detalle';
    protected $fillable = ['recibo_id', 'producto_id', 'cantidad', 'subtotal'];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    public function recibo()
    {
        return $this->belongsTo(Recibo::class);
    }
}
