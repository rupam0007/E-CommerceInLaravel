@extends('layouts.app')

@section('title', 'Nexora - Your E-commerce Destination')

@section('content')

<!-- Hero Section with Interactive Background -->
<div class="relative overflow-hidden theme-bg">
    <!-- Animated Background -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="hero-gradient"></div>
        <div class="floating-shapes">
            <div class="shape shape-1"></div>
            <div class="shape shape-2"></div>
            <div class="shape shape-3"></div>
            <div class="shape shape-4"></div>
            <div class="shape shape-5"></div>
        </div>
    </div>

    <!-- Hero Content -->
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 sm:py-32">
        <div class="text-center">
            <!-- Animated Badge -->
            <div class="inline-flex items-center px-4 py-2 rounded-full mb-8 animate-fade-in-down"
                 style="background: linear-gradient(135deg, rgba(129, 140, 248, 0.1), rgba(99, 102, 241, 0.1)); border: 1px solid rgba(129, 140, 248, 0.2);">
                <span class="relative flex h-2 w-2 mr-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-indigo-500"></span>
                </span>
                <span class="text-sm font-medium theme-accent">New Arrivals Available</span>
            </div>

            <!-- Main Heading with Typing Effect -->
            <h1 class="text-5xl md:text-7xl font-bold font-serif mb-6 leading-tight animate-fade-in">
                <span class="block bg-gradient-to-r from-indigo-400 via-purple-400 to-pink-400 bg-clip-text text-transparent">
                    Welcome to Nexora
                </span>
            </h1>

            <!-- Subtitle with Stagger Animation -->
            <p class="text-lg md:text-xl theme-text-muted mb-10 max-w-2xl mx-auto animate-fade-in-up leading-relaxed">
                Discover premium products, cutting-edge technology, and unbeatable deals. 
                <span class="theme-accent font-semibold">Your journey to excellence starts here.</span>
            </p>

            <!-- Interactive CTA Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center animate-fade-in-up" style="animation-delay: 0.2s;">
                <a href="{{ route('products.index') }}"
                    class="group relative inline-flex items-center justify-center px-8 py-4 font-semibold text-white transition-all duration-300 bg-gradient-to-r from-indigo-600 to-purple-600 rounded-xl hover:shadow-2xl hover:shadow-indigo-500/50 hover:-translate-y-1 overflow-hidden">
                    <span class="absolute inset-0 w-full h-full bg-gradient-to-r from-purple-600 to-pink-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
                    <span class="relative flex items-center">
                        <svg class="w-5 h-5 mr-2 group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        Shop Now
                    </span>
                </a>
                <a href="#featured"
                    class="group relative inline-flex items-center justify-center px-8 py-4 font-semibold theme-text-muted transition-all duration-300 theme-card rounded-xl hover:shadow-xl hover:-translate-y-1 border theme-border">
                    <span class="relative flex items-center">
                        Explore Products
                        <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </span>
                </a>
            </div>

            <!-- Stats Counter -->
            <div class="grid grid-cols-3 gap-8 mt-16 max-w-3xl mx-auto animate-fade-in-up" style="animation-delay: 0.4s;">
                <div class="text-center">
                    <div class="text-3xl md:text-4xl font-bold theme-accent counter" data-target="1000">0</div>
                    <div class="text-sm theme-text-muted mt-1">Products</div>
                </div>
                <div class="text-center border-l border-r theme-border">
                    <div class="text-3xl md:text-4xl font-bold theme-accent counter" data-target="5000">0</div>
                    <div class="text-sm theme-text-muted mt-1">Happy Customers</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl md:text-4xl font-bold theme-accent counter" data-target="50">0</div>
                    <div class="text-sm theme-text-muted mt-1">Categories</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scroll Indicator -->
    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
        <svg class="w-6 h-6 theme-text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
        </svg>
    </div>
</div>

<div class="bg-gray-900 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center p-6">
                <div class="w-12 h-12 bg-indigo-900 text-indigo-400 rounded-lg flex items-center justify-center mx-auto mb-5">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-white mb-2">Fast Delivery</h3>
                <p class="text-gray-300 text-sm">Free shipping on orders over $50. Get your products quickly.</p>
            </div>

            <div class="text-center p-6">
                <div class="w-12 h-12 bg-indigo-900 text-indigo-400 rounded-lg flex items-center justify-center mx-auto mb-5">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H4a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-white mb-2">Secure Payment</h3>
                <p class="text-gray-300 text-sm">Your payment information is protected with bank-level security.</p>
            </div>

            <div class="text-center p-6">
                <div class="w-12 h-12 bg-indigo-900 text-indigo-400 rounded-lg flex items-center justify-center mx-auto mb-5">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-white mb-2">Premium Quality</h3>
                <p class="text-gray-300 text-sm">All products are carefully selected to ensure the highest quality.</p>
            </div>
        </div>
    </div>
</div>


<div class="bg-gray-800 py-16 sm:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold font-serif text-white text-center mb-12">
            Explore Top Categories
        </h2>

        <div class="flex space-x-6 overflow-x-auto pb-4 -mb-4 scrollbar-thin scrollbar-thumb-gray-600 scrollbar-track-gray-800">

            @php
            $brands = [
            ['name' => 'Mobile', 'icon' => '<svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
            </svg>'],
            ['name' => 'Laptop', 'icon' => '<svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
            </svg>'],
            ['name' => 'Tablets', 'icon' => '<svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
            </svg>'],
            ['name' => 'Watch', 'icon' => '<svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>'],
            ['name' => 'Cameras', 'icon' => '<svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>'],
            ['name' => 'Headphones', 'icon' => '<svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"></path>
            </svg>'],
            ['name' => 'Gaming', 'icon' => '<svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
            </svg>']
            ];
            @endphp

            @foreach ($brands as $brand)
            <div class="flex-shrink-0 w-36">
                <a href="{{ route('products.index') }}" class="flex flex-col items-center justify-center p-6 bg-gray-700 rounded-lg border border-gray-600 hover:bg-indigo-900 hover:border-indigo-700 hover:shadow-sm transition-all text-center">
                    <div class="w-16 h-16 bg-indigo-900 text-indigo-400 rounded-full flex items-center justify-center mb-3">
                        {!! $brand['icon'] !!}
                    </div>
                    <span class="text-sm font-semibold text-white">{{ $brand['name'] }}</span>
                </a>
            </div>
            @endforeach

        </div>
    </div>
</div>

@if($categories->count() > 0)
<div class="bg-gray-900 py-16 sm:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold font-serif text-white text-center mb-12">
            Shop by Category
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($categories as $category)
            <div class="group relative bg-gray-800 rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow border border-gray-700">
                <div class="aspect-w-3 aspect-h-2">
                    @if($category->image)
                    <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="w-full h-full object-cover">
                    @else
                    <div class="w-full h-full bg-gray-700 flex items-center justify-center">
                        <span class="text-gray-400 font-medium">{{ $category->name }}</span>
                    </div>
                    @endif
                </div>
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-white">
                        <a href="{{ route('products.category', $category) }}" class="hover:text-indigo-400">
                            <span class="absolute inset-0"></span>
                            {{ $category->name }}
                        </a>
                    </h3>
                    <p class="text-sm text-gray-300 mt-1">{{ Str::limit($category->description, 50) }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif

@if($featuredProducts->count() > 0)
<div class="bg-gray-800 py-16 sm:py-24" id="featured">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold font-serif text-white text-center mb-12">
            Featured Products
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @include('customer.products.partials.products-grid', ['products' => $featuredProducts])
        </div>
        <div class="text-center mt-12">
            <a href="{{ route('products.index') }}"
                class="bg-indigo-500 text-white px-8 py-3 rounded-md font-semibold text-base hover:bg-indigo-600 transition-all duration-300 shadow-sm">
                View All Products
            </a>
        </div>
    </div>
</div>
@endif

@endsection

@push('scripts')
<style>
    /* Scrollbar Styles */
    .scrollbar-thin::-webkit-scrollbar {
        height: 6px;
    }

    .scrollbar-thin::-webkit-scrollbar-track {
        background: #1f2937;
        border-radius: 10px;
    }

    .scrollbar-thin::-webkit-scrollbar-thumb {
        background: #4b5563;
        border-radius: 10px;
    }

    .scrollbar-thin::-webkit-scrollbar-thumb:hover {
        background: #6b7280;
    }

    /* Hero Animated Background */
    .hero-gradient {
        position: absolute;
        inset: 0;
        background: radial-gradient(circle at 20% 50%, rgba(129, 140, 248, 0.15) 0%, transparent 50%),
                    radial-gradient(circle at 80% 80%, rgba(167, 139, 250, 0.15) 0%, transparent 50%),
                    radial-gradient(circle at 40% 20%, rgba(99, 102, 241, 0.1) 0%, transparent 50%);
        animation: gradientShift 15s ease infinite;
    }

    @keyframes gradientShift {
        0%, 100% {
            opacity: 1;
            transform: scale(1);
        }
        50% {
            opacity: 0.8;
            transform: scale(1.1);
        }
    }

    /* Floating Shapes */
    .floating-shapes {
        position: absolute;
        inset: 0;
        overflow: hidden;
    }

    .shape {
        position: absolute;
        border-radius: 50%;
        filter: blur(40px);
        opacity: 0.3;
        animation: float 20s infinite;
    }

    .shape-1 {
        width: 300px;
        height: 300px;
        background: linear-gradient(135deg, #818cf8, #6366f1);
        top: 10%;
        left: 10%;
        animation-delay: 0s;
    }

    .shape-2 {
        width: 200px;
        height: 200px;
        background: linear-gradient(135deg, #a78bfa, #8b5cf6);
        top: 60%;
        right: 10%;
        animation-delay: 5s;
    }

    .shape-3 {
        width: 250px;
        height: 250px;
        background: linear-gradient(135deg, #ec4899, #db2777);
        bottom: 10%;
        left: 50%;
        animation-delay: 10s;
    }

    .shape-4 {
        width: 180px;
        height: 180px;
        background: linear-gradient(135deg, #6366f1, #4f46e5);
        top: 30%;
        right: 30%;
        animation-delay: 3s;
    }

    .shape-5 {
        width: 220px;
        height: 220px;
        background: linear-gradient(135deg, #8b5cf6, #7c3aed);
        bottom: 30%;
        left: 20%;
        animation-delay: 7s;
    }

    @keyframes float {
        0%, 100% {
            transform: translate(0, 0) rotate(0deg);
        }
        33% {
            transform: translate(30px, -30px) rotate(120deg);
        }
        66% {
            transform: translate(-20px, 20px) rotate(240deg);
        }
    }

    /* Fade In Animations */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fade-in {
        animation: fadeIn 1s ease-out forwards;
    }

    .animate-fade-in-down {
        animation: fadeInDown 0.8s ease-out forwards;
    }

    .animate-fade-in-up {
        animation: fadeInUp 1s ease-out forwards;
        opacity: 0;
    }

    /* Gradient Text Animation */
    @keyframes gradientText {
        0%, 100% {
            background-position: 0% 50%;
        }
        50% {
            background-position: 100% 50%;
        }
    }

    .bg-gradient-to-r {
        background-size: 200% auto;
        animation: gradientText 3s ease infinite;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Counter Animation
        const counters = document.querySelectorAll('.counter');
        const speed = 200;

        counters.forEach(counter => {
            const animate = () => {
                const value = +counter.getAttribute('data-target');
                const data = +counter.innerText;
                const time = value / speed;

                if (data < value) {
                    counter.innerText = Math.ceil(data + time);
                    setTimeout(animate, 1);
                } else {
                    counter.innerText = value + '+';
                }
            };

            // Use Intersection Observer for counter animation
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        animate();
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.5 });

            observer.observe(counter);
        });

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                const href = this.getAttribute('href');
                if (href !== '#') {
                    e.preventDefault();
                    const target = document.querySelector(href);
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                }
            });
        });

        // Parallax effect on scroll
        let ticking = false;
        window.addEventListener('scroll', function() {
            if (!ticking) {
                window.requestAnimationFrame(function() {
                    const scrolled = window.pageYOffset;
                    const parallaxElements = document.querySelectorAll('.floating-shapes');
                    parallaxElements.forEach(element => {
                        element.style.transform = `translateY(${scrolled * 0.5}px)`;
                    });
                    ticking = false;
                });
                ticking = true;
            }
        });
    });
</script>
@endpush