@php
    $statusColors = [
        'pending' => 'from-yellow-400 to-orange-500',
        'confirmed' => 'from-blue-500 to-indigo-600',
        'processing' => 'from-indigo-500 to-purple-600',
        'shipped' => 'from-purple-500 to-pink-600',
        'delivered' => 'from-green-500 to-emerald-600',
        'cancelled' => 'from-red-500 to-pink-600',
    ];

    $paymentStatusColors = [
        'pending' => 'from-yellow-400 to-orange-500',
        'completed' => 'from-green-500 to-emerald-600',
        'failed' => 'from-red-500 to-pink-600',
        'refunded' => 'from-gray-500 to-gray-700',
    ];
@endphp

<div class="overflow-x-auto">
<table class="w-full">
    <thead>
        <tr class="bg-gradient-to-r from-gray-700 to-gray-800">
            <th scope="col" class="text-left text-sm font-bold text-white px-6 py-4">Order</th>
            <th scope="col" class="text-left text-sm font-bold text-white px-6 py-4">Customer</th>
            <th scope="col" class="text-center text-sm font-bold text-white px-6 py-4">Status</th>
            <th scope="col" class="text-center text-sm font-bold text-white px-6 py-4">Payment</th>
            <th scope="col" class="text-right text-sm font-bold text-white px-6 py-4">Total</th>
            <th scope="col" class="text-right text-sm font-bold text-white px-6 py-4">Date</th>
            <th scope="col" class="text-center text-sm font-bold text-white px-6 py-4">Actions</th>
        </tr>
    </thead>
    <tbody class="divide-y divide-gray-200">
        @forelse($orders as $order)
            <tr class="hover:bg-blue-50 transition-colors">
                <td class="px-6 py-5">
                    <span class="font-mono font-bold text-blue-600">#{{ $order->order_number }}</span>
                </td>
                <td class="px-6 py-5">
                    <span class="font-semibold text-gray-900">{{ $order->user->name }}</span>
                </td>
                <td class="px-6 py-5 text-center">
                    <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold bg-gradient-to-r {{ $statusColors[$order->status] ?? 'from-gray-500 to-gray-700' }} text-white shadow-md">
                        {{ ucfirst($order->status) }}
                    </span>
                </td>
                <td class="px-6 py-5 text-center">
                    <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold bg-gradient-to-r {{ $paymentStatusColors[$order->payment_status] ?? 'from-gray-500 to-gray-700' }} text-white shadow-md">
                        {{ ucfirst($order->payment_status) }}
                    </span>
                </td>
                <td class="px-6 py-5 text-right">
                    <span class="font-mono font-extrabold text-gray-900 text-lg">₹{{ number_format($order->total_amount, 0) }}</span>
                </td>
                <td class="px-6 py-5 text-right">
                    <span class="text-gray-600 font-semibold text-sm">{{ $order->created_at->format('M d, Y') }}</span>
                </td>
                <td class="px-6 py-5 text-center">
                    <a href="{{ route('admin.orders.show', $order) }}" class="inline-flex items-center gap-1 px-4 py-2 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white rounded-lg font-bold text-sm shadow-lg hover:shadow-xl transition-all">
                        <span class="material-icons text-sm">visibility</span>
                        View
                    </a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="p-12 text-center">
                    <span class="material-icons text-gray-400 mb-3" style="font-size: 80px;">shopping_cart</span>
                    <p class="text-gray-600 font-semibold text-lg">No orders found</p>
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
</div>