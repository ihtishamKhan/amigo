<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@amigo.com',
            'password' => Hash::make('password'),
            'phone' => '+44123456789',
            'preferred_language' => 'en',
            'country_code' => 'GB',
        ])
        ->assignRole('Super Admin');

        // Create regular users
        User::factory(10)->create();
    }
}
