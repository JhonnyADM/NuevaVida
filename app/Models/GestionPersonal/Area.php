<?php

namespace App\Models\GestionPersonal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;
    protected $table = 'area';
    protected $fillable = [
        'descripcion',
        'nombre'
    ];
    public function personales()
    {
        return $this->belongsToMany(Personal::class, 'area_personal_turno')
            ->withPivot('turno_id')
            ->withTimestamps();
    }
}
