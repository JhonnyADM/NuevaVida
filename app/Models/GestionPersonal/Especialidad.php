<?php

namespace App\Models\GestionPersonal;

use Illuminate\Database\Eloquent\Model;

class Especialidad extends Model
{
   protected $table = 'especialidad';

    protected $fillable = ['descripcion'];

    public function veterinarios()
    {
        return $this->belongsToMany(Veterinario::class, 'veterinario_especialidads', 'especialidad_id', 'veterinario_id');
    }
}
