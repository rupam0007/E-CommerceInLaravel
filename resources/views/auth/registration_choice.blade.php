<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nexora | Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@700;900&family=Work+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'sans': ['Work Sans', 'ui-sans-serif', 'system-ui'],
                        'serif': ['Merriweather', 'ui-serif', 'Georgia'],
                    },
                    colors: {
                        'indigo': {
                            50: '#eef2ff',
                            100: '#e0e7ff',
                            300: '#a5b4fc',
                            400: '#818cf8',
                            500: '#6366f1',
                            600: '#4f46e5',
                            700: '#4338ca',
                            800: '#3730a3',
                        },
                        'gray': {
                            100: '#f3f4f6',
                            200: '#e5e7eb',
                            300: '#d1d5db',
                            400: '#9ca3af',
                            500: '#6b7280',
                            600: '#4b5563',
                            700: '#374151',
                            800: '#1f2937',
                            900: '#111827',
                        }
                    }
                }
            }
        }
    </script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="bg-gray-900 font-sans antialiased">

    <div class="min-h-screen flex items-center justify-center">
        <div class="w-full max-w-5xl p-4">
            <div class="flex flex-col md:flex-row bg-gray-800 shadow-2xl rounded-2xl overflow-hidden border border-gray-700">

                <div class="w-full md:w-1/2 p-10 sm:p-12 flex flex-col justify-center bg-gradient-to-br from-indigo-700 to-indigo-800 text-white relative overflow-hidden">
                    <div class="absolute -top-16 -right-16 w-40 h-40 bg-indigo-600 rounded-full opacity-30"></div>
                    <div class="absolute -bottom-24 -left-12 w-48 h-48 bg-indigo-600 rounded-full opacity-30"></div>

                    <div class="relative z-10">
                        <a href="{{ route('home') }}" class="text-5xl font-bold font-serif">
                            Nexora
                        </a>
                        <p class="text-lg text-indigo-100 mt-4">
                            Join the Nexora family. Start your journey with us today.
                        </p>
                    </div>
                </div>

                <div class="w-full md:w-1/2 p-10 sm:p-12">
                    <div class="text-right mb-4">
                        <a href="{{ route('admin.register') }}" class="text-sm font-medium text-indigo-400 hover:text-indigo-300 transition-colors">
                            Admin Register
                        </a>
                    </div>

                    <h2 class="text-3xl font-bold font-serif text-white mb-2">
                        Create Your Account
                    </h2>
                    <p class="text-sm text-gray-300 mb-8">
                        Already have an account?
                        <a href="{{ route('login') }}" class="font-semibold text-indigo-400 hover:text-indigo-300 transition-colors">
                            Sign in here
                        </a>
                    </p>

                    <form id="registration-form" method="POST" action="{{ route('register') }}" data-redirect="{{ route('home') }}" class="space-y-6">
                        @csrf

                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-300 mb-1">Full Name</label>
                            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                                class="w-full px-4 py-3 border border-gray-600 rounded-lg shadow-sm text-sm bg-gray-700 text-white
                                          focus:ring-indigo-400 focus:border-indigo-400 focus:bg-gray-600 transition-colors"
                                placeholder="Enter your full name">
                            <p class="mt-2 text-sm text-red-400 hidden field-error" data-error-for="name"></p>
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-300 mb-1">Email Address</label>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required
                                class="w-full px-4 py-3 border border-gray-600 rounded-lg shadow-sm text-sm bg-gray-700 text-white
                                          focus:ring-indigo-400 focus:border-indigo-400 focus:bg-gray-600 transition-colors"
                                placeholder="you@example.com">
                            <p class="mt-2 text-sm text-red-400 hidden field-error" data-error-for="email"></p>
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-300 mb-1">Password</label>
                            <input id="password" type="password" name="password" required
                                class="w-full px-4 py-3 border border-gray-600 rounded-lg shadow-sm text-sm bg-gray-700 text-white
                                          focus:ring-indigo-400 focus:border-indigo-400 focus:bg-gray-600 transition-colors"
                                placeholder="Create a secure password">
                            <p class="mt-2 text-sm text-red-400 hidden field-error" data-error-for="password"></p>
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-300 mb-1">Confirm Password</label>
                            <input id="password_confirmation" type="password" name="password_confirmation" required
                                class="w-full px-4 py-3 border border-gray-600 rounded-lg shadow-sm text-sm bg-gray-700 text-white
                                          focus:ring-indigo-400 focus:border-indigo-400 focus:bg-gray-600 transition-colors"
                                placeholder="Confirm your password">
                        </div>

                        <div class="flex items-center">
                            <input id="remember" name="remember" type="checkbox"
                                class="h-4 w-4 text-indigo-500 focus:ring-indigo-400 border-gray-600 bg-gray-700 rounded">
                            <label for="remember" class="ml-2 block text-sm text-gray-300">
                                Remember me
                            </label>
                        </div>

                        <div>
                            <button id="register-submit" type="submit"
                                class="group relative w-full flex justify-center py-3 px-4 rounded-lg font-semibold shadow-md text-white bg-indigo-500 hover:bg-indigo-600
                                       focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-300 transform hover:-translate-y-0.5">
                                <span class="submit-text">Create Account</span>
                                <span class="submit-loading hidden">Processing...</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

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