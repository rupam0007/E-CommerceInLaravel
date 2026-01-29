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
        // Featured products - random selection for variety
        $featuredProducts = Product::with(['category', 'reviews'])
            ->withAvg('reviews', 'rating')
            ->inRandomOrder()
            ->limit(8)
            ->get();

        // New arrivals - latest products
        $newArrivals = Product::with(['category', 'reviews'])
            ->withAvg('reviews', 'rating')
            ->orderBy('created_at', 'desc')
            ->limit(4)
            ->get();

        $categories = Category::all();

        return view('customer.home', compact('featuredProducts', 'newArrivals', 'categories'));
    }
}
