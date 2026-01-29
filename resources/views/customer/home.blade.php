@extends('layouts.app')

@section('title', 'Nexora - Premium Online Shopping')

@section('content')

<!-- Hero Section - Minimal -->
<section class="bg-gradient-to-br from-gray-50 to-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-12 md:py-20">
        <div class="grid md:grid-cols-2 gap-12 items-center">
            <div>
                <span class="inline-flex items-center gap-2 text-primary-600 text-sm font-semibold mb-4">
                    <span class="w-8 h-0.5 bg-primary-500"></span>
                    NEW COLLECTION
                </span>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-dark-900 leading-tight mb-6">
                    Discover Your 
                    <span class="gradient-text">Perfect Style</span>
                </h1>
                <p class="text-lg text-dark-500 mb-8 max-w-lg">
                    Explore our curated collection of premium products. Quality meets affordability.
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 bg-dark-900 hover:bg-dark-800 text-white px-8 py-4 rounded-full font-semibold transition-all hover:shadow-lg hover:shadow-dark-900/20">
                        Shop Now
                        <span class="material-icons-outlined text-lg">arrow_forward</span>
                    </a>
                    <a href="{{ route('products.index', ['sort' => 'newest']) }}" class="inline-flex items-center gap-2 border-2 border-dark-200 hover:border-dark-900 text-dark-700 px-8 py-4 rounded-full font-semibold transition-colors">
                        New Arrivals
                    </a>
                </div>
            </div>
            <div class="relative">
                <div class="absolute inset-0 bg-gradient-to-br from-primary-100 to-primary-50 rounded-3xl transform rotate-3"></div>
                <img src="https://images.unsplash.com/photo-1441986300917-64674bd600d8?w=600&h=500&fit=crop" 
                     alt="Shopping" class="relative rounded-3xl shadow-2xl w-full object-cover" style="height: 400px;">
            </div>
        </div>
    </div>
</section>

<!-- Features Strip -->
<section class="bg-white border-y border-gray-100 py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 bg-primary-50 rounded-xl flex items-center justify-center">
                    <span class="material-icons-outlined text-primary-500">local_shipping</span>
                </div>
                <div>
                    <p class="font-semibold text-dark-900 text-sm">Free Shipping</p>
                    <p class="text-xs text-dark-500">On orders over ₹499</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 bg-primary-50 rounded-xl flex items-center justify-center">
                    <span class="material-icons-outlined text-primary-500">verified</span>
                </div>
                <div>
                    <p class="font-semibold text-dark-900 text-sm">Genuine Products</p>
                    <p class="text-xs text-dark-500">100% Authentic</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 bg-primary-50 rounded-xl flex items-center justify-center">
                    <span class="material-icons-outlined text-primary-500">autorenew</span>
                </div>
                <div>
                    <p class="font-semibold text-dark-900 text-sm">Easy Returns</p>
                    <p class="text-xs text-dark-500">30-day return policy</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 bg-primary-50 rounded-xl flex items-center justify-center">
                    <span class="material-icons-outlined text-primary-500">support_agent</span>
                </div>
                <div>
                    <p class="font-semibold text-dark-900 text-sm">24/7 Support</p>
                    <p class="text-xs text-dark-500">Always here to help</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Categories Section -->
<section class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="flex items-center justify-between mb-10">
            <div>
                <h2 class="text-2xl md:text-3xl font-bold text-dark-900">Shop by Category</h2>
                <p class="text-dark-500 mt-1">Find what you're looking for</p>
            </div>
            <a href="{{ route('products.index') }}" class="text-primary-500 hover:text-primary-600 font-semibold text-sm flex items-center gap-1">
                View All <span class="material-icons-outlined text-lg">arrow_forward</span>
            </a>
        </div>
        
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-4">
            @if(isset($navCategories) && $navCategories->count() > 0)
                @foreach($navCategories as $cat)
                    <a href="{{ route('products.index', ['category' => $cat->id]) }}" 
                       class="group bg-white rounded-2xl p-6 border border-gray-100 hover:border-primary-200 hover:shadow-lg hover:shadow-primary-100/50 transition-all text-center">
                        <div class="w-14 h-14 mx-auto mb-4 bg-gradient-to-br from-gray-100 to-gray-50 rounded-2xl flex items-center justify-center group-hover:from-primary-100 group-hover:to-primary-50 transition-all">
                            <span class="material-icons-outlined text-2xl text-dark-400 group-hover:text-primary-500 transition-colors">category</span>
                        </div>
                        <h3 class="font-semibold text-dark-800 group-hover:text-primary-600 transition-colors">{{ $cat->name }}</h3>
                    </a>
                @endforeach
            @else
                @php
                    $defaultCats = [
                        ['name' => 'Electronics', 'icon' => 'devices', 'search' => 'electronics'],
                        ['name' => 'Fashion', 'icon' => 'checkroom', 'search' => 'fashion'],
                        ['name' => 'Home', 'icon' => 'weekend', 'search' => 'home'],
                        ['name' => 'Beauty', 'icon' => 'spa', 'search' => 'beauty'],
                        ['name' => 'Sports', 'icon' => 'fitness_center', 'search' => 'sports'],
                        ['name' => 'Books', 'icon' => 'menu_book', 'search' => 'books'],
                    ];
                @endphp
                @foreach($defaultCats as $cat)
                    <a href="{{ route('products.index', ['search' => $cat['search']]) }}" 
                       class="group bg-white rounded-2xl p-6 border border-gray-100 hover:border-primary-200 hover:shadow-lg hover:shadow-primary-100/50 transition-all text-center">
                        <div class="w-14 h-14 mx-auto mb-4 bg-gradient-to-br from-gray-100 to-gray-50 rounded-2xl flex items-center justify-center group-hover:from-primary-100 group-hover:to-primary-50 transition-all">
                            <span class="material-icons-outlined text-2xl text-dark-400 group-hover:text-primary-500 transition-colors">{{ $cat['icon'] }}</span>
                        </div>
                        <h3 class="font-semibold text-dark-800 group-hover:text-primary-600 transition-colors">{{ $cat['name'] }}</h3>
                    </a>
                @endforeach
            @endif
        </div>
    </div>
</section>

<!-- Featured Products -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="flex items-center justify-between mb-10">
            <div>
                <h2 class="text-2xl md:text-3xl font-bold text-dark-900">Featured Products</h2>
                <p class="text-dark-500 mt-1">Handpicked just for you</p>
            </div>
            <a href="{{ route('products.index') }}" class="text-primary-500 hover:text-primary-600 font-semibold text-sm flex items-center gap-1">
                View All <span class="material-icons-outlined text-lg">arrow_forward</span>
            </a>
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
            @forelse($featuredProducts ?? [] as $product)
                <div class="product-card group overflow-hidden">
                    <div class="relative aspect-square overflow-hidden">
                        <a href="{{ route('products.show', $product) }}">
                            @if($product->image)
                                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" 
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @else
                                <div class="w-full h-full bg-gray-100 flex items-center justify-center">
                                    <span class="material-icons-outlined text-4xl text-gray-300">image</span>
                                </div>
                            @endif
                        </a>
                        
                        @if($product->has_discount)
                            <span class="discount-badge absolute top-3 left-3">
                                -{{ round($product->discount_percentage) }}%
                            </span>
                        @endif
                        
                        <button class="wishlist-btn absolute top-3 right-3 w-9 h-9 rounded-full flex items-center justify-center transition-all shadow-sm
                            {{ $product->isInWishlist ? 'bg-red-500 text-white' : 'bg-white/90 text-dark-400 hover:text-red-500' }}"
                            data-product-id="{{ $product->id }}"
                            data-in-wishlist="{{ $product->isInWishlist ? 'true' : 'false' }}">
                            <span class="material-icons-outlined text-lg heart-icon-outline {{ $product->isInWishlist ? 'hidden' : '' }}">favorite_border</span>
                            <span class="material-icons-outlined text-lg heart-icon-filled {{ $product->isInWishlist ? '' : 'hidden' }}">favorite</span>
                        </button>
                        
                        <!-- Quick Add to Cart Button -->
                        @if($product->stock_quantity > 0)
                        <button class="add-to-cart-btn absolute bottom-3 right-3 w-10 h-10 bg-primary-500 hover:bg-primary-600 text-white rounded-full flex items-center justify-center shadow-lg opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-y-2 group-hover:translate-y-0"
                            data-product-id="{{ $product->id }}"
                            title="Add to Cart">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </button>
                        @endif
                    </div>
                    
                    <div class="p-4">
                        <a href="{{ route('products.show', $product) }}" class="block">
                            <h3 class="font-medium text-dark-800 mb-1 truncate group-hover:text-primary-600 transition-colors">{{ $product->name }}</h3>
                        </a>
                        
                        @if($product->reviews_avg_rating)
                            <div class="flex items-center gap-1 mb-2">
                                <span class="text-yellow-500 text-sm">★</span>
                                <span class="text-xs text-dark-600 font-medium">{{ number_format($product->reviews_avg_rating, 1) }}</span>
                            </div>
                        @endif
                        
                        <div class="flex items-center justify-between">
                            <div class="flex items-baseline gap-2">
                                <span class="text-lg font-bold text-dark-900">₹{{ number_format($product->final_price, 0) }}</span>
                                @if($product->has_discount)
                                    <span class="text-sm text-dark-400 line-through">₹{{ number_format($product->price, 0) }}</span>
                                @endif
                            </div>
                            @if($product->stock_quantity <= 0)
                                <span class="text-xs text-red-500 font-medium">Out of Stock</span>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-4 text-center py-12">
                    <span class="material-icons-outlined text-5xl text-gray-300 mb-4">inventory_2</span>
                    <p class="text-dark-500">No products available yet</p>
                    <a href="{{ route('products.index') }}" class="text-primary-500 font-medium mt-2 inline-block">Browse all products</a>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Promo Banner -->
<section class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-dark-900 to-dark-800 p-8 md:p-12">
            <div class="absolute inset-0 opacity-10">
                <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                    <defs>
                        <pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse">
                            <path d="M 10 0 L 0 0 0 10" fill="none" stroke="white" stroke-width="0.5"/>
                        </pattern>
                    </defs>
                    <rect width="100" height="100" fill="url(#grid)"/>
                </svg>
            </div>
            
            <div class="relative z-10 max-w-xl">
                <span class="inline-block bg-primary-500 text-white text-xs font-bold px-4 py-1.5 rounded-full mb-4">LIMITED OFFER</span>
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Get 20% Off Your First Order</h2>
                <p class="text-gray-300 mb-6">Sign up today and receive exclusive discounts on your first purchase. Don't miss out!</p>
                <a href="{{ route('register') }}" class="inline-flex items-center gap-2 bg-white hover:bg-gray-100 text-dark-900 px-8 py-4 rounded-full font-semibold transition-colors">
                    Create Account
                    <span class="material-icons-outlined text-lg">arrow_forward</span>
                </a>
            </div>
            
            <div class="absolute right-0 bottom-0 opacity-20 md:opacity-40">
                <span class="material-icons-outlined text-[200px] text-white">shopping_bag</span>
            </div>
        </div>
    </div>
</section>

<!-- New Arrivals -->
@if(isset($newArrivals) && $newArrivals->count() > 0)
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="flex items-center justify-between mb-10">
            <div>
                <h2 class="text-2xl md:text-3xl font-bold text-dark-900">New Arrivals</h2>
                <p class="text-dark-500 mt-1">Fresh drops this week</p>
            </div>
            <a href="{{ route('products.index', ['sort' => 'newest']) }}" class="text-primary-500 hover:text-primary-600 font-semibold text-sm flex items-center gap-1">
                View All <span class="material-icons-outlined text-lg">arrow_forward</span>
            </a>
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
            @foreach($newArrivals as $product)
                <div class="product-card group overflow-hidden">
                    <div class="relative aspect-square overflow-hidden">
                        <a href="{{ route('products.show', $product) }}">
                            @if($product->image)
                                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" 
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @else
                                <div class="w-full h-full bg-gray-100 flex items-center justify-center">
                                    <span class="material-icons-outlined text-4xl text-gray-300">image</span>
                                </div>
                            @endif
                        </a>
                        
                        <span class="absolute top-3 left-3 bg-dark-900 text-white text-[10px] font-bold px-3 py-1 rounded-full">NEW</span>
                        
                        <button class="wishlist-btn absolute top-3 right-3 w-9 h-9 rounded-full flex items-center justify-center transition-all shadow-sm
                            {{ $product->isInWishlist ? 'bg-red-500 text-white' : 'bg-white/90 text-dark-400 hover:text-red-500' }}"
                            data-product-id="{{ $product->id }}"
                            data-in-wishlist="{{ $product->isInWishlist ? 'true' : 'false' }}">
                            <span class="material-icons-outlined text-lg heart-icon-outline {{ $product->isInWishlist ? 'hidden' : '' }}">favorite_border</span>
                            <span class="material-icons-outlined text-lg heart-icon-filled {{ $product->isInWishlist ? '' : 'hidden' }}">favorite</span>
                        </button>
                        
                        <!-- Quick Add to Cart Button -->
                        @if($product->stock_quantity > 0)
                        <button class="add-to-cart-btn absolute bottom-3 right-3 w-10 h-10 bg-primary-500 hover:bg-primary-600 text-white rounded-full flex items-center justify-center shadow-lg opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-y-2 group-hover:translate-y-0"
                            data-product-id="{{ $product->id }}"
                            title="Add to Cart">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </button>
                        @endif
                    </div>
                    
                    <div class="p-4">
                        <a href="{{ route('products.show', $product) }}" class="block">
                            <h3 class="font-medium text-dark-800 mb-1 truncate group-hover:text-primary-600 transition-colors">{{ $product->name }}</h3>
                        </a>
                        
                        <div class="flex items-center justify-between">
                            <div class="flex items-baseline gap-2">
                                <span class="text-lg font-bold text-dark-900">₹{{ number_format($product->final_price, 0) }}</span>
                                @if($product->has_discount)
                                    <span class="text-sm text-dark-400 line-through">₹{{ number_format($product->price, 0) }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Newsletter -->
<section class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="bg-gradient-to-br from-primary-50 to-primary-100/50 rounded-3xl p-8 md:p-12 text-center">
            <h2 class="text-2xl md:text-3xl font-bold text-dark-900 mb-3">Stay in the Loop</h2>
            <p class="text-dark-500 mb-8 max-w-lg mx-auto">Subscribe to our newsletter for exclusive deals, new arrivals, and style tips.</p>
            
            <form class="max-w-md mx-auto flex gap-3">
                <input type="email" placeholder="Enter your email" 
                       class="flex-1 px-5 py-3.5 rounded-full border-0 bg-white shadow-sm focus:outline-none focus:ring-2 focus:ring-primary-500/20 text-sm">
                <button type="submit" class="bg-dark-900 hover:bg-dark-800 text-white px-8 py-3.5 rounded-full font-semibold transition-colors whitespace-nowrap">
                    Subscribe
                </button>
            </form>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
(function() {
    // Add to cart functionality for home page
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
                btn.innerHTML = '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>';
                btn.classList.remove('bg-primary-500', 'hover:bg-primary-600');
                btn.classList.add('bg-green-500');
                showToast('Added to cart!', 'success');
                
                if (typeof updateCartBadge === 'function') updateCartBadge();
                
                setTimeout(() => {
                    btn.innerHTML = originalContent;
                    btn.classList.remove('bg-green-500');
                    btn.classList.add('bg-primary-500', 'hover:bg-primary-600');
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
