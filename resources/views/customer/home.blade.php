@extends('layouts.app')

@section('title', 'Nexora - Your Electronics Store')

@section('content')

<!-- Vibrant Flipkart-Style Hero Section -->
<div class="relative overflow-hidden bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500">
    <!-- Hero Content -->
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-20">
        <div class="grid lg:grid-cols-2 gap-10 items-center">
            <!-- Left Content -->
            <div class="text-left">
                <!-- New Badge -->
                <div class="inline-flex items-center px-4 py-2 rounded-full bg-white/20 backdrop-blur-sm border border-white/30 mb-5">
                    <span class="material-icons text-white text-sm mr-2">new_releases</span>
                    <span class="text-sm font-bold text-white">Big Savings Sale 2025</span>
                </div>

                <!-- Main Heading -->
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black text-white mb-6 leading-tight">
                    Shop Smart,
                    <span class="block text-yellow-300">
                        Save More!
                    </span>
                </h1>

                <!-- Subtitle -->
                <p class="text-lg sm:text-xl text-white/90 mb-8 leading-relaxed max-w-xl">
                    Explore amazing deals on electronics, gadgets, and accessories. Your one-stop shop for everything tech!
                </p>

                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('products.index') }}"
                        class="group inline-flex items-center justify-center px-8 py-4 font-bold text-gray-900 bg-white hover:bg-yellow-300 rounded-lg transition-all duration-300 shadow-2xl hover:shadow-xl hover:-translate-y-1">
                        <span class="material-icons mr-2">shopping_bag</span>
                        Shop Now
                        <span class="material-icons ml-2 group-hover:translate-x-1 transition-transform">arrow_forward</span>
                    </a>
                </div>

                <!-- Trust Indicators -->
                <div class="grid grid-cols-3 gap-6 mt-10 pt-8 border-t border-white/20">
                    <div>
                        <div class="flex items-center gap-2 mb-1">
                            <span class="material-icons text-yellow-300 text-xl">inventory_2</span>
                            <div class="text-2xl font-black text-white">10K+</div>
                        </div>
                        <div class="text-sm text-white/80 font-semibold">Products</div>
                    </div>
                    <div>
                        <div class="flex items-center gap-2 mb-1">
                            <span class="material-icons text-yellow-300 text-xl">people</span>
                            <div class="text-2xl font-black text-white">50K+</div>
                        </div>
                        <div class="text-sm text-white/80 font-semibold">Happy Buyers</div>
                    </div>
                    <div>
                        <div class="flex items-center gap-2 mb-1">
                            <span class="material-icons text-yellow-300 text-xl">verified</span>
                            <div class="text-2xl font-black text-white">100%</div>
                        </div>
                        <div class="text-sm text-white/80 font-semibold">Authentic</div>
                    </div>
                </div>
            </div>

            <!-- Right Visual -->
            <div class="hidden lg:flex items-center justify-center">
                <div class="relative">
                    <div class="w-80 h-80 bg-white rounded-3xl shadow-2xl p-8 transform hover:scale-105 transition-transform duration-300">
                        <div class="flex flex-col items-center justify-center h-full">
                            <span class="material-icons text-blue-600 mb-4" style="font-size: 120px;">devices</span>
                            <h3 class="text-2xl font-black text-gray-900 text-center mb-2">Best Deals on Electronics</h3>
                            <p class="text-sm text-gray-600 text-center font-semibold">Up to 70% OFF</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Colorful Features Section -->
<div class="bg-[#F5EFE6] py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Feature 1 -->
            <div class="text-center p-6 bg-white rounded-2xl shadow-md hover:shadow-xl transition-all">
                <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                    <span class="material-icons text-white text-3xl">local_shipping</span>
                </div>
                <h3 class="text-lg font-black text-gray-900 mb-2">FREE Delivery</h3>
                <p class="text-gray-600 text-sm font-semibold">On orders above ₹500</p>
            </div>

            <!-- Feature 2 -->
            <div class="text-center p-6 bg-white rounded-2xl shadow-md hover:shadow-xl transition-all">
                <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-emerald-600 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                    <span class="material-icons text-white text-3xl">verified_user</span>
                </div>
                <h3 class="text-lg font-black text-gray-900 mb-2">100% Secure</h3>
                <p class="text-gray-600 text-sm font-semibold">Safe & encrypted payments</p>
            </div>

            <!-- Feature 3 -->
            <div class="text-center p-6 bg-white rounded-2xl shadow-md hover:shadow-xl transition-all">
                <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-pink-600 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                    <span class="material-icons text-white text-3xl">workspace_premium</span>
                </div>
                <h3 class="text-lg font-black text-gray-900 mb-2">Verified Products</h3>
                <p class="text-gray-600 text-sm font-semibold">100% authentic guarantee</p>
            </div>
        </div>
    </div>
</div>
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-white mb-2">Fast Delivery</h3>
                <p class="text-gray-300 text-sm">Free shipping on orders over $50. Get your products quickly.</p>
            </div>

            <div class="text-center p-6">
                <div class="w-12 h-12 bg-indigo-900 text-indigo-400 rounded-lg flex items-center justify-center mx-auto mb-5">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H4a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-white mb-2">Secure Payment</h3>
                <p class="text-gray-300 text-sm">Your payment information is protected with bank-level security.</p>
            </div>

            <div class="text-center p-6">
                <div class="w-12 h-12 bg-indigo-900 text-indigo-400 rounded-lg flex items-center justify-center mx-auto mb-5">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-white mb-2">Premium Quality</h3>
                <p class="text-gray-300 text-sm">All products are carefully selected to ensure the highest quality.</p>
            </div>
        </div>
    </div>
</div>

<!-- Vibrant Categories Section -->
<div class="bg-white py-12 sm:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10">
            <h2 class="text-3xl sm:text-4xl font-black text-gray-900 mb-3">
                Top Categories
            </h2>
            <p class="text-gray-600 font-semibold">
                Shop by your favorite category
            </p>
        </div>

        <div class="flex gap-4 overflow-x-auto pb-4 scrollbar-hide">
            @php
            $brands = [
                ['name' => 'Smartphones', 'icon' => 'smartphone', 'color' => 'from-blue-500 to-cyan-500'],
                ['name' => 'Laptops', 'icon' => 'laptop_mac', 'color' => 'from-purple-500 to-pink-500'],
                ['name' => 'Tablets', 'icon' => 'tablet_mac', 'color' => 'from-green-500 to-emerald-500'],
                ['name' => 'Watches', 'icon' => 'watch', 'color' => 'from-orange-500 to-red-500'],
                ['name' => 'Cameras', 'icon' => 'photo_camera', 'color' => 'from-indigo-500 to-purple-500'],
                ['name' => 'Headphones', 'icon' => 'headphones', 'color' => 'from-pink-500 to-rose-500'],
                ['name' => 'Gaming', 'icon' => 'sports_esports', 'color' => 'from-yellow-500 to-orange-500'],
                ['name' => 'Accessories', 'icon' => 'cable', 'color' => 'from-teal-500 to-cyan-500']
            ];
            @endphp

            @foreach ($brands as $brand)
            <a href="{{ route('products.index') }}" class="flex-shrink-0 w-36">
                <div class="flex flex-col items-center justify-center p-5 bg-[#F5EFE6] rounded-2xl hover:shadow-lg transition-all duration-300 group">
                    <div class="w-14 h-14 bg-gradient-to-br {{ $brand['color'] }} rounded-full flex items-center justify-center mb-3 group-hover:scale-110 transition-transform shadow-md">
                        <span class="material-icons text-white text-2xl">{{ $brand['icon'] }}</span>
                    </div>
                    <span class="text-xs font-bold text-gray-900 text-center">{{ $brand['name'] }}</span>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</div>

@if($categories->count() > 0)
<div class="bg-[#F5EFE6] py-12 sm:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10">
            <h2 class="text-3xl sm:text-4xl font-black text-gray-900 mb-3">
                Shop by Category
            </h2>
            <p class="text-gray-600 font-semibold">
                Find exactly what you need
            </p>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach($categories as $category)
            <a href="{{ route('products.category', $category) }}" class="group relative bg-white rounded-2xl overflow-hidden border-2 border-gray-100 hover:border-blue-500 hover:shadow-xl transition-all duration-300">
                <div class="aspect-w-3 aspect-h-2">
                    @if($category->image)
                    <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="w-full h-40 object-cover group-hover:scale-110 transition-transform duration-300">
                    @else
                    <div class="w-full h-40 bg-gradient-to-br from-blue-100 via-purple-100 to-pink-100 flex items-center justify-center">
                        <span class="material-icons text-blue-600 text-5xl">category</span>
                    </div>
                    @endif
                </div>
                <div class="p-4">
                    <h3 class="text-base font-black text-gray-900 group-hover:text-blue-600 transition-colors">
                        {{ $category->name }}
                    </h3>
                    <p class="text-xs text-gray-600 font-semibold mt-1">{{ Str::limit($category->description, 40) }}</p>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</div>
@endif

@if($featuredProducts->count() > 0)
<div class="bg-white py-12 sm:py-16" id="featured">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10">
            <h2 class="text-3xl sm:text-4xl font-black text-gray-900 mb-3">
                Best Deals for You
            </h2>
            <p class="text-gray-600 font-semibold">
                Handpicked products at amazing prices
            </p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            @include('customer.products.partials.products-grid', ['products' => $featuredProducts])
        </div>
        <div class="text-center mt-10">
            <a href="{{ route('products.index') }}"
                class="inline-flex items-center gap-2 bg-gradient-to-r from-orange-500 to-pink-500 hover:from-orange-600 hover:to-pink-600 text-white px-8 py-4 rounded-lg font-bold text-base transition-all duration-300 shadow-lg hover:shadow-xl hover:-translate-y-1">
                View All Products
                <span class="material-icons">arrow_forward</span>
            </a>
        </div>
    </div>
</div>
@endif

@endsection

@push('scripts')
<style>
    /* Scrollbar Hide */
    .scrollbar-hide::-webkit-scrollbar {
        display: none;
    }
    .scrollbar-hide {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
</style>
@endpush