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
        Allergen::create([
            'name' => 'Breakfast'
        ]);
    }
}
