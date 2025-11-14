@extends('layouts.app')

@section('title', 'Admin • Orders')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex flex-col md:flex-row items-center justify-between gap-4 mb-6">
        <h1 class="text-2xl font-semibold text-white">Orders (<span id="order-count">{{ $orders->total() }}</span>)</h1>
        <a href="{{ route('admin.dashboard') }}" class="w-full md:w-auto text-center px-5 py-2.5 rounded-md border border-gray-700 text-gray-300 hover:bg-gray-800 transition-colors">Back to Dashboard</a>
    </div>

    
    <div class="bg-gray-800 rounded-lg shadow-xl border border-gray-700 p-4 mb-6">
        <form id="filter-form" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
            <input type="text" name="search" placeholder="Search by Order # or Customer..." class="border border-gray-700 bg-gray-900 text-white rounded px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none">
            
            <select name="status" class="border border-gray-700 bg-gray-900 text-white rounded px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                <option value="">All Statuses</option>
                <option value="pending">Pending</option>
                <option value="confirmed">Confirmed</option>
                <option value="processing">Processing</option>
                <option value="shipped">Shipped</option>
                <option value="delivered">Delivered</option>
                <option value="cancelled">Cancelled</option>
            </select>
            
            <select name="payment_status" class="border border-gray-700 bg-gray-900 text-white rounded px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                <option value="">All Payment Statuses</option>
                <option value="pending">Pending</option>
                <option value="completed">Completed</option>
                <option value="failed">Failed</option>
                <option value="refunded">Refunded</option>
            </select>
            
            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2 rounded-md text-sm font-medium transition-colors">Filter</button>
        </form>
    </div>

    
    <div id="orders-container" class="bg-gray-800 rounded-lg shadow-xl border border-gray-700 overflow-x-auto">
        @include('admin.orders.partials.orders-table', ['orders' => $orders])
    </div>

    
    <div id="pagination-container" class="mt-6">
        @include('admin.orders.partials.pagination', ['paginator' => $orders])
    </div>
</div>
@endsection