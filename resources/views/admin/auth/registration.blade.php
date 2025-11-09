@extends('layouts.app')

@section('title', 'Admin • Register')

@section('content')
<div class="max-w-md mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-2xl font-semibold mb-6">Admin Registration </h1>

    <form method="POST" action="{{ route('admin.register') }}" class="bg-white rounded-md shadow p-6 space-y-4">
        @csrf
        <div>
            <label class="block text-sm font-medium text-gray-700">Name</label>
            <input type="text" name="name" value="{{ old('name') }}" required class="mt-1 w-full border rounded-md px-3 py-2" />
            @error('name')
                <div class="text-sm text-red-600 mt-1">{{ $message }}</div>
            @enderror
        </div>
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
            @error('password')
                <div class="text-sm text-red-600 mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Confirm Password</label>
            <input type="password" name="password_confirmation" required class="mt-1 w-full border rounded-md px-3 py-2" />
        </div>
        <button type="submit" class="w-full bg-gray-900 hover:bg-black text-white px-4 py-2 rounded-md">Create Admin</button>
        <div class="text-sm text-gray-700 mt-3">
            Already have an account? <a href="{{ route('admin.login') }}" class="underline">Login</a>
        </div>
    </form>
</div>
@endsection
