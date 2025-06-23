<?php

namespace App\Models\GestionPersonal;

use App\Models\GestionTareaCalificacion\Tarea;
use Illuminate\Database\Eloquent\Model;

class Pasante extends Model
{
    protected $table = 'pasante';
    protected $fillable = ['estado', 'inicio', 'fin', 'personal_id'];

    public function personal()
    {
        return $this->belongsTo(Personal::class);
    }
    public function tareas()
    {
        return $this->belongsToMany(Tarea::class, 'pasante_tarea');
    }
}
