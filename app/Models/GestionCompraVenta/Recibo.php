<?php

namespace App\Models\GestionCompraVenta;

use App\Models\GestionarMascota\Mascota;
use App\Models\GestionPersonal\Atencion;
use App\Models\GestionPersonal\Cliente;
use Illuminate\Database\Eloquent\Model;

class Recibo extends Model
{
    protected $table = 'recibo';
    protected $fillable = ['atencion_id', 'mascota_id', 'cliente_id', 'fecha','descripcion', 'total'];

    protected $casts = [
        'fecha' => 'date',
        'total' => 'float'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function mascota()
    {
        return $this->belongsTo(Mascota::class);
    }

    public function atencion()
    {
        return $this->belongsTo(Atencion::class);
    }

    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'detalle')
            ->withPivot('cantidad', 'subtotal')
            ->withTimestamps();
    }

    public function servicios()
    {
        return $this->belongsToMany(Servicio::class, 'solicitar_servicio')
            ->withTimestamps();
    }
}
