@extends('layouts.admin')

@section('title', 'Products')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <p class="text-muted mb-0">Manage your product inventory</p>
    </div>
    <a href="{{ route('admin.products.create') }}" class="btn btn-primary d-flex align-items-center gap-2">
        <span class="material-icons" style="font-size: 18px;">add</span>
        Add Product
    </a>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Discount</th>
                        <th>Stock</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                @if($product->image)
                                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" 
                                         class="rounded" style="width: 40px; height: 40px; object-fit: cover;">
                                @else
                                    <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                                         style="width: 40px; height: 40px;">
                                        <span class="material-icons text-muted" style="font-size: 20px;">image</span>
                                    </div>
                                @endif
                                <span class="fw-medium">{{ Str::limit($product->name, 30) }}</span>
                            </div>
                        </td>
                        <td><span class="badge bg-light text-dark">{{ $product->category->name ?? '-' }}</span></td>
                        <td>
                            @if($product->has_discount)
                                <span class="text-decoration-line-through text-muted small">₹{{ number_format($product->price, 0) }}</span>
                                <span class="text-success fw-semibold d-block">₹{{ number_format($product->discount_price, 0) }}</span>
                            @else
                                <span class="fw-semibold">₹{{ number_format($product->price, 0) }}</span>
                            @endif
                        </td>
                        <td>
                            @if($product->has_discount)
                                <span class="badge bg-success">{{ number_format($product->discount_percentage, 0) }}% OFF</span>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>
                            @if($product->stock_quantity == 0)
                                <span class="badge bg-danger">Out of Stock</span>
                            @elseif($product->stock_quantity <= 5)
                                <span class="badge bg-warning text-dark">{{ $product->stock_quantity }} left</span>
                            @else
                                <span class="text-success fw-medium">{{ $product->stock_quantity }}</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.products.edit', $product) }}" 
                                   class="btn btn-sm btn-outline-primary d-flex align-items-center gap-1">
                                    <span class="material-icons" style="font-size: 16px;">edit</span>
                                    Edit
                                </a>
                                <form method="POST" action="{{ route('admin.products.destroy', $product) }}" 
                                      onsubmit="return confirm('Delete this product?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger d-flex align-items-center gap-1">
                                        <span class="material-icons" style="font-size: 16px;">delete</span>
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <span class="material-icons text-muted mb-2" style="font-size: 48px;">inventory_2</span>
                            <p class="text-muted mb-0">No products found. Add your first product!</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($products->hasPages())
    <div class="card-footer bg-white">
        {{ $products->links() }}
    </div>
    @endif
</div>
@endsection