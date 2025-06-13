<?php

namespace App\Models\GestionarMascota;

use App\Models\GestionTareaCalificacion\Tarea;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    use HasFactory;
    protected $table = 'estado';
    protected $fillable = [
        'descripcion'
    ];
    public function tareas()
    {
        return $this->hasMany(Tarea::class);
    }
     public function controles()
    {
        return $this->hasMany(Control::class);
    }
}
