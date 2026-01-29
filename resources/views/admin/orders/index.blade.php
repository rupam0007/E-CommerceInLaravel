@extends('layouts.admin')

@section('title', 'Orders')

@section('content')
<p class="text-muted mb-4">Manage customer orders</p>

<!-- Filters -->
<div class="card mb-4">
    <div class="card-body">
        <form id="filter-form" class="row g-3">
            <div class="col-md-4">
                <label class="form-label small fw-medium">Search</label>
                <input type="text" name="search" class="form-control" placeholder="Order # or Customer..." value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <label class="form-label small fw-medium">Order Status</label>
                <select name="status" class="form-select">
                    <option value="">All Statuses</option>
                    <option value="pending" @selected(request('status') == 'pending')>Pending</option>
                    <option value="confirmed" @selected(request('status') == 'confirmed')>Confirmed</option>
                    <option value="processing" @selected(request('status') == 'processing')>Processing</option>
                    <option value="shipped" @selected(request('status') == 'shipped')>Shipped</option>
                    <option value="delivered" @selected(request('status') == 'delivered')>Delivered</option>
                    <option value="cancelled" @selected(request('status') == 'cancelled')>Cancelled</option>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label small fw-medium">Payment Status</label>
                <select name="payment_status" class="form-select">
                    <option value="">All Payment Statuses</option>
                    <option value="pending" @selected(request('payment_status') == 'pending')>Pending</option>
                    <option value="completed" @selected(request('payment_status') == 'completed')>Completed</option>
                    <option value="failed" @selected(request('payment_status') == 'failed')>Failed</option>
                    <option value="refunded" @selected(request('payment_status') == 'refunded')>Refunded</option>
                </select>
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100 d-flex align-items-center justify-content-center gap-2">
                    <span class="material-icons" style="font-size: 18px;">search</span>
                    Filter
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Orders Table -->
<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>Order</th>
                        <th>Customer</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Payment</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                    <tr>
                        <td>
                            <a href="{{ route('admin.orders.show', $order) }}" class="fw-medium text-decoration-none">#{{ $order->id }}</a>
                        </td>
                        <td>{{ $order->user->name ?? 'N/A' }}</td>
                        <td class="fw-semibold">₹{{ number_format($order->total_amount, 0) }}</td>
                        <td>
                            @php
                            $statusColors = [
                                'pending' => 'warning',
                                'confirmed' => 'info',
                                'processing' => 'info',
                                'shipped' => 'primary',
                                'delivered' => 'success',
                                'cancelled' => 'danger'
                            ];
                            @endphp
                            <span class="badge bg-{{ $statusColors[$order->status] ?? 'secondary' }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                        <td>
                            @php
                            $paymentColors = [
                                'pending' => 'warning',
                                'completed' => 'success',
                                'failed' => 'danger',
                                'refunded' => 'secondary'
                            ];
                            @endphp
                            <span class="badge bg-{{ $paymentColors[$order->payment_status] ?? 'secondary' }}">
                                {{ ucfirst($order->payment_status ?? 'pending') }}
                            </span>
                        </td>
                        <td class="text-muted small">{{ $order->created_at->format('M d, Y') }}</td>
                        <td>
                            <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-sm btn-outline-primary d-flex align-items-center gap-1" style="width: fit-content;">
                                <span class="material-icons" style="font-size: 16px;">visibility</span>
                                View
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5">
                            <span class="material-icons text-muted mb-2" style="font-size: 48px;">shopping_bag</span>
                            <p class="text-muted mb-0">No orders found</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($orders->hasPages())
    <div class="card-footer bg-white">
        {{ $orders->withQueryString()->links() }}
    </div>
    @endif
</div>
@endsection