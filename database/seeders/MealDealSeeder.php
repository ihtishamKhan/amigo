<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MealDeal;

class MealDealSeeder extends Seeder
{
    public function run(): void
    {
        $mealDeals = [
            [
                'name' => 'Family Feast',
                'slug' => 'family-feast',
                'description' => 'Perfect for family gathering - 2 Large Pizzas, 4 Drinks, and Garlic Bread',
                'price' => 39.99,
                'image' => '463db2e8bfbfb7935547d43c63320fca.png',
                'is_active' => true,
                'is_featured' => true,
                'products' => [
                    ['id' => 1, 'quantity' => 2], // 2 Large Pizzas
                    ['id' => 3, 'quantity' => 4], // 4 Drinks
                    ['id' => 4, 'quantity' => 1], // 1 Garlic Bread
                ]
            ],
            [
                'name' => 'Couple Combo',
                'slug' => 'couple-combo',
                'description' => 'Perfect for two - 1 Medium Pizza, 2 Drinks, and Fries',
                'price' => 24.99,
                'image' => '889c4bb6e53246aa0c1589882ab3cbd8.png',
                'is_active' => true,
                'is_featured' => true,
                'products' => [
                    ['id' => 2, 'quantity' => 1], // 1 Medium Pizza
                    ['id' => 3, 'quantity' => 2], // 2 Drinks
                    ['id' => 4, 'quantity' => 1], // 1 Fries
                ]
            ]
        ];

        foreach ($mealDeals as $deal) {
            $products = $deal['products'];
            unset($deal['products']);
            
            $mealDeal = MealDeal::create($deal);
            
            foreach ($products as $product) {
                $mealDeal->products()->attach($product['id'], [
                    'quantity' => $product['quantity']
                ]);
            }
        }
    }
}
