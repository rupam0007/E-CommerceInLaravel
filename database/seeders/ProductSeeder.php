<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'Mobile',
                'description' => 'Latest mobile with advanced features and long battery life.',
                'price' => 599.99,
                'stock_quantity' => 30,
                'category_id' => 1,
                'is_active' => true,
                'sku' => 'MOB-001',
                'weight' => 0.2
            ],
            [
                'name' => 'Laptop',
                'description' => 'High-performance laptop for work and gaming.',
                'price' => 999.99,
                'stock_quantity' => 20,
                'category_id' => 1,
                'is_active' => true,
                'sku' => 'LAP-001',
                'weight' => 1.5
            ],
            [
                'name' => 'Watch',
                'description' => 'Stylish smart watch with health tracking features.',
                'price' => 149.99,
                'stock_quantity' => 50,
                'category_id' => 1,
                'is_active' => true,
                'sku' => 'WAT-001',
                'weight' => 0.1
            ],
            [
                'name' => 'Wireless Bluetooth Headphones',
                'description' => 'High-quality wireless headphones with noise cancellation.',
                'price' => 99.99,
                'stock_quantity' => 50,
                'category_id' => 1,
                'is_active' => true,
                'sku' => 'WBH-001',
                'weight' => 0.3
            ],
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
            \App\Models\Product::firstOrCreate(['sku' => $product['sku']], $product);
        }
    }
}