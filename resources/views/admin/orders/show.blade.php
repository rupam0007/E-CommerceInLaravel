@extends('layouts.app')

@section('title', 'Admin • Order ' . $order->order_number)

@php
    $statusColors = [
        'pending' => 'bg-yellow-200 text-yellow-800 border-yellow-300',
        'confirmed' => 'bg-blue-200 text-blue-800 border-blue-300',
        'processing' => 'bg-indigo-200 text-indigo-800 border-indigo-300',
        'shipped' => 'bg-purple-200 text-purple-800 border-purple-300',
        'delivered' => 'bg-green-200 text-green-800 border-green-300',
        'cancelled' => 'bg-red-200 text-red-800 border-red-300',
    ];

    $paymentStatusColors = [
        'pending' => 'bg-yellow-200 text-yellow-800 border-yellow-300',
        'completed' => 'bg-green-200 text-green-800 border-green-300',
        'failed' => 'bg-red-200 text-red-800 border-red-300',
        'refunded' => 'bg-gray-200 text-gray-800 border-gray-300',
    ];
@endphp

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    <div class="mb-5">
        <a href="{{ route('admin.orders.index') }}" class="inline-flex items-center text-sm text-indigo-400 hover:text-indigo-300 transition-colors">
            <svg class="w-4 h-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
            Back to Orders
        </a>
    </div>

    
    <div class="bg-gray-800 rounded-lg shadow-xl border border-gray-700 overflow-hidden mb-8">
        <div class="px-6 py-5 sm:px-8 sm:py-6">
            <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-semibold text-white">
                        Order #<span class="font-mono text-indigo-400">{{ $order->order_number }}</span>
                    </h1>
                    <p class="text-sm text-gray-400 mt-1">
                        Placed on {{ $order->created_at->format('F d, Y \a\t h:i A') }}
                    </p>
                </div>
                <div class="flex-shrink-0">
                    <span class="inline-flex items-center px-4 py-1.5 rounded-full text-sm font-semibold border {{ $statusColors[$order->status] ?? 'bg-gray-200 text-gray-800 border-gray-300' }}">
                        {{ ucfirst($order->status) }}
                    </span>
                </div>
            </div>

            <hr class="border-gray-700 my-5">

            <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                <div class="flex items-center gap-4">
                    <div class="text-sm">
                        <span class="text-gray-400 block">Payment Method</span>
                        <span class="text-white font-medium">{{ strtoupper($order->payment_method) }}</span>
                    </div>
                    <div class="border-l border-gray-700 h-8"></div>
                    <div class="text-sm">
                        <span class="text-gray-400 block">Payment Status</span>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border {{ $paymentStatusColors[$order->payment_status] ?? 'bg-gray-200 text-gray-800 border-gray-300' }}">
                            {{ ucfirst($order->payment_status) }}
                        </span>
                    </div>
                </div>

                <form action="{{ route('admin.orders.update-status', $order->id) }}" method="POST" class="flex items-center gap-3 w-full md:w-auto">
                    @csrf
                    @method('PATCH')
                    <label for="status" class="text-sm font-medium text-gray-300 sr-only">Update Status</label>
                    <select id="status" name="status" class="w-full md:w-auto border border-gray-700 bg-gray-900 text-white rounded px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none" required>
                        @foreach(['pending', 'confirmed', 'processing', 'shipped', 'delivered', 'cancelled'] as $status)
                        <option value="{{ $status }}" @selected($order->status == $status)>{{ ucfirst($status) }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2 rounded-md text-sm font-medium transition-colors">Update</button>
                </form>
            </div>
        </div>
    </div>

    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <div class="lg:col-span-2 space-y-8">
            <div class="bg-gray-800 rounded-lg shadow-xl border border-gray-700 overflow-hidden">
                <div class="px-6 py-5 sm:px-8">
                    <h2 class="text-xl font-semibold text-white">Order Items</h2>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full min-w-max">
                        <thead class="bg-gray-900">
                            <tr>
                                <th scope="col" class="text-left text-sm font-medium text-gray-400 px-8 py-3">Product</th>
                                <th scope="col" class="text-center text-sm font-medium text-gray-400 px-8 py-3">Quantity</th>
                                <th scope="col" class="text-right text-sm font-medium text-gray-400 px-8 py-3">Price</th>
                                <th scope="col" class="text-right text-sm font-medium text-gray-400 px-8 py-3">Total</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-700">
                            @foreach($order->orderItems as $item)
                            <tr class="text-white hover:bg-gray-700/50 transition-colors">
                                <td class="px-8 py-4">
                                    <div class="flex items-center gap-4">
                                        @if($item->product->image)
                                            <img src="{{ $item->product->image_url }}" alt="{{ $item->product->name }}" class="w-14 h-14 object-cover rounded-md border border-gray-700">
                                        @else
                                            <div class="w-14 h-14 bg-gray-700 rounded-md flex items-center justify-center">
                                                <svg class="w-6 h-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l-1.586-1.586a2 2 0 010-2.828L16 8M9 16h10M15 16v-4m-6 4v-2.293a2 2 0 01.586-1.414l2.828-2.828A2 2 0 0113.707 5H10.293a2 2 0 00-1.414.586L6 8.586a2 2 0 00-.586 1.414V16z"></path></svg>
                                            </div>
                                        @endif
                                        <div>
                                            <p class="font-medium">{{ $item->product->name }}</p>
                                            <p class="text-sm text-gray-400">SKU: {{ $item->product->sku }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-4 text-center text-gray-300 font-mono">x {{ $item->quantity }}</td>
                                <td class="px-8 py-4 text-right text-gray-300 font-mono">₹{{ number_format($item->price, 2) }}</td>
                                <td class="px-8 py-4 text-right font-medium font-mono">₹{{ number_format($item->price * $item->quantity, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                
                <div class="px-6 py-5 sm:px-8 bg-gray-900">
                    <div class="flex justify-end">
                        <div class="w-full max-w-sm space-y-3">
                            <div class="flex justify-between text-gray-300">
                                <span class="text-sm">Subtotal</span>
                                <span class="text-sm font-mono">₹{{ number_format($order->orderItems->sum(fn($item) => $item->price * $item->quantity), 2) }}</span>
                            </div>
                            <div class="flex justify-between text-gray-300">
                                <span class="text-sm">Shipping</span>
                                <span class="text-sm font-mono">₹0.00</span>
                            </div>
                            <div class="flex justify-between text-gray-300">
                                <span class="text-sm">Tax</span>
                                <span class="text-sm font-mono">₹0.00</span>
                            </div>
                            <hr class="border-gray-700">
                            <div class="flex justify-between text-white text-lg font-semibold">
                                <span>Total</span>
                                <span class="font-mono">₹{{ number_format($order->total_amount, 2) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            @if($order->notes)
            <div class="bg-gray-800 rounded-lg shadow-xl border border-gray-700 p-6 sm:p-8">
                <h3 class="text-lg font-semibold text-white mb-3">Order Notes</h3>
                <p class="text-gray-300 text-sm italic">"{{ $order->notes }}"</p>
            </div>
            @endif
        </div>

        
        <div class="lg:col-span-1 space-y-8">
            <div class="bg-gray-800 rounded-lg shadow-xl border border-gray-700 p-6 sm:p-8">
                <h3 class="text-lg font-semibold text-white mb-4">Customer Details</h3>
                <div class="space-y-1">
                    <p class="text-white text-base font-medium">{{ $order->user->name }}</p>
                    <a href="mailto:{{ $order->user->email }}" class="text-gray-400 text-sm hover:text-indigo-400 transition-colors">{{ $order->user->email }}</a>
                </div>
            </div>

            <div class="bg-gray-800 rounded-lg shadow-xl border border-gray-700 p-6 sm:p-8">
                <h3 class="text-lg font-semibold text-white mb-4">Shipping Address</h3>
                @php $shipping = json_decode($order->shipping_address, true); @endphp
                <address class="text-gray-300 not-italic space-y-1 text-sm">
                    <p class="font-medium text-white">{{ $shipping['first_name'] ?? '' }} {{ $shipping['last_name'] ?? '' }}</p>
                    <p>{{ $shipping['address'] ?? '' }}</p>
                    <p>{{ $shipping['city'] ?? '' }}, {{ $shipping['state'] ?? '' }} - {{ $shipping['postal_code'] ?? '' }}</p>
                    <p>{{ $shipping['country'] ?? '' }}</p>
                </address>
            </div>

            <div class="bg-gray-800 rounded-lg shadow-xl border border-gray-700 p-6 sm:p-8">
                <h3 class="text-lg font-semibold text-white mb-4">Billing Address</h3>
                @if($order->shipping_address == $order->billing_address)
                    <p class="text-gray-400 text-sm italic">Same as shipping address</p>
                @else
                    @php $billing = json_decode($order->billing_address, true); @endphp
                    <address class="text-gray-300 not-italic space-y-1 text-sm">
                        <p class="font-medium text-white">{{ $billing['first_name'] ?? '' }} {{ $billing['last_name'] ?? '' }}</p>
                        <p>{{ $billing['address'] ?? '' }}</p>
                        <p>{{ $billing['city'] ?? '' }}, {{ $billing['state'] ?? '' }} - {{ $billing['postal_code'] ?? '' }}</p>
                        <p>{{ $billing['country'] ?? '' }}</p>
                    </address>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection