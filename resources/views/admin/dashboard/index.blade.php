@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="theme-bg min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold mb-2">Admin Dashboard</h1>
            <p class="theme-text-muted">Welcome back! Here's what's happening with your store today.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="theme-card p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-lg bg-blue-100 dark:bg-blue-900">
                        <span class="material-icons text-blue-600 text-2xl">shopping_cart</span>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium theme-text-muted">Total Orders</p>
                        <p class="text-2xl font-bold">{{ $stats['total_orders'] }}</p>
                    </div>
                </div>
            </div>

            <div class="theme-card p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-lg bg-green-100 dark:bg-green-900">
                        <span class="material-icons text-green-600 text-2xl">payments</span>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium theme-text-muted">Total Revenue</p>
                        <p class="text-2xl font-bold">₹{{ number_format($stats['total_revenue'], 0) }}</p>
                    </div>
                </div>
            </div>

            <div class="theme-card p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-lg bg-purple-100 dark:bg-purple-900">
                        <span class="material-icons text-purple-600 text-2xl">inventory_2</span>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium theme-text-muted">Total Products</p>
                        <p class="text-2xl font-bold">{{ $stats['total_products'] }}</p>
                    </div>
                </div>
            </div>

            <div class="theme-card p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-lg bg-orange-100 dark:bg-orange-900">
                        <span class="material-icons text-orange-600 text-2xl">people</span>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium theme-text-muted">Total Customers</p>
                        <p class="text-2xl font-bold">{{ $stats['total_customers'] }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

            <div class="lg:col-span-7">
                <div class="theme-card overflow-hidden">
                    <div class="p-6 bg-indigo-600 flex justify-between items-center">
                        <h5 class="text-xl font-bold text-white mb-0 flex items-center gap-2">
                            <span class="material-icons">receipt_long</span>
                            Recent Orders
                        </h5>
                        <a href="{{ route('admin.orders.index') }}" class="inline-flex items-center gap-1 px-4 py-2 bg-white text-indigo-600 rounded-lg font-medium text-sm hover:bg-indigo-50">
                            View All
                            <span class="material-icons text-sm">arrow_forward</span>
                        </a>
                    </div>
                    <div class="divide-y theme-border">
                        @forelse($recent_orders as $order)
                        <div class="p-5 flex justify-between items-start">
                            <div>
                                <h6 class="font-bold text-lg">Order #{{ $order->id }}</h6>
                                <p class="text-sm font-medium mt-1">{{ $order->user->name }}</p>
                                <small class="text-xs theme-text-muted">{{ $order->created_at->diffForHumans() }}</small>
                            </div>
                            <div class="text-right">
                                <h6 class="font-bold mb-2 text-lg">₹{{ number_format($order->total_amount, 0) }}</h6>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                                    @if($order->status === 'pending') bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200
                                    @elseif($order->status === 'delivered') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                                    @elseif($order->status === 'cancelled') bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200
                                    @else bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200 @endif">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </div>
                        </div>
                        @empty
                        <div class="p-8 text-center">
                            <span class="material-icons theme-text-muted mb-3" style="font-size: 60px;">shopping_cart</span>
                            <p class="theme-text-muted font-medium">No recent orders</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="lg:col-span-5">
                <div class="theme-card overflow-hidden">
                    <div class="p-6 bg-orange-600 flex justify-between items-center">
                        <h5 class="text-xl font-bold text-white mb-0 flex items-center gap-2">
                            <span class="material-icons">warning</span>
                            Low Stock Alert
                        </h5>
                        <a href="{{ route('admin.products.index') }}" class="inline-flex items-center gap-1 px-4 py-2 bg-white text-orange-600 rounded-lg font-medium text-sm hover:bg-orange-50">
                            Manage
                            <span class="material-icons text-sm">arrow_forward</span>
                        </a>
                    </div>
                    <div class="divide-y theme-border">
                        @forelse($low_stock_products as $product)
                        <div class="p-5 flex justify-between items-center">
                            <div class="flex items-center gap-3">
                                @if($product->image)
                                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-12 h-12 rounded-lg object-cover theme-border border">
                                @else
                                <div class="w-12 h-12 rounded-lg bg-gray-200 dark:bg-gray-700 flex items-center justify-center theme-border border">
                                    <span class="material-icons theme-text-muted">image</span>
                                </div>
                                @endif
                                <div>
                                    <h6 class="font-bold truncate" style="max-width: 150px;">{{ $product->name }}</h6>
                                    <small class="text-sm theme-text-muted">{{ $product->category->name }}</small>
                                </div>
                            </div>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                                @if($product->stock_quantity == 0) bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200
                                @else bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200 @endif">
                                {{ $product->stock_quantity }} left
                            </span>
                        </div>
                        @empty
                        <div class="p-8 text-center">
                            <span class="material-icons theme-text-muted mb-3" style="font-size: 60px;">check_circle</span>
                            <p class="theme-text-muted font-medium">All products are well stocked</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection