@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="max-w-md mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-2xl font-semibold mb-6 text-center">Choose Registration Type</h1>
    <div class="bg-white rounded-md shadow p-6 space-y-4">
        <a href="{{ route('register.user') }}" class="w-full block text-center bg-gray-900 hover:bg-black text-white px-4 py-2 rounded-md">Register as User</a>
        <a href="{{ route('admin.register') }}" class="w-full block text-center border px-4 py-2 rounded-md">Register as Admin</a>
    </div>
</div>
@endsection
