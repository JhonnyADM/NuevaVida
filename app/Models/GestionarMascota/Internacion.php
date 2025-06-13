<?php

namespace App\Models\GestionarMascota;

use App\Models\GestionPersonal\Veterinario;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Internacion extends Model
{
   use HasFactory;
    protected $table = 'internacion';
    protected $fillable = [
        'fecha_ingreso',
        'fecha_salida',
        'detalles',
        'mascota_id',
        'veterinario_id',
    ];
    public function veterinario()
    {
        return $this->belongsTo(Veterinario::class, 'veterinario_id');
    }
    public function mascota()
    {
        return $this->belongsTo(Mascota::class, 'mascota_id');
    }
      public function control_internacion()
    {
        return $this->hasMany(ControlInternacion::class);
    }

}
