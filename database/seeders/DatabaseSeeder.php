<?php

namespace Database\Seeders;

use App\Models\GestionPersonal\Personal;
use App\Models\GestionUSuario\Usuario;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $personal = Personal::create([
            'nombre' => 'Carlos',
            'apellido' => 'Martínez',
            'telefono' => '1122334455',
            'tipo' => 'superadmin',
        ]);

        // Crear un registro de Usuario relacionado con el Personal creado
        Usuario::create([
            'codigo' => 'ADM001',
            'personal_id' => $personal->id,  // Asociamos al Personal creado
            'password' => Hash::make('adm123456'),  // Encriptamos el password
            'estado' => true,  // Estado del usuario
        ]);
    }
}
