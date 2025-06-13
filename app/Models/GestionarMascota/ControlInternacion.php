<?php

namespace App\Models\GestionarMascota;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ControlInternacion extends Model
{
   use HasFactory;
    protected $table = 'control_internacion';
    protected $fillable = [
        'fecha',
        'detalle',
        'internacion_id',
        'estado_id',
    ];
    public function Internacion()
    {
        return $this->belongsTo(Internacion::class, 'internacion_id');
    }
    public function Estado()
    {
        return $this->belongsTo(Estado::class, 'estado_id');
    }
}
