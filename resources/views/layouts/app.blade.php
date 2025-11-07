<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Nexora E-commerce')</title>
    
    {{-- Scripts --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Crimson+Text:wght@400;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    
    {{-- AJAX Setup --}}
    <script>
        (function() {
            var tokenMeta = document.querySelector('meta[name="csrf-token"]');
            if (tokenMeta && window.jQuery) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': tokenMeta.getAttribute('content')
                    }
                });
            }
        })();
    </script>
    
    {{-- New Tailwind Config --}}
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'sans': ['Inter', 'ui-sans-serif', 'system-ui'],
                        'serif': ['Crimson Text', 'ui-serif', 'Georgia'],
                    },
                    colors: {
                        'indigo': {
                            50: '#eef2ff',
                            100: '#e0e7ff',
                            200: '#c7d2fe',
                            300: '#a5b4fc',
                            400: '#818cf8',
                            500: '#6366f1',
                            600: '#4f46e5',
                            700: '#4338ca',
                            800: '#3730a3',
                            900: '#312e81',
                            950: '#1e1b4b',
                        },
                    }
                }
            }
        }
    </script>
    @yield('styles')
</head>
<body class="bg-gray-50 font-sans text-gray-900 antialiased">
    
    {{-- New Minimalist Header --}}
    <nav class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                
                {{-- Logo & Main Nav --}}
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex-shrink-0 flex items-center">
                        <span class="text-3xl font-bold font-serif text-gray-900">
                            Nexora
                        </span>
                    </a>
                    <div class="hidden md:ml-10 md:flex md:space-x-8">
                        <a href="{{ route('products.index') }}" class="text-gray-600 hover:text-indigo-600 px-1 py-2 text-sm font-medium transition-colors">
                            Products
                        </a>
                        <a href="{{ route('categories.index') }}" class="text-gray-600 hover:text-indigo-600 px-1 py-2 text-sm font-medium transition-colors">
                            Categories
                        </a>
                    </div>
                </div>
                
                {{-- Icons & Auth --}}
                <div class="flex items-center space-x-5">
                    @auth
                        {{-- Icons --}}
                        <a href="{{ route('wishlist.index') }}" class="text-gray-500 hover:text-indigo-600 relative p-1">
                            <span class="sr-only">Wishlist</span>
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                            <span id="wishlist-count-badge" class="absolute -top-1 -right-2 hidden min-w-[1.25rem] h-5 px-1 rounded-full bg-indigo-600 text-white text-xs flex items-center justify-center"></span>
                        </a>
                        <a href="{{ route('cart.index') }}" class="text-gray-500 hover:text-indigo-600 relative p-1">
                            <span class="sr-only">Cart</span>
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.5 6M7 13l-1.5-6m0 0h12.5M17 21a2 2 0 100-4 2 2 0 000 4zM9 21a2 2 0 100-4 2 2 0 000 4z"></path>
                            </svg>
                            <span id="cart-count-badge" class="absolute -top-1 -right-2 hidden min-w-[1.25rem] h-5 px-1 rounded-full bg-indigo-600 text-white text-xs flex items-center justify-center"></span>
                        </a>

                        {{-- Profile & Logout --}}
                        <span class="w-px h-6 bg-gray-200" aria-hidden="true"></span>
                        <div class="flex items-center space-x-3">
                            <a href="{{ route('profile.show') }}" class="text-sm font-medium text-gray-600 hover:text-indigo-600">
                                {{ Auth::user()->name }}
                            </a>
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="text-sm font-medium text-gray-600 hover:text-indigo-600">
                                    Logout
                                </button>
                            </form>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-medium text-gray-600 hover:text-indigo-600">Login</a>
                        <a href="{{ route('register') }}" 
                           class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-md text-sm font-medium transition-colors shadow-sm">
                            Register
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    {{-- Flash Messages --}}
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded mx-auto max-w-7xl mt-6">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-800 px-4 py-3 rounded mx-auto max-w-7xl mt-6">
            {{ session('error') }}
        </div>
    @endif

    {{-- Main Content --}}
    <main>
        @yield('content')
    </main>

    {{-- New Minimalist Footer --}}
    <footer class="bg-white border-t border-gray-200 mt-16">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-xl font-serif font-semibold mb-4">Nexora</h3>
                    <p class="text-gray-500 text-sm">
                        Premium e-commerce for quality products.
                    </p>
                </div>
                <div>
                    <h4 class="text-sm font-semibold text-gray-900 tracking-wider uppercase mb-4">Shop</h4>
                    <ul class="space-y-3 text-sm">
                        <li><a href="{{ route('products.index') }}" class="text-gray-500 hover:text-gray-900">Products</a></li>
                        <li><a href="{{ route('categories.index') }}" class="text-gray-500 hover:text-gray-900">Categories</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-sm font-semibold text-gray-900 tracking-wider uppercase mb-4">Account</h4>
                    <ul class="space-y-3 text-sm">
                        @auth
                            <li><a href="{{ route('profile.show') }}" class="text-gray-500 hover:text-gray-900">My Profile</a></li>
                            <li><a href="{{ route('orders.index') }}" class="text-gray-500 hover:text-gray-900">My Orders</a></li>
                            <li><a href="{{ route('cart.index') }}" class="text-gray-500 hover:text-gray-900">Cart</a></li>
                        @else
                            <li><a href="{{ route('login') }}" class="text-gray-500 hover:text-gray-900">Login</a></li>
                            <li><a href="{{ route('register') }}" class="text-gray-500 hover:text-gray-900">Register</a></li>
                        @endauth
                    </ul>
                </div>
                <div>
                    <h4 class="text-sm font-semibold text-gray-900 tracking-wider uppercase mb-4">Contact</h4>
                    <ul class="space-y-3 text-sm">
                        <li><span class="text-gray-500">support@nexora.com</span></li>
                        <li><span class="text-gray-500">+1 (555) 123-4567</span></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-200 mt-8 pt-8 text-sm text-gray-500 text-center">
                <p>&copy; 2025 Nexora. All rights reserved.</p>
            </div>
        </div>
    </footer>

    @yield('scripts')
    @stack('scripts')
    <script>
    (function(){
        const cartBadge = document.getElementById('cart-count-badge');
        const wishlistBadge = document.getElementById('wishlist-count-badge');
        if (!cartBadge && !wishlistBadge) return;
        const cartCountUrl = "{{ route('cart.count') }}";
        const wishlistCountUrl = "{{ route('wishlist.count') }}";
        async function fetchCartCount() {
            try {
                if (!cartBadge) return;
                const res = await fetch(cartCountUrl, { headers: { 'Accept': 'application/json' }, credentials: 'same-origin' });
                if (!res.ok) return;
                const data = await res.json();
                const count = Number(data.count || 0);
                if (count > 0) {
                    cartBadge.textContent = count > 99 ? '99+' : String(count);
                    cartBadge.classList.remove('hidden');
                } else {
                    cartBadge.textContent = '';
                    cartBadge.classList.add('hidden');
                }
            } catch (e) { /* ignore */ }
        }
        async function fetchWishlistCount() {
            try {
                if (!wishlistBadge) return;
                const res = await fetch(wishlistCountUrl, { headers: { 'Accept': 'application/json' }, credentials: 'same-origin' });
                if (!res.ok) return;
                const data = await res.json();
                const count = Number(data.count || 0);
                if (count > 0) {
                    wishlistBadge.textContent = count > 99 ? '99+' : String(count);
                    wishlistBadge.classList.remove('hidden');
                } else {
                    wishlistBadge.textContent = '';
                    wishlistBadge.classList.add('hidden');
                }
            } catch (e) { /* ignore */ }
        }
        fetchCartCount();
        fetchWishlistCount();
        document.addEventListener('visibilitychange', () => { if (!document.hidden) { fetchCartCount(); fetchWishlistCount(); } });
        
        // Listen for custom events to update cart
        document.addEventListener('cartUpdated', fetchCartCount);
        document.addEventListener('wishlistUpdated', fetchWishlistCount);

        // Intercept forms
        document.addEventListener('submit', async function(e){
            const form = e.target;
            if (!(form instanceof HTMLFormElement)) return;
            const action = form.getAttribute('action') || '';
            
            if (action.includes('/cart/add/')) {
                e.preventDefault();
                try {
                    const formData = new FormData(form);
                    const res = await fetch(action, {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        },
                        body: formData,
                        credentials: 'same-origin'
                    });
                    const data = await res.json().catch(() => ({}));
                    if (res.ok) {
                        fetchCartCount(); // Update badge
                    } else {
                        alert(data.message || 'Could not add to cart.');
                    }
                } catch (err) {
                    alert('Network error. Please try again.');
                }
            } else if (action.includes('/wishlist/toggle')) {
                // Let wishlist toggle normally but update count
                setTimeout(fetchWishlistCount, 500);
            }
        });
    })();
    </script>
</body>
</html>