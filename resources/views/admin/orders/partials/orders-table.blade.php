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

<table class="w-full min-w-max">
    <thead class="bg-gray-900">
        <tr>
            <th scope="col" class="text-left text-sm font-medium text-gray-400 px-6 py-3">Order</th>
            <th scope="col" class="text-left text-sm font-medium text-gray-400 px-6 py-3">Customer</th>
            <th scope="col" class="text-center text-sm font-medium text-gray-400 px-6 py-3">Status</th>
            <th scope="col" class="text-center text-sm font-medium text-gray-400 px-6 py-3">Payment</th>
            <th scope="col" class="text-right text-sm font-medium text-gray-400 px-6 py-3">Total</th>
            <th scope="col" class="text-right text-sm font-medium text-gray-400 px-6 py-3">Date</th>
            <th scope="col" class="text-right text-sm font-medium text-gray-400 px-6 py-3"></th>
        </tr>
    </thead>
    <tbody class="divide-y divide-gray-700">
        @forelse($orders as $order)
            <tr class="text-white hover:bg-gray-700/50 transition-colors">
                <td class="px-6 py-4 font-mono font-medium text-indigo-400">#{{ $order->order_number }}</td>
                <td class="px-6 py-4">{{ $order->user->name }}</td>
                <td class="px-6 py-4 text-center">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border {{ $statusColors[$order->status] ?? 'bg-gray-200 text-gray-800 border-gray-300' }}">
                        {{ ucfirst($order->status) }}
                    </span>
                </td>
                <td class="px-6 py-4 text-center">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border {{ $paymentStatusColors[$order->payment_status] ?? 'bg-gray-200 text-gray-800 border-gray-300' }}">
                        {{ ucfirst($order->payment_status) }}
                    </span>
                </td>
                <td class="px-6 py-4 text-right font-mono font-medium">₹{{ number_format($order->total_amount, 2) }}</td>
                <td class="px-6 py-4 text-right text-gray-400 text-sm">{{ $order->created_at->format('M d, Y') }}</td>
                <td class="px-6 py-4 text-right">
                    <a href="{{ route('admin.orders.show', $order) }}" class="text-indigo-400 hover:text-indigo-300 text-sm font-medium">View</a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="p-6 text-center text-gray-400">
                    No orders found.
                </td>
            </tr>
        @endforelse
    </tbody>
</table>