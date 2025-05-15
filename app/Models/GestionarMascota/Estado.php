<?php

namespace App\Models\GestionarMascota;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
   use HasFactory;
    protected $table = 'estado';
    protected $fillable = [
        'descripcion'
    ];
}
 
