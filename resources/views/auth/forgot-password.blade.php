<!DOCTYPE html>
<html lang="en" class="light scroll-smooth group" data-layout="vertical" data-sidebar="light" data-sidebar-size="lg"
    data-mode="light" data-topbar="light" data-skin="default" data-navbar="sticky" data-content="fluid" dir="ltr">

<head>

    <meta charset="utf-8">
    <title>USM CEE | Forgot Password </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta content="Minimal Admin & Dashboard Template" name="description">
    <meta content="Themesdesign" name="author">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('backend/./assets/images/favicon.ico') }}">
    <!-- Layout config Js -->
    <script src="{{ asset('backend/assets/js/layout.js') }}"></script>
    <!-- Icons CSS -->

    <!-- Tailwind CSS -->


    <link rel="stylesheet" href="{{ asset('backend/assets/css/tailwind2.css') }}">
    <script src="{{ asset('backend/assets/js/tailwind/tailwind4.js') }}"></script>
</head>

<body
    class="flex items-center justify-center min-h-screen py-16 lg:py-10 bg-slate-50 dark:bg-zink-800 dark:text-zink-100 font-public">

    <div class="relative">
        <div class="absolute hidden opacity-50 ltr:-left-16 rtl:-right-16 -top-10 md:block">
            <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 125 316" width="125" height="316">
                <title>&lt;Group&gt;</title>
                <g id="&lt;Group&gt;">
                    <path id="&lt;Path&gt;" class="fill-custom-100/50 dark:fill-custom-950/50"
                        d="m23.4 221.8l-1.3-3.1v-315.3l1.3 3.1z" />
                    <path id="&lt;Path&gt;" class="fill-custom-100 dark:fill-custom-950"
                        d="m31.2 229.6l-1.3-3.1v-315.3l1.3 3.1z" />
                    <path id="&lt;Path&gt;" class="fill-custom-200/50 dark:fill-custom-900/50"
                        d="m39 237.4l-1.3-3.1v-315.3l1.3 3.1z" />
                    <path id="&lt;Path&gt;" class="fill-custom-200/75 dark:fill-custom-900/75"
                        d="m46.8 245.2l-1.3-3.1v-315.3l1.3 3.1z" />
                    <path id="&lt;Path&gt;" class="fill-custom-200 dark:fill-custom-900"
                        d="m54.6 253.1l-1.3-3.1v-315.4l1.3 3.1z" />
                    <path id="&lt;Path&gt;" class="fill-custom-300/50 dark:fill-custom-800/50"
                        d="m62.4 260.9l-1.2-3.1v-315.4l1.2 3.1z" />
                    <path id="&lt;Path&gt;" class="fill-custom-300/75 dark:fill-custom-800/75"
                        d="m70.3 268.7l-1.3-3.1v-315.4l1.3 3.1z" />
                    <path id="&lt;Path&gt;" class="fill-custom-300 dark:fill-custom-800"
                        d="m78.1 276.5l-1.3-3.1v-315.3l1.3 3.1z" />
                    <path id="&lt;Path&gt;" class="fill-custom-400/50 dark:fill-custom-700/50"
                        d="m85.9 284.3l-1.3-3.1v-315.3l1.3 3.1z" />
                    <path id="&lt;Path&gt;" class="fill-custom-400/75 dark:fill-custom-700/75"
                        d="m93.7 292.1l-1.3-3.1v-315.3l1.3 3.1z" />
                    <path id="&lt;Path&gt;" class="fill-custom-400 dark:fill-custom-700"
                        d="m101.5 299.9l-1.3-3.1v-315.3l1.3 3.1z" />
                    <path id="&lt;Path&gt;" class="fill-custom-500/50 dark:fill-custom-600/50"
                        d="m109.3 307.8l-1.3-3.1v-315.4l1.3 3.1z" />
                </g>
            </svg>
        </div>

        <div class="absolute hidden -rotate-180 opacity-50 ltr:-right-16 rtl:-left-16 -bottom-10 md:block">
            <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 125 316" width="125" height="316">
                <title>&lt;Group&gt;</title>
                <g id="&lt;Group&gt;">
                    <path id="&lt;Path&gt;" class="fill-custom-100/50 dark:fill-custom-950/50"
                        d="m23.4 221.8l-1.3-3.1v-315.3l1.3 3.1z" />
                    <path id="&lt;Path&gt;" class="fill-custom-100 dark:fill-custom-950"
                        d="m31.2 229.6l-1.3-3.1v-315.3l1.3 3.1z" />
                    <path id="&lt;Path&gt;" class="fill-custom-200/50 dark:fill-custom-900/50"
                        d="m39 237.4l-1.3-3.1v-315.3l1.3 3.1z" />
                    <path id="&lt;Path&gt;" class="fill-custom-200/75 dark:fill-custom-900/75"
                        d="m46.8 245.2l-1.3-3.1v-315.3l1.3 3.1z" />
                    <path id="&lt;Path&gt;" class="fill-custom-200 dark:fill-custom-900"
                        d="m54.6 253.1l-1.3-3.1v-315.4l1.3 3.1z" />
                    <path id="&lt;Path&gt;" class="fill-custom-300/50 dark:fill-custom-800/50"
                        d="m62.4 260.9l-1.2-3.1v-315.4l1.2 3.1z" />
                    <path id="&lt;Path&gt;" class="fill-custom-300/75 dark:fill-custom-800/75"
                        d="m70.3 268.7l-1.3-3.1v-315.4l1.3 3.1z" />
                    <path id="&lt;Path&gt;" class="fill-custom-300 dark:fill-custom-800"
                        d="m78.1 276.5l-1.3-3.1v-315.3l1.3 3.1z" />
                    <path id="&lt;Path&gt;" class="fill-custom-400/50 dark:fill-custom-700/50"
                        d="m85.9 284.3l-1.3-3.1v-315.3l1.3 3.1z" />
                    <path id="&lt;Path&gt;" class="fill-custom-400/75 dark:fill-custom-700/75"
                        d="m93.7 292.1l-1.3-3.1v-315.3l1.3 3.1z" />
                    <path id="&lt;Path&gt;" class="fill-custom-400 dark:fill-custom-700"
                        d="m101.5 299.9l-1.3-3.1v-315.3l1.3 3.1z" />
                    <path id="&lt;Path&gt;" class="fill-custom-500/50 dark:fill-custom-600/50"
                        d="m109.3 307.8l-1.3-3.1v-315.4l1.3 3.1z" />
                </g>
            </svg>
        </div>

        <div
            class="relative w-screen border-none shadow-lg lg:mx-auto lg:w-[520px] rounded-3xl bg-white dark:bg-zink-800 shadow-slate-200/60 dark:shadow-black/20 overflow-hidden">
            <div class="px-8 py-10 md:px-10 md:py-12">

                {{-- Logo --}}
                <div class="text-center">
                    <a href="#!">
                        <img src="{{ asset('backend/assets/images/logo-light.png') }}" alt="Logo"
                            class="hidden mx-auto h-14 dark:block">
                        <img src="{{ asset('backend/assets/images/logo-dark.png') }}" alt="Logo"
                            class="block mx-auto h-14 dark:hidden">
                    </a>
                </div>

                {{-- Heading --}}
                <div class="mt-8 text-center">
                    <p class="mb-1 text-[11px] font-semibold tracking-[0.22em] uppercase text-custom-500">
                        Account Recovery
                    </p>
                    <h4 class="text-2xl font-bold tracking-tight text-slate-800 dark:text-white">
                        Forgot your password?
                    </h4>
                    <p class="mt-3 text-sm leading-7 text-slate-500 dark:text-zink-300">
                        No problem. Enter your email address below and we will send you a password reset link so you can
                        choose
                        a new one.
                    </p>
                </div>

                {{-- Session Status --}}
                @if (session('status'))
                    <div
                        class="px-4 py-3 mt-6 text-sm text-green-700 border border-green-200 rounded-2xl bg-green-50 dark:border-green-500/20 dark:bg-green-500/10 dark:text-green-300">
                        <x-auth-session-status :status="session('status')" />
                    </div>
                @endif

                {{-- Form --}}
                <form method="POST" action="{{ route('password.email') }}" class="mt-8 space-y-5">
                    @csrf

                    <div>
                        <label for="email"
                            class="inline-block mb-2 text-sm font-semibold text-slate-700 dark:text-zink-100">
                            Email Address
                        </label>

                        <div class="relative">
                            <input type="email" id="email" name="email" value="{{ old('email') }}"
                                class="w-full px-4 py-3 text-sm transition-all duration-200 bg-white border rounded-2xl border-slate-200 pr-11 text-slate-700 placeholder:text-slate-400 focus:border-custom-500 focus:outline-none focus:ring-2 focus:ring-custom-100 dark:border-zink-600 dark:bg-zink-700 dark:text-zink-100 dark:placeholder:text-zink-400 dark:focus:border-custom-500"
                                placeholder="Enter email address" required autofocus>

                            <div
                                class="absolute inset-y-0 flex items-center pointer-events-none right-4 text-slate-400">
                                <i data-lucide="mail" class="size-4"></i>
                            </div>
                        </div>

                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs font-medium text-red-500" />
                    </div>

                    <div class="pt-2">
                        <button type="submit"
                            class="inline-flex items-center justify-center w-full gap-2 px-5 py-3 text-sm font-semibold text-white transition-all duration-200 bg-green-500 shadow-sm rounded-2xl hover:bg-green-600 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-green-200 active:bg-green-600">
                            <i data-lucide="send" class="size-4"></i>
                            {{ __('Email Password Reset Link') }}
                        </button>
                    </div>
                </form>

                {{-- Footer --}}
                <div class="mt-8 text-center">
                    <p class="text-sm text-slate-500 dark:text-zink-300">
                        Already have an account?
                        <a href="{{ route('login') }}"
                            class="font-semibold transition text-custom-500 hover:text-custom-600 hover:underline">
                            Login
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    </div>

    <script src="{{ asset('backend/assets/js/tailwick.bundle.js') }}"></script>

</body>

</html>
