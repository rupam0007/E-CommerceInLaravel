<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            // Electronics
            [
                'name' => 'Wireless Bluetooth Headphones',
                'description' => 'High-quality wireless headphones with noise cancellation and 30-hour battery life.',
                'price' => 99.99,
                'stock_quantity' => 50,
                'category_id' => 1,
                'is_active' => true,
                'sku' => 'WBH-001',
                'weight' => 0.3
            ],
            [
                'name' => 'Smartphone 128GB',
                'description' => 'Latest smartphone with advanced camera system and fast processor.',
                'price' => 699.99,
                'stock_quantity' => 25,
                'category_id' => 1,
                'is_active' => true,
                'sku' => 'SP-128-001',
                'weight' => 0.2
            ],
            // Clothing
            [
                'name' => 'Cotton T-Shirt',
                'description' => 'Comfortable 100% cotton t-shirt available in multiple colors.',
                'price' => 19.99,
                'stock_quantity' => 100,
                'category_id' => 2,
                'is_active' => true,
                'sku' => 'CT-001',
                'weight' => 0.2
            ],
            [
                'name' => 'Denim Jeans',
                'description' => 'Classic fit denim jeans made from premium quality fabric.',
                'price' => 59.99,
                'stock_quantity' => 75,
                'category_id' => 2,
                'is_active' => true,
                'sku' => 'DJ-001',
                'weight' => 0.6
            ],
            // Home & Garden
            [
                'name' => 'Coffee Maker',
                'description' => 'Programmable coffee maker with 12-cup capacity and auto-shutoff.',
                'price' => 79.99,
                'stock_quantity' => 30,
                'category_id' => 3,
                'is_active' => true,
                'sku' => 'CM-001',
                'weight' => 2.5
            ],
            [
                'name' => 'Garden Tool Set',
                'description' => 'Complete 10-piece garden tool set with carrying case.',
                'price' => 49.99,
                'stock_quantity' => 40,
                'category_id' => 3,
                'is_active' => true,
                'sku' => 'GTS-001',
                'weight' => 3.0
            ],
            // Sports & Outdoors
            [
                'name' => 'Yoga Mat',
                'description' => 'Non-slip yoga mat with extra cushioning for comfort.',
                'price' => 29.99,
                'stock_quantity' => 60,
                'category_id' => 4,
                'is_active' => true,
                'sku' => 'YM-001',
                'weight' => 1.2
            ],
            [
                'name' => 'Running Shoes',
                'description' => 'Lightweight running shoes with advanced cushioning technology.',
                'price' => 129.99,
                'stock_quantity' => 45,
                'category_id' => 4,
                'is_active' => true,
                'sku' => 'RS-001',
                'weight' => 0.8
            ]
        ];

        foreach ($products as $product) {
            \App\Models\Product::create($product);
        }
    }
}
