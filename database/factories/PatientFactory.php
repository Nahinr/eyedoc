<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patient>
 */
class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre_completo' => $this->faker->name(),
            'fecha_nacimiento' => $this->faker->date(),
            'identidad' => $this->faker->unique()->numerify('###########'),
            'edad' => $this->faker->numberBetween(1, 100),
            'telefono' => $this->faker->phoneNumber(),
        ];
    }
}
