<!DOCTYPE html>
<html lang="en" class="light scroll-smooth group" data-layout="vertical" data-sidebar="light" data-sidebar-size="lg" data-mode="light" data-topbar="light" data-skin="default" data-navbar="sticky" data-content="fluid" dir="ltr">

<head>

    <meta charset="utf-8">
    <title>Offline | Tailwick - Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta content="Minimal Admin & Dashboard Template" name="description">
    <meta content="Themesdesign" name="author">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('backend/assets/images/favicon.ico')}}">
    <!-- Layout config Js -->
    <script src="{{aset('backendssets/js/layout.js')}}"></script>
    <!-- Icons CSS -->

    <!-- Tailwind CSS -->


  <link rel="stylesheet" href="{{asset('backend/assets/css/tailwind2.css')}}">
</head>

<body class="flex items-center justify-center min-h-screen py-16 bg-cover bg-auth-pattern dark:bg-auth-pattern-dark font-public">

    <div class="mb-0 border-none shadow-none lg:w-[500px] card bg-white/70 dark:bg-zink-500/70">
        <div class="!px-10 !py-12 card-body">
            <a href="index">
                <img src="{{asset('backend/assets/images/logo-light.png')}}" alt="" class="hidden h-6 mx-auto dark:block">
                <img src="{{asset('backend/assets/images/logo-dark.png')}}" alt="" class="block h-6 mx-auto dark:hidden">
            </a>

            <div class="mt-10">
                <img src="{{asset('backend/assets/images/offline.png')}}" alt="" class="mx-auto h-72">
            </div>
            <div class="mt-8 text-center">
                <h4 class="mb-2 text-purple-500">We're Temporarily Offline</h4>
                <p class="mb-6 text-slate-500 dark:text-zink-200">We can't display these images as you're currently not connected to the internet. Once you're back online, please refresh the page or click the button below.</p>
                <button onclick="window.location.href=window.location.href" class="text-white transition-all duration-200 ease-linear btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20"><i data-lucide="refresh-ccw" class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i> <span class="align-middle">Refresh</span></button>
            </div>
        </div>
    </div>


</body>

</html>