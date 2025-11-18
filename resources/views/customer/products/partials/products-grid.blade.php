@forelse ($products as $product)
<div class="relative bg-gray-700 rounded-lg shadow-lg overflow-hidden flex flex-col h-full border border-gray-600 hover:shadow-xl transition-all duration-300 ease-in-out group">
    
    {{-- Wishlist Button --}}
    <form action="{{ route('wishlist.toggle', $product) }}" method="POST" class="absolute top-3 right-3 z-20">
        @csrf
        <button type="submit" class="p-2 rounded-full shadow-sm transition-colors duration-200 {{ Auth::check() && Auth::user()->wishlist && Auth::user()->wishlist->contains('product_id', $product->id) ? 'bg-red-600 text-white' : 'bg-gray-800 text-gray-400 hover:text-red-500 hover:bg-gray-700' }}">
            @if (Auth::check() && Auth::user()->wishlist && Auth::user()->wishlist->contains('product_id', $product->id))
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path>
            </svg>
            @else
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 016.364 0L12 7.636l1.318-1.318a4.5 4.5 0 016.364 6.364L12 20.364l-7.682-7.682a4.5 4.5 0 010-6.364z"></path>
            </svg>
            @endif
        </button>
    </form>

    {{-- Product Image --}}
    <a href="{{ route('products.show', $product) }}" class="flex-shrink-0 relative block overflow-hidden">
        @if($product->image)
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover object-center transform group-hover:scale-105 transition-transform duration-500 ease-in-out">
        @else
            <div class="w-full h-48 bg-gray-600 flex items-center justify-center text-gray-400">
                <svg class="h-12 w-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </div>
        @endif
        
        {{-- Stock Badge --}}
        @if($product->stock_quantity <= 5 && $product->stock_quantity > 0)
            <span class="absolute top-3 left-3 bg-yellow-600 text-white text-xs font-bold px-2 py-1 rounded">Low Stock</span>
        @elseif($product->stock_quantity == 0)
            <span class="absolute top-3 left-3 bg-red-600 text-white text-xs font-bold px-2 py-1 rounded">Out of Stock</span>
        @endif
    </a>

    {{-- Product Details --}}
    <div class="flex-grow p-4 flex flex-col">
        <div class="mb-2">
            <p class="text-xs text-gray-400 mb-1">{{ optional($product->category)->name }}</p>
            <h3 class="text-lg font-semibold text-white leading-tight">
                <a href="{{ route('products.show', $product) }}" class="hover:text-indigo-400 transition-colors">
                    {{ $product->name }}
                </a>
            </h3>
            
            {{-- Star Rating --}}
            <div class="flex items-center mt-1">
                @php $rating = $product->reviews_avg_rating ?? 0; @endphp
                @for($i = 1; $i <= 5; $i++)
                    <svg class="w-4 h-4 {{ $i <= round($rating) ? 'text-yellow-400' : 'text-gray-500' }}" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                    </svg>
                @endfor
                <span class="text-xs text-gray-400 ml-1">({{ number_format($rating, 1) }})</span>
            </div>
        </div>

        <div class="mt-auto">
            <div class="flex items-baseline mb-4">
                <span class="text-xl font-bold text-indigo-400 mr-2">₹{{ number_format($product->price, 2) }}</span>
            </div>

            <div class="flex space-x-2">
                <a href="{{ route('products.show', $product) }}" class="flex-1 bg-gray-600 text-white py-2 px-3 rounded text-sm font-medium text-center hover:bg-gray-500 transition-colors">
                    View
                </a>

                @if($product->stock_quantity > 0)
                <form action="{{ route('cart.add', $product) }}" method="POST" class="flex-1">
                    @csrf
                    <input type="hidden" name="quantity" value="1">
                    <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-3 rounded text-sm font-medium hover:bg-indigo-700 transition-colors flex items-center justify-center">
                        Add to Cart
                    </button>
                </form>
                @else
                <button disabled class="flex-1 bg-gray-800 text-gray-500 py-2 px-3 rounded text-sm font-medium cursor-not-allowed border border-gray-600">
                    Out of Stock
                </button>
                @endif
            </div>
        </div>
    </div>
</div>
@empty
<div class="col-span-full text-center py-12">
    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
    </svg>
    <h3 class="mt-2 text-lg font-medium text-white">No products found</h3>
    <p class="mt-1 text-sm text-gray-400">Try adjusting your search or filter to find what you're looking for.</p>
</div>
@endforelse