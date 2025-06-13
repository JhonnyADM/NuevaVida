<?php

namespace App\Models\GestionCompraVenta;

use Illuminate\Database\Eloquent\Model;

class Provedor extends Model
{
    protected $table = 'provedor';
    protected $fillable = ['descripcion', 'email', 'telefono'];
    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'nota_ingreso')
            ->withPivot('cantidad', 'fecha', 'total')
            ->withTimestamps();
    }
}
