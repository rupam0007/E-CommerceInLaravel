@extends('layouts.admin')

@section('title', 'Customers')

@section('content')
<p class="text-muted mb-4">View and manage registered customers</p>

<!-- Filters -->
<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('admin.customers.index') }}" class="row g-3">
            <div class="col-md-4">
                <label for="search" class="form-label small fw-medium">Search</label>
                <input type="text" id="search" name="search" class="form-control" value="{{ request('search') }}" placeholder="Name or email...">
            </div>
            <div class="col-md-3">
                <label for="date_from" class="form-label small fw-medium">From Date</label>
                <input type="date" id="date_from" name="date_from" class="form-control" value="{{ request('date_from') }}">
            </div>
            <div class="col-md-3">
                <label for="date_to" class="form-label small fw-medium">To Date</label>
                <input type="date" id="date_to" name="date_to" class="form-control" value="{{ request('date_to') }}">
            </div>
            <div class="col-md-2 d-flex align-items-end gap-2">
                <button type="submit" class="btn btn-primary flex-grow-1">Filter</button>
                <a href="{{ route('admin.customers.index') }}" class="btn btn-outline-secondary">Clear</a>
            </div>
        </form>
    </div>
</div>

<!-- Customers Table -->
<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>Customer</th>
                        <th>Email</th>
                        <th>Orders</th>
                        <th>Joined</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($customers as $customer)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                    <span class="text-primary fw-semibold">{{ strtoupper(substr($customer->name, 0, 1)) }}</span>
                                </div>
                                <span class="fw-medium">{{ $customer->name }}</span>
                            </div>
                        </td>
                        <td class="text-muted">{{ $customer->email }}</td>
                        <td>
                            <span class="badge bg-primary bg-opacity-10 text-primary">{{ $customer->orders_count }} orders</span>
                        </td>
                        <td class="text-muted small">{{ $customer->created_at->format('M d, Y') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-5">
                            <span class="material-icons text-muted mb-2" style="font-size: 48px;">people</span>
                            <p class="text-muted mb-0">No customers found</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($customers->hasPages())
    <div class="card-footer bg-white">
        {{ $customers->withQueryString()->links() }}
    </div>
    @endif
</div>
@endsection