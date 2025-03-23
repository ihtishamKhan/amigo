<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\OptionGroup;
use App\Models\AddonCategory;
use App\Models\ProductVariation;

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
                    'price' => $kebab['price'],
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
            [
                'category_id' => 4,
                'name' => 'CHEESE CHIPS WRAP',
                'description' => '',
                'price' => 5.50,
                'image' => '9bd653c8d7a9bc9cf0b9d3cae6b30d4d.png',
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'category_id' => 4,
                'name' => 'CHEESE CHIPS PEPPERONI WRAP',
                'description' => '',
                'price' => 6.00,
                'image' => '9bd653c8d7a9bc9cf0b9d3cae6b30d4d.png',
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'category_id' => 4,
                'name' => 'CHEESE CHIPS JALAPENO WRAP',
                'description' => '',
                'price' => 6.00,
                'image' => '9bd653c8d7a9bc9cf0b9d3cae6b30d4d.png',
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'category_id' => 4,
                'name' => 'CHIPS WRAP',
                'description' => '',
                'price' => 4.50,
                'image' => '9bd653c8d7a9bc9cf0b9d3cae6b30d4d.png',
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'category_id' => 4,
                'name' => 'MEGA KEBAB WRAP',
                'description' => '',
                'price' => 9.90,
                'image' => '9bd653c8d7a9bc9cf0b9d3cae6b30d4d.png',
                'is_active' => true,
                'is_featured' => true,
            ],
        ];

        foreach ($wraps as $index => $wrap) {
            $product = Product::firstOrCreate(
                [
                    'category_id' => $wrap['category_id'],
                    'name' => $wrap['name']
                ],
                [
                    'price' => $wrap['price'],
                    'description' => $wrap['description'],
                    'has_options' => true,
                    'is_featured' => $index === 0,
                ]
            );

            $product->optionGroups()->attach($sides, ['display_order' => 1]);

            $product->optionGroups()->attach($sauces, ['display_order' => 2]);
            
        }

        $mexicans = [
            [
                'category_id' => 5,
                'name' => 'Mexican Combo',
                'description' => '2 x Tortillas, 1 filled with: chicken, chilli, onion, peppers & jalapenos and the other with beef, chilli, onion, peppers & jalapenos',
                'price' => 9.99,
                'image' => '9bd653c8d7a9bc9cf0b9d3cae6b30d4d.png',
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'category_id' => 5,
                'name' => 'Beef Burrito',
                'description' => '2 x Tortillas filled with beef, chilli, onion, peppers & jalapenos.',
                'price' => 9.99,
                'image' => '9bd653c8d7a9bc9cf0b9d3cae6b30d4d.png',
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'category_id' => 5,
                'name' => 'Chicken Burrito',
                'description' => '2 x Tortillas filled with chicken, chilli, onion, peppers & jalapenos.',
                'price' => 9.99,
                'image' => '9bd653c8d7a9bc9cf0b9d3cae6b30d4d.png',
                'is_active' => true,
                'is_featured' => true,
            ]
        ];

        foreach ($mexicans as $index => $mexican) {
            $product = Product::firstOrCreate(
                [
                    'category_id' => $mexican['category_id'],
                    'name' => $mexican['name']
                ],
                [
                    'price' => $mexican['price'],
                    'description' => $mexican['description'],
                    'has_options' => true,
                    'is_featured' => $index === 0,
                ]
            );

            $product->optionGroups()->attach($sides, ['display_order' => 1]);            
        }

        $fishAndChips = [
            [
                'category_id' => 6,
                'name' => 'CHIPS',
                'description' => '',
                'price' => 2.90,
                'image' => '9bd653c8d7a9bc9cf0b9d3cae6b30d4d.png',
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'category_id' => 6,
                'name' => 'COD',
                'description' => '',
                'image' => '9bd653c8d7a9bc9cf0b9d3cae6b30d4d.png',
                'is_active' => true,
                'is_featured' => true,
                'variations' => [
                    [
                        'name' => 'Small',
                        'price' => 7.00,
                    ],
                    [
                        'name' => 'Large',
                        'price' => 9.00,
                    ],
                ],
            ],
            [
                'category_id' => 6,
                'name' => 'COD BITES (5)',
                'description' => '',
                'price' => 7.00,
                'image' => '9bd653c8d7a9bc9cf0b9d3cae6b30d4d.png',
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'category_id' => 6,
                'name' => 'CHIPS & SAUCE',
                'description' => '',
                'price' => 3.90,
                'image' => '9bd653c8d7a9bc9cf0b9d3cae6b30d4d.png',
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'category_id' => 6,
                'name' => 'CHEESY CHIPS',
                'description' => '',
                'price' => 4.50,
                'image' => '9bd653c8d7a9bc9cf0b9d3cae6b30d4d.png',
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'category_id' => 6,
                'name' => 'CHEESY CHIPS & BOLOGNESE',
                'description' => '',
                'price' => 5.90,
                'image' => '9bd653c8d7a9bc9cf0b9d3cae6b30d4d.png',
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'category_id' => 6,
                'name' => 'SCAMPI (10) WITH CHIPS & SAUCE',
                'description' => '',
                'price' => 6.90,
                'image' => '9bd653c8d7a9bc9cf0b9d3cae6b30d4d.png',
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'category_id' => 6,
                'name' => 'CHIP BUTTY',
                'description' => '',
                'price' => 3.50,
                'image' => '9bd653c8d7a9bc9cf0b9d3cae6b30d4d.png',
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'category_id' => 6,
                'name' => 'FISH CAKE',
                'description' => '',
                'price' => 2.90,
                'image' => '9bd653c8d7a9bc9cf0b9d3cae6b30d4d.png',
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'category_id' => 6,
                'name' => 'JUMBO SAUSAGE',
                'description' => '',
                'price' => 2.90,
                'image' => '9bd653c8d7a9bc9cf0b9d3cae6b30d4d.png',
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'category_id' => 6,
                'name' => 'JUMBO SAUSAGE',
                'description' => '',
                'price' => 2.90,
                'image' => '9bd653c8d7a9bc9cf0b9d3cae6b30d4d.png',
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'category_id' => 6,
                'name' => 'JUMBO SAUSAGE & CHIPS',
                'description' => '',
                'price' => 4.90,
                'image' => '9bd653c8d7a9bc9cf0b9d3cae6b30d4d.png',
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'category_id' => 6,
                'name' => 'BATTERED BURGER',
                'description' => '',
                'price' => 2.90,
                'image' => '9bd653c8d7a9bc9cf0b9d3cae6b30d4d.png',
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'category_id' => 6,
                'name' => 'MINCE PIE',
                'description' => '',
                'price' => 2.90,
                'image' => '9bd653c8d7a9bc9cf0b9d3cae6b30d4d.png',
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'category_id' => 6,
                'name' => 'CHEESE SAVOURY',
                'description' => '',
                'price' => 2.90,
                'image' => '9bd653c8d7a9bc9cf0b9d3cae6b30d4d.png',
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'category_id' => 6,
                'name' => 'CORNED BEEF SAVOURY',
                'description' => '',
                'price' => 2.90,
                'image' => '9bd653c8d7a9bc9cf0b9d3cae6b30d4d.png',
                'is_active' => true,
                'is_featured' => true,
            ],
        ];

        foreach ($fishAndChips as $index => $fAndC) {
            $product = Product::firstOrCreate(
                [
                    'category_id' => $fAndC['category_id'],
                    'name' => $fAndC['name']
                ],
                [
                    'price' => isset($fAndC['price']) ? $fAndC['price'] : null,
                    'description' => $fAndC['description'],
                    'has_options' => true,
                    'is_featured' => $index === 0,
                ]
            );

            if(isset($fAndC['variations'])) {
                $product->variations()->createMany($fAndC['variations']);
            }
            
            $product->optionGroups()->sync($sides, ['display_order' => 1]);
        }

        $burgers = [
            [
                'category_id' => 7,
                'name' => 'BEEF BURGER',
                'description' => '',
                'image' => '9bd653c8d7a9bc9cf0b9d3cae6b30d4d.png',
                'has_variations' => true,
                'prices' => [
                    '1/4' => 5.50,
                    '1/2' => 6.90
                ]
            ],
            [
                'category_id' => 7,
                'name' => 'CHEESE BURGER',
                'description' => '',
                'image' => '9bd653c8d7a9bc9cf0b9d3cae6b30d4d.png',
                'has_variations' => true,
                'prices' => [
                    '1/4' => 6.50,
                    '1/2' => 7.90
                ]
            ],
            [
                'category_id' => 7,
                'name' => 'CHICKEN BURGER',
                'description' => '',
                'image' => '9bd653c8d7a9bc9cf0b9d3cae6b30d4d.png',
                'has_variations' => true,
                'prices' => [
                    '1/4' => 6.50,
                    '1/2' => 7.90
                ]
            ],
            [
                'category_id' => 7,
                'name' => 'HAWAIIAN BURGER',
                'description' => '',
                'image' => '9bd653c8d7a9bc9cf0b9d3cae6b30d4d.png',
                'has_variations' => true,
                'prices' => [
                    '1/4' => 6.50,
                    '1/2' => 7.90
                ]
            ],
            [
                'category_id' => 7,
                'name' => 'MEXICAN BURGER',
                'description' => '',
                'image' => '9bd653c8d7a9bc9cf0b9d3cae6b30d4d.png',
                'has_variations' => true,
                'prices' => [
                    '1/4' => 6.50,
                    '1/2' => 7.90
                ]
            ],
            [
                'category_id' => 7,
                'name' => 'GEORDIE BURGER',
                'description' => 'With donner meat, chicken & beef burger',
                'image' => '9bd653c8d7a9bc9cf0b9d3cae6b30d4d.png',
                'has_variations' => true,
                'prices' => [
                    '1/2' => 8.90
                ]
            ]
        ];

        foreach ($burgers as $index => $burger) {
            $product = Product::firstOrCreate(
                [
                    'category_id' => $burger['category_id'],
                    'name' => $burger['name']
                ],
                [
                    'description' => $burger['description'],
                    'has_variations' => true,
                    'has_options' => true,
                    'is_featured' => $index === 0,
                ]
            );

            if(isset($burger['has_variations'])) {
                foreach ($burger['prices'] as $name => $price) {
                    $variation = ProductVariation::firstOrCreate(
                        [
                            'product_id' => $product->id,
                            'name' => $name
                        ],
                        [
                            'price' => $price,
                            'is_default' => $name === '1/4',
                            'display_order' => 1,
                            'is_active' => true,
                        ]
                    );
                }
            }

            $product->optionGroups()->sync($sides, ['display_order' => 1]);
        }

        $parmesans = [
            [
                'category_id' => 8,
                'name' => 'CHICKEN PARMESAN',
                'description' => '',
                'price' => 9.90,
                'image' => '9bd653c8d7a9bc9cf0b9d3cae6b30d4d.png',
            ],
            [
                'category_id' => 8,
                'name' => 'BBQ PARMESAN',
                'description' => '',
                'price' => 10.50,
                'image' => '9bd653c8d7a9bc9cf0b9d3cae6b30d4d.png',
            ],
            [
                'category_id' => 8,
                'name' => 'PEPPERONI PARMESAN',
                'description' => '',
                'price' => 10.50,
                'image' => '9bd653c8d7a9bc9cf0b9d3cae6b30d4d.png',
            ],
            [
                'category_id' => 8,
                'name' => 'KIEV PARMESAN',
                'description' => 'Garlic, mushroom & onions',
                'price' => 10.50,
                'image' => '9bd653c8d7a9bc9cf0b9d3cae6b30d4d.png',
            ],
            [
                'category_id' => 8,
                'name' => 'HOT & SPICY PARMESAN',
                'description' => 'Chilli, bolognese & jalapenos',
                'price' => 10.50,
                'image' => '9bd653c8d7a9bc9cf0b9d3cae6b30d4d.png',
            ],
        ];

        foreach ($parmesans as $index => $parmesan) {
            $product = Product::firstOrCreate(
                [
                    'category_id' => $parmesan['category_id'],
                    'name' => $parmesan['name']
                ],
                [
                    'description' => $parmesan['description'],
                    'price' => $parmesan['price'],
                    'is_featured' => $index === 0,
                ]
            );

            $product->optionGroups()->sync($sides, ['display_order' => 1]);
            $product->optionGroups()->sync($sauces, ['display_order' => 2]);
        }

        $nachos = [
            [
                'category_id' => 9,
                'name' => 'CHEESE NACHOS',
                'description' => '',
                'price' => 6.50,
                'image' => '9bd653c8d7a9bc9cf0b9d3cae6b30d4d.png',
            ],
            [
                'category_id' => 9,
                'name' => 'CHEESE & BOLOGNESE NACHOS',
                'description' => '',
                'price' => 7.50,
                'image' => '9bd653c8d7a9bc9cf0b9d3cae6b30d4d.png',
            ],
            [
                'category_id' => 9,
                'name' => 'CHEESE & PEPPERONI NACHOS',
                'description' => '',
                'price' => 7.50,
                'image' => '9bd653c8d7a9bc9cf0b9d3cae6b30d4d.png',
            ],
            [
                'category_id' => 9,
                'name' => 'CHEESE & JALAPENOOS NACHOS',
                'description' => '',
                'price' => 7.50,
                'image' => '9bd653c8d7a9bc9cf0b9d3cae6b30d4d.png',
            ],
            [
                'category_id' => 9,
                'name' => 'CHEESE & CHICKEN NACHOS',
                'description' => '',
                'price' => 7.50,
                'image' => '9bd653c8d7a9bc9cf0b9d3cae6b30d4d.png',
            ],
        ];

        $toppingCategories = AddonCategory::get(); 
        foreach ($nachos as $index => $nacho) {
            $product = Product::firstOrCreate(
                [
                    'category_id' => $nacho['category_id'],
                    'name' => $nacho['name']
                ],
                [
                    'description' => $nacho['description'],
                    'price' => $nacho['price'],
                    'is_featured' => $index === 0,
                ]
            );

            $product->addonCategories()->attach($toppingCategories->where('name', 'Nachos Toppings')->first()->id);
        }

        $sundries = [
            [
                'category_id' => 10,
                'name' => 'KEBAB BUTTY',
                'description' => '',
                'price' => 5.50,
                'image' => '9bd653c8d7a9bc9cf0b9d3cae6b30d4d.png',
            ],
            [
                'category_id' => 10,
                'name' => 'CHICKEN NUGGETS & CHIPS (8pc)',
                'description' => '',
                'price' => 5.90,
                'image' => '9bd653c8d7a9bc9cf0b9d3cae6b30d4d.png',
            ],
            [
                'category_id' => 10,
                'name' => 'ONION RINGS (10pc)',
                'description' => '',
                'price' => 3.50,
                'image' => '9bd653c8d7a9bc9cf0b9d3cae6b30d4d.png',
            ],
            [
                'category_id' => 10,
                'name' => 'POTATO WEDGES',
                'description' => '',
                'price' => 4.90,
                'image' => '9bd653c8d7a9bc9cf0b9d3cae6b30d4d.png',
            ],
            [
                'category_id' => 10,
                'name' => 'POTATO WEDGES, CHEESE & SAUCE',
                'description' => '',
                'price' => 5.50,
                'image' => '9bd653c8d7a9bc9cf0b9d3cae6b30d4d.png',
            ],
            [
                'category_id' => 10,
                'name' => 'GARLIC MUSHROOM & CHEESE',
                'description' => '',
                'price' => 4.80,
                'image' => '9bd653c8d7a9bc9cf0b9d3cae6b30d4d.png',
            ],
            [
                'category_id' => 10,
                'name' => 'MOZZARELLA STICKS (6pc)',
                'description' => '',
                'price' => 4.60,
                'image' => '9bd653c8d7a9bc9cf0b9d3cae6b30d4d.png',
            ],
            [
                'category_id' => 10,
                'name' => 'JALAPENO STICKS (6pc)',
                'description' => '',
                'price' => 4.60,
                'image' => '9bd653c8d7a9bc9cf0b9d3cae6b30d4d.png',
            ],
            [
                'category_id' => 10,
                'name' => 'CURLEY FRIES',
                'description' => '',
                'price' => 4.50,
                'image' => '9bd653c8d7a9bc9cf0b9d3cae6b30d4d.png',
            ],
            [
                'category_id' => 10,
                'name' => 'SALAD',
                'description' => '',
                'price' => 2.50,
                'image' => '9bd653c8d7a9bc9cf0b9d3cae6b30d4d.png',
            ],
            [
                'category_id' => 10,
                'name' => 'PITTA BREAD / TORTILLA / BREAD BUN',
                'description' => '',
                'price' => 0.90,
                'image' => '9bd653c8d7a9bc9cf0b9d3cae6b30d4d.png',
            ],
            [
                'category_id' => 10,
                'name' => 'SOUTHERN FRIED CHICKEN & CHIPS',
                'description' => '',
                'image' => '9bd653c8d7a9bc9cf0b9d3cae6b30d4d.png',
                'has_variations' => true,
                'prices' => [
                    '2pc' => 7.90,
                    '4pc' => 9.90
                ]
            ]
        ];

        foreach ($sundries as $index => $sundry) {
            $product = Product::firstOrCreate(
                [
                    'category_id' => $sundry['category_id'],
                    'name' => $sundry['name']
                ],
                [
                    'description' => $sundry['description'],
                    'price' => $sundry['price'] ?? null,
                    'is_featured' => $index === 0,
                ]
            );

            if(isset($sundry['has_variations'])) {
                $product->variations()->createMany(
                    collect($sundry['prices'])->map(function ($price, $name) {
                        return [
                            'name' => $name,
                            'price' => $price
                        ];
                    })->toArray()
                );
            }
        }

        $dips = [
            [
                'category_id' => 11,
                'name' => 'Dips (4oz)',
                'description' => '',
                'price' => 1.00,
                'image' => '9bd653c8d7a9bc9cf0b9d3cae6b30d4d.png',
            ],
            [
                'category_id' => 11,
                'name' => 'Dips (7oz)',
                'description' => '',
                'price' => 1.40,
                'image' => '9bd653c8d7a9bc9cf0b9d3cae6b30d4d.png',
            ],
        ];

        $dips4ozOptionGroup = OptionGroup::where('name', 'Dips 4oz')->first();
        $dips7ozOptionGroup = OptionGroup::where('name', 'Dips 7oz')->first();

        foreach ($dips as $index => $dip) {
            $product = Product::firstOrCreate(
                [
                    'category_id' => $dip['category_id'],
                    'name' => $dip['name']
                ],
                [
                    'description' => $dip['description'],
                    'price' => $dip['price'],
                    'is_featured' => $index === 0,
                ]
            );

            $product->optionGroups()->sync($dip['name'] === 'Dips (4oz)' ? $dips4ozOptionGroup : $dips7ozOptionGroup);
        }

        $drinks = [
            [
                'category_id' => 12,
                'name' => 'Can of Pop',
                'description' => '',
                'price' => 1.20,
                'image' => '9bd653c8d7a9bc9cf0b9d3cae6b30d4d.png',
                'has_options' => true,
            ],
            [
                'category_id' => 12,
                'name' => 'Bottle of Pop (500ml)',
                'description' => '',
                'price' => 2.00,
                'image' => '9bd653c8d7a9bc9cf0b9d3cae6b30d4d.png',
                'has_options' => true,
            ],
            [
                'category_id' => 12,
                'name' => 'Large Bottle of Pop',
                'description' => '',
                'price' => 3.00,
                'image' => '9bd653c8d7a9bc9cf0b9d3cae6b30d4d.png',
                'has_options' => true,
            ],
            [
                'category_id' => 12,
                'name' => 'Water / Fruit Shoot',
                'description' => '',
                'price' => 0.80,
                'image' => '9bd653c8d7a9bc9cf0b9d3cae6b30d4d.png',
                'has_options' => false,
            ],
            [
                'category_id' => 12,
                'name' => 'Monster',
                'description' => '',
                'price' => 2.00,
                'image' => '9bd653c8d7a9bc9cf0b9d3cae6b30d4d.png',
                'has_options' => false,
            ],
        ];

        $canOfPopOptionGroup = OptionGroup::where('name', 'Can of Pop')->first();
        $bottleOfPopOptionGroup = OptionGroup::where('name', 'Bottle of Pop')->first();
        $largeBottleOfPopOptionGroup = OptionGroup::where('name', 'Large Bottle of Pop')->first();

        foreach ($drinks as $index => $drink) {
            $product = Product::firstOrCreate(
                [
                    'category_id' => $drink['category_id'],
                    'name' => $drink['name']
                ],
                [
                    'description' => $drink['description'],
                    'price' => $drink['price'],
                    'is_featured' => $index === 0,
                ]
            );

            if($drink['has_options']) {
                $product->optionGroups()->sync($drink['name'] === 'Can of Pop' ? $canOfPopOptionGroup : ($drink['name'] === 'Bottle of Pop (500ml)' ? $bottleOfPopOptionGroup : $largeBottleOfPopOptionGroup));
            }

        }

        $drinks = [
            [
                'category_id' => 13,
                'name' => 'Cheese Cake',
                'description' => '',
                'price' => 2.50,
                'image' => '9bd653c8d7a9bc9cf0b9d3cae6b30d4d.png',
            ],
            [
                'category_id' => 13,
                'name' => 'Chocolate Cake',
                'description' => '',
                'price' => 2.50,
                'image' => '9bd653c8d7a9bc9cf0b9d3cae6b30d4d.png',
            ],
            [
                'category_id' => 13,
                'name' => 'Fudge Cake',
                'description' => '',
                'price' => 2.50,
                'image' => '9bd653c8d7a9bc9cf0b9d3cae6b30d4d.png',
            ],
            [
                'category_id' => 13,
                'name' => 'Ben & Jerry\'s Ice Cream (500ml)',
                'description' => '',
                'price' => 5.90,
                'image' => '9bd653c8d7a9bc9cf0b9d3cae6b30d4d.png',
            ],
        ];

        foreach ($drinks as $index => $drink) {
            $product = Product::firstOrCreate(
                [
                    'category_id' => $drink['category_id'],
                    'name' => $drink['name']
                ],
                [
                    'description' => $drink['description'],
                    'price' => $drink['price'],
                    'is_featured' => $index === 0,
                ]
            );
        }
    }
}
