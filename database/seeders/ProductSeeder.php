<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\OptionGroup;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Category IDs are based on the CategorySeeder
        // 1: Pizza
        // 2: Garlic Bread
        // 3: Stuffed Crust
        // 4: Kebabs
        // 5: Wraps
        // 6: Mexican
        // 7: Fish & Chips
        // 8: Burgers
        // 9: Parmesan
        // 10: Nachos
        // 11: Sundries
        // 12: Dips
        // 13: Drinks
        // 14: Desserts
        // 15: Kids Meals
        $kebabs = [
            [
                'category_id' => 3,
                'name' => 'DONNER KEBAB',
                'description' => '',
                'price' => 7.90,
                'image' => '9bd653c8d7a9bc9cf0b9d3cae6b30d4d.png',
                'is_active' => true,
                'is_featured' => true,
                'has_sides' => true,
                'has_sauces' => true,
            ],
            [
                'category_id' => 3,
                'name' => 'Chicken Kebab',
                'description' => 'Marinated chicken breast',
                'price' => 9.90,
                'image' => '9d1efcc469f881493437c3a20f2b2ea3.png',
                'is_active' => true,
                'is_featured' => false,
                'has_sides' => true,
                'has_sauces' => true,
            ],
            [
                'category_id' => 3,
                'name' => 'Chicken Special Kebab',
                'description' => 'Chicken and donner meat',
                'price' => 10.90,
                'image' => '25f2e4c54cd49303e7e7576fb87719ec.png',
                'is_active' => true,
                'is_featured' => true,
                'has_sides' => true,
                'has_sauces' => true,
            ],
            [
                'category_id' => 3,
                'name' => 'CHICKEN TIKKA KEBAB',
                'description' => 'Marinated Chicken and Tikka Meat',
                'price' => 9.90,
                'image' => '796b7434248619a652fe538dfbcc2302.png',
                'is_active' => true,
                'is_featured' => false,
                'has_sides' => true,
                'has_sauces' => true,
            ],
            [
                'category_id' => 3,
                'name' => 'CHICKEN TANDOORI KEBAB',
                'description' => 'Marinated Chicken & Tandoori Sauce',
                'price' => 9.90,
                'image' => '796b7434248619a652fe538dfbcc2302.png',
                'is_active' => true,
                'is_featured' => false,
                'has_sides' => true,
                'has_sauces' => true,
            ],
            [
                'category_id' => 3,
                'name' => 'SHISH KEBAB',
                'description' => 'Marinated Lamb',
                'price' => 11.90,
                'image' => '796b7434248619a652fe538dfbcc2302.png',
                'is_active' => true,
                'is_featured' => false,
                'has_sides' => true,
                'has_sauces' => true,
            ],
            [
                'category_id' => 3,
                'name' => 'HOUSE SPECIAL KEBAB',
                'description' => 'Chicken, Shish & Donner Meat',
                'price' => 12.90,
                'image' => '796b7434248619a652fe538dfbcc2302.png',
                'is_active' => true,
                'is_featured' => false,
                'has_sides' => true,
                'has_sauces' => true,
            ],
            [
                'category_id' => 3,
                'name' => ' TRAY OF DONNER MEAT',
                'description' => 'With Chilli or garlic sauce only',
                'price' => 5.50,
                'image' => '796b7434248619a652fe538dfbcc2302.png',
                'is_active' => true,
                'is_featured' => false,
                'has_sauces' => true,
            ],
            [
                'category_id' => 3,
                'name' => 'Donner Meat & Chips',
                'description' => 'With Chilli or garlic sauce only',
                'price' => 6.50,
                'image' => '796b7434248619a652fe538dfbcc2302.png',
                'is_active' => true,
                'is_featured' => false,
                'has_sauces' => true,
            ],
        ];

        $sides = OptionGroup::where('name', 'Sides')->first();
        $sauces = OptionGroup::where('name', 'Sauces')->first();

        foreach ($kebabs as $index => $kebab) {
            $product = Product::firstOrCreate(
                [
                    'category_id' => $kebab['category_id'],
                    'name' => $kebab['name']
                ],
                [
                    'description' => $kebab['description'],
                    'has_options' => true,
                    'is_featured' => $index === 0,
                ]
            );

            if(isset($kebab['has_sides']) && $kebab['has_sides']) {
                $product->optionGroups()->attach($sides, ['display_order' => 1]);
            }

            if(isset($kebab['has_sauces']) && $kebab['has_sauces']) {
                $product->optionGroups()->attach($sauces, ['display_order' => 2]);
            }
        }

        $wraps = [
            [
                'category_id' => 4,
                'name' => 'DONNER WRAP',
                'description' => '',
                'price' => 6.50,
                'image' => '9bd653c8d7a9bc9cf0b9d3cae6b30d4d.png',
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'category_id' => 4,
                'name' => 'CHICKEN WRAP',
                'description' => '',
                'price' => 7.90,
                'image' => '9bd653c8d7a9bc9cf0b9d3cae6b30d4d.png',
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'category_id' => 4,
                'name' => 'Mixed WRAP',
                'description' => 'Chicken and Donner Meat',
                'price' => 8.90,
                'image' => '9bd653c8d7a9bc9cf0b9d3cae6b30d4d.png',
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'category_id' => 4,
                'name' => 'CHICKEN TIKKA WRAP',
                'description' => '',
                'price' => 7.90,
                'image' => '9bd653c8d7a9bc9cf0b9d3cae6b30d4d.png',
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'category_id' => 4,
                'name' => 'CHICKEN TANDOORI WRAP',
                'description' => '',
                'price' => 7.90,
                'image' => '9bd653c8d7a9bc9cf0b9d3cae6b30d4d.png',
                'is_active' => true,
                'is_featured' => true,
            ],
        ];
    }
}
