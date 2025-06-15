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
}
