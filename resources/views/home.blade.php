<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nexora | Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Crimson+Text:wght@400;600&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
</head>
<body class="bg-gray-50 min-h-screen">

    {{-- Navigation --}}
    <nav class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <h1 class="text-xl font-bold text-indigo-600" style="font-family: 'Crimson Text', serif;">
                        Nexora
                    </h1>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-gray-700" style="font-family: 'Inter', sans-serif;">
                        Welcome, {{ Auth::user()->name }}!
                    </span>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" 
                                class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors"
                                style="font-family: 'Inter', sans-serif;">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    {{-- Main Content --}}
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm rounded-lg">
            <div class="p-6 text-center">
                <div class="mx-auto h-16 w-16 bg-green-100 rounded-full flex items-center justify-center mb-4">
                    <svg class="h-8 w-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-900 mb-2" style="font-family: 'Crimson Text', serif;">
                    Registration Successful!
                </h2>
                <p class="text-gray-600 mb-6" style="font-family: 'Inter', sans-serif;">
                    Welcome to Nexora, {{ Auth::user()->name }}. Your account has been created successfully.
                </p>
                
                {{-- User Information Card --}}
                <div class="bg-gray-50 rounded-lg p-6 max-w-md mx-auto">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4" style="font-family: 'Inter', sans-serif;">
                        Your Account Details
                    </h3>
                    <div class="space-y-3 text-left">
                        <div class="flex justify-between">
                            <span class="text-gray-600" style="font-family: 'Inter', sans-serif;">Name:</span>
                            <span class="font-medium text-gray-900" style="font-family: 'Inter', sans-serif;">{{ Auth::user()->name }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600" style="font-family: 'Inter', sans-serif;">Email:</span>
                            <span class="font-medium text-gray-900" style="font-family: 'Inter', sans-serif;">{{ Auth::user()->email }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600" style="font-family: 'Inter', sans-serif;">Joined:</span>
                            <span class="font-medium text-gray-900" style="font-family: 'Inter', sans-serif;">{{ Auth::user()->created_at->format('M d, Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
