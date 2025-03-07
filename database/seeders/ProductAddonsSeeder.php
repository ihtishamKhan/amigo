<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AddonCategory;
use App\Models\Addon;
use App\Models\Product;
use App\Models\ProductVariation;
use Illuminate\Support\Facades\DB;

class ProductAddonsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pizzaToppingsCategory = AddonCategory::updateOrCreate(
            ['name' => 'Pizza Toppings'],
            [
                'is_required' => false,
                'min_selections' => 0,
                'max_selections' => 10,
                // We'll set a default price of 0, as the actual price
                // will be determined by the size-specific pivot table
            ]
        );
        
        // Create toppings as addons
        $pizzaToppings = [
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
            'Curry Sauce'
        ];

        // Add toppings to the category
        $displayOrder = 1;
        foreach ($pizzaToppings as $topping) {
            Addon::updateOrCreate(
                [
                    'addon_category_id' => $pizzaToppingsCategory->id,
                    'name' => $topping
                ],
                [
                    'price' => 0, // Base price is 0, actual price from pivot
                    'display_order' => $displayOrder++,
                    'is_active' => true
                ]
            );
        }

        // Now connect the toppings category to all pizza variants with the correct price
        $pizzaProducts = Product::where('category_id', 1)->get(); // Assuming category ID 1 is Pizza
        
        foreach ($pizzaProducts as $pizza) {
            // Get all variants (sizes) for this pizza
            $variants = ProductVariation::where('product_id', $pizza->id)->get();
            
            foreach ($variants as $variant) {
                // Determine the topping price based on size
                $toppingPrice = 0;
                
                if ($variant->name === '10"') {
                    $toppingPrice = 1.50;
                } elseif ($variant->name === '12"') {
                    $toppingPrice = 1.90;
                } elseif ($variant->name === '14"') {
                    $toppingPrice = 2.30;
                }
                
                // Link the topping category to this product variant with the appropriate price
                DB::table('product_addon_categories_variants')->updateOrInsert(
                    [
                        'product_id' => $pizza->id,
                        'variant_id' => $variant->id,
                        'addon_category_id' => $pizzaToppingsCategory->id
                    ],
                    [
                        'price_multiplier' => $toppingPrice, // Store the price for this size
                        'display_order' => 1
                    ]
                );
            }
        }
        
    }
}
