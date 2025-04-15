<?php

namespace App\Models\GestionUSuario;

use App\Models\GestionPersonal\Personal;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $fillable = ['codigo', 'personal_id','passwor'];
    public function personal()
    {
        return $this->belongsTo(Personal::class);
    }
}
