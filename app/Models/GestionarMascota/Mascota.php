<?php

namespace App\Models\GestionarMascota;

use App\Models\GestionPersonal\Cliente;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mascota extends Model
{
    use HasFactory;
    protected $table = 'mascota';
    protected $fillable = [
        'nombre', 'color', 'descripcion', 'edad',
        'fecha_nacimiento', 'peso', 'raza_id', 'cliente_id'
    ];

    public function raza()
    {
        return $this->belongsTo(Raza::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }


}
