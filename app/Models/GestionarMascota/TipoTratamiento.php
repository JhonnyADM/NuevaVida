<?php

namespace App\Models\GestionarMascota;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoTratamiento extends Model
{
    use HasFactory;
    protected $table = 'tipo_tratamiento';
    protected $fillable = ['descripcion'];
    public function tratamientos()
    {
        return $this->hasMany(Tratamiento::class, 'tipo_tratamiento_id');
    }
}
