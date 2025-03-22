<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\CustomersSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            CategorySeeder::class,
            // AddonsSeeder::class,
            OptionsSeeder::class,
            PizzaSeeder::class,
            GarlicBreadSeeder::class,
            ProductSeeder::class,
            AddressSeeder::class,
            CustomersSeeder::class,
            MealDealSeeder::class,
            MealDeal2Seeder::class,
            MealDeal3Seeder::class,
            MealDeal4Seeder::class,
            MealDeal5Seeder::class,
            MealDeal6Seeder::class,
            MealDealFamilyOfferSeeder::class,
            MealDealBoxSpecialSeeder::class,
        ]);
    }
}
