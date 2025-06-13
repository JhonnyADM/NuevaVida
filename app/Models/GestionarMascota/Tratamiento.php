<?php

namespace App\Models\GestionarMascota;

use App\Models\GestionPersonal\Veterinario;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tratamiento extends Model
{
    use HasFactory;
    protected $table = 'tratamiento';
    protected $fillable = [
        'fecha',
        'detalles',
        'mascota_id',
        'tipo_tratamiento_id',
        'veterinario_id',
    ];
    public function tipoTratamiento()
    {
        return $this->belongsTo(TipoTratamiento::class, 'tipo_tratamiento_id');
    }
    public function veterinario()
    {
        return $this->belongsTo(Veterinario::class, 'veterinario_id');
    }
    public function mascota()
    {
        return $this->belongsTo(Mascota::class, 'mascota_id');
    }
    public function controles()
    {
        return $this->hasMany(Control::class);
    }
}
