<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Pizza',
                'slug' => 'pizza',
                'image' => 'pizza-image.png',
                'display_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Garlic Bread',
                'slug' => 'garlic-bread',
                'image' => 'bread-image.png',
                'display_order' => 2,
                'is_active' => true,
            ],
            // [
            //     'name' => 'Stuffed Crust',
            //     'slug' => 'stuffed-crust',
            //     'image' => 'crust-image.png',
            //     'display_order' => 3,
            //     'is_active' => true,
            // ],
            [
                'name' => 'Kebabs',
                'slug' => 'kebabs',
                'image' => 'kebab-image.png',
                'display_order' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'Wraps',
                'slug' => 'wraps',
                'image' => 'wrap-image.png',
                'display_order' => 5,
                'is_active' => true,
            ],
            [
                'name' => 'Mexican',
                'slug' => 'mexican',
                'image' => 'mexican-image.png',
                'display_order' => 6,
                'is_active' => true,
            ],
            [
                'name' => 'Fish & Chips',
                'slug' => 'fish-and-chips',
                'image' => 'fish-image.png',
                'display_order' => 7,
                'is_active' => true,
            ],
            [
                'name' => 'Burgers',
                'slug' => 'burgers',
                'image' => 'burger-image.png',
                'display_order' => 8,
                'is_active' => true,
            ],
            [
                'name' => 'Parmesan',
                'slug' => 'parmesan',
                'image' => 'parmesan-image.png',
                'display_order' => 9,
                'is_active' => true,
            ],
            [
                'name' => 'Nachos',
                'slug' => 'nachos',
                'image' => 'nachos-image.png',
                'display_order' => 10,
                'is_active' => true,
            ],
            [
                'name' => 'Sundries',
                'slug' => 'sundries',
                'image' => 'sundries-image.png',
                'display_order' => 11,
                'is_active' => true,
            ],
            [
                'name' => 'Dips',
                'slug' => 'dips',
                'image' => 'dips-image.png',
                'display_order' => 12,
                'is_active' => true,
            ],
            [
                'name' => 'Drinks',
                'slug' => 'drinks',
                'image' => 'drinks-image.png',
                'display_order' => 13,
                'is_active' => true,
            ],
            [
                'name' => 'Desserts',
                'slug' => 'desserts',
                'image' => 'desserts-image.png',
                'display_order' => 14,
                'is_active' => true,
            ],
            [
                'name' => 'Kids Meals',
                'slug' => 'kids-meals',
                'image' => 'kids-image.png',
                'display_order' => 15,
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
