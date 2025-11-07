<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Choice</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-sm">
        <h2 class="text-2xl font-bold text-center mb-6">Register As</h2>
        <div class="space-y-4">
            {{-- --- FIX: Route 'register.user' se 'register' mein change kiya gaya hai --- --}}
            <a href="{{ route('register') }}"
                class="block w-full text-center bg-blue-600 text-white py-2 rounded-md font-medium hover:bg-blue-700 transition-colors">
                Register as User
            </a>

            <a href="{{ route('admin.register') }}"
                class="block w-full text-center bg-gray-600 text-white py-2 rounded-md font-medium hover:bg-gray-700 transition-colors">
                Register as Admin
            </a>
        </div>
        <p class="text-sm text-gray-600 text-center mt-6">
            Already have an account?
            {{-- --- FIX: Route 'login' se 'login.choice' mein change kiya gaya hai --- --}}
            <a href="{{ route('login.choice') }}" class="font-medium text-blue-600 hover:text-blue-500">
                Login here
            </a>
        </p>
    </div>
</body>

</html>