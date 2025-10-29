@extends('layouts.app')

@section('title', 'Products - Nexora')

@section('content')
<div class="bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        {{-- Page Header --}}
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900" style="font-family: 'Crimson Text', serif;">
                Products
            </h1>
            <p class="text-gray-600 mt-2">Discover our amazing collection of products</p>
        </div>

        <div class="flex flex-col lg:flex-row gap-8">
            
            {{-- Filters Sidebar --}}
            <div class="lg:w-1/4">
                <div class="bg-gray-50 rounded-lg p-6 sticky top-24">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Filters</h3>
                    
                    <form method="GET" action="{{ route('products.index') }}" id="filterForm">
                        {{-- Search --}}
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Search</label>
                            <input type="text" name="search" value="{{ request('search') }}" 
                                   placeholder="Search products..." 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        </div>

                        {{-- Category Filter --}}
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                            <select name="category" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                <option value="">All Categories</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Price Range --}}
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Price Range</label>
                            <div class="flex gap-2">
                                <input type="number" name="min_price" value="{{ request('min_price') }}" 
                                       placeholder="Min" step="0.01"
                                       class="w-1/2 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                <input type="number" name="max_price" value="{{ request('max_price') }}" 
                                       placeholder="Max" step="0.01"
                                       class="w-1/2 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            </div>
                            @if($priceRange)
                                <p class="text-xs text-gray-500 mt-1">
                                    Range: ${{ number_format($priceRange->min_price, 2) }} - ${{ number_format($priceRange->max_price, 2) }}
                                </p>
                            @endif
                        </div>

                        {{-- Stock Filter --}}
                        <div class="mb-6">
                            <label class="flex items-center">
                                <input type="checkbox" name="in_stock" value="1" {{ request('in_stock') ? 'checked' : '' }}
                                       class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                <span class="ml-2 text-sm text-gray-700">In Stock Only</span>
                            </label>
                        </div>

                        <div class="flex gap-2">
                            <button type="submit" class="flex-1 bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition-colors">
                                Apply Filters
                            </button>
                            <a href="{{ route('products.index') }}" class="flex-1 bg-gray-300 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-400 transition-colors text-center">
                                Clear
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Products Grid --}}
            <div class="lg:w-3/4">
                
                {{-- Sort Options --}}
                <div class="flex justify-between items-center mb-6">
                    <p class="text-gray-600" id="products-count">
                        Showing {{ $products->firstItem() ?? 0 }} - {{ $products->lastItem() ?? 0 }} of {{ $products->total() }} products
                    </p>
                    
                    <div class="flex items-center gap-2">
                        <label class="text-sm text-gray-700">Sort by:</label>
                        <select name="sort" id="sortSelect"
                                class="px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Name</option>
                            <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                            <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest First</option>
                        </select>
                    </div>
                </div>

                {{-- Products Grid --}}
                <div id="products-container">
                    @include('customer.products.partials.products-grid', ['products' => $products])
                </div>

                {{-- Pagination --}}
                <div class="mt-8" id="pagination-container">
                    @include('customer.products.partials.pagination', ['products' => $products])
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    let filterTimeout;
    
    // Handle filter form submission
    $('#filterForm').on('submit', function(e) {
        e.preventDefault();
        applyFilters();
    });
    
    // Handle real-time filtering on input changes
    $('#filterForm input, #filterForm select').on('input change', function() {
        clearTimeout(filterTimeout);
        filterTimeout = setTimeout(function() {
            applyFilters();
        }, 500); // Debounce for 500ms
    });
    
    // Handle sort change
    $('#sortSelect').on('change', function() {
        applyFilters();
    });
    
    // Handle pagination clicks
    $(document).on('click', '#pagination-container .pagination a', function(e) {
        e.preventDefault();
        let url = $(this).attr('href');
        loadPage(url);
    });
    
    function applyFilters() {
        let formData = $('#filterForm').serialize();
        let sortValue = $('#sortSelect').val();
        let data = formData + '&sort=' + sortValue;
        
        // Show loading state
        showLoading();
        
        $.ajax({
            url: '{{ route("products.index") }}',
            type: 'GET',
            data: data,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            },
            success: function(response) {
                if (response.success) {
                    // Update products grid
                    $('#products-container').html(response.html);
                    
                    // Update pagination
                    $('#pagination-container').html(response.pagination);
                    
                    // Update count info
                    $('#products-count').text(
                        `Showing ${response.count_info.first} - ${response.count_info.last} of ${response.count_info.total} products`
                    );
                    
                    // Update URL without page reload
                    let newUrl = '{{ route("products.index") }}?' + data;
                    window.history.pushState({}, '', newUrl);
                }
                hideLoading();
            },
            error: function(xhr, status, error) {
                console.error('Filter error:', error);
                hideLoading();
                
                // Show error message
                showErrorMessage('An error occurred while filtering products. Please try again.');
            }
        });
    }
    
    function loadPage(url) {
        showLoading();
        
        $.ajax({
            url: url,
            type: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            },
            success: function(response) {
                if (response.success) {
                    // Update products grid
                    $('#products-container').html(response.html);
                    
                    // Update pagination
                    $('#pagination-container').html(response.pagination);
                    
                    // Update count info
                    $('#products-count').text(
                        `Showing ${response.count_info.first} - ${response.count_info.last} of ${response.count_info.total} products`
                    );
                    
                    // Update URL
                    window.history.pushState({}, '', url);
                    
                    // Scroll to top of products
                    $('html, body').animate({
                        scrollTop: $('#products-container').offset().top - 100
                    }, 500);
                }
                hideLoading();
            },
            error: function(xhr, status, error) {
                console.error('Pagination error:', error);
                hideLoading();
                showErrorMessage('An error occurred while loading the page. Please try again.');
            }
        });
    }
    
    function showLoading() {
        // Add loading overlay
        if ($('#loading-overlay').length === 0) {
            $('body').append(`
                <div id="loading-overlay" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                    <div class="bg-white rounded-lg p-6 flex items-center space-x-3">
                        <div class="animate-spin rounded-full h-6 w-6 border-b-2 border-indigo-600"></div>
                        <span class="text-gray-700">Loading products...</span>
                    </div>
                </div>
            `);
        }
        
        // Add loading state to products container
        $('#products-container').addClass('opacity-50 pointer-events-none');
    }
    
    function hideLoading() {
        $('#loading-overlay').remove();
        $('#products-container').removeClass('opacity-50 pointer-events-none');
    }
    
    function showErrorMessage(message) {
        // Remove existing error messages
        $('.error-message').remove();
        
        // Add error message
        $('#products-container').before(`
            <div class="error-message bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <span class="block sm:inline">${message}</span>
                <button class="float-right font-bold text-red-700 hover:text-red-900" onclick="$(this).parent().remove()">×</button>
            </div>
        `);
        
        // Auto-remove after 5 seconds
        setTimeout(function() {
            $('.error-message').fadeOut(function() {
                $(this).remove();
            });
        }, 5000);
    }
    
    // Handle browser back/forward buttons
    window.addEventListener('popstate', function(e) {
        location.reload();
    });
});
</script>
@endpush
