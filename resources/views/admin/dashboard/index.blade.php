@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-6">Admin Dashboard</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 border border-transparent dark:border-gray-700">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-indigo-100 dark:bg-indigo-500 dark:bg-opacity-30 text-indigo-600 dark:text-indigo-400">
                    <i class="fas fa-shopping-cart fa-lg"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Orders</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $stats['total_orders'] }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 border border-transparent dark:border-gray-700">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 dark:bg-green-500 dark:bg-opacity-30 text-green-600 dark:text-green-400">
                    <i class="fas fa-dollar-sign fa-lg"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Revenue</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">₹{{ number_format($stats['total_revenue'], 2) }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 border border-transparent dark:border-gray-700">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 dark:bg-blue-500 dark:bg-opacity-30 text-blue-600 dark:text-blue-400">
                    <i class="fas fa-boxes fa-lg"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Products</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $stats['total_products'] }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 border border-transparent dark:border-gray-700">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100 dark:bg-yellow-500 dark:bg-opacity-30 text-yellow-600 dark:text-yellow-400">
                    <i class="fas fa-users fa-lg"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Customers</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $stats['total_customers'] }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

        <div class="lg:col-span-7">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md border border-transparent dark:border-gray-700 overflow-hidden">
                <div class="p-4 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
                    <h5 class="text-lg font-semibold text-gray-900 dark:text-white mb-0">Recent Orders</h5>
                    <a href="{{ route('admin.orders.index') }}" class="text-sm font-medium text-indigo-600 dark:text-indigo-400 hover:text-indigo-500 dark:hover:text-indigo-300">
                        View All
                    </a>
                </div>
                <div class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($recent_orders as $order)
                    <div class="p-4 flex justify-between items-start hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                        <div>
                            <h6 class="font-medium text-gray-900 dark:text-white">Order #{{ $order->id }}</h6>
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $order->user->name }}</p>
                            <small class="text-xs text-gray-400 dark:text-gray-500">{{ $order->created_at->diffForHumans() }}</small>
                        </div>
                        <div class="text-right">
                            <h6 class="font-semibold text-gray-900 dark:text-white mb-1">₹{{ number_format($order->total_amount, 2) }}</h6>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                @if($order->status === 'pending') bg-yellow-100 text-yellow-800 dark:bg-yellow-500 dark:bg-opacity-20 dark:text-yellow-300
                                @elseif($order->status === 'delivered') bg-green-100 text-green-800 dark:bg-green-500 dark:bg-opacity-20 dark:text-green-300
                                @elseif($order->status === 'cancelled') bg-red-100 text-red-800 dark:bg-red-500 dark:bg-opacity-20 dark:text-red-300
                                @else bg-blue-100 text-blue-800 dark:bg-blue-500 dark:bg-opacity-20 dark:text-blue-300 @endif">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>
                    </div>
                    @empty
                    <div class="p-4 text-center text-gray-500 dark:text-gray-400">
                        No recent orders
                    </div>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="lg:col-span-5">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md border border-transparent dark:border-gray-700 overflow-hidden">
                <div class="p-4 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
                    <h5 class="text-lg font-semibold text-gray-900 dark:text-white mb-0">Low Stock Alert</h5>
                    <a href="{{ route('admin.products.index') }}" class="text-sm font-medium text-indigo-600 dark:text-indigo-400 hover:text-indigo-500 dark:hover:text-indigo-300">
                        Manage Inventory
                    </a>
                </div>
                <div class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($low_stock_products as $product)
                    <div class="p-4 flex justify-between items-center hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                        <div class="flex items-center">
                            @if($product->image)
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-10 h-10 rounded-md object-cover me-3">
                            @else
                            <div class="w-10 h-10 rounded-md bg-gray-100 dark:bg-gray-700 d-flex items-center justify-center me-3">
                                <i class="fas fa-image text-gray-400 dark:text-gray-500"></i>
                            </div>
                            @endif
                            <div>
                                <h6 class="font-medium text-gray-900 dark:text-white truncate" style="max-width: 150px;">{{ $product->name }}</h6>
                                <small class="text-sm text-gray-500 dark:text-gray-400">{{ $product->category->name }}</small>
                            </div>
                        </div>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                            @if($product->stock_quantity == 0) bg-red-100 text-red-800 dark:bg-red-500 dark:bg-opacity-20 dark:text-red-300
                            @else bg-yellow-100 text-yellow-800 dark:bg-yellow-500 dark:bg-opacity-20 dark:text-yellow-300 @endif">
                            {{ $product->stock_quantity }} left
                        </span>
                    </div>
                    @empty
                    <div class_models="p-4 text-center text-gray-500 dark:text-gray-400">
                        All products are well stocked
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection