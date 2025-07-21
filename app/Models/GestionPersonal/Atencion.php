<?php

namespace App\Models\GestionPersonal;

use App\Models\GestionCompraVenta\Recibo;
use Illuminate\Database\Eloquent\Model;

class Atencion extends Model
{
    protected $table = 'atencion';
    protected $fillable = ['cargo', 'personal_id', 'email'];

    public function personal()
    {
        return $this->belongsTo(Personal::class);
    }

    public function recibos()
    {
        return $this->hasMany(Recibo::class);
    }
    public function areas()
    {
        return $this->belongsToMany(Area::class, 'area_personal_turno')
            ->withPivot('turno_id')
            ->withTimestamps();
    }

    public function turnos()
    {
        return $this->belongsToMany(Turno::class, 'area_personal_turno')
            ->withPivot('area_id')
            ->withTimestamps();
    }
}
