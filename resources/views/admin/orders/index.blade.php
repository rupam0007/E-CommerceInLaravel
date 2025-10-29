@extends('layouts.app')

@section('title', 'Order Management')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-7xl mx-auto">
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Order Management</h1>
            <a href="{{ route('admin.dashboard') }}" 
               class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-md transition-colors duration-200">
                Back to Dashboard
            </a>
        </div>

        <!-- Filters -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <form id="orderFilterForm" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Search</label>
                    <input type="text" id="search" name="search" value="{{ request('search') }}" 
                           placeholder="Order number or customer name"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select id="status" name="status" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">All Statuses</option>
                        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="confirmed" {{ request('status') === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                        <option value="processing" {{ request('status') === 'processing' ? 'selected' : '' }}>Processing</option>
                        <option value="shipped" {{ request('status') === 'shipped' ? 'selected' : '' }}>Shipped</option>
                        <option value="delivered" {{ request('status') === 'delivered' ? 'selected' : '' }}>Delivered</option>
                        <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>
                
                <div>
                    <label for="payment_status" class="block text-sm font-medium text-gray-700 mb-1">Payment Status</label>
                    <select id="payment_status" name="payment_status" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">All Payment Statuses</option>
                        <option value="pending" {{ request('payment_status') === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="completed" {{ request('payment_status') === 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="failed" {{ request('payment_status') === 'failed' ? 'selected' : '' }}>Failed</option>
                    </select>
                </div>
                
                <div class="flex items-end gap-2">
                    <button type="submit" 
                            class="flex-1 bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-md transition-colors duration-200">
                        Filter
                    </button>
                    <button type="button" id="clearFilters"
                            class="bg-gray-300 hover:bg-gray-400 text-gray-700 py-2 px-4 rounded-md transition-colors duration-200">
                        Clear
                    </button>
                </div>
            </form>
        </div>

        <!-- Orders Table -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden" id="orders-table-container">
            @include('admin.orders.partials.orders-table', ['orders' => $orders])
        </div>

        <!-- Pagination -->
        <div class="mt-6" id="orders-pagination-container">
            @include('admin.orders.partials.pagination', ['orders' => $orders])
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    let filterTimeout;
    
    // Handle filter form submission
    $('#orderFilterForm').on('submit', function(e) {
        e.preventDefault();
        applyFilters();
    });
    
    // Handle real-time filtering on input changes
    $('#orderFilterForm input, #orderFilterForm select').on('input change', function() {
        clearTimeout(filterTimeout);
        filterTimeout = setTimeout(function() {
            applyFilters();
        }, 500); // Debounce for 500ms
    });
    
    // Handle clear filters button
    $('#clearFilters').on('click', function() {
        $('#orderFilterForm')[0].reset();
        applyFilters();
    });
    
    // Handle pagination clicks
    $(document).on('click', '#orders-pagination-container .pagination a', function(e) {
        e.preventDefault();
        let url = $(this).attr('href');
        loadPage(url);
    });
    
    function applyFilters() {
        let formData = $('#orderFilterForm').serialize();
        
        // Show loading state
        showLoading();
        
        $.ajax({
            url: '{{ route("admin.orders.index") }}',
            type: 'GET',
            data: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            },
            success: function(response) {
                if (response.success) {
                    // Update orders table
                    $('#orders-table-container').html(response.html);
                    
                    // Update pagination
                    $('#orders-pagination-container').html(response.pagination);
                    
                    // Update URL without page reload
                    let newUrl = '{{ route("admin.orders.index") }}?' + formData;
                    window.history.pushState({}, '', newUrl);
                }
                hideLoading();
            },
            error: function(xhr, status, error) {
                console.error('Filter error:', error);
                hideLoading();
                
                // Show error message
                showErrorMessage('An error occurred while filtering orders. Please try again.');
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
                    // Update orders table
                    $('#orders-table-container').html(response.html);
                    
                    // Update pagination
                    $('#orders-pagination-container').html(response.pagination);
                    
                    // Update URL
                    window.history.pushState({}, '', url);
                    
                    // Scroll to top of table
                    $('html, body').animate({
                        scrollTop: $('#orders-table-container').offset().top - 100
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
                        <div class="animate-spin rounded-full h-6 w-6 border-b-2 border-blue-600"></div>
                        <span class="text-gray-700">Loading orders...</span>
                    </div>
                </div>
            `);
        }
        
        // Add loading state to table container
        $('#orders-table-container').addClass('opacity-50 pointer-events-none');
    }
    
    function hideLoading() {
        $('#loading-overlay').remove();
        $('#orders-table-container').removeClass('opacity-50 pointer-events-none');
    }
    
    function showErrorMessage(message) {
        // Remove existing error messages
        $('.error-message').remove();
        
        // Add error message
        $('#orders-table-container').before(`
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
