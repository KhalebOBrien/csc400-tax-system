<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Number;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'last_name' => 'Admin',
            'other_name' => 'Admin',
            'email' => 'admin@yopmail.com',
            'status' => 'active',
            'role' => 'admin',
            'profile_photo_path' => 'profile-photos/default.png',
        ]);

        User::factory()->create([
            'last_name' => 'Ebuka',
            'other_name' => 'Matthew',
            'email' => 'ebuka@yopmail.com',
            'status' => 'active',
            'role' => 'user',
            'profile_photo_path' => 'profile-photos/default.png',
            'tin' => Number::random(10),
        ]);
    }
}
