<?php

namespace App\Models\GestionPersonal;

use Illuminate\Database\Eloquent\Model;

class AreaPersonalTurno extends Model
{
    protected $table = 'area_personal_turno';
    protected $fillable = ['personal_id', 'area_id', 'turno_id'];

    public function personal()
    {
        return $this->belongsTo(Personal::class);
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function turno()
    {
        return $this->belongsTo(Turno::class);
    }
}
