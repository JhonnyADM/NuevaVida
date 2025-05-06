<?php

namespace App\Models\GestionPersonal;

use Illuminate\Database\Eloquent\Model;

class Pasante extends Model
{
    protected $table = 'pasante';
    protected $fillable = ['estado', 'inicio','fin','personal_id'];

    public function personal()
    {
        return $this->belongsTo(Personal::class);
    }
}
