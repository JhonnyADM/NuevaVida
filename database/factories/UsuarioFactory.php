<?php

namespace Database\Factories;

use App\Models\GestionPersonal\Personal;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GestionUSuario\Usuario>
 */
class UsuarioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'codigo' => $this->faker->unique()->userName,
            'personal_id' => Personal::factory(), // Crea un personal automáticamente
            'password' => Hash::make('password'), // o Hash::make('password')
            'estado' => true,
        ];
    }
}
