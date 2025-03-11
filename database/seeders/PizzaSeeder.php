<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductVariation;
use App\Models\OptionGroup;
use Illuminate\Support\Str;
use App\Models\Option;
use App\Models\OptionPrice;
use Illuminate\Support\Facades\DB;
use App\Models\AddonCategory;
use App\Models\AddonCategoryVariant;
use App\Models\Addon;
use App\Models\AddonVariant;

class PizzaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pizza category ID is assumed to be 1
        $pizzaCategoryId = 1;

        $crustTypes = OptionGroup::where('name', 'Crust Type')->first();
    
        // Define all pizzas from the menu with their descriptions and prices
        $pizzas = [
            [
                'name' => 'MARGARITA',
                'description' => 'Cheese & Tomato',
                'prices' => [
                    '10"' => 5.50,
                    '12"' => 7.50,
                    '14"' => 9.90
                ]
            ],
            [
                'name' => 'AL FUNGHI',
                'description' => 'Mushroom',
                'prices' => [
                    '10"' => 8.50,
                    '12"' => 9.50,
                    '14"' => 10.90
                ]
            ],
            [
                'name' => 'VEGETARIAN',
                'description' => 'Mushroom, Onion, Peppers',
                'prices' => [
                    '10"' => 10.50,
                    '12"' => 10.50,
                    '14"' => 12.50
                ]
            ],
            [
                'name' => 'LONDON PIZZA',
                'description' => 'Chips',
                'prices' => [
                    '10"' => 5.50,
                    '12"' => 7.50,
                    '14"' => 9.90
                ]
            ],
            [
                'name' => 'HAM',
                'description' => 'Turkey Ham',
                'prices' => [
                    '10"' => 3.30,
                    '12"' => 10.50,
                    '14"' => 12.50
                ]
            ],
            [
                'name' => 'HAWAIIAN',
                'description' => 'Turkey Ham & Pineapple',
                'prices' => [
                    '10"' => 3.30,
                    '12"' => 10.50,
                    '14"' => 12.50
                ]
            ],
            [
                'name' => 'HAM & MUSHROOM',
                'description' => 'Turkey Ham & Mushroom',
                'prices' => [
                    '10"' => 3.30,
                    '12"' => 10.50,
                    '14"' => 12.50
                ]
            ],
            [
                'name' => 'CALZONE',
                'description' => '(FOLDED) Turkey Ham, Onion & Mushroom',
                'prices' => [
                    '10"' => 3.30,
                    '12"' => 10.50,
                    '14"' => 12.50
                ]
            ],
            [
                'name' => 'CHICKEN',
                'description' => 'Chicken',
                'prices' => [
                    '10"' => 3.30,
                    '12"' => 10.50,
                    '14"' => 12.50
                ]
            ],
            [
                'name' => 'BBQ CHICKEN',
                'description' => 'BBQ Sauce & Chicken',
                'prices' => [
                    '10"' => 3.30,
                    '12"' => 10.50,
                    '14"' => 12.50
                ]
            ],
            [
                'name' => 'CHICKEN CURRY',
                'description' => 'Curry Sauce & Chicken',
                'prices' => [
                    '10"' => 3.30,
                    '12"' => 10.50,
                    '14"' => 12.50
                ]
            ],
            [
                'name' => 'CHICKEN & MUSHROOM',
                'description' => 'Chicken & Mushroom',
                'prices' => [
                    '10"' => 3.30,
                    '12"' => 10.50,
                    '14"' => 12.50
                ]
            ],
            [
                'name' => 'CHICKEN & SWEETCORN',
                'description' => 'Chicken & Sweetcorn',
                'prices' => [
                    '10"' => 3.30,
                    '12"' => 10.50,
                    '14"' => 12.50
                ]
            ],
            [
                'name' => 'CHICKEN KEV',
                'description' => 'Chicken, Mushroom & Garlic',
                'prices' => [
                    '10"' => 3.30,
                    '12"' => 10.50,
                    '14"' => 12.50
                ]
            ],
            [
                'name' => 'CHICKEN TIKKA',
                'description' => 'Chicken Tikka & Onion',
                'prices' => [
                    '10"' => 3.30,
                    '12"' => 10.50,
                    '14"' => 12.50
                ]
            ],
            [
                'name' => 'CHICKEN TANDOORI',
                'description' => 'Chicken Tandoori & Onion',
                'prices' => [
                    '10"' => 3.30,
                    '12"' => 10.50,
                    '14"' => 12.50
                ]
            ],
            [
                'name' => 'HOT VEGETARIAN',
                'description' => 'Chilli, Mushroom, Onion, Peppers & Sweetcorn',
                'prices' => [
                    '10"' => 3.30,
                    '12"' => 10.50,
                    '14"' => 12.50
                ]
            ],
            [
                'name' => 'HOT & SPICY',
                'description' => 'Chilli, Jalapenos, Onion, Peppers & Mushroom',
                'prices' => [
                    '10"' => 3.30,
                    '12"' => 10.50,
                    '14"' => 12.50
                ]
            ],
            [
                'name' => 'INFERNO',
                'description' => 'Chilli, Salami, Peppers & Jalapenos',
                'prices' => [
                    '10"' => 3.30,
                    '12"' => 10.50,
                    '14"' => 12.50
                ]
            ],
            [
                'name' => 'MEXICAN',
                'description' => 'Chilli, Jalapenos, Mushroom, Onion & Jalapenos',
                'prices' => [
                    '10"' => 3.30,
                    '12"' => 10.50,
                    '14"' => 12.50
                ]
            ],
            [
                'name' => 'SPICY CHICKEN',
                'description' => 'Chilli, Chicken & Jalapenos',
                'prices' => [
                    '10"' => 3.30,
                    '12"' => 10.50,
                    '14"' => 12.50
                ]
            ],
            [
                'name' => 'PEPPERONI',
                'description' => 'Pepperoni',
                'prices' => [
                    '10"' => 3.30,
                    '12"' => 10.50,
                    '14"' => 12.50
                ]
            ],
            [
                'name' => 'PEPPERONI SPECIAL',
                'description' => 'Pepperoni, Onion & Peppers',
                'prices' => [
                    '10"' => 3.30,
                    '12"' => 10.50,
                    '14"' => 12.50
                ]
            ],
            [
                'name' => 'SALAMI',
                'description' => 'Salami',
                'prices' => [
                    '10"' => 3.30,
                    '12"' => 10.50,
                    '14"' => 12.50
                ]
            ],
            [
                'name' => 'BOLOGNESE',
                'description' => 'Bolognese',
                'prices' => [
                    '10"' => 3.30,
                    '12"' => 10.50,
                    '14"' => 12.50
                ]
            ],
            [
                'name' => 'ALL MEAT',
                'description' => 'Pepperoni, Salami, Bolognese & Turkey Ham',
                'prices' => [
                    '10"' => 3.30,
                    '12"' => 10.50,
                    '14"' => 12.50
                ]
            ],
            [
                'name' => 'KEBAB PIZZA',
                'description' => 'Donner Meat',
                'prices' => [
                    '10"' => 3.30,
                    '12"' => 10.50,
                    '14"' => 12.50
                ]
            ],
            [
                'name' => 'KEBAB CALZONE',
                'description' => '(FOLDED) Donner Meat & Onion',
                'prices' => [
                    '10"' => 3.30,
                    '12"' => 10.50,
                    '14"' => 12.50
                ]
            ],
            [
                'name' => 'TUNA',
                'description' => 'Tuna',
                'prices' => [
                    '10"' => 3.90,
                    '12"' => 10.90,
                    '14"' => 12.70
                ]
            ],
            [
                'name' => 'TUNA SWEETCORN',
                'description' => 'Tuna & Sweetcorn',
                'prices' => [
                    '10"' => 3.90,
                    '12"' => 10.90,
                    '14"' => 12.70
                ]
            ],
            [
                'name' => 'NEPTUNE',
                'description' => 'Tuna & Prawn',
                'prices' => [
                    '10"' => 3.90,
                    '12"' => 10.90,
                    '14"' => 12.70
                ]
            ],
            [
                'name' => 'SEAFOOD SPECIAL',
                'description' => 'Tuna, Prawns & Mussels',
                'prices' => [
                    '10"' => 3.90,
                    '12"' => 10.90,
                    '14"' => 12.70
                ]
            ],
            [
                'name' => 'AMIGO\'S SPECIAL',
                'description' => '4 toppings of your choice',
                'prices' => [
                    '10"' => 10.00,
                    '12"' => 11.00,
                    '14"' => 13.00
                ]
            ]
        ];

        // Create option groups for crust types
        $crustOptionsGroups = OptionGroup::get();

        // Create options for each crust option group
        $toppingCategories = AddonCategory::get();
        

        // Create products and their variants
        foreach ($pizzas as $index => $pizzaData) {
            $product = Product::firstOrCreate(
                [
                    'category_id' => $pizzaCategoryId,
                    'name' => $pizzaData['name']
                ],
                [
                    'description' => $pizzaData['description'],
                    'has_variations' => true,
                    'has_options' => true,
                    'has_addons' => true,
                    'is_featured' => $index === 0, // Make first pizza featured
                    // 'display_order' => $index + 1,
                    // 'is_active' => true
                ]
            );

            // Create size variants with links to the appropriate option groups and addon categories
            foreach ($pizzaData['prices'] as $size => $price) {
                $variation = ProductVariation::firstOrCreate(
                    [
                        'product_id' => $product->id,
                        'name' => $size
                    ],
                    [
                        'price' => $price,
                        'is_default' => ($size === '10"'), // 10" is the default size
                        'display_order' => $size === '10"' ? 1 : ($size === '12"' ? 2 : 3),
                        'is_active' => true,
                    ]
                );

                $variation->addonCategories()->attach($toppingCategories->where('name', $size . ' Toppings')->first()->id);
                $variation->optionGroups()->attach($crustOptionsGroups->where('name', $size . ' Crust Options')->first()->id);
            }
        }
    }
}
