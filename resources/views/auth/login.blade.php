<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nexora | Login</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="min-h-screen flex items-center justify-center bg-gray-100">

    <div class="w-full max-w-md bg-white rounded-lg shadow p-8">
        <h2 class="text-2xl font-bold text-center text-gray-900 mb-6" style="font-family: 'Crimson Text', serif;">
            Sign in to Nexora
        </h2>

        {{-- Session Status --}}
        @if(session('status'))
            <div class="mb-4 text-green-600 text-sm text-center">
                {{ session('status') }}
            </div>
        @endif
        {{-- Login Form --}}
        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            {{-- Email --}}
            <div>
                <label for="email" class="block text-gray-700 font-semibold">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" 
                       required autofocus 
                       class="w-full px-4 py-3 mt-1 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-gray-400 focus:outline-none">
                @error('email')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Password --}}
            <div>
                <label for="password" class="block text-gray-700 font-semibold">Password</label>
                <input id="password" type="password" name="password" required 
                       class="w-full px-4 py-3 mt-1 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-gray-400 focus:outline-none">
                @error('password')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Remember Me --}}
            <div class="flex items-center justify-between">
                <label class="flex items-center text-gray-600">
                    <input type="checkbox" name="remember" class="mr-2 rounded">
                    Remember Me
                </label>
                <a href="#" class="text-sm text-gray-700 hover:underline">Forgot Password?</a>
            </div>

            {{-- Login Button --}}
            <button type="submit" 
                    class="w-full bg-gray-900 text-white py-3 rounded-md font-medium shadow hover:bg-black transition-colors">
                Login
            </button>
        </form>

        {{-- Links --}}
        <div class="mt-6 text-center text-gray-700">
            Don't have an account? 
            <a href="{{ route('register') }}" class="text-gray-900 font-medium hover:underline">Register</a>
        </div>
    </div>

</body>
</html>
