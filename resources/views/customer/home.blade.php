@extends('layouts.app')

@section('title', 'Nexora - Your Electronics Store')

@section('content')

<!-- Colorful Flipkart-Inspired Hero Section -->
<div class="relative overflow-hidden bg-gradient-to-br from-blue-500 via-indigo-600 to-purple-600">
    <!-- Animated Background Elements -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-0 right-0 w-96 h-96 bg-yellow-400 rounded-full blur-3xl opacity-20 animate-pulse"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-pink-500 rounded-full blur-3xl opacity-20 animate-pulse" style="animation-delay: 1s;"></div>
        <div class="absolute top-1/2 left-1/2 w-96 h-96 bg-green-400 rounded-full blur-3xl opacity-20 animate-pulse" style="animation-delay: 2s;"></div>
    </div>

    <!-- Hero Content -->
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-20">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            <!-- Left Content -->
            <div class="text-left">
                <!-- Trending Badge -->
                <div class="inline-flex items-center px-4 py-2 rounded-full bg-gradient-to-r from-yellow-400 to-orange-500 mb-6 shadow-lg animate-bounce">
                    <span class="material-icons text-white text-sm mr-2">whatshot</span>
                    <span class="text-sm font-bold text-white">Trending Now!</span>
                </div>

                <!-- Main Heading -->
                <h1 class="text-5xl sm:text-6xl lg:text-7xl font-extrabold text-white mb-6 leading-tight">
                    Amazing
                    <span class="block bg-gradient-to-r from-yellow-300 via-orange-300 to-pink-300 bg-clip-text text-transparent">
                        Offers & Deals
                    </span>
                </h1>

                <!-- Subtitle -->
                <p class="text-xl sm:text-2xl text-blue-100 mb-8 leading-relaxed font-semibold">
                    Get up to <span class="text-yellow-300 font-extrabold text-3xl">70% OFF</span> on electronics
                </p>

                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('products.index') }}"
                        class="group inline-flex items-center justify-center px-8 py-4 font-bold text-lg text-blue-600 bg-white hover:bg-gray-50 rounded-xl transition-all duration-300 shadow-2xl hover:shadow-3xl hover:scale-105">
                        <span class="material-icons mr-2 group-hover:rotate-12 transition-transform">shopping_bag</span>
                        Shop Now
                        <span class="material-icons ml-2 group-hover:translate-x-1 transition-transform">arrow_forward</span>
                    </a>
                    <a href="#deals"
                        class="group inline-flex items-center justify-center px-8 py-4 font-bold text-lg text-white bg-gradient-to-r from-orange-500 to-red-500 hover:from-orange-600 hover:to-red-600 rounded-xl transition-all duration-300 shadow-2xl hover:shadow-3xl hover:scale-105 border-2 border-white">
                        <span class="material-icons mr-2">local_offer</span>
                        Hot Deals
                    </a>
                </div>

                <!-- Trust Indicators -->
                <div class="grid grid-cols-3 gap-6 mt-12 pt-8 border-t-2 border-white/30">
                    <div>
                        <div class="text-3xl font-extrabold text-white mb-1">100K+</div>
                        <div class="text-sm text-blue-200 font-semibold">Products</div>
                    </div>
                    <div>
                        <div class="text-3xl font-extrabold text-white mb-1">5M+</div>
                        <div class="text-sm text-blue-200 font-semibold">Customers</div>
                    </div>
                    <div>
                        <div class="text-3xl font-extrabold text-white mb-1">4.8★</div>
                        <div class="text-sm text-blue-200 font-semibold">Rating</div>
                    </div>
                </div>
            </div>

            <!-- Right Visual -->
            <div class="hidden lg:block relative">
                <div class="relative animate-float">
                    <!-- Main Product Card -->
                    <div class="relative w-80 h-96 bg-white rounded-3xl shadow-2xl p-8 mx-auto transform hover:scale-105 transition-transform duration-300">
                        <div class="absolute -top-4 -right-4 bg-gradient-to-r from-red-500 to-pink-500 text-white text-sm font-bold px-4 py-2 rounded-full shadow-lg">
                            -50% OFF
                        </div>
                        <div class="flex flex-col items-center justify-center h-full">
                            <span class="material-icons text-blue-600 mb-6" style="font-size: 120px;">devices</span>
                            <h3 class="text-2xl font-extrabold text-gray-900 text-center mb-2">Premium Electronics</h3>
                            <p class="text-gray-600 text-center mb-4 font-semibold">Best prices guaranteed</p>
                            <div class="flex items-center gap-2 text-yellow-500 mb-4">
                                <span class="material-icons">star</span>
                                <span class="material-icons">star</span>
                                <span class="material-icons">star</span>
                                <span class="material-icons">star</span>
                                <span class="material-icons">star</span>
                            </div>
                            <a href="{{ route('products.index') }}" class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-6 py-3 rounded-xl font-bold hover:shadow-xl transition-all">
                                Explore Now
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Colorful Features Section -->
<div class="bg-[#F5EFE6] py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Feature 1 -->
            <div class="text-center p-8 bg-white rounded-2xl hover:shadow-2xl transition-all duration-300 hover:scale-105 border-2 border-gray-100">
                <div class="w-20 h-20 bg-gradient-to-br from-green-400 to-emerald-500 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg">
                    <span class="material-icons text-white text-5xl">local_shipping</span>
                </div>
                <h3 class="text-xl font-extrabold text-gray-900 mb-2">FREE Delivery</h3>
                <p class="text-gray-600 font-semibold">On orders above ₹499</p>
            </div>

            <!-- Feature 2 -->
            <div class="text-center p-8 bg-white rounded-2xl hover:shadow-2xl transition-all duration-300 hover:scale-105 border-2 border-gray-100">
                <div class="w-20 h-20 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg">
                    <span class="material-icons text-white text-5xl">verified_user</span>
                </div>
                <h3 class="text-xl font-extrabold text-gray-900 mb-2">100% Secure</h3>
                <p class="text-gray-600 font-semibold">Safe payment options</p>
            </div>

            <!-- Feature 3 -->
            <div class="text-center p-8 bg-white rounded-2xl hover:shadow-2xl transition-all duration-300 hover:scale-105 border-2 border-gray-100">
                <div class="w-20 h-20 bg-gradient-to-br from-orange-400 to-red-500 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg">
                    <span class="material-icons text-white text-5xl">workspace_premium</span>
                </div>
                <h3 class="text-xl font-extrabold text-gray-900 mb-2">Top Quality</h3>
                <p class="text-gray-600 font-semibold">Authentic products only</p>
            </div>
        </div>
    </div>
</div>

<style>
@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-20px); }
}
.animate-float {
    animation: float 3s ease-in-out infinite;
}
</style>
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
<div class="bg-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-4xl sm:text-5xl font-extrabold text-gray-900 mb-4">
                Shop By <span class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">Category</span>
            </h2>
            <p class="text-gray-600 text-lg font-semibold max-w-2xl mx-auto">
                Find exactly what you're looking for
            </p>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-4 gap-6">
            @php
            $categoryTiles = [
                ['name' => 'Smartphones', 'icon' => 'smartphone', 'color' => 'from-blue-500 to-cyan-500'],
                ['name' => 'Laptops', 'icon' => 'laptop_mac', 'color' => 'from-purple-500 to-pink-500'],
                ['name' => 'Tablets', 'icon' => 'tablet_mac', 'color' => 'from-green-500 to-emerald-500'],
                ['name' => 'Smartwatches', 'icon' => 'watch', 'color' => 'from-orange-500 to-red-500'],
                ['name' => 'Cameras', 'icon' => 'photo_camera', 'color' => 'from-indigo-500 to-blue-500'],
                ['name' => 'Headphones', 'icon' => 'headphones', 'color' => 'from-pink-500 to-rose-500'],
                ['name' => 'Gaming', 'icon' => 'sports_esports', 'color' => 'from-yellow-500 to-orange-500'],
                ['name' => 'Accessories', 'icon' => 'cable', 'color' => 'from-teal-500 to-cyan-500']
            ];
            @endphp

            @foreach ($categoryTiles as $tile)
            <a href="{{ route('products.index') }}" class="group">
                <div class="flex flex-col items-center justify-center p-6 bg-gradient-to-br {{ $tile['color'] }} rounded-2xl hover:shadow-2xl transition-all duration-300 transform hover:scale-110">
                    <div class="w-16 h-16 bg-white/20 backdrop-blur-md rounded-2xl flex items-center justify-center mb-3 group-hover:rotate-12 transition-transform">
                        <span class="material-icons text-white text-4xl">{{ $tile['icon'] }}</span>
                    </div>
                    <span class="text-sm font-bold text-white text-center">{{ $tile['name'] }}</span>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</div>

@if($featuredProducts->count() > 0)
<div class="bg-[#F5EFE6] py-16" id="deals">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <div class="inline-flex items-center px-4 py-2 rounded-full bg-gradient-to-r from-red-500 to-pink-500 mb-4 shadow-lg">
                <span class="material-icons text-white text-sm mr-2">local_offer</span>
                <span class="text-sm font-bold text-white">HOT DEALS</span>
            </div>
            <h2 class="text-4xl sm:text-5xl font-extrabold text-gray-900 mb-4">
                Best <span class="bg-gradient-to-r from-orange-500 to-red-500 bg-clip-text text-transparent">Selling Products</span>
            </h2>
            <p class="text-gray-600 text-lg font-semibold">
                Limited time offers - grab them before they're gone!
            </p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @include('customer.products.partials.products-grid', ['products' => $featuredProducts])
        </div>
        <div class="text-center mt-12">
            <a href="{{ route('products.index') }}"
                class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white px-10 py-4 rounded-xl font-bold text-lg transition-all duration-300 shadow-2xl hover:shadow-3xl hover:scale-105">
                <span class="material-icons">storefront</span>
                View All Products
                <span class="material-icons">arrow_forward</span>
            </a>
        </div>
    </div>
</div>
@endif

<!-- Promotional Banner -->
<div class="bg-gradient-to-r from-purple-600 via-pink-600 to-red-600 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center text-white">
            <h2 class="text-4xl sm:text-5xl font-extrabold mb-4">
                Download Our App & Get Extra 10% OFF!
            </h2>
            <p class="text-xl text-pink-100 mb-8 font-semibold">
                Shop on the go with exclusive app-only deals
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="#" class="inline-flex items-center gap-3 bg-gradient-to-br from-green-600 to-teal-600 hover:from-green-700 hover:to-teal-700 text-white px-8 py-4 rounded-xl font-bold transition-all hover:scale-105 shadow-xl">
                    <svg class="w-9 h-9" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M3,20.5V3.5C3,2.91 3.34,2.39 3.84,2.15L13.69,12L3.84,21.85C3.34,21.6 3,21.09 3,20.5M16.81,15.12L6.05,21.34L14.54,12.85L16.81,15.12M20.16,10.81C20.5,11.08 20.75,11.5 20.75,12C20.75,12.5 20.53,12.9 20.18,13.18L17.89,14.5L15.39,12L17.89,9.5L20.16,10.81M6.05,2.66L16.81,8.88L14.54,11.15L6.05,2.66Z"/>
                    </svg>
                    <div class="text-left">
                        <div class="text-xs font-semibold">GET IT ON</div>
                        <div class="text-2xl font-extrabold">Google Play</div>
                    </div>
                </a>
                <a href="#" class="inline-flex items-center gap-3 bg-gradient-to-br from-blue-600 to-blue-800 hover:from-blue-700 hover:to-blue-900 text-white px-8 py-4 rounded-xl font-bold transition-all hover:scale-105 shadow-xl">
                    <svg class="w-9 h-9" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M18.71,19.5C17.88,20.74 17,21.95 15.66,21.97C14.32,22 13.89,21.18 12.37,21.18C10.84,21.18 10.37,21.95 9.1,22C7.79,22.05 6.8,20.68 5.96,19.47C4.25,17 2.94,12.45 4.7,9.39C5.57,7.87 7.13,6.91 8.82,6.88C10.1,6.86 11.32,7.75 12.11,7.75C12.89,7.75 14.37,6.68 15.92,6.84C16.57,6.87 18.39,7.1 19.56,8.82C19.47,8.88 17.39,10.1 17.41,12.63C17.44,15.65 20.06,16.66 20.09,16.67C20.06,16.74 19.67,18.11 18.71,19.5M13,3.5C13.73,2.67 14.94,2.04 15.94,2C16.07,3.17 15.6,4.35 14.9,5.19C14.21,6.04 13.07,6.7 11.95,6.61C11.8,5.46 12.36,4.26 13,3.5Z"/>
                    </svg>
                    <div class="text-left">
                        <div class="text-xs font-semibold">Download on the</div>
                        <div class="text-2xl font-extrabold">App Store</div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

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