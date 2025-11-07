@extends('layouts.app')

@section('title', 'Admin • Login')

@section('content')
<div class="max-w-md mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-2xl font-semibold mb-6">Admin Login</h1>

    <form method="POST" action="{{ route('admin.login') }}" class="bg-white rounded-md shadow p-6 space-y-4">
        @csrf
        <div>
            <label class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required class="mt-1 w-full border rounded-md px-3 py-2" />
            @error('email')
                <div class="text-sm text-red-600 mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password" name="password" required class="mt-1 w-full border rounded-md px-3 py-2" />
        </div>
        <div class="flex items-center justify-between">
            <label class="inline-flex items-center gap-2">
                <input type="checkbox" name="remember" class="border rounded" />
                <span class="text-sm text-gray-700">Remember me</span>
            </label>
            <a href="{{ route('admin.register') }}" class="text-sm text-gray-700 underline">Register</a>
        </div>
        <button type="submit" class="w-full bg-gray-900 hover:bg-black text-white px-4 py-2 rounded-md">Login</button>
    </form>
</div>
@endsection
