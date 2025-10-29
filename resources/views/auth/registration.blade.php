<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nexora | Register</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Crimson+Text:wght@400;600&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        .classic-shadow {
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }
        .classic-input {
            border: 2px solid #e5e7eb;
            transition: all 0.3s ease;
        }
        .classic-input:focus {
            border-color: #4f46e5;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }
        .classic-btn {
            background: #111827; /* gray-900 */
            transition: background-color 0.2s ease;
        }
        .classic-btn:hover {
            background: #000000; /* black */
        }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">

    <div class="max-w-md w-full space-y-8">
        {{-- Header Section --}}
        <div class="text-center">
            <h2 class="text-3xl font-bold text-gray-900" style="font-family: 'Crimson Text', serif;">
                Create Your Account
            </h2>
            <p class="mt-2 text-sm text-gray-700" style="font-family: 'Inter', sans-serif;">
                Join Nexora and get started today
            </p>
        </div>

        {{-- Registration Form --}}
        <div class="bg-white classic-shadow rounded-lg px-8 py-10">
            <form id="registration-form" method="POST" action="{{ route('register') }}" data-redirect="{{ route('home') }}" class="space-y-6">
                @csrf

                {{-- Name Field --}}
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-800 mb-2" style="font-family: 'Inter', sans-serif;">
                        Full Name
                    </label>
                    <input id="name" 
                           type="text" 
                           name="name" 
                           value="{{ old('name') }}" 
                           required 
                           autofocus
                           class="classic-input appearance-none relative block w-full px-4 py-3 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:z-10 sm:text-sm"
                           placeholder="Enter your full name"
                           style="font-family: 'Inter', sans-serif;">
                    @error('name')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-2 text-sm text-red-600 hidden field-error" data-error-for="name"></p>
                </div>

                {{-- Email Field --}}
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-800 mb-2" style="font-family: 'Inter', sans-serif;">
                        Email Address
                    </label>
                    <input id="email" 
                           type="email" 
                           name="email" 
                           value="{{ old('email') }}" 
                           required
                           class="classic-input appearance-none relative block w-full px-4 py-3 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:z-10 sm:text-sm"
                           placeholder="Enter your email address"
                           style="font-family: 'Inter', sans-serif;">
                    @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-2 text-sm text-red-600 hidden field-error" data-error-for="email"></p>
                </div>

                {{-- Password Field --}}
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-800 mb-2" style="font-family: 'Inter', sans-serif;">
                        Password
                    </label>
                    <input id="password" 
                           type="password" 
                           name="password" 
                           required
                           class="classic-input appearance-none relative block w-full px-4 py-3 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:z-10 sm:text-sm"
                           placeholder="Create a secure password"
                           style="font-family: 'Inter', sans-serif;">
                    @error('password')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-2 text-sm text-red-600 hidden field-error" data-error-for="password"></p>
                </div>

                {{-- Confirm Password Field --}}
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-800 mb-2" style="font-family: 'Inter', sans-serif;">
                        Confirm Password
                    </label>
                    <input id="password_confirmation" 
                           type="password" 
                           name="password_confirmation" 
                           required
                           class="classic-input appearance-none relative block w-full px-4 py-3 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:z-10 sm:text-sm"
                           placeholder="Confirm your password"
                           style="font-family: 'Inter', sans-serif;">
                </div>

                {{-- Remember Me Checkbox --}}
                <div class="flex items-center">
                    <input id="remember" 
                           name="remember" 
                           type="checkbox" 
                           class="h-4 w-4 text-gray-900 focus:ring-gray-500 border-gray-300 rounded">
                    <label for="remember" class="ml-2 block text-sm text-gray-700" style="font-family: 'Inter', sans-serif;">
                        Remember me on this device
                    </label>
                </div>

                {{-- Register Button --}}
                <div class="pt-4">
                    <button id="register-submit" type="submit"
                            class="classic-btn group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-md text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                            style="font-family: 'Inter', sans-serif;">
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                            <svg class="h-5 w-5 text-gray-300 group-hover:text-gray-200" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                            </svg>
                        </span>
                        <span class="submit-text">Create Account</span>
                        <span class="submit-loading hidden">Processing...</span>
                    </button>
                </div>
            </form>

            {{-- Login Link --}}
            <div class="mt-8 text-center">
                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-white text-gray-500" style="font-family: 'Inter', sans-serif;">
                            Already have an account?
                        </span>
                    </div>
                </div>
                <div class="mt-4">
                    <a href="{{ route('login') }}" 
                       class="font-medium text-gray-900 hover:text-black transition-colors duration-200"
                       style="font-family: 'Inter', sans-serif;">
                        Sign in to your account
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        (function () {
            const form = document.getElementById('registration-form');
            if (!form) return;
            const submitBtn = document.getElementById('register-submit');
            const submitText = submitBtn ? submitBtn.querySelector('.submit-text') : null;
            const submitLoading = submitBtn ? submitBtn.querySelector('.submit-loading') : null;

            function setLoading(state) {
                if (!submitBtn) return;
                submitBtn.disabled = state;
                if (submitText) submitText.classList.toggle('hidden', state);
                if (submitLoading) submitLoading.classList.toggle('hidden', !state);
                submitBtn.classList.toggle('opacity-75', state);
                submitBtn.classList.toggle('cursor-not-allowed', state);
            }

            function clearErrors() {
                document.querySelectorAll('.field-error').forEach((el) => {
                    el.textContent = '';
                    el.classList.add('hidden');
                });
            }

            function showErrors(errors) {
                Object.keys(errors || {}).forEach((field) => {
                    const el = document.querySelector(`.field-error[data-error-for="${field}"]`);
                    if (el) {
                        el.textContent = Array.isArray(errors[field]) ? errors[field][0] : errors[field];
                        el.classList.remove('hidden');
                    }
                });
            }

            form.addEventListener('submit', async function (e) {
                e.preventDefault();
                clearErrors();
                setLoading(true);
                try {
                    const formData = new FormData(form);
                    const res = await fetch(form.action, {
                        method: 'POST',
                        headers: {
                            Accept: 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                        },
                        body: formData,
                        credentials: 'same-origin',
                    });

                    const data = await res.json().catch(() => ({}));
                    if (!res.ok) {
                        if (res.status === 422) {
                            showErrors(data.errors || {});
                        } else {
                            alert(data.message || 'Something went wrong. Please try again.');
                        }
                        return;
                    }

                    // Success: redirect
                    const redirectUrl = data.redirect || form.dataset.redirect;
                    window.location.href = redirectUrl;
                } catch (err) {
                    alert('Network error. Please check your connection and try again.');
                } finally {
                    setLoading(false);
                }
            });
        })();
    </script>
</body>
</html>
