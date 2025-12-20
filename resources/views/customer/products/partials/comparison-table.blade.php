{{-- Product Comparison Table --}}
@if($products->count() > 1)
<div class="overflow-x-auto">
    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-gradient-to-r from-blue-600 to-indigo-600">
                <th class="p-4 text-left text-white font-bold text-sm uppercase sticky left-0 bg-blue-600 z-10">Feature</th>
                @foreach($products as $product)
                    <th class="p-4 text-center text-white font-bold min-w-[250px]">
                        <div class="flex flex-col items-center gap-3">
                            @if($product->image)
                                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-24 h-24 object-cover rounded-lg shadow-lg">
                            @else
                                <div class="w-24 h-24 bg-gray-200 dark:bg-gray-700 rounded-lg flex items-center justify-center">
                                    <span class="material-icons text-gray-400">image</span>
                                </div>
                            @endif
                            <span class="text-sm">{{ Str::limit($product->name, 30) }}</span>
                        </div>
                    </th>
                @endforeach
            </tr>
        </thead>
        <tbody class="bg-white dark:bg-gray-800">
            {{-- Price --}}
            <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                <td class="p-4 font-bold text-gray-900 dark:text-white sticky left-0 bg-white dark:bg-gray-800">
                    <span class="flex items-center gap-2">
                        <span class="material-icons text-green-600">payments</span>
                        Price
                    </span>
                </td>
                @foreach($products as $product)
                    <td class="p-4 text-center">
                        <span class="text-2xl font-extrabold text-gray-900 dark:text-white">₹{{ number_format($product->price, 0) }}</span>
                    </td>
                @endforeach
            </tr>

            {{-- Rating --}}
            <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                <td class="p-4 font-bold text-gray-900 dark:text-white sticky left-0 bg-white dark:bg-gray-800">
                    <span class="flex items-center gap-2">
                        <span class="material-icons text-yellow-500">star</span>
                        Rating
                    </span>
                </td>
                @foreach($products as $product)
                    <td class="p-4 text-center">
                        <div class="inline-flex items-center gap-1 px-3 py-1.5 bg-gradient-to-r from-green-500 to-green-600 rounded-lg">
                            <span class="text-white font-bold">{{ number_format($product->reviews_avg_rating ?? 0, 1) }}</span>
                            <span class="material-icons text-white text-sm">star</span>
                        </div>
                    </td>
                @endforeach
            </tr>

            {{-- Category --}}
            <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                <td class="p-4 font-bold text-gray-900 dark:text-white sticky left-0 bg-white dark:bg-gray-800">
                    <span class="flex items-center gap-2">
                        <span class="material-icons text-purple-600">category</span>
                        Category
                    </span>
                </td>
                @foreach($products as $product)
                    <td class="p-4 text-center">
                        <span class="inline-block bg-purple-100 dark:bg-purple-900 text-purple-800 dark:text-purple-200 px-3 py-1 rounded-full text-sm font-semibold">
                            {{ optional($product->category)->name ?? 'N/A' }}
                        </span>
                    </td>
                @endforeach
            </tr>

            {{-- Stock --}}
            <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                <td class="p-4 font-bold text-gray-900 dark:text-white sticky left-0 bg-white dark:bg-gray-800">
                    <span class="flex items-center gap-2">
                        <span class="material-icons text-blue-600">inventory</span>
                        Stock
                    </span>
                </td>
                @foreach($products as $product)
                    <td class="p-4 text-center">
                        @if($product->stock_quantity > 0)
                            <span class="inline-flex items-center px-3 py-1 rounded-full bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 font-semibold">
                                <span class="material-icons text-sm mr-1">check_circle</span>
                                {{ $product->stock_quantity }} units
                            </span>
                        @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200 font-semibold">
                                <span class="material-icons text-sm mr-1">cancel</span>
                                Out of Stock
                            </span>
                        @endif
                    </td>
                @endforeach
            </tr>

            {{-- Weight --}}
            <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                <td class="p-4 font-bold text-gray-900 dark:text-white sticky left-0 bg-white dark:bg-gray-800">
                    <span class="flex items-center gap-2">
                        <span class="material-icons text-orange-600">scale</span>
                        Weight
                    </span>
                </td>
                @foreach($products as $product)
                    <td class="p-4 text-center text-gray-700 dark:text-gray-300 font-semibold">
                        {{ $product->weight ? $product->weight . ' kg' : 'N/A' }}
                    </td>
                @endforeach
            </tr>

            {{-- Dimensions --}}
            <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                <td class="p-4 font-bold text-gray-900 dark:text-white sticky left-0 bg-white dark:bg-gray-800">
                    <span class="flex items-center gap-2">
                        <span class="material-icons text-indigo-600">straighten</span>
                        Dimensions
                    </span>
                </td>
                @foreach($products as $product)
                    <td class="p-4 text-center text-gray-700 dark:text-gray-300 font-semibold">
                        {{ $product->dimensions ?? 'N/A' }}
                    </td>
                @endforeach
            </tr>

            {{-- SKU --}}
            <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                <td class="p-4 font-bold text-gray-900 dark:text-white sticky left-0 bg-white dark:bg-gray-800">
                    <span class="flex items-center gap-2">
                        <span class="material-icons text-gray-600">tag</span>
                        SKU
                    </span>
                </td>
                @foreach($products as $product)
                    <td class="p-4 text-center">
                        <code class="bg-gray-100 dark:bg-gray-700 px-3 py-1 rounded text-sm font-mono text-gray-800 dark:text-gray-200">
                            {{ $product->sku }}
                        </code>
                    </td>
                @endforeach
            </tr>

            {{-- Actions --}}
            <tr class="bg-gray-50 dark:bg-gray-700">
                <td class="p-4 font-bold text-gray-900 dark:text-white sticky left-0 bg-gray-50 dark:bg-gray-700">
                    Actions
                </td>
                @foreach($products as $product)
                    <td class="p-4 text-center">
                        <div class="flex flex-col gap-2">
                            @if($product->stock_quantity > 0)
                                <button class="add-to-cart-btn bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white py-2 px-4 rounded-lg font-bold transition-all shadow-lg hover:shadow-xl transform hover:scale-105 flex items-center justify-center gap-2"
                                        data-product-id="{{ $product->id }}">
                                    <span class="material-icons text-sm">shopping_cart</span>
                                    Add to Cart
                                </button>
                            @else
                                <button disabled class="bg-gray-300 dark:bg-gray-600 text-gray-500 dark:text-gray-400 py-2 px-4 rounded-lg font-bold cursor-not-allowed">
                                    Out of Stock
                                </button>
                            @endif
                            <a href="{{ route('products.show', $product) }}" 
                               class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg font-bold transition-all flex items-center justify-center gap-2">
                                <span class="material-icons text-sm">visibility</span>
                                View Details
                            </a>
                        </div>
                    </td>
                @endforeach
            </tr>
        </tbody>
    </table>
</div>
@else
<div class="text-center py-12">
    <span class="material-icons text-gray-400 text-6xl mb-4">compare_arrows</span>
    <p class="text-gray-600 dark:text-gray-400 text-lg">Please select at least 2 products to compare</p>
</div>
@endif
