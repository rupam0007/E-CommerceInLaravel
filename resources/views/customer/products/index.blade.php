@extends('layouts.app')

@section('title', $pageTitle . ' - Nexora')

@section('content')
<div class="bg-[#F5EFE6] dark:bg-gray-900 min-h-screen transition-colors duration-300 relative z-0">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16 relative z-0">
        
        {{-- Header Section --}}
        <div class="mb-10 text-center">
            <h1 class="text-4xl font-bold font-serif text-gray-900 dark:text-white transition-colors">
                {{ $pageTitle }}
            </h1>
            <p class="text-gray-600 dark:text-gray-400 mt-2 text-lg transition-colors">{{ $pageDescription }}</p>
        </div>

        <div class="flex flex-col lg:flex-row gap-8">
            
            {{-- Sidebar Filters --}}
            <div class="lg:w-1/4 space-y-8">
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm transition-colors">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Filters</h3>
                    
                    <form action="{{ route('products.index') }}" method="GET">
                        @if(request('search'))
                            <input type="hidden" name="search" value="{{ request('search') }}">
                        @endif

                        {{-- Category Filter --}}
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Category</label>
                            <select name="category" onchange="this.form.submit()" 
                                class="w-full px-3 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md text-gray-900 dark:text-white text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                <option value="">All Categories</option>
                                @foreach($categories as $cat)
                                    @php
                                        $isSelected = false;
                                        if (isset($currentCategory) && $currentCategory) {
                                            $isSelected = $currentCategory->id == $cat->id;
                                        } elseif (request('category')) {
                                            $isSelected = request('category') == $cat->id;
                                        }
                                    @endphp
                                    <option value="{{ $cat->id }}" {{ $isSelected ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Sort Filter --}}
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Sort By</label>
                            <select name="sort" onchange="this.form.submit()" 
                                class="w-full px-3 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md text-gray-900 dark:text-white text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest Arrivals</option>
                                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                            </select>
                        </div>

                        {{-- Reset Button --}}
                        <a href="{{ route('products.index') }}" class="block w-full text-center bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-900 dark:text-white py-2 px-4 rounded-md text-sm transition-colors border border-gray-300 dark:border-gray-600">
                            Clear Filters
                        </a>
                    </form>
                </div>
            </div>

            {{-- Main Product Grid --}}
            <div class="lg:w-3/4">
                {{-- Result Count --}}
                <div class="flex justify-between items-center mb-6">
                    <p class="text-gray-600 dark:text-gray-400 text-sm">
                        Showing <span class="font-medium text-gray-900 dark:text-white">{{ $products->firstItem() ?? 0 }}</span> to <span class="font-medium text-gray-900 dark:text-white">{{ $products->lastItem() ?? 0 }}</span> of <span class="font-medium text-gray-900 dark:text-white">{{ $products->total() }}</span> results
                    </p>
                </div>

                {{-- GRID FIX: Wrapper added here --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 relative z-0">
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

{{-- Quick View Modal --}}
<div id="quick-view-modal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
        {{-- Background overlay --}}
        <div class="fixed inset-0 bg-black bg-opacity-75 transition-opacity backdrop-blur-sm" aria-hidden="true"></div>

        {{-- Modal panel --}}
        <div class="relative inline-block bg-white dark:bg-gray-800 rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:max-w-4xl sm:w-full">
            {{-- Close button --}}
            <button type="button" class="absolute top-4 right-4 z-10 text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 transition-colors" onclick="closeQuickView()">
                <span class="material-icons text-3xl">close</span>
            </button>

            {{-- Modal content --}}
            <div id="quick-view-content" class="p-8">
                <div class="flex items-center justify-center h-64">
                    <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600"></div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Product Comparison Bar --}}
<div id="comparison-bar" class="fixed bottom-0 left-0 right-0 z-40 bg-gradient-to-r from-blue-600 to-indigo-600 shadow-2xl transform translate-y-full transition-transform duration-300 hidden">
    <div class="max-w-7xl mx-auto px-4 py-4">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <span class="text-white font-bold text-lg">Compare Products (<span id="compare-count">0</span>/3)</span>
                <div id="compared-products" class="flex gap-2"></div>
            </div>
            <div class="flex gap-3">
                <button onclick="openComparisonModal()" class="bg-white text-blue-600 px-6 py-2 rounded-lg font-bold hover:bg-blue-50 transition-colors disabled:opacity-50 disabled:cursor-not-allowed" id="compare-btn" disabled>
                    <span class="flex items-center gap-2">
                        <span class="material-icons">compare_arrows</span>
                        Compare Now
                    </span>
                </button>
                <button onclick="clearComparison()" class="bg-red-500 text-white px-4 py-2 rounded-lg font-bold hover:bg-red-600 transition-colors">
                    Clear All
                </button>
            </div>
        </div>
    </div>
</div>

{{-- Comparison Modal --}}
<div id="comparison-modal" class="fixed inset-0 z-50 hidden overflow-y-auto" role="dialog" aria-modal="true">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
        <div class="fixed inset-0 bg-black bg-opacity-75 transition-opacity backdrop-blur-sm" onclick="closeComparisonModal()"></div>
        
        <div class="relative inline-block bg-white dark:bg-gray-800 rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 w-full max-w-6xl">
            <div class="flex items-center justify-between p-6 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white">Product Comparison</h3>
                <button type="button" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200" onclick="closeComparisonModal()">
                    <span class="material-icons text-3xl">close</span>
                </button>
            </div>
            
            <div id="comparison-content" class="p-6 overflow-x-auto">
                <!-- Comparison table will be loaded here -->
            </div>
        </div>
    </div>
</div>
@endsection