@extends('layouts.admin')

@section('title', 'Edit Product')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0">Edit: {{ $product->name }}</h6>
                @if($product->image)
                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="rounded" style="width: 40px; height: 40px; object-fit: cover;">
                @endif
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Product Name -->
                    <div class="mb-4">
                        <label for="name" class="form-label fw-medium">Product Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" 
                            class="form-control @error('name') is-invalid @enderror" 
                            placeholder="Enter product name" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="mb-4">
                        <label for="description" class="form-label fw-medium">Description <span class="text-danger">*</span></label>
                        <textarea name="description" id="description" rows="4" 
                            class="form-control @error('description') is-invalid @enderror" 
                            placeholder="Enter product description" required>{{ old('description', $product->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Price & Stock -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="price" class="form-label fw-medium">Price (₹) <span class="text-danger">*</span></label>
                            <input type="number" name="price" id="price" step="0.01" min="0" value="{{ old('price', $product->price) }}" 
                                class="form-control @error('price') is-invalid @enderror" 
                                placeholder="0.00" required>
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="stock_quantity" class="form-label fw-medium">Stock Quantity <span class="text-danger">*</span></label>
                            <input type="number" name="stock_quantity" id="stock_quantity" value="{{ old('stock_quantity', $product->stock_quantity) }}" 
                                class="form-control @error('stock_quantity') is-invalid @enderror" 
                                placeholder="0" required>
                            @error('stock_quantity')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Discount Section -->
                    <div class="mb-4 p-4 bg-light rounded border">
                        <div class="form-check mb-3">
                            <input type="checkbox" name="has_discount" id="has_discount" value="1" 
                                class="form-check-input" {{ old('has_discount', $product->has_discount) ? 'checked' : '' }}>
                            <label for="has_discount" class="form-check-label fw-medium">Enable Discount</label>
                        </div>
                        
                        <div id="discount-fields" class="{{ old('has_discount', $product->has_discount) ? '' : 'd-none' }}">
                            <label for="discount_percentage" class="form-label fw-medium">Discount Percentage (%)</label>
                            <input type="number" name="discount_percentage" id="discount_percentage" step="0.01" min="0" max="100" 
                                value="{{ old('discount_percentage', $product->discount_percentage ?? 0) }}" 
                                class="form-control @error('discount_percentage') is-invalid @enderror" 
                                placeholder="0.00">
                            @error('discount_percentage')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            
                            <div id="discount-preview" class="mt-3 p-3 bg-white rounded border">
                                <small class="text-muted">
                                    <strong>Original Price:</strong> ₹<span id="original-price-display">{{ $product->price }}</span><br>
                                    <strong>Discount:</strong> <span id="discount-amount-display">{{ $product->discount_percentage ?? 0 }}</span>%<br>
                                    <strong class="text-success">Final Price:</strong> ₹<span id="final-price-display">{{ $product->discount_price ?? $product->price }}</span>
                                </small>
                            </div>
                        </div>
                    </div>

                    <!-- Category & SKU -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="category_id" class="form-label fw-medium">Category <span class="text-danger">*</span></label>
                            <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                                <option value="">Select a category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="sku" class="form-label fw-medium">SKU</label>
                            <input type="text" name="sku" id="sku" value="{{ old('sku', $product->sku) }}" 
                                class="form-control @error('sku') is-invalid @enderror" 
                                placeholder="SKU123">
                            @error('sku')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Weight & Image -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="weight" class="form-label fw-medium">Weight (kg) <span class="text-muted small">(Optional)</span></label>
                            <input type="number" name="weight" id="weight" step="0.01" min="0" value="{{ old('weight', $product->weight) }}" 
                                class="form-control @error('weight') is-invalid @enderror" 
                                placeholder="0.00">
                            @error('weight')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="image" class="form-label fw-medium">Product Image <span class="text-muted small">(Optional)</span></label>
                            <input type="file" name="image" id="image" accept="image/*" 
                                class="form-control @error('image') is-invalid @enderror">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="d-flex gap-3 pt-4 border-top">
                        <button type="submit" class="btn btn-primary d-flex align-items-center gap-2">
                            <span class="material-icons" style="font-size: 18px;">save</span>
                            Update Product
                        </button>
                        <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const hasDiscountCheckbox = document.getElementById('has_discount');
    const discountFields = document.getElementById('discount-fields');
    const priceInput = document.getElementById('price');
    const discountPercentageInput = document.getElementById('discount_percentage');
    const discountPreview = document.getElementById('discount-preview');
    const originalPriceDisplay = document.getElementById('original-price-display');
    const discountAmountDisplay = document.getElementById('discount-amount-display');
    const finalPriceDisplay = document.getElementById('final-price-display');

    hasDiscountCheckbox.addEventListener('change', function() {
        if (this.checked) {
            discountFields.classList.remove('d-none');
            calculateDiscount();
        } else {
            discountFields.classList.add('d-none');
        }
    });

    function calculateDiscount() {
        const price = parseFloat(priceInput.value) || 0;
        const discountPercentage = parseFloat(discountPercentageInput.value) || 0;
        
        if (price > 0 && discountPercentage > 0) {
            const discountAmount = (price * discountPercentage) / 100;
            const finalPrice = price - discountAmount;
            
            originalPriceDisplay.textContent = price.toFixed(2);
            discountAmountDisplay.textContent = discountPercentage.toFixed(2);
            finalPriceDisplay.textContent = finalPrice.toFixed(2);
        }
    }

    priceInput.addEventListener('input', calculateDiscount);
    discountPercentageInput.addEventListener('input', calculateDiscount);
    
    if (hasDiscountCheckbox.checked) {
        calculateDiscount();
    }
});
</script>
@endsection