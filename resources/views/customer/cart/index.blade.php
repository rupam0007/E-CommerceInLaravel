@extends('layouts.app')

@section('title', 'Shopping Cart - Nexora')

@section('content')
<div class="bg-[#F5EFE6] min-h-screen py-8 relative z-0">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Colorful Page Header --}}
        <div class="mb-8">
            <div class="bg-gradient-to-r from-orange-500 via-orange-600 to-red-500 rounded-2xl shadow-2xl p-8 text-white">
                <div class="flex items-center gap-4">
                    <div class="w-16 h-16 bg-white/20 backdrop-blur-md rounded-2xl flex items-center justify-center">
                        <span class="material-icons text-5xl">shopping_cart</span>
                    </div>
                    <div>
                        <h1 class="text-4xl font-extrabold mb-2">Shopping Cart</h1>
                        <p class="text-orange-100 text-lg">{{ $cartItems->count() }} {{ Str::plural('item', $cartItems->count()) }} in your cart</p>
                    </div>
                </div>
            </div>
        </div>

        @if($cartItems->count() > 0)
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 space-y-4">
                @foreach($cartItems as $item)
                <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden group">
                    <div class="flex p-6">
                        <div class="flex-shrink-0">
                            @if($item->product->image)
                            <a href="{{ route('products.show', $item->product) }}">
                                <img src="{{ $item->product->image_url }}"
                                    alt="{{ $item->product->name }}"
                                    class="w-32 h-32 rounded-xl object-cover shadow-lg border-2 border-gray-100 group-hover:scale-105 transition-transform duration-300">
                            </a>
                            @else
                            <div class="w-32 h-32 bg-gradient-to-br from-blue-100 to-purple-100 rounded-xl flex items-center justify-center">
                                <span class="material-icons text-gray-400 text-4xl">image</span>
                            </div>
                            @endif
                        </div>

                        <div class="ml-6 flex-1 flex flex-col justify-between">
                            <div>
                                <div class="flex justify-between">
                                    <div class="flex-1">
                                        <h3 class="text-xl font-bold text-gray-900 mb-2">
                                            <a href="{{ route('products.show', $item->product) }}" class="hover:text-blue-600 transition-colors line-clamp-2">
                                                {{ $item->product->name }}
                                            </a>
                                        </h3>
                                        <p class="text-sm font-bold text-gray-500 mb-3 uppercase tracking-wider bg-gray-100 inline-block px-3 py-1 rounded-full">{{ $item->product->category->name }}</p>
                                    </div>
                                    <form action="{{ route('cart.remove', $item) }}" method="POST" class="ml-4">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-red-500 hover:bg-red-50 p-2.5 rounded-lg transition-colors"
                                            onclick="return confirm('Remove this item from cart?')">
                                            <span class="material-icons text-2xl">delete</span>
                                        </button>
                                    </form>
                                </div>
                                
                                <div class="flex items-center gap-4 mt-3">
                                    <div class="text-3xl font-extrabold text-gray-900">
                                        ₹{{ number_format($item->price, 0) }}
                                    </div>
                                    <span class="text-sm font-semibold text-green-600 bg-green-50 px-3 py-1 rounded-full">Free Delivery</span>
                                </div>
                            </div>

                            <div class="flex items-center justify-between mt-4">
                                <form action="{{ route('cart.update', $item) }}" method="POST" class="flex items-center">
                                    @csrf
                                    @method('PATCH')
                                    <label for="quantity-{{ $item->id }}" class="sr-only">Quantity</label>
                                    <div class="flex items-center border-2 border-gray-200 rounded-lg overflow-hidden">
                                        <button type="button" onclick="decrementQuantity({{ $item->id }})" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 font-bold text-gray-700">-</button>
                                        <input type="number"
                                            id="quantity-{{ $item->id }}"
                                            name="quantity"
                                            value="{{ $item->quantity }}"
                                            min="1"
                                            max="{{ $item->product->stock_quantity }}"
                                            class="w-16 px-3 py-2 text-center font-bold text-gray-900 border-0 focus:ring-0"
                                            onchange="this.form.submit()">
                                        <button type="button" onclick="incrementQuantity({{ $item->id }}, {{ $item->product->stock_quantity }})" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 font-bold text-gray-700">+</button>
                                    </div>
                                </form>

                                <div class="text-right">
                                    <p class="text-sm text-gray-500 font-semibold">Subtotal</p>
                                    <p class="text-2xl font-extrabold text-gray-900">
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
                <div class="bg-white rounded-xl shadow-xl p-6 sticky top-24 border-2 border-gray-100">
                    <h2 class="text-2xl font-extrabold mb-6 text-gray-900 flex items-center gap-2">
                        <span class="material-icons text-blue-600">receipt_long</span>
                        Price Details
                    </h2>

                    <div class="space-y-4 mb-6">
                        <div class="flex justify-between text-base">
                            <span class="text-gray-700 font-semibold">Price ({{ $cartItems->sum('quantity') }} items)</span>
                            <span class="font-bold text-gray-900">₹{{ number_format($cartItems->sum('total'), 0) }}</span>
                        </div>
                        <div class="flex justify-between text-base">
                            <span class="text-gray-700 font-semibold">Delivery Charges</span>
                            <span class="font-bold">
                                @if($cartItems->sum('total') >= 499)
                                <span class="text-green-600">FREE</span>
                                @else
                                ₹40
                                @endif
                            </span>
                        </div>
                        @if($cartItems->sum('total') < 499)
                        <div class="bg-yellow-50 border-2 border-yellow-200 rounded-lg p-3">
                            <p class="text-sm font-bold text-yellow-800">
                                Add items worth ₹{{ number_format(499 - $cartItems->sum('total'), 0) }} to get FREE delivery!
                            </p>
                        </div>
                        @endif
                        <hr class="my-4 border-gray-200 border-2">
                        <div class="flex justify-between text-xl">
                            <span class="font-bold text-gray-900">Total Amount</span>
                            <span class="font-extrabold text-gray-900">₹{{ number_format($cartItems->sum('total') + ($cartItems->sum('total') >= 499 ? 0 : 40), 0) }}</span>
                        </div>
                    </div>

                    <div class="bg-gradient-to-r from-green-50 to-emerald-50 border-2 border-green-200 rounded-lg p-4 mb-6">
                        <p class="text-green-700 font-bold text-center">
                            You will save ₹{{ number_format($cartItems->sum('total') >= 499 ? 40 : 0, 0) }} on this order
                        </p>
                    </div>

                    <a href="{{ route('checkout') }}"
                        class="w-full bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white py-4 px-6 rounded-xl font-bold text-lg transition-all duration-200 block text-center shadow-xl hover:shadow-2xl hover:scale-105 flex items-center justify-center gap-2">
                        <span class="material-icons">shopping_bag</span>
                        Place Order
                    </a>
                </div>
            </div>
        </div>
        @else
        <div class="text-center py-16">
            <div class="bg-white rounded-2xl shadow-xl p-12 max-w-lg mx-auto">
                <div class="w-32 h-32 bg-gradient-to-br from-orange-100 to-red-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <span class="material-icons text-orange-500 text-7xl">shopping_cart</span>
                </div>
                <h3 class="text-3xl font-extrabold text-gray-900 mb-3">Your Cart is Empty</h3>
                <p class="text-gray-600 text-lg mb-8">Add some products to your cart to get started.</p>
                <a href="{{ route('products.index') }}"
                    class="inline-flex items-center gap-2 px-8 py-4 text-lg font-bold rounded-xl text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 transition-all duration-200 shadow-xl hover:shadow-2xl hover:scale-105">
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