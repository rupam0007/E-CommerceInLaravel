<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     */
    public function index()
    {
        // --- START: FIX ---
        // 'is_featured' ki jagah, hum random products dikhayenge
        // Taki naye demo products homepage par dikhein
        $featuredProducts = Product::with('category')
            ->inRandomOrder()
            ->limit(8)
            ->get();
        // --- END: FIX ---

        $categories = Category::limit(3)->get();

        return view('customer.home', compact('featuredProducts', 'categories'));
    }
}
