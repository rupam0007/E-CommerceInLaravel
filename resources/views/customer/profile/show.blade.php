@extends('layouts.app')

@section('title', 'My Profile - Nexora')

@section('content')
<div class="theme-bg min-h-screen py-12 transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            
            {{-- LEFT SIDEBAR: Profile Identity --}}
            <div class="lg:col-span-4 space-y-6">
                
                {{-- Profile Card --}}
                <div class="theme-surface rounded-2xl shadow-xl border theme-border overflow-hidden transition-all duration-300 hover:shadow-2xl">
                    {{-- Cover Background --}}
                    <div class="h-32 bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 relative overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-b from-transparent to-black/30"></div>
                        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiNmZmZmZmYiIGZpbGwtb3BhY2l0eT0iMC4xIj48cGF0aCBkPSJNMzYgMzRjMC0yLjIxLTEuNzktNC00LTRzLTQgMS43OS00IDQgMS43OSA0IDQgNCA0LTEuNzkgNC00em0wLTEwYzAtMi4yMS0xLjc5LTQtNC00cy00IDEuNzktNCA0IDEuNzkgNCA0IDQgNC0xLjc5IDQtNHoiLz48L2c+PC9nPjwvc3ZnPg==')] opacity-20"></div>
                    </div>
                    
                    <div class="px-6 pb-8 text-center relative">
                        
                        {{-- Profile Image Container --}}
                        <div class="relative -mt-20 mb-4 flex justify-center">
                            <div class="relative group">
                                <div class="h-40 w-40 rounded-full border-4 border-white/20 theme-surface overflow-hidden shadow-2xl flex items-center justify-center shrink-0 ring-4 ring-blue-500/30">
                                    @php $media = $user->profile_media; @endphp

                                    @if($media['type'] == 'video')
                                        <video src="{{ $media['url'] }}" autoplay loop muted playsinline class="w-full h-full object-cover rounded-full"></video>
                                    @elseif($media['type'] == 'image')
                                        <img src="{{ $media['url'] }}" alt="{{ $user->name }}" class="w-full h-full object-cover rounded-full">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-blue-500 via-indigo-500 to-purple-600">
                                            <span class="text-5xl font-bold text-white select-none">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                                        </div>
                                    @endif
                                </div>

                                {{-- Camera Icon for Upload --}}
                                <button onclick="document.getElementById('avatar-upload').click()" 
                                    type="button"
                                    class="absolute bottom-2 right-2 bg-gradient-to-r from-blue-600 to-indigo-600 text-white p-2.5 rounded-full shadow-lg hover:scale-110 transition-all duration-300 cursor-pointer border-4 border-white/30 z-20 flex items-center justify-center"
                                    title="Change Profile Photo/Video">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        {{-- Hidden Upload Form --}}
                        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" id="avatar-form" class="hidden">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="name" value="{{ $user->name }}">
                            <input type="hidden" name="email" value="{{ $user->email }}">
                            <input type="file" name="avatar" id="avatar-upload" accept="image/*,video/mp4,video/webm" onchange="document.getElementById('avatar-form').submit()">
                        </form>

                        <h2 class="text-2xl font-bold theme-text">{{ $user->name }}</h2>
                        <p class="theme-text-muted text-sm mt-1">{{ $user->email }}</p>
                        @if($user->bio)
                        <p class="theme-text-muted text-sm mt-3 leading-relaxed">{{ $user->bio }}</p>
                        @endif
                        
                        <div class="mt-6 flex justify-center gap-6 border-t theme-border pt-6">
                            <div class="text-center">
                                <span class="block text-2xl font-bold theme-text">{{ $user->orders()->count() }}</span>
                                <span class="text-xs theme-text-muted uppercase tracking-wide">Orders</span>
                            </div>
                            <div class="text-center">
                                <span class="block text-2xl font-bold theme-text">{{ \App\Models\Wishlist::where('user_id', $user->id)->count() }}</span>
                                <span class="text-xs theme-text-muted uppercase tracking-wide">Wishlist</span>
                            </div>
                        </div>

                        <div class="mt-8">
                            <button type="button" onclick="toggleModal('edit-profile-modal')" class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white py-3 rounded-xl font-medium transition-all duration-300 shadow-lg hover:shadow-xl hover:scale-105 flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                Edit Profile
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Address Card --}}
                <div class="theme-surface rounded-2xl shadow-xl border theme-border p-6 transition-all duration-300 hover:shadow-2xl">
                    <h3 class="text-lg font-bold theme-text mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        Shipping Address
                    </h3>
                    @if($user->address)
                        <p class="theme-text text-sm leading-relaxed">
                            {{ $user->address }}<br>
                            {{ $user->city }}, {{ $user->state }} {{ $user->postal_code }}<br>
                            {{ $user->country }}
                        </p>
                        <div class="mt-4 pt-4 border-t theme-border">
                            <p class="text-sm theme-text-muted"><span class="theme-text font-medium">Phone:</span> {{ $user->phone }}</p>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <p class="theme-text-muted text-sm italic mb-3">No address details provided.</p>
                            {{-- FIXED: Added type="button" and ensured onclick works --}}
                            <button type="button" onclick="toggleModal('edit-profile-modal')" class="theme-accent hover:opacity-80 text-sm font-medium focus:outline-none transition-opacity">
                                Add Address
                            </button>
                        </div>
                    @endif
                </div>
            </div>

            {{-- RIGHT CONTENT: Tabbed Layout --}}
            <div class="lg:col-span-8 space-y-6">
                {{-- Tabs --}}
                <div class="flex items-center gap-2 overflow-x-auto scrollbar-thin">
                    <button type="button" data-tab="overview" class="tab-btn active px-4 py-2 rounded-lg text-sm font-medium theme-text bg-blue-600/10 text-blue-600 border border-blue-600/20 hover:bg-blue-600/20 transition">Overview</button>
                    <button type="button" data-tab="orders" class="tab-btn px-4 py-2 rounded-lg text-sm font-medium theme-text theme-surface border theme-border hover-theme-surface transition">Orders</button>
                    <button type="button" data-tab="security" class="tab-btn px-4 py-2 rounded-lg text-sm font-medium theme-text theme-surface border theme-border hover-theme-surface transition">Security</button>
                </div>

                {{-- Panels --}}
                <div id="tab-overview" class="tab-panel space-y-6">
                    {{-- Quick Summary --}}
                    <div class="theme-surface rounded-2xl shadow-xl border theme-border p-6 grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <h4 class="text-sm theme-text-muted font-semibold uppercase mb-2">Account</h4>
                            <p class="theme-text font-medium">{{ $user->name }}</p>
                            <p class="theme-text-muted text-sm">{{ $user->email }}</p>
                        </div>
                        <div>
                            <h4 class="text-sm theme-text-muted font-semibold uppercase mb-2">Contact</h4>
                            <p class="theme-text text-sm">{{ $user->phone ?: 'Not provided' }}</p>
                            <p class="theme-text-muted text-sm">{{ $user->city ? ($user->city . ', ' . $user->state) : 'No location set' }}</p>
                        </div>
                        <div class="flex items-center gap-8">
                            <div>
                                <p class="text-2xl font-bold theme-text">{{ $user->orders()->count() }}</p>
                                <p class="text-xs theme-text-muted uppercase tracking-wide">Orders</p>
                            </div>
                            <div>
                                <p class="text-2xl font-bold theme-text">{{ \App\Models\Wishlist::where('user_id', $user->id)->count() }}</p>
                                <p class="text-xs theme-text-muted uppercase tracking-wide">Wishlist</p>
                            </div>
                        </div>
                    </div>
                    @if($user->bio)
                    <div class="theme-surface rounded-2xl shadow-xl border theme-border p-6">
                        <h4 class="text-sm theme-text-muted font-semibold uppercase mb-2">Bio</h4>
                        <p class="theme-text leading-relaxed">{{ $user->bio }}</p>
                    </div>
                    @endif
                </div>

                <div id="tab-orders" class="tab-panel hidden">
                    <div class="theme-surface rounded-2xl shadow-xl border theme-border overflow-hidden transition-all duration-300">
                        <div class="p-6 border-b theme-border flex justify-between items-center">
                            <h3 class="text-xl font-bold theme-text">Recent Orders</h3>
                            <a href="{{ route('orders.index') }}" class="text-sm theme-accent hover:opacity-80 font-medium transition-opacity">View all history</a>
                        </div>
                        @php $recentOrders = $user->orders()->latest()->take(5)->get(); @endphp
                        @if($recentOrders->count() > 0)
                            <div class="divide-y theme-border">
                                @foreach($recentOrders as $order)
                                    <div class="p-6 hover-theme-surface transition-colors flex flex-col sm:flex-row justify-between items-center gap-4">
                                        <div class="flex items-center gap-4 w-full sm:w-auto">
                                            <div class="h-12 w-12 rounded-lg theme-bg flex items-center justify-center theme-accent">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                                            </div>
                                            <div>
                                                <p class="theme-text font-medium">Order #{{ $order->id }}</p>
                                                <p class="text-xs theme-text-muted">{{ $order->created_at->format('M d, Y') }} &bull; {{ $order->orderItems->count() }} Items</p>
                                            </div>
                                        </div>
                                        <div class="flex items-center gap-6 w-full sm:w-auto justify-between sm:justify-end">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium border
                                                {{ strtolower($order->status) == 'completed' ? 'bg-green-900/30 text-green-400 border-green-800' : 
                                                   (strtolower($order->status) == 'pending' ? 'bg-yellow-900/30 text-yellow-400 border-yellow-800' : 'bg-blue-900/30 text-blue-400 border-blue-800') }}">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                            <div class="text-right">
                                                <p class="theme-text font-bold">₹{{ number_format($order->total_amount, 2) }}</p>
                                            </div>
                                            <a href="{{ route('orders.show', $order) }}" class="p-2 theme-text-muted hover-theme-accent hover-theme-surface rounded-full transition-colors">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="p-12 text-center">
                                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full theme-bg mb-4 theme-text-muted">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                </div>
                                <h3 class="theme-text font-medium">No orders yet</h3>
                                <p class="theme-text-muted text-sm mt-1 mb-6">Start exploring our collection.</p>
                                <a href="{{ route('products.index') }}" class="inline-flex items-center px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-full transition-colors">Browse Products</a>
                            </div>
                        @endif
                    </div>
                </div>

                <div id="tab-security" class="tab-panel hidden">
                    <div class="theme-surface rounded-2xl shadow-xl border theme-border p-6 transition-all duration-300">
                        <h3 class="text-xl font-bold theme-text mb-6">Security Settings</h3>
                        <form action="{{ route('profile.password.update') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @csrf
                            @method('PATCH')
                            <div class="md:col-span-2">
                                <label class="block text-xs theme-text-muted uppercase font-bold mb-2">Current Password</label>
                                <div class="relative">
                                    <input type="password" id="current_password" name="current_password" class="w-full theme-bg border theme-border rounded-lg theme-text px-4 py-2.5 pr-12 focus:ring-indigo-500 focus:border-indigo-500">
                                    <button type="button" onclick="togglePassword('current_password')" class="absolute right-3 top-1/2 -translate-y-1/2 theme-text-muted hover:theme-text transition-colors focus:outline-none">
                                        <svg id="current_password-eye-open" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        <svg id="current_password-eye-closed" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div>
                                <label class="block text-xs theme-text-muted uppercase font-bold mb-2">New Password</label>
                                <div class="relative">
                                    <input type="password" id="new_password" name="password" class="w-full theme-bg border theme-border rounded-lg theme-text px-4 py-2.5 pr-12 focus:ring-indigo-500 focus:border-indigo-500">
                                    <button type="button" onclick="togglePassword('new_password')" class="absolute right-3 top-1/2 -translate-y-1/2 theme-text-muted hover:theme-text transition-colors focus:outline-none">
                                        <svg id="new_password-eye-open" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        <svg id="new_password-eye-closed" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div>
                                <label class="block text-xs theme-text-muted uppercase font-bold mb-2">Confirm Password</label>
                                <div class="relative">
                                    <input type="password" id="confirm_password" name="password_confirmation" class="w-full theme-bg border theme-border rounded-lg theme-text px-4 py-2.5 pr-12 focus:ring-indigo-500 focus:border-indigo-500">
                                    <button type="button" onclick="togglePassword('confirm_password')" class="absolute right-3 top-1/2 -translate-y-1/2 theme-text-muted hover:theme-text transition-colors focus:outline-none">
                                        <svg id="confirm_password-eye-open" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        <svg id="confirm_password-eye-closed" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="md:col-span-2 flex justify-end">
                                <button type="submit" class="bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white px-6 py-2.5 rounded-lg font-medium transition-all duration-300 shadow-lg hover:shadow-xl">Update Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Edit Profile Modal --}}
<div id="edit-profile-modal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        {{-- Backdrop --}}
        <div class="fixed inset-0 bg-black bg-opacity-80 backdrop-blur-sm transition-opacity" aria-hidden="true" onclick="toggleModal('edit-profile-modal')"></div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <div class="inline-block align-bottom theme-surface rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl w-full border theme-border">
            <div class="theme-surface px-6 pt-6 pb-4">
                <div class="flex justify-between items-center mb-5">
                    <h3 class="text-xl font-bold theme-text">Edit Profile</h3>
                    <button type="button" onclick="toggleModal('edit-profile-modal')" class="theme-text-muted hover-theme-text focus:outline-none transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
                
                <form action="{{ route('profile.update') }}" method="POST" id="edit-profile-form">
                    @csrf
                    @method('PATCH')
                    <div class="space-y-4">
                        {{-- Personal Info --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs theme-text-muted uppercase font-bold mb-1">Full Name</label>
                                <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full theme-bg border theme-border rounded-lg theme-text px-4 py-2.5 focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                            <div>
                                <label class="block text-xs theme-text-muted uppercase font-bold mb-1">Email</label>
                                <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full theme-bg border theme-border rounded-lg theme-text px-4 py-2.5 focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs theme-text-muted uppercase font-bold mb-1">Bio</label>
                            <textarea name="bio" rows="3" class="w-full theme-bg border theme-border rounded-lg theme-text px-4 py-2.5 focus:ring-indigo-500 focus:border-indigo-500" placeholder="Tell something about yourself...">{{ old('bio', $user->bio) }}</textarea>
                            <p class="text-xs theme-text-muted mt-1">Max 500 characters.</p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs theme-text-muted uppercase font-bold mb-1">Phone</label>
                                <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="w-full theme-bg border theme-border rounded-lg theme-text px-4 py-2.5 focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                            <div>
                                <label class="block text-xs theme-text-muted uppercase font-bold mb-1">Date of Birth</label>
                                <input type="date" name="date_of_birth" value="{{ old('date_of_birth', $user->date_of_birth?->format('Y-m-d')) }}" class="w-full theme-bg border theme-border rounded-lg theme-text px-4 py-2.5 focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs theme-text-muted uppercase font-bold mb-1">Gender</label>
                            <select name="gender" class="w-full theme-bg border theme-border rounded-lg theme-text px-4 py-2.5 focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="">Select Gender</option>
                                <option value="male" {{ old('gender', $user->gender) == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ old('gender', $user->gender) == 'female' ? 'selected' : '' }}>Female</option>
                                <option value="other" {{ old('gender', $user->gender) == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>

                        <hr class="theme-border my-4">
                        
                        {{-- Address Info --}}
                        <h4 class="text-sm font-bold theme-accent uppercase">Shipping Address</h4>

                        <div>
                            <label class="block text-xs theme-text-muted uppercase font-bold mb-1">Address</label>
                            <textarea name="address" rows="2" class="w-full theme-bg border theme-border rounded-lg theme-text px-4 py-2.5 focus:ring-indigo-500 focus:border-indigo-500">{{ old('address', $user->address) }}</textarea>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs theme-text-muted uppercase font-bold mb-1">City</label>
                                <input type="text" name="city" value="{{ old('city', $user->city) }}" class="w-full theme-bg border theme-border rounded-lg theme-text px-4 py-2.5 focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                            <div>
                                <label class="block text-xs theme-text-muted uppercase font-bold mb-1">State</label>
                                <input type="text" name="state" value="{{ old('state', $user->state) }}" class="w-full theme-bg border theme-border rounded-lg theme-text px-4 py-2.5 focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs theme-text-muted uppercase font-bold mb-1">Postal Code</label>
                                <input type="text" name="postal_code" value="{{ old('postal_code', $user->postal_code) }}" class="w-full theme-bg border theme-border rounded-lg theme-text px-4 py-2.5 focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                            <div>
                                <label class="block text-xs theme-text-muted uppercase font-bold mb-1">Country</label>
                                <input type="text" name="country" value="{{ old('country', $user->country) }}" class="w-full theme-bg border theme-border rounded-lg theme-text px-4 py-2.5 focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="theme-bg px-6 py-4 flex justify-end gap-3 border-t theme-border">
                <button type="button" onclick="toggleModal('edit-profile-modal')" class="px-4 py-2 bg-transparent border theme-border theme-text-muted rounded-lg hover-theme-surface transition-colors">
                    Cancel
                </button>
                <button type="button" onclick="document.getElementById('edit-profile-form').submit()" class="px-6 py-2 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white rounded-lg transition-all duration-300 shadow-lg hover:shadow-xl">
                    Save Changes
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    // Defined globally to ensure it works even if deferred
    window.toggleModal = function(modalID){
        document.getElementById(modalID).classList.toggle("hidden");
    }

    // Tabs logic (robust with delegation)
    document.addEventListener('DOMContentLoaded', function () {
        const panels = {
            overview: document.getElementById('tab-overview'),
            orders: document.getElementById('tab-orders'),
            security: document.getElementById('tab-security')
        };

        function setActive(tab) {
            const keys = Object.keys(panels);
            keys.forEach(key => {
                const el = panels[key];
                if (!el) return;
                if (key === tab) el.classList.remove('hidden'); else el.classList.add('hidden');
            });

            document.querySelectorAll('.tab-btn').forEach(b => {
                const isActive = b.dataset.tab === tab;
                b.classList.toggle('active', isActive);
                if (isActive) {
                    b.classList.add('bg-blue-600/10','text-blue-600','border','border-blue-600/20');
                    b.classList.remove('theme-surface');
                } else {
                    b.classList.remove('bg-blue-600/10','text-blue-600','border-blue-600/20');
                    b.classList.add('theme-surface');
                }
            });
        }

        document.addEventListener('click', function (e) {
            const btn = e.target.closest('.tab-btn');
            if (!btn) return;
            const tab = btn.dataset.tab;
            if (!tab) return;
            setActive(tab);
        });

        const initial = (location.hash && location.hash.substring(1)) || 'overview';
        setActive(['overview','orders','security'].includes(initial) ? initial : 'overview');
    });

    // Password visibility toggle
    function togglePassword(inputId) {
        const input = document.getElementById(inputId);
        const eyeOpen = document.getElementById(inputId + '-eye-open');
        const eyeClosed = document.getElementById(inputId + '-eye-closed');
        
        if (input.type === 'password') {
            input.type = 'text';
            eyeOpen.classList.remove('hidden');
            eyeClosed.classList.add('hidden');
        } else {
            input.type = 'password';
            eyeOpen.classList.add('hidden');
            eyeClosed.classList.remove('hidden');
        }
    }
</script>
@endsection