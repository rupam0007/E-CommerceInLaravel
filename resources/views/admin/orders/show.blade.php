@extends('layouts.admin')

@section('title', 'Order ' . $order->order_number)

@php
    $statusColors = [
        'pending' => 'bg-warning',
        'confirmed' => 'bg-info',
        'processing' => 'bg-primary',
        'shipped' => 'bg-secondary',
        'delivered' => 'bg-success',
        'cancelled' => 'bg-danger',
    ];

    $paymentStatusColors = [
        'pending' => 'bg-warning',
        'completed' => 'bg-success',
        'failed' => 'bg-danger',
        'refunded' => 'bg-secondary',
    ];
@endphp

@section('content')
<div class="mb-3">
    <a href="{{ route('admin.orders.index') }}" class="text-decoration-none text-secondary d-inline-flex align-items-center gap-1">
        <span class="material-icons" style="font-size: 18px;">arrow_back</span>
        Back to Orders
    </a>
</div>

<!-- Order Header -->
<div class="card mb-4">
    <div class="card-body">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h4 class="mb-1">Order #<span class="text-primary">{{ $order->order_number }}</span></h4>
                <p class="text-muted mb-0 small">Placed on {{ $order->created_at->format('F d, Y \a\t h:i A') }}</p>
            </div>
            <div class="col-md-6 text-md-end mt-3 mt-md-0">
                <span class="badge {{ $statusColors[$order->status] ?? 'bg-secondary' }} px-3 py-2">
                    {{ ucfirst($order->status) }}
                </span>
            </div>
        </div>
        
        <hr class="my-4">
        
        <div class="row align-items-center">
            <div class="col-md-6 d-flex align-items-center gap-4">
                <div>
                    <small class="text-muted d-block">Payment Method</small>
                    <strong>{{ strtoupper($order->payment_method) }}</strong>
                </div>
                <div class="vr" style="height: 32px;"></div>
                <div>
                    <small class="text-muted d-block">Payment Status</small>
                    <span class="badge {{ $paymentStatusColors[$order->payment_status] ?? 'bg-secondary' }}">
                        {{ ucfirst($order->payment_status) }}
                    </span>
                </div>
            </div>
            <div class="col-md-6 mt-3 mt-md-0">
                <form action="{{ route('admin.orders.update-status', $order->id) }}" method="POST" class="d-flex justify-content-md-end align-items-center gap-2">
                    @csrf
                    @method('PATCH')
                    <select name="status" class="form-select form-select-sm" style="width: auto;" required>
                        @foreach(['pending', 'confirmed', 'processing', 'shipped', 'delivered', 'cancelled'] as $status)
                        <option value="{{ $status }}" @selected($order->status == $status)>{{ ucfirst($status) }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-primary btn-sm">Update Status</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Order Items -->
    <div class="col-lg-8 mb-4">
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0">Order Items</h6>
            </div>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Product</th>
                            <th class="text-center">Quantity</th>
                            <th class="text-end">Price</th>
                            <th class="text-end">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->orderItems as $item)
                        <tr>
                            <td class="py-3">
                                <div class="d-flex align-items-center gap-3">
                                    @if($item->product->image)
                                        <img src="{{ $item->product->image_url }}" alt="{{ $item->product->name }}" class="rounded" style="width: 50px; height: 50px; object-fit: cover;">
                                    @else
                                        <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                            <span class="material-icons text-muted">image</span>
                                        </div>
                                    @endif
                                    <div>
                                        <p class="mb-0 fw-medium">{{ $item->product->name }}</p>
                                        <small class="text-muted">SKU: {{ $item->product->sku }}</small>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center py-3">x {{ $item->quantity }}</td>
                            <td class="text-end py-3">₹{{ number_format($item->price, 2) }}</td>
                            <td class="text-end py-3 fw-medium">₹{{ number_format($item->price * $item->quantity, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Order Summary -->
            <div class="card-footer bg-light">
                <div class="d-flex justify-content-end">
                    <div style="width: 250px;">
                        <div class="d-flex justify-content-between text-muted small mb-2">
                            <span>Subtotal</span>
                            <span>₹{{ number_format($order->orderItems->sum(fn($item) => $item->price * $item->quantity), 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between text-muted small mb-2">
                            <span>Shipping</span>
                            <span>₹0.00</span>
                        </div>
                        <div class="d-flex justify-content-between text-muted small mb-2">
                            <span>Tax</span>
                            <span>₹0.00</span>
                        </div>
                        <hr class="my-2">
                        <div class="d-flex justify-content-between fw-bold">
                            <span>Total</span>
                            <span>₹{{ number_format($order->total_amount, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        @if($order->notes)
        <div class="card mt-4">
            <div class="card-header">
                <h6 class="mb-0">Order Notes</h6>
            </div>
            <div class="card-body">
                <p class="text-muted fst-italic mb-0">"{{ $order->notes }}"</p>
            </div>
        </div>
        @endif
    </div>
    
    <!-- Customer & Address Info -->
    <div class="col-lg-4">
        <div class="card mb-4">
            <div class="card-header">
                <h6 class="mb-0">Customer Details</h6>
            </div>
            <div class="card-body">
                <p class="fw-medium mb-1">{{ $order->user->name }}</p>
                <a href="mailto:{{ $order->user->email }}" class="text-primary small">{{ $order->user->email }}</a>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <h6 class="mb-0">Shipping Address</h6>
            </div>
            <div class="card-body">
                @php $shipping = json_decode($order->shipping_address, true); @endphp
                <address class="mb-0 small">
                    <strong>{{ $shipping['first_name'] ?? '' }} {{ $shipping['last_name'] ?? '' }}</strong><br>
                    {{ $shipping['address'] ?? '' }}<br>
                    {{ $shipping['city'] ?? '' }}, {{ $shipping['state'] ?? '' }} - {{ $shipping['postal_code'] ?? '' }}<br>
                    {{ $shipping['country'] ?? '' }}
                </address>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h6 class="mb-0">Billing Address</h6>
            </div>
            <div class="card-body">
                @if($order->shipping_address == $order->billing_address)
                    <p class="text-muted fst-italic small mb-0">Same as shipping address</p>
                @else
                    @php $billing = json_decode($order->billing_address, true); @endphp
                    <address class="mb-0 small">
                        <strong>{{ $billing['first_name'] ?? '' }} {{ $billing['last_name'] ?? '' }}</strong><br>
                        {{ $billing['address'] ?? '' }}<br>
                        {{ $billing['city'] ?? '' }}, {{ $billing['state'] ?? '' }} - {{ $billing['postal_code'] ?? '' }}<br>
                        {{ $billing['country'] ?? '' }}
                    </address>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection