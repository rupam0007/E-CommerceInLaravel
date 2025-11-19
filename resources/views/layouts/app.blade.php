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

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700;900&family=Work+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

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

        <header class="sticky top-0 z-50 bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-800 shadow-sm">
            <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">

                    {{-- Logo --}}
                    <div class="flex-shrink-0">
                        <a href="{{ route('home') }}" class="flex items-center">
                            <svg class="w-8 h-8 text-teal-600" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M3 3h18v18H3V3zm16 16V5H5v14h14zM7 7h10v2H7V7zm0 4h10v2H7v-2zm0 4h7v2H7v-2z"/>
                            </svg>
                            <span class="ml-2 text-2xl font-bold text-gray-900 dark:text-white">Nexora</span>
                        </a>
                    </div>

                    {{-- Navigation Links --}}
                    <div class="hidden md:flex items-center space-x-8">
                        <a href="{{ route('home') }}" class="text-sm font-medium {{ request()->routeIs('home') ? 'text-teal-600 dark:text-teal-400' : 'text-gray-700 dark:text-gray-300 hover:text-teal-600 dark:hover:text-teal-400' }} transition-colors">
                            Home
                        </a>
                        <a href="{{ route('products.index') }}" class="text-sm font-medium {{ request()->routeIs('products.index') ? 'text-teal-600 dark:text-teal-400' : 'text-gray-700 dark:text-gray-300 hover:text-teal-600 dark:hover:text-teal-400' }} transition-colors">
                            Shop
                        </a>
                        <a href="{{ route('categories.index') }}" class="text-sm font-medium {{ request()->routeIs('categories.index') ? 'text-teal-600 dark:text-teal-400' : 'text-gray-700 dark:text-gray-300 hover:text-teal-600 dark:hover:text-teal-400' }} transition-colors">
                            Categories
                        </a>
                    </div>

                    {{-- Right Side Icons --}}
                    <div class="flex items-center space-x-4">
                        {{-- Theme Toggle --}}
                        <button type="button" class="p-2 text-gray-700 dark:text-gray-300 hover:text-teal-600 dark:hover:text-teal-400 transition-colors" data-theme-toggle title="Toggle theme">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                            </svg>
                        </button>
                        
                        {{-- Wishlist --}}
                        <a href="{{ route('wishlist.index') }}" class="relative p-2 text-gray-700 dark:text-gray-300 hover:text-teal-600 dark:hover:text-teal-400 transition-colors">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 016.364 0L12 7.636l1.318-1.318a4.5 4.5 0 016.364 6.364L12 20.364l-7.682-7.682a4.5 4.5 0 010-6.364z"></path>
                            </svg>
                            <span id="wishlist-count" class="absolute -top-1 -right-1 bg-pink-500 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">0</span>
                        </a>

                        {{-- Cart --}}
                        <a href="{{ route('cart.index') }}" class="relative p-2 text-gray-700 dark:text-gray-300 hover:text-teal-600 dark:hover:text-teal-400 transition-colors">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            <span id="cart-count" class="absolute -top-1 -right-1 bg-teal-600 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">0</span>
                        </a>

                        @guest
                        {{-- Login/Register --}}
                        @if (Route::has('login'))
                        <a href="{{ route('login') }}" class="text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-teal-600 dark:hover:text-teal-400 transition-colors">
                            Login
                        </a>
                        @endif

                        @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="px-4 py-2 text-sm font-medium text-white bg-teal-600 hover:bg-teal-700 rounded-lg transition-colors">
                            Register
                        </a>
                        @endif
                        @else
                        {{-- User Menu --}}
                        <div class="relative">
                            <button type="button" class="flex items-center text-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 rounded-full" id="profile-button" aria-expanded="false" aria-haspopup="true">
                                @php 
                                    $user = Auth::user();
                                    $media = $user->profile_media;
                                @endphp
                                <div class="h-10 w-10 rounded-full overflow-hidden border-2 border-gray-200 dark:border-gray-700 hover:border-teal-500 transition-colors">
                                    @if($media['type'] == 'video')
                                        <video src="{{ $media['url'] }}" autoplay loop muted playsinline class="w-full h-full object-cover"></video>
                                    @elseif($media['type'] == 'image')
                                        <img src="{{ $media['url'] }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-teal-500 to-teal-600">
                                            <span class="text-sm font-semibold text-white">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                                        </div>
                                    @endif
                                </div>
                            </button>

                            {{-- Dropdown Menu --}}
                            <div id="profile-menu" class="hidden origin-top-right absolute right-0 mt-2 w-56 rounded-lg shadow-lg bg-white dark:bg-gray-800 ring-1 ring-black ring-opacity-5" role="menu">
                                <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                                    <p class="text-sm font-medium text-gray-900 dark:text-white truncate">{{ $user->name }}</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 truncate">{{ $user->email }}</p>
                                </div>
                                <div class="py-1">
                                    <a href="{{ route('profile.show') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700" role="menuitem">
                                        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                        Profile
                                    </a>
                                    <a href="{{ route('orders.index') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700" role="menuitem">
                                        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                                        My Orders
                                    </a>
                                    <a href="{{ route('wishlist.index') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700" role="menuitem">
                                        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 016.364 0L12 7.636l1.318-1.318a4.5 4.5 0 016.364 6.364L12 20.364l-7.682-7.682a4.5 4.5 0 010-6.364z"></path></svg>
                                        Wishlist
                                    </a>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="flex items-center w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700" role="menuitem">
                                            <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                            Logout
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endauth
                    </div>
                </div>
            </nav>
        </header>

        <main>
            @yield('content')
        </main>

        <footer class="mt-16 border-t theme-border theme-surface transition-colors duration-300">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 theme-surface transition-colors duration-300">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <div>
                        <h3 class="font-serif text-2xl font-bold theme-accent mb-4">Nexora</h3>
                        <p class="theme-text-muted text-sm">
                            Your one-stop shop for electronics, fashion, and more.
                        </p>
                    </div>

                    <div>
                        <h4 class="text-lg font-semibold theme-text-muted mb-4">Quick Links</h4>
                        <ul class="space-y-2 text-sm">
                            <li><a href="{{ route('home') }}" class="theme-text-muted hover-theme-accent transition-colors">Home</a></li>
                            <li><a href="{{ route('products.index') }}" class="theme-text-muted hover-theme-accent transition-colors">Shop</a></li>
                            <li><a href="{{ route('cart.index') }}" class="theme-text-muted hover-theme-accent transition-colors">Cart</a></li>
                            <li><a href="{{ route('profile.show') }}" class="theme-text-muted hover-theme-accent transition-colors">My Account</a></li>
                        </ul>
                    </div>

                    <div>
                        <h4 class="text-lg font-semibold theme-text-muted mb-4">Categories</h4>
                        <ul class="space-y-2 text-sm">
                            @php
                            $footerCategories = \App\Models\Category::take(4)->get();
                            @endphp
                            @foreach($footerCategories as $category)
                            <li><a href="{{ route('products.category', $category) }}" class="theme-text-muted hover-theme-accent transition-colors">{{ $category->name }}</a></li>
                            @endforeach
                            <li><a href="{{ route('categories.index') }}" class="theme-text-muted hover-theme-accent transition-colors">All Categories</a></li>
                        </ul>
                    </div>

                    <div>
                        <h4 class="text-lg font-semibold theme-text-muted mb-4">Contact Us</h4>
                        <p class="theme-text-muted text-sm">
                            123 E-Commerce St.<br>
                            Kolkata, WB 700001<br>
                            Email: support@nexora.com
                        </p>
                    </div>
                </div>
                <hr class="border theme-border my-8">
                <div class="text-center theme-text-muted text-sm">
                    &copy; {{ date('Y') }} Nexora. All rights reserved.
                </div>
            </div>
        </footer>
    </div>

    <style>
        /* Glass morphism effects */
        .glass-nav {
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
        }
        
        .glass-button {
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .dark .glass-button {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .glass-button-primary {
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }
        
        .glass-button-danger {
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }
        
        .glass-dropdown {
            backdrop-filter: blur(30px) saturate(180%);
            -webkit-backdrop-filter: blur(30px) saturate(180%);
            animation: slideDown 0.3s ease-out;
        }
        
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
        
        .glass-button:hover {
            background: rgba(255, 255, 255, 0.15);
        }
        
        .dark .glass-button:hover {
            background: rgba(255, 255, 255, 0.1);
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