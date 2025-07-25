<?php

namespace App\Models\GestionPersonal;

use App\Models\GestionarMascota\Tratamiento;
use Illuminate\Database\Eloquent\Model;

class Veterinario extends Model
{
    protected $table = 'veterinario';
    protected $fillable = ['profesion', 'personal_id', 'email'];

    public function personal()
    {
        return $this->belongsTo(Personal::class);
    }
     public function especialidades()
    {
        return $this->belongsToMany(Especialidad::class, 'veterinario_especialidads', 'veterinario_id', 'especialidad_id');
    }
     public function tratamientos()
    {
        return $this->hasMany(Tratamiento::class, 'veterinario_id');
    }

}
