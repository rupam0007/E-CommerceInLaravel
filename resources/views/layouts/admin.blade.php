<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-m">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Nexora Admin')</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700;900&family=Work+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-900 text-gray-300">
    <div class="flex h-screen bg-gray-900">
        
        <aside class="w-64 bg-gray-800 border-r border-gray-700 shadow-md">
            <div class="flex items-center justify-center h-16 bg-gray-800 border-b border-gray-700">
                <a href="{{ route('admin.dashboard') }}" class="font-serif text-2xl font-bold text-indigo-400">
                    Nexora Admin
                </a>
            </div>
            <nav class="mt-6">
                <a href="{{ route('admin.dashboard') }}" class="block px-6 py-3 text-sm font-medium {{ request()->routeIs('admin.dashboard') ? 'text-indigo-400 bg-gray-700' : 'text-gray-300 hover:bg-gray-700' }} transition-colors">
                    Dashboard
                </a>
                <a href="#" class="block px-6 py-3 text-sm font-medium text-gray-300 hover:bg-gray-700 transition-colors">
                    Products
                </a>
                <a href="#" class="block px-6 py-3 text-sm font-medium text-gray-300 hover:bg-gray-700 transition-colors">
                    Orders
                </a>
                <a href="#" class="block px-6 py-3 text-sm font-medium text-gray-300 hover:bg-gray-700 transition-colors">
                    Customers
                </a>
                <a href="#" class="block px-6 py-3 text-sm font-medium text-gray-300 hover:bg-gray-700 transition-colors">
                    Reports
                </a>
            </nav>
        </aside>

        
        <div class="flex-1 flex flex-col overflow-hidden">
            
            <header class="flex items-center justify-between h-16 px-6 bg-gray-800 border-b border-gray-700 shadow-md">
                <div>
                    <h1 class="text-xl font-semibold text-white">@yield('title')</h1>
                </div>
                <div>
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button type="submit" class="text-sm font-medium text-gray-300 hover:text-indigo-400">
                            Log Out
                        </button>
                    </form>
                </div>
            </header>

            
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-900 p-6 sm:p-8">
                @yield('content')
            </main>
        </div>
    </div>
</body>

</html>