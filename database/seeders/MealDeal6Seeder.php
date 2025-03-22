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

class MealDeal6Seeder extends Seeder
{
    public function run(): void
    {
        // Create Meal Deal 6
        $mealDeal = MealDeal::create([
            'name' => 'Meal Deal 6',
            'description' => 'Any 2 x 12" Pizza with 2 sauces & 2 cans of pop',
            'price' => 19.90,
            'image' => 'meal-deals/meal-deal-6.jpg',
            'is_active' => true,
        ]);

        // Pizza Section - Two dropdowns
        $pizzaSection = MealDealSection::create([
            'meal_deal_id' => $mealDeal->id,
            'name' => '12" Pizzas',
            'description' => 'Choose any 2 12" pizzas',
            'required' => true,
            'number_of_selections' => 2,
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

        // Sauces Section - Two dropdowns for 2 sauces
        $saucesSection = MealDealSection::create([
            'meal_deal_id' => $mealDeal->id,
            'name' => 'Sauces',
            'description' => 'Choose 2 sauces',
            'required' => true,
            'number_of_selections' => 2,
            'display_order' => 2,
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

        // Drinks Section - Two dropdowns for 2 cans
        $drinksSection = MealDealSection::create([
            'meal_deal_id' => $mealDeal->id,
            'name' => 'Drinks',
            'description' => 'Choose 2 cans of pop',
            'required' => true,
            'number_of_selections' => 2,
            'display_order' => 3,
        ]);

        $canOptions = OptionGroup::where('name', 'Can of Pop')->first()?->options;
        if ($canOptions) {
            foreach ($canOptions as $index => $option) {
                MealDealSectionItem::create([
                    'meal_deal_section_id' => $drinksSection->id,
                    'reference_type' => 'option',
                    'reference_id' => $option->id,
                    'display_order' => $index + 1,
                ]);
            }
        }
    }
}