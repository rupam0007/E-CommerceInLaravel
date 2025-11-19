@extends('layouts.app')

@section('title', 'Nexora - Your E-commerce Destination')

@section('content')

{{-- Hero Section - Premium Dark Design --}}
<div class="relative overflow-hidden bg-gradient-to-br from-slate-950 via-indigo-950 to-slate-950">
    {{-- Animated Background Gradient --}}
    <div class="absolute inset-0">
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-indigo-900/20 via-transparent to-transparent"></div>
        <div class="absolute bottom-0 left-0 right-0 h-96 bg-gradient-to-t from-purple-900/10 to-transparent"></div>
    </div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 sm:py-32 lg:py-40">
        <div class="text-center space-y-10">
            
            {{-- Top Badge --}}
            <div class="flex justify-center animate-fade-in">
                <div class="inline-flex items-center gap-2.5 px-5 py-2.5 rounded-full bg-indigo-500/10 border border-indigo-400/30 backdrop-blur-md shadow-lg shadow-indigo-500/20">
                    <span class="relative flex h-2.5 w-2.5">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-indigo-400"></span>
                    </span>
                    <span class="text-sm font-semibold text-indigo-200">New Arrivals Available</span>
                </div>
            </div>
            
            {{-- Main Heading --}}
            <div class="space-y-6">
                <h1 class="text-5xl sm:text-6xl lg:text-7xl xl:text-8xl font-extrabold text-white leading-tight tracking-tight">
                    Welcome to Nexora
                </h1>
                
                {{-- Description --}}
                <p class="text-lg sm:text-xl lg:text-2xl text-gray-400 max-w-4xl mx-auto leading-relaxed">
                    Discover premium products, cutting-edge technology, and unbeatable deals. 
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 via-purple-400 to-indigo-400">Your journey to excellence starts here.</span>
                </p>
            </div>
            
            {{-- CTA Buttons --}}
            <div class="flex flex-col sm:flex-row items-center justify-center gap-5 pt-6">
                <a href="{{ route('products.index') }}"
                    class="group relative inline-flex items-center justify-center gap-3 px-10 py-5 text-lg font-bold text-white bg-gradient-to-r from-indigo-600 via-purple-600 to-indigo-600 bg-size-200 bg-pos-0 hover:bg-pos-100 rounded-xl transition-all duration-500 shadow-2xl shadow-indigo-600/50 hover:shadow-indigo-600/70 hover:scale-105 overflow-hidden">
                    <span class="absolute inset-0 bg-gradient-to-r from-indigo-400 to-purple-400 opacity-0 group-hover:opacity-20 transition-opacity duration-500"></span>
                    <svg class="w-6 h-6 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <span class="relative z-10">Shop Now</span>
                </a>
                <a href="#featured"
                    class="group inline-flex items-center justify-center gap-3 px-10 py-5 text-lg font-bold text-gray-200 bg-white/5 hover:bg-white/10 border-2 border-gray-700 hover:border-indigo-500/50 rounded-xl transition-all duration-300 backdrop-blur-sm hover:shadow-lg hover:shadow-indigo-500/20">
                    <span>Explore Products</span>
                    <svg class="w-6 h-6 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>
            
            {{-- Stats Section --}}
            <div class="grid grid-cols-3 gap-10 pt-20 max-w-4xl mx-auto">
                <div class="text-center space-y-3 p-6 rounded-2xl bg-gradient-to-br from-indigo-500/10 to-purple-500/10 backdrop-blur-sm border border-indigo-500/20 hover:border-indigo-400/40 transition-all duration-300 hover:scale-105">
                    <div class="text-4xl sm:text-5xl lg:text-6xl font-black text-transparent bg-clip-text bg-gradient-to-br from-indigo-400 via-purple-400 to-indigo-500">1000+</div>
                    <div class="text-sm sm:text-base font-semibold text-gray-400 uppercase tracking-wider">Products</div>
                </div>
                <div class="text-center space-y-3 p-6 rounded-2xl bg-gradient-to-br from-purple-500/10 to-pink-500/10 backdrop-blur-sm border border-purple-500/20 hover:border-purple-400/40 transition-all duration-300 hover:scale-105">
                    <div class="text-4xl sm:text-5xl lg:text-6xl font-black text-transparent bg-clip-text bg-gradient-to-br from-purple-400 via-pink-400 to-purple-500">5000+</div>
                    <div class="text-sm sm:text-base font-semibold text-gray-400 uppercase tracking-wider">Happy Customers</div>
                </div>
                <div class="text-center space-y-3 p-6 rounded-2xl bg-gradient-to-br from-pink-500/10 to-indigo-500/10 backdrop-blur-sm border border-pink-500/20 hover:border-pink-400/40 transition-all duration-300 hover:scale-105">
                    <div class="text-4xl sm:text-5xl lg:text-6xl font-black text-transparent bg-clip-text bg-gradient-to-br from-pink-400 via-indigo-400 to-pink-500">50+</div>
                    <div class="text-sm sm:text-base font-semibold text-gray-400 uppercase tracking-wider">Categories</div>
                </div>
            </div>
            
        </div>
    </div>
    
    {{-- Bottom Accent Line --}}
    <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-transparent via-indigo-500 to-transparent"></div>
</div>

<style>
    @keyframes fade-in {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in {
        animation: fade-in 1s ease-out;
    }
    .bg-size-200 { background-size: 200%; }
    .bg-pos-0 { background-position: 0%; }
    .bg-pos-100 { background-position: 100%; }
</style>

{{-- Filter Section --}}
<div class="bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-700 py-4">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-wrap items-center gap-3">
            {{-- Filter Buttons --}}
            @if(isset($categories) && $categories->count() > 0)
                @foreach($categories->take(6) as $category)
                <a href="{{ route('products.category', $category) }}" 
                   class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-lg transition-colors">
                    {{ $category->name }}
                </a>
                @endforeach
            @endif
            
            <button class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-lg transition-colors flex items-center gap-2">
                All Filters
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                </svg>
            </button>
            
            {{-- Sort Dropdown --}}
            <div class="ml-auto">
                <select class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500">
                    <option>Sort by</option>
                    <option>Price: Low to High</option>
                    <option>Price: High to Low</option>
                    <option>Newest First</option>
                    <option>Most Popular</option>
                </select>
            </div>
        </div>
    </div>
</div>

{{-- Features Section --}}
<div class="bg-gray-50 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center p-6">
                <div class="w-12 h-12 bg-indigo-100 text-indigo-600 rounded-lg flex items-center justify-center mx-auto mb-5">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Fast Delivery</h3>
                <p class="text-gray-600 text-sm">Free shipping on orders over $50. Get your products quickly.</p>
            </div>

            <div class="text-center p-6">
                <div class="w-12 h-12 bg-indigo-100 text-indigo-600 rounded-lg flex items-center justify-center mx-auto mb-5">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H4a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Secure Payment</h3>
                <p class="text-gray-600 text-sm">Your payment information is protected with bank-level security.</p>
            </div>

            <div class="text-center p-6">
                <div class="w-12 h-12 bg-indigo-100 text-indigo-600 rounded-lg flex items-center justify-center mx-auto mb-5">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Premium Quality</h3>
                <p class="text-gray-600 text-sm">All products are carefully selected to ensure the highest quality.</p>
            </div>
        </div>
    </div>
</div>

{{-- Featured Categories --}}
@if($categories->count() > 0)
<div class="bg-white py-16 sm:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold font-serif text-gray-900 text-center mb-12">
            Shop by Category
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($categories as $category)
            <div class="group relative bg-gray-100 rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow">
                <div class="aspect-w-3 aspect-h-2">
                    @if($category->image)
                    <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="w-full h-full object-cover">
                    @else
                    <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                        <span class="text-gray-500 font-medium">{{ $category->name }}</span>
                    </div>
                    @endif
                </div>
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900">
                        <a href="{{ route('products.category', $category) }}" class="hover:text-indigo-600">
                            <span class="absolute inset-0"></span>
                            {{ $category->name }}
                        </a>
                    </h3>
                    <p class="text-sm text-gray-600 mt-1">{{ Str::limit($category->description, 50) }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif

{{-- Featured Products --}}
@if($featuredProducts->count() > 0)
<div class="bg-gray-50 py-16 sm:py-24" id="featured">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold font-serif text-gray-900 text-center mb-12">
            Featured Products
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            {{-- --- FIX: REMOVED @foreach AND @break --- --}}
            @include('customer.products.partials.products-grid', ['products' => $featuredProducts])
            {{-- --- END FIX --- --}}
        </div>
        <div class="text-center mt-12">
            <a href="{{ route('products.index') }}"
                class="bg-indigo-600 text-white px-8 py-3 rounded-md font-semibold text-base hover:bg-indigo-700 transition-all duration-300 shadow-sm">
                View All Products
            </a>
        </div>
    </div>
</div>
@endif

@endsection