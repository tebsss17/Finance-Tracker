<?php

namespace Database\Seeders;

use App\Models\Categories;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $categories =
        [
            'Food',
            'Transporation',
            'Bills and Payment',
            'Investment',
            'Salary',
        ];

        $user = User::first();

        foreach($categories as $name)
            {
                Categories::create([
                   'user_id' => $user->id,
                   'name' => $name,
                ]);
            }

    }
}
