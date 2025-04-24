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