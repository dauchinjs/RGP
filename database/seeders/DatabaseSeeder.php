<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\LandProperty;
use App\Models\LandPropertyInfo;
use App\Models\People;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
        $amount = 10;

        $people = People::factory($amount)->create();
        $landProperties = LandProperty::factory($amount)->create();
        $landPropertyInfo = LandPropertyInfo::factory($amount)->create();

        foreach ($people as $person) {
            $person->landProperties()->saveMany($landProperties->random(5));
        }

        foreach ($landProperties as $landProperty) {
            $landProperty->landPropertyInfo()->saveMany($landPropertyInfo->random(5));
        }
    }
}
