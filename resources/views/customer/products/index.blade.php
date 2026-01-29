@extends('layouts.app')

@section('title', $pageTitle . ' - Nexora')

@section('content')
<div class="bg-gray-100 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 py-6">
        
        <!-- Breadcrumb -->
        <nav class="flex items-center gap-2 text-sm text-gray-500 mb-4">
            <a href="{{ route('home') }}" class="hover:text-primary-500">Home</a>
            <span class="material-icons text-lg">chevron_right</span>
            <span class="text-gray-900 font-medium">{{ $pageTitle }}</span>
        </nav>

        <div class="flex gap-6">
            
            <!-- Sidebar Filters -->
            <div class="hidden lg:block w-64 flex-shrink-0">
                <div class="bg-white rounded shadow-sm sticky top-20">
                    <div class="p-4 border-b">
                        <h3 class="font-semibold text-gray-900">Filters</h3>
                    </div>
                    
                    <form action="{{ route('products.index') }}" method="GET" class="p-4 space-y-5">
                        @if(request('search'))
                            <input type="hidden" name="search" value="{{ request('search') }}">
                        @endif

                        <!-- Category Filter -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                            <select name="category" onchange="this.form.submit()" 
                                class="w-full px-3 py-2 bg-white border border-gray-200 rounded text-sm focus:outline-none focus:border-primary-500">
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

                        <!-- Sort Filter -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Sort By</label>
                            <select name="sort" onchange="this.form.submit()" 
                                class="w-full px-3 py-2 bg-white border border-gray-200 rounded text-sm focus:outline-none focus:border-primary-500">
                                <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest First</option>
                                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                            </select>
                        </div>

                        <!-- Reset Button -->
                        <a href="{{ route('products.index') }}" class="block w-full text-center bg-gray-100 hover:bg-gray-200 text-gray-700 py-2 px-4 rounded text-sm transition">
                            Clear Filters
                        </a>
                    </form>
                </div>
            </div>

            <!-- Main Content -->
            <div class="flex-1">
                <!-- Header -->
                <div class="bg-white rounded shadow-sm p-4 mb-4">
                    <div class="flex flex-wrap items-center justify-between gap-4">
                        <div>
                            <h1 class="text-xl font-semibold text-gray-900">{{ $pageTitle }}</h1>
                            <p class="text-sm text-gray-500">
                                Showing {{ $products->firstItem() ?? 0 }} - {{ $products->lastItem() ?? 0 }} of {{ $products->total() }} products
                            </p>
                        </div>
                        
                        <!-- Mobile Filter Toggle -->
                        <button class="lg:hidden flex items-center gap-2 px-4 py-2 border rounded text-sm" onclick="toggleMobileFilter()">
                            <span class="material-icons text-lg">tune</span>
                            Filters
                        </button>
                    </div>
                </div>

                <!-- Product Grid -->
                <div class="grid grid-cols-2 sm:grid-cols-3 xl:grid-cols-4 gap-4">
                    @include('customer.products.partials.products-grid-new', ['products' => $products])
                </div>

                <!-- Pagination -->
                @if($products->hasPages())
                <div class="mt-6 bg-white rounded shadow-sm p-4">
                    {{ $products->withQueryString()->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Mobile Filter Modal -->
<div id="mobile-filter" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-black/50" onclick="toggleMobileFilter()"></div>
    <div class="absolute bottom-0 left-0 right-0 bg-white rounded-t-2xl p-6 max-h-[80vh] overflow-y-auto">
        <div class="flex items-center justify-between mb-4">
            <h3 class="font-semibold text-lg">Filters</h3>
            <button onclick="toggleMobileFilter()" class="p-2 hover:bg-gray-100 rounded-full">
                <span class="material-icons">close</span>
            </button>
        </div>
        
        <form action="{{ route('products.index') }}" method="GET" class="space-y-5">
            @if(request('search'))
                <input type="hidden" name="search" value="{{ request('search') }}">
            @endif

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                <select name="category" class="w-full px-3 py-3 bg-white border border-gray-200 rounded text-sm">
                    <option value="">All Categories</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Sort By</label>
                <select name="sort" class="w-full px-3 py-3 bg-white border border-gray-200 rounded text-sm">
                    <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest First</option>
                    <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                    <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                </select>
            </div>

            <div class="flex gap-3 pt-4">
                <a href="{{ route('products.index') }}" class="flex-1 text-center py-3 border rounded font-medium">Clear</a>
                <button type="submit" class="flex-1 bg-primary-500 text-white py-3 rounded font-medium">Apply</button>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
function toggleMobileFilter() {
    const modal = document.getElementById('mobile-filter');
    modal.classList.toggle('hidden');
    document.body.classList.toggle('overflow-hidden');
}
</script>
@endpush