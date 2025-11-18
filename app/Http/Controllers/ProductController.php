<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::active()->withAvg('reviews', 'rating');

        // Initialize currentCategory as null for the main listing page
        $currentCategory = null;

        if ($request->has('category')) {
            $category = Category::where('id', $request->category)->first();
            if ($category) {
                $query->where('category_id', $category->id);
                // If filtered by ID via query string, you might want to set it here, 
                // but for the dropdown logic to work with the loop variable $currentCategory ?? null is safer.
                $currentCategory = $category; 
            }
        }

        if ($request->has('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%");
        }

        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'price_asc':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('price', 'desc');
                    break;
                case 'newest':
                    $query->latest();
                    break;
            }
        }

        $products = $query->paginate(12);
        $categories = Category::where('is_active', true)->get();

        $pageTitle = 'All Products';
        $pageDescription = 'Browse our extensive collection of premium products.';

        // Pass currentCategory explicitly
        return view('customer.products.index', compact('products', 'categories', 'pageTitle', 'pageDescription', 'currentCategory'));
    }

    public function show(Product $product)
    {
        $product->load(['category', 'reviews.user']);
        $product->loadAvg('reviews', 'rating');
        $product->loadCount('reviews');
        
        $relatedProducts = Product::active()
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->withAvg('reviews', 'rating')
            ->limit(4)
            ->get();

        return view('customer.products.show', compact('product', 'relatedProducts'));
    }

    public function showCategory(Category $category)
    {
        $products = $category->products()
            ->active()
            ->withAvg('reviews', 'rating')
            ->paginate(12);
            
        return view('customer.products.index', [
            'products' => $products,
            'categories' => Category::where('is_active', true)->get(),
            'currentCategory' => $category, // This was already correct
            'pageTitle' => $category->name,
            'pageDescription' => $category->description ?? 'Explore products in ' . $category->name
        ]);
    }

    public function showAllCategories()
    {
        $categories = Category::where('is_active', true)->get();
        return view('customer.categories.index', compact('categories'));
    }
}