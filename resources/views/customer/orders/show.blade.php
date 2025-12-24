@extends('layouts.app')

@section('title', 'Order Details')

@section('content')
<div class="container mx-auto px-4 pt-4 pb-4">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="flex items-center justify-between mb-4">
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

        <!-- Order Tracking Timeline -->
        <div class="theme-card p-4 mb-4">
            <h2 class="text-xl font-semibold mb-4">Order Tracking</h2>
            
            <div class="relative">
                @php
                    $statuses = [
                        'pending' => ['label' => 'Order Placed', 'date' => $order->created_at],
                        'confirmed' => ['label' => 'Order Confirmed', 'date' => $order->confirmed_at],
                        'processing' => ['label' => 'Processing', 'date' => $order->processing_at],
                        'shipped' => ['label' => 'Shipped', 'date' => $order->shipped_at],
                        'delivered' => ['label' => 'Delivered', 'date' => $order->delivered_at],
                    ];
                    
                    $currentStatusIndex = array_search($order->status, array_keys($statuses));
                    $isCancelled = $order->status === 'cancelled';
                @endphp

                @if(!$isCancelled)
                    <!-- Horizontal Timeline -->
                    <div class="relative">
                        <!-- Progress Line Container -->
                        <div class="absolute top-10 left-0 right-0 h-1 theme-border" style="background-color: rgb(var(--color-border));">
                            <!-- Completed Progress Line -->
                            <div class="h-full bg-green-500 transition-all duration-500" 
                                 style="width: {{ $currentStatusIndex >= 0 ? ($currentStatusIndex / (count($statuses) - 1)) * 100 : 0 }}%;">
                            </div>
                        </div>

                        <!-- Status Steps -->
                        <div class="relative flex justify-between">
                            @foreach($statuses as $statusKey => $statusInfo)
                                @php
                                    $statusIndex = array_search($statusKey, array_keys($statuses));
                                    $isCompleted = $statusIndex <= $currentStatusIndex;
                                    $isCurrent = $statusIndex === $currentStatusIndex;
                                    $isUpcoming = $statusIndex > $currentStatusIndex;
                                @endphp
                                
                                <div class="flex flex-col items-center flex-1 relative" style="min-width: 120px;">
                                    <!-- Status Circle -->
                                    <div class="relative z-10 mb-4">
                                        <div class="flex items-center justify-center w-20 h-20 rounded-full border-4 transition-all duration-300 shadow-lg
                                            {{ $isCompleted ? 'bg-green-500 border-green-500' : '' }}
                                            {{ $isCurrent ? 'border-green-500 animate-pulse' : '' }}
                                            {{ $isUpcoming ? 'border-gray-400' : '' }}"
                                            style="background-color: {{ $isCompleted ? '#10b981' : ($isCurrent ? 'rgb(var(--color-surface))' : 'rgb(var(--color-surface))') }}">
                                            
                                            @if($isCompleted)
                                                <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                                </svg>
                                            @elseif($isCurrent)
                                                <div class="w-5 h-5 bg-green-500 rounded-full animate-ping absolute"></div>
                                                <div class="w-5 h-5 bg-green-500 rounded-full relative"></div>
                                            @else
                                                <div class="w-5 h-5 rounded-full" style="background-color: rgb(var(--color-border))"></div>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Status Label -->
                                    <div class="text-center">
                                        <h3 class="text-sm font-semibold mb-1 transition-colors {{ $isCompleted || $isCurrent ? '' : 'theme-text-muted' }}">
                                            {{ $statusInfo['label'] }}
                                        </h3>
                                        @if($isCompleted && $statusInfo['date'])
                                            <p class="text-xs theme-text-muted">
                                                {{ $statusInfo['date']->format('M d, Y') }}
                                            </p>
                                            <p class="text-xs theme-text-muted">
                                                {{ $statusInfo['date']->format('g:i A') }}
                                            </p>
                                        @elseif($isCurrent)
                                            <p class="text-xs text-green-600 font-semibold">
                                                In Progress
                                            </p>
                                        @else
                                            <p class="text-xs theme-text-muted">
                                                Pending
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <!-- Cancelled Order -->
                    <div class="text-center py-8">
                        <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-red-100 mb-4">
                            <svg class="w-10 h-10 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold mb-2">Order Cancelled</h3>
                        <p class="theme-text-muted">This order has been cancelled on {{ $order->updated_at->format('M d, Y') }}</p>
                    </div>
                @endif
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Order Items -->
            <div class="lg:col-span-2 space-y-4">
                <!-- Items List -->
                <div class="theme-card overflow-hidden">
                    <div class="px-6 py-3 border-b theme-border">
                        <h2 class="text-lg font-semibold">Order Items</h2>
                    </div>
                    <div class="divide-y theme-border">
                        @foreach($order->orderItems as $item)
                            <div class="p-4">
                                <div class="flex items-center space-x-4">
                                    @if($item->product->image)
                                        <img src="{{ $item->product->image_url }}" 
                                             alt="{{ $item->product->name }}" 
                                             class="w-16 h-16 object-cover rounded-lg">
                                    @else
                                        <div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center">
                                            <span class="text-gray-400 text-xs">No Image</span>
                                        </div>
                                    @endif

                                    <div class="flex-1">
                                        <h3 class="text-lg font-medium">{{ $item->product->name }}</h3>
                                        <p class="text-sm theme-text-muted">{{ $item->product->category->name }}</p>
                                        <div class="flex items-center mt-1">
                                            <span class="text-sm theme-text-muted">Qty: {{ $item->quantity }}</span>
                                            <span class="mx-2 theme-text-muted">•</span>
                                            <span class="text-sm theme-text-muted">₹{{ number_format($item->price, 2) }} each</span>
                                        </div>
                                    </div>

                                    <div class="text-right">
                                        <p class="text-lg font-semibold">₹{{ number_format($item->total, 2) }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Shipping Address -->
                <div class="theme-card p-4">
                    <h2 class="text-lg font-semibold mb-3">Shipping Address</h2>
                    @php $shipping = json_decode($order->shipping_address, true); @endphp
                    <div class="theme-text-muted">
                        <p class="font-medium">{{ $shipping['first_name'] }} {{ $shipping['last_name'] }}</p>
                        <p>{{ $shipping['address'] }}</p>
                        <p>{{ $shipping['city'] }}, {{ $shipping['state'] }} {{ $shipping['postal_code'] }}</p>
                        <p>{{ $shipping['country'] }}</p>
                    </div>
                </div>

                <!-- Order Notes -->
                @if($order->notes)
                    <div class="theme-card p-4">
                        <h2 class="text-lg font-semibold mb-3">Order Notes</h2>
                        <p class="theme-text-muted">{{ $order->notes }}</p>
                    </div>
                @endif
            </div>

            <!-- Order Summary Sidebar -->
            <div class="lg:col-span-1">
                <div class="theme-card p-5 sticky top-4">
                    <h2 class="text-lg font-semibold mb-3">Order Summary</h2>
                    
                    <div class="space-y-2 mb-3">
                        <div class="flex justify-between">
                            <span class="theme-text-muted">Subtotal:</span>
                            <span class="font-medium">₹{{ number_format($order->orderItems->sum('total'), 2) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="theme-text-muted">Shipping:</span>
                            <span class="font-medium">
                                @php 
                                    $subtotal = $order->orderItems->sum('total');
                                    $shipping = $subtotal > 100 ? 0 : 10;
                                @endphp
                                @if($shipping == 0)
                                    <span class="text-green-600">FREE</span>
                                @else
                                    ₹{{ number_format($shipping, 2) }}
                                @endif
                            </span>
                        </div>
                        <div class="flex justify-between">
                            <span class="theme-text-muted">Tax:</span>
                            <span class="font-medium">₹{{ number_format($subtotal * 0.08, 2) }}</span>
                        </div>
                        <hr class="my-3">
                        <div class="flex justify-between text-lg font-bold">
                            <span>Total:</span>
                            <span>₹{{ number_format($order->total_amount, 2) }}</span>
                        </div>
                    </div>

                    <!-- Payment Information -->
                    <div class="border-t theme-border pt-3">
                        <h3 class="font-semibold mb-2">Payment Information</h3>
                        <div class="space-y-1.5">
                            <div class="flex justify-between">
                                <span class="theme-text-muted">Method:</span>
                                <span class="font-medium">{{ ucfirst($order->payment_method) }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="theme-text-muted">Status:</span>
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
                    <div class="border-t theme-border pt-3 mt-3">
                        @if($order->status === 'pending' && $order->payment_status !== 'completed')
                            <form action="{{ route('orders.cancel', $order) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this order?');">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="w-full mb-2 bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-md font-medium transition-colors duration-200">
                                    Cancel Order
                                </button>
                            </form>
                        @endif
                        
                        @if($order->status === 'delivered')
                            <button class="w-full mb-2 bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-md font-medium transition-colors duration-200">
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
