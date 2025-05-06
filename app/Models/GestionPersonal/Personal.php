<?php

namespace App\Models\GestionPersonal;

use App\Models\GestionUSuario\Usuario;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
    use HasFactory;
    protected $table = 'personal';
    protected $fillable = [
        'nombre',
        'apellido',
        'telefono',
        'tipo',
    ];
    public function veterinario()
    {
        return $this->hasOne(Veterinario::class);
    }
    public function atencion()
    {
        return $this->hasOne(Atencion::class);
    }

    public function cliente()
    {
        return $this->hasOne(Cliente::class);
    }

    public function pasante()
    {
        return $this->hasOne(Pasante::class);
    }

    public function voluntario()
    {
        return $this->hasOne(Voluntario::class);
    }
    public function usuario()
    {
        return $this->hasOne(Usuario::class);
    }
}
