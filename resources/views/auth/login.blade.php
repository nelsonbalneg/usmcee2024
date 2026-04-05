<!DOCTYPE html>
<html lang="en" class="light scroll-smooth group" data-layout="vertical" data-sidebar="light" data-sidebar-size="lg"
    data-mode="light" data-topbar="light" data-skin="default" data-navbar="sticky" data-content="fluid" dir="ltr">

<head>

    <meta charset="utf-8">
    <title>USM CEE | Sign in </title>
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

    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-EJPB3BXP56');
    </script>

    <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>

</head>

<body
    @php
use App\Models\SiteSetting;
use Carbon\Carbon;

$endofreservation = $endofreservation ?? optional(SiteSetting::first())->endreservation; @endphp
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

        <div class="mb-0 w-screen lg:mx-auto lg:w-[500px] card shadow-lg border-none shadow-slate-100 relative">
            <div class="!px-10 !py-12 card-body">
                <a href="#!">
                    <img src="{{ asset('backend/assets/images/logo-light.png') }}" alt=""
                        class="hidden h-6 mx-auto dark:block">
                    <img src="{{ asset('backend/assets/images/logo-dark.png') }}" alt=""
                        class="block mx-auto h-15 dark:hidden">
                </a>

                {{-- Welcome --}}
                <div class="mt-8 space-y-2 text-center">
                    <h4 class="text-xl font-bold tracking-tight text-slate-800 dark:text-white">
                        Welcome, Applicants
                    </h4>

                    <p class="text-sm text-slate-500 dark:text-zink-300">
                        Please review the important guidelines below before proceeding.
                    </p>
                </div>

                {{-- Warning Card --}}
                <div
                    class="p-5 mt-6 border shadow-sm border-amber-200 bg-amber-50 rounded-2xl dark:border-amber-500/20 dark:bg-amber-500/10">

                    <div class="flex items-start gap-3">


                        {{-- Content --}}
                        <div class="min-w-0">
                            <p class="text-[11px] font-semibold tracking-[0.18em] uppercase text-amber-500">
                                Important Notice
                            </p>

                            <h6 class="mt-1 text-sm font-bold text-slate-800 dark:text-white">
                                Please Read Carefully
                            </h6>

                            <ul class="mt-3 space-y-2 text-sm text-slate-600 dark:text-zink-300">
                                <li class="flex gap-2">

                                    <span>
                                        Creating multiple accounts to secure slots is
                                        <b class="text-red-500">strictly prohibited</b>.
                                    </span>
                                </li>

                                <li class="flex gap-2">

                                    <span>
                                        Ensure all information provided is complete and accurate.
                                    </span>
                                </li>

                                <li class="flex gap-2">
                                    <span>
                                        Incomplete or incorrect entries, or multiple accounts, may result in
                                        disqualification.
                                    </span>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
                <form method="POST" action="{{ route('login') }}" class="mt-5">
                    @csrf
                    <div class="mb-3 text-center">
                        @if ($errors->any())
                            <div class="mt-2 text-sm text-red-500">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                    <div class="space-y-5">

                        {{-- Email --}}
                        <div>
                            <label for="email"
                                class="inline-block mb-2 text-sm font-semibold text-slate-700 dark:text-zink-100">
                                Email Address
                            </label>

                            <div class="relative">
                                <input type="text" id="email" name="email" value="{{ old('email') }}"
                                    class="w-full px-4 py-3 text-sm transition-all duration-200 bg-white border rounded-2xl border-slate-200 text-slate-700 placeholder:text-slate-400 focus:border-custom-500 focus:outline-none focus:ring-2 focus:ring-custom-100 dark:border-zink-600 dark:bg-zink-700 dark:text-zink-100 dark:placeholder:text-zink-400 dark:focus:border-custom-500"
                                    placeholder="Enter email address">

                                <div
                                    class="absolute inset-y-0 flex items-center pointer-events-none right-4 text-slate-400">
                                    <i data-lucide="mail" class="size-4"></i>
                                </div>
                            </div>

                            <div id="email-error" class="hidden mt-2 text-xs font-medium text-red-500">
                                Please enter a valid email address.
                            </div>
                        </div>

                        {{-- Password --}}
                        <div>
                            <label for="password"
                                class="inline-block mb-2 text-sm font-semibold text-slate-700 dark:text-zink-100">
                                Password
                            </label>

                            <div class="relative">
                                <input type="password" id="password" name="password" required
                                    autocomplete="current-password"
                                    class="w-full px-4 py-3 text-sm transition-all duration-200 bg-white border rounded-2xl border-slate-200 pr-11 text-slate-700 placeholder:text-slate-400 focus:border-custom-500 focus:outline-none focus:ring-2 focus:ring-custom-100 dark:border-zink-600 dark:bg-zink-700 dark:text-zink-100 dark:placeholder:text-zink-400 dark:focus:border-custom-500"
                                    placeholder="Enter password">

                                <div
                                    class="absolute inset-y-0 flex items-center pointer-events-none right-4 text-slate-400">
                                    <i data-lucide="lock" class="size-4"></i>
                                </div>
                            </div>

                            <div id="password-error" class="hidden mt-2 text-xs font-medium text-red-500">
                                Password must be at least 8 characters long and contain both letters and numbers.
                            </div>
                        </div>

                        {{-- Remember / Forgot --}}
                        <div class="flex flex-col gap-3 pt-1 sm:flex-row sm:items-center sm:justify-between">
                            <label for="checkboxDefault1" class="inline-flex items-center gap-3 cursor-pointer">
                                <input id="checkboxDefault1" name="remember"
                                    class="border rounded size-4 border-slate-300 bg-slate-100 text-custom-500 focus:ring-2 focus:ring-custom-100 dark:border-zink-500 dark:bg-zink-600 dark:checked:bg-custom-500 dark:checked:border-custom-500"
                                    type="checkbox" value="1">
                                <span class="text-sm font-medium text-slate-600 dark:text-zink-200">
                                    Remember me
                                </span>
                            </label>

                            <a href="{{ route('student.forgot-password') }}"
                                class="text-sm font-semibold transition text-custom-500 hover:text-custom-600 hover:underline">
                                Forgot Password?
                            </a>
                        </div>

                        {{-- Turnstile --}}
                        <div class="pt-1">
                            <div class="cf-turnstile" data-sitekey="{{ config('services.turnstile.sitekey') }}">
                            </div>
                        </div>

                        {{-- Submit --}}
                        <div class="pt-1">
                            <button type="submit"
                                class="inline-flex items-center justify-center w-full gap-2 px-5 py-3 text-sm font-semibold text-white transition-all duration-200 bg-green-500 shadow-sm rounded-2xl hover:bg-green-600 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-green-200 active:bg-green-600">
                                <i data-lucide="log-in" class="size-4"></i>
                                Sign In
                            </button>
                        </div>
                    </div>
                </form>


                @if ($endofregistration && Carbon::parse($endofregistration, 'Asia/Manila')->isFuture())
                    {{-- Sign Up CTA --}}
                    <div class="mt-10 space-y-2 text-center">
                        <p class="text-sm text-slate-500 dark:text-zink-300">
                            Don’t have an account?
                        </p>

                        <a href="{{ route('register') }}"
                            class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold transition-all duration-200 border text-custom-500 border-custom-200 rounded-xl hover:bg-custom-50 hover:text-custom-600 dark:border-custom-500/20 dark:hover:bg-custom-500/10">
                            <i data-lucide="user-plus" class="size-4"></i>
                            Create an Account
                        </a>
                    </div>
                @else
                    {{-- Closed Notice --}}
                    <div
                        class="p-5 mt-6 border border-red-200 shadow-sm bg-red-50 rounded-2xl dark:border-red-500/20 dark:bg-red-500/10">
                        <div class="flex items-start gap-3">


                            {{-- Content --}}
                            <div class="min-w-0">
                                <p class="text-[11px] font-semibold tracking-[0.18em] uppercase text-red-500">
                                    Registration Closed
                                </p>

                                <h6 class="mt-1 text-sm font-bold text-slate-800 dark:text-white">
                                    USMCEE Registration is no longer available
                                </h6>

                                <p class="mt-2 text-sm leading-6 text-slate-600 dark:text-zink-300">
                                    Please be informed that <b>account registration and slot reservation</b> for USMCEE
                                    are now officially closed.
                                </p>
                            </div>

                        </div>
                    </div>
                @endif

                <div
                    class="mt-6 pt-4 border-t border-slate-200 dark:border-zink-600 text-center text-[12px] text-slate-400 dark:text-zink-200 space-x-2">

                    <a href="javascript:void(0)" data-drawer-target="drawerterms"
                        class="hover:underline hover:text-slate-600 dark:hover:text-white">
                        Terms &amp; Conditions
                    </a>
                    <span>|</span>

                    <a href="javascript:void(0)" data-drawer-target="drawerprivacy"
                        class="hover:underline hover:text-slate-600 dark:hover:text-white">
                        Data Privacy
                    </a>

                    <span>|</span>

                    <a href="javascript:void(0)" data-drawer-target="drawerprivacy"
                        class="hover:underline hover:text-slate-600 dark:hover:text-white">
                        Cookie Policy
                    </a>

                </div>



            </div>


        </div>


    </div>
    <div id="drawerterms"
        class="fixed inset-y-0 flex flex-col hidden w-full transition-transform duration-300 ease-in-out transform translate-x-full bg-white shadow md:w-80 z-drawer dark:bg-zink-600 ltr:right-0 rtl:left-0">

        <div class="flex items-center justify-between p-4 border-b card-body border-slate-200 dark:border-zink-500">
            <h6 class="text-15">Terms &amp; Conditions</h6>
            <button type="button" data-drawer-close="drawerterms">
                <i data-lucide="x"
                    class="transition-all duration-200 ease-linear size-4 text-slate-500 hover:text-slate-700 dark:text-zink-200 dark:hover:text-zink-50"></i>
            </button>
        </div>

        <div class="h-full p-2 overflow-y-auto">
            {!! $activeTermsPolicy->content !!}

        </div>

        <div class="flex items-center justify-between p-4 border-t border-slate-200 dark:border-zink-500">
            <h6 class="text-15">University of Southern Mindanao</h6>
            <button type="button" class="px-3 py-1.5 text-sm text-white bg-slate-600 rounded-md hover:bg-slate-700"
                data-drawer-close="drawerterms">
                Close
            </button>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const drawer = document.getElementById('drawerterms');
            if (!drawer) return;

            // Disable transition briefly so it doesn't animate on load
            drawer.style.transition = 'none';
            drawer.classList.add('translate-x-full');

            // Re-enable transition after a tick
            requestAnimationFrame(() => {
                requestAnimationFrame(() => {
                    drawer.style.transition = '';
                });
            });
        });
    </script>


    <script src="{{ asset('backend/assets/js/tailwick.bundle.js') }}"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="https://cdn.jsdelivr.net/npm/lucide@latest/dist/umd/lucide.js"></script>
    {{-- <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script> --}}

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const emailInput = document.getElementById("email");

            emailInput.addEventListener("blur", function() {
                const email = emailInput.value.trim(); // Trim whitespace
                const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

                // Only validate if email is not empty
                if (email && !emailPattern.test(email)) {
                    emailInput.value = ""; // Clear invalid email input
                    Toastify({
                        text: 'Please enter a valid email address.',
                        duration: 5000,
                        gravity: "top",
                        position: "right",
                        backgroundColor: "#f56565", // Red color for error
                        className: "error",
                    }).showToast();
                }
            });
        });
    </script>
</body>

</html>
