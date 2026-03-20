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

                <div class="mt-8 text-center">
                    <h4 class="mb-1 text-yellow-500 dark:text-yellow-500">Welcome Applicants !</h4>
                    {{-- <p class="text-slate-500 dark:text-zink-200">Sign in to continue to USMCEE</p> --}}
                </div>
                <div class="flex gap-3 p-3 mt-5 text-sm text-yellow-500 rounded-md bg-yellow-50 dark:bg-yellow-400/20">
                    <div>
                        <h6 class="mb-1">WARNING!</h6>
                        <ul class="ml-2 list-disc list-inside">
                            <li>Creating multiple accounts to secure slots is <b>PROHIBITED</b></li>
                            <li>Ensure all information is complete and accurate.</li>
                            <li>Incomplete or incorrect entries, or multiple accounts, may result in disqualification.
                            </li>
                        </ul>
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
                    <div class="mb-3">
                        <label for="email" class="inline-block mb-2 text-base font-medium">Email Address</label>
                        <input type="text" id="email" name="email" value="{{ old('email') }}"
                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                            placeholder="Enter email address">
                        <div id="email-error" class="hidden mt-1 text-sm text-red-500">Please enter a valid email
                            address.</div>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="inline-block mb-2 text-base font-medium">Password</label>
                        <input type="password" id="password" name="password" required
                            autocomplete="current-password"
                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                            placeholder="Enter password">
                        <div id="password-error" class="hidden mt-1 text-sm text-red-500">Password must be at least 8
                            characters long and contain both letters and numbers.</div>
                    </div>

                    <div class="flex items-center justify-between mt-4">
                        <!-- Remember Me Checkbox -->
                        <div class="flex items-center gap-2">
                            <input id="checkboxDefault1" name="remember"
                                class="border rounded-sm appearance-none size-4 bg-slate-100 border-slate-200 dark:bg-zink-600 dark:border-zink-500 checked:bg-custom-500 checked:border-custom-500 dark:checked:bg-custom-500 dark:checked:border-custom-500 checked:disabled:bg-custom-400 checked:disabled:border-custom-400"
                                type="checkbox" value="1">
                            <label for="checkboxDefault1"
                                class="inline-block text-base font-medium align-middle cursor-pointer">
                                Remember me
                            </label>
                        </div>

                        <!-- Forgot Password Link -->
                        <div>
                            <a href="{{ route('student.forgot-password') }}"
                                class="text-base font-medium text-blue-600 cursor-pointer hover:underline">
                                Forgot Password?
                            </a>
                        </div>
                    </div>

                    <!-- Error message for Remember Me -->
                    <div class="mt-5 cf-turnstile" data-sitekey="{{ config('services.turnstile.sitekey') }}"></div>

                    <div class="mt-5 text-center">
                        <button type="submit"
                            class="w-full text-white bg-green-500 border-green-500 btn hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-100 active:text-white active:bg-green-600 active:border-green-600 active:ring active:ring-green-100 dark:ring-green-400/10">Sign
                            In</button>
                    </div>

                </form>


                @if ($endofregistration && Carbon::parse($endofregistration, 'Asia/Manila')->isFuture())
                    <div class="mt-10 text-center">
                        <p class="mb-0 text-slate-500 dark:text-zink-200">Don't have an account ? <a
                                href="{{ route('register') }}"
                                class="font-semibold underline transition-all duration-150 ease-linear text-slate-500 dark:text-zink-200 hover:text-custom-500 dark:hover:text-custom-500">
                                Sign Up</a> </p>
                    </div>
                @else
                    <div class="mt-4 card">
                        <div class="flex gap-3 p-4 text-sm text-red-500 rounded-md bg-red-50 dark:bg-red-400/20">
                            <i data-lucide="alert-circle" class="inline-block size-4 mt-0.5 shrink-0"></i>
                            <p class="mb-0">Please be informed that USMCEE <b>account registration and slot
                                    reservation</b> are now closed.</p>
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
