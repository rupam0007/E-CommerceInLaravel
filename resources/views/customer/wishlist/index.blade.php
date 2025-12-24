@extends('layouts.app')

@section('title', 'My Wishlist - Nexora')

@section('content')
<div class="min-h-screen theme-bg py-8">
    <div class="container mx-auto px-4">
        <div class="max-w-7xl mx-auto">
            <div class="mb-8">
                <h1 class="text-3xl font-bold mb-2">My Wishlist</h1>
                <p class="theme-text-muted">{{ $wishlistItems->count() }} {{ Str::plural('item', $wishlistItems->count()) }} saved</p>
            </div>

            @if($wishlistItems->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach($wishlistItems as $item)
                        <div class="theme-card overflow-hidden">
                            <div class="relative">
                                @if($item->product->image)
                                    <a href="{{ route('products.show', $item->product) }}">
                                        <img src="{{ $item->product->image_url }}" 
                                             alt="{{ $item->product->name }}" 
                                             class="w-full h-48 object-cover">
                                    </a>
                                @else
                                    <div class="w-full h-48 bg-gray-100 dark:bg-gray-700 flex items-center justify-center">
                                        <span class="material-icons theme-text-muted text-5xl">image</span>
                                    </div>
                                @endif
                                
                                <button class="remove-wishlist-btn absolute top-3 right-3 bg-red-600 hover:bg-red-700 text-white p-2 rounded-full" 
                                        data-product-id="{{ $item->product->id }}">
                                    <span class="material-icons text-sm">close</span>
                                </button>

                                @if($item->product->stock_quantity > 0)
                                    <span class="absolute top-3 left-3 bg-green-600 text-white text-xs font-medium px-3 py-1 rounded-full">In Stock</span>
                                @else
                                    <span class="absolute top-3 left-3 bg-red-600 text-white text-xs font-medium px-3 py-1 rounded-full">Out of Stock</span>
                                @endif
                            </div>

                            <div class="p-4">
                                <p class="text-xs theme-text-muted mb-2">{{ $item->product->category->name }}</p>
                                
                                <h3 class="text-base font-semibold mb-3 line-clamp-2">
                                    <a href="{{ route('products.show', $item->product) }}" class="hover-theme-accent">
                                        {{ $item->product->name }}
                                    </a>
                                </h3>
                                
                                <div class="flex items-baseline justify-between mb-4">
                                    <span class="text-xl font-bold">₹{{ number_format($item->product->price, 0) }}</span>
                                    @if($item->product->stock_quantity > 0)
                                        <span class="text-xs text-green-600">Available</span>
                                    @else
                                        <span class="text-xs text-red-600">Unavailable</span>
                                    @endif
                                </div>

                                <div class="flex gap-2">
                                    @if($item->product->stock_quantity > 0)
                                        <form action="{{ route('cart.add', $item->product) }}" method="POST" class="flex-1">
                                            @csrf
                                            <input type="hidden" name="quantity" value="1">
                                            <button type="submit" 
                                                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-2 px-4 rounded-lg text-sm font-medium flex items-center justify-center gap-2">
                                                <span class="material-icons text-sm">shopping_cart</span>
                                                Add to Cart
                                            </button>
                                        </form>
                                    @else
                                        <button disabled 
                                                class="w-full bg-gray-300 dark:bg-gray-700 theme-text-muted py-2 px-4 rounded-lg text-sm font-medium cursor-not-allowed">
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
                    <div class="theme-card p-12 max-w-lg mx-auto">
                        <div class="w-24 h-24 bg-indigo-100 dark:bg-indigo-900 rounded-full flex items-center justify-center mx-auto mb-6">
                            <span class="material-icons text-indigo-600 text-5xl">favorite_border</span>
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
