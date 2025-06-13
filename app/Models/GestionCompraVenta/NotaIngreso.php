<?php

namespace App\Models\GestionCompraVenta;

use Illuminate\Database\Eloquent\Model;

class NotaIngreso extends Model
{
    protected $table = 'nota_ingreso';

    protected $fillable = [
        'producto_id',
        'provedor_id',
        'cantidad',
        'fecha',
        'total',
    ];
    protected $casts = [
        'fecha' => 'date',
    ];

    // Relaciones

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }

    public function provedor()
    {
        return $this->belongsTo(Provedor::class, 'provedor_id');
    }

}
