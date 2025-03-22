<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MealDeal;
use App\Models\MealDealSection;
use App\Models\MealDealSectionItem;
use App\Models\Product;
use App\Models\ProductVariation;
use App\Models\OptionGroup;
use App\Models\Option;

class MealDealBoxSpecialSeeder extends Seeder
{
    public function run(): void
    {
        // Create Box Special
        $mealDeal = MealDeal::create([
            'name' => 'Box Special',
            'description' => '12" Pizza Box Come With Chips, Donner Kebab, Chicken Kebab, Salad, 2 Tortilla & 2 Sauces',
            'price' => 16.90,
            'image' => 'meal-deals/box-special.jpg',
            'is_active' => true,
        ]);

        // 12" Pizza Section - One dropdown
        $pizzaSection = MealDealSection::create([
            'meal_deal_id' => $mealDeal->id,
            'name' => '12" Pizza',
            'description' => 'Choose any 12" pizza',
            'required' => true,
            'number_of_selections' => 1,
            'display_order' => 1,
        ]);

        // Get all 12" pizzas
        $pizzaProducts = Product::where('category_id', 1)->get();
        foreach ($pizzaProducts as $index => $pizza) {
            $twelveInchVariation = $pizza->variations()->where('name', '12"')->first();
            if ($twelveInchVariation) {
                MealDealSectionItem::create([
                    'meal_deal_section_id' => $pizzaSection->id,
                    'reference_type' => 'variation',
                    'reference_id' => $twelveInchVariation->id,
                    'display_order' => $index + 1,
                ]);
            }
        }

        // Fixed items section - These come in the box
        $boxItemsSection = MealDealSection::create([
            'meal_deal_id' => $mealDeal->id,
            'name' => 'Box Items',
            'description' => 'Items included in the box',
            'required' => true,
            'number_of_selections' => 0, // No dropdown needed - fixed items
            'display_order' => 2,
        ]);

        // Add fixed items
        $fixedItems = [
            ['name' => 'CHIPS', 'override' => 'Chips'],
            ['name' => 'DONNER KEBAB', 'override' => 'Donner Kebab'],
            ['name' => 'Chicken Kebab', 'override' => 'Chicken Kebab'],
            ['name' => 'SALAD', 'override' => 'Salad'],
            ['name' => 'PITTA BREAD / TORTILLA / BREAD BUN', 'override' => '2 Tortilla']
        ];

        $displayOrder = 1;
        foreach ($fixedItems as $item) {
            $product = Product::where('name', 'LIKE', "%{$item['name']}%")->first();
            if ($product) {
                MealDealSectionItem::create([
                    'meal_deal_section_id' => $boxItemsSection->id,
                    'reference_type' => 'product',
                    'reference_id' => $product->id,
                    'name_override' => $item['override'],
                    'display_order' => $displayOrder++,
                ]);
            }
        }

        // Sauces Section - Two dropdowns for 2 sauces
        $saucesSection = MealDealSection::create([
            'meal_deal_id' => $mealDeal->id,
            'name' => 'Sauces',
            'description' => 'Choose 2 sauces',
            'required' => true,
            'number_of_selections' => 2,
            'display_order' => 3,
        ]);

        $dipOptions = OptionGroup::where('name', 'Dips 4oz')->first()?->options;
        if ($dipOptions) {
            foreach ($dipOptions as $index => $option) {
                MealDealSectionItem::create([
                    'meal_deal_section_id' => $saucesSection->id,
                    'reference_type' => 'option',
                    'reference_id' => $option->id,
                    'display_order' => $index + 1,
                ]);
            }
        }
    }
}