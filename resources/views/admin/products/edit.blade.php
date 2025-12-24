@extends('layouts.app')

@section('title', 'Admin • Edit Product')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Edit Product</h1>
        <p class="text-gray-600 mt-2">Update your product information</p>
    </div>

    <div class="bg-white shadow-xl rounded-xl border border-gray-200">
        <div class="p-8">
            <form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Product Name --}}
                    <div class="md:col-span-2">
                        <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Product Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" 
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                            placeholder="Enter product name" required>
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Description --}}
                    <div class="md:col-span-2">
                        <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">Description</label>
                        <textarea name="description" id="description" rows="4" 
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                            placeholder="Describe your product" required>{{ old('description', $product->description) }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Price & Stock --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="price" class="block text-sm font-semibold text-gray-700 mb-2">Price (₹)</label>
                        <input type="number" name="price" id="price" step="0.01" min="0" value="{{ old('price', $product->price) }}" 
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                            placeholder="0.00" required>
                        @error('price')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="stock_quantity" class="block text-sm font-semibold text-gray-700 mb-2">Stock Quantity</label>
                        <input type="number" name="stock_quantity" id="stock_quantity" value="{{ old('stock_quantity', $product->stock_quantity) }}" 
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                            placeholder="0" required>
                        @error('stock_quantity')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Discount Section --}}
                <div class="bg-indigo-50 dark:bg-indigo-900/20 p-6 rounded-lg border-2 border-indigo-200 dark:border-indigo-800">
                    <div class="flex items-center mb-4">
                        <input type="checkbox" name="has_discount" id="has_discount" value="1" 
                            class="w-5 h-5 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500" 
                            {{ old('has_discount', $product->has_discount) ? 'checked' : '' }}>
                        <label for="has_discount" class="ml-3 text-sm font-semibold text-gray-700">Enable Discount</label>
                    </div>
                    
                    <div id="discount-fields" class="{{ old('has_discount', $product->has_discount) ? '' : 'hidden' }}">
                        <label for="discount_percentage" class="block text-sm font-semibold text-gray-700 mb-2">Discount Percentage (%)</label>
                        <input type="number" name="discount_percentage" id="discount_percentage" step="0.01" min="0" max="100" 
                            value="{{ old('discount_percentage', $product->discount_percentage ?? 0) }}" 
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" 
                            placeholder="0.00">
                        @error('discount_percentage')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        
                        <div id="discount-preview" class="mt-3 p-3 bg-white rounded-lg border border-indigo-200">
                            <p class="text-sm text-gray-600">
                                <span class="font-semibold">Original Price:</span> ₹<span id="original-price-display">{{ $product->price }}</span><br>
                                <span class="font-semibold">Discount:</span> <span id="discount-amount-display">{{ $product->discount_percentage ?? 0 }}</span>%<br>
                                <span class="font-semibold text-green-600">Final Price:</span> ₹<span id="final-price-display">{{ $product->discount_price ?? $product->price }}</span>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Category --}}
                    <div>
                        <label for="category_id" class="block text-sm font-semibold text-gray-700 mb-2">Category</label>
                        <select name="category_id" id="category_id" 
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                            required>
                            <option value="">Select a category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- SKU --}}
                    <div>
                        <label for="sku" class="block text-sm font-semibold text-gray-700 mb-2">SKU</label>
                        <input type="text" name="sku" id="sku" value="{{ old('sku', $product->sku) }}" 
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                            placeholder="SKU123" required>
                        @error('sku')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Weight --}}
                    <div>
                        <label for="weight" class="block text-sm font-semibold text-gray-700 mb-2">Weight (kg)</label>
                        <input type="number" name="weight" id="weight" step="0.01" min="0" value="{{ old('weight', $product->weight) }}" 
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                            placeholder="0.00">
                        @error('weight')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Image --}}
                    <div>
                        <label for="image" class="block text-sm font-semibold text-gray-700 mb-2">Product Image</label>
                        <input type="file" name="image" id="image" accept="image/*" 
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        @error('image')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        @if($product->image)
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="h-20 w-20 object-cover rounded-lg border border-gray-200">
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Buttons --}}
                <div class="flex items-center justify-end gap-3 pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.products.index') }}" 
                        class="px-6 py-2.5 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 font-medium">
                        Cancel
                    </a>
                    <button type="submit" 
                        class="px-6 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium">
                        Update Product
                    </button>
                </div>
            </form>
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

    // Toggle discount fields
    hasDiscountCheckbox.addEventListener('change', function() {
        if (this.checked) {
            discountFields.classList.remove('hidden');
            calculateDiscount();
        } else {
            discountFields.classList.add('hidden');
        }
    });

    // Calculate discount on input changes
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
    
    // Initial calculation if discount is already enabled
    if (hasDiscountCheckbox.checked) {
        calculateDiscount();
    }
});
</script>

@endsection