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

class MealDealFamilyOfferSeeder extends Seeder
{
    public function run(): void
    {
        // Create Family Offer
        $mealDeal = MealDeal::create([
            'name' => 'Family Offer',
            'description' => 'Any 10" Pizza, Any 12" Pizza, Donner Kebab with Salad, 2 Sauces, Chips & Bottle of Pop',
            'price' => 25.90,
            'image' => 'meal-deals/family-offer.jpg',
            'is_active' => true,
        ]);

        // 10" Pizza Section - One dropdown
        $tenInchPizzaSection = MealDealSection::create([
            'meal_deal_id' => $mealDeal->id,
            'name' => '10" Pizza',
            'description' => 'Choose any 10" pizza',
            'required' => true,
            'number_of_selections' => 1,
            'display_order' => 1,
        ]);

        // Get all 10" pizzas
        $pizzaProducts = Product::where('category_id', 1)->get();
        foreach ($pizzaProducts as $index => $pizza) {
            $tenInchVariation = $pizza->variations()->where('name', '10"')->first();
            if ($tenInchVariation) {
                MealDealSectionItem::create([
                    'meal_deal_section_id' => $tenInchPizzaSection->id,
                    'reference_type' => 'variation',
                    'reference_id' => $tenInchVariation->id,
                    'display_order' => $index + 1,
                ]);
            }
        }

        // 12" Pizza Section - One dropdown
        $twelveInchPizzaSection = MealDealSection::create([
            'meal_deal_id' => $mealDeal->id,
            'name' => '12" Pizza',
            'description' => 'Choose any 12" pizza',
            'required' => true,
            'number_of_selections' => 1,
            'display_order' => 2,
        ]);

        // Get all 12" pizzas
        foreach ($pizzaProducts as $index => $pizza) {
            $twelveInchVariation = $pizza->variations()->where('name', '12"')->first();
            if ($twelveInchVariation) {
                MealDealSectionItem::create([
                    'meal_deal_section_id' => $twelveInchPizzaSection->id,
                    'reference_type' => 'variation',
                    'reference_id' => $twelveInchVariation->id,
                    'display_order' => $index + 1,
                ]);
            }
        }

        // Donner Kebab Section - Fixed item
        $kebabSection = MealDealSection::create([
            'meal_deal_id' => $mealDeal->id,
            'name' => 'Donner Kebab',
            'description' => 'Donner Kebab with Salad included',
            'required' => true,
            'number_of_selections' => 0, // No dropdown needed - fixed item
            'display_order' => 3,
        ]);

        // Get Donner Kebab product
        $donnerKebab = Product::where('name', 'LIKE', '%DONNER KEBAB%')->first();
        if ($donnerKebab) {
            MealDealSectionItem::create([
                'meal_deal_section_id' => $kebabSection->id,
                'reference_type' => 'product',
                'reference_id' => $donnerKebab->id,
                'name_override' => 'Donner Kebab with Salad',
                'display_order' => 1,
            ]);
        }

        // Chips Section - Fixed item
        // $chipsSection = MealDealSection::create([
        //     'meal_deal_id' => $mealDeal->id,
        //     'name' => 'Chips',
        //     'description' => 'Portion of chips included',
        //     'required' => true,
        //     'number_of_selections' => 0, // No dropdown needed - fixed item
        //     'display_order' => 4,
        // ]);

        // // Get Chips product
        // $chips = Product::where('name', 'LIKE', '%CHIPS%')->first();
        // if ($chips) {
        //     MealDealSectionItem::create([
        //         'meal_deal_section_id' => $chipsSection->id,
        //         'reference_type' => 'product',
        //         'reference_id' => $chips->id,
        //         'display_order' => 1,
        //     ]);
        // }

        // Sauces Section - Two dropdowns for 2 sauces
        $saucesSection = MealDealSection::create([
            'meal_deal_id' => $mealDeal->id,
            'name' => 'Sauces',
            'description' => 'Choose 2 sauces',
            'required' => true,
            'number_of_selections' => 2,
            'display_order' => 5,
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

        // Drinks Section - One dropdown for bottle
        $drinksSection = MealDealSection::create([
            'meal_deal_id' => $mealDeal->id,
            'name' => 'Drink',
            'description' => 'Choose a bottle of pop',
            'required' => true,
            'number_of_selections' => 1,
            'display_order' => 6,
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