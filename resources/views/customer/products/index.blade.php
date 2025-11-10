@extends('layouts.app')

@section('title', $pageTitle . ' - Nexora')

@section('content')
<div class="bg-gray-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16">


        <div class="mb-10 text-center">
            <h1 class="text-4xl font-bold font-serif text-white">
                {{ $pageTitle }}
            </h1>
            <p class="text-gray-300 mt-2 text-lg">{{ $pageDescription }}</p>
        </div>

        <div class="flex flex-col lg:flex-row gap-8">


            <aside class="lg:w-1/4">
                <div class="bg-gray-800 border border-gray-700 rounded-lg p-6 sticky top-24 shadow-sm">
                    <h3 class="text-xl font-semibold text-white mb-6">Filters</h3>

                    <form method="GET" action="{{ route('products.index') }}" id="filterForm">

                        <div class="mb-5">
                            <label for="search" class="block text-sm font-medium text-gray-300 mb-2">Search</label>
                            <input type="text" id="search" name="search" value="{{ request('search') }}"
                                placeholder="Search products..."
                                class="w-full px-3 py-2 border border-gray-600 rounded-md shadow-sm text-sm bg-gray-700 text-white
                                          focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400">
                        </div>


                        <div class="mb-5">
                            <label for="category" class="block text-sm font-medium text-gray-300 mb-2">Category</label>
                            <select id="category" name="category"
                                class="w-full px-3 py-2 border border-gray-600 rounded-md shadow-sm text-sm bg-gray-700 text-white
                                           focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400">
                                <option value="">All Categories</option>
                                @foreach($categories as $cat)
                                <option value="{{ $cat->id }}"
                                    {{ (request()->query('category') == $cat->id) || ($currentCategory && $currentCategory->id == $cat->id) ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>


                        <div class="mb-5">
                            <label class="block text-sm font-medium text-gray-300 mb-2">Price Range</label>
                            <div class="flex gap-2">
                                <input type="number" name="min_price" value="{{ request('min_price') }}"
                                    placeholder="Min" step="0.01"
                                    class="w-full px-3 py-2 border border-gray-600 rounded-md shadow-sm text-sm bg-gray-700 text-white
                                              focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400">
                                <input type="number" name="max_price" value="{{ request('max_price') }}"
                                    placeholder="Max" step="0.01"
                                    class="w-full px-3 py-2 border border-gray-600 rounded-md shadow-sm text-sm bg-gray-700 text-white
                                              focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400">
                            </div>
                        </div>


                        <div class="mb-6">
                            <label class="flex items-center">
                                <input type="checkbox" name="in_stock" value="1" {{ request('in_stock') ? 'checked' : '' }}
                                    class="rounded border-gray-600 bg-gray-700 text-indigo-500 shadow-sm focus:ring-indigo-400">
                                <span class="ml-2 text-sm text-gray-300">In Stock Only</span>
                            </label>
                        </div>

                        <div class="flex flex-col gap-3">
                            <button type="submit" class="w-full bg-indigo-500 text-white px-4 py-2.5 rounded-md hover:bg-indigo-600 transition-colors text-sm font-medium shadow-sm">
                                Apply Filters
                            </button>
                            <a href="{{ route('products.index') }}" class="w-full bg-gray-700 text-white border border-gray-600 px-4 py-2.5 rounded-md hover:bg-gray-600 transition-colors text-sm font-medium text-center">
                                Clear All
                            </a>
                        </div>
                    </form>
                </div>
            </aside>


            <div class="lg:w-3/4">


                <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4">
                    <p class="text-gray-400 text-sm" id="products-count">
                        Showing {{ $products->firstItem() ?? 0 }} - {{ $products->lastItem() ?? 0 }} of {{ $products->total() }} products
                    </p>

                    <div class="flex items-center gap-2">
                        <label class="text-sm text-gray-300">Sort by:</label>
                        <select name="sort" id="sortSelect"
                            class="px-3 py-2 border border-gray-600 rounded-md text-sm shadow-sm bg-gray-700 text-white
                                       focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400">
                            <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Name</option>
                            <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                            <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest First</option>
                        </select>
                    </div>
                </div>


                <div id="products-container" class="min-h-[400px]">
                    @include('customer.products.partials.products-grid', ['products' => $products])
                </div>


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

        function getCleanUrl(url) {
            let newUrl = new URL(url);
            newUrl.searchParams.delete('_');
            return newUrl.href;
        }

        function updatePage(data, url) {
            $('#products-container').html(data.html);
            $('#pagination-container').html(data.pagination);

            let countText = `Showing 0 - 0 of 0 products`;
            if (data.count_info.total > 0) {
                countText = `Showing ${data.count_info.first} - ${data.count_info.last} of ${data.count_info.total} products`;
            }
            $('#products-count').text(countText);

            window.history.pushState({
                path: url
            }, '', url);
        }

        function applyFilters() {
            let formData = $('#filterForm').serialize();
            let sortValue = $('#sortSelect').val();
            let data = formData + '&sort=' + sortValue;

            let baseUrl = '{{ route("products.index") }}';
            let currentPath = window.location.pathname;


            if (currentPath.includes('/categories/')) {
                baseUrl = currentPath;
            }

            let url = baseUrl + '?' + data;

            showLoading();

            $.ajax({
                url: baseUrl,
                type: 'GET',
                data: data,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                success: function(response) {
                    if (response.success) {


                        if (!currentPath.includes('/categories/')) {
                            let newUrl = '{{ route("products.index") }}?' + data;
                            window.history.pushState({
                                path: newUrl
                            }, '', newUrl);
                        } else {
                            window.history.pushState({
                                path: url
                            }, '', url);
                        }

                        updatePage(response, url);

                    }
                    hideLoading();
                },
                error: function() {
                    hideLoading();
                    showErrorMessage('An error occurred while filtering products.');
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
                        updatePage(response, getCleanUrl(url));
                        $('html, body').animate({
                            scrollTop: $('#products-container').offset().top - 100
                        }, 300);
                    }
                    hideLoading();
                },
                error: function() {
                    hideLoading();
                    showErrorMessage('An error occurred while loading the page.');
                }
            });
        }

        $('#filterForm').on('submit', function(e) {
            e.preventDefault();
            applyFilters();
        });


        $('#filterForm input[type="text"], #filterForm input[type="number"], #filterForm input[type="checkbox"]').on('change', function() {
            clearTimeout(filterTimeout);
            filterTimeout = setTimeout(applyFilters, 500);
        });

        $('#filterForm select').on('change', applyFilters);

        $('#sortSelect').on('change', applyFilters);

        $(document).on('click', '#pagination-container .pagination a', function(e) {
            e.preventDefault();
            loadPage($(this).attr('href'));
        });

        window.addEventListener('popstate', function() {
            location.reload();
        });

        function showLoading() {
            $('#products-container').addClass('opacity-50 pointer-events-none');
        }

        function hideLoading() {
            $('#products-container').removeClass('opacity-50 pointer-events-none');
        }

        function showErrorMessage(message) {
            $('.error-message').remove();
            $('#products-container').before(`
            <div class="error-message bg-red-900 border border-red-700 text-red-300 px-4 py-3 rounded mb-4" role="alert">
                <span>${message}</span>
                <button class="float-right" onclick="$(this).parent().remove()">×</button>
            </div>
        `);
        }
    });
</script>
@endpush