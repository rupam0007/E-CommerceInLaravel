@if($products->count() > 0)
@foreach($products as $product)
<div class="relative bg-gray-800 border border-gray-700 rounded-lg shadow-sm overflow-hidden transition-all duration-300 hover:shadow-lg group">
    <div class="relative">

        <div class="aspect-square w-full overflow-hidden">

            @if($product->image)
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-300">
            @else
            <div class="w-full h-full bg-gray-700 flex items-center justify-center">
                <svg class="h-12 w-12 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </div>
            @endif
        </div>

        @php
        $inWishlist = false;
        if(auth()->check()) {
        $inWishlist = \App\Models\Wishlist::where('user_id', auth()->id())
        ->where('product_id', $product->id)
        ->exists();
        }
        @endphp
        <form method="POST" action="{{ route('wishlist.toggle', $product) }}" class="absolute top-3 right-3 z-20">
            @csrf
            <button type="submit" aria-label="Toggle wishlist"
                class="p-2 rounded-full shadow-sm
                                       {{ $inWishlist ? 'bg-red-600 text-white' : 'bg-gray-700 text-gray-300 hover:text-red-500 hover:bg-red-900' }}
                                       transition-colors">
                @if($inWishlist)
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                </svg>
                @else
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78L12 21.23l8.84-8.84a5.5 5.5 0 0 0 0-7.78z" />
                </svg>
                @endif
            </button>
        </form>
    </div>

    <div class="p-5">
        <div class="flex justify-between items-start mb-2">
            <div>
                <p class="text-sm text-gray-400">{{ optional($product->category)->name }}</p>
                <h3 class="text-base font-semibold text-white mt-1">
                    <a href="{{ route('products.show', $product) }}" class="hover:text-indigo-400">
                        <span class="absolute inset-0 z-0"></span>
                        {{ $product->name }}
                    </a>
                </h3>
            </div>
            @if($product->stock_quantity <= 5 && $product->stock_quantity > 0)
                <span class="text-xs bg-yellow-900 text-yellow-300 px-2 py-1 rounded-full font-medium relative z-10">Low Stock</span>
                @elseif($product->stock_quantity == 0)
                <span class="text-xs bg-red-900 text-red-300 px-2 py-1 rounded-full font-medium relative z-10">Out of Stock</span>
                @endif
        </div>

        <p class="text-2xl font-bold text-white mb-4 relative z-10">₹{{ number_format($product->price, 2) }}</p>

        <div class="flex gap-2 relative z-10">
            <a href="{{ route('products.show', $product) }}"
                class="flex-1 bg-gray-700 border border-gray-600 text-white px-4 py-2 rounded-md text-sm font-medium text-center hover:bg-gray-600 transition-colors">
                View Details
            </a>

            @if($product->stock_quantity > 0)
            <form action="{{ route('cart.add', $product) }}" method="POST" class="flex-1">
                @csrf
                <input type="hidden" name="quantity" value="1">
                <button type="submit"
                    class="w-full bg-indigo-500 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-indigo-600 transition-colors">
                    Add to Cart
                </button>
            </form>
            @else
            <button disabled class="w-full flex-1 bg-gray-700 text-gray-400 px-4 py-2 rounded-md text-sm font-medium cursor-not-allowed">
                Out of Stock
            </button>
            @endif
        </div>
    </div>
</div>
@endforeach
@else
<div class="text-center py-16 col-span-full">
    <svg class="mx-auto h-12 w-12 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
    </svg>
    <h3 class="mt-2 text-lg font-semibold text-white">No products found</h3>
    <p class="mt-1 text-sm text-gray-400">Try adjusting your search or filter criteria.</p>
    <div class="mt-6">
        <a href="{{ route('products.index') }}"
            class="inline-flex items-center px-5 py-2.5 shadow-sm text-sm font-medium rounded-md text-white bg-indigo-500 hover:bg-indigo-600">
            Clear Filters
        </a>
    </div>
</div>
@endif