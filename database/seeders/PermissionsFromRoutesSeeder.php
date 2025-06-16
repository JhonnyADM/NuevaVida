<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;
class PermissionsFromRoutesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Obtenemos todas las rutas con nombre definido
        $routes = collect(Route::getRoutes())
            ->map(fn($route) => $route->getName())
            ->filter() // elimina rutas sin nombre
            ->unique();

        foreach ($routes as $name) {
            // Creamos el permiso solo si no existe
            Permission::firstOrCreate(['name' => $name]);
        }

        $this->command->info('Permisos creados desde las rutas con nombre.');
    }
}
