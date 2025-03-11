<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Addon;
use App\Models\AddonCategory;

class AddonsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $addonCategory = AddonCategory::firstOrCreate(
            ['name' => 'Pizza Toppings'],
            [
                'is_required' => false,
                'min_selections' => 0,
                'max_selections' => 5,
            ]
        );

        // Create all addons that can be used across products
        $addons = [
            'Tomato',
            'Bolognese',
            'Mussels',
            'Tuna',
            'Turkey Ham',
            'Salami',
            'Pepperoni',
            'Donner Meat',
            'Chicken Tikka',
            'Chicken Tandoori',
            'Chicken',
            'Prawns',
            'Sweetcorn',
            'BBQ Sauce',
            'Pineapple',
            'Peppers',
            'Onion',
            'Mushroom',
            'Jalapenos',
            'Garlic',
            'Chips',
            'Chilli',
            'Cheese',
            'Curry Sauce',
        ];
        
        foreach ($addons as $addonName) {
            Addon::create([
                'name' => $addonName,
                'is_active' => true
            ]);
        }
    }
}
