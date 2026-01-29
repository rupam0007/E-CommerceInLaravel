@forelse ($products as $product)
@php
    $inWishlist = Auth::check() && Auth::user()->isInWishlist($product->id);
@endphp
<div class="product-card bg-white rounded overflow-hidden group">
    <!-- Product Image -->
    <a href="{{ route('products.show', $product) }}" class="block relative">
        @if($product->image)
            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" 
                 class="w-full h-52 object-contain p-4 group-hover:scale-105 transition-transform duration-300">
        @else
            <div class="w-full h-52 bg-gray-50 flex items-center justify-center">
                <span class="material-icons text-5xl text-gray-300">image</span>
            </div>
        @endif
        
        <!-- Discount Badge -->
        @if($product->has_discount)
            <span class="absolute top-3 left-3 bg-green-600 text-white text-xs font-semibold px-2 py-1 rounded">
                {{ number_format($product->discount_percentage, 0) }}% OFF
            </span>
        @endif
        
        <!-- Stock Badge -->
        @if($product->stock_quantity <= 5 && $product->stock_quantity > 0)
            <span class="absolute top-3 right-3 bg-red-100 text-red-600 text-xs font-medium px-2 py-1 rounded">
                Only {{ $product->stock_quantity }} left
            </span>
        @elseif($product->stock_quantity == 0)
            <span class="absolute top-3 right-3 bg-red-600 text-white text-xs font-medium px-2 py-1 rounded">
                Out of Stock
            </span>
        @endif
    </a>

    <!-- Product Details -->
    <div class="p-4">
        <!-- Category -->
        <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">{{ optional($product->category)->name }}</p>
        
        <!-- Title -->
        <h3 class="text-sm font-medium text-gray-900 mb-2 line-clamp-2 min-h-[40px]">
            <a href="{{ route('products.show', $product) }}" class="hover:text-primary-500 transition">
                {{ $product->name }}
            </a>
        </h3>
        
        <!-- Rating -->
        @php $rating = $product->reviews_avg_rating ?? 4.0; @endphp
        <div class="flex items-center gap-2 mb-3">
            <span class="inline-flex items-center gap-0.5 bg-green-600 text-white text-xs font-semibold px-1.5 py-0.5 rounded">
                {{ number_format($rating, 1) }}
                <span class="material-icons" style="font-size: 12px;">star</span>
            </span>
            <span class="text-xs text-gray-400">({{ $product->reviews_count ?? rand(10, 500) }})</span>
        </div>
        
        <!-- Price -->
        <div class="mb-3">
            @if($product->has_discount)
                <div class="flex items-center gap-2 flex-wrap">
                    <span class="text-lg font-bold text-gray-900">₹{{ number_format($product->discount_price, 0) }}</span>
                    <span class="text-sm text-gray-400 line-through">₹{{ number_format($product->price, 0) }}</span>
                </div>
                <span class="text-xs font-medium text-green-600">Save ₹{{ number_format($product->price - $product->discount_price, 0) }}</span>
            @else
                <span class="text-lg font-bold text-gray-900">₹{{ number_format($product->price, 0) }}</span>
                <span class="text-xs text-gray-500 block">Free Delivery</span>
            @endif
        </div>

        <!-- Actions -->
        <div class="flex gap-2">
            @if($product->stock_quantity > 0)
            <button class="bg-yellow-500 hover:bg-yellow-600 text-white p-2.5 rounded transition flex items-center justify-center add-to-cart-btn" 
                    data-product-id="{{ $product->id }}"
                    title="Add to Cart">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
            </button>
            @else
            <button disabled class="bg-gray-200 text-gray-500 p-2.5 rounded cursor-not-allowed" title="Out of Stock">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
            </button>
            @endif
            
            <button type="button" 
                    class="wishlist-btn p-2.5 rounded border {{ $inWishlist ? 'bg-red-500 border-red-500 text-white' : 'bg-white border-gray-200 text-gray-400 hover:text-red-500 hover:border-red-500' }} transition"
                    data-product-id="{{ $product->id }}"
                    data-in-wishlist="{{ $inWishlist ? 'true' : 'false' }}">
                <svg class="w-5 h-5 heart-icon-filled {{ $inWishlist ? '' : 'hidden' }}" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path>
                </svg>
                <svg class="w-5 h-5 heart-icon-outline {{ $inWishlist ? 'hidden' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 016.364 0L12 7.636l1.318-1.318a4.5 4.5 0 016.364 6.364L12 20.364l-7.682-7.682a4.5 4.5 0 010-6.364z"></path>
                </svg>
            </button>
        </div>
    </div>
</div>
@empty
<div class="col-span-full text-center py-16">
    <div class="bg-white rounded-lg shadow p-10 max-w-md mx-auto">
        <span class="material-icons text-gray-300 mb-4" style="font-size: 64px;">inventory_2</span>
        <h3 class="text-xl font-semibold text-gray-900 mb-2">No Products Found</h3>
        <p class="text-gray-500 mb-6">Try adjusting your filters or search terms.</p>
        <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 bg-primary-500 hover:bg-primary-600 text-white px-5 py-2.5 rounded font-medium transition">
            <span class="material-icons" style="font-size: 18px;">refresh</span>
            View All Products
        </a>
    </div>
</div>
@endforelse

@push('scripts')
<script>
(function() {
    // Add to cart functionality - using event delegation for better performance
    document.addEventListener('click', async function(e) {
        const btn = e.target.closest('.add-to-cart-btn');
        if (!btn) return;
        
        e.preventDefault();
        if (btn.disabled) return;
        
        const productId = btn.dataset.productId;
        const originalContent = btn.innerHTML;
        
        // Show loading state
        btn.innerHTML = '<svg class="w-5 h-5 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg>';
        btn.disabled = true;
        
        try {
            const response = await fetch(`/cart/add/${productId}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ quantity: 1 })
            });
            
            // Handle non-JSON responses
            const contentType = response.headers.get('content-type');
            if (!contentType || !contentType.includes('application/json')) {
                throw new Error('Please login to add items to cart');
            }
            
            const data = await response.json();
            
            if (response.status === 401) {
                showToast(data.message || 'Please login to add items to cart', 'info');
                setTimeout(() => window.location.href = data.redirect || '/login', 1000);
                return;
            }
            
            if (response.ok && data.success) {
                // Show success icon briefly
                btn.innerHTML = '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>';
                btn.classList.remove('bg-yellow-500', 'hover:bg-yellow-600');
                btn.classList.add('bg-green-500');
                showToast('Added to cart!', 'success');
                
                // Update cart badge
                if (typeof updateCartBadge === 'function') updateCartBadge();
                
                // Reset after short delay
                setTimeout(() => {
                    btn.innerHTML = originalContent;
                    btn.classList.remove('bg-green-500');
                    btn.classList.add('bg-yellow-500', 'hover:bg-yellow-600');
                    btn.disabled = false;
                }, 1000);
            } else {
                throw new Error(data.message || 'Failed to add to cart');
            }
        } catch (error) {
            btn.innerHTML = originalContent;
            btn.disabled = false;
            showToast(error.message || 'Failed to add to cart', 'error');
        }
    });
})();
</script>
@endpush
