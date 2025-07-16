<?php

namespace App\Models\GestionPersonal;

use App\Models\GestionarMascota\Adopcion;
use App\Models\GestionarMascota\Mascota;
use App\Models\GestionCompraVenta\Recibo;
use App\Models\GestionCompraVenta\Servicio;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'cliente';
    protected $fillable = ['celular', 'direccion', 'personal_id'];

    public function personal()
    {
        return $this->belongsTo(Personal::class);
    }

    public function mascotas()
    {
        return $this->hasMany(Mascota::class);
    }

    public function recibos()
    {
        return $this->hasMany(Recibo::class);
    }
    public function servicios()
    {
        return $this->belongsToMany(Servicio::class, 'calificacion')
            ->withPivot('valor')
            ->withTimestamps();
    }
    public function adopciones()
    {
        return $this->hasMany(Adopcion::class);
    }
}
