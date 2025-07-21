<?php

namespace App\Models\GestionPersonal;

use Illuminate\Database\Eloquent\Model;

class Turno extends Model
{
    protected $table = 'turnos';
    protected $fillable = ['nombre', 'hora_inicio', 'hora_fin'];

    protected $casts = [
        'hora_inicio' => 'datetime:H:i:s',
        'hora_fin' => 'datetime:H:i:s',
    ];
    public function personales()
    {
        return $this->belongsToMany(Personal::class, 'area_personal_turno')
            ->withPivot('area_id')
            ->withTimestamps();
    }
}
