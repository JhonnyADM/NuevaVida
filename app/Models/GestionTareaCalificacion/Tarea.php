<?php

namespace App\Models\GestionTareaCalificacion;

use App\Models\GestionarMascota\Estado;
use App\Models\GestionPersonal\Pasante;
use App\Models\GestionPersonal\Voluntario;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    use HasFactory;
    protected $table = 'tarea';
    protected $fillable = [
        'descripcion',
        'fecha',
        'estado_id'
    ];
    public function estado()
    {
        return $this->belongsTo(Estado::class);
    }
    public function pasantes()
    {
        return $this->belongsToMany(Pasante::class, 'pasante_tarea');
    }

    public function voluntarios()
    {
        return $this->belongsToMany(Voluntario::class, 'tarea_voluntario');
    }
}
