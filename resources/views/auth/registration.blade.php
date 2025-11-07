<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nexora | Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Crimson+Text:wght@400;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'sans': ['Inter', 'ui-sans-serif', 'system-ui'],
                        'serif': ['Crimson Text', 'ui-serif', 'Georgia'],
                    },
                    colors: {
                        'indigo': {
                            500: '#6366f1',
                            600: '#4f46e5',
                            700: '#4338ca'
                        },
                    }
                }
            }
        }
    </script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="bg-gray-50 font-sans min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">

    <div class="max-w-md w-full space-y-8">
        {{-- Header Section --}}
        <div class="text-center">
            <a href="{{ route('home') }}" class="text-4xl font-bold font-serif text-gray-900">
                Nexora
            </a>
            <h2 class="mt-4 text-3xl font-semibold font-serif text-gray-900">
                Create your account
            </h2>
            <p class="mt-2 text-sm text-gray-600">
                Or <a href="{{ route('login') }}" class="font-medium text-indigo-600 hover:text-indigo-500">sign in to your existing account</a>
            </p>
        </div>

        {{-- Registration Form --}}
        <div class="bg-white shadow-sm border border-gray-200 rounded-lg p-8">
            <form id="registration-form" method="POST" action="{{ route('register') }}" data-redirect="{{ route('home') }}" class="space-y-6">
                @csrf

                {{-- Name Field --}}
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                        class="mt-1 classic-input appearance-none relative block w-full px-4 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        placeholder="Enter your full name">
                    <p class="mt-2 text-sm text-red-600 hidden field-error" data-error-for="name"></p>
                </div>

                {{-- Email Field --}}
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required
                        class="mt-1 classic-input appearance-none relative block w-full px-4 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        placeholder="Enter your email address">
                    <p class="mt-2 text-sm text-red-600 hidden field-error" data-error-for="email"></p>
                </div>

                {{-- Password Field --}}
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input id="password" type="password" name="password" required
                        class="mt-1 classic-input appearance-none relative block w-full px-4 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        placeholder="Create a secure password">
                    <p class="mt-2 text-sm text-red-600 hidden field-error" data-error-for="password"></p>
                </div>

                {{-- Confirm Password Field --}}
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required
                        class="mt-1 classic-input appearance-none relative block w-full px-4 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        placeholder="Confirm your password">
                </div>

                {{-- Remember Me Checkbox --}}
                <div class="flex items-center">
                    <input id="remember" name="remember" type="checkbox"
                        class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                    <label for="remember" class="ml-2 block text-sm text-gray-700">
                        Remember me
                    </label>
                </div>


                {{-- Register Button --}}
                <div>
                    <button id="register-submit" type="submit"
                        class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 shadow-sm transition-colors">
                        <span class="submit-text">Create Account</span>
                        <span class="submit-loading hidden">Processing...</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- This script remains identical to your original --}}
    <script>
        (function() {
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

            form.addEventListener('submit', async function(e) {
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
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
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