<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed users
        // \App\Models\User::factory(5)->create();

        // Create admin user
        User::create([
            'name' => "Administrator",
            'username' => "Admin",
            'email' => "admin@admin.com",
            'contact_number' => '1234556789',
            'email_verified_at' => now(),
            'password' => '$2y$10$/6kM98PhYuEhum.1KN3mdedxrm7aGo/iHIQNaznqRycvAeYQkD2Wa', // &i902lYG8os3
            'remember_token' => Str::random(10),
            'role' => 'Admin'
        ]);
    }
}
