<?php

namespace Database\Factories;

use App\Models\LandProperty;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LandPropertyInfo>
 */
class LandPropertyInfoFactory extends Factory
{
    public function definition(): array
    {
        return [
            'land_property_id' => LandProperty::all()->random()->id,
            'cadastre_number' => fake()->numberBetween(10000000000, 99999999999),
            'land_usage' => fake()->randomElement(['Lauksaimniecības zeme', 'Meža zeme', 'Zeme zem ūdeņiem', 'Apbūves platība', 'Cits', 'Nav lietojuma']),
            'total_area' => fake()->randomFloat(2, 0, 10),
            'survey_date' => fake()->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
