@forelse ($products as $product)
<div class="relative bg-white rounded-2xl shadow-md overflow-hidden flex flex-col h-full border border-gray-100 hover:shadow-2xl hover:scale-[1.02] transition-all duration-300 ease-in-out group">
    
    {{-- Wishlist Button --}}
    @php
        $inWishlist = Auth::check() && Auth::user()->isInWishlist($product->id);
    @endphp
    <button type="button" 
            class="wishlist-btn absolute top-3 right-3 z-20 p-2.5 rounded-full shadow-lg backdrop-blur-md transition-all duration-200 {{ $inWishlist ? 'bg-gradient-to-r from-red-500 to-pink-600 text-white wishlist-active scale-110' : 'bg-white text-gray-400 hover:text-red-500' }}"
            data-product-id="{{ $product->id }}"
            data-in-wishlist="{{ $inWishlist ? 'true' : 'false' }}">
        <svg class="w-5 h-5 heart-icon-filled {{ $inWishlist ? '' : 'hidden' }}" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path>
        </svg>
        <svg class="w-5 h-5 heart-icon-outline {{ $inWishlist ? 'hidden' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 016.364 0L12 7.636l1.318-1.318a4.5 4.5 0 016.364 6.364L12 20.364l-7.682-7.682a4.5 4.5 0 010-6.364z"></path>
        </svg>
    </button>

    {{-- Product Image --}}
    <a href="{{ route('products.show', $product) }}" class="flex-shrink-0 relative block overflow-hidden bg-[#F5EFE6]">
        @if($product->image)
            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-56 object-cover object-center transform group-hover:scale-110 transition-all duration-500">
        @else
            <div class="w-full h-56 bg-gradient-to-br from-blue-50 via-purple-50 to-pink-50 flex items-center justify-center text-gray-400">
                <svg class="h-16 w-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </div>
        @endif
        
        {{-- Stock Badge --}}
        @if($product->stock_quantity <= 5 && $product->stock_quantity > 0)
            <span class="absolute top-3 left-3 bg-gradient-to-r from-yellow-400 to-orange-500 text-white text-xs font-bold px-3 py-1.5 rounded-full shadow-lg">Only {{ $product->stock_quantity }} Left</span>
        @elseif($product->stock_quantity == 0)
            <span class="absolute top-3 left-3 bg-gradient-to-r from-red-500 to-pink-600 text-white text-xs font-bold px-3 py-1.5 rounded-full shadow-lg">Out of Stock</span>
        @endif
    </a>

    {{-- Product Details --}}
    <div class="flex-grow p-5 flex flex-col">
        <div class="mb-3">
            <p class="text-xs font-semibold text-blue-600 mb-2 uppercase tracking-wider">{{ optional($product->category)->name }}</p>
            <h3 class="text-lg font-bold text-gray-900 leading-tight mb-2">
                <a href="{{ route('products.show', $product) }}" class="hover:text-blue-600 transition-colors line-clamp-2">
                    {{ $product->name }}
                </a>
            </h3>
            
            {{-- Star Rating --}}
            <div class="flex items-center mt-2">
                @php $rating = $product->reviews_avg_rating ?? 0; @endphp
                @for($i = 1; $i <= 5; $i++)
                    <svg class="w-4 h-4 {{ $i <= round($rating) ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                    </svg>
                @endfor
                <span class="text-xs font-medium text-gray-600 ml-2">({{ number_format($rating, 1) }})</span>
            </div>
        </div>

        <div class="mt-auto pt-4 border-t border-gray-100">
            <div class="flex items-baseline mb-4">
                <span class="text-2xl font-black text-gray-900">₹{{ number_format($product->price, 0) }}</span>
            </div>

            <div class="flex space-x-2">
                <a href="{{ route('products.show', $product) }}" class="flex-1 bg-gray-100 text-gray-900 py-2.5 px-3 rounded-lg text-sm font-bold text-center hover:bg-gray-200 transition-all">
                    View Details
                </a>

                @if($product->stock_quantity > 0)
                <form action="{{ route('cart.add', $product) }}" method="POST" class="flex-1">
                    @csrf
                    <input type="hidden" name="quantity" value="1">
                    <button type="submit" class="w-full bg-gradient-to-r from-orange-500 to-pink-500 text-white py-2.5 px-3 rounded-lg text-sm font-bold hover:from-orange-600 hover:to-pink-600 transition-all flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        Add to Cart
                    </button>
                </form>
                @else
                <button disabled class="flex-1 bg-gray-200 text-gray-500 py-2.5 px-3 rounded-lg text-sm font-bold cursor-not-allowed">
                    Sold Out
                </button>
                @endif
            </div>
        </div>
    </div>
</div>
@empty
<div class="col-span-full text-center py-12">
    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
    </svg>
    <h3 class="mt-2 text-lg font-medium text-gray-900">No products found</h3>
    <p class="mt-1 text-sm text-gray-500">Try adjusting your search or filter to find what you're looking for.</p>
</div>
@endforelse

@push('scripts')
<script>
$(document).ready(function() {
    // Wishlist AJAX functionality
    $(document).on('click', '.wishlist-btn', function(e) {
        e.preventDefault();
        
        const $btn = $(this);
        const productId = $btn.data('product-id');
        const isInWishlist = $btn.data('in-wishlist') === 'true';
        
        // Check if user is authenticated
        @guest
            window.location.href = "{{ route('login') }}";
            return;
        @endguest
        
        // Disable button during request
        $btn.prop('disabled', true).css('opacity', '0.6');
        
        $.ajax({
            url: `/wishlist/toggle/${productId}`,
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Accept': 'application/json'
            },
            success: function(response) {
                if (response.success) {
                    // Toggle button state
                    const newState = response.inWishlist;
                    $btn.data('in-wishlist', newState);
                    
                    if (newState) {
                        // Added to wishlist - show red filled heart
                        $btn.removeClass('bg-gray-800 text-gray-400')
                            .addClass('bg-red-600 text-white wishlist-active');
                        $btn.find('.heart-icon-outline').addClass('hidden');
                        $btn.find('.heart-icon-filled').removeClass('hidden');
                    } else {
                        // Removed from wishlist - show gray outline heart
                        $btn.removeClass('bg-red-600 text-white wishlist-active')
                            .addClass('bg-gray-800 text-gray-400');
                        $btn.find('.heart-icon-filled').addClass('hidden');
                        $btn.find('.heart-icon-outline').removeClass('hidden');
                    }
                    
                    // Update wishlist count in navbar
                    $('#wishlist-count').text(response.count);
                    
                    // Show toast notification
                    if (typeof Toastify !== 'undefined') {
                        Toastify({
                            text: response.message,
                            duration: 3000,
                            gravity: "top",
                            position: "right",
                            style: {
                                background: newState ? "linear-gradient(135deg, #ef4444 0%, #dc2626 100%)" : "linear-gradient(135deg, #10b981 0%, #059669 100%)",
                            }
                        }).showToast();
                    }
                }
            },
            error: function(xhr) {
                console.error('Error toggling wishlist:', xhr);
                if (typeof Toastify !== 'undefined') {
                    Toastify({
                        text: "Error updating wishlist. Please try again.",
                        duration: 3000,
                        gravity: "top",
                        position: "right",
                        style: {
                            background: "linear-gradient(135deg, #ef4444 0%, #dc2626 100%)",
                        }
                    }).showToast();
                }
            },
            complete: function() {
                // Re-enable button
                $btn.prop('disabled', false).css('opacity', '1');
            }
        });
    });
});
</script>
@endpush