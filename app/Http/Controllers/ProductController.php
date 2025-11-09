<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        $query = Product::query()->with('category');

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

        $products = $query->paginate(9);

        $pageTitle = "All Products";
        $pageDescription = "Discover our amazing collection";
        $currentCategory = null;

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

        return view('customer.products.index', compact(
            'products',
            'categories',
            'pageTitle',
            'pageDescription',
            'currentCategory'
        ));
    }

    public function showAllCategories()
    {
        $categories = Category::all();
        return view('customer.categories.index', compact('categories'));
    }

    public function showCategory(Category $category)
    {
        $products = $category->products()->with('category')->paginate(9);
        $categories = Category::all();

        $pageTitle = $category->name;
        $pageDescription = $category->description ?? "Products in the {$category->name} category";
        $currentCategory = $category;

        return view('customer.products.index', compact(
            'products',
            'categories',
            'pageTitle',
            'pageDescription',
            'currentCategory'
        ));
    }

    public function show(Product $product)
    {
        $product->load('category');

        $relatedProducts = Product::with('category')
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->limit(4)
            ->get();

        return view('customer.products.show', compact('product', 'relatedProducts'));
    }
}
