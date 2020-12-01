<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'All'
        ]);
        Category::create([
            'name' => 'Breakfast'
        ]);
        Category::create([
            'name' => 'Lunch'
        ]);
        Category::create([
            'name' => 'Dinner'
        ]);
        Category::create([
            'name' => 'Dessert'
        ]);
    }
}
