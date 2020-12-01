<?php

namespace Database\Seeders;

use App\Models\Allergen;
use Illuminate\Database\Seeder;

class AllergenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Allergen::create(
            ['name' => 'lactose-free']
        );
        Allergen::create(
            ['name' => 'gluten-free']
        );
        Allergen::create(
            ['name' => 'histamine-free']
        );
        Allergen::create(
            ['name' => 'nut-free']
        );
        Allergen::create(
            ['name' => 'vegetarian']
        );
        Allergen::create(
            ['name' => 'vegan']
        );
        Allergen::create(
            ['name' => 'undefined']
        );
    }
}
