<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'category_id' => 2, // Burgers
                'name' => 'Beef Burger',
                'slug' => 'beef-burger',
                'description' => 'Premium beef patty with fresh vegetables and special sauce',
                'price' => 12.99,
                'image' => 'beef-burger.jpg',
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'category_id' => 2,
                'name' => 'Chicken Burger',
                'slug' => 'chicken-burger',
                'description' => 'Grilled chicken breast with lettuce and mayo',
                'price' => 10.99,
                'image' => 'chicken-burger.jpg',
                'is_active' => true,
                'is_featured' => false,
            ],
            [
                'category_id' => 1, // Pizza
                'name' => 'AL FUNGHI',
                'slug' => 'al-funghi',
                'description' => 'Mushroom pizza with truffle oil',
                'price' => 14.99,
                'image' => 'funghi-pizza.jpg',
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'category_id' => 3, // Garlic Bread
                'name' => 'Classic Garlic Bread',
                'slug' => 'classic-garlic-bread',
                'description' => 'Freshly baked bread with garlic butter',
                'price' => 4.99,
                'image' => 'garlic-bread.jpg',
                'is_active' => true,
                'is_featured' => false,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
