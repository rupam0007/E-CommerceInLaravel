@extends('layouts.app')

@section('title', 'Shopping Cart')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-6xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Shopping Cart</h1>

        @if($cartItems->count() > 0)
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Cart Items -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        @foreach($cartItems as $item)
                            <div class="p-6 border-b border-gray-200 last:border-b-0">
                                <div class="flex items-center space-x-4">
                                    @if($item->product->image)
                                        <img src="{{ asset('uploads/' . $item->product->image) }}" 
                                             alt="{{ $item->product->name }}" 
                                             class="w-20 h-20 object-cover rounded-lg">
                                    @else
                                        <div class="w-20 h-20 bg-gray-200 rounded-lg flex items-center justify-center">
                                            <span class="text-gray-400 text-xs">No Image</span>
                                        </div>
                                    @endif

                                    <div class="flex-1">
                                        <h3 class="text-lg font-semibold text-gray-900">
                                            <a href="{{ route('products.show', $item->product) }}" class="hover:text-blue-600">
                                                {{ $item->product->name }}
                                            </a>
                                        </h3>
                                        <p class="text-sm text-gray-600">{{ $item->product->category->name }}</p>
                                        <p class="text-lg font-bold text-gray-900 mt-1">${{ number_format($item->product->price, 2) }}</p>
                                    </div>

                                    <div class="flex items-center space-x-3">
                                        <form action="{{ route('cart.update', $item) }}" method="POST" class="flex items-center">
                                            @csrf
                                            @method('PATCH')
                                            <label for="quantity-{{ $item->id }}" class="sr-only">Quantity</label>
                                            <input type="number" 
                                                   id="quantity-{{ $item->id }}"
                                                   name="quantity" 
                                                   value="{{ $item->quantity }}" 
                                                   min="1" 
                                                   max="{{ $item->product->stock_quantity }}"
                                                   class="w-16 px-2 py-1 border border-gray-300 rounded text-center"
                                                   onchange="this.form.submit()">
                                        </form>

                                        <div class="text-right">
                                            <p class="text-lg font-bold text-gray-900">${{ number_format($item->total_price, 2) }}</p>
                                        </div>

                                        <form action="{{ route('cart.remove', $item) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="text-red-500 hover:text-red-700 p-1"
                                                    onclick="return confirm('Remove this item from cart?')">
                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" clip-rule="evenodd"></path>
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414L7.586 12l-1.293 1.293a1 1 0 101.414 1.414L9 13.414l2.293 2.293a1 1 0 001.414-1.414L11.414 12l1.293-1.293z" clip-rule="evenodd"></path>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Clear Cart Button -->
                    <div class="mt-4">
                        <form action="{{ route('cart.clear') }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="text-red-600 hover:text-red-800 font-medium"
                                    onclick="return confirm('Clear entire cart?')">
                                Clear Cart
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Cart Summary -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-lg shadow-md p-6 sticky top-4">
                        <h2 class="text-xl font-semibold text-gray-900 mb-4">Order Summary</h2>
                        
                        <div class="space-y-3 mb-4">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Items ({{ $cartItems->sum('quantity') }}):</span>
                                <span class="font-medium">${{ number_format($cartItems->sum('total_price'), 2) }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Shipping:</span>
                                <span class="font-medium">
                                    @if($cartItems->sum('total_price') > 100)
                                        <span class="text-green-600">FREE</span>
                                    @else
                                        $10.00
                                    @endif
                                </span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Tax (8%):</span>
                                <span class="font-medium">${{ number_format($cartItems->sum('total_price') * 0.08, 2) }}</span>
                            </div>
                            <hr class="my-3">
                            <div class="flex justify-between text-lg font-bold">
                                <span>Total:</span>
                                <span>${{ number_format($cartItems->sum('total_price') + ($cartItems->sum('total_price') > 100 ? 0 : 10) + ($cartItems->sum('total_price') * 0.08), 2) }}</span>
                            </div>
                        </div>

                        <a href="{{ route('checkout') }}" 
                           class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 px-4 rounded-md font-medium transition-colors duration-200 block text-center">
                            Proceed to Checkout
                        </a>

                        <p class="text-xs text-gray-500 mt-3 text-center">
                            Free shipping on orders over $100
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
                <p class="text-gray-600 mb-6">Add some products to your cart to get started.</p>
                <a href="{{ route('products.index') }}" 
                   class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 transition-colors duration-200">
                    Browse Products
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
