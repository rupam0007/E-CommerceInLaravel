<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Nexora E-commerce')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Crimson+Text:wght@400;600&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <!-- jQuery for AJAX-based pages -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
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
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    animation: {
                        'fade-in': 'fadeIn 0.5s ease-in-out',
                        'slide-up': 'slideUp 0.5s ease-out',
                        'bounce-slow': 'bounce 2s infinite',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' }
                        },
                        slideUp: {
                            '0%': { transform: 'translateY(20px)', opacity: '0' },
                            '100%': { transform: 'translateY(0)', opacity: '1' }
                        }
                    }
                }
            }
        }
    </script>
    @yield('styles')
</head>
<body class="bg-gray-100 min-h-screen text-gray-900">
    
    {{-- Enhanced Navigation --}}
    <nav class="bg-white border-b sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center space-x-2">
                        <span class="text-2xl font-bold" style="font-family: 'Crimson Text', serif;">
                            Nexora
                        </span>
                    </a>
                    <div class="hidden md:ml-12 md:flex md:space-x-6">
                        <a href="{{ route('products.index') }}" class="text-gray-800 hover:text-black px-2 py-2 text-sm font-medium transition-colors">
                            Products
                        </a>
                        <a href="{{ route('categories.index') }}" class="text-gray-800 hover:text-black px-2 py-2 text-sm font-medium transition-colors">
                            Categories
                        </a>
                    </div>
                </div>
                
                <div class="flex items-center space-x-6">
                    @auth
                        <a href="{{ route('admin.dashboard') }}" class="text-gray-800 hover:text-black px-2 py-2 text-sm font-medium transition-colors">
                            Admin
                        </a>
                        <a href="{{ route('wishlist.index') }}" class="text-gray-700 hover:text-black relative group transition-colors duration-200">
                            <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                            <span id="wishlist-count-badge" class="absolute -top-1 -right-2 hidden min-w-[1.25rem] h-5 px-1 rounded-full bg-red-600 text-white text-xs flex items-center justify-center"></span>
                            <span class="absolute -top-8 left-1/2 transform -translate-x-1/2 bg-gray-800 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity">Wishlist</span>
                        </a>
                        <a href="{{ route('cart.index') }}" class="text-gray-700 hover:text-black relative group transition-colors duration-200">
                            <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.5 6M7 13l-1.5-6m0 0h12.5M17 21a2 2 0 100-4 2 2 0 000 4zM9 21a2 2 0 100-4 2 2 0 000 4z"></path>
                            </svg>
                            <span id="cart-count-badge" class="absolute -top-1 -right-2 hidden min-w-[1.25rem] h-5 px-1 rounded-full bg-red-600 text-white text-xs flex items-center justify-center"></span>
                            <span class="absolute -top-8 left-1/2 transform -translate-x-1/2 bg-gray-800 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity">Cart</span>
                        </a>
                        <div class="flex items-center space-x-3">
                            <span class="text-gray-800 font-medium" style="font-family: 'Inter', sans-serif;">{{ Auth::user()->name }}</span>
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="bg-gray-900 hover:bg-black text-white px-4 py-2 rounded-md text-sm font-medium transition-colors">
                                    Logout
                                </button>
                            </form>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-800 hover:text-black px-2 py-2 text-sm font-medium transition-colors">Login</a>
                        <a href="{{ route('register') }}" class="bg-gray-900 hover:bg-black text-white px-4 py-2 rounded-md text-sm font-medium transition-colors">
                            Register
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    {{-- Flash Messages --}}
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mx-4 mt-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mx-4 mt-4">
            {{ session('error') }}
        </div>
    @endif

    {{-- Main Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-gray-100 text-gray-700 mt-16">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-lg font-semibold mb-4" style="font-family: 'Crimson Text', serif;">Nexora</h3>
                    <p class="text-gray-600" style="font-family: 'Inter', sans-serif;">Your trusted e-commerce platform for quality products.</p>
                </div>
                <div>
                    <h4 class="text-md font-medium mb-4">Quick Links</h4>
                    <ul class="space-y-2 text-gray-600">
                        <li><a href="{{ route('products.index') }}" class="hover:text-gray-900">Products</a></li>
                        <li><a href="{{ route('categories.index') }}" class="hover:text-gray-900">Categories</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-md font-medium mb-4">Account</h4>
                    <ul class="space-y-2 text-gray-600">
                        @auth
                            <li><a href="{{ route('orders.index') }}" class="hover:text-gray-900">My Orders</a></li>
                            <li><a href="{{ route('cart.index') }}" class="hover:text-gray-900">Cart</a></li>
                        @else
                            <li><a href="{{ route('login') }}" class="hover:text-gray-900">Login</a></li>
                            <li><a href="{{ route('register') }}" class="hover:text-gray-900">Register</a></li>
                        @endauth
                    </ul>
                </div>
                <div>
                    <h4 class="text-md font-medium mb-4">Contact</h4>
                    <p class="text-gray-600">Email: support@nexora.com</p>
                    <p class="text-gray-600">Phone: +1 (555) 123-4567</p>
                </div>
            </div>
            <div class="border-t border-gray-300 mt-8 pt-8 text-center text-gray-600">
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
        // If badges aren't present (e.g., guest), do nothing
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
        // Initial load
        fetchCartCount();
        fetchWishlistCount();
        // Update on visibility change (when user returns to the tab)
        document.addEventListener('visibilitychange', () => { if (!document.hidden) { fetchCartCount(); fetchWishlistCount(); } });
        // Intercept add-to-cart forms to update badge without full reload
        document.addEventListener('submit', async function(e){
            const form = e.target;
            if (!(form instanceof HTMLFormElement)) return;
            const action = form.getAttribute('action') || '';
            if (!action.includes('/cart/add/')) return;
            // Use fetch to submit
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
                // Update badge from response or refetch
                if (res.ok) {
                    const data = await res.json().catch(() => ({}));
                    if (typeof data.count !== 'undefined') {
                        const count = Number(data.count || 0);
                        if (cartBadge) {
                            if (count > 0) { cartBadge.textContent = count > 99 ? '99+' : String(count); cartBadge.classList.remove('hidden'); }
                            else { cartBadge.textContent = ''; cartBadge.classList.add('hidden'); }
                        }
                    } else {
                        fetchCartCount();
                    }
                } else {
                    fetchCartCount();
                }
            } catch (err) {
                fetchCartCount();
            }
        });
        // Intercept wishlist toggle forms to update wishlist badge
        document.addEventListener('submit', async function(e){
            const form = e.target;
            if (!(form instanceof HTMLFormElement)) return;
            const action = form.getAttribute('action') || '';
            if (!action.includes('/wishlist/toggle')) return;
            // Let normal navigation happen if not authenticated or server redirects
            // But also trigger a background count refresh
            setTimeout(fetchWishlistCount, 300);
        });
        // Listen clicks on remove buttons in wishlist page to refresh badge
        document.addEventListener('click', function(e){
            const target = e.target.closest && e.target.closest('.remove-wishlist-btn');
            if (target) {
                setTimeout(fetchWishlistCount, 500);
            }
        });
    })();
    </script>
</body>
</html>

