@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<p class="text-muted mb-4">Welcome back! Here's your store overview.</p>

<!-- Stats Cards -->
<div class="row g-4 mb-4">
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="d-flex align-items-center">
                <div class="stat-icon bg-primary bg-opacity-10">
                    <span class="material-icons text-primary">shopping_bag</span>
                </div>
                <div class="ms-3">
                    <p class="mb-0 text-muted small">Total Orders</p>
                    <h3 class="mb-0 fw-bold">{{ number_format($stats['total_orders']) }}</h3>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="d-flex align-items-center">
                <div class="stat-icon bg-success bg-opacity-10">
                    <span class="material-icons text-success">payments</span>
                </div>
                <div class="ms-3">
                    <p class="mb-0 text-muted small">Revenue</p>
                    <h3 class="mb-0 fw-bold">₹{{ number_format($stats['total_revenue'], 0) }}</h3>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="d-flex align-items-center">
                <div class="stat-icon bg-info bg-opacity-10">
                    <span class="material-icons text-info">inventory_2</span>
                </div>
                <div class="ms-3">
                    <p class="mb-0 text-muted small">Products</p>
                    <h3 class="mb-0 fw-bold">{{ number_format($stats['total_products']) }}</h3>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="d-flex align-items-center">
                <div class="stat-icon bg-warning bg-opacity-10">
                    <span class="material-icons text-warning">people</span>
                </div>
                <div class="ms-3">
                    <p class="mb-0 text-muted small">Customers</p>
                    <h3 class="mb-0 fw-bold">{{ number_format($stats['total_customers']) }}</h3>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Recent Orders -->
    <div class="col-12 col-xl-7">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0">Recent Orders</h6>
                <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-primary">View All</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Order</th>
                                <th>Customer</th>
                                <th>Amount</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recent_orders as $order)
                            <tr>
                                <td>
                                    <a href="{{ route('admin.orders.show', $order) }}" class="fw-medium text-decoration-none">#{{ $order->id }}</a>
                                    <small class="d-block text-muted">{{ $order->created_at->diffForHumans() }}</small>
                                </td>
                                <td>{{ $order->user->name }}</td>
                                <td class="fw-semibold">₹{{ number_format($order->total_amount, 0) }}</td>
                                <td>
                                    @php
                                    $statusColors = [
                                        'pending' => 'warning',
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
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-4 text-muted">
                                    <span class="material-icons mb-2" style="font-size: 32px;">shopping_cart</span>
                                    <p class="mb-0">No orders yet</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Low Stock Alert -->
    <div class="col-12 col-xl-5">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0">
                    <span class="material-icons text-warning me-1" style="font-size: 18px; vertical-align: middle;">warning</span>
                    Low Stock
                </h6>
                <a href="{{ route('admin.products.index') }}" class="btn btn-sm btn-outline-primary">Manage</a>
            </div>
            <div class="card-body p-0">
                <div class="list-group list-group-flush">
                    @forelse($low_stock_products as $product)
                    <div class="list-group-item d-flex align-items-center gap-3">
                        @if($product->image)
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" 
                                 class="rounded" style="width: 40px; height: 40px; object-fit: cover;">
                        @else
                            <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                                 style="width: 40px; height: 40px;">
                                <span class="material-icons text-muted" style="font-size: 20px;">image</span>
                            </div>
                        @endif
                        <div class="flex-grow-1">
                            <h6 class="mb-0 fw-medium" style="font-size: 0.9rem;">{{ Str::limit($product->name, 25) }}</h6>
                            <small class="text-muted">{{ $product->category->name ?? 'Uncategorized' }}</small>
                        </div>
                        <span class="badge {{ $product->stock_quantity == 0 ? 'bg-danger' : 'bg-warning text-dark' }}">
                            {{ $product->stock_quantity }} left
                        </span>
                    </div>
                    @empty
                    <div class="list-group-item text-center py-4 text-muted">
                        <span class="material-icons mb-2" style="font-size: 32px;">check_circle</span>
                        <p class="mb-0">All products well stocked</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection