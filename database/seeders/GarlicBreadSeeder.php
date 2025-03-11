<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductVariation;
use Illuminate\Support\Str;
use App\Models\OptionGroup;
use App\Models\AddonCategory;

class GarlicBreadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Garlic Bread category ID is assumed to be 2
        $breadCategory = 2;
    
        // Define all breads from the menu with their descriptions and prices
        $breads = [
            [
                'name' => 'PLAIN GARLIC BREAD',
                'description' => 'Plain Garlic Bread',
                'prices' => [
                    '10"' => 4.00,
                    '12"' => 6.00,
                    '14"' => 7.00
                ],
                'has_crust_options' => true,
                'has_addons' => true,
            ],
            [
                'name' => 'Garlic Bread Cheese',
                'description' => 'Garlic Bread Cheese',
                'prices' => [
                    '10"' => 6.50,
                    '12"' => 7.50,
                    '14"' => 9.90
                ],
                'has_crust_options' => true,
                'has_addons' => true,
            ],
            [
                'name' => 'Garlic Bread Cheese  & Mushroom',
                'description' => 'Garlic Bread Cheese  & Mushroom',
                'prices' => [
                    '10"' => 8.00,
                    '12"' => 9.00,
                    '14"' => 10.00
                ],
                'has_crust_options' => true,
                'has_addons' => true,
            ],
            [
                'name' => 'Garlic Bread Tomato',
                'description' => 'Garlic Bread Tomato',
                'prices' => [
                    '10"' => 4.80,
                    '12"' => 6.50,
                    '14"' => 7.50
                ],
                'has_crust_options' => true,
                'has_addons' => true,
            ],
            [
                'name' => 'Garlic Bread Cheese Special',
                'description' => 'Garlic Bread Cheese Special',
                'prices' => [
                    '10"' => 9.50,
                    '12"' => 10.90,
                    '14"' => 12.50
                ],
                'has_crust_options' => false,
                'has_sauce_options' => true,
            ],
        ];

        // Create products and their variants
        foreach ($breads as $index => $bread) {
            $product = Product::updateOrCreate(
                [
                    'category_id' => $breadCategory,
                    'name' => $bread['name'],
                ],
                [
                    'description' => $bread['description'],
                    'has_variations' => true,
                    'has_addons' => $bread['has_addons'] ?? false,
                    'has_options' => isset($bread['has_options']) ? $bread['has_options'] : false,
                    'is_featured' => $index === 0, // Make first pizza featured
                ]
            );
            
            // Create size variants
            $displayOrder = 1;
            $optionsGroup = OptionGroup::get();
            // Create options for each crust option group
            $addonCategories = AddonCategory::get();
            foreach ($bread['prices'] as $size => $price) {
                $variation = ProductVariation::updateOrCreate(
                    [
                        'product_id' => $product->id,
                        'name' => $size
                    ],
                    [
                        'price' => $price,
                    ]
                );

                if($bread['has_crust_options']) {
                    $variation->optionGroups()->attach($optionsGroup->where('name', $size . ' Crust Options')->first()->id);
                }

                if(isset($bread['has_sauce_options']) && $bread['has_sauce_options']) {
                    // $variation->optionGroups()->sync($optionsGroup->pluck('id')->toArray(), ['display_order' => $displayOrder]);
                    $variation->optionGroups()->attach($optionsGroup->where('name', 'Sauces')->first()->id);
                }

                if(isset($bread['has_addons']) && $bread['has_addons']) {
                    $variation->addonCategories()->attach($addonCategories->where('name', $size . ' Toppings')->first()->id);
                }
            }
        }
    }
}
