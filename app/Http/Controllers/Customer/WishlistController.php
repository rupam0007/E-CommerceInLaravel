<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlistItems = Wishlist::with('product.category')
            ->where('user_id', Auth::id())
            ->get();

        return view('customer.wishlist.index', compact('wishlistItems'));
    }

    public function add(Product $product)
    {
        $exists = Wishlist::where('user_id', Auth::id())
            ->where('product_id', $product->id)
            ->exists();

        if (!$exists) {
            Wishlist::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id
            ]);
            
            return response()->json([
                'success' => true,
                'message' => 'Product added to wishlist!'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Product already in wishlist!'
        ]);
    }

    public function remove(Product $product)
    {
        $wishlistItem = Wishlist::where('user_id', Auth::id())
            ->where('product_id', $product->id)
            ->first();

        if ($wishlistItem) {
            $wishlistItem->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Product removed from wishlist!'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Product not found in wishlist!'
        ]);
    }

    public function toggle(Product $product)
    {
        $wishlistItem = Wishlist::where('user_id', Auth::id())
            ->where('product_id', $product->id)
            ->first();

        if ($wishlistItem) {
            $wishlistItem->delete();
            return response()->json([
                'success' => true,
                'action' => 'removed',
                'message' => 'Product removed from wishlist!'
            ]);
        } else {
            Wishlist::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id
            ]);
            
            return response()->json([
                'success' => true,
                'action' => 'added',
                'message' => 'Product added to wishlist!'
            ]);
        }
    }
}
