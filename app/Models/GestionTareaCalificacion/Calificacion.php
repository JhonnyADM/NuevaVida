<?php

namespace App\Models\GestionTareaCalificacion;

use App\Models\GestionCompraVenta\Servicio;
use App\Models\GestionPersonal\Cliente;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calificacion extends Model
{
    use HasFactory;
    protected $table = 'calificacion';
    protected $fillable =[
        'valor',
        'comentario',
        'cliente_id',
        'servicio_id'

    ];
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function servicio()
    {
        return $this->belongsTo(Servicio::class);
    }
}
