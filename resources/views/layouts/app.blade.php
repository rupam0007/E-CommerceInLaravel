<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Nexora - Premium Shopping')</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        'sans': ['Plus Jakarta Sans', 'system-ui', 'sans-serif'],
                    },
                    colors: {
                        'primary': {
                            50: '#fef7f0',
                            100: '#fdecd8',
                            200: '#fad5b0',
                            300: '#f6b77e',
                            400: '#f18f4a',
                            500: '#ed6c28',
                            600: '#de521d',
                            700: '#b83d1a',
                            800: '#93331c',
                            900: '#782d1a',
                        },
                        'dark': {
                            50: '#f8fafc',
                            100: '#f1f5f9',
                            200: '#e2e8f0',
                            300: '#cbd5e1',
                            400: '#94a3b8',
                            500: '#64748b',
                            600: '#475569',
                            700: '#334155',
                            800: '#1e293b',
                            900: '#0f172a',
                            950: '#020617',
                        }
                    }
                }
            }
        }
    </script>
    
    <style>
        * {
            font-family: 'Plus Jakarta Sans', system-ui, sans-serif;
        }

        body {
            background-color: #fafafa;
            color: #1e293b;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }

        /* Product Card */
        .product-card {
            background: #fff;
            border-radius: 16px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid #f1f5f9;
        }

        .product-card:hover {
            box-shadow: 0 20px 40px -12px rgba(0,0,0,0.1);
            transform: translateY(-4px);
        }

        /* Discount Badge */
        .discount-badge {
            background: linear-gradient(135deg, #ed6c28 0%, #de521d 100%);
            color: white;
            font-size: 11px;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 20px;
            letter-spacing: 0.3px;
        }

        /* Theme classes */
        .theme-bg { background-color: #fafafa; }
        .theme-surface { background-color: #fff; }
        .theme-card { 
            background: #fff; 
            border-radius: 16px;
            border: 1px solid #f1f5f9;
        }
        .theme-text-muted { color: #64748b; }
        .theme-border { border-color: #e2e8f0; }

        /* Gradient Text */
        .gradient-text {
            background: linear-gradient(135deg, #ed6c28 0%, #f18f4a 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Glass Effect */
        .glass {
            background: rgba(255,255,255,0.8);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }
    </style>
</head>
<body class="min-h-screen">
    <!-- Minimal Header -->
    <header class="bg-white border-b border-gray-100 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="flex items-center justify-between h-16">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-primary-500 to-primary-600 rounded-xl flex items-center justify-center">
                        <span class="text-white font-bold text-lg">N</span>
                    </div>
                    <span class="text-xl font-bold text-dark-900 tracking-tight">Nexora</span>
                </a>

                <!-- Search Bar - Centered -->
                <div class="flex-1 max-w-xl mx-8 hidden md:block">
                    <form action="{{ route('products.search') }}" method="GET" class="relative">
                        <input type="text" name="search" placeholder="Search products..." 
                               value="{{ request('search') }}" 
                               class="w-full pl-12 pr-4 py-3 bg-gray-50 border-0 rounded-full text-sm focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:bg-white transition-all">
                        <span class="material-icons-outlined absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-xl">search</span>
                    </form>
                </div>

                <!-- Navigation -->
                <nav class="flex items-center gap-2">
                    @auth
                        <a href="{{ route('wishlist.index') }}" class="p-2.5 text-dark-500 hover:text-primary-500 hover:bg-primary-50 rounded-full transition-colors relative" title="Wishlist">
                            <span class="material-icons-outlined text-xl">favorite_border</span>
                            <span id="wishlist-badge" class="absolute -top-0.5 -right-0.5 bg-red-500 text-white text-[10px] font-bold rounded-full w-4 h-4 flex items-center justify-center hidden">0</span>
                        </a>
                        <a href="{{ route('cart.index') }}" class="p-2.5 text-dark-500 hover:text-primary-500 hover:bg-primary-50 rounded-full transition-colors relative" title="Cart">
                            <span class="material-icons-outlined text-xl">shopping_bag</span>
                            <span id="cart-badge" class="absolute -top-0.5 -right-0.5 bg-primary-500 text-white text-[10px] font-bold rounded-full w-4 h-4 flex items-center justify-center hidden">0</span>
                        </a>
                        <div class="relative group ml-2">
                            <button class="flex items-center gap-2 py-2 px-3 text-dark-700 hover:bg-gray-50 rounded-full transition-colors">
                                <div class="w-8 h-8 bg-gradient-to-br from-primary-400 to-primary-600 rounded-full flex items-center justify-center">
                                    <span class="text-white text-sm font-semibold">{{ substr(Auth::user()->name, 0, 1) }}</span>
                                </div>
                                <span class="hidden lg:inline text-sm font-medium">{{ explode(' ', Auth::user()->name)[0] }}</span>
                                <span class="material-icons-outlined text-sm text-gray-400">expand_more</span>
                            </button>
                            <div class="absolute right-0 mt-2 w-56 bg-white rounded-2xl shadow-xl border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50 overflow-hidden">
                                <div class="p-3 bg-gray-50 border-b border-gray-100">
                                    <p class="font-semibold text-dark-900">{{ Auth::user()->name }}</p>
                                    <p class="text-xs text-dark-500 truncate">{{ Auth::user()->email }}</p>
                                </div>
                                <div class="py-2">
                                    <a href="{{ route('profile.show') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-dark-600 hover:bg-gray-50 transition-colors">
                                        <span class="material-icons-outlined text-lg">person_outline</span>
                                        My Profile
                                    </a>
                                    <a href="{{ route('orders.index') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-dark-600 hover:bg-gray-50 transition-colors">
                                        <span class="material-icons-outlined text-lg">local_shipping</span>
                                        My Orders
                                    </a>
                                    <a href="{{ route('wishlist.index') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-dark-600 hover:bg-gray-50 transition-colors">
                                        <span class="material-icons-outlined text-lg">favorite_border</span>
                                        Wishlist
                                    </a>
                                </div>
                                <div class="border-t border-gray-100">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="flex items-center gap-3 w-full px-4 py-3 text-sm text-red-500 hover:bg-red-50 transition-colors">
                                            <span class="material-icons-outlined text-lg">logout</span>
                                            Sign Out
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-medium text-dark-600 hover:text-dark-900 px-4 py-2 transition-colors">
                            Sign In
                        </a>
                        <a href="{{ route('register') }}" class="text-sm font-medium text-white bg-dark-900 hover:bg-dark-800 px-5 py-2.5 rounded-full transition-colors">
                            Get Started
                        </a>
                    @endauth
                </nav>
            </div>
        </div>
        
        <!-- Mobile Search -->
        <div class="md:hidden px-4 pb-3">
            <form action="{{ route('products.search') }}" method="GET" class="relative">
                <input type="text" name="search" placeholder="Search..." 
                       value="{{ request('search') }}" 
                       class="w-full pl-10 pr-4 py-2.5 bg-gray-50 border-0 rounded-full text-sm focus:outline-none focus:ring-2 focus:ring-primary-500/20">
                <span class="material-icons-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-lg">search</span>
            </form>
        </div>
    </header>
        <div class="md:hidden px-4 pb-3">
            <form action="{{ route('products.search') }}" method="GET" class="search-bar flex items-center">
                <input type="text" name="search" placeholder="Search for products..." 
                       value="{{ request('search') }}" class="flex-1 text-sm">
                <button type="submit" class="px-3 text-primary-500">
                    <span class="material-icons text-xl">search</span>
                </button>
            </form>
        </div>
    </header>

    <!-- Minimal Category Navigation -->
    <nav class="bg-white border-b border-gray-100 hidden lg:block">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="flex items-center gap-1 h-12 text-sm overflow-x-auto scrollbar-hide">
                <a href="{{ route('products.index') }}" class="px-4 py-2 text-dark-600 hover:text-primary-500 hover:bg-primary-50 rounded-full font-medium whitespace-nowrap transition-colors">
                    All Products
                </a>
                @if(isset($navCategories) && $navCategories->count() > 0)
                    @foreach($navCategories as $category)
                        <a href="{{ route('products.index', ['category' => $category->id]) }}" 
                           class="px-4 py-2 text-dark-600 hover:text-primary-500 hover:bg-primary-50 rounded-full font-medium whitespace-nowrap transition-colors">
                            {{ $category->name }}
                        </a>
                    @endforeach
                @else
                    <a href="{{ route('products.index', ['search' => 'electronics']) }}" class="px-4 py-2 text-dark-600 hover:text-primary-500 hover:bg-primary-50 rounded-full font-medium whitespace-nowrap transition-colors">Electronics</a>
                    <a href="{{ route('products.index', ['search' => 'fashion']) }}" class="px-4 py-2 text-dark-600 hover:text-primary-500 hover:bg-primary-50 rounded-full font-medium whitespace-nowrap transition-colors">Fashion</a>
                    <a href="{{ route('products.index', ['search' => 'home']) }}" class="px-4 py-2 text-dark-600 hover:text-primary-500 hover:bg-primary-50 rounded-full font-medium whitespace-nowrap transition-colors">Home & Living</a>
                    <a href="{{ route('products.index', ['search' => 'beauty']) }}" class="px-4 py-2 text-dark-600 hover:text-primary-500 hover:bg-primary-50 rounded-full font-medium whitespace-nowrap transition-colors">Beauty</a>
                @endif
                <a href="{{ route('products.index', ['sort' => 'newest']) }}" class="ml-auto px-4 py-2 bg-primary-50 text-primary-600 rounded-full font-medium whitespace-nowrap flex items-center gap-1.5">
                    <span class="material-icons-outlined text-base">local_fire_department</span>
                    New Arrivals
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="min-h-screen">
        @yield('content')
    </main>

    <!-- Minimal Footer -->
    <footer class="bg-white border-t border-gray-100 mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 py-12">
            <div class="grid grid-cols-2 md:grid-cols-5 gap-8">
                <!-- Brand -->
                <div class="col-span-2 md:col-span-1">
                    <a href="{{ route('home') }}" class="flex items-center gap-2 mb-4">
                        <div class="w-10 h-10 bg-gradient-to-br from-primary-500 to-primary-600 rounded-xl flex items-center justify-center">
                            <span class="text-white font-bold text-lg">N</span>
                        </div>
                        <span class="text-xl font-bold text-dark-900">Nexora</span>
                    </a>
                    <p class="text-sm text-dark-500 mb-4">Premium shopping experience with curated products.</p>
                    <div class="flex gap-3">
                        <a href="#" class="w-9 h-9 bg-gray-100 rounded-full flex items-center justify-center text-dark-500 hover:bg-primary-500 hover:text-white transition-colors">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                        <a href="#" class="w-9 h-9 bg-gray-100 rounded-full flex items-center justify-center text-dark-500 hover:bg-primary-500 hover:text-white transition-colors">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073z"/></svg>
                        </a>
                        <a href="#" class="w-9 h-9 bg-gray-100 rounded-full flex items-center justify-center text-dark-500 hover:bg-primary-500 hover:text-white transition-colors">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                        </a>
                    </div>
                </div>

                <div>
                    <h4 class="text-dark-900 font-semibold mb-4">Shop</h4>
                    <ul class="space-y-2.5 text-sm">
                        <li><a href="{{ route('products.index') }}" class="text-dark-500 hover:text-primary-500 transition-colors">All Products</a></li>
                        <li><a href="{{ route('products.index', ['sort' => 'newest']) }}" class="text-dark-500 hover:text-primary-500 transition-colors">New Arrivals</a></li>
                        <li><a href="#" class="text-dark-500 hover:text-primary-500 transition-colors">Best Sellers</a></li>
                        <li><a href="#" class="text-dark-500 hover:text-primary-500 transition-colors">Sale</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-dark-900 font-semibold mb-4">Support</h4>
                    <ul class="space-y-2.5 text-sm">
                        <li><a href="#" class="text-dark-500 hover:text-primary-500 transition-colors">Help Center</a></li>
                        <li><a href="#" class="text-dark-500 hover:text-primary-500 transition-colors">Shipping Info</a></li>
                        <li><a href="#" class="text-dark-500 hover:text-primary-500 transition-colors">Returns</a></li>
                        <li><a href="#" class="text-dark-500 hover:text-primary-500 transition-colors">Track Order</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-dark-900 font-semibold mb-4">Company</h4>
                    <ul class="space-y-2.5 text-sm">
                        <li><a href="#" class="text-dark-500 hover:text-primary-500 transition-colors">About Us</a></li>
                        <li><a href="#" class="text-dark-500 hover:text-primary-500 transition-colors">Careers</a></li>
                        <li><a href="#" class="text-dark-500 hover:text-primary-500 transition-colors">Press</a></li>
                        <li><a href="#" class="text-dark-500 hover:text-primary-500 transition-colors">Blog</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-dark-900 font-semibold mb-4">Legal</h4>
                    <ul class="space-y-2.5 text-sm">
                        <li><a href="#" class="text-dark-500 hover:text-primary-500 transition-colors">Privacy Policy</a></li>
                        <li><a href="#" class="text-dark-500 hover:text-primary-500 transition-colors">Terms of Service</a></li>
                        <li><a href="#" class="text-dark-500 hover:text-primary-500 transition-colors">Cookie Policy</a></li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-100 mt-10 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-sm text-dark-500">&copy; {{ date('Y') }} Nexora. All rights reserved.</p>
                <div class="flex items-center gap-4">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5e/Visa_Inc._logo.svg/100px-Visa_Inc._logo.svg.png" alt="Visa" class="h-6 opacity-50">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2a/Mastercard-logo.svg/100px-Mastercard-logo.svg.png" alt="Mastercard" class="h-6 opacity-50">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b5/PayPal.svg/100px-PayPal.svg.png" alt="PayPal" class="h-6 opacity-50">
                </div>
            </div>
        </div>
    </footer>

    <!-- Toast Notifications -->
    <div id="toast-container" class="fixed bottom-4 right-4 z-50 space-y-2"></div>

    <script>
        // Cart badge update
        function updateCartBadge() {
            fetch('{{ route("cart.count") }}')
                .then(response => response.json())
                .then(data => {
                    const badge = document.getElementById('cart-badge');
                    if (data.count > 0) {
                        badge.textContent = data.count;
                        badge.classList.remove('hidden');
                    } else {
                        badge.classList.add('hidden');
                    }
                })
                .catch(error => console.log('Cart count error:', error));
        }

        // Wishlist badge update
        function updateWishlistBadge() {
            fetch('{{ route("wishlist.count") }}')
                .then(response => response.json())
                .then(data => {
                    const badge = document.getElementById('wishlist-badge');
                    if (badge) {
                        if (data.count > 0) {
                            badge.textContent = data.count;
                            badge.classList.remove('hidden');
                        } else {
                            badge.classList.add('hidden');
                        }
                    }
                })
                .catch(error => console.log('Wishlist count error:', error));
        }

        // Toast notification
        function showToast(message, type = 'success') {
            const container = document.getElementById('toast-container');
            const toast = document.createElement('div');
            const colors = {
                success: 'bg-emerald-500',
                error: 'bg-red-500',
                info: 'bg-dark-800',
                product: 'bg-gradient-to-r from-primary-500 to-primary-600'
            };
            const icons = {
                success: 'check_circle',
                error: 'error',
                info: 'info',
                product: 'new_releases'
            };
            toast.className = `${colors[type] || colors.info} text-white px-5 py-3 rounded-xl shadow-lg flex items-center gap-3 transform transition-all duration-300`;
            toast.innerHTML = `
                <span class="material-icons-outlined text-lg">${icons[type] || icons.info}</span>
                <span class="text-sm font-medium">${message}</span>
            `;
            container.appendChild(toast);
            setTimeout(() => {
                toast.style.opacity = '0';
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }

        // New Product Notification System
        let lastProductCheck = null;
        let notificationEnabled = true;

        function showProductNotification(product) {
            const container = document.getElementById('toast-container');
            const toast = document.createElement('div');
            toast.className = 'bg-white text-dark-900 px-4 py-3 rounded-2xl shadow-2xl border border-gray-100 transform transition-all duration-300 max-w-sm cursor-pointer hover:shadow-xl';
            toast.innerHTML = `
                <div class="flex items-center gap-3">
                    <div class="w-14 h-14 rounded-xl overflow-hidden flex-shrink-0 bg-gray-100">
                        <img src="${product.image}" alt="${product.name}" class="w-full h-full object-cover">
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-2 mb-0.5">
                            <span class="inline-flex items-center gap-1 text-xs font-semibold text-primary-500 bg-primary-50 px-2 py-0.5 rounded-full">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5 2a1 1 0 011 1v1h1a1 1 0 010 2H6v1a1 1 0 01-2 0V6H3a1 1 0 010-2h1V3a1 1 0 011-1zm0 10a1 1 0 011 1v1h1a1 1 0 110 2H6v1a1 1 0 11-2 0v-1H3a1 1 0 110-2h1v-1a1 1 0 011-1zM12 2a1 1 0 01.967.744L14.146 7.2 17.5 9.134a1 1 0 010 1.732l-3.354 1.935-1.18 4.455a1 1 0 01-1.933 0L9.854 12.8 6.5 10.866a1 1 0 010-1.732l3.354-1.935 1.18-4.455A1 1 0 0112 2z" clip-rule="evenodd"/></svg>
                                New
                            </span>
                        </div>
                        <p class="text-sm font-semibold truncate">${product.name}</p>
                        <p class="text-sm font-bold text-primary-500">$${product.price}</p>
                    </div>
                    <svg class="w-5 h-5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </div>
            `;
            toast.onclick = () => window.location.href = product.url;
            container.appendChild(toast);
            
            // Play a subtle notification sound effect using Web Audio API
            try {
                const audioCtx = new (window.AudioContext || window.webkitAudioContext)();
                const oscillator = audioCtx.createOscillator();
                const gainNode = audioCtx.createGain();
                oscillator.connect(gainNode);
                gainNode.connect(audioCtx.destination);
                oscillator.frequency.value = 800;
                oscillator.type = 'sine';
                gainNode.gain.setValueAtTime(0.1, audioCtx.currentTime);
                gainNode.gain.exponentialRampToValueAtTime(0.01, audioCtx.currentTime + 0.3);
                oscillator.start(audioCtx.currentTime);
                oscillator.stop(audioCtx.currentTime + 0.3);
            } catch(e) {}
            
            setTimeout(() => {
                toast.style.opacity = '0';
                toast.style.transform = 'translateX(100%)';
                setTimeout(() => toast.remove(), 300);
            }, 5000);
        }

        async function checkForNewProducts() {
            if (!notificationEnabled) return;
            
            try {
                const url = lastProductCheck 
                    ? `/api/new-products?since=${encodeURIComponent(lastProductCheck)}`
                    : '/api/new-products';
                
                const response = await fetch(url);
                const data = await response.json();
                
                if (data.products && data.products.length > 0) {
                    // Show notifications for new products (max 3)
                    data.products.slice(0, 3).forEach((product, index) => {
                        setTimeout(() => {
                            showProductNotification(product);
                        }, index * 1000);
                    });
                }
                
                lastProductCheck = data.latest_check;
            } catch (error) {
                console.log('New product check error:', error);
            }
        }

        // Initialize new product notifications
        function initProductNotifications() {
            // Initial check to get the current timestamp
            checkForNewProducts();
            
            // Check every 30 seconds for new products
            setInterval(checkForNewProducts, 30000);
        }

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            updateCartBadge();
            updateWishlistBadge();
            // Start checking for new products
            initProductNotifications();
        });

        // Wishlist toggle
        document.addEventListener('click', function(e) {
            if (e.target.closest('.wishlist-btn')) {
                const btn = e.target.closest('.wishlist-btn');
                const productId = btn.dataset.productId;
                
                fetch(`/wishlist/toggle/${productId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => {
                    if (response.status === 401) {
                        return response.json().then(data => {
                            showToast(data.message || 'Please login first', 'info');
                            setTimeout(() => window.location.href = data.redirect || '/login', 1000);
                            throw new Error('Unauthorized');
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        const isAdded = data.inWishlist;
                        btn.dataset.inWishlist = isAdded ? 'true' : 'false';
                        
                        const filledHeart = btn.querySelector('.heart-icon-filled');
                        const outlineHeart = btn.querySelector('.heart-icon-outline');
                        
                        if (isAdded) {
                            btn.classList.add('bg-red-500', 'text-white');
                            btn.classList.remove('bg-white/90', 'text-dark-400');
                            if (filledHeart) filledHeart.classList.remove('hidden');
                            if (outlineHeart) outlineHeart.classList.add('hidden');
                        } else {
                            btn.classList.remove('bg-red-500', 'text-white');
                            btn.classList.add('bg-white/90', 'text-dark-400');
                            if (filledHeart) filledHeart.classList.add('hidden');
                            if (outlineHeart) outlineHeart.classList.remove('hidden');
                        }
                        
                        // Update wishlist badge count
                        updateWishlistBadge();
                        
                        showToast(data.message, 'success');
                    }
                })
                .catch(error => {
                    if (error.message !== 'Unauthorized') {
                        showToast('Something went wrong', 'error');
                    }
                });
            }
        });
    </script>

    @stack('scripts')
</body>
</html>