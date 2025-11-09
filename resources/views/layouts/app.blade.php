<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-m">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Nexora - Your E-Commerce Destination')</title>


    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700;900&family=Work+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">


    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>


    @vite(['resources/css/app.css', 'resources/js/app.js'])


    <script>
        $(document).ready(function() {
            function updateCartCount() {
                $.ajax({
                    url: '{{ route("cart.count") }}',
                    type: 'GET',
                    success: function(response) {
                        $('#cart-count').text(response.count);
                    }
                });
            }

            function updateWishlistCount() {
                $.ajax({
                    url: '{{ route("wishlist.count") }}',
                    type: 'GET',
                    success: function(response) {
                        $('#wishlist-count').text(response.count);
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

<body class="font-sans antialiased bg-gray-100">
    <div class="min-h-screen bg-gray-100">

        <header class="bg-white shadow-sm sticky top-0 z-50">
            <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">

                    <div class="flex-shrink-0 flex items-center">
                        <a href="{{ route('home') }}" class="font-serif text-3xl font-bold text-indigo-600">
                            Nexora
                        </a>
                    </div>


                    <div class="hidden sm:ml-6 sm:flex sm:items-center space-x-8">
                        <a href="{{ route('home') }}" class="text-sm font-medium text-gray-700 hover:text-indigo-600 transition-colors {{ request()->routeIs('home') ? 'text-indigo-600' : '' }}">
                            Home
                        </a>
                        <a href="{{ route('products.index') }}" class="text-sm font-medium text-gray-700 hover:text-indigo-600 transition-colors {{ request()->routeIs('products.index') ? 'text-indigo-600' : '' }}">
                            Shop
                        </a>
                        <a href="{{ route('categories.index') }}" class="text-sm font-medium text-gray-700 hover:text-indigo-600 transition-colors {{ request()->routeIs('categories.index') ? 'text-indigo-600' : '' }}">
                            Categories
                        </a>

                    </div>


                    <div class="flex items-center space-x-4">

                        <a href="{{ route('wishlist.index') }}" class="relative text-gray-500 hover:text-indigo-600 transition-colors">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 016.364 0L12 7.636l1.318-1.318a4.5 4.5 0 016.364 6.364L12 20.364l-7.682-7.682a4.5 4.5 0 010-6.364z"></path>
                            </svg>
                            <span id="wishlist-count" class="absolute -top-2 -right-2 bg-indigo-600 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">0</span>
                        </a>


                        <a href="{{ route('cart.index') }}" class="relative text-gray-500 hover:text-indigo-600 transition-colors">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            <span id="cart-count" class="absolute -top-2 -right-2 bg-indigo-600 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">0</span>
                        </a>


                        @guest
                        @if (Route::has('login'))
                        <a href="{{ route('login') }}"
                            class="text-sm font-medium text-gray-700 hover:text-indigo-600 transition-colors">
                            Login
                        </a>
                        @endif

                        <!-- @if (Route::has('admin.login'))
                        <a href="{{ route('admin.login') }}"
                            class="ml-4 text-sm font-medium text-gray-700 hover:text-indigo-600 transition-colors">
                            Admin Login
                        </a>
                        @endif -->

                        @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="ml-4 text-sm font-medium text-white bg-indigo-600 px-4 py-2 rounded-md hover:bg-indigo-700 transition-colors shadow-sm">
                            Register
                        </a>
                        @endif
                        @else

                        <div class="relative ml-3">
                            <button type="button" class="flex text-sm rounded-full focus:outline-none" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                <span class="sr-only">Open user menu</span>

                                <span class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-indigo-600">
                                    <span class="text-sm font-medium leading-none text-white">{{ Auth::user()->name[0] }}</span>
                                </span>
                            </button>

                            <div id="user-menu" class="hidden origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                                <div class="px-4 py-2 text-sm text-gray-700">
                                    <div>{{ Auth::user()->name }}</div>
                                    <div class="font-medium truncate">{{ Auth::user()->email }}</div>
                                </div>
                                <hr>
                                <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1">My Profile</a>
                                <a href="{{ route('orders.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1">My Orders</a>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type-="submit" class="w-full text-left block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1">
                                        Log Out
                                    </button>
                                </form>
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


        <footer class="bg-gray-900 text-white mt-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">

                    <div>
                        <h3 class="font-serif text-2xl font-bold text-white mb-4">Nexora</h3>
                        <p class="text-gray-400 text-sm">
                            Your one-stop shop for electronics, fashion, and more.
                        </p>
                    </div>

                    <div>
                        <h4 class="text-lg font-semibold text-gray-200 mb-4">Quick Links</h4>
                        <ul class="space-y-2 text-sm">
                            <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-white">Home</a></li>
                            <li><a href="{{ route('products.index') }}" class="text-gray-400 hover:text-white">Shop</a></li>
                            <li><a href="{{ route('cart.index') }}" class="text-gray-400 hover:text-white">Cart</a></li>
                            <li><a href="{{ route('profile.show') }}" class="text-gray-400 hover:text-white">My Account</a></li>
                        </ul>
                    </div>

                    <div>
                        <h4 class="text-lg font-semibold text-gray-200 mb-4">Categories</h4>
                        <ul class="space-y-2 text-sm">

                            @php
                            $footerCategories = \App\Models\Category::take(4)->get();
                            @endphp
                            @foreach($footerCategories as $category)
                            <li><a href="{{ route('products.category', $category) }}" class="text-gray-400 hover:text-white">{{ $category->name }}</a></li>
                            @endforeach
                            <li><a href="{{ route('categories.index') }}" class="text-gray-400 hover:text-white">All Categories</a></li>
                        </ul>
                    </div>

                    <div>
                        <h4 class="text-lg font-semibold text-gray-200 mb-4">Contact Us</h4>
                        <p class="text-gray-400 text-sm">
                            123 E-Commerce St.<br>
                            Kolkata, WB 700001<br>
                            Email: support@nexora.com
                        </p>
                    </div>
                </div>
                <hr class="border-gray-700 my-8">
                <div class="text-center text-gray-500 text-sm">
                    &copy; {{ date('Y') }} Nexora. All rights reserved.
                </div>
            </div>
        </footer>
    </div>


    <script>
        $(document).ready(function() {
            const $userMenuButton = $('#user-menu-button');
            const $userMenu = $('#user-menu');

            $userMenuButton.on('click', function() {
                $userMenu.toggleClass('hidden');
                let isExpanded = $userMenu.attr('aria-expanded') === 'true';
                $userMenu.attr('aria-expanded', !isExpanded);
            });


            $(document).on('click', function(event) {
                if (!$userMenuButton.is(event.target) && $userMenuButton.has(event.target).length === 0 &&
                    !$userMenu.is(event.target) && $userMenu.has(event.target).length === 0) {
                    $userMenu.addClass('hidden');
                    $userMenu.attr('aria-expanded', 'false');
                }
            });
        });
    </script>

    @stack('scripts')
</body>

</html>