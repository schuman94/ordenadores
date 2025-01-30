<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ordenador>
 */
class OrdenadorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'codigo' => fake()->unique()->bothify('??###'),
            'marca' => fake()->word(),
            'modelo' => fake()->bothify('???-#'),
            'aula_id' => rand(1, 5), // Aula::first()->id
        ];
    }
}
