@extends('layouts.app')

@section('title', 'Nexora - Your Electronics Store')

@section('content')

<!-- Modern Hero Section for Electronics Store -->
<div class="relative overflow-hidden bg-gradient-to-br from-[#CBDCEB] via-[#F5EFE6] to-[#E8DFCA] dark:from-[#1B3C53] dark:via-[#234C6A] dark:to-[#1B3C53]">
    <!-- Decorative Elements -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-0 right-0 w-96 h-96 bg-[#6D94C5] dark:bg-[#456882] rounded-full blur-3xl opacity-20"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-[#456882] dark:bg-[#6D94C5] rounded-full blur-3xl opacity-20"></div>
    </div>

    <!-- Hero Content -->
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-24">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            <!-- Left Content -->
            <div class="text-left">
                <!-- New Badge -->
                <div class="inline-flex items-center px-4 py-2 rounded-full bg-[#CBDCEB] dark:bg-[#456882] border border-[#6D94C5] dark:border-[#D2C1B6] mb-6">
                    <span class="material-icons text-[#6D94C5] dark:text-[#D2C1B6] text-sm mr-2">new_releases</span>
                    <span class="text-sm font-semibold text-[#6D94C5] dark:text-[#D2C1B6]">Latest Collection 2025</span>
                </div>

                <!-- Main Heading -->
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-gray-900 dark:text-white mb-6 leading-tight">
                    Experience the
                    <span class="block bg-gradient-to-r from-[#6D94C5] via-[#456882] to-[#6D94C5] dark:from-[#D2C1B6] dark:via-[#E8DFCA] dark:to-[#D2C1B6] bg-clip-text text-transparent">
                        Future of Electronics
                    </span>
                </h1>

                <!-- Subtitle -->
                <p class="text-lg sm:text-xl text-gray-600 dark:text-gray-300 mb-8 leading-relaxed max-w-xl">
                    Discover cutting-edge technology, premium quality products, and unbeatable deals. Your trusted electronics destination.
                </p>

                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('products.index') }}"
                        class="group inline-flex items-center justify-center px-8 py-4 font-semibold text-white bg-gradient-to-r from-[#6D94C5] to-[#456882] hover:opacity-90 dark:from-[#456882] dark:to-[#6D94C5] rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl hover:-translate-y-0.5">
                        <span class="material-icons mr-2 group-hover:scale-110 transition-transform">shopping_bag</span>
                        Shop Now
                    </a>
                    <a href="#featured"
                        class="group inline-flex items-center justify-center px-8 py-4 font-semibold text-[#6D94C5] dark:text-[#D2C1B6] bg-white dark:bg-[#234C6A] hover:bg-[#CBDCEB] dark:hover:bg-[#456882] border-2 border-[#E8DFCA] dark:border-[#456882] rounded-xl transition-all duration-300 shadow-md hover:shadow-lg hover:-translate-y-0.5">
                        Explore Products
                        <span class="material-icons ml-2 group-hover:translate-x-1 transition-transform">arrow_forward</span>
                    </a>
                </div>

                <!-- Trust Indicators -->
                <div class="grid grid-cols-3 gap-6 mt-12 pt-8 border-t border-[#E8DFCA] dark:border-[#456882]">
                    <div>
                        <div class="flex items-center gap-2 mb-1">
                            <span class="material-icons text-[#6D94C5] dark:text-[#D2C1B6] text-xl">inventory_2</span>
                            <div class="text-2xl font-bold text-gray-900 dark:text-white">5K+</div>
                        </div>
                        <div class="text-sm text-gray-600 dark:text-gray-400">Products</div>
                    </div>
                    <div>
                        <div class="flex items-center gap-2 mb-1">
                            <span class="material-icons text-[#6D94C5] dark:text-[#D2C1B6] text-xl">people</span>
                            <div class="text-2xl font-bold text-gray-900 dark:text-white">50K+</div>
                        </div>
                        <div class="text-sm text-gray-600 dark:text-gray-400">Customers</div>
                    </div>
                    <div>
                        <div class="flex items-center gap-2 mb-1">
                            <span class="material-icons text-[#6D94C5] dark:text-[#D2C1B6] text-xl">verified</span>
                            <div class="text-2xl font-bold text-gray-900 dark:text-white">100%</div>
                        </div>
                        <div class="text-sm text-gray-600 dark:text-gray-400">Authentic</div>
                    </div>
                </div>
            </div>

            <!-- Right Visual (Hero Image Placeholder) -->
            <div class="hidden lg:block relative">
                <div class="relative">
                    <!-- Decorative Card 1 -->
                    <div class="absolute top-0 right-0 w-64 h-80 bg-gradient-to-br from-[#6D94C5] to-[#456882] dark:from-[#D2C1B6] dark:to-[#E8DFCA] rounded-2xl shadow-2xl transform rotate-6 opacity-20"></div>
                    <!-- Decorative Card 2 -->
                    <div class="absolute top-8 right-8 w-64 h-80 bg-gradient-to-br from-[#456882] to-[#6D94C5] dark:from-[#E8DFCA] dark:to-[#D2C1B6] rounded-2xl shadow-2xl transform rotate-3 opacity-40"></div>
                    <!-- Main Visual Card -->
                    <div class="relative w-64 h-80 bg-white dark:bg-[#234C6A] rounded-2xl shadow-2xl p-6 mx-auto transform hover:scale-105 transition-transform duration-300">
                        <div class="flex flex-col items-center justify-center h-full">
                            <span class="material-icons text-[#6D94C5] dark:text-[#D2C1B6] mb-4" style="font-size: 120px;">devices</span>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white text-center mb-2">Premium Electronics</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400 text-center">Top brands, best prices</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Wave Divider -->
    <div class="absolute bottom-0 left-0 w-full">
        <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-auto">
            <path d="M0 120L60 110C120 100 240 80 360 70C480 60 600 60 720 65C840 70 960 80 1080 85C1200 90 1320 90 1380 90L1440 90V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0Z" class="fill-white dark:fill-[#234C6A]"/>
        </svg>
    </div>
</div>

<!-- Features Section -->
<div class="bg-white dark:bg-[#234C6A] py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Feature 1 -->
            <div class="text-center p-6 rounded-2xl hover:bg-[#F5EFE6] dark:hover:bg-[#1B3C53] transition-colors">
                <div class="w-16 h-16 bg-gradient-to-br from-[#CBDCEB] to-[#E8DFCA] dark:from-[#456882] dark:to-[#6D94C5] rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <span class="material-icons text-[#6D94C5] dark:text-[#D2C1B6] text-4xl">local_shipping</span>
                </div>
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Fast Delivery</h3>
                <p class="text-gray-600 dark:text-gray-400 text-sm">Free shipping on orders over $50. Quick & reliable.</p>
            </div>

            <!-- Feature 2 -->
            <div class="text-center p-6 rounded-2xl hover:bg-[#F5EFE6] dark:hover:bg-[#1B3C53] transition-colors">
                <div class="w-16 h-16 bg-gradient-to-br from-[#CBDCEB] to-[#E8DFCA] dark:from-[#456882] dark:to-[#6D94C5] rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <span class="material-icons text-green-600 dark:text-emerald-400 text-4xl">verified_user</span>
                </div>
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Secure Payment</h3>
                <p class="text-gray-600 dark:text-gray-400 text-sm">100% secure transactions with bank-level encryption.</p>
            </div>

            <!-- Feature 3 -->
            <div class="text-center p-6 rounded-2xl hover:bg-[#F5EFE6] dark:hover:bg-[#1B3C53] transition-colors">
                <div class="w-16 h-16 bg-gradient-to-br from-[#CBDCEB] to-[#E8DFCA] dark:from-[#456882] dark:to-[#6D94C5] rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <span class="material-icons text-[#6D94C5] dark:text-[#D2C1B6] text-4xl">workspace_premium</span>
                </div>
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Premium Quality</h3>
                <p class="text-gray-600 dark:text-gray-400 text-sm">Authentic products from trusted brands worldwide.</p>
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

<!-- Categories Section -->
<div class="bg-[#F5EFE6] dark:bg-[#1B3C53] py-16 sm:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 dark:text-white mb-4">
                Explore Top Categories
            </h2>
            <p class="text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
                Browse through our wide selection of premium electronics
            </p>
        </div>

        <div class="flex gap-4 overflow-x-auto pb-4 scrollbar-hide">
            @php
            $brands = [
                ['name' => 'Smartphones', 'icon' => 'smartphone'],
                ['name' => 'Laptops', 'icon' => 'laptop_mac'],
                ['name' => 'Tablets', 'icon' => 'tablet_mac'],
                ['name' => 'Smartwatches', 'icon' => 'watch'],
                ['name' => 'Cameras', 'icon' => 'photo_camera'],
                ['name' => 'Headphones', 'icon' => 'headphones'],
                ['name' => 'Gaming', 'icon' => 'sports_esports'],
                ['name' => 'Accessories', 'icon' => 'cable']
            ];
            @endphp

            @foreach ($brands as $brand)
            <a href="{{ route('products.index') }}" class="flex-shrink-0 w-40">
                <div class="flex flex-col items-center justify-center p-6 bg-white dark:bg-[#234C6A] rounded-2xl border border-[#E8DFCA] dark:border-[#456882] hover:border-[#6D94C5] dark:hover:border-[#D2C1B6] hover:shadow-lg transition-all duration-300 group">
                    <div class="w-16 h-16 bg-gradient-to-br from-[#CBDCEB] to-[#E8DFCA] dark:from-[#456882] dark:to-[#6D94C5] rounded-2xl flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                        <span class="material-icons text-[#6D94C5] dark:text-[#D2C1B6] text-3xl">{{ $brand['icon'] }}</span>
                    </div>
                    <span class="text-sm font-semibold text-gray-900 dark:text-white text-center">{{ $brand['name'] }}</span>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</div>

@if($categories->count() > 0)
<div class="bg-white dark:bg-[#234C6A] py-16 sm:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 dark:text-white mb-4">
                Shop by Category
            </h2>
            <p class="text-gray-600 dark:text-gray-400">
                Find exactly what you're looking for
            </p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($categories as $category)
            <a href="{{ route('products.category', $category) }}" class="group relative bg-[#F5EFE6] dark:bg-[#1B3C53] rounded-2xl overflow-hidden border border-[#E8DFCA] dark:border-[#456882] hover:border-[#6D94C5] dark:hover:border-[#D2C1B6] hover:shadow-xl transition-all duration-300">
                <div class="aspect-w-3 aspect-h-2">
                    @if($category->image)
                    <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-300">
                    @else
                    <div class="w-full h-48 bg-gradient-to-br from-[#CBDCEB] to-[#E8DFCA] dark:from-[#456882] dark:to-[#6D94C5] flex items-center justify-center">
                        <span class="material-icons text-[#6D94C5] dark:text-[#D2C1B6] text-6xl">category</span>
                    </div>
                    @endif
                </div>
                <div class="p-5">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2 group-hover:text-[#6D94C5] dark:group-hover:text-[#D2C1B6] transition-colors">
                        {{ $category->name }}
                    </h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">{{ Str::limit($category->description, 60) }}</p>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</div>
@endif

@if($featuredProducts->count() > 0)
<div class="bg-[#F5EFE6] dark:bg-[#1B3C53] py-16 sm:py-24" id="featured">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 dark:text-white mb-4">
                Featured Products
            </h2>
            <p class="text-gray-600 dark:text-gray-400">
                Handpicked products just for you
            </p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @include('customer.products.partials.products-grid', ['products' => $featuredProducts])
        </div>
        <div class="text-center mt-12">
            <a href="{{ route('products.index') }}"
                class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 dark:from-cyan-600 dark:to-blue-600 dark:hover:from-cyan-700 dark:hover:to-blue-700 text-white px-8 py-4 rounded-xl font-semibold text-base transition-all duration-300 shadow-lg hover:shadow-xl hover:-translate-y-0.5">
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