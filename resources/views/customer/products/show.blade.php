@extends('layouts.app')

@section('title', $product->name . ' - Nexora')

@section('content')
<div class="bg-gray-900 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16">

        {{-- Breadcrumb --}}
        <nav class="flex mb-8" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2">
                <li class="inline-flex items-center">
                    <a href="{{ route('home') }}" class="text-sm font-medium text-gray-400 hover:text-white transition-colors">Home</a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <a href="{{ route('products.index') }}" class="ml-1 text-sm font-medium text-gray-400 hover:text-white transition-colors md:ml-2">Products</a>
                    </div>
                </li>
                @if($product->category)
                <li>
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <a href="{{ route('products.category', $product->category) }}" class="ml-1 text-sm font-medium text-gray-400 hover:text-white transition-colors md:ml-2">{{ $product->category->name }}</a>
                    </div>
                </li>
                @endif
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">{{ Str::limit($product->name, 30) }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="lg:grid lg:grid-cols-2 lg:gap-x-12 lg:items-start">

            {{-- Product Image Section --}}
            <div class="relative group">
                {{-- Main Image --}}
                <div id="zoom-container" class="aspect-w-1 aspect-h-1 w-full rounded-lg border border-gray-700 bg-gray-800 overflow-hidden shadow-lg relative z-10">
                    @if($product->image)
                        <img src="{{ $product->image_url }}" 
                             alt="{{ $product->name }}"
                             id="main-product-image"
                             class="w-full h-full object-center object-cover transition-transform duration-200 ease-out cursor-crosshair">
                    @else
                        <div class="w-full h-full bg-gray-800 flex items-center justify-center">
                            <svg class="h-24 w-24 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    @endif
                </div>

                {{-- Zoom Icon Button (FIXED: Always visible, high z-index) --}}
                @if($product->image)
                <button type="button" id="trigger-lightbox" 
                        class="absolute top-4 right-4 z-50 p-3 bg-black/70 hover:bg-indigo-600 text-white rounded-full transition-all duration-300 focus:outline-none shadow-xl border border-gray-600/50 backdrop-blur-sm transform hover:scale-110"
                        title="Expand Image">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path>
                    </svg>
                </button>
                @endif
            </div>

            {{-- Product Info --}}
            <div class="mt-10 px-4 sm:px-0 sm:mt-16 lg:mt-0">
                <h1 class="text-4xl font-bold font-serif tracking-tight text-white">
                    {{ $product->name }}
                </h1>

                {{-- Rating Summary --}}
                <div class="mt-3 flex items-center">
                    <div class="flex items-center">
                        @php $rating = $product->reviews_avg_rating ?? 0; @endphp
                        @for($i = 1; $i <= 5; $i++)
                            <svg class="h-5 w-5 flex-shrink-0 {{ $i <= round($rating) ? 'text-yellow-400' : 'text-gray-600' }}" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                        @endfor
                    </div>
                    <p class="sr-only">{{ $rating }} out of 5 stars</p>
                    <a href="#reviews" class="ml-3 text-sm font-medium text-indigo-400 hover:text-indigo-300 transition-colors">{{ $product->reviews_count }} reviews</a>
                </div>

                <div class="mt-4">
                    <p class="text-3xl text-indigo-400 font-sans font-bold">₹{{ number_format($product->price, 2) }}</p>
                </div>

                <div class="mt-6">
                    @if($product->stock_quantity > 0)
                    <div class="flex items-center">
                        <span class="flex items-center justify-center w-6 h-6 rounded-full bg-green-900/50 text-green-400 mr-2">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                        </span>
                        <p class="text-sm text-green-400 font-medium">In stock ({{ $product->stock_quantity }} available)</p>
                    </div>
                    @else
                    <div class="flex items-center">
                         <span class="flex items-center justify-center w-6 h-6 rounded-full bg-red-900/50 text-red-400 mr-2">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </span>
                        <p class="text-sm text-red-400 font-medium">Out of stock</p>
                    </div>
                    @endif
                </div>

                <div class="mt-6">
                    <h3 class="text-sm font-medium text-white">Description</h3>
                    <div class="mt-4 text-base text-gray-400 space-y-4 leading-relaxed">
                        <p>{{ $product->description }}</p>
                    </div>
                </div>

                @if($product->stock_quantity > 0)
                <form action="{{ route('cart.add', $product) }}" method="POST" class="mt-8">
                    @csrf
                    <div class="flex items-center gap-4">
                        <div class="w-32">
                            <label for="quantity" class="block text-sm font-medium text-gray-400 mb-1">Quantity</label>
                            <div class="relative">
                                <select name="quantity" id="quantity"
                                    class="block w-full pl-3 pr-10 py-3 text-base bg-gray-800 border-gray-700 text-white focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md shadow-sm">
                                    @for($i = 1; $i <= min(10, $product->stock_quantity); $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="flex-1 pt-6">
                            <button type="submit"
                                class="w-full bg-indigo-600 border border-transparent rounded-md py-3 px-8 flex items-center justify-center text-base font-semibold text-white hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 shadow-lg transition-all duration-200 transform hover:-translate-y-0.5">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                Add to Cart
                            </button>
                        </div>
                    </div>
                </form>
                @else
                <div class="mt-8">
                    <button disabled
                        class="w-full bg-gray-800 border border-gray-700 rounded-md py-3 px-8 flex items-center justify-center text-base font-medium text-gray-500 cursor-not-allowed">
                        Out of Stock
                    </button>
                </div>
                @endif

                <div class="mt-8 border-t border-gray-700 pt-8">
                    <h3 class="text-base font-semibold text-white">Product Details</h3>
                    <div class="mt-4 grid grid-cols-1 gap-y-3 gap-x-4 sm:grid-cols-2 text-sm">
                        <div class="bg-gray-800 p-3 rounded-md border border-gray-700">
                            <span class="block font-medium text-gray-400 text-xs uppercase tracking-wider">SKU</span>
                            <dd class="mt-1 text-white font-mono">{{ $product->sku }}</dd>
                        </div>
                        <div class="bg-gray-800 p-3 rounded-md border border-gray-700">
                            <span class="block font-medium text-gray-400 text-xs uppercase tracking-wider">Category</span>
                            <dd class="mt-1 text-white">{{ optional($product->category)->name ?? 'N/A' }}</dd>
                        </div>
                        @if($product->weight)
                        <div class="bg-gray-800 p-3 rounded-md border border-gray-700">
                            <span class="block font-medium text-gray-400 text-xs uppercase tracking-wider">Weight</span>
                            <dd class="mt-1 text-white">{{ $product->weight }} kg</dd>
                        </div>
                        @endif
                        @if($product->dimensions)
                        <div class="bg-gray-800 p-3 rounded-md border border-gray-700">
                            <span class="block font-medium text-gray-400 text-xs uppercase tracking-wider">Dimensions</span>
                            <dd class="mt-1 text-white">{{ $product->dimensions }}</dd>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-16 pt-10 border-t border-gray-800" id="reviews">
            <h2 class="text-2xl font-bold text-white mb-8">Customer Reviews</h2>
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                <div class="lg:col-span-2">
                    @if($product->reviews->count() > 0)
                        <div class="space-y-6">
                            @foreach($product->reviews as $review)
                                <div class="bg-gray-800 rounded-lg p-6 border border-gray-700 shadow-sm">
                                    <div class="flex items-center mb-4">
                                        <div class="flex-shrink-0">
                                            <span class="inline-flex items-center justify-center h-10 w-10 rounded-full bg-indigo-600 shadow-md">
                                                <span class="text-sm font-bold leading-none text-white">{{ strtoupper(substr($review->user->name, 0, 1)) }}</span>
                                            </span>
                                        </div>
                                        <div class="ml-4">
                                            <h4 class="text-sm font-bold text-white">{{ $review->user->name }}</h4>
                                            <div class="flex items-center mt-1">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <svg class="w-3.5 h-3.5 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-600' }}" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                    </svg>
                                                @endfor
                                                <span class="ml-2 text-xs text-gray-500">{{ $review->created_at->diffForHumans() }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-gray-300 text-sm leading-relaxed">
                                        {{ $review->comment }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="bg-gray-800 rounded-lg p-8 text-center border border-gray-700 border-dashed">
                            <svg class="mx-auto h-12 w-12 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                            <h3 class="mt-2 text-sm font-medium text-white">No reviews yet</h3>
                            <p class="mt-1 text-sm text-gray-400">Be the first to share your thoughts about this product.</p>
                        </div>
                    @endif
                </div>

                <div>
                    <div class="bg-gray-800 p-6 rounded-lg border border-gray-700 shadow-lg sticky top-24">
                        <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
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
                                    <label for="comment" class="block text-sm font-medium text-gray-400 mb-2">Your Review</label>
                                    <textarea name="comment" id="comment" rows="4" 
                                        class="block w-full rounded-md bg-gray-700 border-gray-600 text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm placeholder-gray-500" 
                                        placeholder="What did you like or dislike?" required></textarea>
                                </div>

                                <button type="submit" class="w-full bg-indigo-600 text-white py-2.5 px-4 rounded-md hover:bg-indigo-500 transition-colors font-medium shadow-md">
                                    Submit Review
                                </button>
                            </form>
                        @else
                            <div class="text-center py-8 bg-gray-700/50 rounded-md border border-gray-700 border-dashed">
                                <p class="text-gray-400 mb-4">Please login to write a review.</p>
                                <a href="{{ route('login') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-indigo-100 bg-indigo-700 hover:bg-indigo-600">
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
        <div class="mt-16 sm:mt-24 border-t border-gray-800 pt-16">
            <h2 class="text-3xl font-bold font-serif tracking-tight text-white text-center mb-12">
                Related Products
            </h2>
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