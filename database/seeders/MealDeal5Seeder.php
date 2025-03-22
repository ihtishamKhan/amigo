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

class MealDeal5Seeder extends Seeder
{
    public function run(): void
    {
        // Create Meal Deal 5
        $mealDeal = MealDeal::create([
            'name' => 'Meal Deal 5',
            'description' => 'Any 4 x 10" Pizza with bottle of pop',
            'price' => 28.90,
            'image' => 'meal-deals/meal-deal-5.jpg',
            'is_active' => true,
        ]);

        // Pizza Section - Four dropdowns
        $pizzaSection = MealDealSection::create([
            'meal_deal_id' => $mealDeal->id,
            'name' => '10" Pizzas',
            'description' => 'Choose any 4 10" pizzas',
            'required' => true,
            'number_of_selections' => 4,
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

        // Drinks Section - One dropdown for bottle
        $drinksSection = MealDealSection::create([
            'meal_deal_id' => $mealDeal->id,
            'name' => 'Drink',
            'description' => 'Choose a bottle of pop',
            'required' => true,
            'number_of_selections' => 1,
            'display_order' => 2,
        ]);

        $bottleOptions = OptionGroup::where('name', 'Large Bottle of Pop')->first()?->options;
        if ($bottleOptions) {
            foreach ($bottleOptions as $index => $option) {
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