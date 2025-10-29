@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Checkout</h1>

        @if($cartItems->count() > 0)
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Order Summary -->
                <div class="lg:col-span-2">
                    <form action="{{ route('orders.store') }}" method="POST" id="checkout-form">
                        @csrf
                        
                        <!-- Shipping Information -->
                        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                            <h2 class="text-xl font-semibold text-gray-900 mb-4">Shipping Information</h2>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="shipping_first_name" class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                                    <input type="text" id="shipping_first_name" name="shipping_first_name" 
                                           value="{{ old('shipping_first_name', explode(' ', auth()->user()->name)[0] ?? '') }}" 
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                </div>
                                
                                <div>
                                    <label for="shipping_last_name" class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
                                    <input type="text" id="shipping_last_name" name="shipping_last_name" 
                                           value="{{ old('shipping_last_name', explode(' ', auth()->user()->name)[1] ?? '') }}" 
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                </div>
                                
                                <div class="md:col-span-2">
                                    <label for="shipping_address" class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                                    <input type="text" id="shipping_address" name="shipping_address" 
                                           value="{{ old('shipping_address', auth()->user()->address) }}" 
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                </div>
                                
                                <div>
                                    <label for="shipping_city" class="block text-sm font-medium text-gray-700 mb-1">City</label>
                                    <input type="text" id="shipping_city" name="shipping_city" 
                                           value="{{ old('shipping_city', auth()->user()->city) }}" 
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                </div>
                                
                                <div>
                                    <label for="shipping_state" class="block text-sm font-medium text-gray-700 mb-1">State</label>
                                    <input type="text" id="shipping_state" name="shipping_state" 
                                           value="{{ old('shipping_state', auth()->user()->state) }}" 
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                </div>
                                
                                <div>
                                    <label for="shipping_postal_code" class="block text-sm font-medium text-gray-700 mb-1">Postal Code</label>
                                    <input type="text" id="shipping_postal_code" name="shipping_postal_code" 
                                           value="{{ old('shipping_postal_code', auth()->user()->postal_code) }}" 
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                </div>
                                
                                <div>
                                    <label for="shipping_country" class="block text-sm font-medium text-gray-700 mb-1">Country</label>
                                    <input type="text" id="shipping_country" name="shipping_country" 
                                           value="{{ old('shipping_country', auth()->user()->country) }}" 
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                </div>
                            </div>
                        </div>

                        <!-- Billing Information -->
                        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                            <div class="flex items-center justify-between mb-4">
                                <h2 class="text-xl font-semibold text-gray-900">Billing Information</h2>
                                <label class="flex items-center">
                                    <input type="checkbox" id="same_as_shipping" class="mr-2" checked>
                                    <span class="text-sm text-gray-600">Same as shipping</span>
                                </label>
                            </div>
                            
                            <div id="billing-fields" class="grid grid-cols-1 md:grid-cols-2 gap-4 hidden">
                                <div>
                                    <label for="billing_first_name" class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                                    <input type="text" id="billing_first_name" name="billing_first_name" 
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>
                                
                                <div>
                                    <label for="billing_last_name" class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
                                    <input type="text" id="billing_last_name" name="billing_last_name" 
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>
                                
                                <div class="md:col-span-2">
                                    <label for="billing_address" class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                                    <input type="text" id="billing_address" name="billing_address" 
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>
                                
                                <div>
                                    <label for="billing_city" class="block text-sm font-medium text-gray-700 mb-1">City</label>
                                    <input type="text" id="billing_city" name="billing_city" 
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>
                                
                                <div>
                                    <label for="billing_state" class="block text-sm font-medium text-gray-700 mb-1">State</label>
                                    <input type="text" id="billing_state" name="billing_state" 
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>
                                
                                <div>
                                    <label for="billing_postal_code" class="block text-sm font-medium text-gray-700 mb-1">Postal Code</label>
                                    <input type="text" id="billing_postal_code" name="billing_postal_code" 
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>
                                
                                <div>
                                    <label for="billing_country" class="block text-sm font-medium text-gray-700 mb-1">Country</label>
                                    <input type="text" id="billing_country" name="billing_country" 
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>
                            </div>
                        </div>

                        <!-- Payment Method -->
                        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                            <h2 class="text-xl font-semibold text-gray-900 mb-4">Payment Method</h2>
                            
                            <div class="space-y-3">
                                <label class="flex items-center">
                                    <input type="radio" name="payment_method" value="stripe" class="mr-3" checked>
                                    <span class="text-gray-700">Credit/Debit Card (Stripe)</span>
                                </label>
                                
                                <label class="flex items-center">
                                    <input type="radio" name="payment_method" value="paypal" class="mr-3">
                                    <span class="text-gray-700">PayPal</span>
                                </label>
                                
                                <label class="flex items-center">
                                    <input type="radio" name="payment_method" value="razorpay" class="mr-3">
                                    <span class="text-gray-700">Razorpay</span>
                                </label>
                                
                                <label class="flex items-center">
                                    <input type="radio" name="payment_method" value="cod" class="mr-3">
                                    <span class="text-gray-700">Cash on Delivery</span>
                                </label>
                            </div>
                        </div>

                        <!-- Order Notes -->
                        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                            <h2 class="text-xl font-semibold text-gray-900 mb-4">Order Notes (Optional)</h2>
                            <textarea name="notes" rows="3" 
                                      class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                      placeholder="Any special instructions for your order...">{{ old('notes') }}</textarea>
                        </div>
                    </form>
                </div>

                <!-- Order Summary Sidebar -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-lg shadow-md p-6 sticky top-4">
                        <h2 class="text-xl font-semibold text-gray-900 mb-4">Order Summary</h2>
                        
                        <div class="space-y-3 mb-4">
                            @foreach($cartItems as $item)
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        @if($item->product->image)
                                            <img src="{{ asset('uploads/' . $item->product->image) }}" 
                                                 alt="{{ $item->product->name }}" 
                                                 class="w-12 h-12 object-cover rounded mr-3">
                                        @endif
                                        <div>
                                            <p class="text-sm font-medium text-gray-900">{{ $item->product->name }}</p>
                                            <p class="text-xs text-gray-600">Qty: {{ $item->quantity }}</p>
                                        </div>
                                    </div>
                                    <span class="text-sm font-medium text-gray-900">${{ number_format($item->total_price, 2) }}</span>
                                </div>
                            @endforeach
                        </div>
                        
                        <hr class="my-4">
                        
                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Subtotal:</span>
                                <span class="font-medium">${{ number_format($subtotal, 2) }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Shipping:</span>
                                <span class="font-medium">${{ number_format($shipping, 2) }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Tax:</span>
                                <span class="font-medium">${{ number_format($tax, 2) }}</span>
                            </div>
                            <hr class="my-2">
                            <div class="flex justify-between text-lg font-bold">
                                <span>Total:</span>
                                <span>${{ number_format($total, 2) }}</span>
                            </div>
                        </div>
                        
                        <button type="submit" form="checkout-form" 
                                class="w-full mt-6 bg-blue-600 hover:bg-blue-700 text-white py-3 px-4 rounded-md font-medium transition-colors duration-200">
                            Place Order
                        </button>
                        
                        <p class="text-xs text-gray-500 mt-3 text-center">
                            By placing your order, you agree to our Terms of Service and Privacy Policy.
                        </p>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-12">
                <div class="mb-4">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.5 6M7 13l-1.5-6m0 0h15M17 13v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6" />
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Your cart is empty</h3>
                <p class="text-gray-600 mb-6">Add some products to your cart before checkout.</p>
                <a href="{{ route('products.index') }}" 
                   class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 transition-colors duration-200">
                    Browse Products
                </a>
            </div>
        @endif
    </div>
</div>

<script>
document.getElementById('same_as_shipping').addEventListener('change', function() {
    const billingFields = document.getElementById('billing-fields');
    const isChecked = this.checked;
    
    if (isChecked) {
        billingFields.classList.add('hidden');
        // Clear billing fields
        billingFields.querySelectorAll('input').forEach(input => {
            input.value = '';
            input.removeAttribute('required');
        });
    } else {
        billingFields.classList.remove('hidden');
        // Copy shipping to billing
        const shippingFields = ['first_name', 'last_name', 'address', 'city', 'state', 'postal_code', 'country'];
        shippingFields.forEach(field => {
            const shippingInput = document.getElementById(`shipping_${field}`);
            const billingInput = document.getElementById(`billing_${field}`);
            if (shippingInput && billingInput) {
                billingInput.value = shippingInput.value;
                billingInput.setAttribute('required', 'required');
            }
        });
    }
});
</script>
@endsection
