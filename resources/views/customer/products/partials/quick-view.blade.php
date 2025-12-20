{{-- Quick View Modal Content --}}
<div class="grid md:grid-cols-2 gap-8">
    {{-- Product Image --}}
    <div class="relative">
        @if($product->image)
            <img src="{{ $product->image_url }}" 
                 alt="{{ $product->name }}"
                 class="w-full h-96 object-cover rounded-xl shadow-lg">
        @else
            <div class="w-full h-96 bg-gradient-to-br from-blue-100 to-purple-100 rounded-xl flex items-center justify-center">
                <span class="material-icons text-gray-400" style="font-size: 120px;">image</span>
            </div>
        @endif

        {{-- Stock Badge --}}
        @if($product->stock_quantity > 0)
            <div class="absolute top-4 left-4 bg-gradient-to-r from-green-500 to-emerald-600 text-white px-4 py-2 rounded-full font-bold text-sm shadow-lg">
                In Stock
            </div>
        @else
            <div class="absolute top-4 left-4 bg-gradient-to-r from-red-500 to-rose-600 text-white px-4 py-2 rounded-full font-bold text-sm shadow-lg">
                Out of Stock
            </div>
        @endif
    </div>

    {{-- Product Details --}}
    <div class="flex flex-col">
        <div class="mb-3">
            <span class="inline-block bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 px-3 py-1 rounded-full text-xs font-bold uppercase">
                {{ optional($product->category)->name ?? 'Uncategorized' }}
            </span>
        </div>

        <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white mb-4">
            {{ $product->name }}
        </h2>

        {{-- Rating --}}
        <div class="flex items-center gap-3 mb-4">
            <div class="inline-flex items-center gap-1 px-3 py-1.5 bg-gradient-to-r from-green-500 to-green-600 rounded-lg shadow-md">
                @php $rating = $product->reviews_avg_rating ?? 0; @endphp
                <span class="text-white font-bold text-sm">{{ number_format($rating, 1) }}</span>
                <span class="material-icons text-white text-sm">star</span>
            </div>
            <span class="text-sm text-gray-600 dark:text-gray-400 font-semibold">
                {{ $product->reviews_count }} Reviews
            </span>
        </div>

        {{-- Price --}}
        <div class="mb-6">
            <div class="flex items-baseline gap-3">
                <p class="text-4xl font-extrabold text-gray-900 dark:text-white">₹{{ number_format($product->price, 0) }}</p>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold bg-gradient-to-r from-green-500 to-emerald-500 text-white shadow-md">
                    <span class="material-icons text-sm mr-1">local_offer</span>
                    Best Price
                </span>
            </div>
            <p class="mt-2 text-sm text-green-600 dark:text-green-400 font-semibold">Free Delivery on orders above ₹499</p>
        </div>

        {{-- Description --}}
        <div class="mb-6 p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
            <h3 class="text-sm font-bold text-gray-900 dark:text-white mb-2 flex items-center">
                <span class="material-icons text-blue-600 dark:text-blue-400 mr-2 text-lg">description</span>
                Description
            </h3>
            <p class="text-sm text-gray-700 dark:text-gray-300 line-clamp-3">
                {{ $product->description }}
            </p>
        </div>

        {{-- Add to Cart Section --}}
        @if($product->stock_quantity > 0)
            <form action="{{ route('cart.add', $product) }}" method="POST" class="mt-auto">
                @csrf
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-32">
                        <label for="quick-quantity" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Quantity</label>
                        <select name="quantity" id="quick-quantity"
                            class="block w-full px-3 py-2 bg-white dark:bg-gray-700 border-2 border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white rounded-lg font-semibold focus:ring-2 focus:ring-blue-500">
                            @for($i = 1; $i <= min(10, $product->stock_quantity); $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                </div>

                <div class="flex gap-3">
                    <button type="submit"
                        class="flex-1 bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white py-3 px-6 rounded-xl font-bold transition-all shadow-lg hover:shadow-xl transform hover:scale-105 flex items-center justify-center gap-2">
                        <span class="material-icons">shopping_cart</span>
                        Add to Cart
                    </button>
                    <a href="{{ route('products.show', $product) }}"
                        class="bg-blue-600 hover:bg-blue-700 text-white py-3 px-6 rounded-xl font-bold transition-all shadow-lg hover:shadow-xl transform hover:scale-105 flex items-center justify-center gap-2">
                        <span class="material-icons">visibility</span>
                        View Details
                    </a>
                </div>
            </form>
        @else
            <div class="mt-auto">
                <button disabled
                    class="w-full bg-gray-300 dark:bg-gray-600 text-gray-500 dark:text-gray-400 py-3 px-6 rounded-xl font-bold cursor-not-allowed flex items-center justify-center gap-2">
                    <span class="material-icons">block</span>
                    Out of Stock
                </button>
            </div>
        @endif
    </div>
</div>
