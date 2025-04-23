<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MealDeal;
use App\Models\MealDealSection;
use App\Models\MealDealSectionItem;
use App\Models\Product;
use App\Models\OptionGroup;
use App\Models\Option;

class MealDealSeeder extends Seeder
{
    public function run(): void
    {
        // Create Meal Deal 1
        $mealDeal1 = MealDeal::create([
            'name' => 'Meal Deal 1',
            'description' => '2 x Donner wraps with chips or salad & chilli or garlic sauce - 2 x sauces & 2 x cans of pop',
            'price' => 13.99,
            'image' => 'meal-deals/meal-deal-1.jpg',
            'is_active' => true,
        ]);

        // First Donner Wrap Section
        $donnerWrap1Section = MealDealSection::create([
            'meal_deal_id' => $mealDeal1->id,
            'name' => 'Donner Wrap 1',
            'description' => 'Select your first donner wrap',
            'required' => true,
            'number_of_selections' => 1, // One dropdown
            'display_order' => 1,
        ]);

        // Get Donner Wrap product
        $donnerWrap = Product::where('name', 'LIKE', '%Donner Wrap%')
            ->first();

        if ($donnerWrap) {
            MealDealSectionItem::create([
                'meal_deal_section_id' => $donnerWrap1Section->id,
                'reference_type' => 'product',
                'reference_id' => $donnerWrap->id,
                'name_override' => 'Donner Wrap',
                'display_order' => 1,
            ]);
        }

        // Side for first wrap
        $side1Section = MealDealSection::create([
            'meal_deal_id' => $mealDeal1->id,
            'name' => 'Side for Wrap 1',
            'description' => 'Choose side for your first wrap',
            'required' => true,
            'number_of_selections' => 1,
            'display_order' => 2,
        ]);

        $sides = OptionGroup::where('name', 'LIKE', '%Side%')
            ->first()->options;

        foreach ($sides as $index => $side) {
            MealDealSectionItem::create([
                'meal_deal_section_id' => $side1Section->id,
                'reference_type' => 'option',
                'reference_id' => $side->id,
                'display_order' => $index + 1,
            ]);
        }

        // Sauce for first wrap
        $sauce1Section = MealDealSection::create([
            'meal_deal_id' => $mealDeal1->id,
            'name' => 'Sauce for Wrap 1',
            'description' => 'Choose sauce for your first wrap',
            'required' => true,
            'number_of_selections' => 1,
            'display_order' => 3,
        ]);

        $sauces = OptionGroup::where('name', 'LIKE', '%Sauce%')
            ->first()->options;

        foreach ($sauces as $index => $sauce) {
            MealDealSectionItem::create([
                'meal_deal_section_id' => $sauce1Section->id,
                'reference_type' => 'option',
                'reference_id' => $sauce->id,
                'display_order' => $index + 1,
            ]);
        }

        // Drink for first wrap
        $drink1Section = MealDealSection::create([
            'meal_deal_id' => $mealDeal1->id,
            'name' => 'Drink for Wrap 1',
            'description' => 'Choose drink for your first wrap',
            'required' => true,
            'number_of_selections' => 1,
            'display_order' => 4,
        ]);

        // Get can of pop options
        $canOptions = \App\Models\OptionGroup::where('name', 'Can of Pop')->first()?->options;
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

        // Extra sauce for first wrap
        $extraSauce1Section = MealDealSection::create([
            'meal_deal_id' => $mealDeal1->id,
            'name' => 'Extra Sauce for Wrap 1',
            'description' => 'Choose extra sauce for your first wrap',
            'required' => true,
            'number_of_selections' => 1,
            'display_order' => 5,
        ]);

        // Get dips/sauces
        $dipOptions = \App\Models\OptionGroup::where('name', 'Dips 4oz')->first()?->options;
        if ($dipOptions) {
            foreach ($dipOptions as $index => $option) {
                MealDealSectionItem::create([
                    'meal_deal_section_id' => $extraSauce1Section->id,
                    'reference_type' => 'option',
                    'reference_id' => $option->id,
                    'display_order' => $index + 1,
                ]);
            }
        }

        // Second Donner Wrap Section
        $donnerWrap2Section = MealDealSection::create([
            'meal_deal_id' => $mealDeal1->id,
            'name' => 'Donner Wrap 2',
            'description' => 'Select your second donner wrap',
            'required' => true,
            'number_of_selections' => 1,
            'display_order' => 6,
        ]);

        if ($donnerWrap) {
            MealDealSectionItem::create([
                'meal_deal_section_id' => $donnerWrap2Section->id,
                'reference_type' => 'product',
                'reference_id' => $donnerWrap->id,
                'name_override' => 'Donner Wrap',
                'display_order' => 1,
            ]);
        }

        // Side for second wrap
        $side2Section = MealDealSection::create([
            'meal_deal_id' => $mealDeal1->id,
            'name' => 'Side for Wrap 2',
            'description' => 'Choose side for your second wrap',
            'required' => true,
            'number_of_selections' => 1,
            'display_order' => 7,
        ]);

        foreach ($sides as $index => $side) {
            MealDealSectionItem::create([
                'meal_deal_section_id' => $side2Section->id,
                'reference_type' => 'option',
                'reference_id' => $side->id,
                'display_order' => $index + 1,
            ]);
        }

        // Sauce for second wrap
        $sauce2Section = MealDealSection::create([
            'meal_deal_id' => $mealDeal1->id,
            'name' => 'Sauce for Wrap 2',
            'description' => 'Choose sauce for your second wrap',
            'required' => true,
            'number_of_selections' => 1,
            'display_order' => 8,
        ]);

        foreach ($sauces as $index => $sauce) {
            MealDealSectionItem::create([
                'meal_deal_section_id' => $sauce2Section->id,
                'reference_type' => 'option',
                'reference_id' => $sauce->id,
                'display_order' => $index + 1,
            ]);
        }

        // Drink for second wrap
        $drink2Section = MealDealSection::create([
            'meal_deal_id' => $mealDeal1->id,
            'name' => 'Drink for Wrap 2',
            'description' => 'Choose drink for your second wrap',
            'required' => true,
            'number_of_selections' => 1,
            'display_order' => 9,
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

        // Extra sauce for second wrap
        $extraSauce2Section = MealDealSection::create([
            'meal_deal_id' => $mealDeal1->id,
            'name' => 'Extra Sauce for Wrap 2',
            'description' => 'Choose extra sauce for your second wrap',
            'required' => true,
            'number_of_selections' => 1,
            'display_order' => 10,
        ]);

        if ($dipOptions) {
            foreach ($dipOptions as $index => $option) {
                MealDealSectionItem::create([
                    'meal_deal_section_id' => $extraSauce2Section->id,
                    'reference_type' => 'option',
                    'reference_id' => $option->id,
                    'display_order' => $index + 1,
                ]);
            }
        }
    }
}
