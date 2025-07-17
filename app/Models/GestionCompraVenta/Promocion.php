<?php

namespace App\Models\GestionCompraVenta;

use Illuminate\Database\Eloquent\Model;

class Promocion extends Model
{
     protected $table = 'promocion';
    protected $fillable = [
        'nombre',
        'detsalle',
        'fecha_inicio',
        'fecha_fin', 'estado',
        'descuento',
        'total_a_pagar'];


    public function servicios()
    {
        return $this->belongsToMany(Servicio::class, 'promocion_servicio');
    }
}
