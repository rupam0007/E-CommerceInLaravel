<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nexora | Admin Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@700;900&family=Work+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'sans': ['Work Sans', 'ui-sans-serif', 'system-ui'],
                        'serif': ['Merriweather', 'ui-serif', 'Georgia'],
                    },
                    colors: {
                        'indigo': {
                            50: '#eef2ff',
                            100: '#e0e7ff',
                            300: '#a5b4fc',
                            400: '#818cf8',
                            500: '#6366f1',
                            600: '#4f46e5',
                            700: '#4338ca',
                            800: '#3730a3',
                        },
                        'gray': {
                            100: '#f3f4f6',
                            200: '#e5e7eb',
                            300: '#d1d5db',
                            400: '#9ca3af',
                            500: '#6b7280',
                            600: '#4b5563',
                            700: '#374151',
                            800: '#1f2937',
                            900: '#111827',
                        }
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-gray-900 font-sans antialiased">

    <div class="min-h-screen flex items-center justify-center">
        <div class="w-full max-w-5xl p-4">
            <div class="flex flex-col md:flex-row bg-gray-800 shadow-2xl rounded-2xl overflow-hidden border border-gray-700">

                <div class="w-full md:w-1/2 p-10 sm:p-12 flex flex-col justify-center bg-gradient-to-br from-indigo-700 to-indigo-800 text-white relative overflow-hidden">
                    <div class="absolute -top-16 -right-16 w-40 h-40 bg-indigo-600 rounded-full opacity-30"></div>
                    <div class="absolute -bottom-24 -left-12 w-48 h-48 bg-indigo-600 rounded-full opacity-30"></div>

                    <div class="relative z-10">
                        <a href="{{ route('admin.dashboard') }}" class="text-5xl font-bold font-serif">
                            Nexora
                        </a>
                        <p class="text-lg text-indigo-100 mt-4">
                            Administration Panel.
                        </p>
                    </div>
                </div>

                <div class="w-full md:w-1/2 p-10 sm:p-12">
                    <div class="text-right mb-4">
                        <a href="{{ route('login') }}" class="text-sm font-medium text-indigo-400 hover:text-indigo-300 transition-colors">
                            User Login
                        </a>
                    </div>

                    <h2 class="text-3xl font-bold font-serif text-white mb-2">
                        Admin Login
                    </h2>
                    <p class="text-sm text-gray-300 mb-8">
                        Enter your admin credentials below.
                    </p>

                    <form method="POST" action="{{ route('admin.login') }}" class="space-y-6">
                        @csrf

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-300 mb-1">Email address</label>
                            <input id="email" type="email" name="email" value="{{ old('email') }}"
                                required autofocus
                                class="w-full px-4 py-3 border border-gray-600 rounded-lg shadow-sm text-sm bg-gray-700 text-white
                                          focus:ring-indigo-400 focus:border-indigo-400 focus:bg-gray-600 transition-colors"
                                placeholder="admin@example.com">
                            @error('email')
                            <p class="text-sm text-red-400 mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-300 mb-1">Password</label>
                            <input id="password" type="password" name="password" required
                                class="w-full px-4 py-3 border border-gray-600 rounded-lg shadow-sm text-sm bg-gray-700 text-white
                                          focus:ring-indigo-400 focus:border-indigo-400 focus:bg-gray-600 transition-colors"
                                placeholder="Enter your password">
                            @error('password')
                            <p class="text-sm text-red-400 mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between">
                            <label class="flex items-center text-sm text-gray-300">
                                <input type="checkbox" name="remember" class="h-4 w-4 rounded border-gray-600 bg-gray-700 text-indigo-500 focus:ring-indigo-400">
                                <span class="ml-2">Remember me</span>
                            </label>
                        </div>

                        <div>
                            <button type="submit"
                                class="w-full bg-indigo-500 text-white py-3 px-4 rounded-lg font-semibold shadow-md hover:bg-indigo-600
                                       focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-300 transform hover:-translate-y-0.5">
                                Sign In
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>