<?php

namespace Database\Seeders;

use App\Models\Recipe;
use Illuminate\Database\Seeder;

class RecipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Recipe::create([
            'title' => 'Austrian Veggie Meatloaf',
            'description' => 'Best and awesomest Meatloaf without any meat!',
            'ingredients' => '250gr Flour',
            'steps' => 'Put all the wet ingredients into a bowl.',
            'is_public' => false,
        ]);
    }
}
