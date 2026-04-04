@extends('student.layouts.master')
@section('title')
    USM-CEE | Programs Confirmation
@endsection

@section('contents')
    <x-page-header title="USMCEE 4.0 | PROGRAM CONFIRMATION" :breadcrumbs="[
        ['label' => 'Home', 'url' => route('dashboard')],
        ['label' => 'Pre-registration', 'url' => '#!'],
        ['label' => 'Program Confirmation'],
    ]" />

    <div class="grid grid-cols-1 xl:grid-cols-12 gap-x-5">

        <div class="xl:col-span-12">
            <div class="card">
                <div class="card-body">
                    @if ($has_policy_id == 1)

                        {{-- Info Notice --}}
                        <div
                            class="mb-5 overflow-hidden border shadow-sm rounded-2xl border-sky-200 bg-sky-50 dark:border-sky-500/20 dark:bg-sky-500/10">
                            <div class="flex gap-3 p-5">
                                <div
                                    class="flex items-center justify-center bg-white text-sky-600 rounded-xl size-11 shrink-0 dark:bg-zink-800 dark:text-sky-300">
                                    <i data-lucide="badge-info" class="size-5"></i>
                                </div>

                                <div class="min-w-0">
                                    <h6 class="mb-2 text-base font-bold tracking-tight text-slate-800 dark:text-white">
                                        Important Reminder
                                    </h6>

                                    <div class="space-y-2 text-sm text-slate-600 dark:text-zink-200">
                                        <p>
                                            Below are the details of your selected program. Please note that
                                            <span class="font-semibold text-sky-700 dark:text-sky-300">admission is not
                                                automatic</span>,
                                            as all qualifiers will undergo a ranking process.
                                        </p>

                                        <p>
                                            Narito ang detalye ng iyong napiling program. Pakatandaan na
                                            <span class="font-semibold text-sky-700 dark:text-sky-300">
                                                hindi awtomatikong ibibigay ang napili mong program
                                            </span>
                                            sapagkat lahat ng kwalipikado ay daraan sa proseso ng ranggohan (ranking).
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Premium Two-Column Layout --}}
                        <div class="grid grid-cols-1 gap-5 xl:grid-cols-12">

                            {{-- Left: Summary --}}
                            <div class="xl:col-span-8">
                                <div
                                    class="overflow-hidden bg-white border shadow-sm rounded-2xl border-slate-200 dark:border-zink-600 dark:bg-zink-800">

                                    {{-- Profile Header --}}
                                    <div class="p-5 border-b border-slate-200 dark:border-zink-600">
                                        <div class="flex flex-col gap-4 sm:flex-row sm:items-center">
                                            <div class="shrink-0">
                                                <img src="{{ asset(Auth::user()->photo) }}" alt="Profile Photo"
                                                    class="object-cover border-2 border-white rounded-full shadow-sm size-16 dark:border-zink-700">
                                            </div>

                                            <div class="min-w-0 grow">
                                                <p
                                                    class="mb-1 text-[11px] font-semibold tracking-[0.16em] uppercase text-slate-400 dark:text-zink-400">
                                                    Applicant Information
                                                </p>
                                                <h6 class="text-lg font-bold tracking-tight text-slate-800 dark:text-white">
                                                    {{ $prereg_profile->first_name }}
                                                    {{ $prereg_profile->middle_initial }}
                                                    {{ $prereg_profile->last_name }}
                                                    {{ $prereg_profile->ext_name }}
                                                </h6>
                                                <p class="mt-1 text-sm text-slate-500 dark:text-zink-300">
                                                    {{ $prereg_profile->email }}
                                                </p>
                                            </div>

                                            <div class="shrink-0">
                                                <span
                                                    class="inline-flex items-center px-3 py-1 text-xs font-semibold rounded-full bg-sky-100 text-sky-700 dark:bg-sky-500/20 dark:text-sky-500">
                                                    Confirmed Program Summary
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Details --}}
                                    <div class="p-5">
                                        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                            <div
                                                class="p-4 border rounded-2xl bg-slate-50 border-slate-200 dark:bg-zink-700/30 dark:border-zink-600">
                                                <p
                                                    class="mb-1 text-xs font-semibold tracking-wide uppercase text-slate-400 dark:text-zink-400">
                                                    Program Selected
                                                </p>
                                                <h6 class="text-sm font-semibold leading-6 text-slate-800 dark:text-white">
                                                    {{ $prereg_profile->programName }} -
                                                    {{ $prereg_profile->majorDiscDesc }}
                                                </h6>
                                            </div>

                                            <div
                                                class="p-4 border rounded-2xl bg-slate-50 border-slate-200 dark:bg-zink-700/30 dark:border-zink-600">
                                                <p
                                                    class="mb-1 text-xs font-semibold tracking-wide uppercase text-slate-400 dark:text-zink-400">
                                                    Campus and College
                                                </p>
                                                <h6 class="text-sm font-semibold leading-6 text-slate-800 dark:text-white">
                                                    {{ $prereg_profile->campusName }} - {{ $prereg_profile->collegeName }}
                                                </h6>
                                            </div>

                                            <div
                                                class="p-4 border rounded-2xl bg-slate-50 border-slate-200 dark:bg-zink-700/30 dark:border-zink-600 md:col-span-2">
                                                <p
                                                    class="mb-1 text-xs font-semibold tracking-wide uppercase text-slate-400 dark:text-zink-400">
                                                    Date and Time Confirmed
                                                </p>
                                                <h6 class="text-sm font-semibold leading-6 text-slate-800 dark:text-white">
                                                    {{ \Carbon\Carbon::parse($prereg_profile->date_confirmed)->format('F j, Y g:i A') }}
                                                </h6>
                                            </div>
                                        </div>

                                        {{-- Status --}}
                                        <div class="mt-5">
                                            <div
                                                class="p-4 border rounded-2xl bg-slate-50 border-slate-200 dark:bg-zink-700/30 dark:border-zink-600">
                                                <p
                                                    class="mb-2 text-xs font-semibold tracking-wide uppercase text-slate-400 dark:text-zink-400">
                                                    Current Status
                                                </p>

                                                <div class="space-y-3">
                                                    @if ($prereg_profile->prereg_status == 'for_ranking')
                                                        <span
                                                            class="inline-flex items-center px-3 py-1 text-xs font-semibold rounded-full bg-sky-100 text-sky-700 dark:bg-sky-500/20 dark:text-sky-500">
                                                            Confirmed for Ranking
                                                        </span>

                                                        <div
                                                            class="p-3 text-sm leading-6 text-purple-700 border border-purple-200 rounded-xl bg-purple-50 dark:bg-purple-500/10 dark:border-purple-500/20 dark:text-purple-500">
                                                            Please wait. Ranking is currently in progress.
                                                        </div>
                                                    @elseif($prereg_profile->prereg_status == 'pending' && $prereg_profile->status_id == null)
                                                        <span
                                                            class="inline-flex items-center px-3 py-1 text-xs font-semibold rounded-full bg-emerald-100 text-emerald-700 dark:bg-emerald-500/20 dark:text-emerald-500">
                                                            Confirmed for Enrollment
                                                        </span>



                                                        {{-- <div
                                                            class="p-3 text-sm leading-6 text-purple-700 border border-purple-200 rounded-xl bg-purple-50 dark:bg-purple-500/10 dark:border-purple-500/20 dark:text-purple-500">
                                                            Please submit the original copies of the required documents to
                                                            the
                                                            <b>Admission and Records Office (ARO)</b> as soon as possible.
                                                            Submission may be done in person or via courier. If you have
                                                            already
                                                            submitted your documents, kindly disregard this message.
                                                        </div> --}}
                                                    @elseif($prereg_profile->prereg_status == 'cancelled')
                                                        <span
                                                            class="inline-flex items-center px-3 py-1 text-xs font-semibold text-red-700 bg-red-100 rounded-full dark:bg-red-500/20 dark:text-red-500">
                                                            Cancelled
                                                        </span>
                                                    @elseif($prereg_profile->prereg_status == 'denied')
                                                        <span
                                                            class="inline-flex items-center px-3 py-1 text-xs font-semibold text-red-700 bg-red-100 rounded-full dark:bg-red-500/20 dark:text-red-500">
                                                            Denied
                                                        </span>
                                                    @elseif($prereg_profile->prereg_status == 'enrolled' || $prereg_profile->status_id == 1)
                                                        <span
                                                            class="inline-flex items-center px-3 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded-full dark:bg-green-500/20 dark:text-green-500">
                                                            You are officially enrolled!
                                                        </span>

                                                        <div
                                                            class="p-3 text-sm leading-6 text-purple-700 border border-purple-200 rounded-xl bg-purple-50 dark:bg-purple-500/10 dark:border-purple-500/20 dark:text-purple-500">
                                                            Tap the <b>Pre-registration Menu</b>, then tap the
                                                            <b>View Certificate of Registration</b> button to get your
                                                            Certificate of Registration.
                                                        </div>
                                                    @else
                                                        <span class="text-sm text-slate-400 dark:text-zink-400">---</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Right: Action / Status Panel --}}
                            <div class="xl:col-span-4">
                                <div class="sticky top-[calc(theme('spacing.header')_*_1.3)]">
                                    <div
                                        class="overflow-hidden bg-white border shadow-sm rounded-2xl border-slate-200 dark:border-zink-600 dark:bg-zink-800">
                                        <div class="p-5 border-b border-slate-200 dark:border-zink-600">
                                            <p
                                                class="mb-1 text-[11px] font-semibold tracking-[0.16em] uppercase text-green-500">
                                                Enrollment Progress
                                            </p>
                                            <h6 class="text-lg font-bold tracking-tight text-slate-800 dark:text-white">
                                                Current Standing
                                            </h6>
                                            <p class="mt-2 text-sm text-slate-500 dark:text-zink-500">
                                                Review your confirmed program and current pre-registration status.
                                            </p>
                                        </div>

                                        <div class="p-5 space-y-4">
                                            <div
                                                class="p-4 border rounded-2xl bg-slate-50 border-slate-200 dark:bg-zink-700/30 dark:border-zink-600">
                                                <h6 class="mb-2 text-sm font-semibold text-slate-800 dark:text-white">
                                                    Quick Notes
                                                </h6>

                                                <ul class="space-y-2 text-sm text-slate-600 dark:text-zink-500">
                                                    <li class="flex gap-2">
                                                        <i data-lucide="check"
                                                            class="mt-1 text-green-500 size-4 shrink-0"></i>
                                                        <span>Your selected program has already been saved.</span>
                                                    </li>

                                                    <li class="flex gap-2">
                                                        <i data-lucide="check"
                                                            class="mt-1 text-green-500 size-4 shrink-0"></i>
                                                        <span>Admission depends on ranking, document compliance, and slot
                                                            availability.</span>
                                                    </li>

                                                    <li class="flex gap-2">
                                                        <i data-lucide="check"
                                                            class="mt-1 text-green-500 size-4 shrink-0"></i>
                                                        <span>Continue monitoring your status for the next required
                                                            action.</span>
                                                    </li>
                                                </ul>
                                            </div>

                                            @if ($prereg_profile->prereg_status == 'for_ranking')
                                                <div
                                                    class="p-4 border rounded-2xl bg-sky-50 border-sky-200 text-sky-700 dark:bg-sky-500/10 dark:border-sky-500/20 dark:text-sky-500">
                                                    <div class="flex gap-2">
                                                        <i data-lucide="loader-circle" class="mt-0.5 size-4 shrink-0"></i>
                                                        <p class="text-sm leading-6">
                                                            Your application is now waiting for ranking results.
                                                        </p>
                                                    </div>
                                                </div>
                                            @elseif($prereg_profile->prereg_status == 'pending' && $prereg_profile->status_id == null)
                                                <div
                                                    class="p-3 text-sm leading-6 text-purple-700 border border-purple-200 rounded-xl bg-purple-50 dark:bg-purple-500/10 dark:border-purple-500/20 dark:text-purple-500">
                                                    Please submit the original copies of the required documents to
                                                    the
                                                    <b>Admission and Records Office (ARO)</b> as soon as possible.
                                                    Submission may be done in person or via courier. If you have
                                                    already
                                                    submitted your documents, kindly disregard this message.
                                                </div>

                                                @if ($prereg_profile->is_answered_nstp == 1)
                                                    <div
                                                        class="p-3 text-sm leading-6 text-green-700 border border-green-200 rounded-xl bg-green-50 dark:bg-green-500/10 dark:border-green-500/20 dark:text-green-500">
                                                        Please note that enrollment for CWTS or ROTC will take place
                                                        after
                                                        the NSTP orientation.
                                                    </div>
                                                @endif
                                            @elseif($prereg_profile->prereg_status == 'enrolled' || $prereg_profile->status_id == 1)
                                                <div
                                                    class="p-4 text-green-700 border border-green-200 rounded-2xl bg-green-50 dark:bg-green-500/10 dark:border-green-500/20 dark:text-green-500">
                                                    <div class="flex gap-2">
                                                        <i data-lucide="badge-check" class="mt-0.5 size-4 shrink-0"></i>
                                                        <p class="text-sm leading-6">
                                                            Congratulations! You may now proceed to view your Certificate of
                                                            Registration.
                                                        </p>
                                                    </div>
                                                </div>
                                            @else
                                                <div
                                                    class="p-4 border rounded-2xl bg-slate-50 border-slate-200 text-slate-600 dark:bg-zink-700/30 dark:border-zink-600 dark:text-zink-500">
                                                    <div class="flex gap-2">
                                                        <i data-lucide="info" class="mt-0.5 size-4 shrink-0"></i>
                                                        <p class="text-sm leading-6">
                                                            Please monitor this panel for the next status update.
                                                        </p>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    @elseif($has_policy_id == 0)
                        {{-- Empty / Action State --}}
                        <div
                            class="max-w-3xl p-6 mx-auto mt-2 border shadow-sm rounded-2xl border-amber-200 bg-amber-50 dark:border-amber-500/20 dark:bg-amber-500/10">
                            <div class="flex items-start gap-4">
                                <div
                                    class="flex items-center justify-center w-12 h-12 rounded-xl bg-amber-100 text-amber-600 dark:bg-amber-500/20 dark:text-amber-300 shrink-0">
                                    <i data-lucide="triangle-alert" class="size-5"></i>
                                </div>

                                <div class="min-w-0">
                                    <h4 class="text-lg font-bold tracking-tight text-slate-800 dark:text-white">
                                        No confirmed program yet
                                    </h4>
                                    <p class="mt-2 text-sm leading-6 text-slate-600 dark:text-zink-500">
                                        Oops! It seems that you have not confirmed your program yet. Please select your
                                        program
                                        first by clicking the button below.
                                    </p>

                                    <div class="mt-4">
                                        <a href="{{ route('student.cee.result') }}"
                                            class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-semibold text-white transition-all duration-200 shadow-sm rounded-xl bg-green-500 hover:bg-green-600 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-green-200">
                                            <i data-lucide="percent" class="size-4"></i>
                                            Go to Result
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
