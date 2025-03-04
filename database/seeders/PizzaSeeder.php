<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductVariation;


class PizzaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pizza category ID is assumed to be 1
        $pizzaCategoryId = 1;
    
        // Define all pizzas from the menu with their descriptions and prices
        $pizzas = [
            [
                'id' => 1,
                'name' => 'MARGARITA',
                'description' => 'Cheese & Tomato',
                'prices' => [
                    '10"' => 5.50,
                    '12"' => 7.50,
                    '14"' => 9.90
                ]
            ],
            [
                'id' => 2,
                'name' => 'AL FUNGHI',
                'description' => 'Mushroom',
                'prices' => [
                    '10"' => 8.50,
                    '12"' => 9.50,
                    '14"' => 10.90
                ]
            ],
            [
                'id' => 3,
                'name' => 'VEGETARIAN',
                'description' => 'Mushroom, Onion, Peppers',
                'prices' => [
                    '10"' => 10.50,
                    '12"' => 10.50,
                    '14"' => 12.50
                ]
            ],
            [
                'id' => 4,
                'name' => 'LONDON PIZZA',
                'description' => 'Chips',
                'prices' => [
                    '10"' => 5.50,
                    '12"' => 7.50,
                    '14"' => 9.90
                ]
            ],
            [
                'id' => 5,
                'name' => 'HAM',
                'description' => 'Turkey Ham',
                'prices' => [
                    '10"' => 3.30,
                    '12"' => 10.50,
                    '14"' => 12.50
                ]
            ],
            [
                'id' => 6,
                'name' => 'HAWAIIAN',
                'description' => 'Turkey Ham & Pineapple',
                'prices' => [
                    '10"' => 3.30,
                    '12"' => 10.50,
                    '14"' => 12.50
                ]
            ],
            [
                'id' => 7,
                'name' => 'HAM & MUSHROOM',
                'description' => 'Turkey Ham & Mushroom',
                'prices' => [
                    '10"' => 3.30,
                    '12"' => 10.50,
                    '14"' => 12.50
                ]
            ],
            [
                'id' => 8,
                'name' => 'CALZONE',
                'description' => '(FOLDED) Turkey Ham, Onion & Mushroom',
                'prices' => [
                    '10"' => 3.30,
                    '12"' => 10.50,
                    '14"' => 12.50
                ]
            ],
            [
                'id' => 10,
                'name' => 'CHICKEN',
                'description' => 'Chicken',
                'prices' => [
                    '10"' => 3.30,
                    '12"' => 10.50,
                    '14"' => 12.50
                ]
            ],
            [
                'id' => 11,
                'name' => 'BBQ CHICKEN',
                'description' => 'BBQ Sauce & Chicken',
                'prices' => [
                    '10"' => 3.30,
                    '12"' => 10.50,
                    '14"' => 12.50
                ]
            ],
            [
                'id' => 12,
                'name' => 'CHICKEN CURRY',
                'description' => 'Curry Sauce & Chicken',
                'prices' => [
                    '10"' => 3.30,
                    '12"' => 10.50,
                    '14"' => 12.50
                ]
            ],
            [
                'id' => 13,
                'name' => 'CHICKEN & MUSHROOM',
                'description' => 'Chicken & Mushroom',
                'prices' => [
                    '10"' => 3.30,
                    '12"' => 10.50,
                    '14"' => 12.50
                ]
            ],
            [
                'id' => 14,
                'name' => 'CHICKEN & SWEETCORN',
                'description' => 'Chicken & Sweetcorn',
                'prices' => [
                    '10"' => 3.30,
                    '12"' => 10.50,
                    '14"' => 12.50
                ]
            ],
            [
                'id' => 15,
                'name' => 'CHICKEN KEV',
                'description' => 'Chicken, Mushroom & Garlic',
                'prices' => [
                    '10"' => 3.30,
                    '12"' => 10.50,
                    '14"' => 12.50
                ]
            ],
            [
                'id' => 16,
                'name' => 'CHICKEN TIKKA',
                'description' => 'Chicken Tikka & Onion',
                'prices' => [
                    '10"' => 3.30,
                    '12"' => 10.50,
                    '14"' => 12.50
                ]
            ],
            [
                'id' => 17,
                'name' => 'CHICKEN TANDOORI',
                'description' => 'Chicken Tandoori & Onion',
                'prices' => [
                    '10"' => 3.30,
                    '12"' => 10.50,
                    '14"' => 12.50
                ]
            ],
            [
                'id' => 18,
                'name' => 'HOT VEGETARIAN',
                'description' => 'Chilli, Mushroom, Onion, Peppers & Sweetcorn',
                'prices' => [
                    '10"' => 3.30,
                    '12"' => 10.50,
                    '14"' => 12.50
                ]
            ],
            [
                'id' => 19,
                'name' => 'HOT & SPICY',
                'description' => 'Chilli, Jalapenos, Onion, Peppers & Mushroom',
                'prices' => [
                    '10"' => 3.30,
                    '12"' => 10.50,
                    '14"' => 12.50
                ]
            ],
            [
                'id' => 20,
                'name' => 'INFERNO',
                'description' => 'Chilli, Salami, Peppers & Jalapenos',
                'prices' => [
                    '10"' => 3.30,
                    '12"' => 10.50,
                    '14"' => 12.50
                ]
            ],
            [
                'id' => 21,
                'name' => 'MEXICAN',
                'description' => 'Chilli, Jalapenos, Mushroom, Onion & Jalapenos',
                'prices' => [
                    '10"' => 3.30,
                    '12"' => 10.50,
                    '14"' => 12.50
                ]
            ],
            [
                'id' => 22,
                'name' => 'SPICY CHICKEN',
                'description' => 'Chilli, Chicken & Jalapenos',
                'prices' => [
                    '10"' => 3.30,
                    '12"' => 10.50,
                    '14"' => 12.50
                ]
            ],
            [
                'id' => 23,
                'name' => 'PEPPERONI',
                'description' => 'Pepperoni',
                'prices' => [
                    '10"' => 3.30,
                    '12"' => 10.50,
                    '14"' => 12.50
                ]
            ],
            [
                'id' => 24,
                'name' => 'PEPPERONI SPECIAL',
                'description' => 'Pepperoni, Onion & Peppers',
                'prices' => [
                    '10"' => 3.30,
                    '12"' => 10.50,
                    '14"' => 12.50
                ]
            ],
            [
                'id' => 25,
                'name' => 'SALAMI',
                'description' => 'Salami',
                'prices' => [
                    '10"' => 3.30,
                    '12"' => 10.50,
                    '14"' => 12.50
                ]
            ],
            [
                'id' => 26,
                'name' => 'BOLOGNESE',
                'description' => 'Bolognese',
                'prices' => [
                    '10"' => 3.30,
                    '12"' => 10.50,
                    '14"' => 12.50
                ]
            ],
            [
                'id' => 27,
                'name' => 'ALL MEAT',
                'description' => 'Pepperoni, Salami, Bolognese & Turkey Ham',
                'prices' => [
                    '10"' => 3.30,
                    '12"' => 10.50,
                    '14"' => 12.50
                ]
            ],
            [
                'id' => 28,
                'name' => 'KEBAB PIZZA',
                'description' => 'Donner Meat',
                'prices' => [
                    '10"' => 3.30,
                    '12"' => 10.50,
                    '14"' => 12.50
                ]
            ],
            [
                'id' => 29,
                'name' => 'KEBAB CALZONE',
                'description' => '(FOLDED) Donner Meat & Onion',
                'prices' => [
                    '10"' => 3.30,
                    '12"' => 10.50,
                    '14"' => 12.50
                ]
            ],
            [
                'id' => 30,
                'name' => 'TUNA',
                'description' => 'Tuna',
                'prices' => [
                    '10"' => 3.90,
                    '12"' => 10.90,
                    '14"' => 12.70
                ]
            ],
            [
                'id' => 31,
                'name' => 'TUNA SWEETCORN',
                'description' => 'Tuna & Sweetcorn',
                'prices' => [
                    '10"' => 3.90,
                    '12"' => 10.90,
                    '14"' => 12.70
                ]
            ],
            [
                'id' => 32,
                'name' => 'NEPTUNE',
                'description' => 'Tuna & Prawn',
                'prices' => [
                    '10"' => 3.90,
                    '12"' => 10.90,
                    '14"' => 12.70
                ]
            ],
            [
                'id' => 33,
                'name' => 'SEAFOOD SPECIAL',
                'description' => 'Tuna, Prawns & Mussels',
                'prices' => [
                    '10"' => 3.90,
                    '12"' => 10.90,
                    '14"' => 12.70
                ]
            ],
            [
                'id' => 34,
                'name' => 'AMIGO\'S SPECIAL',
                'description' => '4 toppings of your choice',
                'prices' => [
                    '10"' => 10.00,
                    '12"' => 11.00,
                    '14"' => 13.00
                ]
            ]
        ];
        
        // Create products and their variants
        foreach ($pizzas as $pizzaData) {
            $product = Product::updateOrCreate(
                [
                    'id' => $pizzaData['id'],
                    'category_id' => $pizzaCategoryId
                ],
                [
                    'name' => $pizzaData['name'],
                    // 'slug' => Str::slug($pizzaData['name']),
                    'description' => $pizzaData['description'],
                    'has_sizes' => true,
                    'has_addons' => true,
                    'is_active' => true,
                    'is_featured' => in_array($pizzaData['id'], [1, 2, 3, 4]), // Featured pizzas
                    // 'image' => 'products/pizza-' . Str::slug($pizzaData['name']) . '.jpg',
                ]
            );
            
            // Create size variants
            $displayOrder = 1;
            foreach ($pizzaData['prices'] as $size => $price) {
                ProductVariation::updateOrCreate(
                    [
                        'product_id' => $product->id,
                        'name' => $size
                    ],
                    [
                        'price' => $price,
                        'is_default' => ($size === '10"'), // 10" is the default size
                        'display_order' => $displayOrder++
                    ]
                );
            }
        }
    }
}
