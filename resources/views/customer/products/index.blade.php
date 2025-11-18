@extends('layouts.app')

@section('title', $pageTitle . ' - Nexora')

@section('content')
<div class="bg-gray-900 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16">
        
        {{-- Header Section --}}
        <div class="mb-10 text-center">
            <h1 class="text-4xl font-bold font-serif text-white">
                {{ $pageTitle }}
            </h1>
            <p class="text-gray-400 mt-2 text-lg">{{ $pageDescription }}</p>
        </div>

        <div class="flex flex-col lg:flex-row gap-8">
            
            {{-- Sidebar Filters --}}
            <div class="lg:w-1/4 space-y-8">
                <div class="bg-gray-800 p-6 rounded-lg border border-gray-700 shadow-sm">
                    <h3 class="text-lg font-semibold text-white mb-4">Filters</h3>
                    
                    <form action="{{ route('products.index') }}" method="GET">
                        @if(request('search'))
                            <input type="hidden" name="search" value="{{ request('search') }}">
                        @endif

                        {{-- Category Filter --}}
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-300 mb-2">Category</label>
                            <select name="category" onchange="this.form.submit()" 
                                class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-white text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="">All Categories</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ (request('category') == $cat->id || (isset($currentCategory) && $currentCategory && $currentCategory->id == $cat->id)) ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Sort Filter --}}
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-300 mb-2">Sort By</label>
                            <select name="sort" onchange="this.form.submit()" 
                                class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-white text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest Arrivals</option>
                                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                            </select>
                        </div>

                        {{-- Reset Button --}}
                        <a href="{{ route('products.index') }}" class="block w-full text-center bg-gray-700 hover:bg-gray-600 text-white py-2 px-4 rounded-md text-sm transition-colors border border-gray-600">
                            Clear Filters
                        </a>
                    </form>
                </div>
            </div>

            {{-- Main Product Grid --}}
            <div class="lg:w-3/4">
                {{-- Result Count --}}
                <div class="flex justify-between items-center mb-6">
                    <p class="text-gray-400 text-sm">
                        Showing <span class="font-medium text-white">{{ $products->firstItem() ?? 0 }}</span> to <span class="font-medium text-white">{{ $products->lastItem() ?? 0 }}</span> of <span class="font-medium text-white">{{ $products->total() }}</span> results
                    </p>
                </div>

                {{-- GRID FIX: Wrapper added here --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @include('customer.products.partials.products-grid', ['products' => $products])
                </div>

                {{-- Pagination --}}
                <div class="mt-10">
                    {{ $products->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection