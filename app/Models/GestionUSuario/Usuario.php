<?php

namespace App\Models\GestionUSuario;

use App\Models\GestionPersonal\Personal;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use Notifiable;
    protected $table = 'usuario';
    protected $fillable = ['codigo', 'personal_id', 'password', 'estado'];
    public function personal()
    {
        return $this->belongsTo(Personal::class);
    }
     // Cambiar el campo por defecto 'email' por 'codigo'
     public function getAuthIdentifierName()
     {
         return 'codigo';  // Utilizamos el campo 'codigo' como el identificador
     }

     // Asegurarnos de que el campo 'password' se sigue utilizando correctamente
     public function getAuthPassword()
     {
         return $this->password;
     }

     // Si utilizas "remember_token", debes agregar estas funciones
     public function getRememberToken()
     {
         return $this->remember_token;
     }

     public function setRememberToken($value)
     {
         $this->remember_token = $value;
     }

     public function getRememberTokenName()
     {
         return 'remember_token';
     }
}
