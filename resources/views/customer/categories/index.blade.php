@extends('layouts.app')

@section('title', 'All Categories')

@section('content')
{{-- Outer wrapper with Dark Background --}}
<div class="bg-gray-900 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16">

        {{-- Page Header --}}
        <div class="mb-10 text-center">
            <h1 class="text-4xl font-bold font-serif text-white">
                Shop by Category
            </h1>
            <p class="text-gray-400 mt-2 text-lg">Browse our wide range of product categories.</p>
        </div>

        {{-- Categories Grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse($categories as $category)
            <a href="{{ route('products.category', $category) }}" class="relative bg-gray-800 border border-gray-700 rounded-lg shadow-md overflow-hidden transition-all duration-300 hover:shadow-xl hover:border-gray-600 group flex flex-col">
                
                {{-- Image Container --}}
                <div class="aspect-square w-full overflow-hidden bg-gray-700 relative">
                    @if($category->image)
                        <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}"
                            class="w-full h-full object-cover object-center group-hover:scale-110 transition-transform duration-500">
                    @else
                        <div class="w-full h-full flex items-center justify-center">
                            <svg class="h-16 w-16 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    @endif
                    
                    {{-- Dark Overlay on Hover --}}
                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-opacity duration-300"></div>
                </div>
                
                {{-- Text Content --}}
                <div class="p-5 flex-grow flex flex-col justify-center">
                    <h3 class="text-xl font-semibold text-white text-center group-hover:text-indigo-400 transition-colors">
                        {{ $category->name }}
                    </h3>
                    @if($category->description)
                        <p class="text-sm text-gray-400 text-center mt-2 line-clamp-2">{{ $category->description }}</p>
                    @endif
                </div>
            </a>
            @empty
            <div class="col-span-full text-center py-16 bg-gray-800 rounded-lg border border-gray-700 border-dashed">
                <svg class="mx-auto h-12 w-12 text-gray-500 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                </svg>
                <h3 class="text-lg font-semibold text-white">No categories found</h3>
                <p class="text-gray-400 mt-1">Please check back later.</p>
            </div>
            @endforelse
        </div>

    </div>
</div>
@endsection