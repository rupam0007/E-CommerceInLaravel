@extends('layouts.app')

@section('title', 'Nexora - Your E-commerce Destination')

@section('content')

{{-- New Hero Section --}}
<div class="bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 sm:py-32">
        <div class="text-center">
            <h1 class="text-5xl md:text-6xl font-bold font-serif text-gray-900 mb-6 leading-tight">
                Welcome to Nexora
            </h1>
            <p class="text-lg md:text-xl text-gray-600 mb-10 max-w-2xl mx-auto">
                Discover premium products, cutting-edge technology, and unbeatable deals. Your journey to excellence starts here.
            </p>
            <div class="flex gap-4 justify-center items-center">
                <a href="{{ route('products.index') }}"
                    class="bg-indigo-600 text-white px-8 py-3 rounded-md font-semibold text-base hover:bg-indigo-700 transition-all duration-300 shadow-sm">
                    Shop Now
                </a>
                <a href="#featured"
                    class="bg-white text-gray-900 border border-gray-300 px-8 py-3 rounded-md font-semibold text-base hover:bg-gray-50 transition-all duration-300">
                    Explore Products
                </a>
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
            {{-- Use the new, cleaner product card partial --}}
            @foreach($featuredProducts as $product)
            @include('customer.products.partials.products-grid', ['products' => $featuredProducts])
            @break {{-- products-grid partial expects and loops over $products --}}
            @endforeach
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