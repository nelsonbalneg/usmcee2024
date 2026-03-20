{{-- <footer
    class="ltr:md:left-vertical-menu rtl:md:right-vertical-menu group-data-[sidebar-size=md]:ltr:md:left-vertical-menu-md group-data-[sidebar-size=md]:rtl:md:right-vertical-menu-md group-data-[sidebar-size=sm]:ltr:md:left-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:md:right-vertical-menu-sm absolute right-0 bottom-0 px-4 h-14 group-data-[layout=horizontal]:ltr:left-0  group-data-[layout=horizontal]:rtl:right-0 left-0 border-t py-3 flex items-center dark:border-zink-600">
    <div class="group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl w-full">
        <div
            class="grid items-center grid-cols-1 text-center lg:grid-cols-2 text-slate-400 dark:text-zink-200 ltr:lg:text-left rtl:lg:text-right">
            <div>
                <script>
                    document.write(new Date().getFullYear())
                </script> © www.usm.edu.ph
            </div>
            <div class="hidden lg:block">
                <div class="ltr:text-right rtl:text-left">
                    Designed & Developed by UICTO
                </div>
            </div>
        </div>
    </div>
</footer> --}}
<footer
    class="ltr:md:left-vertical-menu rtl:md:right-vertical-menu group-data-[sidebar-size=md]:ltr:md:left-vertical-menu-md group-data-[sidebar-size=md]:rtl:md:right-vertical-menu-md group-data-[sidebar-size=sm]:ltr:md:left-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:md:right-vertical-menu-sm absolute right-0 bottom-0 px-4 h-14 group-data-[layout=horizontal]:ltr:left-0 group-data-[layout=horizontal]:rtl:right-0 left-0 border-t py-3 flex items-center dark:border-zink-600">

    <div class="group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl w-full">

        <div
            class="grid items-center grid-cols-1 text-center lg:grid-cols-2 text-slate-400 dark:text-zink-200 ltr:lg:text-left rtl:lg:text-right">

            <!-- LEFT -->
            <div class="space-y-1">
                <div>
                    <script>
                        document.write(new Date().getFullYear())
                    </script> ©
                    <a href="https://www.usm.edu.ph" target="_blank" class="hover:text-slate-600 dark:hover:text-white">
                        www.usm.edu.ph
                    </a>
                </div>

                <!-- POLICY LINKS -->
                <div class="text-[12px] space-x-2">
                    <a href="{{ route('student.terms-policy.toc') }}"
                        class="hover:underline hover:text-slate-600 dark:hover:text-white">
                        Data Privacy
                    </a>
                    <span>|</span>
                    <a href="{{ route('student.terms-policy.toc') }}"
                        class="hover:underline hover:text-slate-600 dark:hover:text-white" target="_blank">
                        Terms and Conditions
                    </a>
                    <span>|</span>
                    <a href="/cookie-policy" class="hover:underline hover:text-slate-600 dark:hover:text-white">
                        Cookies
                    </a>
                </div>
            </div>

            <!-- RIGHT -->
            <div class="hidden lg:block">
                <div class="ltr:text-right rtl:text-left text-[12px] space-y-1">
                    <div>
                        Designed & Developed by UICTO
                    </div>
                    <div class="opacity-80">
                        University of Southern Mindanao
                    </div>
                </div>
            </div>

        </div>
    </div>
</footer>
