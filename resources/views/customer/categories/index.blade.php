@extends('layouts.app')

@section('title', 'All Categories')

@section('content')
<div class="bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16">


        <div class="mb-10 text-center">
            <h1 class="text-4xl font-bold font-serif text-gray-900">
                Shop by Category
            </h1>
            <p class="text-gray-600 mt-2 text-lg">Apni pasand ki category se products chunein.</p>
        </div>


        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse($categories as $category)
            <a href="{{ route('products.category', $category) }}" class="relative bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden transition-all duration-300 hover:shadow-lg group">
                <div class="aspect-square w-full overflow-hidden">
                    @if($category->image)
                    <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}"
                        class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-300">
                    @else
                    <div class="w-full h-full bg-gray-100 flex items-center justify-center">
                        <svg class="h-12 w-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    @endif
                </div>
                <div class="p-5">
                    <h3 class="text-lg font-semibold text-gray-900 text-center">
                        {{ $category->name }}
                    </h3>
                    <p class="text-sm text-gray-500 text-center mt-1">{{ $category->description }}</p>
                </div>
            </a>
            @empty
            <div class="col-span-full text-center py-16">
                <h3 class="mt-2 text-lg font-semibold text-gray-900">No categories found</h3>
            </div>
            @endforelse
        </div>

    </div>
</div>
@endsection