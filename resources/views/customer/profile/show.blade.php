@extends('layouts.app')

@section('title', 'My Profile - Nexora')

@section('content')
<div class="bg-gray-900 min-h-screen py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            
            {{-- LEFT SIDEBAR: Profile Identity --}}
            <div class="lg:col-span-4 space-y-6">
                
                {{-- Profile Card --}}
                <div class="bg-gray-800 rounded-2xl shadow-lg border border-gray-700 overflow-hidden">
                    {{-- Cover Background --}}
                    <div class="h-32 bg-gradient-to-r from-indigo-600 to-purple-600"></div>
                    
                    <div class="px-6 pb-8 text-center relative">
                        
                        {{-- Profile Image Container --}}
                        <div class="relative -mt-20 mb-4 flex justify-center">
                            <div class="relative group">
                                <div class="h-40 w-40 rounded-full border-4 border-gray-900 bg-gray-800 overflow-hidden shadow-2xl flex items-center justify-center shrink-0">
                                    @php $media = $user->profile_media; @endphp

                                    @if($media['type'] == 'video')
                                        <video src="{{ $media['url'] }}" autoplay loop muted playsinline class="w-full h-full object-cover rounded-full"></video>
                                    @elseif($media['type'] == 'image')
                                        <img src="{{ $media['url'] }}" alt="{{ $user->name }}" class="w-full h-full object-cover rounded-full">
                                    @else
                                        <span class="text-5xl font-bold text-white select-none">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                                    @endif
                                </div>

                                {{-- Camera Icon for Upload --}}
                                <button onclick="document.getElementById('avatar-upload').click()" 
                                    type="button"
                                    class="absolute bottom-2 right-2 bg-indigo-600 text-white p-2.5 rounded-full shadow-lg hover:bg-indigo-500 transition-colors cursor-pointer border-4 border-gray-900 z-20 flex items-center justify-center"
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

                        <h2 class="text-2xl font-bold text-white">{{ $user->name }}</h2>
                        <p class="text-gray-400 text-sm mt-1">{{ $user->email }}</p>
                        
                        <div class="mt-6 flex justify-center gap-6 border-t border-gray-700 pt-6">
                            <div class="text-center">
                                <span class="block text-2xl font-bold text-white">{{ $user->orders()->count() }}</span>
                                <span class="text-xs text-gray-400 uppercase tracking-wide">Orders</span>
                            </div>
                            <div class="text-center">
                                <span class="block text-2xl font-bold text-white">{{ \App\Models\Wishlist::where('user_id', $user->id)->count() }}</span>
                                <span class="text-xs text-gray-400 uppercase tracking-wide">Wishlist</span>
                            </div>
                        </div>

                        <div class="mt-8">
                            <button type="button" onclick="toggleModal('edit-profile-modal')" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-2.5 rounded-lg font-medium transition-colors shadow-md flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                Edit Profile
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Address Card --}}
                <div class="bg-gray-800 rounded-2xl shadow-lg border border-gray-700 p-6">
                    <h3 class="text-lg font-bold text-white mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        Shipping Address
                    </h3>
                    @if($user->address)
                        <p class="text-gray-300 text-sm leading-relaxed">
                            {{ $user->address }}<br>
                            {{ $user->city }}, {{ $user->state }} {{ $user->postal_code }}<br>
                            {{ $user->country }}
                        </p>
                        <div class="mt-4 pt-4 border-t border-gray-700">
                            <p class="text-sm text-gray-400"><span class="text-white font-medium">Phone:</span> {{ $user->phone }}</p>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <p class="text-gray-500 text-sm italic mb-3">No address details provided.</p>
                            {{-- FIXED: Added type="button" and ensured onclick works --}}
                            <button type="button" onclick="toggleModal('edit-profile-modal')" class="text-indigo-400 hover:text-indigo-300 text-sm font-medium focus:outline-none">
                                Add Address
                            </button>
                        </div>
                    @endif
                </div>
            </div>

            {{-- RIGHT CONTENT: Orders & Security --}}
            <div class="lg:col-span-8 space-y-8">
                
                {{-- Recent Orders --}}
                <div class="bg-gray-800 rounded-2xl shadow-lg border border-gray-700 overflow-hidden">
                    <div class="p-6 border-b border-gray-700 flex justify-between items-center">
                        <h3 class="text-xl font-bold text-white">Recent Orders</h3>
                        <a href="{{ route('orders.index') }}" class="text-sm text-indigo-400 hover:text-indigo-300 font-medium hover:underline">View all history</a>
                    </div>
                    
                    @php $recentOrders = $user->orders()->latest()->take(5)->get(); @endphp

                    @if($recentOrders->count() > 0)
                        <div class="divide-y divide-gray-700">
                            @foreach($recentOrders as $order)
                                <div class="p-6 hover:bg-gray-750 transition-colors flex flex-col sm:flex-row justify-between items-center gap-4">
                                    <div class="flex items-center gap-4 w-full sm:w-auto">
                                        <div class="h-12 w-12 rounded-lg bg-gray-700 flex items-center justify-center text-indigo-400">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                                        </div>
                                        <div>
                                            <p class="text-white font-medium">Order #{{ $order->id }}</p>
                                            <p class="text-xs text-gray-400">{{ $order->created_at->format('M d, Y') }} &bull; {{ $order->orderItems->count() }} Items</p>
                                        </div>
                                    </div>
                                    
                                    <div class="flex items-center gap-6 w-full sm:w-auto justify-between sm:justify-end">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium border
                                            {{ strtolower($order->status) == 'completed' ? 'bg-green-900/30 text-green-400 border-green-800' : 
                                               (strtolower($order->status) == 'pending' ? 'bg-yellow-900/30 text-yellow-400 border-yellow-800' : 'bg-blue-900/30 text-blue-400 border-blue-800') }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                        
                                        <div class="text-right">
                                            <p class="text-white font-bold">₹{{ number_format($order->total_amount, 2) }}</p>
                                        </div>
                                        
                                        <a href="{{ route('orders.show', $order) }}" class="p-2 text-gray-400 hover:text-white hover:bg-gray-700 rounded-full transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="p-12 text-center">
                            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-700 mb-4 text-gray-500">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            </div>
                            <h3 class="text-white font-medium">No orders yet</h3>
                            <p class="text-gray-400 text-sm mt-1 mb-6">Start exploring our collection.</p>
                            <a href="{{ route('products.index') }}" class="inline-flex items-center px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-full transition-colors">
                                Browse Products
                            </a>
                        </div>
                    @endif
                </div>

                {{-- Security Settings --}}
                <div class="bg-gray-800 rounded-2xl shadow-lg border border-gray-700 p-6">
                    <h3 class="text-xl font-bold text-white mb-6">Security Settings</h3>
                    <form action="{{ route('profile.password.update') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @csrf
                        @method('PATCH')
                        <div class="md:col-span-2">
                            <label class="block text-xs text-gray-400 uppercase font-bold mb-2">Current Password</label>
                            <input type="password" name="current_password" class="w-full bg-gray-700 border-gray-600 rounded-lg text-white px-4 py-2.5 focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-400 uppercase font-bold mb-2">New Password</label>
                            <input type="password" name="password" class="w-full bg-gray-700 border-gray-600 rounded-lg text-white px-4 py-2.5 focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-400 uppercase font-bold mb-2">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="w-full bg-gray-700 border-gray-600 rounded-lg text-white px-4 py-2.5 focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                        <div class="md:col-span-2 flex justify-end">
                            <button type="submit" class="bg-gray-700 hover:bg-gray-600 text-white px-6 py-2.5 rounded-lg font-medium transition-colors border border-gray-600">
                                Update Password
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

{{-- Edit Profile Modal --}}
<div id="edit-profile-modal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        {{-- Backdrop --}}
        <div class="fixed inset-0 bg-black bg-opacity-80 transition-opacity" aria-hidden="true" onclick="toggleModal('edit-profile-modal')"></div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <div class="inline-block align-bottom bg-gray-800 rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl w-full border border-gray-700">
            <div class="bg-gray-800 px-6 pt-6 pb-4">
                <div class="flex justify-between items-center mb-5">
                    <h3 class="text-xl font-bold text-white">Edit Profile</h3>
                    <button type="button" onclick="toggleModal('edit-profile-modal')" class="text-gray-400 hover:text-white focus:outline-none">
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
                                <label class="block text-xs text-gray-400 uppercase font-bold mb-1">Full Name</label>
                                <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full bg-gray-700 border-gray-600 rounded-lg text-white px-4 py-2.5 focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                            <div>
                                <label class="block text-xs text-gray-400 uppercase font-bold mb-1">Email</label>
                                <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full bg-gray-700 border-gray-600 rounded-lg text-white px-4 py-2.5 focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs text-gray-400 uppercase font-bold mb-1">Phone</label>
                                <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="w-full bg-gray-700 border-gray-600 rounded-lg text-white px-4 py-2.5 focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                            <div>
                                <label class="block text-xs text-gray-400 uppercase font-bold mb-1">Date of Birth</label>
                                <input type="date" name="date_of_birth" value="{{ old('date_of_birth', $user->date_of_birth?->format('Y-m-d')) }}" class="w-full bg-gray-700 border-gray-600 rounded-lg text-white px-4 py-2.5 focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs text-gray-400 uppercase font-bold mb-1">Gender</label>
                            <select name="gender" class="w-full bg-gray-700 border-gray-600 rounded-lg text-white px-4 py-2.5 focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="">Select Gender</option>
                                <option value="male" {{ old('gender', $user->gender) == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ old('gender', $user->gender) == 'female' ? 'selected' : '' }}>Female</option>
                                <option value="other" {{ old('gender', $user->gender) == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>

                        <hr class="border-gray-700 my-4">
                        
                        {{-- Address Info --}}
                        <h4 class="text-sm font-bold text-indigo-400 uppercase">Shipping Address</h4>

                        <div>
                            <label class="block text-xs text-gray-400 uppercase font-bold mb-1">Address</label>
                            <textarea name="address" rows="2" class="w-full bg-gray-700 border-gray-600 rounded-lg text-white px-4 py-2.5 focus:ring-indigo-500 focus:border-indigo-500">{{ old('address', $user->address) }}</textarea>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs text-gray-400 uppercase font-bold mb-1">City</label>
                                <input type="text" name="city" value="{{ old('city', $user->city) }}" class="w-full bg-gray-700 border-gray-600 rounded-lg text-white px-4 py-2.5 focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                            <div>
                                <label class="block text-xs text-gray-400 uppercase font-bold mb-1">State</label>
                                <input type="text" name="state" value="{{ old('state', $user->state) }}" class="w-full bg-gray-700 border-gray-600 rounded-lg text-white px-4 py-2.5 focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs text-gray-400 uppercase font-bold mb-1">Postal Code</label>
                                <input type="text" name="postal_code" value="{{ old('postal_code', $user->postal_code) }}" class="w-full bg-gray-700 border-gray-600 rounded-lg text-white px-4 py-2.5 focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                            <div>
                                <label class="block text-xs text-gray-400 uppercase font-bold mb-1">Country</label>
                                <input type="text" name="country" value="{{ old('country', $user->country) }}" class="w-full bg-gray-700 border-gray-600 rounded-lg text-white px-4 py-2.5 focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="bg-gray-750 px-6 py-4 flex justify-end gap-3 border-t border-gray-700">
                <button type="button" onclick="toggleModal('edit-profile-modal')" class="px-4 py-2 bg-transparent border border-gray-600 text-gray-300 rounded-lg hover:bg-gray-700 transition-colors">
                    Cancel
                </button>
                <button type="button" onclick="document.getElementById('edit-profile-form').submit()" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors shadow-md">
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
</script>
@endsection