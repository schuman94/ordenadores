<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Dispositivo>
 */
class DispositivoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'codigo' => fake()->unique()->bothify('DISP-??-####'),
            'nombre' => fake()->word(),
            'colocable_id' => rand(1, 5),
            'colocable_type' => fake()->randomElement([
                'App\Models\Ordenador',
                'App\Models\Aula'
            ]),
        ];
    }
}
