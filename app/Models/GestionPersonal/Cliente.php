<?php

namespace App\Models\GestionPersonal;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model

{
    protected $table = 'cliente';
    protected $fillable = ['celular', 'direccion','personal_id'];

    public function personal()
    {
        return $this->belongsTo(Personal::class);
    }
}
