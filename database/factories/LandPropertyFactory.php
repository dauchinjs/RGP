<?php

namespace Database\Factories;

use App\Models\People;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LandProperty>
 */
class LandPropertyFactory extends Factory
{
    public function definition(): array
    {
        return [
            'people_id' => People::all()->random()->id,
            'name' => fake()->streetName(),
            'cadastre_number' => fake()->numberBetween(10000000000, 99999999999),
            'status' => fake()->randomElement(['Ir pirkšanas līgums', 'Apmaksāts', 'Reģistrēts zemes grāmatā', 'Pārdots']),
        ];
    }
}
