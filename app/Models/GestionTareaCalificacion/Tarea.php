<?php

namespace App\Models\GestionTareaCalificacion;

use App\Models\GestionarMascota\Estado;
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
}
