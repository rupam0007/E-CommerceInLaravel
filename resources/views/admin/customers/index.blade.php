@extends('layouts.admin')

@section('title', 'Manage Customers')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4">Customers</h1>

    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.customers.index') }}">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label for="search" class="form-label">Search (name/email)</label>
                        <input type="text" id="search" name="search" class="form-control" value="{{ request('search') }}" placeholder="e.g. john or john@email.com">
                    </div>
                    <div class="col-md-3">
                        <label for="date_from" class="form-label">Date From</label>
                        <input type="date" id="date_from" name="date_from" class="form-control" value="{{ request('date_from') }}">
                    </div>
                    <div class="col-md-3">
                        <label for="date_to" class="form-label">Date To</label>
                        <input type="date" id="date_to" name="date_to" class="form-control" value="{{ request('date_to') }}">
                    </div>
                    <div class="col-md-3 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary me-2" style="background-color: var(--accent-color); border-color: var(--accent-color);">Apply</button>
                        <a href="{{ route('admin.customers.index') }}" class="btn btn-outline-secondary">Clear</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-dark table-hover mb-0">
                    <thead style="background-color: var(--hover-bg);">
                        <tr>
                            <th class="px-3 py-2">Name</th>
                            <th class="px-3 py-2">Email</th>
                            <th class="px-3 py-2">Orders</th>
                            <th class="px-3 py-2">Created</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($customers as $customer)
                        <tr>
                            <td class="px-3 py-2">{{ $customer->name }}</td>
                            <td class="px-3 py-2">{{ $customer->email }}</td>
                            <td class="px-3 py-2">{{ $customer->orders_count }}</td>
                            <td class="px-3 py-2">{{ $customer->created_at->format('Y-m-d') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-4">No customers found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($customers->hasPages())
        <div class="card-footer" style="background-color: var(--hover-bg);">
            {{ $customers->withQueryString()->links() }}
        </div>
        @endif
    </div>
</div>
@endsection