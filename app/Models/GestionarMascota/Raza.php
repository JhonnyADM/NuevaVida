<?php

namespace App\Models\GestionarMascota;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Raza extends Model
{
    use HasFactory;
    protected $table = 'raza';
    protected $fillable = ['descripcion'];

    public function mascotas()
    {
        return $this->hasMany(Mascota::class);
    }
}
