@extends('layouts.app')

@section('title', 'My Wishlist')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-6xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">My Wishlist</h1>

        @if($wishlistItems->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($wishlistItems as $item)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                        <div class="relative">
                            @if($item->product->image)
                                <img src="{{ $item->product->image_url }}" 
                                     alt="{{ $item->product->name }}" 
                                     class="w-full h-48 object-cover">
                            @else
                                <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                    <span class="text-gray-400">No Image</span>
                                </div>
                            @endif
                            
                            <!-- Remove from wishlist button -->
                            <button class="remove-wishlist-btn absolute top-2 right-2 bg-red-500 hover:bg-red-600 text-white p-2 rounded-full transition-colors duration-200" 
                                    data-product-id="{{ $item->product->id }}">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        </div>

                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">
                                <a href="{{ route('products.show', $item->product) }}" class="hover:text-blue-600">
                                    {{ $item->product->name }}
                                </a>
                            </h3>
                            
                            <p class="text-sm text-gray-600 mb-2">{{ $item->product->category->name }}</p>
                            
                            <div class="flex items-center justify-between mb-4">
                                <span class="text-xl font-bold text-gray-900">₹{{ number_format($item->product->price, 2) }}</span>
                                @if($item->product->stock_quantity > 0)
                                    <span class="text-sm text-green-600 font-medium">In Stock</span>
                                @else
                                    <span class="text-sm text-red-600 font-medium">Out of Stock</span>
                                @endif
                            </div>

                            <div class="flex space-x-2">
                                @if($item->product->stock_quantity > 0)
                                    <form action="{{ route('cart.add', $item->product) }}" method="POST" class="flex-1">
                                        @csrf
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" 
                                                class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-md transition-colors duration-200 text-sm font-medium">
                                            Add to Cart
                                        </button>
                                    </form>
                                @else
                                    <button disabled 
                                            class="w-full bg-gray-300 text-gray-500 py-2 px-4 rounded-md text-sm font-medium cursor-not-allowed">
                                        Out of Stock
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12">
                <div class="mb-4">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Your wishlist is empty</h3>
                <p class="text-gray-600 mb-6">Start adding products you love to your wishlist!</p>
                <a href="{{ route('products.index') }}" 
                   class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 transition-colors duration-200">
                    Browse Products
                </a>
            </div>
        @endif
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
    if (confirm('Are you sure you want to remove this item from your wishlist?')) {
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
                location.reload();
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
