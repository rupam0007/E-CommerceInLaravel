<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::with('category')
            ->active()
            ->inStock()
            ->limit(8)
            ->get();

        $categories = Category::active()
            ->orderBy('sort_order')
            ->limit(6)
            ->get();

        return view('customer.home', compact('featuredProducts', 'categories'));
    }
}
