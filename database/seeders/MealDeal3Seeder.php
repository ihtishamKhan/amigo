<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MealDeal;
use App\Models\MealDealSection;
use App\Models\MealDealSectionItem;
use App\Models\Product;
use App\Models\OptionGroup;
use App\Models\Option;

class MealDeal3Seeder extends Seeder
{
    public function run(): void
    {
        // Create Meal Deal 3
        $mealDeal = MealDeal::create([
            'name' => 'Meal Deal 3',
            'description' => '2 x Donner Kebabs with chips or salad & 2 x sauces - 2 x cans of pop',
            'price' => 16.90,
            'image' => 'meal-deals/meal-deal-3.jpg',
            'is_active' => true,
        ]);

        // Donner Kebab Section - Fixed item
        $kebabSection = MealDealSection::create([
            'meal_deal_id' => $mealDeal->id,
            'name' => 'Donner Kebabs',
            'description' => '2 x Donner Kebabs included',
            'required' => true,
            'number_of_selections' => 0, // No dropdown needed - fixed item
            'display_order' => 1,
        ]);

        // Get Donner Kebab product
        $donnerKebab = Product::where('name', 'LIKE', '%DONNER KEBAB%')->first();
        if ($donnerKebab) {
            MealDealSectionItem::create([
                'meal_deal_section_id' => $kebabSection->id,
                'reference_type' => 'product',
                'reference_id' => $donnerKebab->id,
                'name_override' => '2 x Donner Kebabs',
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
            'display_order' => 2,
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

        // Sauces Section - Two dropdowns for 2 sauces
        $extraSaucesSection = MealDealSection::create([
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
                    'meal_deal_section_id' => $extraSaucesSection->id,
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
            'display_order' => 4,
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