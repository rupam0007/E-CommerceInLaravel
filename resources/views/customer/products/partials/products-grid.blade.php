@forelse ($products as $product)
@php
    $inWishlist = Auth::check() && Auth::user()->isInWishlist($product->id);
@endphp
<div class="relative bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden flex flex-col h-full border-2 {{ $inWishlist ? 'border-purple-400 bg-gradient-to-br from-purple-50 to-pink-50 dark:from-purple-900/20 dark:to-pink-900/20' : 'border-gray-200 dark:border-gray-700' }} hover:shadow-2xl group z-0">
    
    {{-- Product Comparison Checkbox --}}
    <div class="absolute top-3 left-3 z-10">
        <label class="flex items-center cursor-pointer group/compare">
            <input type="checkbox" class="compare-checkbox hidden" data-product-id="{{ $product->id }}" data-product-name="{{ $product->name }}">
            <div class="w-6 h-6 border-2 border-gray-400 rounded bg-white flex items-center justify-center transition-all duration-200 group-hover/compare:border-blue-500 checkbox-custom">
                <span class="material-icons text-blue-600 text-sm opacity-0 checkmark-icon">check</span>
            </div>
        </label>
    </div>

    {{-- Wishlist Button --}}
    <button type="button" 
            class="wishlist-btn absolute top-3 right-3 z-10 p-2.5 rounded-full shadow-lg {{ $inWishlist ? 'bg-gradient-to-r from-purple-500 to-pink-500 text-white wishlist-active scale-110' : 'bg-white text-gray-400 hover:text-pink-500 hover:bg-pink-50' }}"
            data-product-id="{{ $product->id }}"
            data-in-wishlist="{{ $inWishlist ? 'true' : 'false' }}">
        <svg class="w-5 h-5 heart-icon-filled {{ $inWishlist ? '' : 'hidden' }}" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path>
        </svg>
        <svg class="w-5 h-5 heart-icon-outline {{ $inWishlist ? 'hidden' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 016.364 0L12 7.636l1.318-1.318a4.5 4.5 0 016.364 6.364L12 20.364l-7.682-7.682a4.5 4.5 0 010-6.364z"></path>
        </svg>
    </button>
    
    @if($inWishlist)
    {{-- Purple "Liked" Badge --}}
    <div class="absolute top-3 left-3 z-20 bg-gradient-to-r from-purple-500 to-pink-500 text-white text-xs font-bold px-3 py-1.5 rounded-full shadow-lg flex items-center gap-1">
        <span class="material-icons text-sm">favorite</span>
        Liked
    </div>
    @endif

    {{-- Product Image --}}
    <a href="{{ route('products.show', $product) }}" class="flex-shrink-0 relative block overflow-hidden {{ $inWishlist ? 'bg-gradient-to-br from-purple-50 to-pink-50' : 'bg-gradient-to-br from-blue-50 to-indigo-50' }}">
        @if($product->image)
            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-60 object-cover object-center {{ $inWishlist ? 'opacity-95' : '' }}">
        @else
            <div class="w-full h-60 bg-gradient-to-br {{ $inWishlist ? 'from-purple-100 to-pink-100' : 'from-blue-100 to-purple-100' }} flex items-center justify-center {{ $inWishlist ? 'text-purple-600' : 'text-blue-600' }}">
                <svg class="h-20 w-20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </div>
        @endif
        
        {{-- Discount Badge --}}
        @if($product->has_discount)
            <span class="absolute top-3 right-3 bg-gradient-to-r from-red-600 to-pink-600 text-white text-sm font-black px-4 py-2 rounded-lg shadow-2xl transform rotate-3">
                {{ number_format($product->discount_percentage, 0) }}% OFF
            </span>
        @endif
        
        {{-- Colorful Stock Badges --}}
        @if($product->stock_quantity <= 5 && $product->stock_quantity > 0)
            <span class="absolute {{ $inWishlist ? 'top-14' : 'top-3' }} left-3 bg-gradient-to-r from-yellow-400 to-orange-500 text-white text-xs font-bold px-4 py-1.5 rounded-full shadow-lg">Only {{ $product->stock_quantity }} Left!</span>
        @elseif($product->stock_quantity == 0)
            <span class="absolute {{ $inWishlist ? 'top-14' : 'top-3' }} left-3 bg-gradient-to-r from-red-500 to-rose-600 text-white text-xs font-bold px-4 py-1.5 rounded-full shadow-lg">Out of Stock</span>
        @else
            <span class="absolute {{ $inWishlist ? 'top-14' : 'top-3' }} left-3 bg-gradient-to-r from-green-500 to-emerald-600 text-white text-xs font-bold px-4 py-1.5 rounded-full shadow-lg">In Stock</span>
        @endif
    </a>

    {{-- Product Details --}}
    <div class="flex-grow p-5 flex flex-col {{ $inWishlist ? 'bg-gradient-to-b from-white to-purple-50' : 'bg-white' }}">
        <div class="mb-3">
            <p class="text-xs font-bold text-gray-500 mb-2 uppercase tracking-wider {{ $inWishlist ? 'bg-purple-100 text-purple-700' : 'bg-gray-100' }} inline-block px-3 py-1 rounded-full">{{ optional($product->category)->name }}</p>
            <h3 class="text-lg font-bold {{ $inWishlist ? 'text-purple-900' : 'text-gray-900' }} leading-tight mb-2 line-clamp-2">
                <a href="{{ route('products.show', $product) }}" class="{{ $inWishlist ? 'hover:text-purple-600' : 'hover:text-blue-600' }} transition-colors">
                    {{ $product->name }}
                </a>
            </h3>
            
            {{-- Colorful Star Rating --}}
            <div class="flex items-center mt-2">
                @php $rating = $product->reviews_avg_rating ?? 0; @endphp
                <div class="flex items-center bg-gradient-to-r from-green-500 to-green-600 px-2 py-1 rounded-md">
                    <span class="text-white font-bold text-xs mr-1">{{ number_format($rating, 1) }}</span>
                    <span class="material-icons text-white text-xs">star</span>
                </div>
                <span class="text-xs font-semibold text-gray-500 ml-2">({{ $product->reviews_count ?? 0 }} reviews)</span>
            </div>
        </div>

        <div class="mt-auto pt-4 border-t-2 border-gray-100">
            <div class="flex items-baseline mb-4">
                @if($product->has_discount)
                    <div class="flex flex-col">
                        <div class="flex items-baseline gap-2">
                            <span class="text-3xl font-extrabold text-green-600">₹{{ number_format($product->discount_price, 0) }}</span>
                            <span class="text-lg line-through text-gray-400">₹{{ number_format($product->price, 0) }}</span>
                        </div>
                        <div class="flex items-center gap-2 mt-1">
                            <span class="text-xs font-bold text-white bg-gradient-to-r from-red-500 to-orange-500 px-2 py-1 rounded">{{ number_format($product->discount_percentage, 0) }}% OFF</span>
                            <span class="text-xs font-semibold text-green-600">Save ₹{{ number_format($product->discount_amount, 0) }}</span>
                        </div>
                    </div>
                @else
                    <span class="text-3xl font-extrabold text-gray-900">₹{{ number_format($product->price, 0) }}</span>
                    <span class="text-sm font-semibold text-green-600 ml-2">Free Delivery</span>
                @endif
            </div>

            <div class="flex space-x-2">
                @if($product->stock_quantity > 0)
                <button class="flex-1 bg-gradient-to-r from-orange-500 to-orange-600 text-white py-3 px-4 rounded-lg text-sm font-bold text-center hover:shadow-xl flex items-center justify-center gap-2 add-to-cart-btn" data-product-id="{{ $product->id }}">
                    <span class="material-icons text-lg">shopping_cart</span>
                    Add to Cart
                </button>
                @else
                <button disabled class="flex-1 bg-gray-200 text-gray-500 py-3 px-4 rounded-lg text-sm font-bold cursor-not-allowed">
                    Sold Out
                </button>
                @endif

                <button class="quick-view-btn flex items-center justify-center bg-white border-2 border-blue-600 text-blue-600 py-3 px-4 rounded-lg text-sm font-bold hover:bg-blue-50" 
                        data-product-id="{{ $product->id }}" 
                        title="Quick View">
                    <span class="material-icons text-lg">visibility</span>
                </button>
            </div>
        </div>
    </div>
</div>
@empty
<div class="col-span-full text-center py-16">
    <div class="bg-white rounded-xl shadow-lg p-12 max-w-md mx-auto">
        <div class="w-20 h-20 bg-gradient-to-br from-blue-100 to-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <span class="material-icons text-blue-600 text-5xl">inventory_2</span>
        </div>
        <h3 class="text-2xl font-bold text-gray-900 mb-2">No Products Found</h3>
        <p class="text-gray-600 mb-6">Try adjusting your search or filter to find what you're looking for.</p>
        <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-6 py-3 rounded-lg font-bold hover:shadow-xl transform hover:scale-105 transition-all">
            <span class="material-icons">refresh</span>
            Browse All Products
        </a>
    </div>
</div>
@endforelse

@push('scripts')
<script>
$(document).ready(function() {
    // Product comparison state
    let comparedProducts = [];
    const maxComparison = 3;

    // Handle comparison checkbox changes
    $(document).on('change', '.compare-checkbox', function() {
        const productId = $(this).data('product-id');
        const productName = $(this).data('product-name');
        const isChecked = $(this).is(':checked');

        if (isChecked) {
            if (comparedProducts.length >= maxComparison) {
                $(this).prop('checked', false);
                showToast('You can only compare up to 3 products at a time', 'error');
                return;
            }
            comparedProducts.push({ id: productId, name: productName });
        } else {
            comparedProducts = comparedProducts.filter(p => p.id != productId);
        }

        updateComparisonBar();
    });

    function updateComparisonBar() {
        const count = comparedProducts.length;
        $('#compare-count').text(count);
        
        if (count > 0) {
            $('#comparison-bar').removeClass('hidden translate-y-full');
            $('#compare-btn').prop('disabled', count < 2);
        } else {
            $('#comparison-bar').addClass('translate-y-full');
            setTimeout(() => $('#comparison-bar').addClass('hidden'), 300);
        }

        // Update product tags
        const $container = $('#compared-products');
        $container.empty();
        comparedProducts.forEach(product => {
            $container.append(`
                <div class="bg-white text-blue-600 px-3 py-1 rounded-full text-sm font-semibold flex items-center gap-2">
                    ${product.name.substring(0, 20)}...
                    <button onclick="removeFromComparison(${product.id})" class="hover:text-red-600">
                        <span class="material-icons text-sm">close</span>
                    </button>
                </div>
            `);
        });

        // Update checkbox visuals
        $('.compare-checkbox').each(function() {
            const checkbox = $(this);
            const checkboxCustom = checkbox.siblings('.checkbox-custom');
            const checkmark = checkboxCustom.find('.checkmark-icon');
            
            if (checkbox.is(':checked')) {
                checkboxCustom.addClass('bg-blue-600 border-blue-600');
                checkmark.removeClass('opacity-0');
            } else {
                checkboxCustom.removeClass('bg-blue-600 border-blue-600');
                checkmark.addClass('opacity-0');
            }
        });
    }

    // Quick View functionality
    $(document).on('click', '.quick-view-btn', function() {
        const productId = $(this).data('product-id');
        openQuickView(productId);
    });

    window.openQuickView = function(productId) {
        $('#quick-view-modal').removeClass('hidden');
        $('body').css('overflow', 'hidden');
        
        // Load product details
        $.ajax({
            url: `/products/${productId}/quick-view`,
            type: 'GET',
            success: function(response) {
                $('#quick-view-content').html(response);
            },
            error: function() {
                $('#quick-view-content').html(`
                    <div class="text-center py-12">
                        <span class="material-icons text-red-500 text-6xl mb-4">error</span>
                        <p class="text-gray-600 dark:text-gray-300">Failed to load product details</p>
                    </div>
                `);
            }
        });
    };

    window.closeQuickView = function() {
        $('#quick-view-modal').addClass('hidden');
        $('body').css('overflow', '');
    };

    window.removeFromComparison = function(productId) {
        $(`.compare-checkbox[data-product-id="${productId}"]`).prop('checked', false).trigger('change');
    };

    window.clearComparison = function() {
        $('.compare-checkbox').prop('checked', false);
        comparedProducts = [];
        updateComparisonBar();
    };

    window.openComparisonModal = function() {
        if (comparedProducts.length < 2) return;
        
        $('#comparison-modal').removeClass('hidden');
        $('body').css('overflow', 'hidden');
        
        const productIds = comparedProducts.map(p => p.id).join(',');
        
        $.ajax({
            url: `/products/compare?ids=${productIds}`,
            type: 'GET',
            success: function(response) {
                $('#comparison-content').html(response);
            },
            error: function() {
                $('#comparison-content').html(`
                    <div class="text-center py-12">
                        <span class="material-icons text-red-500 text-6xl mb-4">error</span>
                        <p class="text-gray-600">Failed to load comparison</p>
                    </div>
                `);
            }
        });
    };

    window.closeComparisonModal = function() {
        $('#comparison-modal').addClass('hidden');
        $('body').css('overflow', '');
    };

    function showToast(message, type = 'info') {
        if (typeof Toastify !== 'undefined') {
            const backgrounds = {
                success: 'linear-gradient(135deg, #10b981 0%, #059669 100%)',
                error: 'linear-gradient(135deg, #ef4444 0%, #dc2626 100%)',
                info: 'linear-gradient(135deg, #3b82f6 0%, #2563eb 100%)'
            };
            
            Toastify({
                text: message,
                duration: 3000,
                gravity: 'top',
                position: 'right',
                style: {
                    background: backgrounds[type] || backgrounds.info
                }
            }).showToast();
        }
    }

    // Add to Cart AJAX functionality
    $(document).on('click', '.add-to-cart-btn', function(e) {
        e.preventDefault();
        
        const $btn = $(this);
        const productId = $btn.data('product-id');
        const originalHtml = $btn.html();
        
        // Disable button and show loading state
        $btn.prop('disabled', true).html('<span class="material-icons animate-spin">refresh</span> Adding...');
        
        $.ajax({
            url: `/cart/add/${productId}`,
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Accept': 'application/json'
            },
            data: {
                quantity: 1
            },
            success: function(response) {
                if (response.success) {
                    // Update cart count
                    $('#cart-count').text(response.count);
                    
                    // Show success state
                    $btn.html('<span class="material-icons">check_circle</span> Added!').removeClass('from-orange-500 to-orange-600').addClass('from-green-500 to-green-600');
                    
                    // Show toast notification
                    if (typeof Toastify !== 'undefined') {
                        Toastify({
                            text: "Product added to cart successfully!",
                            duration: 3000,
                            gravity: "top",
                            position: "right",
                            style: {
                                background: "linear-gradient(135deg, #10b981 0%, #059669 100%)",
                            }
                        }).showToast();
                    }
                    
                    // Reset button after 2 seconds
                    setTimeout(function() {
                        $btn.html(originalHtml).removeClass('from-green-500 to-green-600').addClass('from-orange-500 to-orange-600').prop('disabled', false);
                    }, 2000);
                }
            },
            error: function(xhr) {
                console.error('Error adding to cart:', xhr);
                $btn.html(originalHtml).prop('disabled', false);
                
                if (typeof Toastify !== 'undefined') {
                    Toastify({
                        text: xhr.responseJSON?.message || "Error adding to cart. Please try again.",
                        duration: 3000,
                        gravity: "top",
                        position: "right",
                        style: {
                            background: "linear-gradient(135deg, #ef4444 0%, #dc2626 100%)",
                        }
                    }).showToast();
                }
            }
        });
    });

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
                        // Added to wishlist
                        $btn.removeClass('bg-white text-gray-400 hover:text-pink-500 hover:bg-pink-50')
                            .addClass('bg-gradient-to-r from-pink-500 to-rose-500 text-white wishlist-active');
                        $btn.find('.heart-icon-outline').addClass('hidden');
                        $btn.find('.heart-icon-filled').removeClass('hidden');
                    } else {
                        // Removed from wishlist
                        $btn.removeClass('bg-gradient-to-r from-pink-500 to-rose-500 text-white wishlist-active')
                            .addClass('bg-white text-gray-400 hover:text-pink-500 hover:bg-pink-50');
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
                                background: newState ? "linear-gradient(135deg, #ec4899 0%, #f43f5e 100%)" : "linear-gradient(135deg, #10b981 0%, #059669 100%)",
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

<!-- Quick View Modal -->
<div id="quick-view-modal" class="hidden fixed inset-0 z-50 overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="fixed inset-0 bg-black opacity-50" onclick="closeQuickView()"></div>
        <div class="relative bg-white dark:bg-gray-800 rounded-lg max-w-4xl w-full p-6 z-10">
            <button onclick="closeQuickView()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
                <span class="material-icons">close</span>
            </button>
            <div id="quick-view-content">
                <div class="text-center py-12">
                    <span class="material-icons animate-spin text-indigo-600 text-6xl">refresh</span>
                    <p class="text-gray-600 dark:text-gray-300 mt-4">Loading...</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Comparison Modal -->
<div id="comparison-modal" class="hidden fixed inset-0 z-50 overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="fixed inset-0 bg-black opacity-50" onclick="closeComparisonModal()"></div>
        <div class="relative bg-white dark:bg-gray-800 rounded-lg max-w-7xl w-full p-6 z-10">
            <button onclick="closeComparisonModal()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
                <span class="material-icons">close</span>
            </button>
            <div id="comparison-content">
                <div class="text-center py-12">
                    <span class="material-icons animate-spin text-indigo-600 text-6xl">refresh</span>
                    <p class="text-gray-600 dark:text-gray-300 mt-4">Loading comparison...</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Comparison Bar -->
<div id="comparison-bar" class="hidden fixed bottom-0 left-0 right-0 bg-indigo-600 text-white p-4 shadow-lg transform translate-y-full z-40">
    <div class="max-w-7xl mx-auto flex items-center justify-between">
        <div class="flex items-center gap-4">
            <span class="font-bold">Compare Products (<span id="compare-count">0</span>/3)</span>
            <div id="compared-products" class="flex gap-2"></div>
        </div>
        <div class="flex gap-2">
            <button onclick="clearComparison()" class="px-4 py-2 bg-white text-indigo-600 rounded-lg font-medium hover:bg-gray-100">
                Clear All
            </button>
            <button id="compare-btn" onclick="openComparisonModal()" class="px-4 py-2 bg-white text-indigo-600 rounded-lg font-medium hover:bg-gray-100" disabled>
                Compare Now
            </button>
        </div>
    </div>
</div>
@endpush