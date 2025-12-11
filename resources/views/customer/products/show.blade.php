@extends('layouts.app')

@section('title', $product->name . ' - Nexora')

@section('content')
<div class="bg-[#F5EFE6] min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16">

        {{-- Breadcrumb --}}
        <nav class="flex mb-8" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 bg-white px-5 py-3 rounded-full shadow-lg border-2 border-gray-100">
                <li class="inline-flex items-center">
                    <a href="{{ route('home') }}" class="text-sm font-semibold text-blue-600 hover:text-blue-700 transition-colors">Home</a>
                </li>
                <li>
                    <div class="flex items-center">
                        <span class="material-icons text-gray-400 text-sm">chevron_right</span>
                        <a href="{{ route('products.index') }}" class="ml-1 text-sm font-semibold text-blue-600 hover:text-blue-700 transition-colors md:ml-2">Products</a>
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
                <div id="zoom-container" class="aspect-w-1 aspect-h-1 w-full rounded-2xl border-2 border-gray-100 bg-white overflow-hidden shadow-xl relative z-10 hover:shadow-2xl transition-shadow">
                    @if($product->image)
                        <img src="{{ $product->image_url }}" 
                             alt="{{ $product->name }}"
                             id="main-product-image"
                             class="w-full h-full object-center object-cover transition-transform duration-200 ease-out cursor-crosshair">
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-blue-100 to-purple-100 flex items-center justify-center">
                            <span class="material-icons text-gray-400" style="font-size: 120px;">image</span>
                        </div>
                    @endif
                </div>

                {{-- Zoom Icon Button --}}
                @if($product->image)
                <button type="button" id="trigger-lightbox" 
                        class="absolute top-4 right-4 z-50 p-3 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white rounded-full transition-all duration-300 focus:outline-none shadow-xl transform hover:scale-110"
                        title="Expand Image">
                    <span class="material-icons">zoom_in</span>
                </button>
                @endif
            </div>

            {{-- Product Info --}}
            <div class="mt-10 px-4 sm:px-0 sm:mt-16 lg:mt-0">
                <h1 class="text-4xl font-extrabold tracking-tight text-gray-900 leading-tight">
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

                <div class="mt-8 p-6 bg-white rounded-xl border-2 border-gray-100 shadow-md">
                    <h3 class="text-lg font-bold text-gray-900 mb-3 flex items-center">
                        <span class="material-icons text-blue-600 mr-2">description</span>
                        Product Description
                    </h3>
                    <div class="text-base text-gray-700 space-y-2 leading-relaxed">
                        <p>{{ $product->description }}</p>
                    </div>
                </div>

                @if($product->stock_quantity > 0)
                <form action="{{ route('cart.add', $product) }}" method="POST" class="mt-8">
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
                            <button type="submit"
                                class="w-full bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 border border-transparent rounded-xl py-4 px-8 flex items-center justify-center text-lg font-bold text-white focus:outline-none focus:ring-4 focus:ring-orange-300 shadow-xl transition-all duration-200 transform hover:scale-105">
                                <span class="material-icons mr-2">shopping_cart</span>
                                Add to Cart
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
        
        // --- Hover Zoom Logic ---
        if (container && img) {
            container.addEventListener('mousemove', function(e) {
                const { left, top, width, height } = container.getBoundingClientRect();
                // Calculate percentage position
                const x = (e.clientX - left) / width * 100;
                const y = (e.clientY - top) / height * 100;

                // Move origin to cursor position and scale
                img.style.transformOrigin = `${x}% ${y}%`;
                img.style.transform = 'scale(2.5)'; // Adjust zoom level here
            });

            container.addEventListener('mouseleave', function() {
                // Reset
                img.style.transformOrigin = 'center center';
                img.style.transform = 'scale(1)';
            });
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
    });
</script>
@endpush