<?php

namespace App\Models\GestionPersonal;

use Illuminate\Database\Eloquent\Model;

class Voluntario extends Model
{
    protected $table = 'voluntario';
    protected $fillable = ['estado', 'direccion','edad','personal_id'];

    public function personal()
    {
        return $this->belongsTo(Personal::class);
    }
}
