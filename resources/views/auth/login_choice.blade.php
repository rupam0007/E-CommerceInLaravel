<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Choice</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-sm">
        <h2 class="text-2xl font-bold text-center mb-6">Login As</h2>
        <div class="space-y-4">
            {{-- --- FIX: Route 'login.user' se 'login' mein change kiya gaya hai --- --}}
            <a href="{{ route('login') }}"
                class="block w-full text-center bg-blue-600 text-white py-2 rounded-md font-medium hover:bg-blue-700 transition-colors">
                Login as User
            </a>

            <a href="{{ route('admin.login') }}"
                class="block w-full text-center bg-gray-600 text-white py-2 rounded-md font-medium hover:bg-gray-700 transition-colors">
                Login as Admin
            </a>
        </div>
        <p class="text-sm text-gray-600 text-center mt-6">
            Don't have an account?
            {{-- --- FIX: Route 'register' se 'register.choice' mein change kiya gaya hai --- --}}
            <a href="{{ route('register.choice') }}" class="font-medium text-blue-600 hover:text-blue-500">
                Register here
            </a>
        </p>
    </div>
</body>

</html>