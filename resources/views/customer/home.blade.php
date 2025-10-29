@extends('layouts.app')

@section('title', 'Nexora - Your E-commerce Destination')

@section('content')
<div class="bg-white">
    {{-- Hero Section with Enhanced Design --}}
    <div class="relative overflow-hidden bg-gradient-to-br from-blue-600 via-purple-600 to-indigo-800">
        <div class="absolute inset-0 bg-black opacity-20"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-32">
            <div class="text-center">
                <div class="mb-8">
                    <span class="inline-block px-4 py-2 bg-white bg-opacity-20 text-white text-sm font-medium rounded-full mb-4 backdrop-blur-sm">
                        ✨ Premium E-commerce Experience
                    </span>
                </div>
                <h1 class="text-5xl md:text-7xl font-extrabold text-white mb-6 leading-tight">
                    Welcome to <span class="bg-gradient-to-r from-yellow-400 to-orange-500 bg-clip-text text-transparent">Nexora</span>
                </h1>
                <p class="text-xl md:text-2xl text-blue-100 mb-10 max-w-3xl mx-auto leading-relaxed">
                    Discover premium products, cutting-edge technology, and unbeatable deals. Your journey to excellence starts here.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                    <a href="{{ route('products.index') }}" 
                       class="bg-gradient-to-r from-yellow-400 to-orange-500 text-black px-10 py-4 rounded-full font-bold text-lg hover:from-yellow-300 hover:to-orange-400 transition-all duration-300 transform hover:scale-105 shadow-2xl">
                        🛍️ Shop Now
                    </a>
                    <a href="#featured" 
                       class="border-2 border-white text-white px-10 py-4 rounded-full font-semibold text-lg hover:bg-white hover:text-purple-600 transition-all duration-300 backdrop-blur-sm">
                        Explore Products
                    </a>
                </div>
            </div>
        </div>
        {{-- Animated background elements --}}
        <div class="absolute top-10 left-10 w-20 h-20 bg-white bg-opacity-10 rounded-full animate-pulse"></div>
        <div class="absolute top-32 right-20 w-16 h-16 bg-yellow-400 bg-opacity-20 rounded-full animate-bounce"></div>
        <div class="absolute bottom-20 left-32 w-12 h-12 bg-purple-400 bg-opacity-15 rounded-full animate-ping"></div>
    </div>

    {{-- Demo Products Showcase --}}
    <div class="py-20 bg-gradient-to-b from-gray-50 to-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                    🌟 Premium Collection
                </h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Handpicked products featuring the latest technology and premium quality
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
                {{-- Demo Product Cards --}}
                <div class="group bg-white rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2">
                    <div class="relative overflow-hidden">
                        <img src="{{ asset('uploads/demo/laptop-1.jpg') }}" alt="Gaming Laptop" class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute top-4 left-4 bg-red-500 text-white px-3 py-1 rounded-full text-sm font-bold">
                            🔥 Hot Deal
                        </div>
                        <div class="absolute top-4 right-4 bg-black bg-opacity-50 text-white p-2 rounded-full opacity-0 group-hover:opacity-100 transition-opacity">
                            ❤️
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Gaming Laptop Pro</h3>
                        <p class="text-gray-600 mb-4">High-performance laptop for gaming and productivity</p>
                        <div class="flex justify-between items-center">
                            <div>
                                <span class="text-2xl font-bold text-purple-600">$1,299</span>
                                <span class="text-sm text-gray-500 line-through ml-2">$1,599</span>
                            </div>
                            <button class="bg-gradient-to-r from-purple-600 to-blue-600 text-white px-6 py-2 rounded-full font-semibold hover:from-purple-700 hover:to-blue-700 transition-all">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                </div>

                <div class="group bg-white rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2">
                    <div class="relative overflow-hidden">
                        <img src="{{ asset('uploads/demo/smartphone-1.jpg') }}" alt="Smartphone" class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute top-4 left-4 bg-green-500 text-white px-3 py-1 rounded-full text-sm font-bold">
                            ✨ New
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Premium Smartphone</h3>
                        <p class="text-gray-600 mb-4">Latest flagship with advanced camera system</p>
                        <div class="flex justify-between items-center">
                            <span class="text-2xl font-bold text-purple-600">$899</span>
                            <button class="bg-gradient-to-r from-purple-600 to-blue-600 text-white px-6 py-2 rounded-full font-semibold hover:from-purple-700 hover:to-blue-700 transition-all">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                </div>

                <div class="group bg-white rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2">
                    <div class="relative overflow-hidden">
                        <img src="{{ asset('uploads/demo/headphones-1.jpg') }}" alt="Headphones" class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute top-4 left-4 bg-blue-500 text-white px-3 py-1 rounded-full text-sm font-bold">
                            🎵 Audio
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Wireless Headphones</h3>
                        <p class="text-gray-600 mb-4">Premium sound quality with noise cancellation</p>
                        <div class="flex justify-between items-center">
                            <span class="text-2xl font-bold text-purple-600">$299</span>
                            <button class="bg-gradient-to-r from-purple-600 to-blue-600 text-white px-6 py-2 rounded-full font-semibold hover:from-purple-700 hover:to-blue-700 transition-all">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Additional Demo Products Row --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
                <div class="group bg-white rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2">
                    <div class="relative overflow-hidden">
                        <img src="{{ asset('uploads/demo/camera-1.jpg') }}" alt="Digital Camera" class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute top-4 left-4 bg-purple-500 text-white px-3 py-1 rounded-full text-sm font-bold">
                            📸 Photo
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Professional Camera</h3>
                        <p class="text-gray-600 mb-4">Capture stunning photos with professional quality</p>
                        <div class="flex justify-between items-center">
                            <span class="text-2xl font-bold text-purple-600">$799</span>
                            <button class="bg-gradient-to-r from-purple-600 to-blue-600 text-white px-6 py-2 rounded-full font-semibold hover:from-purple-700 hover:to-blue-700 transition-all">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                </div>

                <div class="group bg-white rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2">
                    <div class="relative overflow-hidden">
                        <img src="{{ asset('uploads/demo/tablet-1.jpg') }}" alt="Tablet" class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute top-4 left-4 bg-indigo-500 text-white px-3 py-1 rounded-full text-sm font-bold">
                            💻 Tablet
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Premium Tablet</h3>
                        <p class="text-gray-600 mb-4">Perfect for work and entertainment on the go</p>
                        <div class="flex justify-between items-center">
                            <span class="text-2xl font-bold text-purple-600">$599</span>
                            <button class="bg-gradient-to-r from-purple-600 to-blue-600 text-white px-6 py-2 rounded-full font-semibold hover:from-purple-700 hover:to-blue-700 transition-all">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                </div>

                <div class="group bg-white rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2">
                    <div class="relative overflow-hidden">
                        <img src="{{ asset('uploads/demo/watch-1.jpg') }}" alt="Smart Watch" class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute top-4 left-4 bg-pink-500 text-white px-3 py-1 rounded-full text-sm font-bold">
                            ⌚ Smart
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Smart Watch</h3>
                        <p class="text-gray-600 mb-4">Stay connected with advanced health tracking</p>
                        <div class="flex justify-between items-center">
                            <span class="text-2xl font-bold text-purple-600">$399</span>
                            <button class="bg-gradient-to-r from-purple-600 to-blue-600 text-white px-6 py-2 rounded-full font-semibold hover:from-purple-700 hover:to-blue-700 transition-all">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Call to Action for Demo Products --}}
            <div class="text-center">
                <a href="{{ route('products.index') }}" 
                   class="inline-flex items-center bg-gradient-to-r from-purple-600 to-blue-600 text-white px-12 py-4 rounded-full font-bold text-xl hover:from-purple-700 hover:to-blue-700 transition-all duration-300 transform hover:scale-105 shadow-2xl">
                    <span class="mr-2">🚀</span>
                    Explore All Products
                    <span class="ml-2">→</span>
                </a>
            </div>
        </div>
    </div>

    {{-- Features Section --}}
    <div class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Why Choose Nexora?</h2>
                <p class="text-xl text-gray-600">Experience the difference with our premium service</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center p-8 rounded-2xl bg-gradient-to-br from-blue-50 to-purple-50 hover:shadow-lg transition-shadow">
                    <div class="w-16 h-16 bg-gradient-to-r from-blue-600 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-6">
                        <span class="text-2xl">🚚</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Fast Delivery</h3>
                    <p class="text-gray-600">Free shipping on orders over $50. Get your products delivered within 2-3 business days.</p>
                </div>
                
                <div class="text-center p-8 rounded-2xl bg-gradient-to-br from-green-50 to-blue-50 hover:shadow-lg transition-shadow">
                    <div class="w-16 h-16 bg-gradient-to-r from-green-600 to-blue-600 rounded-full flex items-center justify-center mx-auto mb-6">
                        <span class="text-2xl">🛡️</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Secure Payment</h3>
                    <p class="text-gray-600">Your payment information is protected with bank-level security and encryption.</p>
                </div>
                
                <div class="text-center p-8 rounded-2xl bg-gradient-to-br from-purple-50 to-pink-50 hover:shadow-lg transition-shadow">
                    <div class="w-16 h-16 bg-gradient-to-r from-purple-600 to-pink-600 rounded-full flex items-center justify-center mx-auto mb-6">
                        <span class="text-2xl">💎</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Premium Quality</h3>
                    <p class="text-gray-600">All products are carefully selected and tested to ensure the highest quality standards.</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Featured Categories --}}
    @if($categories->count() > 0)
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <h2 class="text-3xl font-bold text-gray-900 text-center mb-12" style="font-family: 'Crimson Text', serif;">
            Shop by Category
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($categories as $category)
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                @if($category->image)
                    <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="w-full h-48 object-cover">
                @else
                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                        <span class="text-gray-500">{{ $category->name }}</span>
                    </div>
                @endif
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $category->name }}</h3>
                    <p class="text-gray-600 mb-4">{{ $category->description }}</p>
                    <a href="{{ route('products.category', $category) }}" 
                       class="text-indigo-600 hover:text-indigo-800 font-medium">
                        View Products →
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    {{-- Featured Products --}}
    @if($featuredProducts->count() > 0)
    <div class="bg-gray-50 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-gray-900 text-center mb-12" style="font-family: 'Crimson Text', serif;">
                Featured Products
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($featuredProducts as $product)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                            <span class="text-gray-500">No Image</span>
                        </div>
                    @endif
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $product->name }}</h3>
                        <p class="text-gray-600 text-sm mb-3">{{ Str::limit($product->description, 80) }}</p>
                        <div class="flex justify-between items-center">
                            <span class="text-2xl font-bold text-indigo-600">${{ number_format($product->price, 2) }}</span>
                            <a href="{{ route('products.show', $product) }}" 
                               class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition-colors">
                                View
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="text-center mt-12">
                <a href="{{ route('products.index') }}" 
                   class="bg-indigo-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-indigo-700 transition-colors">
                    View All Products
                </a>
            </div>
        </div>
    </div>
    @endif

    {{-- Call to Action --}}
    <div class="bg-indigo-600 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold text-white mb-4" style="font-family: 'Crimson Text', serif;">
                Ready to Start Shopping?
            </h2>
            <p class="text-xl text-indigo-100 mb-8">
                Join thousands of satisfied customers and discover amazing deals today.
            </p>
            @guest
                <a href="{{ route('register') }}" 
                   class="bg-white text-indigo-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors mr-4">
                    Sign Up Now
                </a>
                <a href="{{ route('login') }}" 
                   class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-indigo-600 transition-colors">
                    Login
                </a>
            @else
                <a href="{{ route('products.index') }}" 
                   class="bg-white text-indigo-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
                    Continue Shopping
                </a>
            @endguest
        </div>
    </div>
</div>
@endsection
