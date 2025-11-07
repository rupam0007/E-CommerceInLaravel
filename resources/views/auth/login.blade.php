<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nexora | Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Crimson+Text:wght@400;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'sans': ['Inter', 'ui-sans-serif', 'system-ui'],
                        'serif': ['Crimson Text', 'ui-serif', 'Georgia'],
                    },
                    colors: {
                        'indigo': {
                            600: '#4f46e5',
                            700: '#4338ca'
                        },
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-gray-50 font-sans min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">

    <div class="max-w-md w-full space-y-8">
        {{-- Header Section --}}
        <div class="text-center">
            <a href="{{ route('home') }}" class="text-4xl font-bold font-serif text-gray-900">
                Nexora
            </a>
            <h2 class="mt-4 text-3xl font-semibold font-serif text-gray-900">
                Sign in to your account
            </h2>
            <p class="mt-2 text-sm text-gray-600">
                Or <a href="{{ route('register') }}" class="font-medium text-indigo-600 hover:text-indigo-500">register for a new account</a>
            </p>
        </div>

        {{-- Login Form --}}
        <div class="bg-white shadow-sm border border-gray-200 rounded-lg p-8 space-y-6">
            {{-- Session Status --}}
            @if(session('status'))
            <div class="text-green-600 text-sm">
                {{ session('status') }}
            </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
                    <div class="mt-1">
                        <input id="email" type="email" name="email" value="{{ old('email') }}"
                            required autofocus
                            class="w-full px-4 py-3 mt-1 border border-gray-300 rounded-md shadow-sm text-sm
                                      focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    @error('email')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password --}}
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <div class="mt-1">
                        <input id="password" type="password" name="password" required
                            class="w-full px-4 py-3 mt-1 border border-gray-300 rounded-md shadow-sm text-sm
                                      focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    @error('password')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Remember Me & Forgot --}}
                <div class="flex items-center justify-between">
                    <label class="flex items-center text-sm text-gray-700">
                        <input type="checkbox" name="remember" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                        <span class="ml-2">Remember me</span>
                    </label>
                    <a href="#" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">Forgot password?</a>
                </div>

                {{-- Login Button --}}
                <div>
                    <button type="submit"
                        class="w-full bg-indigo-600 text-white py-3 px-4 rounded-md font-medium shadow-sm hover:bg-indigo-700
                                   focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                        Sign in
                    </button>
                </div>
            </form>
        </div>
    </div>

</body>

</html>