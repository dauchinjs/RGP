<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\People>
 */
class PeopleFactory extends Factory
{
    public function definition()
    {
        $type = fake()->randomElement(['fiziska', 'juridiska']);

        $personalCode = $type === 'fiziska'
            ? fake()->dateTimeBetween('-80 years', '-18 years')->format('dmy') . '-' . fake()->numberBetween(10000, 99999)
            : fake()->numberBetween(10000000000, 99999999999);

        return [
            'name' => fake()->firstName(),
            'surname' => fake()->lastName(),
            'title' => $type === 'juridiska' ? fake()->company() : null,
            'personal_code' => $personalCode,
            'type' => $type,
        ];
    }
}
