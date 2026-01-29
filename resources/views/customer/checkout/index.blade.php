@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<div class="theme-bg min-h-screen py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold mb-8">Checkout</h1>

        @if($cartItems->count() > 0)
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2">
                <form action="{{ route('orders.store') }}" method="POST" id="checkout-form">
                    @csrf

                    <div class="theme-card p-6 mb-6">
                        <h2 class="text-lg font-semibold mb-4">Shipping Information</h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="shipping_first_name" class="block text-sm font-medium mb-1">First Name</label>
                                <input type="text" id="shipping_first_name" name="shipping_first_name"
                                    value="{{ old('shipping_first_name', explode(' ', auth()->user()->name)[0] ?? '') }}"
                                    class="w-full px-3 py-2 border theme-border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 theme-surface" required>
                            </div>

                            <div>
                                <label for="shipping_last_name" class="block text-sm font-medium mb-1">Last Name</label>
                                <input type="text" id="shipping_last_name" name="shipping_last_name"
                                    value="{{ old('shipping_last_name', explode(' ', auth()->user()->name)[1] ?? '') }}"
                                    class="w-full px-3 py-2 border theme-border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 theme-surface" required>
                            </div>

                            <div class="md:col-span-2">
                                <label for="shipping_address" class="block text-sm font-medium mb-1">Address</label>
                                <input type="text" id="shipping_address" name="shipping_address"
                                    value="{{ old('shipping_address', auth()->user()->address) }}"
                                    class="w-full px-3 py-2 border theme-border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 theme-surface" required>
                            </div>

                            <div>
                                <label for="shipping_city" class="block text-sm font-medium mb-1">City</label>
                                <input type="text" id="shipping_city" name="shipping_city"
                                    value="{{ old('shipping_city', auth()->user()->city) }}"
                                    class="w-full px-3 py-2 border theme-border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 theme-surface" required>
                            </div>

                            <div>
                                <label for="shipping_state" class="block text-sm font-medium mb-1">State</label>
                                <input type="text" id="shipping_state" name="shipping_state"
                                    value="{{ old('shipping_state', auth()->user()->state) }}"
                                    class="w-full px-3 py-2 border theme-border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 theme-surface" required>
                            </div>

                            <div>
                                <label for="shipping_postal_code" class="block text-sm font-medium mb-1">Postal Code</label>
                                <input type="text" id="shipping_postal_code" name="shipping_postal_code"
                                    value="{{ old('shipping_postal_code', auth()->user()->postal_code) }}"
                                    class="w-full px-3 py-2 border theme-border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 theme-surface" required>
                            </div>

                            <div>
                                <label for="shipping_country" class="block text-sm font-medium mb-1">Country</label>
                                <input type="text" id="shipping_country" name="shipping_country"
                                    value="{{ old('shipping_country', auth()->user()->country) }}"
                                    class="w-full px-3 py-2 border theme-border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 theme-surface" required>
                            </div>
                        </div>
                    </div>

                    <div class="theme-card p-6 mb-6">
                        <h2 class="text-lg font-semibold mb-4">Payment Method</h2>

                        <div class="space-y-3">
                            <label class="flex items-center p-3 border theme-border rounded-lg has-[:checked]:border-indigo-600 has-[:checked]:bg-indigo-50 dark:has-[:checked]:bg-indigo-900/20 transition">
                                <input type="radio" name="payment_method" value="stripe" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500" checked>
                                <span class="ml-3 text-sm font-medium">Credit/Debit Card (Stripe)</span>
                            </label>
                            <label class="flex items-center p-3 border theme-border rounded-lg has-[:checked]:border-indigo-600 has-[:checked]:bg-indigo-50 dark:has-[:checked]:bg-indigo-900/20 transition">
                                <input type="radio" name="payment_method" value="paypal" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500">
                                <span class="ml-3 text-sm font-medium">PayPal</span>
                            </label>
                            <label class="flex items-center p-3 border theme-border rounded-lg has-[:checked]:border-indigo-600 has-[:checked]:bg-indigo-50 dark:has-[:checked]:bg-indigo-900/20 transition">
                                <input type="radio" name="payment_method" value="razorpay" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500">
                                <span class="ml-3 text-sm font-medium">Razorpay</span>
                            </label>
                            <label class="flex items-center p-3 border theme-border rounded-lg has-[:checked]:border-indigo-600 has-[:checked]:bg-indigo-50 dark:has-[:checked]:bg-indigo-900/20 transition">
                                <input type="radio" name="payment_method" value="cod" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500">
                                <span class="ml-3 text-sm font-medium">Cash on Delivery</span>
                            </label>
                        </div>
                    </div>

                    <div class="theme-card p-6 mb-6">
                        <h2 class="text-lg font-semibold mb-4">Order Notes (Optional)</h2>
                        <textarea name="notes" rows="3"
                            class="w-full px-3 py-2 border theme-border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 theme-surface"
                            placeholder="Any special instructions for your order...">{{ old('notes') }}</textarea>
                    </div>
                </form>
            </div>

            <div class="lg:col-span-1">
                <div class="theme-card p-6 sticky top-24">
                    <h2 class="text-lg font-semibold mb-4">Order Summary</h2>

                    <div class="space-y-3 mb-4">
                        @foreach($cartItems as $item)
                        <div class="flex items-start justify-between pb-3 border-b theme-border last:border-0 last:pb-0">
                            <div class="flex gap-3">
                                @if($item->product->image)
                                <img src="{{ $item->product->image_url }}"
                                    alt="{{ $item->product->name }}"
                                    class="w-12 h-12 object-cover rounded">
                                @endif
                                <div>
                                    <p class="text-sm font-medium">{{ $item->product->name }}</p>
                                    <p class="text-xs theme-text-muted">Qty: {{ $item->quantity }}</p>
                                </div>
                            </div>
                            <span class="text-sm font-medium">₹{{ number_format($item->total, 2) }}</span>
                        </div>
                        @endforeach
                    </div>

                    <hr class="theme-border my-4">

                    <div class="space-y-2 text-sm mb-6">
                        <div class="flex justify-between">
                            <span class="theme-text-muted">Subtotal</span>
                            <span class="font-medium">₹{{ number_format($subtotal, 2) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="theme-text-muted">Shipping</span>
                            <span class="font-medium">₹{{ number_format($shipping, 2) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="theme-text-muted">Tax</span>
                            <span class="font-medium">₹{{ number_format($tax, 2) }}</span>
                        </div>
                        <hr class="theme-border my-2">
                        <div class="flex justify-between text-base font-bold">
                            <span>Total</span>
                            <span>₹{{ number_format($total, 2) }}</span>
                        </div>
                    </div>

                    <button type="submit" form="checkout-form"
                        class="w-full mt-6 bg-indigo-600 hover:bg-indigo-700 text-white py-3 px-4 rounded-md font-semibold transition-colors duration-200 shadow-sm">
                        Place Order
                    </button>
                </div>
            </div>
        </div>
        @else
        <div class="text-center py-16 bg-white border border-gray-200 rounded-lg shadow-sm">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.5 6M7 13l-1.5-6m0 0h15M17 13v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6" />
            </svg>
            <h3 class="text-lg font-semibold text-gray-900 mt-4 mb-2">Your cart is empty</h3>
            <p class="text-gray-500 mb-6 text-sm">Add some products to your cart before checkout.</p>
            <a href="{{ route('products.index') }}"
                class="inline-flex items-center px-6 py-3 text-base font-medium rounded-md text-white bg-primary-500 hover:bg-primary-600 shadow-sm transition-colors duration-200">
                Browse Products
            </a>
        </div>
        @endif
    </div>
</div>
@endsection