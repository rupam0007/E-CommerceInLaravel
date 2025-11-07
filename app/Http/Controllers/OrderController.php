<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{

    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
            ->with('orderItems.product')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('customer.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        // Check if order belongs to current user
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }
        
        $order->load('orderItems.product');

        return view('customer.orders.show', compact('order'));
    }

    public function checkout()
    {
        $cartItems = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $subtotal = $cartItems->sum('total');
        $shipping = $subtotal > 100 ? 0 : 10; // Free shipping over $100
        $tax = $subtotal * 0.08; // 8% tax
        $total = $subtotal + $shipping + $tax;

        return view('customer.checkout.index', compact('cartItems', 'subtotal', 'shipping', 'tax', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'shipping_first_name' => 'required|string|max:255',
            'shipping_last_name' => 'required|string|max:255',
            'shipping_address' => 'required|string|max:500',
            'shipping_city' => 'required|string|max:255',
            'shipping_state' => 'required|string|max:255',
            'shipping_postal_code' => 'required|string|max:20',
            'shipping_country' => 'required|string|max:255',
            'payment_method' => 'required|string|in:stripe,paypal,razorpay,cod',
            'notes' => 'nullable|string|max:1000'
        ]);

        $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();
        
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        // Calculate totals
        $subtotal = $cartItems->sum('total');
        $shipping = $subtotal > 100 ? 0 : 10;
        $tax = $subtotal * 0.08;
        $total = $subtotal + $shipping + $tax;

        // Create order
        $order = Order::create([
            'user_id' => Auth::id(),
            'order_number' => 'ORD-' . strtoupper(uniqid()),
            'status' => Order::STATUS_PENDING,
            'total_amount' => $total,
            'shipping_address' => json_encode([
                'first_name' => $request->shipping_first_name,
                'last_name' => $request->shipping_last_name,
                'address' => $request->shipping_address,
                'city' => $request->shipping_city,
                'state' => $request->shipping_state,
                'postal_code' => $request->shipping_postal_code,
                'country' => $request->shipping_country,
            ]),
            'billing_address' => $request->has('same_as_shipping') ? 
                json_encode([
                    'first_name' => $request->shipping_first_name,
                    'last_name' => $request->shipping_last_name,
                    'address' => $request->shipping_address,
                    'city' => $request->shipping_city,
                    'state' => $request->shipping_state,
                    'postal_code' => $request->shipping_postal_code,
                    'country' => $request->shipping_country,
                ]) : 
                json_encode([
                    'first_name' => $request->billing_first_name,
                    'last_name' => $request->billing_last_name,
                    'address' => $request->billing_address,
                    'city' => $request->billing_city,
                    'state' => $request->billing_state,
                    'postal_code' => $request->billing_postal_code,
                    'country' => $request->billing_country,
                ]),
            'payment_method' => $request->payment_method,
            'payment_status' => $request->payment_method === 'cod' ? 'pending' : 'pending',
            'notes' => $request->notes,
        ]);

        // Create order items
        foreach ($cartItems as $cartItem) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'quantity' => $cartItem->quantity,
                'price' => $cartItem->product->price,
                'total' => $cartItem->total,
            ]);
        }

        // Process payment if not COD
        if ($request->payment_method !== 'cod') {
            $paymentService = new \App\Services\PaymentService();
            $paymentResult = $paymentService->processPayment($order, $request->payment_method);
            
            if ($paymentResult['success']) {
                $order->update(['payment_status' => 'completed', 'status' => Order::STATUS_CONFIRMED]);
            } else {
                $order->update(['payment_status' => 'failed']);
                return redirect()->back()->with('error', 'Payment failed: ' . $paymentResult['message']);
            }
        }

        // Clear cart
        Cart::where('user_id', Auth::id())->delete();

        return redirect()->route('orders.show', $order)->with('success', 'Order placed successfully!');
    }
}
