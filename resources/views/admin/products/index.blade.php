@extends('layouts.admin')

@section('title', 'Manage Products')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Products</h1>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary" style="background-color: var(--accent-color); border-color: var(--accent-color);">
            <i class="fas fa-plus me-1"></i> Add Product
        </a>
    </div>

    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-dark table-hover mb-0">
                    <thead style="background-color: var(--hover-bg);">
                        <tr>
                            <th class="px-3 py-2">Name</th>
                            <th class="px-3 py-2">Category</th>
                            <th class="px-3 py-2">Price</th>
                            <th class="px-3 py-2">Discount</th>
                            <th class="px-3 py-2">Stock</th>
                            <th class="px-3 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                        <tr>
                            <td class="px-3 py-2 align-middle">{{ $product->name }}</td>
                            <td class="px-3 py-2 align-middle">{{ $product->category->name ?? '-' }}</td>
                            <td class="px-3 py-2 align-middle">
                                @if($product->has_discount)
                                    <span class="text-decoration-line-through text-muted">₹{{ number_format($product->price, 2) }}</span>
                                    <span class="text-success fw-bold d-block">₹{{ number_format($product->discount_price, 2) }}</span>
                                @else
                                    ₹{{ number_format($product->price, 2) }}
                                @endif
                            </td>
                            <td class="px-3 py-2 align-middle">
                                @if($product->has_discount)
                                    <span class="badge bg-success">{{ number_format($product->discount_percentage, 0) }}% OFF</span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td class="px-3 py-2 align-middle">{{ $product->stock_quantity }}</td>
                            <td class="px-3 py-2 align-middle">
                                <div class="d-flex gap-2">
                                    <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-outline-light">Edit</a>
                                    <form method="POST" action="{{ route('admin.products.destroy', $product) }}" onsubmit="return confirm('Delete this product?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">No products found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($products->hasPages())
        <div class="card-footer" style="background-color: var(--hover-bg);">
            {{ $products->links() }}
        </div>
        @endif
    </div>
</div>
@endsection