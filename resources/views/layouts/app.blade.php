<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        // Apply theme immediately to prevent flash
        (function() {
            const theme = localStorage.getItem('theme-preference') || 'dark';
            const root = document.documentElement;

            if (theme === 'dark') {
                root.classList.add('dark');
            } else {
                root.classList.remove('dark');
            }
        })();
    </script>

    <title>@yield('title', 'Nexora - Your E-Commerce Destination')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Toastify CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

    <script>
        $(document).ready(function() {
            function updateCartCount() {
                $.ajax({
                    url: '{{ route("cart.count") }}',
                    type: 'GET',
                    success: function(response) {
                        $('#cart-count').text(response.count);
                    },
                    error: function() {
                        $('#cart-count').text('0');
                    }
                });
            }

            function updateWishlistCount() {
                $.ajax({
                    url: '{{ route("wishlist.count") }}',
                    type: 'GET',
                    success: function(response) {
                        $('#wishlist-count').text(response.count);
                    },
                    error: function() {
                        $('#wishlist-count').text('0');
                    }
                });
            }

            updateCartCount();
            updateWishlistCount();

            $(document).on('cart-updated', updateCartCount);
            $(document).on('wishlist-updated', updateWishlistCount);
        });
    </script>
</head>

<body class="font-sans antialiased theme-bg transition-colors duration-300">
    <div class="min-h-screen theme-bg transition-colors duration-300">

        {{-- Professional Header --}}
        <header class="sticky top-0 z-50 bg-white dark:bg-gray-900 shadow-md border-b border-gray-200 dark:border-gray-800">
            {{-- Top Bar --}}
            <div class="bg-gray-900 dark:bg-gray-950 border-b border-gray-800">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex items-center justify-between h-9">
                        <div class="flex items-center gap-6 text-xs text-gray-300">
                            <span class="hidden md:inline-flex items-center gap-2">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
                                </svg>
                                <span>Free shipping on orders over $50</span>
                            </span>
                        </div>
                        <div class="flex items-center gap-5 text-xs">
                            <a href="{{ route('orders.index') }}" class="text-gray-300 hover:text-white transition-colors hidden sm:block">Track Order</a>
                            <span class="hidden sm:block text-gray-700">|</span>
                            <a href="#" class="text-gray-300 hover:text-white transition-colors">Help & Support</a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Main Navigation --}}
            <nav class="bg-white dark:bg-gray-900 border-b border-gray-100 dark:border-gray-800">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex items-center justify-between h-16">

                        {{-- Logo --}}
                        <div class="flex-shrink-0">
                            <a href="{{ route('home') }}" class="flex items-center group">
                                <div class="w-10 h-10 bg-gradient-to-br from-gray-900 to-gray-700 dark:from-cyan-600 dark:to-teal-600 rounded-lg flex items-center justify-center group-hover:shadow-lg transition-all">
                                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <span class="text-xl font-bold text-gray-900 dark:text-white tracking-tight">Nexora</span>
                                    <span class="hidden lg:block text-xs text-gray-500 dark:text-gray-400 font-medium">Premium Shopping</span>
                                </div>
                            </a>
                        </div>

                        {{-- Search Bar (Desktop) --}}
                        <div class="hidden md:flex flex-1 max-w-xl mx-8">
                            <div class="relative w-full">
                                <input type="text" placeholder="Search products, brands..." 
                                    class="w-full h-10 pl-11 pr-4 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900 dark:focus:ring-cyan-500 focus:border-transparent text-sm text-gray-900 dark:text-gray-100 placeholder:text-gray-500 transition-all">
                                <svg class="absolute left-3.5 top-2.5 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                        </div>

                        {{-- Right Side Actions --}}
                        <div class="flex items-center gap-2 sm:gap-4">
                            
                            @guest
                            {{-- Login Button --}}
                            <a href="{{ route('login') }}" class="hidden sm:inline-flex items-center gap-2 h-9 px-5 text-sm font-semibold text-white bg-gray-900 dark:bg-cyan-600 hover:bg-gray-800 dark:hover:bg-cyan-700 rounded-lg transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Sign In
                            </a>
                            @else
                            {{-- User Profile --}}
                            <div class="relative">
                                <button type="button" class="flex items-center gap-2 h-9 px-2.5 hover:bg-gray-50 dark:hover:bg-gray-800 rounded-lg transition-colors" id="profile-button">
                                    @php 
                                        $user = Auth::user();
                                        $media = $user->profile_media;
                                    @endphp
                                    <div class="h-8 w-8 rounded-full overflow-hidden ring-2 ring-gray-200 dark:ring-gray-700">
                                        @if($media['type'] == 'video')
                                            <video src="{{ $media['url'] }}" autoplay loop muted playsinline class="w-full h-full object-cover"></video>
                                        @elseif($media['type'] == 'image')
                                            <img src="{{ $media['url'] }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-blue-500 to-purple-600">
                                                <span class="text-xs font-bold text-white">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                                            </div>
                                        @endif
                                    </div>
                                    <span class="hidden sm:inline text-sm font-medium text-gray-700 dark:text-gray-300">{{ Str::limit($user->name, 15) }}</span>
                                    <svg class="hidden sm:block w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>

                                {{-- Dropdown Menu --}}
                                <div id="profile-menu" class="hidden absolute right-0 mt-2 w-64 bg-white dark:bg-gray-800 rounded-lg shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden" role="menu">
                                    <div class="px-4 py-3 bg-gray-50 dark:bg-gray-900/50 border-b border-gray-200 dark:border-gray-700">
                                        <p class="text-sm font-semibold text-gray-900 dark:text-white truncate">{{ $user->name }}</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400 truncate mt-0.5">{{ $user->email }}</p>
                                    </div>
                                    <div class="py-1">
                                        <a href="{{ route('profile.show') }}" class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 dark:text-gray-300 hover:bg-cyan-50 dark:hover:bg-gray-700 transition-colors" role="menuitem">
                                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                            My Profile
                                        </a>
                                        <a href="{{ route('orders.index') }}" class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 dark:text-gray-300 hover:bg-cyan-50 dark:hover:bg-gray-700 transition-colors" role="menuitem">
                                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                                            My Orders
                                        </a>
                                        <a href="{{ route('wishlist.index') }}" class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 dark:text-gray-300 hover:bg-cyan-50 dark:hover:bg-gray-700 transition-colors" role="menuitem">
                                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 016.364 0L12 7.636l1.318-1.318a4.5 4.5 0 016.364 6.364L12 20.364l-7.682-7.682a4.5 4.5 0 010-6.364z"></path></svg>
                                            My Wishlist
                                        </a>
                                        <hr class="my-2 border-gray-200 dark:border-gray-700">
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="flex items-center gap-3 w-full px-4 py-3 text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors" role="menuitem">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                                Logout
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endguest

                            {{-- Wishlist --}}
                            <a href="{{ route('wishlist.index') }}" class="relative p-2 hover:bg-gray-50 dark:hover:bg-gray-800 rounded-lg transition-colors group">
                                <svg class="w-5 h-5 text-gray-700 dark:text-gray-300 group-hover:text-pink-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 016.364 0L12 7.636l1.318-1.318a4.5 4.5 0 016.364 6.364L12 20.364l-7.682-7.682a4.5 4.5 0 010-6.364z"></path>
                                </svg>
                                <span id="wishlist-count" class="absolute -top-1 -right-1 bg-pink-500 text-white text-xs font-bold rounded-full h-4 w-4 flex items-center justify-center">0</span>
                            </a>

                            {{-- Cart --}}
                            <a href="{{ route('cart.index') }}" class="relative p-2 hover:bg-gray-50 dark:hover:bg-gray-800 rounded-lg transition-colors group">
                                <svg class="w-5 h-5 text-gray-700 dark:text-gray-300 group-hover:text-gray-900 dark:group-hover:text-cyan-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                <span id="cart-count" class="absolute -top-1 -right-1 bg-gray-900 dark:bg-cyan-500 text-white text-xs font-bold rounded-full h-4 w-4 flex items-center justify-center">0</span>
                            </a>

                            {{-- Theme Toggle --}}
                            <button type="button" class="p-2 hover:bg-gray-50 dark:hover:bg-gray-800 rounded-lg transition-colors" data-theme-toggle title="Toggle theme">
                                <svg class="w-5 h-5 text-gray-700 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </nav>

            {{-- Category Navigation --}}
            <div class="bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-800">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex items-center gap-6 h-11 overflow-x-auto scrollbar-hide">
                        <a href="{{ route('home') }}" class="flex-shrink-0 text-sm font-semibold {{ request()->routeIs('home') ? 'text-gray-900 dark:text-white border-b-2 border-gray-900 dark:border-cyan-500' : 'text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white' }} transition-colors pb-3">
                            Home
                        </a>
                        <a href="{{ route('products.index') }}" class="flex-shrink-0 text-sm font-semibold {{ request()->routeIs('products.index') ? 'text-gray-900 dark:text-white border-b-2 border-gray-900 dark:border-cyan-500' : 'text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white' }} transition-colors pb-3">
                            All Products
                        </a>
                        <a href="{{ route('categories.index') }}" class="flex-shrink-0 text-sm font-semibold {{ request()->routeIs('categories.index') ? 'text-gray-900 dark:text-white border-b-2 border-gray-900 dark:border-cyan-500' : 'text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white' }} transition-colors pb-3">
                            Categories
                        </a>
                        @php
                            $headerCategories = \App\Models\Category::take(6)->get();
                        @endphp
                        @foreach($headerCategories as $category)
                        <a href="{{ route('products.category', $category) }}" class="flex-shrink-0 text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition-colors pb-3">
                            {{ $category->name }}
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </header>

        <main>
            @yield('content')
        </main>

        {{-- Modern Flipkart-Style Footer --}}
        <footer class="mt-auto bg-gray-900 text-gray-300">
            {{-- Main Footer Content --}}
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                    
                    {{-- About Section --}}
                    <div>
                        <div class="flex items-center gap-2 mb-4">
                            <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-purple-600 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2L2 7v10c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7l-10-5z"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-white">Nexora</h3>
                        </div>
                        <p class="text-sm text-gray-400 mb-4">
                            Your trusted online marketplace for quality products at the best prices. Shop with confidence!
                        </p>
                        <div class="flex gap-3">
                            <a href="#" class="w-9 h-9 bg-gray-800 hover:bg-blue-600 rounded-full flex items-center justify-center transition-all">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                            </a>
                            <a href="#" class="w-9 h-9 bg-gray-800 hover:bg-blue-400 rounded-full flex items-center justify-center transition-all">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                            </a>
                            <a href="#" class="w-9 h-9 bg-gray-800 hover:bg-pink-600 rounded-full flex items-center justify-center transition-all">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z"/></svg>
                            </a>
                        </div>
                    </div>

                    {{-- Quick Links --}}
                    <div>
                        <h4 class="text-sm font-bold text-white uppercase mb-4">Quick Links</h4>
                        <ul class="space-y-2.5 text-sm">
                            <li><a href="{{ route('home') }}" class="hover:text-blue-400 transition-colors">Home</a></li>
                            <li><a href="{{ route('products.index') }}" class="hover:text-blue-400 transition-colors">All Products</a></li>
                            <li><a href="{{ route('categories.index') }}" class="hover:text-blue-400 transition-colors">Categories</a></li>
                            <li><a href="{{ route('cart.index') }}" class="hover:text-blue-400 transition-colors">Shopping Cart</a></li>
                            <li><a href="{{ route('wishlist.index') }}" class="hover:text-blue-400 transition-colors">My Wishlist</a></li>
                        </ul>
                    </div>

                    {{-- Customer Care --}}
                    <div>
                        <h4 class="text-sm font-bold text-white uppercase mb-4">Customer Care</h4>
                        <ul class="space-y-2.5 text-sm">
                            <li><a href="{{ route('profile.show') }}" class="hover:text-blue-400 transition-colors">My Account</a></li>
                            <li><a href="{{ route('orders.index') }}" class="hover:text-blue-400 transition-colors">Track Order</a></li>
                            <li><a href="#" class="hover:text-blue-400 transition-colors">Help Center</a></li>
                            <li><a href="#" class="hover:text-blue-400 transition-colors">Returns & Refunds</a></li>
                            <li><a href="#" class="hover:text-blue-400 transition-colors">Shipping Info</a></li>
                        </ul>
                    </div>

                    {{-- Contact Info --}}
                    <div>
                        <h4 class="text-sm font-bold text-white uppercase mb-4">Contact Us</h4>
                        <ul class="space-y-3 text-sm">
                            <li class="flex items-start gap-2">
                                <svg class="w-5 h-5 text-blue-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span>123 E-Commerce Street<br>Kolkata, WB 700001</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-blue-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                <span>support@nexora.com</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-blue-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                <span>+91 1800-123-4567</span>
                            </li>
                        </ul>
                    </div>
                </div>

                {{-- Payment Methods & Trust Badges --}}
                <div class="mt-12 pt-8 border-t border-gray-800">
                    <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                        <div class="flex items-center gap-4 flex-wrap justify-center md:justify-start">
                            <span class="text-sm text-gray-400">We Accept:</span>
                            <div class="flex gap-2">
                                <div class="h-8 px-3 bg-gray-800 rounded flex items-center justify-center">
                                    <span class="text-xs font-bold text-white">VISA</span>
                                </div>
                                <div class="h-8 px-3 bg-gray-800 rounded flex items-center justify-center">
                                    <span class="text-xs font-bold text-white">MC</span>
                                </div>
                                <div class="h-8 px-3 bg-gray-800 rounded flex items-center justify-center">
                                    <span class="text-xs font-bold text-white">AMEX</span>
                                </div>
                                <div class="h-8 px-3 bg-gray-800 rounded flex items-center justify-center">
                                    <span class="text-xs font-bold text-blue-400">PayPal</span>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="flex items-center gap-2 text-sm">
                                <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                </svg>
                                <span class="text-gray-400">Secure Payments</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Bottom Bar --}}
            <div class="border-t border-gray-800 bg-gray-950">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                    <div class="flex flex-col md:flex-row items-center justify-between gap-4 text-sm text-gray-400">
                        <p>&copy; {{ date('Y') }} Nexora. All rights reserved.</p>
                        <div class="flex gap-6">
                            <a href="#" class="hover:text-blue-400 transition-colors">Privacy Policy</a>
                            <a href="#" class="hover:text-blue-400 transition-colors">Terms of Service</a>
                            <a href="#" class="hover:text-blue-400 transition-colors">Cookie Policy</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <style>
        /* Scrollbar Hide for Category Bar */
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }
        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        
        /* Smooth Transitions */
        * {
            transition-property: color, background-color, border-color, text-decoration-color, fill, stroke, opacity, box-shadow, transform;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            transition-duration: 150ms;
        }
        
        /* Dropdown Animation */
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        #profile-menu:not(.hidden) {
            animation: slideDown 0.2s ease-out;
        }
    </style>

    <script>
        $(document).ready(function() {
            const $profileButton = $('#profile-button');
            const $profileMenu = $('#profile-menu');

            // Profile dropdown toggle
            $profileButton.on('click', function(e) {
                e.stopPropagation();
                $profileMenu.toggleClass('hidden');
            });

            // Close dropdown when clicking outside
            $(document).on('click', function(event) {
                if (!$profileButton.is(event.target) && $profileButton.has(event.target).length === 0 &&
                    !$profileMenu.is(event.target) && $profileMenu.has(event.target).length === 0) {
                    $profileMenu.addClass('hidden');
                }
            });

            // Close dropdown on ESC key
            $(document).on('keydown', function(e) {
                if (e.key === 'Escape') {
                    $profileMenu.addClass('hidden');
                }
            });
        });
    </script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script>
        @if (session('success'))
            Toastify({
                text: "✓ {{ session('success') }}",
                duration: 4000,
                close: true,
                gravity: "top",
                position: "right",
                stopOnFocus: true,
                className: "toastify-success",
                style: {
                    background: "linear-gradient(135deg, #10b981 0%, #059669 100%)",
                    borderRadius: "12px",
                    padding: "16px 24px",
                    fontSize: "15px",
                    fontWeight: "500",
                    boxShadow: "0 10px 25px rgba(16, 185, 129, 0.3)",
                },
            }).showToast();
        @endif

        @if (session('error'))
            Toastify({
                text: "✕ {{ session('error') }}",
                duration: 5000,
                close: true,
                gravity: "top",
                position: "right",
                stopOnFocus: true,
                className: "toastify-error",
                style: {
                    background: "linear-gradient(135deg, #ef4444 0%, #dc2626 100%)",
                    borderRadius: "12px",
                    padding: "16px 24px",
                    fontSize: "15px",
                    fontWeight: "500",
                    boxShadow: "0 10px 25px rgba(239, 68, 68, 0.3)",
                },
            }).showToast();
        @endif

        @if (session('warning'))
            Toastify({
                text: "⚠ {{ session('warning') }}",
                duration: 4000,
                close: true,
                gravity: "top",
                position: "right",
                stopOnFocus: true,
                className: "toastify-warning",
                style: {
                    background: "linear-gradient(135deg, #f59e0b 0%, #d97706 100%)",
                    borderRadius: "12px",
                    padding: "16px 24px",
                    fontSize: "15px",
                    fontWeight: "500",
                    boxShadow: "0 10px 25px rgba(245, 158, 11, 0.3)",
                },
            }).showToast();
        @endif

        @if (session('info'))
            Toastify({
                text: "ℹ {{ session('info') }}",
                duration: 4000,
                close: true,
                gravity: "top",
                position: "right",
                stopOnFocus: true,
                className: "toastify-info",
                style: {
                    background: "linear-gradient(135deg, #3b82f6 0%, #2563eb 100%)",
                    borderRadius: "12px",
                    padding: "16px 24px",
                    fontSize: "15px",
                    fontWeight: "500",
                    boxShadow: "0 10px 25px rgba(59, 130, 246, 0.3)",
                },
            }).showToast();
        @endif
    </script>
    
    <style>
        /* Enhanced Toastify Styles */
        .toastify {
            font-family: inherit;
            letter-spacing: 0.3px;
            backdrop-filter: blur(10px);
        }
        
        .toastify-success {
            animation: slideInRight 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }
        
        .toastify-error {
            animation: slideInRight 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }
        
        .toastify-warning {
            animation: slideInRight 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }
        
        .toastify-info {
            animation: slideInRight 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }
        
        @keyframes slideInRight {
            from {
                transform: translateX(400px);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
        
        .toastify-close {
            opacity: 0.7;
            font-size: 20px;
            font-weight: bold;
        }
        
        .toastify-close:hover {
            opacity: 1;
        }
    </style>
    
    @stack('scripts')
</body>
</html>