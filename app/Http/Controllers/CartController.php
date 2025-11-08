<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * --- START FIX ---
     * Yeh function har function se pehle 'auth' middleware (login check) ko apply karega.
     * Ab agar koi guest cart access karne ki koshish karega, toh woh seedha login page par redirect ho jayega.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    // --- END FIX ---

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cartItems = Cart::with('product.category') // Eager load product and category
            ->where('user_id', Auth::id())
            ->get();

        $subtotal = $cartItems->sum('total');
        $shipping = $subtotal > 100 ? 0 : 10;
        $tax = $subtotal * 0.08;
        $total = $subtotal + $shipping + $tax;

        return view('customer.cart.index', compact('cartItems', 'subtotal', 'shipping', 'tax', 'total'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function add(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:' . $product->stock_quantity,
        ]);

        $cartItem = Cart::where('user_id', Auth::id())
            ->where('product_id', $product->id)
            ->first();

        $quantity = $request->input('quantity');

        if ($cartItem) {
            // Update quantity
            $newQuantity = $cartItem->quantity + $quantity;
            if ($newQuantity > $product->stock_quantity) {
                return back()->with('error', 'Cannot add more. Product stock limit reached.');
            }
            $cartItem->quantity = $newQuantity;
            $cartItem->total = $cartItem->price * $newQuantity;
            $cartItem->save();
        } else {
            // Create new cart item
            Cart::create([
                'user_id' => Auth::id(), // Ab yeh 'null' nahi hoga, kyunki user login hoga
                'product_id' => $product->id,
                'quantity' => $quantity,
                'price' => $product->price,
                'total' => $product->price * $quantity,
            ]);
        }

        if ($request->ajax()) {
            return response()->json(['message' => 'Product added to cart successfully.']);
        }

        return redirect()->route('cart.index')->with('success', 'Product added to cart successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart $cart)
    {
        // Authorize
        if ($cart->user_id != Auth::id()) {
            abort(403);
        }

        $request->validate([
            'quantity' => 'required|integer|min:1|max:' . $cart->product->stock_quantity,
        ]);

        $quantity = $request->input('quantity');
        $cart->quantity = $quantity;
        $cart->total = $cart->price * $quantity;
        $cart->save();

        return redirect()->route('cart.index')->with('success', 'Cart updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function remove(Cart $cart)
    {
        // Authorize
        if ($cart->user_id != Auth::id()) {
            abort(403);
        }

        $cart->delete();

        return redirect()->route('cart.index')->with('success', 'Product removed from cart.');
    }

    /**
     * Clear all items from the cart.
     */
    public function clear()
    {
        Cart::where('user_id', Auth::id())->delete();
        return redirect()->route('cart.index')->with('success', 'Cart cleared.');
    }

    /**
     * Get cart items count.
     */
    public function count()
    {
        if (!Auth::check()) {
            return response()->json(['count' => 0]);
        }
        $count = Cart::where('user_id', Auth::id())->sum('quantity');
        return response()->json(['count' => $count]);
    }
}
