@extends('layouts.app')

@section('title', 'Shopping Cart')

@section('content')
<div style="background-color: rgb(var(--color-bg));">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16">
        <h1 class="text-4xl font-bold font-serif mb-10" style="color: rgb(var(--color-text));">Shopping Cart</h1>

        @if($cartItems->count() > 0)
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 lg:gap-12">
            <div class="lg:col-span-2">
                <div class="rounded-lg shadow-sm" style="background-color: rgb(var(--color-surface)); border: 1px solid rgb(var(--color-border));">
                    <ul role="list" style="border-color: rgb(var(--color-border));" class="divide-y">
                        @foreach($cartItems as $item)
                        <li class="flex p-6">
                            <div class="flex-shrink-0">
                                @if($item->product->image)
                                <img src="{{ $item->product->image_url }}"
                                    alt="{{ $item->product->name }}"
                                    class="w-24 h-24 rounded-md object-cover">
                                @else
                                <div class="w-24 h-24 bg-gray-100 rounded-md flex items-center justify-center">
                                    <span class="text-gray-400 text-xs">No Image</span>
                                </div>
                                @endif
                            </div>

                            <div class="ml-4 flex-1 flex flex-col justify-between">
                                <div>
                                    <h3 class="text-base font-medium" style="color: rgb(var(--color-text));">
                                        <a href="{{ route('products.show', $item->product) }}" class="transition-colors" style="color: rgb(var(--color-text));">
                                            {{ $item->product->name }}
                                        </a>
                                    </h3>
                                    <p class="text-sm" style="color: rgb(var(--color-muted));">{{ $item->product->category->name }}</p>
                                    <p class="text-base font-semibold mt-1" style="color: rgb(var(--color-text));">₹{{ number_format($item->price, 2) }}</p>
                                </div>
                                <p class="text-base font-semibold text-gray-900 lg:hidden">
                                    ₹{{ number_format($item->total, 2) }}
                                </p>
                            </div>

                            <div class="ml-4 flex-1 flex flex-col justify-between items-end">
                                <p class="text-base font-semibold text-gray-900 hidden lg:block">
                                    ₹{{ number_format($item->total, 2) }}
                                </p>
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
                                            class="w-20 px-2 py-1.5 border border-gray-300 rounded-md text-center text-sm shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                            onchange="this.form.submit()">
                                    </form>

                                    <form action="{{ route('cart.remove', $item) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-red-600 hover:text-red-500 p-1"
                                            onclick="return confirm('Remove this item from cart?')">
                                            <span class="sr-only">Remove item</span>
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <div class="mt-6">
                    <form action="{{ route('cart.clear') }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="text-sm font-medium text-red-600 hover:text-red-500"
                            onclick="return confirm('Clear entire cart?')">
                            Clear Cart
                        </button>
                    </form>
                </div>
            </div>

            <div class="lg:col-span-1">
                <div class="rounded-lg shadow-sm p-6 sticky top-24" style="background-color: rgb(var(--color-surface)); border: 1px solid rgb(var(--color-border));">
                    <h2 class="text-lg font-semibold mb-4" style="color: rgb(var(--color-text));">Order Summary</h2>

                    <div class="space-y-3 mb-6">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Items ({{ $cartItems->sum('quantity') }})</span>
                            <span class="font-medium text-gray-900">₹{{ number_format($cartItems->sum('total'), 2) }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Shipping</span>
                            <span class="font-medium text-gray-900">
                                @if($cartItems->sum('total') > 100)
                                <span class="text-green-600">FREE</span>
                                @else
                                ₹10.00
                                @endif
                            </span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Tax (8%)</span>
                            <span class="font-medium text-gray-900">₹{{ number_format($cartItems->sum('total') * 0.08, 2) }}</span>
                        </div>
                        <hr class="my-3">
                        <div class="flex justify-between text-base font-semibold">
                            <span>Total</span>
                            <span>₹{{ number_format($cartItems->sum('total') + ($cartItems->sum('total') > 100 ? 0 : 10) + ($cartItems->sum('total') * 0.08), 2) }}</span>
                        </div>
                    </div>

                    <a href="{{ route('checkout') }}"
                        class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-3 px-4 rounded-md font-semibold transition-colors duration-200 block text-center shadow-sm">
                        Proceed to Checkout
                    </a>
                </div>
            </div>
        </div>
        @else
        <div class="text-center py-16 bg-white border border-gray-200 rounded-lg shadow-sm">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.5 6M7 13l-1.5-6m0 0h15M17 13v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6" />
            </svg>
            <h3 class="text-lg font-semibold text-gray-900 mt-4 mb-2">Your cart is empty</h3>
            <p class="text-gray-600 mb-6 text-sm">Add some products to your cart to get started.</p>
            <a href="{{ route('products.index') }}"
                class="inline-flex items-center px-6 py-3 text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 shadow-sm transition-colors duration-200">
                Browse Products
            </a>
        </div>
        @endif
    </div>
</div>
@endsection