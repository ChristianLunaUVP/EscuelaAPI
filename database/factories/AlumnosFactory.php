<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Alumnos>
 */
class AlumnosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'matricula' => $this->faker->unique()->randomNumber(8),
            'nombre' => $this->faker->name,
            'carrera_id' => $this->faker->numberBetween(1,6),
            'semestre' => $this->faker->numberBetween(1, 10),
            'imagen' => $this->faker->imageUrl(640, 480, 'people', true)
        ];
    }
}
