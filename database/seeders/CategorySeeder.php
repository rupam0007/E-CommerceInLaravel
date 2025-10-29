<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Electronics',
                'description' => 'Latest gadgets and electronic devices',
                'is_active' => true,
                'sort_order' => 1
            ],
            [
                'name' => 'Clothing',
                'description' => 'Fashion and apparel for all occasions',
                'is_active' => true,
                'sort_order' => 2
            ],
            [
                'name' => 'Home & Garden',
                'description' => 'Everything for your home and garden',
                'is_active' => true,
                'sort_order' => 3
            ],
            [
                'name' => 'Sports & Outdoors',
                'description' => 'Sports equipment and outdoor gear',
                'is_active' => true,
                'sort_order' => 4
            ],
            [
                'name' => 'Books',
                'description' => 'Books, magazines, and educational materials',
                'is_active' => true,
                'sort_order' => 5
            ],
            [
                'name' => 'Health & Beauty',
                'description' => 'Health, beauty, and personal care products',
                'is_active' => true,
                'sort_order' => 6
            ]
        ];

        foreach ($categories as $category) {
            \App\Models\Category::create($category);
        }
    }
}
