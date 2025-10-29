@extends('layouts.app')

@section('title', 'Admin • Customers')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-semibold">Customers</h1>
    </div>

    {{-- Filters --}}
    <form method="GET" action="{{ route('admin.customers.index') }}" class="bg-white p-4 rounded-md shadow mb-6 grid grid-cols-1 md:grid-cols-4 gap-4">
        <div>
            <label class="block text-sm text-gray-600 mb-1">Search (name/email)</label>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="e.g. john or john@email.com"
                   class="w-full border rounded px-3 py-2" />
        </div>
        <div>
            <label class="block text-sm text-gray-600 mb-1">Date From</label>
            <input type="date" name="date_from" value="{{ request('date_from') }}" class="w-full border rounded px-3 py-2" />
        </div>
        <div>
            <label class="block text-sm text-gray-600 mb-1">Date To</label>
            <input type="date" name="date_to" value="{{ request('date_to') }}" class="w-full border rounded px-3 py-2" />
        </div>
        <div class="flex items-end gap-2">
            <button type="submit" class="bg-gray-900 hover:bg-black text-white px-4 py-2 rounded-md">Apply</button>
            <a href="{{ route('admin.customers.index') }}" class="px-4 py-2 rounded-md border">Clear</a>
        </div>
    </form>

    {{-- Table --}}
    <div class="bg-white rounded-md shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Orders</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($customers as $customer)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $customer->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $customer->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $customer->orders_count }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $customer->created_at->format('Y-m-d') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-8 text-center text-gray-500">No customers found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t bg-gray-50">
            {{ $customers->withQueryString()->links() }}
        </div>
    </div>
</div>
@endsection
