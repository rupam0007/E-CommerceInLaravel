@extends('layouts.app')

@section('title', 'Order Details')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Order #{{ $order->order_number }}</h1>
                <p class="text-gray-600">Placed on {{ $order->created_at->format('M d, Y \a\t g:i A') }}</p>
            </div>
            <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium
                @if($order->status === 'pending') bg-yellow-100 text-yellow-800
                @elseif($order->status === 'confirmed') bg-blue-100 text-blue-800
                @elseif($order->status === 'processing') bg-purple-100 text-purple-800
                @elseif($order->status === 'shipped') bg-indigo-100 text-indigo-800
                @elseif($order->status === 'delivered') bg-green-100 text-green-800
                @else bg-red-100 text-red-800 @endif">
                {{ ucfirst($order->status) }}
            </span>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Order Items -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Items List -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-900">Order Items</h2>
                    </div>
                    <div class="divide-y divide-gray-200">
                        @foreach($order->orderItems as $item)
                            <div class="p-6">
                                <div class="flex items-center space-x-4">
                                    @if($item->product->image)
                                        <img src="{{ asset('uploads/' . $item->product->image) }}" 
                                             alt="{{ $item->product->name }}" 
                                             class="w-16 h-16 object-cover rounded-lg">
                                    @else
                                        <div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center">
                                            <span class="text-gray-400 text-xs">No Image</span>
                                        </div>
                                    @endif

                                    <div class="flex-1">
                                        <h3 class="text-lg font-medium text-gray-900">{{ $item->product->name }}</h3>
                                        <p class="text-sm text-gray-600">{{ $item->product->category->name }}</p>
                                        <div class="flex items-center mt-1">
                                            <span class="text-sm text-gray-600">Qty: {{ $item->quantity }}</span>
                                            <span class="mx-2 text-gray-400">•</span>
                                            <span class="text-sm text-gray-600">${{ number_format($item->price, 2) }} each</span>
                                        </div>
                                    </div>

                                    <div class="text-right">
                                        <p class="text-lg font-semibold text-gray-900">${{ number_format($item->total, 2) }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Shipping Address -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Shipping Address</h2>
                    @php $shipping = json_decode($order->shipping_address, true); @endphp
                    <div class="text-gray-700">
                        <p class="font-medium">{{ $shipping['first_name'] }} {{ $shipping['last_name'] }}</p>
                        <p>{{ $shipping['address'] }}</p>
                        <p>{{ $shipping['city'] }}, {{ $shipping['state'] }} {{ $shipping['postal_code'] }}</p>
                        <p>{{ $shipping['country'] }}</p>
                    </div>
                </div>

                <!-- Order Notes -->
                @if($order->notes)
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-lg font-semibold text-gray-900 mb-4">Order Notes</h2>
                        <p class="text-gray-700">{{ $order->notes }}</p>
                    </div>
                @endif
            </div>

            <!-- Order Summary Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-md p-6 sticky top-4">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Order Summary</h2>
                    
                    <div class="space-y-3 mb-4">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Subtotal:</span>
                            <span class="font-medium">${{ number_format($order->orderItems->sum('total'), 2) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Shipping:</span>
                            <span class="font-medium">
                                @php 
                                    $subtotal = $order->orderItems->sum('total');
                                    $shipping = $subtotal > 100 ? 0 : 10;
                                @endphp
                                @if($shipping == 0)
                                    <span class="text-green-600">FREE</span>
                                @else
                                    ${{ number_format($shipping, 2) }}
                                @endif
                            </span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Tax:</span>
                            <span class="font-medium">${{ number_format($subtotal * 0.08, 2) }}</span>
                        </div>
                        <hr class="my-3">
                        <div class="flex justify-between text-lg font-bold">
                            <span>Total:</span>
                            <span>${{ number_format($order->total_amount, 2) }}</span>
                        </div>
                    </div>

                    <!-- Payment Information -->
                    <div class="border-t pt-4">
                        <h3 class="font-semibold text-gray-900 mb-2">Payment Information</h3>
                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Method:</span>
                                <span class="font-medium">{{ ucfirst($order->payment_method) }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Status:</span>
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                    @if($order->payment_status === 'completed') bg-green-100 text-green-800
                                    @elseif($order->payment_status === 'pending') bg-yellow-100 text-yellow-800
                                    @else bg-red-100 text-red-800 @endif">
                                    {{ ucfirst($order->payment_status) }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Order Actions -->
                    <div class="border-t pt-4 mt-4">
                        @if($order->status === 'pending' && $order->payment_status !== 'completed')
                            <button class="w-full mb-3 bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-md font-medium transition-colors duration-200">
                                Cancel Order
                            </button>
                        @endif
                        
                        @if($order->status === 'delivered')
                            <button class="w-full mb-3 bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-md font-medium transition-colors duration-200">
                                Write Review
                            </button>
                        @endif

                        <a href="{{ route('orders.index') }}" 
                           class="w-full bg-gray-600 hover:bg-gray-700 text-white py-2 px-4 rounded-md font-medium transition-colors duration-200 block text-center">
                            Back to Orders
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
