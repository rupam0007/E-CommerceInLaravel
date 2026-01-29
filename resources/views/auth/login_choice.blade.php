<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Nexora</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'sans': ['Plus Jakarta Sans', 'system-ui', 'sans-serif'],
                    },
                    colors: {
                        'primary': {
                            50: '#fef7f0',
                            100: '#fdecd8',
                            200: '#fad5b0',
                            300: '#f6b77e',
                            400: '#f18f4a',
                            500: '#ed6c28',
                            600: '#de521d',
                            700: '#b83d1a',
                        },
                        'dark': {
                            50: '#f8fafc',
                            100: '#f1f5f9',
                            200: '#e2e8f0',
                            300: '#cbd5e1',
                            400: '#94a3b8',
                            500: '#64748b',
                            600: '#475569',
                            700: '#334155',
                            800: '#1e293b',
                            900: '#0f172a',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        * { font-family: 'Plus Jakarta Sans', system-ui, sans-serif; }
    </style>
</head>
<body class="bg-dark-50 antialiased min-h-screen">

    <div class="min-h-screen flex">
        <!-- Left Panel - Decorative -->
        <div class="hidden lg:flex lg:w-1/2 bg-gradient-to-br from-dark-900 via-dark-800 to-dark-900 relative overflow-hidden">
            <!-- Background Pattern -->
            <div class="absolute inset-0 opacity-10">
                <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                    <defs>
                        <pattern id="grid" width="8" height="8" patternUnits="userSpaceOnUse">
                            <path d="M 8 0 L 0 0 0 8" fill="none" stroke="white" stroke-width="0.5"/>
                        </pattern>
                    </defs>
                    <rect width="100" height="100" fill="url(#grid)"/>
                </svg>
            </div>
            
            <!-- Decorative Circles -->
            <div class="absolute top-20 right-20 w-64 h-64 bg-primary-500/20 rounded-full blur-3xl"></div>
            <div class="absolute bottom-20 left-20 w-96 h-96 bg-primary-500/10 rounded-full blur-3xl"></div>
            
            <!-- Content -->
            <div class="relative z-10 flex flex-col justify-between p-12 w-full">
                <div>
                    <a href="{{ route('home') }}" class="inline-flex items-center gap-2">
                        <div class="w-10 h-10 bg-primary-500 rounded-xl flex items-center justify-center">
                            <span class="material-icons-outlined text-white text-xl">shopping_bag</span>
                        </div>
                        <span class="text-2xl font-bold text-white">Nexora</span>
                    </a>
                </div>
                
                <div class="max-w-md">
                    <h1 class="text-4xl font-bold text-white mb-4">Welcome back!</h1>
                    <p class="text-dark-300 text-lg leading-relaxed">
                        Sign in to access your account, track orders, and enjoy personalized shopping experience.
                    </p>
                    
                    <!-- Features -->
                    <div class="mt-10 space-y-4">
                        <div class="flex items-center gap-3 text-dark-200">
                            <span class="material-icons-outlined text-primary-400">check_circle</span>
                            <span>Track your orders in real-time</span>
                        </div>
                        <div class="flex items-center gap-3 text-dark-200">
                            <span class="material-icons-outlined text-primary-400">check_circle</span>
                            <span>Save items to your wishlist</span>
                        </div>
                        <div class="flex items-center gap-3 text-dark-200">
                            <span class="material-icons-outlined text-primary-400">check_circle</span>
                            <span>Faster checkout experience</span>
                        </div>
                    </div>
                </div>
                
                <p class="text-dark-500 text-sm">© 2026 Nexora. All rights reserved.</p>
            </div>
        </div>

        <!-- Right Panel - Form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-6 sm:p-12">
            <div class="w-full max-w-md">
                <!-- Mobile Logo -->
                <div class="lg:hidden mb-8 text-center">
                    <a href="{{ route('home') }}" class="inline-flex items-center gap-2">
                        <div class="w-10 h-10 bg-primary-500 rounded-xl flex items-center justify-center">
                            <span class="material-icons-outlined text-white text-xl">shopping_bag</span>
                        </div>
                        <span class="text-2xl font-bold text-dark-800">Nexora</span>
                    </a>
                </div>

                <!-- Admin Link -->
                <div class="text-right mb-6">
                    <a href="{{ route('admin.login') }}" class="text-sm font-medium text-dark-500 hover:text-primary-500 transition-colors">
                        Admin Login →
                    </a>
                </div>

                <div class="text-center mb-8">
                    <h2 class="text-2xl font-bold text-dark-900 mb-2">Sign in to your account</h2>
                    <p class="text-dark-500">
                        Don't have an account? 
                        <a href="{{ route('register') }}" class="font-semibold text-primary-500 hover:text-primary-600 transition-colors">
                            Create one
                        </a>
                    </p>
                </div>

                @if(session('status'))
                <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl text-sm mb-6 flex items-center gap-2">
                    <span class="material-icons-outlined text-lg">check_circle</span>
                    {{ session('status') }}
                </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label for="email" class="block text-sm font-medium text-dark-700 mb-2">Email address</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 material-icons-outlined text-dark-400 text-xl">mail</span>
                            <input id="email" type="email" name="email" value="{{ old('email') }}"
                                required autofocus
                                class="w-full pl-12 pr-4 py-3.5 border border-dark-200 rounded-xl text-sm bg-white text-dark-800
                                       focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all"
                                placeholder="you@example.com">
                        </div>
                        @error('email')
                        <p class="text-sm text-red-500 mt-2 flex items-center gap-1">
                            <span class="material-icons-outlined text-sm">error</span>
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-dark-700 mb-2">Password</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 material-icons-outlined text-dark-400 text-xl">lock</span>
                            <input id="password" type="password" name="password" required
                                class="w-full pl-12 pr-12 py-3.5 border border-dark-200 rounded-xl text-sm bg-white text-dark-800
                                       focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all"
                                placeholder="Enter your password">
                            <button type="button" onclick="togglePassword('password')" class="absolute right-4 top-1/2 -translate-y-1/2 text-dark-400 hover:text-dark-600 transition-colors focus:outline-none">
                                <svg id="password-eye-open" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                <svg id="password-eye-closed" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                                </svg>
                            </button>
                        </div>
                        @error('password')
                        <p class="text-sm text-red-500 mt-2 flex items-center gap-1">
                            <span class="material-icons-outlined text-sm">error</span>
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between">
                        <label class="flex items-center cursor-pointer">
                            <input type="checkbox" name="remember" 
                                   class="w-4 h-4 rounded border-dark-300 text-primary-500 focus:ring-primary-500/20">
                            <span class="ml-2 text-sm text-dark-600">Remember me</span>
                        </label>
                        <a href="#" class="text-sm font-medium text-primary-500 hover:text-primary-600 transition-colors">
                            Forgot password?
                        </a>
                    </div>

                    <button type="submit"
                        class="w-full bg-dark-900 hover:bg-dark-800 text-white py-4 px-6 rounded-xl font-semibold
                               transition-all duration-300 hover:shadow-lg hover:shadow-dark-900/20 flex items-center justify-center gap-2">
                        Sign In
                        <span class="material-icons-outlined text-lg">arrow_forward</span>
                    </button>
                </form>

                <!-- Divider -->
                <div class="relative my-8">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-dark-200"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-4 bg-dark-50 text-dark-500">Or continue with</span>
                    </div>
                </div>

                <!-- Social Login -->
                <div class="grid grid-cols-2 gap-4">
                    <button type="button" class="flex items-center justify-center gap-2 px-4 py-3 border border-dark-200 rounded-xl
                                                 hover:bg-dark-100 transition-colors text-dark-700 font-medium text-sm">
                        <svg class="w-5 h-5" viewBox="0 0 24 24">
                            <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                            <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                            <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                            <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                        </svg>
                        Google
                    </button>
                    <button type="button" class="flex items-center justify-center gap-2 px-4 py-3 border border-dark-200 rounded-xl
                                                 hover:bg-dark-100 transition-colors text-dark-700 font-medium text-sm">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.477 2 2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.879V14.89h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.989C18.343 21.129 22 16.99 22 12c0-5.523-4.477-10-10-10z"/>
                        </svg>
                        Facebook
                    </button>
                </div>

                <!-- Back to Home -->
                <p class="text-center mt-8 text-sm text-dark-500">
                    <a href="{{ route('home') }}" class="inline-flex items-center gap-1 hover:text-primary-500 transition-colors">
                        <span class="material-icons-outlined text-sm">arrow_back</span>
                        Back to home
                    </a>
                </p>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const eyeOpen = document.getElementById(inputId + '-eye-open');
            const eyeClosed = document.getElementById(inputId + '-eye-closed');
            
            if (input.type === 'password') {
                input.type = 'text';
                eyeOpen.classList.remove('hidden');
                eyeClosed.classList.add('hidden');
            } else {
                input.type = 'password';
                eyeOpen.classList.add('hidden');
                eyeClosed.classList.remove('hidden');
            }
        }
    </script>
</body>
</html>
