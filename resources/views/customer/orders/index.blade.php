@extends('layouts.app')

@section('title', 'My Orders')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-6xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">My Orders</h1>

        @if($orders->count() > 0)
            <div class="space-y-6">
                @foreach($orders as $order)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-4">
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900">Order #{{ $order->order_number }}</h3>
                                    <p class="text-sm text-gray-600">Placed on {{ $order->created_at->format('M d, Y') }}</p>
                                </div>
                                <div class="text-right">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                        @if($order->status === 'pending') bg-yellow-100 text-yellow-800
                                        @elseif($order->status === 'confirmed') bg-blue-100 text-blue-800
                                        @elseif($order->status === 'processing') bg-purple-100 text-purple-800
                                        @elseif($order->status === 'shipped') bg-indigo-100 text-indigo-800
                                        @elseif($order->status === 'delivered') bg-green-100 text-green-800
                                        @else bg-red-100 text-red-800 @endif">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
                                <div>
                                    <p class="text-sm text-gray-600">Total Amount</p>
                                    <p class="text-lg font-bold text-gray-900">${{ number_format($order->total_amount, 2) }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Payment Method</p>
                                    <p class="font-medium text-gray-900">{{ ucfirst($order->payment_method) }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Payment Status</p>
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                        @if($order->payment_status === 'completed') bg-green-100 text-green-800
                                        @elseif($order->payment_status === 'pending') bg-yellow-100 text-yellow-800
                                        @else bg-red-100 text-red-800 @endif">
                                        {{ ucfirst($order->payment_status) }}
                                    </span>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Items</p>
                                    <p class="font-medium text-gray-900">{{ $order->orderItems->count() }} item(s)</p>
                                </div>
                            </div>

                            <!-- Order Items Preview -->
                            <div class="border-t pt-4">
                                <div class="flex items-center space-x-4 overflow-x-auto">
                                    @foreach($order->orderItems->take(3) as $item)
                                        <div class="flex-shrink-0 flex items-center space-x-2">
                                            @if($item->product->image)
                                                <img src="{{ asset('uploads/' . $item->product->image) }}" 
                                                     alt="{{ $item->product->name }}" 
                                                     class="w-12 h-12 object-cover rounded">
                                            @else
                                                <div class="w-12 h-12 bg-gray-200 rounded flex items-center justify-center">
                                                    <span class="text-gray-400 text-xs">No Image</span>
                                                </div>
                                            @endif
                                            <div>
                                                <p class="text-sm font-medium text-gray-900">{{ $item->product->name }}</p>
                                                <p class="text-xs text-gray-600">Qty: {{ $item->quantity }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                    
                                    @if($order->orderItems->count() > 3)
                                        <div class="flex-shrink-0 text-sm text-gray-600">
                                            +{{ $order->orderItems->count() - 3 }} more items
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="flex items-center justify-between mt-6 pt-4 border-t">
                                <div class="flex space-x-3">
                                    <a href="{{ route('orders.show', $order) }}" 
                                       class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors duration-200">
                                        View Details
                                    </a>
                                    
                                    @if($order->status === 'delivered')
                                        <button class="inline-flex items-center px-4 py-2 border border-transparent rounded-md text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 transition-colors duration-200">
                                            Write Review
                                        </button>
                                    @endif
                                </div>
                                
                                @if($order->status === 'pending' && $order->payment_status !== 'completed')
                                    <button class="text-red-600 hover:text-red-800 text-sm font-medium">
                                        Cancel Order
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $orders->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <div class="mb-4">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">No orders yet</h3>
                <p class="text-gray-600 mb-6">You haven't placed any orders yet. Start shopping to see your orders here!</p>
                <a href="{{ route('products.index') }}" 
                   class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 transition-colors duration-200">
                    Browse Products
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
