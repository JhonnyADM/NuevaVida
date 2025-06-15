<?php

namespace App\Models\GestionCompraVenta;

use App\Models\GestionarMascota\Mascota;
use App\Models\GestionPersonal\Cliente;
use Illuminate\Database\Eloquent\Model;

class SolicitarServicio extends Model
{
    protected $table = 'solicitar_servicio';
    protected $fillable = ['recibo_id', 'servicio_id'];

    public function recibo()
    {
        return $this->belongsTo(Recibo::class);
    }

    public function servicio()
    {
        return $this->belongsTo(Servicio::class);
    }
}
