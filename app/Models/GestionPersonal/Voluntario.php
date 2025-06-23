<?php

namespace App\Models\GestionPersonal;

use App\Models\GestionTareaCalificacion\Tarea;
use Illuminate\Database\Eloquent\Model;

class Voluntario extends Model
{
    protected $table = 'voluntario';
    protected $fillable = ['estado', 'direccion', 'edad', 'personal_id'];

    public function personal()
    {
        return $this->belongsTo(Personal::class);
    }
    public function tareas()
    {
        return $this->belongsToMany(Tarea::class, 'tarea_voluntario');
    }
}
