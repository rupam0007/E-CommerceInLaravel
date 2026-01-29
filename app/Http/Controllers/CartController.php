<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['count', 'add']);
    }

    private function getCartData($userId)
    {
        $cartItems = Cart::with('product')
            ->where('user_id', $userId)
            ->get();
            
        $subtotal = $cartItems->sum(fn($item) => $item->price * $item->quantity);
        $count = $cartItems->sum('quantity');

        return compact('cartItems', 'subtotal', 'count');
    }

    public function index()
    {
        $data = $this->getCartData(Auth::id());

        return view('customer.cart.index', [
            'cartItems' => $data['cartItems'],
            'subtotal' => $data['subtotal']
        ]);
    }

    public function add(Request $request, Product $product)
    {
        // Check if user is authenticated for AJAX requests
        if (!Auth::check()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please login to add items to cart.',
                    'redirect' => route('login')
                ], 401);
            }
            return redirect()->route('login')->with('error', 'Please login to add items to cart.');
        }

        // For AJAX requests, manually validate and return JSON on failure
        $isAjax = $request->ajax() || $request->wantsJson() || $request->header('Accept') === 'application/json';
        
        if ($isAjax) {
            $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
                'quantity' => 'required|integer|min:1'
            ]);
            
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors()->first()
                ], 422);
            }
        } else {
            $request->validate(['quantity' => 'required|integer|min:1']);
        }
        
        $userId = Auth::id();

        if ($product->stock_quantity < $request->quantity) {
            if ($isAjax) {
                return response()->json(['success' => false, 'message' => 'Not enough stock available.'], 422);
            }
            return redirect()->back()->with('error', 'Not enough stock available.');
        }

        $cartItem = Cart::where('user_id', $userId)
                        ->where('product_id', $product->id)
                        ->first();

        if ($cartItem) {
            $newQuantity = $cartItem->quantity + $request->quantity;
            if ($product->stock_quantity < $newQuantity) {
                 if ($isAjax) {
                    return response()->json(['success' => false, 'message' => 'Not enough stock available for this quantity.'], 422);
                 }
                return redirect()->back()->with('error', 'Not enough stock available for this quantity.');
            }
            $cartItem->update(['quantity' => $newQuantity]);
        } else {
            Cart::create([
                'user_id' => $userId,
                'product_id' => $product->id,
                'quantity' => $request->quantity,
                'price' => $product->final_price 
            ]);
        }

        if ($isAjax) {
            $data = $this->getCartData($userId);
            return response()->json([
                'success' => true,
                'message' => 'Product added to cart successfully!',
                'subtotal' => $data['subtotal'],
                'cartCount' => $data['count']
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Product added to cart!');
    }

    public function update(Request $request, Cart $cart)
    {
        $request->validate(['quantity' => 'required|integer|min:1']);

        if ($cart->product->stock_quantity < $request->quantity) {
             if ($request->ajax()) {
                return response()->json(['message' => 'Not enough stock available.'], 422);
            }
            return redirect()->back()->with('error', 'Not enough stock available.');
        }

        $cart->update(['quantity' => $request->quantity]);
        
        if ($request->ajax()) {
            $data = $this->getCartData(Auth::id());
            return response()->json([
                'success' => true,
                'message' => 'Cart updated successfully!',
                'subtotal' => $data['subtotal'],
                'cartCount' => $data['count']
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Cart updated successfully!');
    }

    public function remove(Request $request, Cart $cart)
    {
        $cart->delete();
        
        if ($request->ajax()) {
            $data = $this->getCartData(Auth::id());
            return response()->json([
                'success' => true,
                'message' => 'Product removed from cart!',
                'subtotal' => $data['subtotal'],
                'cartCount' => $data['count']
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Product removed from cart!');
    }

    public function clear(Request $request)
    {
        $userId = Auth::id();
        Cart::where('user_id', $userId)->delete();

        if ($request->ajax()) {
            $data = $this->getCartData($userId);
            return response()->json([
                'success' => true,
                'message' => 'Cart cleared successfully!',
                'subtotal' => $data['subtotal'],
                'cartCount' => $data['count']
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Cart cleared successfully!');
    }

    public function count()
    {
        $count = 0;
        if (Auth::check()) {
            $count = Cart::where('user_id', Auth::id())->sum('quantity');
        }
        return response()->json(['count' => $count]);
    }
}