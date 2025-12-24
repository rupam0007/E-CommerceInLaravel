@extends('layouts.app')

@section('title', 'Nexora - Your E-Commerce Store')

@section('content')

<!-- Simple Hero Section -->
<div class="bg-indigo-600 theme-bg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            <div>
                <div class="inline-flex items-center px-4 py-2 rounded-full bg-indigo-500 mb-6">
                    <span class="material-icons text-white text-sm mr-2">local_offer</span>
                    <span class="text-sm font-medium text-white">Special Offers Available</span>
                </div>
                
                <h1 class="text-4xl sm:text-5xl font-bold text-white mb-6">
                    Welcome to Nexora
                    <span class="block mt-2">Your Trusted Shop</span>
                </h1>

                <p class="text-lg text-indigo-100 mb-8">
                    Discover quality products at competitive prices with fast, reliable delivery.
                </p>

                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('products.index') }}"
                        class="inline-flex items-center justify-center px-6 py-3 font-medium text-indigo-600 bg-white rounded-lg hover:bg-gray-50">
                        <span class="material-icons mr-2">shopping_bag</span>
                        Shop Now
                    </a>
                    <a href="#products"
                        class="inline-flex items-center justify-center px-6 py-3 font-medium text-white border-2 border-white rounded-lg hover:bg-white hover:text-indigo-600">
                        View Deals
                    </a>
                </div>
            </div>

            <div class="hidden lg:block">
                <div class="bg-white rounded-lg shadow-lg p-8">
                    <span class="material-icons text-indigo-600" style="font-size: 120px;">shopping_cart</span>
                    <h3 class="text-2xl font-bold text-gray-900 mt-4">Start Shopping</h3>
                    <p class="text-gray-600 mt-2">Browse thousands of products</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Features Section -->
<div class="theme-bg py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center p-6 theme-card">
                <div class="w-16 h-16 bg-indigo-600 rounded-lg flex items-center justify-center mx-auto mb-4">
                    <span class="material-icons text-white text-3xl">local_shipping</span>
                </div>
                <h3 class="text-lg font-semibold mb-2">Free Delivery</h3>
                <p class="theme-text-muted text-sm">On orders above ₹499</p>
            </div>

            <div class="text-center p-6 theme-card">
                <div class="w-16 h-16 bg-indigo-600 rounded-lg flex items-center justify-center mx-auto mb-4">
                    <span class="material-icons text-white text-3xl">verified_user</span>
                </div>
                <h3 class="text-lg font-semibold mb-2">Secure Payment</h3>
                <p class="theme-text-muted text-sm">100% secure transactions</p>
            </div>

            <div class="text-center p-6 theme-card">
                <div class="w-16 h-16 bg-indigo-600 rounded-lg flex items-center justify-center mx-auto mb-4">
                    <span class="material-icons text-white text-3xl">support_agent</span>
                </div>
                <h3 class="text-lg font-semibold mb-2">24/7 Support</h3>
                <p class="theme-text-muted text-sm">Always here to help</p>
            </div>
        </div>
    </div>
</div>

    </div>
</div>

<!-- Categories Section -->
<div class="theme-surface py-16" id="categories">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold mb-2">Shop by Category</h2>
            <p class="theme-text-muted">Find what you're looking for</p>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6">
            @php
            $categoryTiles = [
                ['name' => 'Electronics', 'icon' => 'devices'],
                ['name' => 'Fashion', 'icon' => 'checkroom'],
                ['name' => 'Home & Kitchen', 'icon' => 'home'],
                ['name' => 'Books', 'icon' => 'menu_book'],
                ['name' => 'Sports', 'icon' => 'sports_basketball'],
                ['name' => 'Beauty', 'icon' => 'spa'],
                ['name' => 'Toys', 'icon' => 'toys'],
                ['name' => 'More', 'icon' => 'apps']
            ];
            @endphp

            @foreach ($categoryTiles as $tile)
            <a href="{{ route('products.index') }}" class="theme-card p-6 text-center hover:border-indigo-600">
                <div class="w-12 h-12 bg-indigo-600 rounded-lg flex items-center justify-center mx-auto mb-3">
                    <span class="material-icons text-white">{{ $tile['icon'] }}</span>
                </div>
                <span class="text-sm font-medium">{{ $tile['name'] }}</span>
            </a>
            @endforeach
        </div>
    </div>
</div>

@if($featuredProducts->count() > 0)
<div class="theme-bg py-16" id="products">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <div class="inline-flex items-center px-4 py-2 rounded-full bg-indigo-600 text-white mb-4">
                <span class="material-icons text-sm mr-2">local_offer</span>
                <span class="text-sm font-medium">Featured Products</span>
            </div>
            <h2 class="text-3xl font-bold mb-2">Best Sellers</h2>
            <p class="theme-text-muted">Check out our most popular products</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @include('customer.products.partials.products-grid', ['products' => $featuredProducts])
        </div>
        <div class="text-center mt-12">
            <a href="{{ route('products.index') }}"
                class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-lg font-medium">
                View All Products
                <span class="material-icons">arrow_forward</span>
            </a>
        </div>
    </div>
</div>
@endif

@endsection