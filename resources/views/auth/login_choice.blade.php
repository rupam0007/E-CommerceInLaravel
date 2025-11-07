@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="max-w-md mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-2xl font-semibold mb-6 text-center">Choose Login Type</h1>
    <div class="bg-white rounded-md shadow p-6 space-y-4">
        <a href="{{ route('login.user') }}" class="w-full block text-center bg-gray-900 hover:bg-black text-white px-4 py-2 rounded-md">Login as User</a>
        <a href="{{ route('admin.login') }}" class="w-full block text-center border px-4 py-2 rounded-md">Login as Admin</a>
    </div>
</div>
@endsection
