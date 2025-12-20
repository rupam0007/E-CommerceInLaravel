@extends('layouts.app')

@section('title', $product->name . ' - Nexora')

@section('content')
<div class="bg-[#F5EFE6] dark:bg-gray-900 min-h-screen transition-colors duration-300 relative z-0">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16 relative z-0">

        {{-- Breadcrumb --}}
        <nav class="flex mb-8" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 bg-white dark:bg-gray-800 px-5 py-3 rounded-full shadow-lg border-2 border-gray-100 dark:border-gray-700 transition-colors duration-300">
                <li class="inline-flex items-center">
                    <a href="{{ route('home') }}" class="text-sm font-semibold text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 transition-colors">Home</a>
                </li>
                <li>
                    <div class="flex items-center">
                        <span class="material-icons text-gray-400 dark:text-gray-500 text-sm">chevron_right</span>
                        <a href="{{ route('products.index') }}" class="ml-1 text-sm font-semibold text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 transition-colors md:ml-2">Products</a>
                    </div>
                </li>
                @if($product->category)
                <li>
                    <div class="flex items-center">
                        <span class="material-icons text-gray-400 text-sm">chevron_right</span>
                        <a href="{{ route('products.category', $product->category) }}" class="ml-1 text-sm font-semibold text-blue-600 hover:text-blue-700 transition-colors md:ml-2">{{ $product->category->name }}</a>
                    </div>
                </li>
                @endif
                <li aria-current="page">
                    <div class="flex items-center">
                        <span class="material-icons text-gray-400 text-sm">chevron_right</span>
                        <span class="ml-1 text-sm font-semibold text-gray-700 md:ml-2">{{ Str::limit($product->name, 30) }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="lg:grid lg:grid-cols-2 lg:gap-x-12 lg:items-start">

            {{-- Product Image Section --}}
            <div class="relative group">
                {{-- Main Image --}}
                <div id="zoom-container" class="aspect-w-1 aspect-h-1 w-full rounded-2xl border-2 border-gray-100 dark:border-gray-700 bg-white dark:bg-gray-800 overflow-hidden shadow-xl relative z-10 hover:shadow-2xl transition-shadow">
                    @if($product->image)
                        <img src="{{ $product->image_url }}" 
                             alt="{{ $product->name }}"
                             id="main-product-image"
                             class="w-full h-full object-center object-cover transition-transform duration-200 ease-out cursor-crosshair">
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-blue-100 to-purple-100 dark:from-blue-900 dark:to-purple-900 flex items-center justify-center">
                            <span class="material-icons text-gray-400 dark:text-gray-600" style="font-size: 120px;">image</span>
                        </div>
                    @endif
                </div>

                {{-- Enhanced Zoom Controls --}}
                @if($product->image)
                <div class="absolute bottom-4 right-4 z-20 flex flex-col gap-2 bg-white dark:bg-gray-800 rounded-lg shadow-xl p-2 border-2 border-gray-200 dark:border-gray-700 opacity-0 group-hover:opacity-100 transition-opacity duration-300" id="zoom-controls">
                    <button type="button" class="p-2 hover:bg-blue-50 dark:hover:bg-gray-700 rounded transition-colors" onclick="zoomIn()" title="Zoom In">
                        <span class="material-icons text-blue-600 dark:text-blue-400">zoom_in</span>
                    </button>
                    <button type="button" class="p-2 hover:bg-blue-50 dark:hover:bg-gray-700 rounded transition-colors" onclick="zoomOut()" title="Zoom Out">
                        <span class="material-icons text-blue-600 dark:text-blue-400">zoom_out</span>
                    </button>
                    <button type="button" class="p-2 hover:bg-blue-50 dark:hover:bg-gray-700 rounded transition-colors" onclick="resetZoom()" title="Reset Zoom">
                        <span class="material-icons text-blue-600 dark:text-blue-400">refresh</span>
                    </button>
                    <div class="h-px bg-gray-200 dark:bg-gray-700 my-1"></div>
                    <button type="button" id="trigger-lightbox" class="p-2 hover:bg-blue-50 dark:hover:bg-gray-700 rounded transition-colors" title="Full Screen">
                        <span class="material-icons text-blue-600 dark:text-blue-400">fullscreen</span>
                    </button>
                </div>

                {{-- Zoom Level Indicator --}}
                <div class="absolute top-4 left-4 z-20 bg-black/70 text-white px-3 py-1 rounded-full text-xs font-bold opacity-0 transition-opacity duration-300" id="zoom-level">
                    100%
                </div>
                @endif
            </div>

            {{-- Product Info --}}
            <div class="mt-10 px-4 sm:px-0 sm:mt-16 lg:mt-0">
                <h1 class="text-4xl font-extrabold tracking-tight text-gray-900 dark:text-white leading-tight transition-colors duration-300">
                    {{ $product->name }}
                </h1>

                {{-- Rating Summary --}}
                <div class="mt-4 flex items-center">
                    <div class="inline-flex items-center gap-1 px-3 py-1.5 bg-gradient-to-r from-green-500 to-green-600 rounded-lg shadow-md">
                        @php $rating = $product->reviews_avg_rating ?? 0; @endphp
                        <span class="text-white font-bold text-sm">{{ number_format($rating, 1) }}</span>
                        <span class="material-icons text-white text-sm">star</span>
                    </div>
                    <a href="#reviews" class="ml-3 text-sm font-semibold text-blue-600 hover:text-blue-700 transition-colors underline">{{ $product->reviews_count }} Reviews</a>
                </div>

                <div class="mt-6">
                    <div class="flex items-baseline gap-3">
                        <p class="text-4xl text-gray-900 font-extrabold">₹{{ number_format($product->price, 0) }}</p>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold bg-gradient-to-r from-green-500 to-emerald-500 text-white shadow-md">
                            <span class="material-icons text-sm mr-1">local_offer</span>
                            Best Price
                        </span>
                    </div>
                    <p class="mt-2 text-sm text-green-600 font-semibold">Free Delivery on orders above ₹499</p>
                </div>

                <div class="mt-6">
                    @if($product->stock_quantity > 0)
                    <div class="inline-flex items-center px-4 py-2 rounded-lg bg-gradient-to-r from-green-50 to-emerald-50 border-2 border-green-200">
                        <span class="material-icons text-green-600 text-lg mr-2">check_circle</span>
                        <p class="text-sm text-green-700 font-bold">In Stock - {{ $product->stock_quantity }} units available</p>
                    </div>
                    @else
                    <div class="inline-flex items-center px-4 py-2 rounded-lg bg-gradient-to-r from-red-50 to-pink-50 border-2 border-red-200">
                        <span class="material-icons text-red-600 text-lg mr-2">cancel</span>
                        <p class="text-sm text-red-700 font-bold">Out of Stock</p>
                    </div>
                    @endif
                </div>

                <div class="mt-8 p-6 bg-white dark:bg-gray-800 rounded-xl border-2 border-gray-100 dark:border-gray-700 shadow-md transition-colors duration-300">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-3 flex items-center">
                        <span class="material-icons text-blue-600 dark:text-blue-400 mr-2">description</span>
                        Product Description
                    </h3>
                    <div class="text-base text-gray-700 dark:text-gray-300 space-y-2 leading-relaxed">
                        <p>{{ $product->description }}</p>
                    </div>
                </div>

                @if($product->stock_quantity > 0)
                <form action="{{ route('cart.add', $product) }}" method="POST" class="mt-8" id="add-to-cart-form">
                    @csrf
                    <div class="flex items-center gap-4">
                        <div class="w-32">
                            <label for="quantity" class="block text-sm font-bold text-gray-700 mb-2">Quantity</label>
                            <div class="relative">
                                <select name="quantity" id="quantity"
                                    class="block w-full pl-3 pr-10 py-3 text-base bg-white border-2 border-gray-200 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 rounded-lg shadow-sm font-semibold">
                                    @for($i = 1; $i <= min(10, $product->stock_quantity); $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="flex-1 pt-6">
                            <button type="submit" id="add-to-cart-btn"
                                class="w-full bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 border border-transparent rounded-xl py-4 px-8 flex items-center justify-center text-lg font-bold text-white focus:outline-none focus:ring-4 focus:ring-orange-300 shadow-xl transition-all duration-200 transform hover:scale-105 relative overflow-hidden group">
                                <span class="material-icons mr-2 transition-transform duration-300 group-hover:scale-110" id="cart-icon">shopping_cart</span>
                                <span id="btn-text">Add to Cart</span>
                                {{-- Flying cart icon animation overlay --}}
                                <span class="material-icons absolute opacity-0 text-white text-2xl flying-cart-icon">shopping_cart</span>
                            </button>
                        </div>
                    </div>
                </form>
                @else
                <div class="mt-8">
                    <button disabled
                        class="w-full bg-gray-300 border border-gray-400 rounded-xl py-4 px-8 flex items-center justify-center text-lg font-bold text-gray-500 cursor-not-allowed">
                        <span class="material-icons mr-2">block</span>
                        Out of Stock
                    </button>
                </div>
                @endif

                <div class="mt-8 border-t-2 border-gray-200 pt-8">
                    <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                        <span class="material-icons text-indigo-600 mr-2">info</span>
                        Product Details
                    </h3>
                    <div class="mt-4 grid grid-cols-1 gap-3 sm:grid-cols-2 text-sm">
                        <div class="bg-gradient-to-br from-blue-50 to-cyan-50 p-4 rounded-xl border-2 border-blue-100 shadow-sm">
                            <span class="block font-bold text-blue-600 text-xs uppercase tracking-wider mb-1">SKU</span>
                            <dd class="text-gray-900 font-mono font-semibold">{{ $product->sku }}</dd>
                        </div>
                        <div class="bg-gradient-to-br from-purple-50 to-pink-50 p-4 rounded-xl border-2 border-purple-100 shadow-sm">
                            <span class="block font-bold text-purple-600 text-xs uppercase tracking-wider mb-1">Category</span>
                            <dd class="text-gray-900 font-semibold">{{ optional($product->category)->name ?? 'N/A' }}</dd>
                        </div>
                        @if($product->weight)
                        <div class="bg-gradient-to-br from-green-50 to-emerald-50 p-4 rounded-xl border-2 border-green-100 shadow-sm">
                            <span class="block font-bold text-green-600 text-xs uppercase tracking-wider mb-1">Weight</span>
                            <dd class="text-gray-900 font-semibold">{{ $product->weight }} kg</dd>
                        </div>
                        @endif
                        @if($product->dimensions)
                        <div class="bg-gradient-to-br from-orange-50 to-red-50 p-4 rounded-xl border-2 border-orange-100 shadow-sm">
                            <span class="block font-bold text-orange-600 text-xs uppercase tracking-wider mb-1">Dimensions</span>
                            <dd class="text-gray-900 font-semibold">{{ $product->dimensions }}</dd>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-16 pt-10 border-t-2 border-gray-200" id="reviews">
            <div class="text-center mb-10">
                <h2 class="text-4xl font-extrabold text-gray-900 mb-2">Customer Reviews</h2>
                <p class="text-gray-600 font-semibold">See what our customers are saying</p>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                <div class="lg:col-span-2">
                    @if($product->reviews->count() > 0)
                        <div class="space-y-5">
                            @foreach($product->reviews as $review)
                                <div class="bg-white rounded-xl p-6 border-2 border-gray-100 shadow-lg hover:shadow-xl transition-shadow">
                                    <div class="flex items-center mb-4">
                                        <div class="flex-shrink-0">
                                            <span class="inline-flex items-center justify-center h-12 w-12 rounded-full bg-gradient-to-r from-blue-600 to-indigo-600 shadow-lg">
                                                <span class="text-base font-bold leading-none text-white">{{ strtoupper(substr($review->user->name, 0, 1)) }}</span>
                                            </span>
                                        </div>
                                        <div class="ml-4 flex-1">
                                            <h4 class="text-base font-bold text-gray-900">{{ $review->user->name }}</h4>
                                            <div class="flex items-center mt-1 gap-2">
                                                <div class="inline-flex items-center gap-0.5 px-2 py-1 bg-gradient-to-r from-yellow-400 to-orange-400 rounded-md">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        <span class="material-icons text-white" style="font-size: 14px;">{{ $i <= $review->rating ? 'star' : 'star_border' }}</span>
                                                    @endfor
                                                </div>
                                                <span class="text-xs text-gray-500 font-semibold">{{ $review->created_at->diffForHumans() }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-gray-700 text-sm leading-relaxed bg-gray-50 p-4 rounded-lg">
                                        {{ $review->comment }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl p-12 text-center border-2 border-blue-100">
                            <span class="material-icons text-gray-400 mb-4" style="font-size: 80px;">rate_review</span>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">No reviews yet</h3>
                            <p class="text-gray-600 font-semibold">Be the first to share your thoughts about this product!</p>
                        </div>
                    @endif
                </div>

                <div>
                    <div class="bg-white p-6 rounded-2xl border-2 border-gray-100 shadow-xl sticky top-24">
                        <h3 class="text-xl font-bold text-gray-900 mb-5 flex items-center">
                            <span class="material-icons text-blue-600 mr-2">edit</span>
                            Write a Review
                        </h3>
                        
                        @auth
                            <form action="{{ route('reviews.store', $product) }}" method="POST">
                                @csrf
                                <div class="mb-5">
                                    <label class="block text-sm font-medium text-gray-400 mb-2">Rating</label>
                                    
                                    {{-- JS-BASED STAR RATING CONTAINER --}}
                                    <div class="flex items-center gap-1" id="star-rating-container">
                                        <input type="hidden" name="rating" id="rating-input" required>
                                        
                                        @for($i = 1; $i <= 5; $i++)
                                            <button type="button" class="star-btn focus:outline-none transition-colors duration-200 text-gray-600" data-value="{{ $i }}">
                                                <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                </svg>
                                            </button>
                                        @endfor
                                    </div>
                                    <p class="text-xs text-gray-500 mt-2">Click a star to rate</p>
                                </div>

                                <div class="mb-5">
                                    <label for="comment" class="block text-sm font-bold text-gray-700 mb-2">Your Review</label>
                                    <textarea name="comment" id="comment" rows="4" 
                                        class="block w-full rounded-lg bg-white border-2 border-gray-200 text-gray-900 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-300 sm:text-sm placeholder-gray-400 p-3" 
                                        placeholder="What did you like or dislike?" required></textarea>
                                </div>

                                <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white py-3 px-4 rounded-xl transition-all font-bold shadow-lg hover:scale-105 flex items-center justify-center">
                                    <span class="material-icons mr-2">send</span>
                                    Submit Review
                                </button>
                            </form>
                        @else
                            <div class="text-center py-10 bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl border-2 border-blue-100">
                                <span class="material-icons text-gray-400 mb-3" style="font-size: 60px;">login</span>
                                <p class="text-gray-700 font-semibold mb-5">Please login to write a review</p>
                                <a href="{{ route('login') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-bold rounded-xl text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 shadow-lg hover:scale-105 transition-all">
                                    <span class="material-icons mr-2">login</span>
                                    Login Now
                                </a>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>

        {{-- Complete the Set / Bundle Section --}}
        @if($relatedProducts->count() > 0)
        <div class="mt-16 pt-10 border-t-2 border-gray-200 dark:border-gray-700">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white flex items-center gap-3">
                        <span class="material-icons text-orange-600 text-4xl">shopping_basket</span>
                        Complete the Set
                    </h2>
                    <p class="text-gray-600 dark:text-gray-400 mt-2 font-semibold">Add these items together and save time!</p>
                </div>
                <div class="text-right">
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Bundle Total:</p>
                    <p class="text-3xl font-extrabold text-green-600 dark:text-green-400" id="bundle-total">₹{{ number_format($product->price, 0) }}</p>
                </div>
            </div>

            <div class="bg-gradient-to-br from-orange-50 to-amber-50 dark:from-gray-800 dark:to-gray-700 rounded-2xl p-6 border-2 border-orange-200 dark:border-orange-900">
                {{-- Main Product (Always Included) --}}
                <div class="flex items-center gap-4 p-4 bg-white dark:bg-gray-800 rounded-xl shadow-md mb-4 border-2 border-orange-400 dark:border-orange-600">
                    <div class="flex-shrink-0">
                        <div class="w-16 h-16 rounded-lg overflow-hidden bg-gradient-to-br from-orange-100 to-amber-100 dark:from-orange-900 dark:to-amber-900 flex items-center justify-center">
                            @if($product->image)
                                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                            @else
                                <span class="material-icons text-orange-600">image</span>
                            @endif
                        </div>
                    </div>
                    <div class="flex-1">
                        <h4 class="font-bold text-gray-900 dark:text-white">{{ Str::limit($product->name, 50) }}</h4>
                        <p class="text-sm text-gray-600 dark:text-gray-400">This item (included)</p>
                    </div>
                    <div class="text-right">
                        <p class="text-xl font-extrabold text-gray-900 dark:text-white">₹{{ number_format($product->price, 0) }}</p>
                        <span class="inline-flex items-center px-2 py-1 rounded-full bg-orange-500 text-white text-xs font-bold">
                            <span class="material-icons text-xs mr-1">check</span>
                            Main Item
                        </span>
                    </div>
                </div>

                {{-- Related Products (Optional) --}}
                <div class="space-y-3">
                    @foreach($relatedProducts->take(3) as $relatedProduct)
                    <label class="flex items-center gap-4 p-4 bg-white dark:bg-gray-800 rounded-xl shadow-md hover:shadow-lg transition-all cursor-pointer border-2 border-transparent hover:border-blue-400 dark:hover:border-blue-600 bundle-item">
                        <div class="flex-shrink-0">
                            <input type="checkbox" 
                                   class="bundle-checkbox w-5 h-5 text-blue-600 rounded focus:ring-2 focus:ring-blue-500" 
                                   data-product-id="{{ $relatedProduct->id }}"
                                   data-product-price="{{ $relatedProduct->price }}"
                                   data-product-name="{{ $relatedProduct->name }}">
                        </div>
                        <div class="flex-shrink-0">
                            <div class="w-16 h-16 rounded-lg overflow-hidden bg-gradient-to-br from-blue-100 to-indigo-100 dark:from-blue-900 dark:to-indigo-900 flex items-center justify-center">
                                @if($relatedProduct->image)
                                    <img src="{{ $relatedProduct->image_url }}" alt="{{ $relatedProduct->name }}" class="w-full h-full object-cover">
                                @else
                                    <span class="material-icons text-blue-600">image</span>
                                @endif
                            </div>
                        </div>
                        <div class="flex-1">
                            <h4 class="font-bold text-gray-900 dark:text-white">{{ Str::limit($relatedProduct->name, 50) }}</h4>
                            <div class="flex items-center gap-2 mt-1">
                                @if($relatedProduct->stock_quantity > 0)
                                    <span class="text-xs text-green-600 dark:text-green-400 font-semibold flex items-center gap-1">
                                        <span class="material-icons text-xs">check_circle</span>
                                        In Stock
                                    </span>
                                @else
                                    <span class="text-xs text-red-600 dark:text-red-400 font-semibold flex items-center gap-1">
                                        <span class="material-icons text-xs">cancel</span>
                                        Out of Stock
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-xl font-extrabold text-gray-900 dark:text-white">₹{{ number_format($relatedProduct->price, 0) }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">+ Add to bundle</p>
                        </div>
                    </label>
                    @endforeach
                </div>

                {{-- Add Bundle to Cart Button --}}
                <div class="mt-6 pt-6 border-t-2 border-orange-200 dark:border-orange-900">
                    <button onclick="addBundleToCart()" 
                            class="w-full bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white py-4 px-8 rounded-xl font-bold text-lg transition-all shadow-xl hover:shadow-2xl transform hover:scale-105 flex items-center justify-center gap-3"
                            id="add-bundle-btn">
                        <span class="material-icons text-2xl">shopping_basket</span>
                        <span>Add Selected Items to Cart (<span id="bundle-count">1</span> items)</span>
                    </button>
                    <p class="text-center text-sm text-gray-600 dark:text-gray-400 mt-3">
                        💡 Save time by adding multiple items at once!
                    </p>
                </div>
            </div>
        </div>
        @endif

        {{-- Related Products --}}
        @if($relatedProducts->count() > 0)
        <div class="mt-16 sm:mt-24 border-t-2 border-gray-200 pt-16">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-extrabold tracking-tight text-gray-900 mb-2">
                    Related Products
                </h2>
                <p class="text-gray-600 font-semibold">You might also like these</p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @include('customer.products.partials.products-grid', ['products' => $relatedProducts])
            </div>
        </div>
        @endif
    </div>
</div>

{{-- Lightbox Modal (Hidden by default) --}}
<div id="lightbox-modal" class="fixed inset-0 z-50 hidden bg-black/95 backdrop-blur-sm flex items-center justify-center p-4 opacity-0 transition-opacity duration-300">
    <button id="close-lightbox" class="absolute top-6 right-6 text-gray-400 hover:text-white focus:outline-none transition-colors p-2 rounded-full hover:bg-white/10">
        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
    </button>
    
    <div class="relative w-full h-full flex items-center justify-center">
        @if($product->image)
            <img src="{{ $product->image_url }}" 
                 alt="{{ $product->name }}" 
                 class="max-w-full max-h-[90vh] object-contain rounded-lg shadow-2xl transform scale-95 transition-transform duration-300"
                 id="lightbox-image">
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('zoom-container');
        const img = document.getElementById('main-product-image');
        const lightbox = document.getElementById('lightbox-modal');
        const lightboxImg = document.getElementById('lightbox-image');
        const triggerBtn = document.getElementById('trigger-lightbox');
        const closeBtn = document.getElementById('close-lightbox');
        const zoomLevel = document.getElementById('zoom-level');
        
        let currentZoom = 1;
        const minZoom = 1;
        const maxZoom = 4;
        const zoomStep = 0.5;
        
        // --- Enhanced Hover Zoom Logic ---
        if (container && img) {
            container.addEventListener('mousemove', function(e) {
                const { left, top, width, height } = container.getBoundingClientRect();
                const x = (e.clientX - left) / width * 100;
                const y = (e.clientY - top) / height * 100;

                img.style.transformOrigin = `${x}% ${y}%`;
                img.style.transform = `scale(${currentZoom})`;
                
                if (currentZoom > 1 && zoomLevel) {
                    zoomLevel.style.opacity = '1';
                }
            });

            container.addEventListener('mouseleave', function() {
                if (currentZoom === 1) {
                    img.style.transformOrigin = 'center center';
                    img.style.transform = 'scale(1)';
                }
                if (zoomLevel) {
                    zoomLevel.style.opacity = '0';
                }
            });
        }

        // Zoom control functions
        window.zoomIn = function() {
            if (currentZoom < maxZoom) {
                currentZoom = Math.min(currentZoom + zoomStep, maxZoom);
                updateZoom();
            }
        };

        window.zoomOut = function() {
            if (currentZoom > minZoom) {
                currentZoom = Math.max(currentZoom - zoomStep, minZoom);
                updateZoom();
            }
        };

        window.resetZoom = function() {
            currentZoom = minZoom;
            updateZoom();
        };

        function updateZoom() {
            if (img) {
                img.style.transform = `scale(${currentZoom})`;
            }
            if (zoomLevel) {
                zoomLevel.textContent = `${Math.round(currentZoom * 100)}%`;
                zoomLevel.style.opacity = currentZoom > 1 ? '1' : '0';
            }
        }

        // --- Lightbox Logic ---
        function openLightbox() {
            if(!lightbox) return;
            lightbox.classList.remove('hidden');
            // Small delay to allow display:block to apply before opacity transition
            setTimeout(() => {
                lightbox.classList.remove('opacity-0');
                if(lightboxImg) lightboxImg.classList.remove('scale-95');
            }, 10);
            document.body.style.overflow = 'hidden'; // Prevent scrolling
        }

        function closeLightbox() {
            if(!lightbox) return;
            lightbox.classList.add('opacity-0');
            if(lightboxImg) lightboxImg.classList.add('scale-95');
            
            setTimeout(() => {
                lightbox.classList.add('hidden');
                document.body.style.overflow = ''; // Restore scrolling
            }, 300);
        }

        // Triggers
        if (triggerBtn) triggerBtn.addEventListener('click', openLightbox);
        if (container) container.addEventListener('click', openLightbox); // Also open on image click
        if (closeBtn) closeBtn.addEventListener('click', closeLightbox);

        // Close on background click
        if (lightbox) {
            lightbox.addEventListener('click', function(e) {
                if (e.target === lightbox || e.target.closest('.relative') === e.target) {
                    closeLightbox();
                }
            });
        }
        
        // Close on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && !lightbox.classList.contains('hidden')) {
                closeLightbox();
            }
        });

        // --- STAR RATING LOGIC (JS FIX) ---
        const stars = document.querySelectorAll('.star-btn');
        const ratingInput = document.getElementById('rating-input');
        const starContainer = document.getElementById('star-rating-container');

        if(stars.length > 0 && ratingInput && starContainer) {
            function updateStarVisuals(value) {
                stars.forEach(star => {
                    const starValue = parseInt(star.getAttribute('data-value'));
                    if (starValue <= value) {
                        star.classList.remove('text-gray-600');
                        star.classList.add('text-yellow-400');
                    } else {
                        star.classList.add('text-gray-600');
                        star.classList.remove('text-yellow-400');
                    }
                });
            }

            stars.forEach(star => {
                // Click event to set value
                star.addEventListener('click', function() {
                    const value = parseInt(this.getAttribute('data-value'));
                    ratingInput.value = value;
                    updateStarVisuals(value);
                });

                // Hover event for temporary highlight
                star.addEventListener('mouseenter', function() {
                    const value = parseInt(this.getAttribute('data-value'));
                    updateStarVisuals(value);
                });
            });

            // Reset to selected value when mouse leaves container
            starContainer.addEventListener('mouseleave', function() {
                const currentValue = ratingInput.value ? parseInt(ratingInput.value) : 0;
                updateStarVisuals(currentValue);
            });
        }

        // --- MICRO-INTERACTIONS: Add to Cart Animation ---
        const addToCartForm = document.getElementById('add-to-cart-form');
        const addToCartBtn = document.getElementById('add-to-cart-btn');
        
        if (addToCartForm && addToCartBtn) {
            addToCartForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const flyingIcon = addToCartBtn.querySelector('.flying-cart-icon');
                const btnText = document.getElementById('btn-text');
                const cartIcon = document.getElementById('cart-icon');
                
                // Get cart icon position in header
                const headerCart = document.querySelector('#cart-count').parentElement;
                const btnRect = addToCartBtn.getBoundingClientRect();
                const cartRect = headerCart.getBoundingClientRect();
                
                // Calculate distance to fly
                const deltaX = cartRect.left - btnRect.left;
                const deltaY = cartRect.top - btnRect.top;
                
                // Show and animate the flying icon
                if (flyingIcon) {
                    flyingIcon.style.opacity = '1';
                    flyingIcon.style.transform = `translate(${deltaX}px, ${deltaY}px) scale(0.3)`;
                    flyingIcon.style.transition = 'all 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94)';
                }
                
                // Button feedback
                addToCartBtn.classList.add('scale-95');
                cartIcon.classList.add('animate-bounce');
                btnText.textContent = 'Adding...';
                
                // Submit form after animation
                setTimeout(() => {
                    this.submit();
                }, 400);
            });
        }

        // --- Bundle Functionality ---
        const bundleCheckboxes = document.querySelectorAll('.bundle-checkbox');
        const bundleTotalEl = document.getElementById('bundle-total');
        const bundleCountEl = document.getElementById('bundle-count');
        const mainProductPrice = {{ $product->price }};
        
        function updateBundleTotal() {
            let total = mainProductPrice;
            let count = 1;
            
            bundleCheckboxes.forEach(checkbox => {
                if (checkbox.checked) {
                    total += parseFloat(checkbox.dataset.productPrice);
                    count++;
                }
            });
            
            if (bundleTotalEl) {
                bundleTotalEl.textContent = '₹' + total.toLocaleString('en-IN');
            }
            if (bundleCountEl) {
                bundleCountEl.textContent = count;
            }
        }
        
        bundleCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', updateBundleTotal);
        });
        
        window.addBundleToCart = function() {
            const selectedProducts = [{{ $product->id }}];
            
            bundleCheckboxes.forEach(checkbox => {
                if (checkbox.checked) {
                    selectedProducts.push(parseInt(checkbox.dataset.productId));
                }
            });
            
            if (selectedProducts.length === 0) {
                showToast('Please select at least one product', 'error');
                return;
            }
            
            const btn = document.getElementById('add-bundle-btn');
            const originalHtml = btn.innerHTML;
            btn.disabled = true;
            btn.innerHTML = '<span class="material-icons animate-spin">refresh</span> Adding to cart...';
            
            // Add products sequentially
            let addedCount = 0;
            selectedProducts.forEach((productId, index) => {
                $.ajax({
                    url: `/cart/add/${productId}`,
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        'Accept': 'application/json'
                    },
                    data: { quantity: 1 },
                    success: function(response) {
                        addedCount++;
                        if (addedCount === selectedProducts.length) {
                            $('#cart-count').text(response.count);
                            btn.innerHTML = '<span class="material-icons">check_circle</span> Added to Cart!';
                            btn.classList.remove('from-orange-500', 'to-orange-600');
                            btn.classList.add('from-green-500', 'to-green-600');
                            
                            showToast(`Successfully added ${addedCount} items to cart!`, 'success');
                            
                            setTimeout(() => {
                                btn.innerHTML = originalHtml;
                                btn.classList.remove('from-green-500', 'to-green-600');
                                btn.classList.add('from-orange-500', 'to-orange-600');
                                btn.disabled = false;
                                bundleCheckboxes.forEach(cb => cb.checked = false);
                                updateBundleTotal();
                            }, 2000);
                        }
                    },
                    error: function() {
                        btn.innerHTML = originalHtml;
                        btn.disabled = false;
                        showToast('Error adding some items to cart', 'error');
                    }
                });
            });
        };
        
        function showToast(message, type = 'info') {
            if (typeof Toastify !== 'undefined') {
                const backgrounds = {
                    success: 'linear-gradient(135deg, #10b981 0%, #059669 100%)',
                    error: 'linear-gradient(135deg, #ef4444 0%, #dc2626 100%)',
                    info: 'linear-gradient(135deg, #3b82f6 0%, #2563eb 100%)'
                };
                
                Toastify({
                    text: message,
                    duration: 3000,
                    gravity: 'top',
                    position: 'right',
                    style: {
                        background: backgrounds[type] || backgrounds.info
                    }
                }).showToast();
            }
        }
    });
</script>

<style>
    /* Micro-interaction styles */
    .flying-cart-icon {
        pointer-events: none;
        z-index: 9999;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
    }
    
    @keyframes heartBeat {
        0%, 100% { transform: scale(1); }
        25% { transform: scale(1.1); }
        50% { transform: scale(0.95); }
        75% { transform: scale(1.05); }
    }

    /* Enhanced zoom controls */
    #zoom-controls {
        backdrop-filter: blur(10px);
    }

    #zoom-level {
        backdrop-filter: blur(10px);
    }
</style>
@endpush