@extends('layouts.app')

@section('title', 'Admin • Create Product')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-white">Create Product</h1>
        <p class="text-sm text-gray-400">Add a new product to your catalog.</p>
    </div>

    <div class="bg-gray-900 rounded-md shadow-lg p-6">
        <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf

            
            <div>
                <label class="block text-sm font-medium text-gray-300">Name <span class="text-red-500">*</span></label>
                <input type="text" name="name" value="{{ old('name') }}" class="mt-1 block w-full border border-gray-700 bg-gray-800 text-white rounded px-3 py-2" required>
                @error('name')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
            </div>

            
            <div>
                <label class="block text-sm font-medium text-gray-300">Description <span class="text-red-500">*</span></label>
                <textarea name="description" rows="5" class="mt-1 block w-full border border-gray-700 bg-gray-800 text-white rounded px-3 py-2" required>{{ old('description') }}</textarea>
                @error('description')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <div>
                    <label class="block text-sm font-medium text-gray-300">Price (₹) <span class="text-red-500">*</span></label>
                    <input type="number" name="price" step="0.01" min="0" value="{{ old('price') }}" class="mt-1 block w-full border border-gray-700 bg-gray-800 text-white rounded px-3 py-2" required>
                    @error('price')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                </div>

                
                <div>
                    <label class="block text-sm font-medium text-gray-300">Stock Quantity <span class="text-red-500">*</span></label>
                    <input type="number" name="stock_quantity" min="0" value="{{ old('stock_quantity') }}" class="mt-1 block w-full border border-gray-700 bg-gray-800 text-white rounded px-3 py-2" required>
                    @error('stock_quantity')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <div>
                    <label class="block text-sm font-medium text-gray-300">Category <span class="text-red-500">*</span></label>
                    <select name="category_id" class="mt-1 block w-full border border-gray-700 bg-gray-800 text-white rounded px-3 py-2" required>
                        <option value="">Select a category</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}" @selected(old('category_id')==$category->id)>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                </div>

                
                <div>
                    <label class="block text-sm font-medium text-gray-300">SKU <span class="text-red-500">*</span></label>
                    <input type="text" name="sku" value="{{ old('sku') }}" class="mt-1 block w-full border border-gray-700 bg-gray-800 text-white rounded px-3 py-2" required>
                    @error('sku')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <div>
                    <label class="block text-sm font-medium text-gray-300">Weight (kg)</label>
                    <input type="number" name="weight" step="0.01" min="0" value="{{ old('weight') }}" class="mt-1 block w-full border border-gray-700 bg-gray-800 text-white rounded px-3 py-2">
                    @error('weight')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                </div>

                
                <div>
                    <label class="block text-sm font-medium text-gray-300">Image</label>
                    <input type="file" name="image" accept="image/*" class="mt-1 block w-full border border-gray-700 rounded px-3 py-2 text-gray-400">
                    @error('image')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="flex items-center gap-3">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-md">Create</button>
                <a href="{{ route('admin.products.index') }}" class="px-5 py-2.5 rounded-md border border-gray-700 text-gray-300 hover:bg-gray-800">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection