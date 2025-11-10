@extends('layouts.app')

@section('title', 'My Profile - Nexora')

@section('content')
<div class="bg-gray-900 py-12 sm:py-16">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="mb-8 text-center">
            <h1 class="text-4xl font-bold font-serif text-white">
                My Profile
            </h1>
            <p class="text-gray-300 mt-2 text-lg">Manage your account details and view your orders.</p>
        </div>

        <div class="bg-gray-800 border border-gray-700 rounded-lg shadow-sm overflow-hidden">
            <div class="p-6 sm:p-8">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <span class="inline-flex items-center justify-center h-16 w-16 rounded-full bg-indigo-500 mb-4 sm:mb-0">
                            <span class="text-3xl font-medium leading-none text-white">{{ $user->name[0] }}</span>
                        </span>
                    </div>
                    <div class="sm:ml-6 flex-1">
                        <h2 class="text-2xl font-bold text-white">{{ $user->name }}</h2>
                        <p class="text-sm text-gray-400 mt-1">{{ $user->email }}</p>
                        <p class="text-sm text-gray-400 mt-1">Joined: {{ $user->created_at->format('M d, Y') }}</p>
                    </div>
                    <div class="mt-4 sm:mt-0">
                        <a href="#" class="w-full sm:w-auto inline-flex justify-center items-center bg-indigo-500 text-white px-5 py-2.5 rounded-md font-semibold text-sm hover:bg-indigo-600 transition-colors">
                            Edit Profile
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-10">
            <h3 class="text-2xl font-semibold font-serif text-white mb-6">
                My Recent Orders
            </h3>

            @php
            $recentOrders = $user->orders()->latest()->take(3)->get();
            @endphp

            @if($recentOrders->count() > 0)
            <div class="space-y-6">
                @foreach($recentOrders as $order)
                <div class="bg-gray-800 border border-gray-700 rounded-lg shadow-sm">
                    <div class="p-5 sm:p-6">
                        <div class="flex flex-col sm:flex-row justify-between sm:items-center">
                            <div>
                                <p class="text-lg font-semibold text-white">Order #{{ $order->id }}</p>
                                <p class="text-sm text-gray-400 mt-1">Placed on: {{ $order->created_at->format('F d, Y') }}</p>
                            </div>
                            <div class="mt-3 sm:mt-0">
                                <span class="text-lg font-bold text-white">₹{{ number_format($order->total_amount, 2) }}</span>
                            </div>
                        </div>
                        <hr class="border-gray-700 my-4">
                        <div class="flex flex-col sm:flex-row justify-between sm:items-center">
                            <span class="inline-block bg-{{ strtolower($order->status) == 'completed' ? 'green' : (strtolower($order->status) == 'pending' ? 'yellow' : 'blue') }}-900 text-{{ strtolower($order->status) == 'completed' ? 'green' : (strtolower($order->status) == 'pending' ? 'yellow' : 'blue') }}-300 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                {{ ucfirst($order->status) }}
                            </span>
                            <a href="{{ route('orders.show', $order) }}" class="mt-3 sm:mt-0 text-sm font-medium text-indigo-400 hover:text-indigo-300">
                                View Order Details &rarr;
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="text-center mt-8">
                <a href="{{ route('orders.index') }}" class="text-lg font-medium text-indigo-400 hover:text-indigo-300">
                    View All Orders
                </a>
            </div>
            @else
            <div class="text-center bg-gray-800 border border-gray-700 rounded-lg p-10">
                <svg class="mx-auto h-12 w-12 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002-2h2a2 2 0 002 2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 9l-4 4m0 0l-4-4m4 4V9"></path>
                </svg>
                <h3 class="mt-2 text-lg font-semibold text-white">No orders yet</h3>
                <p class="mt-1 text-sm text-gray-400">You haven't placed any orders yet. Start shopping!</p>
                <div class="mt-6">
                    <a href="{{ route('products.index') }}" class="inline-flex items-center px-5 py-2.5 shadow-sm text-sm font-medium rounded-md text-white bg-indigo-500 hover:bg-indigo-600">
                        Shop Now
                    </a>
                </div>
            </div>
            @endif
        </div>

    </div>
</div>
@endsection