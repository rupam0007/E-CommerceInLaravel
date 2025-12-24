@extends('layouts.app')

@section('title', 'Nexora - Your Electronics Store')

@section('content')

<!-- Hero Slider Section -->
<div class="relative overflow-hidden theme-bg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid lg:grid-cols-2 gap-8">
            <!-- Main Banner -->
            <div class="relative group cursor-pointer overflow-hidden rounded-2xl">
                <img src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=800&h=400&fit=crop" 
                     alt="Featured Product" 
                     class="w-full h-80 lg:h-96 object-cover transform group-hover:scale-105 transition duration-500">
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent"></div>
                <div class="absolute bottom-0 left-0 p-8 text-white">
                    <span class="inline-block px-3 py-1 bg-purple-600 rounded-full text-xs font-medium mb-3">NEW ARRIVAL</span>
                    <h2 class="text-3xl lg:text-4xl font-bold mb-2">Premium Headphones</h2>
                    <p class="text-white/90 mb-4">Experience crystal clear sound</p>
                    <a href="{{ route('products.index') }}" class="inline-block px-6 py-3 bg-white text-purple-600 font-semibold rounded-lg hover:bg-purple-50 transition">
                        Shop Now
                    </a>
                </div>
            </div>

            <!-- Secondary Banners -->
            <div class="grid grid-rows-2 gap-8">
                <div class="relative group cursor-pointer overflow-hidden rounded-2xl">
                    <img src="https://images.unsplash.com/photo-1546868871-7041f2a55e12?w=600&h=200&fit=crop" 
                         alt="Smart Watches" 
                         class="w-full h-36 lg:h-44 object-cover transform group-hover:scale-105 transition duration-500">
                    <div class="absolute inset-0 bg-gradient-to-r from-purple-600/80 to-transparent"></div>
                    <div class="absolute inset-0 flex items-center px-6">
                        <div class="text-white">
                            <h3 class="text-xl font-bold mb-1">Smart Watches</h3>
                            <p class="text-sm mb-2">Up to 40% OFF</p>
                            <span class="text-xs font-medium underline">Explore →</span>
                        </div>
                    </div>
                </div>
                <div class="relative group cursor-pointer overflow-hidden rounded-2xl">
                    <img src="https://images.unsplash.com/photo-1588872657578-7efd1f1555ed?w=600&h=200&fit=crop" 
                         alt="Tablets" 
                         class="w-full h-36 lg:h-44 object-cover transform group-hover:scale-105 transition duration-500">
                    <div class="absolute inset-0 bg-gradient-to-r from-blue-600/80 to-transparent"></div>
                    <div class="absolute inset-0 flex items-center px-6">
                        <div class="text-white">
                            <h3 class="text-xl font-bold mb-1">Latest Tablets</h3>
                            <p class="text-sm mb-2">Starting at ₹15,999</p>
                            <span class="text-xs font-medium underline">Shop Now →</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Features Section -->
<div class="theme-surface py-12 border-y theme-border">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <!-- Feature 1 -->
            <div class="flex items-center gap-4 p-4 rounded-xl hover-theme-surface transition">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900/30 rounded-xl flex items-center justify-center">
                        <span class="material-icons text-purple-600 dark:text-purple-400 text-2xl">local_shipping</span>
                    </div>
                </div>
                <div>
                    <h3 class="font-semibold text-sm">Free Delivery</h3>
                    <p class="text-xs theme-text-muted">For orders above ₹499</p>
                </div>
            </div>

            <!-- Feature 2 -->
            <div class="flex items-center gap-4 p-4 rounded-xl hover-theme-surface transition">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900/30 rounded-xl flex items-center justify-center">
                        <span class="material-icons text-purple-600 dark:text-purple-400 text-2xl">verified_user</span>
                    </div>
                </div>
                <div>
                    <h3 class="font-semibold text-sm">Secure Payment</h3>
                    <p class="text-xs theme-text-muted">100% secure transactions</p>
                </div>
            </div>

            <!-- Feature 3 -->
            <div class="flex items-center gap-4 p-4 rounded-xl hover-theme-surface transition">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900/30 rounded-xl flex items-center justify-center">
                        <!-- Hero Section Inspired by Reference -->
                        <div class="bg-gradient-to-r from-emerald-700 via-emerald-600 to-teal-600 text-white">
                            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                                <div class="grid lg:grid-cols-2 gap-10 items-center">
                                    <div class="space-y-4">
                                        <div class="inline-flex items-center gap-2 bg-white/10 px-4 py-2 rounded-full text-sm">
                                            <span class="material-icons text-white text-base">flash_on</span>
                                            <span>Electronics & Gadget</span>
                                        </div>
                                        <h1 class="text-4xl lg:text-5xl font-bold leading-tight">Ecommax Sound II</h1>
                                        <p class="text-white/80 text-lg max-w-xl">Smart speaker series crafted for immersive sound, quick pairing, and all-day battery.</p>
                                        <div class="flex flex-wrap gap-3">
                                            <a href="{{ route('products.index') }}" class="px-6 py-3 bg-white text-emerald-700 font-semibold rounded-lg shadow hover:-translate-y-0.5 transition">Shop Now</a>
                                            <a href="{{ route('products.index') }}" class="px-6 py-3 border border-white/50 text-white rounded-lg hover:bg-white/10 transition">View Deals</a>
                                        </div>
                                        <div class="flex items-center gap-6 pt-2">
                                            <div class="flex items-center gap-2">
                                                <span class="material-icons text-amber-300">star</span>
                                                <span class="font-semibold">4.8/5 Rating</span>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <span class="material-icons text-white">local_shipping</span>
                                                <span class="text-white/80">Free 48h Delivery</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="relative">
                                        <div class="relative bg-white/90 text-slate-900 rounded-3xl p-6 shadow-2xl overflow-hidden">
                                            <div class="absolute inset-0 bg-gradient-to-b from-emerald-50 via-transparent to-white"></div>
                                            <img src="https://images.unsplash.com/photo-1610530537615-23f91f9bb76a?w=900&h=520&fit=crop" alt="Hero Product" class="relative w-full h-80 object-cover rounded-2xl">
                                            <div class="absolute top-4 right-4 bg-emerald-600 text-white px-4 py-2 rounded-full text-sm shadow">New Series</div>
                                            <div class="absolute bottom-4 left-0 right-0 flex justify-center gap-2">
                                                <span class="w-3 h-3 rounded-full bg-emerald-600"></span>
                                                <span class="w-3 h-3 rounded-full bg-white/60"></span>
                                                <span class="w-3 h-3 rounded-full bg-white/60"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 pb-10">
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 bg-white/10 backdrop-blur rounded-2xl p-5">
                                    @php
                                    $features = [
                                        ['icon' => 'local_shipping', 'title' => 'Fast Delivery', 'desc' => 'Across India'],
                                        ['icon' => 'verified', 'title' => 'Secure Payment', 'desc' => 'UPI / Cards'],
                                        ['icon' => 'support_agent', 'title' => '24/7 Support', 'desc' => 'Chat & Call'],
                                        ['icon' => 'workspace_premium', 'title' => '1 Year Warranty', 'desc' => 'On select items'],
                                    ];
                                    @endphp
                                    @foreach($features as $feature)
                                        <div class="flex items-center gap-3">
                                            <div class="w-11 h-11 bg-white rounded-xl text-emerald-600 flex items-center justify-center shadow">
                                                <span class="material-icons">{{ $feature['icon'] }}</span>
                                            </div>
                                            <div>
                                                <p class="font-semibold">{{ $feature['title'] }}</p>
                                                <p class="text-sm text-white/80">{{ $feature['desc'] }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        @if($featuredProducts->count() > 0)
                        <!-- Deals of the Day Row -->
                        <div class="bg-slate-50 dark:bg-slate-900 py-12" id="deals">
                            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                                <div class="flex items-center justify-between mb-6">
                                    <div>
                                        <p class="text-sm text-emerald-700 font-semibold">Limited offers</p>
                                        <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Deals of the Day</h2>
                                    </div>
                                    <a href="{{ route('products.index') }}" class="text-emerald-700 font-semibold text-sm hover:underline">View All</a>
                                </div>

                                <div class="flex gap-4 overflow-x-auto pb-2">
                                    @foreach($featuredProducts->take(6) as $product)
                                        <div class="min-w-[260px] bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 p-4 flex flex-col">
                                            <div class="flex justify-between items-start mb-2">
                                                <span class="text-xs text-slate-500">{{ $product->category->name ?? 'Category' }}</span>
                                                <button class="wishlist-btn text-slate-400 hover:text-red-500" data-product-id="{{ $product->id }}">
                                                    <span class="material-icons text-lg">favorite_border</span>
                                                </button>
                                            </div>
                                            <div class="w-full h-36 bg-slate-100 dark:bg-slate-700 rounded-xl flex items-center justify-center mb-3 overflow-hidden">
                                                <img src="{{ $product->primary_image_url ?? $product->image_url ?? 'https://via.placeholder.com/200x200?text=Product' }}" alt="{{ $product->name }}" class="h-full object-contain">
                                            </div>
                                            <h3 class="font-semibold text-sm text-slate-900 dark:text-white line-clamp-2 mb-1">{{ $product->name }}</h3>
                                            <div class="flex items-center gap-2 text-xs text-amber-500 mb-2">
                                                <span class="material-icons text-base">star</span>
                                                <span>4.8</span>
                                            </div>
                                            <div class="flex items-center gap-2 mb-3">
                                                <span class="text-lg font-bold text-emerald-700">₹{{ number_format($product->price, 0) }}</span>
                                                @if($product->original_price ?? false)
                                                    <span class="text-sm line-through text-slate-400">₹{{ number_format($product->original_price, 0) }}</span>
                                                @endif
                                            </div>
                                            @if($product->stock_quantity > 0)
                                                <button class="w-full bg-emerald-600 hover:bg-emerald-700 text-white py-2 rounded-lg text-sm font-semibold transition add-to-cart-btn" data-product-id="{{ $product->id }}">
                                                    Add to Cart
                                                </button>
                                            @else
                                                <button class="w-full bg-slate-200 text-slate-500 py-2 rounded-lg text-sm font-semibold" disabled>Out of Stock</button>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Category Tiles -->
                        <div class="bg-white dark:bg-slate-900 py-12">
                            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                                <div class="flex items-center justify-between mb-6">
                                    <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Shop by Category</h2>
                                    <a href="{{ route('categories.index') }}" class="text-emerald-700 font-semibold text-sm hover:underline">View All</a>
                                </div>
                                @php
                                $categories = [
                                    ['name' => 'Smartphones', 'icon' => 'smartphone', 'count' => '1.2k'],
                                    ['name' => 'Watches', 'icon' => 'watch', 'count' => '540'],
                                    ['name' => 'Tablets', 'icon' => 'tablet_mac', 'count' => '620'],
                                    ['name' => 'Audio', 'icon' => 'headphones', 'count' => '1.1k'],
                                    ['name' => 'Laptops', 'icon' => 'laptop_mac', 'count' => '780'],
                                    ['name' => 'Cameras', 'icon' => 'photo_camera', 'count' => '320'],
                                ];
                                @endphp
                                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4">
                                    @foreach($categories as $category)
                                    <a href="{{ route('products.index') }}" class="group">
                                        <div class="bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-2xl p-4 text-center hover:-translate-y-1 hover:shadow-md transition">
                                            <div class="w-14 h-14 mx-auto mb-3 rounded-2xl bg-emerald-50 text-emerald-700 flex items-center justify-center group-hover:bg-emerald-600 group-hover:text-white transition">
                                                <span class="material-icons text-2xl">{{ $category['icon'] }}</span>
                                            </div>
                                            <p class="font-semibold text-slate-900 dark:text-white">{{ $category['name'] }}</p>
                                            <p class="text-xs text-slate-500">{{ $category['count'] }} items</p>
                                        </div>
                                    </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        @if($featuredProducts->count() > 1)
                        <!-- Spotlight Banner -->
                        <div class="bg-gradient-to-r from-sky-50 via-white to-emerald-50 dark:from-slate-900 dark:via-slate-900 dark:to-slate-900 py-12">
                            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                                <div class="grid lg:grid-cols-2 gap-8 items-center">
                                    <div class="space-y-4">
                                        <p class="text-sm text-emerald-700 font-semibold">Top pick</p>
                                        <h2 class="text-3xl font-bold text-slate-900 dark:text-white">Vimore Tablet ProMax</h2>
                                        <p class="text-slate-600 dark:text-slate-300 max-w-xl">Stunning 12.9" display, ultra-fast processor, and all-day battery. Perfect for creative work and entertainment on the go.</p>
                                        <div class="flex flex-wrap gap-3">
                                            <a href="{{ route('products.index') }}" class="px-6 py-3 bg-emerald-600 text-white rounded-lg font-semibold shadow hover:-translate-y-0.5 transition">Buy Now</a>
                                            <a href="{{ route('products.index') }}" class="px-6 py-3 border border-emerald-200 text-emerald-700 rounded-lg font-semibold hover:bg-emerald-50 transition">Compare</a>
                                        </div>
                                    </div>
                                    <div class="relative bg-white dark:bg-slate-800 rounded-3xl border border-slate-200 dark:border-slate-700 p-6 shadow-lg">
                                        <img src="https://images.unsplash.com/photo-1545239351-1141bd82e8a6?w=900&h=520&fit=crop" alt="Spotlight Product" class="w-full h-72 object-cover rounded-2xl">
                                        <div class="absolute top-4 left-4 bg-emerald-600 text-white px-3 py-1 rounded-full text-xs">New</div>
                                        <div class="absolute bottom-4 left-0 right-0 flex justify-center gap-2">
                                            <span class="w-2.5 h-2.5 rounded-full bg-emerald-600"></span>
                                            <span class="w-2.5 h-2.5 rounded-full bg-slate-300"></span>
                                            <span class="w-2.5 h-2.5 rounded-full bg-slate-300"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                        @if($featuredProducts->count() > 3)
                        <!-- Latest / Trending Grid -->
                        <div class="bg-white dark:bg-slate-900 py-12">
                            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                                <div class="flex items-center justify-between mb-6">
                                    <div>
                                        <p class="text-sm text-emerald-700 font-semibold">Fresh & Latest</p>
                                        <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Trending Now</h2>
                                    </div>
                                    <a href="{{ route('products.index') }}" class="text-emerald-700 font-semibold text-sm hover:underline">View All</a>
                                </div>
                                <div class="grid md:grid-cols-3 gap-6">
                                    @foreach($featuredProducts->skip(1)->take(3) as $product)
                                        <div class="bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-2xl overflow-hidden hover:shadow-lg transition flex flex-col">
                                            <div class="h-40 bg-slate-100 dark:bg-slate-700 flex items-center justify-center">
                                                <img src="{{ $product->primary_image_url ?? $product->image_url ?? 'https://via.placeholder.com/320x200?text=Product' }}" alt="{{ $product->name }}" class="h-full object-contain">
                                            </div>
                                            <div class="p-4 flex-1 flex flex-col">
                                                <h3 class="font-semibold text-slate-900 dark:text-white mb-2 line-clamp-2">{{ $product->name }}</h3>
                                                <p class="text-sm text-slate-500 mb-3 line-clamp-2">Latest generation with improved battery and performance.</p>
                                                <div class="mt-auto flex items-center justify-between">
                                                    <span class="text-lg font-bold text-emerald-700">₹{{ number_format($product->price, 0) }}</span>
                                                    <a href="{{ route('products.show', $product->id) }}" class="text-sm font-semibold text-emerald-700 hover:underline">View →</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Brand & Assurance Row -->
                        <div class="bg-slate-50 dark:bg-slate-900 py-10">
                            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                                <div class="grid md:grid-cols-3 gap-6 items-center">
                                    <div class="space-y-3">
                                        <h3 class="text-xl font-bold text-slate-900 dark:text-white">Why shop with us?</h3>
                                        <p class="text-sm text-slate-600 dark:text-slate-300">Genuine brands, easy returns, and fast delivery across India.</p>
                                    </div>
                                    <div class="col-span-2 flex flex-wrap items-center justify-center gap-4">
                                        @php
                                        $brands = ['Apple', 'Samsung', 'Sony', 'Dell', 'HP', 'JBL', 'OnePlus', 'Lenovo'];
                                        @endphp
                                        @foreach($brands as $brand)
                                            <span class="px-4 py-2 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-full text-sm font-semibold text-slate-700 dark:text-slate-200">{{ $brand }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>