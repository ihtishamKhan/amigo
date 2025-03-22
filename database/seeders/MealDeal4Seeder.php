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

class MealDeal4Seeder extends Seeder
{
    public function run(): void
    {
        // Create Meal Deal 4
        $mealDeal = MealDeal::create([
            'name' => 'Meal Deal 4',
            'description' => 'Any 2 x 10" Pizza with 2 sauces & 2 cans of pop',
            'price' => 18.90,
            'image' => 'meal-deals/meal-deal-4.jpg',
            'is_active' => true,
        ]);

        // Pizza Section - Two dropdowns
        $pizzaSection = MealDealSection::create([
            'meal_deal_id' => $mealDeal->id,
            'name' => '10" Pizzas',
            'description' => 'Choose any 2 10" pizzas',
            'required' => true,
            'number_of_selections' => 2,
            'display_order' => 1,
        ]);

        // Get all 10" pizzas
        $pizzaProducts = Product::where('category_id', 1)->get();
        foreach ($pizzaProducts as $index => $pizza) {
            $tenInchVariation = $pizza->variations()->where('name', '10"')->first();
            if ($tenInchVariation) {
                MealDealSectionItem::create([
                    'meal_deal_section_id' => $pizzaSection->id,
                    'reference_type' => 'variation',
                    'reference_id' => $tenInchVariation->id,
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