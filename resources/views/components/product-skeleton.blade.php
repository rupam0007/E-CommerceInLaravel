{{-- Skeleton loader for product cards --}}
<div class="group bg-white rounded-2xl overflow-hidden border-2 border-gray-100 shadow-lg animate-pulse">
    {{-- Image Skeleton --}}
    <div class="relative aspect-square bg-gradient-to-br from-gray-200 to-gray-300">
        <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/30 to-transparent skeleton-shimmer"></div>
    </div>

    {{-- Content Skeleton --}}
    <div class="p-5">
        {{-- Title Skeleton --}}
        <div class="h-5 bg-gray-300 rounded-lg mb-3 w-3/4"></div>
        <div class="h-4 bg-gray-200 rounded-lg mb-4 w-1/2"></div>

        {{-- Rating Skeleton --}}
        <div class="flex items-center gap-2 mb-4">
            <div class="h-6 w-16 bg-gray-300 rounded-lg"></div>
            <div class="h-4 w-24 bg-gray-200 rounded-lg"></div>
        </div>

        {{-- Price Skeleton --}}
        <div class="flex items-baseline gap-2 mb-5">
            <div class="h-7 w-24 bg-gray-300 rounded-lg"></div>
            <div class="h-5 w-16 bg-gray-200 rounded-lg"></div>
        </div>

        {{-- Button Skeleton --}}
        <div class="h-12 bg-gray-300 rounded-xl"></div>
    </div>
</div>

<style>
    @keyframes shimmer {
        0% {
            transform: translateX(-100%);
        }
        100% {
            transform: translateX(100%);
        }
    }

    .skeleton-shimmer {
        animation: shimmer 2s infinite;
    }
</style>
