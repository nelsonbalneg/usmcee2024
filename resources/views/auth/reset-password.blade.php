<!DOCTYPE html>
<html lang="en" class="light scroll-smooth group" data-layout="vertical" data-sidebar="light" data-sidebar-size="lg"
    data-mode="light" data-topbar="light" data-skin="default" data-navbar="sticky" data-content="fluid" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>USM CEE | Reset Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta content="Minimal Admin & Dashboard Template" name="description">
    <meta content="Themesdesign" name="author">
    <link rel="shortcut icon" href="{{ asset('backend/./assets/images/favicon.ico') }}">
    <script src="{{ asset('backend/assets/js/layout.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('backend/assets/css/tailwind2.css') }}">
</head>

<body
    class="flex items-center justify-center min-h-screen py-16 lg:py-10 bg-slate-50 dark:bg-zink-800 dark:text-zink-100 font-public">
    <div class="relative">
        <div class="absolute hidden opacity-50 ltr:-left-16 rtl:-right-16 -top-10 md:block">
            <!-- SVG for background styling -->
            <!-- Add SVG paths here if required -->
        </div>

        <div class="mb-0 w-screen lg:mx-auto lg:w-[500px] card shadow-lg border-none shadow-slate-100 relative">
            <div class="!px-10 !py-12 card-body">
                <!-- Logo Section -->
                <a href="#!">
                    <img src="{{ asset('backend/assets/images/logo-light.png') }}" alt=""
                        class="hidden h-6 mx-auto dark:block">
                    <img src="{{ asset('backend/assets/images/logo-dark.png') }}" alt=""
                        class="block h-6 mx-auto dark:hidden">
                </a>

                <div class="mt-8 text-center">
                    <p class="text-slate-500 dark:text-zink-200">Enter your new password below to reset your account
                        password.</p>
                </div>

                <!-- Session Status -->
                <div class="mt-8 text-center">
                    <x-auth-session-status class="mb-4" :status="session('status')" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-500" />
                </div>
                <form method="POST" action="{{ route('password.store') }}" class="mt-10">
                    @csrf
                    <!-- Password Reset Token -->
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">
                    <!-- Email Address -->
                    <div class="mb-3">
                        <x-input-label for="email" :value="__('Email')"
                            class="inline-block mb-2 text-base font-medium" />
                        <x-text-input id="email" type="email" name="email" :value="old('email', $request->email)"
                            class="form-input w-full border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                            required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-500" />
                    </div>
                    <!-- Password -->
                    <div class="mb-3">
                        <x-input-label for="password" :value="__('Password')"
                            class="inline-block mb-2 text-base font-medium" />
                        <x-text-input id="password" type="password" name="password"
                            class="form-input w-full border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                            required autocomplete="new-password" />

                    </div>
                    <!-- Confirm Password -->
                    <div class="mb-3">
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')"
                            class="inline-block mb-2 text-base font-medium" />
                        <x-text-input id="password_confirmation" type="password" name="password_confirmation"
                            class="form-input w-full border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                            required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>
                    <!-- Submit Button -->
                    <div class="mt-10">
                        <button type="submit"
                            class="w-full text-white btn bg-custom-500 border-custom-500 hover:bg-custom-600 hover:border-custom-600 focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 dark:ring-custom-400/20">
                            Reset Password
                        </button>
                    </div>
                </form>
                <!-- Login Link -->
                <div class="mt-10 text-center">
                    <p class="mb-0 text-slate-500 dark:text-zink-200">
                        Remembered your password? <a href="{{ route('login') }}"
                            class="font-semibold underline text-slate-500 dark:text-zink-200 hover:text-custom-500 dark:hover:text-custom-500">Login</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('backend/assets/js/tailwick.bundle.js') }}"></script>
</body>
</html>
