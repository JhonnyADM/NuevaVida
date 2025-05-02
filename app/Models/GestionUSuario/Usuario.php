<?php

namespace App\Models\GestionUSuario;

use App\Models\GestionPersonal\Personal;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;
    protected $table = 'usuario';
    protected $fillable = ['codigo', 'personal_id', 'password', 'estado'];
    public function personal()
    {
        return $this->belongsTo(Personal::class);
    }
}
