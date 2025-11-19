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
        $this->middleware('auth');
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
        $request->validate(['quantity' => 'required|integer|min:1']);
        $userId = Auth::id();

        if ($product->stock_quantity < $request->quantity) {
            if ($request->ajax()) {
                return response()->json(['message' => 'Not enough stock available.'], 422);
            }
            return redirect()->back()->with('error', 'Not enough stock available.');
        }

        $cartItem = Cart::where('user_id', $userId)
                        ->where('product_id', $product->id)
                        ->first();

        if ($cartItem) {
            $newQuantity = $cartItem->quantity + $request->quantity;
            if ($product->stock_quantity < $newQuantity) {
                 if ($request->ajax()) {
                    return response()->json(['message' => 'Not enough stock available for this quantity.'], 422);
                 }
                return redirect()->back()->with('error', 'Not enough stock available for this quantity.');
            }
            $cartItem->update(['quantity' => $newQuantity]);
        } else {
            Cart::create([
                'user_id' => $userId,
                'product_id' => $product->id,
                'quantity' => $request->quantity,
                'price' => $product->price 
            ]);
        }

        if ($request->ajax()) {
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