@extends('layouts.app')

@section('title', 'My Orders')

@section('content')
<div class="bg-[#F5EFE6] dark:bg-gray-900 min-h-screen transition-colors duration-300 relative z-0">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16">
        <h1 class="text-4xl font-extrabold text-gray-900 dark:text-white mb-8 transition-colors">My Orders</h1>

            @if($orders->count() > 0)
                <div class="space-y-6">
                    @foreach($orders as $order)
                        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl border-2 border-gray-200 dark:border-gray-700 overflow-hidden transition-colors">
                            <div class="p-6">
                                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-4">
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Order #<span class="font-mono text-blue-600 dark:text-indigo-400">{{ $order->order_number }}</span></h3>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">Placed on {{ $order->created_at->format('M d, Y') }}</p>
                                    </div>
                                    <div class="text-right mt-3 sm:mt-0 flex-shrink-0">
                                        <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-semibold border
                                            @if($order->status === 'pending') bg-yellow-200 text-yellow-800 border-yellow-300
                                            @elseif($order->status === 'confirmed') bg-blue-200 text-blue-800 border-blue-300
                                            @elseif($order->status === 'processing') bg-indigo-200 text-indigo-800 border-indigo-300
                                            @elseif($order->status === 'shipped') bg-purple-200 text-purple-800 border-purple-300
                                            @elseif($order->status === 'delivered') bg-green-200 text-green-800 border-green-300
                                            @else bg-red-200 text-red-800 border-red-300 @endif">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
                                    <div>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">Total Amount</p>
                                        <p class="text-lg font-bold text-gray-900 dark:text-white font-mono">₹{{ number_format($order->total_amount, 2) }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">Payment Method</p>
                                        <p class="font-medium text-gray-800 dark:text-gray-200">{{ strtoupper($order->payment_method) }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">Payment Status</p>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border
                                            @if($order->payment_status === 'completed') bg-green-200 text-green-800 border-green-300
                                            @elseif($order->payment_status === 'pending') bg-yellow-200 text-yellow-800 border-yellow-300
                                            @else bg-red-200 text-red-800 border-red-300 @endif">
                                            {{ ucfirst($order->payment_status) }}
                                        </span>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">Items</p>
                                        <p class="font-medium text-gray-800 dark:text-gray-200">{{ $order->orderItems->count() }} item(s)</p>
                                    </div>
                                </div>

                                
                                <div class="border-t border-gray-200 dark:border-gray-700 pt-4">
                                    <div class="flex items-center space-x-4 overflow-x-auto">
                                        @foreach($order->orderItems->take(3) as $item)
                                            <div class="flex-shrink-0 flex items-center space-x-3">
                                                @if($item->product->image)
                                                    <img src="{{ $item->product->image_url }}" 
                                                         alt="{{ $item->product->name }}" 
                                                         class="w-12 h-12 object-cover rounded border-2 border-gray-200 dark:border-gray-700">
                                                @else
                                                    <div class="w-12 h-12 bg-gray-200 dark:bg-gray-700 rounded flex items-center justify-center border-2 border-gray-300 dark:border-gray-600">
                                                        <svg class="w-6 h-6 text-gray-400 dark:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l-1.586-1.586a2 2 0 010-2.828L16 8M9 16h10M15 16v-4m-6 4v-2.293a2 2 0 01.586-1.414l2.828-2.828A2 2 0 0113.707 5H10.293a2 2 0 00-1.414.586L6 8.586a2 2 0 00-.586 1.414V16z"></path></svg>
                                                    </div>
                                                @endif
                                                <div>
                                                    <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $item->product->name }}</p>
                                                    <p class="text-xs text-gray-600 dark:text-gray-400">Qty: {{ $item->quantity }}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                        
                                        @if($order->orderItems->count() > 3)
                                            <div class="flex-shrink-0 text-sm text-gray-600 dark:text-gray-400">
                                                +{{ $order->orderItems->count() - 3 }} more items
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="flex items-center justify-between mt-6 pt-4 border-t border-gray-200 dark:border-gray-700">
                                    <div class="flex space-x-3">
                                        <a href="{{ route('orders.show', $order) }}" 
                                           class="inline-flex items-center px-4 py-2 border-2 border-blue-600 dark:border-blue-500 rounded-md text-sm font-medium text-blue-600 dark:text-blue-400 bg-white dark:bg-gray-800 hover:bg-blue-50 dark:hover:bg-gray-700 transition-colors duration-200">
                                            View Details
                                        </a>
                                        
                                        @if($order->status === 'delivered')
                                            <button class="inline-flex items-center px-4 py-2 border border-transparent rounded-md text-sm font-medium text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 transition-colors duration-200">
                                                Write Review
                                            </button>
                                        @endif
                                    </div>
                                    
                                    @if($order->status === 'pending' && $order->payment_status !== 'completed')
                                        <form action="{{ route('orders.cancel', $order) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to cancel this order?');">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="text-red-500 hover:text-red-400 text-sm font-medium transition-colors">
                                                Cancel Order
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                
                <div class="mt-8">
                    {{ $orders->links() }}
                </div>
            @else
                <div class="text-center py-12 bg-white dark:bg-gray-800 rounded-lg border-2 border-gray-200 dark:border-gray-700 shadow-xl transition-colors">
                    <div class="mb-4">
                        <svg class="mx-auto h-12 w-12 text-gray-400 dark:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">No orders yet</h3>
                    <p class="text-gray-600 dark:text-gray-400 mb-6">You haven't placed any orders yet. Start shopping to see your orders here!</p>

                    <a href="{{ route('products.index') }}" 
                       class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 transition-all shadow-lg hover:shadow-xl transform hover:scale-105">
                        Browse Products
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection