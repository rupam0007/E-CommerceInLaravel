@extends('layouts.app')

@section('title', 'My Wishlist - Nexora')

@section('content')
<div class="min-h-screen bg-[#F5EFE6] py-8">
    <div class="container mx-auto px-4">
        <div class="max-w-7xl mx-auto">
            {{-- Colorful Page Header --}}
            <div class="mb-8">
                <div class="bg-gradient-to-r from-pink-500 via-rose-500 to-red-500 rounded-2xl shadow-2xl p-8 text-white">
                    <div class="flex items-center gap-4">
                        <div class="w-16 h-16 bg-white/20 backdrop-blur-md rounded-2xl flex items-center justify-center">
                            <span class="material-icons text-5xl">favorite</span>
                        </div>
                        <div>
                            <h1 class="text-4xl font-extrabold mb-2">My Wishlist</h1>
                            <p class="text-pink-100 text-lg">{{ $wishlistItems->count() }} {{ Str::plural('item', $wishlistItems->count()) }} saved for later</p>
                        </div>
                    </div>
                </div>
            </div>

            @if($wishlistItems->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach($wishlistItems as $item)
                        <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-2xl transition-all duration-300 hover:scale-[1.02] group">
                            <div class="relative">
                                @if($item->product->image)
                                    <a href="{{ route('products.show', $item->product) }}">
                                        <img src="{{ $item->product->image_url }}" 
                                             alt="{{ $item->product->name }}" 
                                             class="w-full h-56 object-cover group-hover:scale-110 transition-transform duration-500">
                                    </a>
                                @else
                                    <div class="w-full h-56 bg-gradient-to-br from-blue-100 to-purple-100 flex items-center justify-center">
                                        <span class="material-icons text-gray-400 text-6xl">image</span>
                                    </div>
                                @endif
                                
                                {{-- Remove Button --}}
                                <button class="remove-wishlist-btn absolute top-3 right-3 bg-gradient-to-r from-red-500 to-rose-600 hover:from-red-600 hover:to-rose-700 text-white p-3 rounded-full transition-all duration-200 shadow-lg hover:shadow-xl hover:scale-110" 
                                        data-product-id="{{ $item->product->id }}">
                                    <span class="material-icons text-xl">close</span>
                                </button>

                                {{-- Stock Badge --}}
                                @if($item->product->stock_quantity > 0)
                                    <span class="absolute top-3 left-3 bg-gradient-to-r from-green-500 to-emerald-600 text-white text-xs font-bold px-4 py-1.5 rounded-full shadow-lg">In Stock</span>
                                @else
                                    <span class="absolute top-3 left-3 bg-gradient-to-r from-red-500 to-rose-600 text-white text-xs font-bold px-4 py-1.5 rounded-full shadow-lg">Out of Stock</span>
                                @endif
                            </div>

                            <div class="p-5">
                                <p class="text-xs font-bold text-gray-500 mb-2 uppercase tracking-wider bg-gray-100 inline-block px-3 py-1 rounded-full">{{ $item->product->category->name }}</p>
                                
                                <h3 class="text-lg font-bold text-gray-900 mb-3 line-clamp-2">
                                    <a href="{{ route('products.show', $item->product) }}" class="hover:text-blue-600 transition-colors">
                                        {{ $item->product->name }}
                                    </a>
                                </h3>
                                
                                <div class="flex items-baseline justify-between mb-4">
                                    <span class="text-2xl font-extrabold text-gray-900">₹{{ number_format($item->product->price, 0) }}</span>
                                    @if($item->product->stock_quantity > 0)
                                        <span class="text-sm font-bold text-green-600">Available</span>
                                    @else
                                        <span class="text-sm font-bold text-red-600">Unavailable</span>
                                    @endif
                                </div>

                                <div class="flex gap-2">
                                    @if($item->product->stock_quantity > 0)
                                        <form action="{{ route('cart.add', $item->product) }}" method="POST" class="flex-1">
                                            @csrf
                                            <input type="hidden" name="quantity" value="1">
                                            <button type="submit" 
                                                    class="w-full bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white py-3 px-4 rounded-lg transition-all duration-200 text-sm font-bold shadow-md hover:shadow-xl hover:scale-105 flex items-center justify-center gap-2">
                                                <span class="material-icons text-lg">shopping_cart</span>
                                                Move to Cart
                                            </button>
                                        </form>
                                    @else
                                        <button disabled 
                                                class="w-full bg-gray-200 text-gray-500 py-3 px-4 rounded-lg text-sm font-bold cursor-not-allowed">
                                            Out of Stock
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-16">
                    <div class="bg-white rounded-2xl shadow-xl p-12 max-w-lg mx-auto">
                        <div class="w-32 h-32 bg-gradient-to-br from-pink-100 to-rose-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <span class="material-icons text-pink-500 text-7xl">favorite_border</span>
                        </div>
                        <h3 class="text-3xl font-extrabold text-gray-900 mb-3">Your Wishlist is Empty</h3>
                        <p class="text-gray-600 text-lg mb-8">Start adding products you love to your wishlist!</p>
                        <a href="{{ route('products.index') }}" 
                           class="inline-flex items-center gap-2 px-8 py-4 border-0 text-lg font-bold rounded-xl text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 transition-all duration-200 shadow-xl hover:shadow-2xl hover:scale-105">
                            <span class="material-icons">storefront</span>
                            Browse Products
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add event listeners to all remove wishlist buttons
    document.querySelectorAll('.remove-wishlist-btn').forEach(function(button) {
        button.addEventListener('click', function() {
            const productId = this.getAttribute('data-product-id');
            removeFromWishlist(productId);
        });
    });
});

function removeFromWishlist(productId) {
    if (confirm('Remove this item from your wishlist?')) {
        fetch('/wishlist/remove/' + productId, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Show toast notification if available
                if (typeof Toastify !== 'undefined') {
                    Toastify({
                        text: "Item removed from wishlist",
                        duration: 3000,
                        gravity: "top",
                        position: "right",
                        style: {
                            background: "linear-gradient(135deg, #10b981 0%, #059669 100%)",
                        }
                    }).showToast();
                }
                // Reload page after short delay
                setTimeout(() => location.reload(), 500);
            } else {
                alert(data.message || 'Error removing item from wishlist');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error removing item from wishlist');
        });
    }
}
</script>
@endsection
