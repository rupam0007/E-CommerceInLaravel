<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['count', 'toggle']);
    }

    public function index()
    {
        $wishlistItems = Wishlist::with('product.category')
            ->where('user_id', Auth::id())
            ->get();
        return view('customer.wishlist.index', compact('wishlistItems'));
    }

    public function add(Product $product)
    {
        Wishlist::firstOrCreate([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
        ]);

        return back()->with('success', 'Product added to wishlist.');
    }

    public function remove(Product $product)
    {
        Wishlist::where('user_id', Auth::id())
            ->where('product_id', $product->id)
            ->delete();

        return back()->with('success', 'Product removed from wishlist.');
    }

    public function toggle(Product $product)
    {
        // Check authentication for AJAX requests
        if (!Auth::check()) {
            if (request()->wantsJson() || request()->ajax() || request()->header('Accept') === 'application/json') {
                return response()->json([
                    'success' => false,
                    'message' => 'Please login to manage wishlist.',
                    'redirect' => route('login')
                ], 401);
            }
            return redirect()->route('login')->with('error', 'Please login to manage wishlist.');
        }

        $wishlistItem = Wishlist::where('user_id', Auth::id())
            ->where('product_id', $product->id)
            ->first();

        if ($wishlistItem) {
            $wishlistItem->delete();
            $message = 'Product removed from wishlist.';
            $inWishlist = false;
        } else {
            Wishlist::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
            ]);
            $message = 'Product added to wishlist.';
            $inWishlist = true;
        }

        // Return JSON for AJAX requests
        if (request()->wantsJson() || request()->ajax()) {
            $count = Wishlist::where('user_id', Auth::id())->count();
            return response()->json([
                'success' => true,
                'message' => $message,
                'inWishlist' => $inWishlist,
                'count' => $count
            ]);
        }

        return back()->with('success', $message);
    }

    public function count()
    {
        $count = 0;
        if (Auth::check()) {
            $count = Wishlist::where('user_id', Auth::id())->count();
        }
        return response()->json(['count' => $count]);
    }
}