<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create(['name' => 'Admin', 'email' => 'admin@insanestaffing.ca', 'password' => Hash::make('12345678'), 'is_admin' => true]);
    }
}
