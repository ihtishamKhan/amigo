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

        // Donner Section
        $donnerWrapSection = MealDealSection::create([
            'meal_deal_id' => $mealDeal1->id,
            'name' => 'Donner Wraps',
            'description' => '2 x Donner wraps',
            'required' => true,
            'number_of_selections' => 0, // No dropdown needed - fixed item
            'display_order' => 1,
        ]);

        // Get Donner Wrap product
        $donnerWrap = Product::where('name', 'LIKE', '%Donner Wrap%')
            ->first();

        if ($donnerWrap) {
            MealDealSectionItem::create([
                'meal_deal_section_id' => $donnerWrapSection->id,
                'reference_type' => 'product',
                'reference_id' => $donnerWrap->id,
                'name_override' => '2 x Donner Wraps',
                'display_order' => 1,
            ]);
        }

        // Side Section - One dropdown
        $sideSection = MealDealSection::create([
            'meal_deal_id' => $mealDeal1->id,
            'name' => 'Side',
            'description' => 'Choose between chips or salad',
            'required' => true,
            'number_of_selections' => 1, // One dropdown
            'display_order' => 2,
        ]);

        $sides = OptionGroup::where('name', 'LIKE', '%Side%')
            ->first()->options;

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
            'meal_deal_id' => $mealDeal1->id,
            'name' => 'Sauce',
            'description' => 'Choose between chilli or garlic',
            'required' => true,
            'number_of_selections' => 1, // One dropdown
            'display_order' => 3,
        ]);

        $sauces = OptionGroup::where('name', 'LIKE', '%Sauce%')
            ->first()->options;

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
            'meal_deal_id' => $mealDeal1->id,
            'name' => 'Drinks',
            'description' => 'Choose 2 cans of pop',
            'required' => true,
            'number_of_selections' => 2, // Two dropdowns
            'display_order' => 4,
        ]);

        // Get can of pop product and its options
        $canOfPop = Product::where('name', 'Can of Pop')->first();
        if ($canOfPop) {
            // Get options for cans of pop
            $canOptions = \App\Models\OptionGroup::where('name', 'Can of Pop')->first()?->options;
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


        // Sauces Section - Two dropdowns for 2 sauces
        $extraSaucesSection = MealDealSection::create([
            'meal_deal_id' => $mealDeal1->id,
            'name' => 'Extra Sauces',
            'description' => 'Choose 2 sauces',
            'required' => true,
            'number_of_selections' => 2, // Two dropdowns
            'display_order' => 5,
        ]);

        // Get all dips/sauces
        $dipOptions = \App\Models\OptionGroup::where('name', 'Dips 4oz')->first()?->options;
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



    }
}
