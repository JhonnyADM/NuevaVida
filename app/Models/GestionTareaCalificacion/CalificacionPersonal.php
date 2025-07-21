<?php

namespace App\Models\GestionTareacalificacion;

use App\Models\GestionPersonal\Cliente;
use App\Models\GestionPersonal\Personal;
use Illuminate\Database\Eloquent\Model;

class CalificacionPersonal extends Model
{
    protected $table = 'calificacion_personal';

    protected $fillable = ['cliente_id', 'personal_id', 'valor', 'comentario'];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function personal()
    {
        return $this->belongsTo(Personal::class);
    }
}
