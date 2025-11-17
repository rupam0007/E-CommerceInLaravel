@extends('layouts.admin')

@section('title', 'Manage Orders')

@section('content')
<div class="container-fluid">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-3 mb-md-0">Orders (<span id="order-count">{{ $orders->total() }}</span>)</h1>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">Back to Dashboard</a>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <form id="filter-form">
                <div class="row g-3">
                    <div class="col-md-3">
                        <input type="text" name="search" class="form-control" placeholder="Search by Order # or Customer..." value="{{ request('search') }}">
                    </div>
                    <div class="col-md-3">
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
                        <select name="payment_status" class="form-select">
                            <option value="">All Payment Statuses</option>
                            <option value="pending" @selected(request('payment_status') == 'pending')>Pending</option>
                            <option value="completed" @selected(request('payment_status') == 'completed')>Completed</option>
                            <option value="failed" @selected(request('payment_status') == 'failed')>Failed</option>
                            <option value="refunded" @selected(request('payment_status') == 'refunded')>Refunded</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary w-100" style="background-color: var(--accent-color); border-color: var(--accent-color);">Filter</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div id="orders-container" class="card">
        <div class="card-body p-0">
            @include('admin.orders.partials.orders-table', ['orders' => $orders])
        </div>
    </div>

    <div id="pagination-container" class="mt-4">
        @include('admin.orders.partials.pagination', ['paginator' => $orders])
    </div>
</div>
@endsection