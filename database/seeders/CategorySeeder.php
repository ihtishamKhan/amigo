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
                'icon' => 'pizza-icon.png',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Burgers',
                'slug' => 'burgers',
                'icon' => 'burger-icon.png',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Garlic Bread',
                'slug' => 'garlic-bread',
                'icon' => 'bread-icon.png',
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'Sides',
                'slug' => 'sides',
                'icon' => 'sides-icon.png',
                'is_active' => true,
                'sort_order' => 4,
            ],
            [
                'name' => 'Drinks',
                'slug' => 'drinks',
                'icon' => 'drinks-icon.png',
                'is_active' => true,
                'sort_order' => 5,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
