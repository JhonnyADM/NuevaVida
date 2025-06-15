<?php

namespace App\Models\GestionCompraVenta;

use App\Models\GestionPersonal\Cliente;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    protected $table = 'servicio';
    protected $fillable = ['nombre', 'descripcion', 'precio'];

    protected $casts = [
        'precio' => 'float',
    ];

    public function recibos()
    {
        return $this->belongsToMany(Recibo::class, 'solicitar_servicio')
            ->withTimestamps();
    }
}
