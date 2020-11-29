<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'testuser',
            'email' => 'kewu@test.at',
            'password' => bcrypt('testme'),
        ]);
    }
}
