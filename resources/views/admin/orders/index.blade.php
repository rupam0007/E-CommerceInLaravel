@extends('layouts.app')

@section('title', 'Manage Orders')

@section('content')
<div class="bg-[#F5EFE6] min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {{-- Header --}}
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
            <div>
                <h1 class="text-4xl font-extrabold text-gray-900 mb-2">Manage Orders</h1>
                <p class="text-gray-600 font-semibold">Total <span id="order-count" class="text-blue-600">{{ $orders->total() }}</span> orders</p>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-white text-gray-700 rounded-xl font-bold hover:shadow-xl transition-all border-2 border-gray-200">
                <span class="material-icons">arrow_back</span>
                Back to Dashboard
            </a>
        </div>

        {{-- Filters --}}
        <div class="bg-white rounded-2xl shadow-lg p-6 mb-6 border-2 border-blue-100">
            <div class="flex items-center gap-2 mb-4">
                <span class="material-icons text-blue-600">filter_alt</span>
                <h3 class="text-lg font-bold text-gray-900">Filter Orders</h3>
            </div>
            <form id="filter-form">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Search</label>
                        <input type="text" name="search" class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-blue-500 focus:outline-none font-semibold" placeholder="Order # or Customer..." value="{{ request('search') }}">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Order Status</label>
                        <select name="status" class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-blue-500 focus:outline-none font-semibold">
                            <option value="">All Statuses</option>
                            <option value="pending" @selected(request('status') == 'pending')>Pending</option>
                            <option value="confirmed" @selected(request('status') == 'confirmed')>Confirmed</option>
                            <option value="processing" @selected(request('status') == 'processing')>Processing</option>
                            <option value="shipped" @selected(request('status') == 'shipped')>Shipped</option>
                            <option value="delivered" @selected(request('status') == 'delivered')>Delivered</option>
                            <option value="cancelled" @selected(request('status') == 'cancelled')>Cancelled</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Payment Status</label>
                        <select name="payment_status" class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-blue-500 focus:outline-none font-semibold">
                            <option value="">All Payment Statuses</option>
                            <option value="pending" @selected(request('payment_status') == 'pending')>Pending</option>
                            <option value="completed" @selected(request('payment_status') == 'completed')>Completed</option>
                            <option value="failed" @selected(request('payment_status') == 'failed')>Failed</option>
                            <option value="refunded" @selected(request('payment_status') == 'refunded')>Refunded</option>
                        </select>
                    </div>
                    <div class="flex items-end">
                        <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white py-3 px-6 rounded-lg font-bold shadow-lg hover:shadow-xl transition-all flex items-center justify-center gap-2">
                            <span class="material-icons">search</span>
                            Filter
                        </button>
                    </div>
                </div>
            </form>
        </div>

        {{-- Orders Table --}}
        <div id="orders-container" class="bg-white rounded-2xl shadow-lg overflow-hidden border-2 border-gray-100">
            @include('admin.orders.partials.orders-table', ['orders' => $orders])
        </div>

        {{-- Pagination --}}
        <div id="pagination-container" class="mt-6">
            @include('admin.orders.partials.pagination', ['paginator' => $orders])
        </div>
    </div>
</div>
@endsection