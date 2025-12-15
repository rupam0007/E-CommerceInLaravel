@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="bg-[#F5EFE6] min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-8">
            <h1 class="text-4xl font-extrabold text-gray-900 mb-2">Admin Dashboard</h1>
            <p class="text-gray-600 font-semibold">Welcome back! Here's what's happening with your store today.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-lg p-6 border-2 border-blue-100 hover:shadow-xl transition-shadow">
                <div class="flex items-center">
                    <div class="p-4 rounded-xl bg-gradient-to-br from-blue-500 to-indigo-600 shadow-lg">
                        <span class="material-icons text-white text-3xl">shopping_cart</span>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-bold text-gray-600 uppercase tracking-wide">Total Orders</p>
                        <p class="text-3xl font-extrabold text-gray-900">{{ $stats['total_orders'] }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6 border-2 border-green-100 hover:shadow-xl transition-shadow">
                <div class="flex items-center">
                    <div class="p-4 rounded-xl bg-gradient-to-br from-green-500 to-emerald-600 shadow-lg">
                        <span class="material-icons text-white text-3xl">payments</span>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-bold text-gray-600 uppercase tracking-wide">Total Revenue</p>
                        <p class="text-3xl font-extrabold text-gray-900">₹{{ number_format($stats['total_revenue'], 0) }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6 border-2 border-purple-100 hover:shadow-xl transition-shadow">
                <div class="flex items-center">
                    <div class="p-4 rounded-xl bg-gradient-to-br from-purple-500 to-pink-600 shadow-lg">
                        <span class="material-icons text-white text-3xl">inventory_2</span>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-bold text-gray-600 uppercase tracking-wide">Total Products</p>
                        <p class="text-3xl font-extrabold text-gray-900">{{ $stats['total_products'] }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6 border-2 border-orange-100 hover:shadow-xl transition-shadow">
                <div class="flex items-center">
                    <div class="p-4 rounded-xl bg-gradient-to-br from-orange-500 to-red-600 shadow-lg">
                        <span class="material-icons text-white text-3xl">people</span>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-bold text-gray-600 uppercase tracking-wide">Total Customers</p>
                        <p class="text-3xl font-extrabold text-gray-900">{{ $stats['total_customers'] }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

            <div class="lg:col-span-7">
                <div class="bg-white rounded-xl shadow-lg border-2 border-gray-100 overflow-hidden">
                    <div class="p-6 bg-gradient-to-r from-blue-500 to-indigo-600 flex justify-between items-center">
                        <h5 class="text-xl font-bold text-white mb-0 flex items-center gap-2">
                            <span class="material-icons">receipt_long</span>
                            Recent Orders
                        </h5>
                        <a href="{{ route('admin.orders.index') }}" class="inline-flex items-center gap-1 px-4 py-2 bg-white text-blue-600 rounded-lg font-bold text-sm hover:bg-blue-50 transition-all shadow-md hover:shadow-lg">
                            View All
                            <span class="material-icons text-sm">arrow_forward</span>
                        </a>
                    </div>
                    <div class="divide-y divide-gray-200">
                        @forelse($recent_orders as $order)
                        <div class="p-5 flex justify-between items-start hover:bg-blue-50 transition-colors">
                            <div>
                                <h6 class="font-bold text-gray-900 text-lg">Order #{{ $order->id }}</h6>
                                <p class="text-sm text-gray-700 font-semibold mt-1">{{ $order->user->name }}</p>
                                <small class="text-xs text-gray-500 font-medium">{{ $order->created_at->diffForHumans() }}</small>
                            </div>
                            <div class="text-right">
                                <h6 class="font-extrabold text-gray-900 mb-2 text-xl">₹{{ number_format($order->total_amount, 0) }}</h6>
                                <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold shadow-sm
                                    @if($order->status === 'pending') bg-gradient-to-r from-yellow-400 to-orange-500 text-white
                                    @elseif($order->status === 'delivered') bg-gradient-to-r from-green-500 to-emerald-600 text-white
                                    @elseif($order->status === 'cancelled') bg-gradient-to-r from-red-500 to-pink-600 text-white
                                    @else bg-gradient-to-r from-blue-500 to-indigo-600 text-white @endif">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </div>
                        </div>
                        @empty
                        <div class="p-8 text-center">
                            <span class="material-icons text-gray-400 mb-3" style="font-size: 60px;">shopping_cart</span>
                            <p class="text-gray-600 font-semibold">No recent orders</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="lg:col-span-5">
                <div class="bg-white rounded-xl shadow-lg border-2 border-gray-100 overflow-hidden">
                    <div class="p-6 bg-gradient-to-r from-orange-500 to-red-600 flex justify-between items-center">
                        <h5 class="text-xl font-bold text-white mb-0 flex items-center gap-2">
                            <span class="material-icons">warning</span>
                            Low Stock Alert
                        </h5>
                        <a href="{{ route('admin.products.index') }}" class="inline-flex items-center gap-1 px-4 py-2 bg-white text-orange-600 rounded-lg font-bold text-sm hover:bg-orange-50 transition-all shadow-md hover:shadow-lg">
                            Manage
                            <span class="material-icons text-sm">arrow_forward</span>
                        </a>
                    </div>
                    <div class="divide-y divide-gray-200">
                        @forelse($low_stock_products as $product)
                        <div class="p-5 flex justify-between items-center hover:bg-orange-50 transition-colors">
                            <div class="flex items-center gap-3">
                                @if($product->image)
                                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-12 h-12 rounded-lg object-cover border-2 border-gray-200">
                                @else
                                <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center border-2 border-gray-200">
                                    <span class="material-icons text-gray-500">image</span>
                                </div>
                                @endif
                                <div>
                                    <h6 class="font-bold text-gray-900 truncate" style="max-width: 150px;">{{ $product->name }}</h6>
                                    <small class="text-sm text-gray-600 font-semibold">{{ $product->category->name }}</small>
                                </div>
                            </div>
                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold shadow-sm
                                @if($product->stock_quantity == 0) bg-gradient-to-r from-red-500 to-pink-600 text-white
                                @else bg-gradient-to-r from-yellow-400 to-orange-500 text-white @endif">
                                {{ $product->stock_quantity }} left
                            </span>
                        </div>
                        @empty
                        <div class="p-8 text-center">
                            <span class="material-icons text-gray-400 mb-3" style="font-size: 60px;">check_circle</span>
                            <p class="text-gray-600 font-semibold">All products are well stocked</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection