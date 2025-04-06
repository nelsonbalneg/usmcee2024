@extends('student.layouts.master')
@section('title')
    USM-CEE | Result
@endsection

@section('contents')
    <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
        <div class="grow">
            <h5 class="text-16">USM - College Entrance Examination System 4.0</h5>
        </div>
        <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="#!" class="text-slate-400 dark:text-zink-200">Home</a>
            </li>
            <li class="text-slate-700 dark:text-zink-100">
                CEE Result
            </li>
        </ul>
    </div>


    @if (optional($cee_result))
        <div class="grid grid-cols-1 2xl:grid-cols-12">
            <div class="relative card 2xl:col-span-8 2xl:col-start-3">
                <div class="p-8">
                    <div class="text-center">
                        <h5
                            class="relative before:absolute before:h-[1px] before:inset-x-0 before:-bottom-2.5 inline-block before:bg-gradient-to-r before:from-white dark:before:from-zink-700 before:via-custom-500 before:to-white dark:before:to-zink-700 dark:before:via-custom-500">
                            USM-CEE RESULT</h5>
                    </div>

                    <div class="mt-16">
                        <p class="mb-1 text-slate-500 dark:text-zink-200">Full Name: <span
                                class="font-semibold uppercase text-slate-800 dark:text-zink-50">
                                {{ $cee_result->firstname }}
                                {{ $cee_result->middlename ? strtoupper(substr($cee_result->middlename, 0, 1)) . '.' : '' }}
                                {{ $cee_result->lastname }}
                                {{ $cee_result->suffix }}</span></p>
                        <p class="mb-1 text-slate-500 dark:text-zink-200">App No.: <span
                                class="font-semibold text-slate-800 dark:text-zink-50">{{ $cee_result->app_no }}</span></p>
                        <p class="mb-1 text-slate-500 dark:text-zink-200">Examination Date: <span
                                class="font-semibold text-slate-800 dark:text-zink-50">
                                {{ \Carbon\Carbon::parse($cee_result->schedule)->format('F j, Y') }}</span></p>
                        <p class="mb-1 text-slate-500 dark:text-zink-200">Date Registered: <span
                                class="font-semibold text-slate-800 dark:text-zink-50">{{ \Carbon\Carbon::parse($cee_result->user_created_at)->format('F j, Y') }}</span>
                        </p>
                    </div>

                    <div class="mt-10 overflow-x-auto">
                        @if ($cee_result->csa < 25)
                            <p class="text-slate-800">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Thank you for your
                                interest in pursuing your tertiary education at the University of Southern Mindanao. We
                                appreciate the time and effort you invested in our admission process.

                                <br><br>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;After careful evaluation of all examination
                                results, <strong class="text-red-500">we regret to inform you that your performance did not
                                    meet the requirement for admission into any of our offered programs at this
                                    time</strong>.

                                <br><br>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;We recommend exploring alternative
                                educational pathways that may align with your interests and career goals.
                            </p>
                        @elseif($cee_result->csa >= 25)
                            <p class="text-slate-800">
                                {{-- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Thank you for your interest in pursuing your
                                tertiary education at the University of Southern Mindanao. We appreciate the time and effort
                                you invested in our admission process.

                                <br><br>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;After careful evaluation of all examination
                                results, <strong class="text-green-600">we are pleased to inform you that you have
                                    successfully passed the University of Southern Mindanao College Entrance Examination
                                    (USMCEE)</strong>. --}}

                                <br><br>
                            <h4 class="text-blue-500">Please wait for further announcements
                                regarding the schedule and procedures for the pre-registration process. Kindly monitor the
                                official USM website and USM official page for updates.</h4>
                            </p>
                        @endif
                    </div>

                    <div class="grid grid-cols-1 mt-10 2xl:grid-cols-12">
                        <div class="2xl:col-span-5">
                            <p class="mb-5 text-slate-500 dark:text-zink-200">Sincerely,</p>
                            <p class="mb-2 uppercase text-slate-800 dark:text-zink-200"> <b> LEORENCE C. TANDOG </b></p>
                            <p class="text-slate-500 dark:text-zink-200">Vice President for Academic Affair</p>
                            <p class="text-slate-500 dark:text-zink-200">University of Southern Mindanao</p>
                        </div>


                        <div class="self-end mt-10 text-center 2xl:col-span-2 2xl:col-start-11">
                            <hr class="mb-5 border-t-2 border-slate-200 dark:border-zink-700">
                            <img src="{{ asset('backend/assets/images/logo-dark.png') }}" alt=""
                                class="h-12 mx-auto">
                            <h6>University of Southern Mindanao</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
