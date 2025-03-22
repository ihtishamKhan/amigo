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

class MealDeal2Seeder extends Seeder
{
    public function run(): void
    {
        // Create Meal Deal 2
        $mealDeal = MealDeal::create([
            'name' => 'Meal Deal 2',
            'description' => 'Any 10" Pizza, Donner Kebab with chips or salad & chilli or garlic sauce - 2 x cans of pop',
            'price' => 16.90,
            'image' => 'meal-deals/meal-deal-2.jpg',
            'is_active' => true,
        ]);

        // Pizza Section - One dropdown
        $pizzaSection = MealDealSection::create([
            'meal_deal_id' => $mealDeal->id,
            'name' => '10" Pizza',
            'description' => 'Choose any 10" pizza',
            'required' => true,
            'number_of_selections' => 1,
            'display_order' => 1,
        ]);

        // Get all 10" pizzas
        $pizzaProducts = Product::where('category_id', 1)->get(); // Assuming 1 is the pizza category ID
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

        // Donner Kebab Section - Fixed item
        $kebabSection = MealDealSection::create([
            'meal_deal_id' => $mealDeal->id,
            'name' => 'Donner Kebab',
            'description' => 'Donner Kebab included',
            'required' => true,
            'number_of_selections' => 0, // No dropdown needed - fixed item
            'display_order' => 2,
        ]);

        // Get Donner Kebab product
        $donnerKebab = Product::where('name', 'LIKE', '%DONNER KEBAB%')->first();
        if ($donnerKebab) {
            MealDealSectionItem::create([
                'meal_deal_section_id' => $kebabSection->id,
                'reference_type' => 'product',
                'reference_id' => $donnerKebab->id,
                'display_order' => 1,
            ]);
        }

        // Side Section - One dropdown
        $sideSection = MealDealSection::create([
            'meal_deal_id' => $mealDeal->id,
            'name' => 'Side',
            'description' => 'Choose between chips or salad',
            'required' => true,
            'number_of_selections' => 1,
            'display_order' => 3,
        ]);

        $sides = OptionGroup::where('name', 'LIKE', '%Side%')->first()->options;
        foreach ($sides as $index => $side) {
            MealDealSectionItem::create([
                'meal_deal_section_id' => $sideSection->id,
                'reference_type' => 'option',
                'reference_id' => $side->id,
                'display_order' => $index + 1,
            ]);
        }

        // Sauce Section - One dropdown
        $sauceSection = MealDealSection::create([
            'meal_deal_id' => $mealDeal->id,
            'name' => 'Sauce',
            'description' => 'Choose between chilli or garlic',
            'required' => true,
            'number_of_selections' => 1,
            'display_order' => 4,
        ]);

        $sauces = OptionGroup::where('name', 'LIKE', '%Sauce%')->first()->options;
        foreach ($sauces as $index => $sauce) {
            MealDealSectionItem::create([
                'meal_deal_section_id' => $sauceSection->id,
                'reference_type' => 'option',
                'reference_id' => $sauce->id,
                'display_order' => $index + 1,
            ]);
        }

        // Drinks Section - Two dropdowns for 2 cans
        $drinksSection = MealDealSection::create([
            'meal_deal_id' => $mealDeal->id,
            'name' => 'Drinks',
            'description' => 'Choose 2 cans of pop',
            'required' => true,
            'number_of_selections' => 2,
            'display_order' => 5,
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