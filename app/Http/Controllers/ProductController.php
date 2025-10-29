<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category')->active();
        
        // Search functionality
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('description', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('sku', 'LIKE', "%{$searchTerm}%");
            });
        }
        
        // Category filter
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }
        
        // Price range filter
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }
        
        // Stock filter
        if ($request->filled('in_stock') && $request->in_stock) {
            $query->inStock();
        }
        
        // Sorting
        $sortBy = $request->get('sort', 'name');
        $sortOrder = $request->get('order', 'asc');
        
        switch ($sortBy) {
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
                $query->orderBy('name', $sortOrder);
                break;
        }
        
        $products = $query->paginate(12)->withQueryString();
        $categories = Category::active()->orderBy('name')->get();
        
        // Get price range for filters
        $priceRange = Product::active()->selectRaw('MIN(price) as min_price, MAX(price) as max_price')->first();
        
        // Return JSON response for AJAX requests
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'html' => view('customer.products.partials.products-grid', compact('products'))->render(),
                'pagination' => view('customer.products.partials.pagination', compact('products'))->render(),
                'count_info' => [
                    'first' => $products->firstItem() ?? 0,
                    'last' => $products->lastItem() ?? 0,
                    'total' => $products->total()
                ]
            ]);
        }
        
        return view('customer.products.index', compact('products', 'categories', 'priceRange'));
    }

    public function show(Product $product)
    {
        $product->load('category');
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->active()
            ->inStock()
            ->limit(4)
            ->get();

        return view('customer.products.show', compact('product', 'relatedProducts'));
    }

    public function byCategory(Category $category)
    {
        $products = Product::where('category_id', $category->id)
            ->active()
            ->inStock()
            ->paginate(12);

        return view('customer.products.category', compact('products', 'category'));
    }

    public function search(Request $request)
    {
        $query = $request->get('q');
        $products = Product::where('name', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->active()
            ->inStock()
            ->paginate(12);

        return view('customer.products.search', compact('products', 'query'));
    }
}
