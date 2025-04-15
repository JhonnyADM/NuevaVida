<?php

namespace App\Models\GestionPersonal;

use Illuminate\Database\Eloquent\Model;

class Veterinario extends Model
{
    protected $fillable = ['profesion', 'personal_id','email'];

    public function personal()
    {
        return $this->belongsTo(Personal::class);
    }
}
