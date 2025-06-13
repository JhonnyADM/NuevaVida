<?php

namespace App\Models\GestionarMascota;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Control extends Model
{
    use HasFactory;
    protected $table = 'control';
    protected $fillable = [
        'fecha',
        'observacion',
        'tratamiento_id',
        'estado_id',
    ];
    public function Tratamiento()
    {
        return $this->belongsTo(Tratamiento::class, 'tratamiento_id');
    }
    public function Estado()
    {
        return $this->belongsTo(Estado::class, 'estado_id');
    }
}
