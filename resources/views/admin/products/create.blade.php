@extends('layouts.app')

@section('title', 'Admin • Create Product')

@section('content')
<div class="bg-[#F5EFE6] min-h-screen">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {{-- Header --}}
        <div class="mb-8">
            <h1 class="text-4xl font-extrabold text-gray-900 mb-2">Create New Product</h1>
            <p class="text-gray-600 font-semibold">Add a new product to your catalog and start selling!</p>
        </div>

        <div class="bg-white rounded-2xl shadow-lg p-8">
            <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="space-y-6">
                    {{-- Product Name --}}
                    <div>
                        <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Product Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" 
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                            placeholder="Enter product name" required>
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Description --}}
                    <div>
                        <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">Description</label>
                        <textarea name="description" id="description" rows="4" 
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                            placeholder="Enter product description" required>{{ old('description') }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Price & Stock --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="price" class="block text-sm font-semibold text-gray-700 mb-2">Price (₹)</label>
                            <input type="number" name="price" id="price" step="0.01" min="0" value="{{ old('price') }}" 
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                placeholder="0.00" required>
                            @error('price')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="stock_quantity" class="block text-sm font-semibold text-gray-700 mb-2">Stock Quantity</label>
                            <input type="number" name="stock_quantity" id="stock_quantity" value="{{ old('stock_quantity') }}" 
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                placeholder="0" required>
                            @error('stock_quantity')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Category --}}
                    <div>
                        <label for="category_id" class="block text-sm font-semibold text-gray-700 mb-2">Category</label>
                        <select name="category_id" id="category_id" 
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                            <option value="">Select a category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Weight --}}
                    <div>
                        <label for="weight" class="block text-sm font-semibold text-gray-700 mb-2">Weight (kg) <span class="text-gray-500 text-xs">(Optional)</span></label>
                        <input type="number" name="weight" id="weight" step="0.01" min="0" value="{{ old('weight') }}" 
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                            placeholder="0.00">
                        @error('weight')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Image --}}
                    <div>
                        <label for="image" class="block text-sm font-semibold text-gray-700 mb-2">Product Image <span class="text-gray-500 text-xs">(Optional)</span></label>
                        <input type="file" name="image" id="image" accept="image/*" 
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        @error('image')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="flex items-center gap-4 mt-8 pt-6 border-t border-gray-200">
                    <button type="submit" 
                        class="flex-1 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-8 py-3.5 rounded-lg font-bold text-base shadow-lg hover:shadow-xl transform hover:scale-[1.02] transition-all duration-200 flex items-center justify-center gap-2">
                        <span class="material-icons text-xl">add_circle</span>
                        Create Product
                    </button>
                    <a href="{{ route('admin.products.index') }}" 
                        class="px-8 py-3.5 rounded-lg border-2 border-gray-300 hover:border-gray-400 font-semibold text-gray-700 hover:bg-gray-50 transition-all duration-200 flex items-center justify-center gap-2">
                        <span class="material-icons text-xl">close</span>
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection