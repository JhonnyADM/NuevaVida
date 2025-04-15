<?php

namespace App\Models\GestionPersonal;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = ['celular', 'direcccion','personal_id'];

    public function personal()
    {
        return $this->belongsTo(Personal::class);
    }
}
