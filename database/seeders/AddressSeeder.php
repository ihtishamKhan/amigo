<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UserAddress;
use App\Models\User;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        foreach ($users as $user) {
            UserAddress::create([
                'user_id' => $user->id,
                'address_line1' => '123 Example Street',
                'city' => 'London',
                'postcode' => 'E1 6AN',
                'latitude' => 51.5074,
                'longitude' => -0.1278,
                'is_default' => true,
            ]);
        }

    }
}
