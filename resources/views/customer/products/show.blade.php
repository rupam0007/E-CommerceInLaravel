@extends('layouts.app')

@section('title', $product->name . ' - Nexora')

@section('content')
<div class="bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        {{-- Breadcrumb --}}
        <nav class="flex mb-8" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-indigo-600">Home</a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <a href="{{ route('products.index') }}" class="ml-1 text-gray-700 hover:text-indigo-600 md:ml-2">Products</a>
                    </div>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <a href="{{ route('products.category', $product->category) }}" class="ml-1 text-gray-700 hover:text-indigo-600 md:ml-2">{{ $product->category->name }}</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="ml-1 text-gray-500 md:ml-2">{{ Str::limit($product->name, 30) }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="lg:grid lg:grid-cols-2 lg:gap-x-8 lg:items-start">

            {{-- Product Images --}}
            <div class="flex flex-col-reverse">
                <div class="aspect-w-1 aspect-h-1 w-full">
                    @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                        class="w-full h-full object-center object-cover sm:rounded-lg">
                    @else
                    <div class="w-full h-96 bg-gray-200 flex items-center justify-center rounded-lg">
                        <svg class="h-24 w-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    @endif
                </div>
            </div>

            {{-- Product Info --}}
            <div class="mt-10 px-4 sm:px-0 sm:mt-16 lg:mt-0">
                <h1 class="text-3xl font-extrabold tracking-tight text-gray-900" style="font-family: 'Crimson Text', serif;">
                    {{ $product->name }}
                </h1>

                <div class="mt-3">
                    <h2 class="sr-only">Product information</h2>
                    <p class="text-3xl text-gray-900 font-bold">${{ number_format($product->price, 2) }}</p>
                </div>

                {{-- Stock Status --}}
                <div class="mt-6">
                    @if($product->stock_quantity > 0)
                    <div class="flex items-center">
                        <svg class="flex-shrink-0 h-5 w-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        <p class="ml-2 text-sm text-gray-500">
                            In stock ({{ $product->stock_quantity }} available)
                        </p>
                    </div>
                    @else
                    <div class="flex items-center">
                        <svg class="flex-shrink-0 h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                        </svg>
                        <p class="ml-2 text-sm text-gray-500">Out of stock</p>
                    </div>
                    @endif
                </div>

                {{-- Product Details --}}
                <div class="mt-6">
                    <h3 class="text-sm font-medium text-gray-900">Description</h3>
                    <div class="mt-4 prose prose-sm text-gray-500">
                        <p>{{ $product->description }}</p>
                    </div>
                </div>

                {{-- Product Specifications --}}
                <div class="mt-8 border-t border-gray-200 pt-8">
                    <h3 class="text-sm font-medium text-gray-900">Product Details</h3>
                    <div class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">SKU</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $product->sku }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Category</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $product->category->name }}</dd>
                        </div>
                        @if($product->weight)
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Weight</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $product->weight }} kg</dd>
                        </div>
                        @endif
                        @if($product->dimensions)
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Dimensions</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $product->dimensions }}</dd>
                        </div>
                        @endif
                    </div>
                </div>

                {{-- Add to Cart Form --}}
                @auth
                @if($product->stock_quantity > 0)
                <form action="{{ route('cart.add', $product) }}" method="POST" class="mt-10">
                    @csrf
                    <div class="flex items-center space-x-4">
                        <div>
                            <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
                            <select name="quantity" id="quantity"
                                class="mt-1 block w-20 pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                @for($i = 1; $i <= min(10, $product->stock_quantity); $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                            </select>
                        </div>
                        <div class="flex-1">
                            <button type="submit"
                                class="w-full bg-indigo-600 border border-transparent rounded-md py-3 px-8 flex items-center justify-center text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                </form>
                @else
                <div class="mt-10">
                    <button disabled
                        class="w-full bg-gray-300 border border-transparent rounded-md py-3 px-8 flex items-center justify-center text-base font-medium text-gray-500 cursor-not-allowed">
                        Out of Stock
                    </button>
                </div>
                @endif
                @else
                <div class="mt-10">
                    <a href="{{ route('login') }}"
                        class="w-full bg-indigo-600 border border-transparent rounded-md py-3 px-8 flex items-center justify-center text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Login to Purchase
                    </a>
                </div>
                @endauth
            </div>
        </div>

        {{-- Related Products --}}
        @if($relatedProducts->count() > 0)
        <div class="mt-16 border-t border-gray-200 pt-16">
            <h2 class="text-2xl font-extrabold tracking-tight text-gray-900" style="font-family: 'Crimson Text', serif;">
                Related Products
            </h2>

            <div class="mt-8 grid grid-cols-1 gap-y-12 sm:grid-cols-2 sm:gap-x-6 lg:grid-cols-4 xl:gap-x-8">
                @foreach($relatedProducts as $relatedProduct)
                <div class="group relative">
                    <div class="relative w-full h-72 bg-white rounded-lg overflow-hidden group-hover:opacity-75 sm:aspect-w-2 sm:aspect-h-1 sm:h-64 lg:aspect-w-1 lg:aspect-h-1">
                        @if($relatedProduct->image)
                        <img src="{{ asset('storage/' . $relatedProduct->image) }}" alt="{{ $relatedProduct->name }}"
                            class="w-full h-full object-center object-cover">
                        @else
                        <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                            <svg class="h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        @endif
                    </div>
                    <div class="mt-6">
                        <h3 class="text-sm text-gray-500">
                            <a href="{{ route('products.show', $relatedProduct) }}">
                                <span class="absolute inset-0"></span>
                                {{ $relatedProduct->category->name }}
                            </a>
                        </h3>
                        <p class="text-base font-semibold text-gray-900">{{ $relatedProduct->name }}</p>
                        <p class="mt-1 text-lg font-medium text-gray-900">${{ number_format($relatedProduct->price, 2) }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>
@endsection