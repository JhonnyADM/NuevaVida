<?php

namespace App\Models\GestionUSuario;

use Spatie\Permission\Traits\HasRoles;
use App\Models\GestionPersonal\Personal;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use Notifiable;
     use HasRoles;
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
    public function getFullNameAttribute()
    {
        return $this->personal ? $this->personal->nombre . ' ' . $this->personal->apellido : $this->codigo;
    }
    // app/Models/Usuario.php

    public function getNameAttribute()
    {
        return $this->personal ? $this->personal->nombre . ' ' . $this->personal->apellido : $this->codigo;
    }
    public function adminlte_desc()
    {
        return $this->personal ? ucfirst($this->personal->tipo) : 'Sin tipo';
    }
    public function adminlte_name()
    {
        return $this->personal ? $this->personal->nombre . ' ' . $this->personal->apellido : $this->codigo;
    }
    public function adminlte_profile_url()
    {
        return route('usuario.configuracion'); // Usa el nombre de la ruta a configuración
    }
}
