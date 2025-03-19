<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\OptionGroup;
use App\Models\Option;
use App\Models\AddonCategory;
use App\Models\Addon;


class OptionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create size-specific option groups for crust types
        $crustOptionsGroups = [
            '10"' => OptionGroup::firstOrCreate(
                ['name' => '10" Crust Options'],
                [
                    'is_required' => true,
                    'min_selections' => 1,
                    'max_selections' => 1,
                    'display_order' => 1,
                    'is_active' => true
                ]
            ),
            '12"' => OptionGroup::firstOrCreate(
                ['name' => '12" Crust Options'],
                [
                    'is_required' => true,
                    'min_selections' => 1,
                    'max_selections' => 1,
                    'display_order' => 1,
                    'is_active' => true
                ]
            ),
            '14"' => OptionGroup::firstOrCreate(
                ['name' => '14" Crust Options'],
                [
                    'is_required' => true,
                    'min_selections' => 1,
                    'max_selections' => 1,
                    'display_order' => 1,
                    'is_active' => true
                ]
            ),

            'sauces' => OptionGroup::firstOrCreate(
                ['name' => 'Sauces'],
                [
                    'is_required' => true,
                    'min_selections' => 0,
                    'max_selections' => 0, // Unlimited
                    'display_order' => 1,
                    'is_active' => true
                ]
            ),
            
            'sides' => OptionGroup::firstOrCreate(
                ['name' => 'Sides'],
                [
                    'is_required' => true,
                    'min_selections' => 0,
                    'max_selections' => 0, // Unlimited
                    'display_order' => 1,
                    'is_active' => true
                ]
            ),

            'dips4oz' => OptionGroup::firstOrCreate(
                ['name' => 'Dips 4oz'],
                [
                    'is_required' => true,
                    'min_selections' => 0,
                    'max_selections' => 1, // Unlimited
                    'display_order' => 1,
                    'is_active' => true
                ]
            ),

            'dips7oz' => OptionGroup::firstOrCreate(
                ['name' => 'Dips 7oz'],
                [
                    'is_required' => true,
                    'min_selections' => 0,
                    'max_selections' => 1, // Unlimited
                    'display_order' => 1,
                    'is_active' => true
                ]
            ),

            'canOfPop' => OptionGroup::firstOrCreate(
                ['name' => 'Can of Pop'],
                [
                    'is_required' => true,
                    'min_selections' => 0,
                    'max_selections' => 1, // Unlimited
                    'display_order' => 1,
                    'is_active' => true
                ]
            ),

            'bottleOfPop' => OptionGroup::firstOrCreate(
                ['name' => 'Bottle of Pop'],
                [
                    'is_required' => true,
                    'min_selections' => 0,
                    'max_selections' => 1, // Unlimited
                    'display_order' => 1,
                    'is_active' => true
                ]
            ),

            'largeBottleOfPop' => OptionGroup::firstOrCreate(
                ['name' => 'Large Bottle of Pop'],
                [
                    'is_required' => true,
                    'min_selections' => 0,
                    'max_selections' => 1, // Unlimited
                    'display_order' => 1,
                    'is_active' => true
                ]
            ),
        ];

        // Create options for each crust option group
        $crustTypes = [
            'Regular Crust' => [
                'is_default' => true,
                'display_order' => 1,
                '10"' => 0.00,
                '12"' => 0.00,
                '14"' => 0.00
            ],
            'Cheese Stuffed Crust' => [
                'is_default' => false,
                'display_order' => 2,
                '10"' => 1.50,
                '12"' => 2.00,
                '14"' => 2.50
            ],
            'Cheese & Pepperoni Stuffed Crust' => [
                'is_default' => false,
                'display_order' => 3,
                '10"' => 2.00,
                '12"' => 2.50,
                '14"' => 3.00
            ],
            'Cheese & Jalapenos Stuffed Crust' => [
                'is_default' => false,
                'display_order' => 4,
                '10"' => 2.00,
                '12"' => 2.50,
                '14"' => 3.00
            ],
            'Cheese Garlic & Herbs Stuffed Crust' => [
                'is_default' => false,
                'display_order' => 5,
                '10"' => 2.00,
                '12"' => 2.50,
                '14"' => 3.00
            ]
        ];

        // Create crust options for each size
        foreach ($crustTypes as $name => $data) {
            foreach (['10"', '12"', '14"'] as $size) {
                Option::firstOrCreate(
                    [
                        'option_group_id' => $crustOptionsGroups[$size]->id,
                        'name' => $name
                    ],
                    [
                        'additional_price' => $data[$size],
                        'is_default' => $data['is_default'],
                        'display_order' => $data['display_order'],
                        'is_active' => true
                    ]
                );
            }
        }

        // Create size-specific addon categories for toppings
        $toppingCategories = [
            '10"' => AddonCategory::firstOrCreate(
                ['name' => '10" Toppings'],
                [
                    'display_name' => 'Fancy a little something extra?',
                    'is_required' => false,
                    'min_selections' => 0,
                    'max_selections' => 0, // Unlimited
                    'display_order' => 1,
                    'is_active' => true
                ]
            ),
            '12"' => AddonCategory::firstOrCreate(
                ['name' => '12" Toppings'],
                [
                    'display_name' => 'Fancy a little something extra?',
                    'is_required' => false,
                    'min_selections' => 0,
                    'max_selections' => 0, // Unlimited
                    'display_order' => 1,
                    'is_active' => true
                ]
            ),
            '14"' => AddonCategory::firstOrCreate(
                ['name' => '14" Toppings'],
                [
                    'display_name' => 'Fancy a little something extra?',
                    'is_required' => false,
                    'min_selections' => 0,
                    'max_selections' => 0, // Unlimited
                    'display_order' => 1,
                    'is_active' => true
                ]
            ),
            'nachosToppings' => AddonCategory::firstOrCreate(
                ['name' => 'Nachos Toppings'],
                [
                    'display_name' => 'Fancy a little something extra?',
                    'is_required' => false,
                    'min_selections' => 0,
                    'max_selections' => 0, // Unlimited
                    'display_order' => 1,
                    'is_active' => true
                ]
            ),
        ];

        // Create toppings for each size category
        $toppings = [
            'Tomato' => ['10"' => 1.00, '12"' => 1.30, '14"' => 1.60],
            'Bolognese' => ['10"' => 1.00, '12"' => 1.30, '14"' => 1.60],
            'Mussels' => ['10"' => 1.00, '12"' => 1.30, '14"' => 1.60],
            'Tuna' => ['10"' => 1.00, '12"' => 1.30, '14"' => 1.60],
            'Turkey Ham' => ['10"' => 1.00, '12"' => 1.30, '14"' => 1.60],
            'Salami' => ['10"' => 1.00, '12"' => 1.30, '14"' => 1.60],
            'Pepperoni' => ['10"' => 1.00, '12"' => 1.30, '14"' => 1.60],
            'Donner Meat' => ['10"' => 1.00, '12"' => 1.30, '14"' => 1.60],
            'Chicken Tikka' => ['10"' => 1.00, '12"' => 1.30, '14"' => 1.60],
            'Chicken Tandoori' => ['10"' => 1.00, '12"' => 1.30, '14"' => 1.60],
            'Chicken' => ['10"' => 1.00, '12"' => 1.30, '14"' => 1.60],
            'Prawns' => ['10"' => 1.00, '12"' => 1.30, '14"' => 1.60],
            'Sweetcorn' => ['10"' => 1.00, '12"' => 1.30, '14"' => 1.60],
            'BBQ Sauce' => ['10"' => 1.00, '12"' => 1.30, '14"' => 1.60],
            'Pineapple' => ['10"' => 1.00, '12"' => 1.30, '14"' => 1.60],
            'Peppers' => ['10"' => 1.00, '12"' => 1.30, '14"' => 1.60],
            'Onion' => ['10"' => 1.00, '12"' => 1.30, '14"' => 1.60],
            'Mushroom' => ['10"' => 1.00, '12"' => 1.30, '14"' => 1.60],
            'Jalapenos' => ['10"' => 1.00, '12"' => 1.30, '14"' => 1.60],
            'Garlic' => ['10"' => 1.00, '12"' => 1.30, '14"' => 1.60],
            'Chips' => ['10"' => 1.00, '12"' => 1.30, '14"' => 1.60],
            'Chilli' => ['10"' => 1.00, '12"' => 1.30, '14"' => 1.60],
            'Cheese' => ['10"' => 1.00, '12"' => 1.30, '14"' => 1.60],
            'Curry Sauce' => ['10"' => 1.00, '12"' => 1.30, '14"' => 1.60],
        ];

        $displayOrder = 1;
        foreach ($toppings as $name => $prices) {
            foreach (['10"', '12"', '14"'] as $size) {
                Addon::firstOrCreate(
                    [
                        'addon_category_id' => $toppingCategories[$size]->id,
                        'name' => $name
                    ],
                    [
                        'price' => $prices[$size],
                        'is_default' => false,
                        'display_order' => $displayOrder,
                        'is_active' => true
                    ]
                );
            }
            $displayOrder++;
        }

        $nachosTopings = [
            'Bolognese' => 1.00,
            'Jalapenos' => 1.00,
            'Pepperoni' => 1.00,
            'Chicken' => 1.00
        ];

        $displayOrder = 1;
        foreach ($nachosTopings as $name => $price) {
            Addon::firstOrCreate(
                [
                    'addon_category_id' => $toppingCategories['nachosToppings']->id,
                    'name' => $name
                ],
                [
                    'price' => $price,
                    'is_default' => false,
                    'display_order' => $displayOrder,
                    'is_active' => true
                ]
            );
            $displayOrder++;
        }


        $sauces = [
            'Chilli Sauce' => 0,
            'Garlic Sauce' => 0,
            'No Sauce' => 0,
        ];

        foreach ($sauces as $name => $data) {
            Option::firstOrCreate(
                [
                    'option_group_id' => $crustOptionsGroups['sauces']->id,
                    'name' => $name
                ],
                [
                    'additional_price' => $data,
                    'is_default' => false,
                    'display_order' => 1,
                    'is_active' => true
                ]
            );
        }

        $sides = [
            'Chips' => 0,
            'Salad' => 0,
        ];

        foreach ($sides as $name => $data) {
            Option::firstOrCreate(
                [
                    'option_group_id' => $crustOptionsGroups['sides']->id,
                    'name' => $name
                ],
                [
                    'additional_price' => $data,
                    'is_default' => false,
                    'display_order' => 1,
                    'is_active' => true
                ]
            );
        }

        $dips4oz = [
            'Chilli' => 0,
            'Garlic' => 0,
            'BBQ' => 0,
            'Sweet Chilli' => 0,
            'Ketchup' => 0,
        ];

        foreach ($dips4oz as $name => $data) {
            Option::firstOrCreate(
                [
                    'option_group_id' => $crustOptionsGroups['dips4oz']->id,
                    'name' => $name
                ],
                [
                    'additional_price' => $data,
                    'is_default' => false,
                    'display_order' => 1,
                    'is_active' => true
                ]
            );
        }

        $dips7oz = [
            'Curry' => 0,
            'Gravy' => 0,
            'Mushy Peas' => 0,
        ];

        foreach ($dips7oz as $name => $data) {
            Option::firstOrCreate(
                [
                    'option_group_id' => $crustOptionsGroups['dips7oz']->id,
                    'name' => $name
                ],
                [
                    'additional_price' => $data,
                    'is_default' => false,
                    'display_order' => 1,
                    'is_active' => true
                ]
            );
        }

        $cansOfPop = [
            'Coke' => 0,
            'Diet Coke' => 0,
            'Diet Pepsi' => 0,
            'Fanta' => 0,
            '7Up' => 0,
            'Dr Pepper' => 0,
        ];

        foreach ($cansOfPop as $name => $data) {
            Option::firstOrCreate(
                [
                    'option_group_id' => $crustOptionsGroups['canOfPop']->id,
                    'name' => $name
                ],
                [
                    'additional_price' => $data,
                    'is_default' => false,
                    'display_order' => 1,
                    'is_active' => true
                ]
            );
        }

        $bottlesOfPop = [
            'Coke' => 0,
            'Diet Coke' => 0,
            'Pepsi' => 0,
            'Diet Pepsi' => 0,
            '7Up' => 0,
            'Dr Pepper' => 0,
        ];

        foreach ($bottlesOfPop as $name => $data) {
            Option::firstOrCreate(
                [
                    'option_group_id' => $crustOptionsGroups['bottleOfPop']->id,
                    'name' => $name
                ],
                [
                    'additional_price' => $data,
                    'is_default' => false,
                    'display_order' => 1,
                    'is_active' => true
                ]
            );
        }

        $largeBottlesOfPop = [
            'Pepsi' => 0,
            'Diet Pepsi' => 0,
            'Coke' => 0,
            'Diet Coke' => 0,
        ];

        foreach ($largeBottlesOfPop as $name => $data) {
            Option::firstOrCreate(
                [
                    'option_group_id' => $crustOptionsGroups['largeBottleOfPop']->id,
                    'name' => $name
                ],
                [
                    'additional_price' => $data,
                    'is_default' => false,
                    'display_order' => 1,
                    'is_active' => true
                ]
            );
        }
    }
}
