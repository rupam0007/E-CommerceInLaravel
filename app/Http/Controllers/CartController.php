<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    public function index()
    {
        $cartItems = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        $total = $cartItems->sum('total');

        return view('customer.cart.index', compact('cartItems', 'total'));
    }

    public function add(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:' . $product->stock_quantity
        ]);

        $quantity = $request->quantity;
        
        // Check if product is already in cart
        $cartItem = Cart::where('user_id', Auth::id())
            ->where('product_id', $product->id)
            ->first();

        if ($cartItem) {
            // Update existing cart item
            $newQuantity = $cartItem->quantity + $quantity;
            if ($newQuantity > $product->stock_quantity) {
                return redirect()->back()->with('error', 'The requested quantity exceeds available stock.');
            }
            
            $cartItem->quantity = $newQuantity;
            $cartItem->total = $product->price * $newQuantity;
            $cartItem->save();
        } else {
            // Create new cart item
            if ($quantity > $product->stock_quantity) {
                return redirect()->back()->with('error', 'The requested quantity exceeds available stock.');
            }
            
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'quantity' => $quantity,
                'price' => $product->price,
                'total' => $product->price * $quantity
            ]);
        }

        return redirect()->back()->with('success', 'Product added to cart!');
    }

    public function update(Request $request, Cart $cart)
    {
        // Check if cart belongs to current user
        if ($cart->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'quantity' => 'required|integer|min:1|max:' . $cart->product->stock_quantity
        ]);

        $cart->update([
            'quantity' => $request->quantity,
            'total' => $cart->price * $request->quantity
        ]);

        return redirect()->back()->with('success', 'Cart updated!');
    }

    public function remove(Cart $cart)
    {
        // Check if cart belongs to current user
        if ($cart->user_id !== Auth::id()) {
            abort(403);
        }
        
        $cart->delete();

        return redirect()->back()->with('success', 'Item removed from cart!');
    }

    public function clear()
    {
        Cart::where('user_id', Auth::id())->delete();

        return redirect()->back()->with('success', 'Cart cleared!');
    }
}
