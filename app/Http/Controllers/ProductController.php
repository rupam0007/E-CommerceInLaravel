<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = Category::all();

        // Base query
        $query = Product::query()->with('category');

        // Apply filters
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }
        
        if ($request->has('in_stock')) {
            $query->where('stock_quantity', '>', 0);
        }

        // Apply sorting
        $sort = $request->get('sort', 'name');
        switch ($sort) {
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            case 'newest':
                $query->orderBy('created_at', 'desc');
                break;
            case 'name':
            default:
                $query->orderBy('name', 'asc');
                break;
        }

        // Paginate
        $products = $query->paginate(9);
        
        // Handle AJAX requests
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'html' => view('customer.products.partials.products-grid', compact('products'))->render(),
                'pagination' => view('customer.products.partials.pagination', compact('products'))->render(),
                'count_info' => [
                    'first' => $products->firstItem(),
                    'last'  => $products->lastItem(),
                    'total' => $products->total(),
                ]
            ]);
        }
        
        // Return full page
        return view('customer.products.index', compact('products', 'categories'));
    }
    
    // --- START: NAYA FUNCTION ADD KIYA ---
    /**
     * Display all categories.
     */
    public function showAllCategories()
    {
        $categories = Category::all();
        return view('customer.categories.index', compact('categories'));
    }
    // --- END: NAYA FUNCTION ---

    /**
     * Display products by category.
     */
    public function showCategory(Category $category)
    {
        // Category se related products fetch karein
        $products = $category->products()->with('category')->paginate(9);
        // Doosri categories bhi fetch karein (filter sidebar ke liye)
        $categories = Category::all();
        
        // Product list wala view hi istemal karein
        return view('customer.products.index', compact('products', 'categories'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        // N+1 fix: Category ko pehle hi load kar lein
        $product->load('category');

        // N+1 fix: Related products ke liye bhi category load karein
        $relatedProducts = Product::with('category')
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->limit(4)
            ->get();

        return view('customer.products.show', compact('product', 'relatedProducts'));
    }
}