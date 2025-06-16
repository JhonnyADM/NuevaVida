<?php

namespace Database\Seeders;

use App\Models\GestionPersonal\Personal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Models\GestionUsuario\Usuario;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Crear los roles
        $roles = [
            'superadmin',
            'cliente',
            'pasante',
            'atencion',
            'voluntario',
            'veterinario'
        ];

        foreach ($roles as $rol) {
            Role::firstOrCreate(['name' => $rol]);
        }

        // Crear personal superadmin
        $personal = Personal::create([
            'nombre' => 'Carlos',
            'apellido' => 'Martínez',
            'telefono' => '1122334455',
            'tipo' => 'superadmin',
        ]);

        // Crear usuario superadmin
        $usuario = Usuario::create([
            'codigo' => '0001',
            'personal_id' => $personal->id,
            'password' => Hash::make('adm123456'),
            'estado' => true,
        ]);

        // Obtener el rol superadmin
        $superadminRole = Role::where('name', 'superadmin')->first();

        // Asignar rol superadmin al usuario
        $usuario->assignRole($superadminRole);

        // Asignar todos los permisos a superadmin
        $superadminRole->syncPermissions(Permission::all());
    }
}
