@extends('layouts.app')

@section('title', 'Admin • Reports')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-semibold">Reports</h1>
        <form method="GET" class="flex items-center gap-2">
            <label for="period" class="text-sm text-gray-600">Period (days)</label>
            <select id="period" name="period" class="border rounded-md px-3 py-2">
                @foreach([7,14,30,60,90,180,365] as $p)
                    <option value="{{ $p }}" @selected((string)$period === (string)$p)>{{ $p }}</option>
                @endforeach
            </select>
            <button type="submit" class="bg-gray-900 hover:bg-black text-white px-4 py-2 rounded-md">Apply</button>
        </form>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-md shadow p-4">
            <div class="text-sm text-gray-500">Total Revenue</div>
            <div class="text-2xl font-semibold">₹{{ number_format($salesData['total_revenue'] ?? 0, 2) }}</div>
        </div>
        <div class="bg-white rounded-md shadow p-4">
            <div class="text-sm text-gray-500">Total Orders</div>
            <div class="text-2xl font-semibold">{{ $salesData['total_orders'] ?? 0 }}</div>
        </div>
        <div class="bg-white rounded-md shadow p-4">
            <div class="text-sm text-gray-500">Avg Order Value</div>
            <div class="text-2xl font-semibold">₹{{ number_format($salesData['avg_order_value'] ?? 0, 2) }}</div>
        </div>
        <div class="bg-white rounded-md shadow p-4">
            <div class="text-sm text-gray-500">New Customers</div>
            <div class="text-2xl font-semibold">{{ $newCustomers ?? 0 }}</div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white rounded-md shadow overflow-hidden">
            <div class="px-4 py-3 border-b bg-gray-50 font-medium">Top Selling Products</div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sold</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($topProducts as $item)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $item->product->name ?? 'N/A' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $item->product->category->name ?? '-' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $item->total_sold ?? 0 }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-8 text-center text-gray-500">No data for selected period.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="bg-white rounded-md shadow overflow-hidden">
            <div class="px-4 py-3 border-b bg-gray-50 font-medium">Order Status Distribution</div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Count</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($orderStatusData as $row)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ ucfirst($row->status) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $row->count }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="px-6 py-8 text-center text-gray-500">No data for selected period.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-md shadow overflow-hidden mt-6">
        <div class="px-4 py-3 border-b bg-gray-50 font-medium">Daily Revenue</div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Orders</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Revenue</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($dailyRevenue as $day)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ \Carbon\Carbon::parse($day->date)->format('d M Y') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $day->orders }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">₹{{ number_format($day->revenue, 2) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-8 text-center text-gray-500">No data for selected period.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
