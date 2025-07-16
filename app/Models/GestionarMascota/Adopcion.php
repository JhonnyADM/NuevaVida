<?php

namespace App\Models\GestionarMascota;

use App\Models\GestionPersonal\Cliente;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adopcion extends Model
{
    use HasFactory;
    protected $table = 'adopcion';
    protected $fillable = [
        'fecha_adopcion',
        'mascota_id',
        'observaciones',
        'cliente_id'
    ];
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function mascota()
    {
        return $this->belongsTo(Mascota::class);
    }
}
