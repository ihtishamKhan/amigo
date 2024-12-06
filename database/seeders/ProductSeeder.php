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
                'image' => '9bd653c8d7a9bc9cf0b9d3cae6b30d4d.png',
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'category_id' => 2,
                'name' => 'Chicken Burger',
                'slug' => 'chicken-burger',
                'description' => 'Grilled chicken breast with lettuce and mayo',
                'price' => 10.99,
                'image' => '9d1efcc469f881493437c3a20f2b2ea3.png',
                'is_active' => true,
                'is_featured' => false,
            ],
            [
                'category_id' => 1, // Pizza
                'name' => 'AL FUNGHI',
                'slug' => 'al-funghi',
                'description' => 'Mushroom pizza with truffle oil',
                'price' => 14.99,
                'image' => '25f2e4c54cd49303e7e7576fb87719ec.png',
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'category_id' => 3, // Garlic Bread
                'name' => 'Classic Garlic Bread',
                'slug' => 'classic-garlic-bread',
                'description' => 'Freshly baked bread with garlic butter',
                'price' => 4.99,
                'image' => '796b7434248619a652fe538dfbcc2302.png',
                'is_active' => true,
                'is_featured' => false,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
