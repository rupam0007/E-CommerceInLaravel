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
    
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

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

<body class="font-sans antialiased theme-bg">
    <div class="min-h-screen theme-bg">

        {{-- Clean Purple Header --}}
        <header class="sticky top-0 z-[9998] backdrop-blur-md theme-surface shadow-md theme-border border-b">
            {{-- Simple Top Bar --}}
            <div class="bg-purple-600">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex items-center justify-between h-9">
                        <div class="flex items-center gap-4 text-xs text-white">
                            @auth('admin')
                                <span class="inline-flex items-center gap-1.5 font-medium">
                                    <span class="material-icons text-sm">admin_panel_settings</span>
                                    <span>Admin Panel</span>
                                </span>
                            @else
                                <span class="hidden md:inline-flex items-center gap-1.5">
                                    <span class="material-icons text-sm">local_shipping</span>
                                    <span>Free Delivery on orders above ₹499</span>
                                </span>
                            @endauth
                        </div>
                        <div class="flex items-center gap-4 text-xs text-white">
                            @auth('admin')
                                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-1 hover:text-purple-200">
                                    <span class="material-icons text-sm">dashboard</span>
                                    Dashboard
                                </a>
                            @else
                                <a href="{{ route('orders.index') }}" class="hidden sm:flex items-center gap-1 hover:text-purple-200">
                                    <span class="material-icons text-sm">local_shipping</span>
                                    Track Order
                                </a>
                            @endauth
                            <a href="#" class="flex items-center gap-1 hover:text-purple-200">
                                <span class="material-icons text-sm">support_agent</span>
                                Support
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Main Navigation --}}
            <nav class="theme-surface">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex items-center justify-between h-16">

                        {{-- Logo --}}
                        <div class="flex-shrink-0">
                            <a href="{{ route('home') }}" class="flex items-center gap-2.5">
                                <div class="w-10 h-10 bg-purple-600 rounded-xl flex items-center justify-center">
                                    <span class="material-icons text-white text-2xl">shopping_bag</span>
                                </div>
                                <span class="text-xl font-bold text-purple-600">Nexora</span>
                            </a>
                        </div>

                        {{-- Navigation Links --}}
                        <div class="hidden md:flex items-center gap-6 flex-1 justify-center">
                            @auth('admin')
                                <a href="{{ route('admin.dashboard') }}" class="text-sm font-medium {{ request()->routeIs('admin.dashboard') ? 'text-purple-600 dark:text-purple-400' : 'theme-text-muted hover-theme-accent' }}">
                                    Dashboard
                                </a>
                                <a href="{{ route('admin.products.index') }}" class="text-sm font-medium {{ request()->routeIs('admin.products.*') ? 'text-purple-600 dark:text-purple-400' : 'theme-text-muted hover-theme-accent' }}">
                                    Products
                                </a>
                                <a href="{{ route('admin.orders.index') }}" class="text-sm font-medium {{ request()->routeIs('admin.orders.*') ? 'text-purple-600 dark:text-purple-400' : 'theme-text-muted hover-theme-accent' }}">
                                    Orders
                                </a>
                                <a href="{{ route('admin.customers.index') }}" class="text-sm font-medium {{ request()->routeIs('admin.customers.*') ? 'text-purple-600 dark:text-purple-400' : 'theme-text-muted hover-theme-accent' }}">
                                    Customers
                                </a>
                            @else
                                <a href="{{ route('home') }}" class="text-sm font-medium {{ request()->routeIs('home') ? 'text-purple-600 dark:text-purple-400' : 'theme-text-muted hover-theme-accent' }}">
                                    Home
                                </a>
                                <a href="{{ route('products.index') }}" class="text-sm font-medium {{ request()->routeIs('products.index') ? 'text-purple-600 dark:text-purple-400' : 'theme-text-muted hover-theme-accent' }}">
                                    Products
                                </a>
                            @endauth
                            
                            @guest('admin')
                            {{-- Categories Dropdown --}}
                            <div class="relative" id="categories-dropdown">
                                <button type="button" class="flex items-center gap-1 text-sm font-medium {{ request()->routeIs('categories.*') || request()->routeIs('products.category') ? 'text-purple-600 dark:text-purple-400' : 'theme-text-muted hover-theme-accent' }}" id="categories-button">
                                    Categories
                                    <span class="material-icons text-sm">expand_more</span>
                                </button>
                                
                                {{-- Clean Dropdown Menu --}}
                                <div id="categories-menu" class="hidden absolute left-0 top-full mt-2 w-64 theme-surface rounded-xl shadow-lg theme-border border overflow-hidden z-50">
                                    <div class="py-1 max-h-96 overflow-y-auto">
                                        <a href="{{ route('categories.index') }}" class="flex items-center gap-2.5 px-4 py-2.5 text-sm font-medium hover-theme-surface">
                                            <span class="material-icons text-purple-600 text-lg">apps</span>
                                            All Categories
                                        </a>
                                        <hr class="theme-border my-1">
                                        @php
                                            $allCategories = \App\Models\Category::all();
                                        @endphp
                                        @foreach($allCategories as $category)
                                        <a href="{{ route('products.category', $category) }}" class="flex items-center gap-2.5 px-4 py-2.5 text-sm hover-theme-surface theme-text-muted hover-theme-accent">
                                            <span class="material-icons text-lg">category</span>
                                            {{ $category->name }}
                                        </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @endguest
                        </div>

                        {{-- Action Icons --}}
                        <div class="flex items-center gap-2">
                            
                            @guest('admin')
                            @guest
                            {{-- Login Button --}}
                            <a href="{{ route('login') }}" class="inline-flex items-center gap-1.5 h-10 px-5 text-sm font-medium text-white bg-purple-600 hover:bg-purple-700 rounded-lg">
                                <span class="material-icons text-lg">person</span>
                                <span class="hidden sm:inline">Login</span>
                            </a>
                            @else
                            {{-- User Profile --}}
                            <div class="relative z-[9999]">
                                <button type="button" class="flex items-center gap-2 h-10 px-2.5 hover-theme-surface rounded-lg" id="profile-button">
                                    @php 
                                        $user = Auth::user();
                                        $media = $user->profile_media ?? ['type' => 'text', 'url' => ''];
                                    @endphp
                                    <div class="h-9 w-9 rounded-full overflow-hidden ring-2 ring-purple-600 flex-shrink-0">
                                        @if(isset($media['type']) && $media['type'] == 'video' && !empty($media['url']))
                                            <video src="{{ $media['url'] }}" autoplay loop muted playsinline class="w-full h-full object-cover"></video>
                                        @elseif(isset($media['type']) && $media['type'] == 'image' && !empty($media['url']))
                                            <img src="{{ $media['url'] }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center bg-purple-600">
                                                <span class="text-sm font-bold text-white">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                                            </div>
                                        @endif
                                    </div>
                                    <span class="hidden sm:inline text-sm font-bold text-gray-800">{{ Str::limit($user->name, 12) }}</span>
                                    <span class="material-icons hidden sm:block text-gray-600 text-lg">expand_more</span>
                                </button>

                                {{-- Clean Dropdown Menu --}}
                                <div id="profile-menu" class="hidden absolute right-0 mt-2 w-56 theme-surface rounded-xl shadow-lg theme-border border overflow-hidden" role="menu">
                                    <div class="px-4 py-3 bg-purple-600">
                                        <p class="text-sm font-medium text-white truncate">{{ $user->name }}</p>
                                        <p class="text-xs text-purple-100 truncate mt-0.5">{{ $user->email }}</p>
                                    </div>
                                    <div class="py-1">
                                        <a href="{{ route('profile.show') }}" class="flex items-center gap-2.5 px-4 py-2.5 text-sm font-medium hover-theme-surface" role="menuitem">
                                            <span class="material-icons text-purple-600 text-lg">account_circle</span>
                                            My Profile
                                        </a>
                                        <a href="{{ route('orders.index') }}" class="flex items-center gap-2.5 px-4 py-2.5 text-sm font-medium hover-theme-surface" role="menuitem">
                                            <span class="material-icons text-purple-600 text-lg">shopping_bag</span>
                                            My Orders
                                        </a>
                                        <a href="{{ route('wishlist.index') }}" class="flex items-center gap-2.5 px-4 py-2.5 text-sm font-medium hover-theme-surface" role="menuitem">
                                            <span class="material-icons text-purple-600 text-lg">favorite</span>
                                            My Wishlist
                                        </a>
                                        <hr class="theme-border my-1">
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="flex items-center gap-2.5 w-full px-4 py-2.5 text-sm font-medium text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 text-left" role="menuitem">
                                                <span class="material-icons text-lg">logout</span>
                                                Logout
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endguest
                            @endguest

                            @auth('admin')
                            {{-- Admin Profile --}}
                            <div class="relative z-[9999]">
                                <button type="button" class="flex items-center gap-2 h-10 px-2.5 hover-theme-surface rounded-lg" id="admin-profile-button">
                                    <div class="h-9 w-9 rounded-full overflow-hidden ring-2 ring-purple-600 flex-shrink-0">
                                        <div class="w-full h-full flex items-center justify-center bg-purple-600">
                                            <span class="text-sm font-bold text-white">{{ strtoupper(substr(Auth::guard('admin')->user()->name, 0, 1)) }}</span>
                                        </div>
                                    </div>
                                    <span class="hidden sm:inline text-sm font-medium">{{ Str::limit(Auth::guard('admin')->user()->name, 12) }}</span>
                                    <span class="material-icons hidden sm:block text-sm">expand_more</span>
                                </button>

                                {{-- Admin Dropdown Menu --}}
                                <div id="admin-profile-menu" class="hidden absolute right-0 mt-2 w-56 theme-surface rounded-xl shadow-lg theme-border border overflow-hidden" role="menu">
                                    <div class="px-4 py-3 bg-purple-600">
                                        <p class="text-sm font-medium text-white truncate">{{ Auth::guard('admin')->user()->name }}</p>
                                        <p class="text-xs text-purple-100 truncate mt-0.5">{{ Auth::guard('admin')->user()->email }}</p>
                                    </div>
                                    <div class="py-1">
                                        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2.5 px-4 py-2.5 text-sm font-medium hover-theme-surface" role="menuitem">
                                            <span class="material-icons text-purple-600 text-lg">dashboard</span>
                                            Dashboard
                                        </a>
                                        <a href="{{ route('admin.products.index') }}" class="flex items-center gap-2.5 px-4 py-2.5 text-sm font-medium hover-theme-surface" role="menuitem">
                                            <span class="material-icons text-purple-600 text-lg">inventory_2</span>
                                            Products
                                        </a>
                                        <a href="{{ route('admin.orders.index') }}" class="flex items-center gap-2.5 px-4 py-2.5 text-sm font-medium hover-theme-surface" role="menuitem">
                                            <span class="material-icons text-purple-600 text-lg">shopping_bag</span>
                                            Orders
                                        </a>
                                        <a href="{{ route('admin.customers.index') }}" class="flex items-center gap-2.5 px-4 py-2.5 text-sm font-medium hover-theme-surface" role="menuitem">
                                            <span class="material-icons text-purple-600 text-lg">people</span>
                                            Customers
                                        </a>
                                        <hr class="theme-border my-1">
                                        <form method="POST" action="{{ route('admin.logout') }}">
                                            @csrf
                                            <button type="submit" class="flex items-center gap-2.5 w-full px-4 py-2.5 text-sm font-medium text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 text-left" role="menuitem">
                                                <span class="material-icons text-lg">logout</span>
                                                Logout
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endauth

                            @guest('admin')
                            {{-- Theme Toggle --}}
                            <button type="button" id="theme-toggle" class="theme-icon-button">
                                <span class="material-icons text-xl theme-icon-sun hidden dark:block">light_mode</span>
                                <span class="material-icons text-xl theme-icon-moon block dark:hidden">dark_mode</span>
                            </button>

                            {{-- Wishlist --}}
                            <a href="{{ route('wishlist.index') }}" class="relative theme-icon-button">
                                <span class="material-icons text-xl">favorite</span>
                                <span id="wishlist-count" class="absolute -top-1 -right-1 bg-purple-600 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">0</span>
                            </a>

                            {{-- Cart --}}
                            <a href="{{ route('cart.index') }}" class="relative theme-icon-button">
                                <span class="material-icons text-xl">shopping_cart</span>
                                <span id="cart-count" class="absolute -top-1 -right-1 bg-purple-600 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">0</span>
                            </a>
                            @endguest
                        </div>
                    </div>
                </div>
            </nav>

            {{-- Clean Category Navigation - REMOVED --}}
        </header>

        <main>
            @yield('content')
        </main>

        {{-- Scroll to Top Button --}}
        <div id="scroll-to-top" style="position: fixed; bottom: 30px; right: 30px; width: 56px; height: 56px; background: #6366f1; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.2); z-index: 99999;">
            <span class="material-icons" style="font-size: 32px;">arrow_upward</span>
        </div>

        {{-- Clean Footer --}}
        <footer class="mt-auto theme-surface border-t theme-border">
            {{-- Main Footer Content --}}
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    
                    {{-- About Section --}}
                    <div>
                        <div class="flex items-center gap-2 mb-3">
                            <div class="w-8 h-8 bg-purple-600 rounded-lg flex items-center justify-center">
                                <span class="material-icons text-white text-lg">shopping_bag</span>
                            </div>
                            <h3 class="text-lg font-bold text-purple-600 dark:text-purple-400">Nexora</h3>
                        </div>
                        <p class="text-sm theme-text-muted mb-3">
                            Your trusted online marketplace for quality products at the best prices.
                        </p>
                        <div class="flex gap-2">
                            <a href="#" class="w-8 h-8 theme-icon-button">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                            </a>
                            <a href="#" class="w-8 h-8 theme-icon-button">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                            </a>
                            <a href="#" class="w-8 h-8 theme-icon-button">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z"/></svg>
                            </a>
                        </div>
                    </div>

                    {{-- Quick Links --}}
                    <div>
                        <h4 class="text-sm font-semibold uppercase mb-3 text-purple-600 dark:text-purple-400">Quick Links</h4>
                        <ul class="space-y-2 text-sm">
                            <li><a href="{{ route('home') }}" class="theme-text-muted hover-theme-accent">Home</a></li>
                            <li><a href="{{ route('products.index') }}" class="theme-text-muted hover-theme-accent">Products</a></li>
                            <li><a href="{{ route('cart.index') }}" class="theme-text-muted hover-theme-accent">Cart</a></li>
                            <li><a href="{{ route('orders.index') }}" class="theme-text-muted hover-theme-accent">Orders</a></li>
                        </ul>
                    </div>

                    {{-- Contact Info --}}
                    <div>
                        <h4 class="text-sm font-semibold uppercase mb-3 text-purple-600 dark:text-purple-400">Contact Us</h4>
                        <ul class="space-y-2 text-sm">
                            <li class="flex items-start gap-2">
                                <span class="material-icons text-purple-600 dark:text-purple-400 text-base mt-0.5">location_on</span>
                                <span class="theme-text-muted">Ramnagar, West Bengal</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="material-icons text-purple-600 dark:text-purple-400 text-base">email</span>
                                <a href="mailto:girirupam25@gmail.com" class="theme-text-muted hover-theme-accent">girirupam25@gmail.com</a>
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="material-icons text-purple-600 dark:text-purple-400 text-base">phone</span>
                                <a href="tel:+919800278101" class="theme-text-muted hover-theme-accent">+91 9800278101</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            {{-- Footer Bottom --}}
            <div class="border-t theme-border bg-purple-600">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3">
                    <div class="flex flex-col sm:flex-row items-center justify-between gap-2 text-sm text-white">
                        <p>&copy; {{ date('Y') }} Nexora. All rights reserved.</p>
                        <div class="flex gap-4 text-xs">
                            <a href="#" class="hover:text-purple-200">Privacy</a>
                            <a href="#" class="hover:text-purple-200">Terms</a>
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
        
        /* iPhone-like Glass Effect for Header */
        header {
            -webkit-backdrop-filter: saturate(180%) blur(20px);
            backdrop-filter: saturate(180%) blur(20px);
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
        
        #admin-profile-menu:not(.hidden) {
            animation: slideDown 0.2s ease-out;
        }
        
        #categories-menu:not(.hidden) {
            animation: slideDown 0.2s ease-out;
        }
    </style>

    <script>
        $(document).ready(function() {
            const $profileButton = $('#profile-button');
            const $profileMenu = $('#profile-menu');
            const $adminProfileButton = $('#admin-profile-button');
            const $adminProfileMenu = $('#admin-profile-menu');
            const $categoriesButton = $('#categories-button');
            const $categoriesMenu = $('#categories-menu');

            // Profile dropdown toggle
            $profileButton.on('click', function(e) {
                e.stopPropagation();
                $profileMenu.toggleClass('hidden');
                $categoriesMenu.addClass('hidden');
            });

            // Admin Profile dropdown toggle
            $adminProfileButton.on('click', function(e) {
                e.stopPropagation();
                $adminProfileMenu.toggleClass('hidden');
            });

            // Categories dropdown toggle
            $categoriesButton.on('click', function(e) {
                e.stopPropagation();
                $categoriesMenu.toggleClass('hidden');
                $profileMenu.addClass('hidden');
                $adminProfileMenu.addClass('hidden');
            });

            // Close dropdown when clicking outside
            $(document).on('click', function(event) {
                if (!$profileButton.is(event.target) && $profileButton.has(event.target).length === 0 &&
                    !$profileMenu.is(event.target) && $profileMenu.has(event.target).length === 0) {
                    $profileMenu.addClass('hidden');
                }
                
                if (!$adminProfileButton.is(event.target) && $adminProfileButton.has(event.target).length === 0 &&
                    !$adminProfileMenu.is(event.target) && $adminProfileMenu.has(event.target).length === 0) {
                    $adminProfileMenu.addClass('hidden');
                }
                
                if (!$categoriesButton.is(event.target) && $categoriesButton.has(event.target).length === 0 &&
                    !$categoriesMenu.is(event.target) && $categoriesMenu.has(event.target).length === 0) {
                    $categoriesMenu.addClass('hidden');
                }
            });

            // Close dropdown on ESC key
            $(document).on('keydown', function(e) {
                if (e.key === 'Escape') {
                    $profileMenu.addClass('hidden');
                    $adminProfileMenu.addClass('hidden');
                    $categoriesMenu.addClass('hidden');
                }
            });

            // Dark Mode Toggle
            const $themeToggle = $('#theme-toggle');
            const root = document.documentElement;

            $themeToggle.on('click', function() {
                const currentTheme = root.classList.contains('dark') ? 'dark' : 'light';
                const newTheme = currentTheme === 'dark' ? 'light' : 'dark';

                if (newTheme === 'dark') {
                    root.classList.add('dark');
                } else {
                    root.classList.remove('dark');
                }

                localStorage.setItem('theme-preference', newTheme);
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
    
    <script>
        // Scroll to Top Button
        $(document).ready(function() {
            const $scrollToTop = $('#scroll-to-top');
            
            // Show/hide button on scroll
            $(window).scroll(function() {
                if ($(this).scrollTop() > 300) {
                    $scrollToTop.fadeIn(300);
                } else {
                    $scrollToTop.fadeOut(300);
                }
            });
            
            // Scroll to top on click
            $scrollToTop.on('click', function() {
                $('html, body').animate({scrollTop: 0}, 600);
            });
        });
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