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

        // First Donner Kebab Section
        $kebab1Section = MealDealSection::create([
            'meal_deal_id' => $mealDeal->id,
            'name' => 'Donner Kebab 1',
            'description' => 'Select your first donner kebab',
            'required' => true,
            'number_of_selections' => 1,
            'display_order' => 1,
        ]);

        // Get Donner Kebab product
        $donnerKebab = Product::where('name', 'LIKE', '%DONNER KEBAB%')->first();
        if ($donnerKebab) {
            MealDealSectionItem::create([
                'meal_deal_section_id' => $kebab1Section->id,
                'reference_type' => 'product',
                'reference_id' => $donnerKebab->id,
                'name_override' => 'Donner Kebab',
                'display_order' => 1,
            ]);
        }

        // Side for first kebab
        $side1Section = MealDealSection::create([
            'meal_deal_id' => $mealDeal->id,
            'name' => 'Side for Kebab 1',
            'description' => 'Choose side for your first kebab',
            'required' => true,
            'number_of_selections' => 1,
            'display_order' => 2,
        ]);

        $sides = OptionGroup::where('name', 'LIKE', '%Side%')->first()->options;
        foreach ($sides as $index => $side) {
            MealDealSectionItem::create([
                'meal_deal_section_id' => $side1Section->id,
                'reference_type' => 'option',
                'reference_id' => $side->id,
                'display_order' => $index + 1,
            ]);
        }

        // Sauce for first kebab
        $sauce1Section = MealDealSection::create([
            'meal_deal_id' => $mealDeal->id,
            'name' => 'Sauce for Kebab 1',
            'description' => 'Choose sauce for your first kebab',
            'required' => true,
            'number_of_selections' => 1,
            'display_order' => 3,
        ]);

        $dipOptions = OptionGroup::where('name', 'Dips 4oz')->first()?->options;
        if ($dipOptions) {
            foreach ($dipOptions as $index => $option) {
                MealDealSectionItem::create([
                    'meal_deal_section_id' => $sauce1Section->id,
                    'reference_type' => 'option',
                    'reference_id' => $option->id,
                    'display_order' => $index + 1,
                ]);
            }
        }

        // Drink for first kebab
        $drink1Section = MealDealSection::create([
            'meal_deal_id' => $mealDeal->id,
            'name' => 'Drink for Kebab 1',
            'description' => 'Choose drink for your first kebab',
            'required' => true,
            'number_of_selections' => 1,
            'display_order' => 4,
        ]);

        $canOptions = OptionGroup::where('name', 'Can of Pop')->first()?->options;
        if ($canOptions) {
            foreach ($canOptions as $index => $option) {
                MealDealSectionItem::create([
                    'meal_deal_section_id' => $drink1Section->id,
                    'reference_type' => 'option',
                    'reference_id' => $option->id,
                    'display_order' => $index + 1,
                ]);
            }
        }

        // Second Donner Kebab Section
        $kebab2Section = MealDealSection::create([
            'meal_deal_id' => $mealDeal->id,
            'name' => 'Donner Kebab 2',
            'description' => 'Select your second donner kebab',
            'required' => true,
            'number_of_selections' => 1,
            'display_order' => 5,
        ]);

        if ($donnerKebab) {
            MealDealSectionItem::create([
                'meal_deal_section_id' => $kebab2Section->id,
                'reference_type' => 'product',
                'reference_id' => $donnerKebab->id,
                'name_override' => 'Donner Kebab',
                'display_order' => 1,
            ]);
        }

        // Side for second kebab
        $side2Section = MealDealSection::create([
            'meal_deal_id' => $mealDeal->id,
            'name' => 'Side for Kebab 2',
            'description' => 'Choose side for your second kebab',
            'required' => true,
            'number_of_selections' => 1,
            'display_order' => 6,
        ]);

        foreach ($sides as $index => $side) {
            MealDealSectionItem::create([
                'meal_deal_section_id' => $side2Section->id,
                'reference_type' => 'option',
                'reference_id' => $side->id,
                'display_order' => $index + 1,
            ]);
        }

        // Sauce for second kebab
        $sauce2Section = MealDealSection::create([
            'meal_deal_id' => $mealDeal->id,
            'name' => 'Sauce for Kebab 2',
            'description' => 'Choose sauce for your second kebab',
            'required' => true,
            'number_of_selections' => 1,
            'display_order' => 7,
        ]);

        if ($dipOptions) {
            foreach ($dipOptions as $index => $option) {
                MealDealSectionItem::create([
                    'meal_deal_section_id' => $sauce2Section->id,
                    'reference_type' => 'option',
                    'reference_id' => $option->id,
                    'display_order' => $index + 1,
                ]);
            }
        }

        // Drink for second kebab
        $drink2Section = MealDealSection::create([
            'meal_deal_id' => $mealDeal->id,
            'name' => 'Drink for Kebab 2',
            'description' => 'Choose drink for your second kebab',
            'required' => true,
            'number_of_selections' => 1,
            'display_order' => 8,
        ]);

        if ($canOptions) {
            foreach ($canOptions as $index => $option) {
                MealDealSectionItem::create([
                    'meal_deal_section_id' => $drink2Section->id,
                    'reference_type' => 'option',
                    'reference_id' => $option->id,
                    'display_order' => $index + 1,
                ]);
            }
        }
    }
}