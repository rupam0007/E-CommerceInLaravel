<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $categoryMap = Category::pluck('id', 'name');

        $products = [
            [
                'name' => 'Aurora Pro Smartphone',
                'description' => 'Flagship 6.5" OLED display, triple-lens camera system, and all-day battery built for creators and power users alike.',
                'price' => 749.00,
                'stock_quantity' => 35,
                'category' => 'Electronics',
                'image' => 'https://images.unsplash.com/photo-1510557880182-3f8c5f87b257?auto=format&fit=crop&w=800&q=80',
                'is_active' => true,
                'sku' => 'ELE-AURORA-PRO',
                'weight' => 0.19,
                'dimensions' => '158 x 74 x 7.5 mm'
            ],
            [
                'name' => 'Nimbus X Ultrabook',
                'description' => 'Ultra-portable 14" laptop with the latest generation processors, 16GB RAM, and a studio-grade display for remote professionals.',
                'price' => 1299.00,
                'stock_quantity' => 20,
                'category' => 'Electronics',
                'image' => 'https://images.unsplash.com/photo-1517336714731-489689fd1ca8?auto=format&fit=crop&w=800&q=80',
                'is_active' => true,
                'sku' => 'ELE-NIMBUS-X',
                'weight' => 1.32,
                'dimensions' => '313 x 221 x 14 mm'
            ],
            [
                'name' => 'PulseFit Smartwatch',
                'description' => 'Track workouts, heart rate, and sleep cycles with a premium stainless-steel watch that lasts 7 days on one charge.',
                'price' => 229.00,
                'stock_quantity' => 50,
                'category' => 'Electronics',
                'image' => 'https://images.unsplash.com/photo-1511732352360-771a87e3752d?auto=format&fit=crop&w=800&q=80',
                'is_active' => true,
                'sku' => 'ELE-PULSEFIT',
                'weight' => 0.09,
                'dimensions' => '44 mm case'
            ],
            [
                'name' => 'Aether Noise-Canceling Headphones',
                'description' => 'Immersive over-ear headphones with adaptive noise cancellation and 30-hour battery life for deep focus.',
                'price' => 199.00,
                'stock_quantity' => 45,
                'category' => 'Electronics',
                'image' => 'https://images.unsplash.com/photo-1511379938547-c1f69419868d?auto=format&fit=crop&w=800&q=80',
                'is_active' => true,
                'sku' => 'ELE-AETHER-NC',
                'weight' => 0.28,
                'dimensions' => '195 x 170 x 80 mm'
            ],
            [
                'name' => 'Selene Denim Jacket',
                'description' => 'Classic indigo denim with modern tailoring, soft stretch lining, and sustainable cotton construction.',
                'price' => 89.00,
                'stock_quantity' => 60,
                'category' => 'Clothing',
                'image' => 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?auto=format&fit=crop&w=800&q=80',
                'is_active' => true,
                'sku' => 'CLT-SELENE-DENIM',
                'weight' => 0.65,
                'dimensions' => 'Folded 40 x 30 x 6 cm'
            ],
            [
                'name' => 'EverSoft Cotton Tee',
                'description' => 'Lightweight crew-neck tee crafted from organic cotton with a relaxed drape for everyday layering.',
                'price' => 24.00,
                'stock_quantity' => 120,
                'category' => 'Clothing',
                'image' => 'https://images.unsplash.com/photo-1523381210434-271e8be1f52b?auto=format&fit=crop&w=800&q=80',
                'is_active' => true,
                'sku' => 'CLT-EVERSOFT-TEE',
                'weight' => 0.22,
                'dimensions' => 'Folded 34 x 28 x 2 cm'
            ],
            [
                'name' => 'BrewMaster Drip Coffee Maker',
                'description' => 'Programmable brewer with thermal carafe, bloom pre-infusion, and reusable stainless filter for perfect mornings.',
                'price' => 159.00,
                'stock_quantity' => 25,
                'category' => 'Home & Garden',
                'image' => 'https://images.unsplash.com/photo-1541167760496-1628856ab772?auto=format&fit=crop&w=800&q=80',
                'is_active' => true,
                'sku' => 'HOME-BREWMASTER',
                'weight' => 2.8,
                'dimensions' => '225 x 200 x 360 mm'
            ],
            [
                'name' => 'Verdant Garden Tool Kit',
                'description' => 'Complete 10-piece carbon-steel gardening set with ergonomic grips and weatherproof storage tote.',
                'price' => 69.00,
                'stock_quantity' => 32,
                'category' => 'Home & Garden',
                'image' => 'https://images.unsplash.com/photo-1466692476868-aef1dfb1e735?auto=format&fit=crop&w=800&q=80',
                'is_active' => true,
                'sku' => 'HOME-VERDANT-KIT',
                'weight' => 3.4,
                'dimensions' => '48 x 22 x 18 cm'
            ],
            [
                'name' => 'LumaFlex Yoga Mat',
                'description' => '4.5mm cushioned, non-slip surface with alignment guides designed to stay grounded through intense sessions.',
                'price' => 54.00,
                'stock_quantity' => 70,
                'category' => 'Sports & Outdoors',
                'image' => 'https://images.unsplash.com/photo-1605296867304-46d5465a13f1?auto=format&fit=crop&w=800&q=80',
                'is_active' => true,
                'sku' => 'SPRT-LUMAFLEX',
                'weight' => 1.4,
                'dimensions' => '183 x 66 x 0.45 cm'
            ],
            [
                'name' => 'Velocity Knit Running Shoes',
                'description' => 'Responsive foam cushioning, breathable knit upper, and reflective accents built for daily miles.',
                'price' => 139.00,
                'stock_quantity' => 48,
                'category' => 'Sports & Outdoors',
                'image' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=800&q=80',
                'is_active' => true,
                'sku' => 'SPRT-VELOCITY',
                'weight' => 0.78,
                'dimensions' => 'Boxed 32 x 21 x 12 cm'
            ],
            [
                'name' => 'Eclipse Wireless Speaker',
                'description' => '360° immersive sound with smart assistant support and 18-hour playback in a minimalist design.',
                'price' => 189.00,
                'stock_quantity' => 40,
                'category' => 'Electronics',
                'image' => 'https://images.unsplash.com/photo-1512446733611-9099a758e0f1?auto=format&fit=crop&w=800&q=80',
                'is_active' => true,
                'sku' => 'ELE-ECLIPSE-SPKR',
                'weight' => 1.1,
                'dimensions' => '170 x 170 x 230 mm'
            ],
            [
                'name' => 'Horizon Leather Weekender',
                'description' => 'Handcrafted full-grain leather duffel with organized interior pockets for effortless travel style.',
                'price' => 289.00,
                'stock_quantity' => 18,
                'category' => 'Clothing',
                'image' => 'https://images.unsplash.com/photo-1518544889280-59ccb743eb1a?auto=format&fit=crop&w=800&q=80',
                'is_active' => true,
                'sku' => 'CLT-HORIZON-BAG',
                'weight' => 1.9,
                'dimensions' => '55 x 28 x 25 cm'
            ],
        ];

        foreach ($products as $payload) {
            $categoryName = $payload['category'] ?? null;
            $categoryId = $categoryName ? ($categoryMap[$categoryName] ?? null) : null;

            if (!$categoryId) {
                continue;
            }

            $data = collect($payload)
                ->except('category')
                ->merge(['category_id' => $categoryId])
                ->toArray();

            Product::updateOrCreate(
                ['sku' => $data['sku']],
                $data
            );
        }
    }
}