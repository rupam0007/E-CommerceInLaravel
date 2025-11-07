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

    public function add(Request $request, Product $product)
    {
        $exists = Wishlist::where('user_id', Auth::id())
            ->where('product_id', $product->id)
            ->exists();

        if (!$exists) {
            Wishlist::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id
            ]);
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Product added to wishlist!'
                ]);
            }
            return back()->with('success', 'Product added to wishlist!');
        }

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => false,
                'message' => 'Product already in wishlist!'
            ]);
        }
        return back()->with('error', 'Product already in wishlist!');
    }

    public function remove(Request $request, Product $product)
    {
        $wishlistItem = Wishlist::where('user_id', Auth::id())
            ->where('product_id', $product->id)
            ->first();

        if ($wishlistItem) {
            $wishlistItem->delete();
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Product removed from wishlist!'
                ]);
            }
            return back()->with('success', 'Product removed from wishlist!');
        }

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found in wishlist!'
            ]);
        }
        return back()->with('error', 'Product not found in wishlist!');
    }

    public function toggle(Request $request, Product $product)
    {
        $wishlistItem = Wishlist::where('user_id', Auth::id())
            ->where('product_id', $product->id)
            ->first();

        if ($wishlistItem) {
            $wishlistItem->delete();
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => true,
                    'action' => 'removed',
                    'message' => 'Product removed from wishlist!'
                ]);
            }
            return back()->with('success', 'Product removed from wishlist!');
        } else {
            Wishlist::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id
            ]);
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => true,
                    'action' => 'added',
                    'message' => 'Product added to wishlist!'
                ]);
            }
            return back()->with('success', 'Product added to wishlist!');
        }
    }

    public function count(Request $request)
    {
        $userId = Auth::id();
        $count = $userId ? Wishlist::where('user_id', $userId)->count() : 0;
        return response()->json(['count' => $count]);
    }
}

