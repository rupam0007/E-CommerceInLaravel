@extends('layouts.app')

@section('title', 'Shopping Cart - Nexora')

@section('content')
<div class="theme-bg min-h-screen py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Page Header --}}
        <div class="mb-8">
            <h1 class="text-3xl font-bold mb-2">Shopping Cart</h1>
            <p class="theme-text-muted">{{ $cartItems->count() }} {{ Str::plural('item', $cartItems->count()) }} in your cart</p>
        </div>

        @if($cartItems->count() > 0)
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 space-y-4">
                @foreach($cartItems as $item)
                <div class="theme-card overflow-hidden">
                    <div class="flex p-6">
                        <div class="flex-shrink-0">
                            @if($item->product->image)
                            <a href="{{ route('products.show', $item->product) }}">
                                <img src="{{ $item->product->image_url }}"
                                    alt="{{ $item->product->name }}"
                                    class="w-24 h-24 rounded-lg object-cover">
                            </a>
                            @else
                            <div class="w-24 h-24 bg-gray-100 dark:bg-gray-700 rounded-lg flex items-center justify-center">
                                <span class="material-icons theme-text-muted text-3xl">image</span>
                            </div>
                            @endif
                        </div>

                        <div class="ml-6 flex-1 flex flex-col justify-between">
                            <div>
                                <div class="flex justify-between">
                                    <div class="flex-1">
                                        <h3 class="text-lg font-semibold mb-1">
                                            <a href="{{ route('products.show', $item->product) }}" class="hover-theme-accent transition line-clamp-2">
                                                {{ $item->product->name }}
                                            </a>
                                        </h3>
                                        <p class="text-xs theme-text-muted mb-2">{{ $item->product->category->name }}</p>
                                    </div>
                                    <form action="{{ route('cart.remove', $item) }}" method="POST" class="ml-4">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 p-2 rounded-lg transition"
                                            onclick="return confirm('Remove this item from cart?')">
                                            <span class="material-icons">delete</span>
                                        </button>
                                    </form>
                                </div>
                                
                                <div class="flex items-center gap-3 mt-2">
                                    <div class="text-2xl font-bold">
                                        @if($item->product->has_discount)
                                            <div class="flex items-baseline gap-2">
                                                <span class="text-green-600">₹{{ number_format($item->price, 0) }}</span>
                                                <span class="text-sm text-gray-400 line-through">₹{{ number_format($item->product->price, 0) }}</span>
                                                <span class="text-xs font-bold text-white bg-red-500 px-2 py-1 rounded">{{ number_format($item->product->discount_percentage, 0) }}% OFF</span>
                                            </div>
                                        @else
                                            ₹{{ number_format($item->price, 0) }}
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center justify-between mt-4">
                                <form action="{{ route('cart.update', $item) }}" method="POST" class="flex items-center">
                                    @csrf
                                    @method('PATCH')
                                    <label for="quantity-{{ $item->id }}" class="sr-only">Quantity</label>
                                    <div class="flex items-center border theme-border rounded-lg overflow-hidden">
                                        <button type="button" onclick="decrementQuantity({{ $item->id }})" class="px-3 py-1.5 hover-theme-surface transition">-</button>
                                        <input type="number"
                                            id="quantity-{{ $item->id }}"
                                            name="quantity"
                                            value="{{ $item->quantity }}"
                                            min="1"
                                            max="{{ $item->product->stock_quantity }}"
                                            class="w-14 px-2 py-1.5 text-center border-0 focus:ring-0 theme-surface"
                                            onchange="this.form.submit()">
                                        <button type="button" onclick="incrementQuantity({{ $item->id }}, {{ $item->product->stock_quantity }})" class="px-3 py-1.5 hover-theme-surface transition">+</button>
                                    </div>
                                </form>

                                <div class="text-right">
                                    <p class="text-xs theme-text-muted">Subtotal</p>
                                    <p class="text-xl font-bold">
                                        ₹{{ number_format($item->total, 0) }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

                <div class="mt-6 flex justify-between items-center bg-white rounded-xl p-4 shadow-md">
                    <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 text-blue-600 font-bold hover:text-blue-700 transition-colors">
                        <span class="material-icons">arrow_back</span>
                        Continue Shopping
                    </a>
                    <form action="{{ route('cart.clear') }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="inline-flex items-center gap-2 text-red-600 font-bold hover:bg-red-50 px-4 py-2 rounded-lg transition-colors"
                            onclick="return confirm('Clear entire cart?')">
                            <span class="material-icons">delete_sweep</span>
                            Clear Cart
                        </button>
                    </form>
                </div>
            </div>

            <div class="lg:col-span-1">
                <div class="theme-card p-6 sticky top-24">
                    <h2 class="text-xl font-bold mb-6">Order Summary</h2>

                    <div class="space-y-3 mb-6">
                        <div class="flex justify-between text-sm">
                            <span class="theme-text-muted">Subtotal ({{ $cartItems->sum('quantity') }} items)</span>
                            <span class="font-medium">₹{{ number_format($cartItems->sum('total'), 0) }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="theme-text-muted">Delivery</span>
                            <span class="font-medium">
                                @if($cartItems->sum('total') >= 499)
                                <span class="text-green-600">FREE</span>
                                @else
                                ₹40
                                @endif
                            </span>
                        </div>
                        @if($cartItems->sum('total') < 499)
                        <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-lg p-3">
                            <p class="text-xs text-yellow-800 dark:text-yellow-200">
                                Add ₹{{ number_format(499 - $cartItems->sum('total'), 0) }} for free delivery
                            </p>
                        </div>
                        @endif
                        <hr class="theme-border">
                        <div class="flex justify-between text-lg font-bold">
                            <span>Total</span>
                            <span>₹{{ number_format($cartItems->sum('total') + ($cartItems->sum('total') >= 499 ? 0 : 40), 0) }}</span>
                        </div>
                    </div>

                    <a href="{{ route('checkout') }}"
                        class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-3 px-6 rounded-lg font-medium transition block text-center">
                        Proceed to Checkout
                    </a>
                </div>
            </div>
        </div>
        @else
        <div class="text-center py-16">
            <div class="theme-card p-12 max-w-lg mx-auto">
                <div class="w-24 h-24 bg-indigo-100 dark:bg-indigo-900 rounded-full flex items-center justify-center mx-auto mb-6">
                    <span class="material-icons text-indigo-600 text-5xl">shopping_cart</span>
                </div>
                <h3 class="text-2xl font-bold mb-3">Your Cart is Empty</h3>
                <p class="theme-text-muted mb-8">Add some products to start shopping.</p>
                <a href="{{ route('products.index') }}"
                    class="inline-flex items-center gap-2 px-6 py-3 font-medium rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 transition">
                    <span class="material-icons">storefront</span>
                    Browse Products
                </a>
            </div>
        </div>
        @endif
    </div>
</div>

<script>
function incrementQuantity(itemId, maxQty) {
    const input = document.getElementById('quantity-' + itemId);
    const currentValue = parseInt(input.value);
    if (currentValue < maxQty) {
        input.value = currentValue + 1;
        input.form.submit();
    }
}

function decrementQuantity(itemId) {
    const input = document.getElementById('quantity-' + itemId);
    const currentValue = parseInt(input.value);
    if (currentValue > 1) {
        input.value = currentValue - 1;
        input.form.submit();
    }
}
</script>
@endsection