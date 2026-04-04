@extends('student.layouts.master')
@section('title')
    USMCEE - My Profile
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endpush

@section('contents')

    <x-page-header title="USMCEE | Dashboard" :breadcrumbs="[['label' => 'Home', 'url' => route('dashboard')], ['label' => 'Dashboard', 'url' => '#!']]" />


    <!--start grid-->
    <div class="grid grid-cols-1 xl:grid-cols-12 gap-x-5">

        <div class="xl:col-span-4">

            {{-- <a href="https://drive.google.com/file/d/17K7A0XK0fkGALONUxJ28UxNs40-d5zTB/view?usp=sharing"
                class="block w-full mt-2 mb-2 text-white bg-green-500 border-green-500 btn hover:text-white hover:bg-green-600 hover:yellow-green-600 focus:text-white focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-100 active:text-white active:bg-green-600 active:border-green-600 active:ring active:ring-green-100 dark:ring-custom-400/10">
                <i data-lucide="book" class="inline-block h-4 align-middle"></i>
                Download the User Guide
            </a> --}}
            {{-- <a href="https://drive.google.com/file/d/11uex4NLsFaez7bJv0LNUUqSZMCR2W1pZ/view?usp=sharing"
                class="block w-full mt-2 mb-2 text-white bg-green-500 border-green-500 btn hover:text-white hover:bg-green-600 hover:yellow-green-600 focus:text-white focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-100 active:text-white active:bg-green-600 active:border-green-600 active:ring active:ring-green-100 dark:ring-custom-400/10">
                <i data-lucide="book" class="inline-block h-4 align-middle"></i>
                Download User Guide
            </a> --}}

            <div class="sticky top-[calc(theme('spacing.header')_*_1.3)]">
                <div
                    class="relative overflow-hidden border shadow-sm card rounded-2xl border-white/60 bg-white/90 backdrop-blur-xl dark:border-zink-700/60 dark:bg-zink-800/80">

                    {{-- Decorative Glow --}}
                    <div class="absolute inset-0 bg-gradient-to-br from-sky-500/[0.08] via-blue-500/[0.03] to-transparent">
                    </div>
                    <div class="absolute rounded-full -top-12 -right-12 size-36 bg-sky-400/10 blur-3xl"></div>
                    <div
                        class="absolute top-0 left-0 w-full h-px bg-gradient-to-r from-transparent via-sky-400/30 to-transparent">
                    </div>

                    <div class="relative p-6">
                        {{-- Header --}}
                        <div class="mb-5">
                            <p class="mb-1 text-[11px] font-semibold tracking-[0.22em] uppercase text-sky-500">
                                Student Account
                            </p>
                            <h6 class="text-lg font-bold tracking-tight text-slate-800 dark:text-white">
                                My Profile
                            </h6>
                        </div>

                        {{-- Photo Section --}}
                        <div
                            class="relative px-5 mb-5 overflow-hidden border py-7 rounded-2xl bg-gradient-to-br from-sky-50 via-white to-blue-50 border-sky-100 dark:border-zink-700 dark:from-zink-800 dark:via-zink-700 dark:to-zink-800">
                            <div
                                class="absolute rounded-full -top-8 -right-8 size-24 bg-sky-200/40 blur-2xl dark:bg-sky-500/10">
                            </div>
                            <div
                                class="absolute rounded-full -bottom-8 -left-8 size-24 bg-blue-200/40 blur-2xl dark:bg-blue-500/10">
                            </div>

                            <div class="relative flex justify-center">
                                <div class="relative">
                                    <div
                                        class="absolute inset-0 scale-110 rounded-full bg-gradient-to-br from-sky-400 to-blue-500 blur-md opacity-20">
                                    </div>
                                    <img src="{{ asset($studentdetails->photo) }}" alt="Student Photo"
                                        class="relative object-cover mx-auto border-4 border-white rounded-full shadow-xl size-28 dark:border-zink-700">

                                    <span
                                        class="absolute flex items-center justify-center w-8 h-8 text-white border-2 border-white rounded-full shadow-md bottom-1 right-1 bg-gradient-to-br from-green-500 to-emerald-600 dark:border-zink-700">
                                        <i data-lucide="check" class="size-4"></i>
                                    </span>
                                </div>
                            </div>
                        </div>

                        {{-- Name + Basic Info --}}
                        <div class="mb-5 text-center">
                            <h5 class="text-lg font-bold tracking-tight uppercase text-sky-600 dark:text-sky-400">
                                {{ $studentdetails->lastname }}, {{ $studentdetails->firstname }}
                                {{ $studentdetails->middlename }} {{ $studentdetails->suffix }}
                            </h5>
                            <p class="mt-1 text-sm text-slate-500 dark:text-zink-300">
                                Applicant Information Summary
                            </p>
                        </div>

                        {{-- Contact / Personal Info --}}
                        <div class="space-y-3">
                            <div
                                class="flex items-center gap-3 p-3 transition-all duration-200 border rounded-xl bg-slate-50/80 border-slate-200/70 hover:border-sky-200 hover:bg-sky-50/70 dark:bg-zink-700/40 dark:border-zink-600">
                                <div
                                    class="flex items-center justify-center rounded-xl size-10 bg-sky-100 text-sky-600 dark:bg-sky-500/20 dark:text-sky-300 shrink-0">
                                    <i data-lucide="mail" class="size-4"></i>
                                </div>
                                <div class="min-w-0">
                                    <p
                                        class="text-xs font-semibold tracking-wide uppercase text-slate-400 dark:text-zink-400">
                                        Email Address
                                    </p>
                                    <p class="text-sm font-medium break-all text-slate-700 dark:text-zink-100">
                                        {{ $studentdetails->email ?? '---' }}
                                    </p>
                                </div>
                            </div>

                            <div
                                class="flex items-center gap-3 p-3 transition-all duration-200 border rounded-xl bg-slate-50/80 border-slate-200/70 hover:border-sky-200 hover:bg-sky-50/70 dark:bg-zink-700/40 dark:border-zink-600">
                                <div
                                    class="flex items-center justify-center text-green-600 bg-green-100 rounded-xl size-10 dark:bg-green-500/20 dark:text-green-300 shrink-0">
                                    <i data-lucide="phone" class="size-4"></i>
                                </div>
                                <div class="min-w-0">
                                    <p
                                        class="text-xs font-semibold tracking-wide uppercase text-slate-400 dark:text-zink-400">
                                        Contact Number
                                    </p>
                                    <p class="text-sm font-medium text-slate-700 dark:text-zink-100">
                                        {{ $studentdetails->phone ?? '---' }}
                                    </p>
                                </div>
                            </div>

                            <div
                                class="flex items-center gap-3 p-3 transition-all duration-200 border rounded-xl bg-slate-50/80 border-slate-200/70 hover:border-sky-200 hover:bg-sky-50/70 dark:bg-zink-700/40 dark:border-zink-600">
                                <div
                                    class="flex items-center justify-center rounded-xl size-10 bg-violet-100 text-violet-600 dark:bg-violet-500/20 dark:text-violet-300 shrink-0">
                                    <i data-lucide="calendar" class="size-4"></i>
                                </div>
                                <div class="min-w-0">
                                    <p
                                        class="text-xs font-semibold tracking-wide uppercase text-slate-400 dark:text-zink-400">
                                        Birthdate
                                    </p>
                                    <p class="text-sm font-medium text-slate-700 dark:text-zink-100">
                                        {{ !empty($studentdetails->birthdate) ? \Carbon\Carbon::parse($studentdetails->birthdate)->format('F j, Y') : '---' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--end card-->
        </div><!--end col-->

        <div class="xl:col-span-4">
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-1">

                {{-- Premium Date & Time Card --}}
                <div
                    class="relative overflow-hidden border shadow-sm card rounded-2xl border-white/60 bg-white/80 backdrop-blur-xl dark:border-slate-700/60 dark:bg-slate-800/70">
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-green-500/[0.08] via-emerald-500/[0.03] to-transparent">
                    </div>
                    <div class="absolute rounded-full -top-12 -right-12 size-36 bg-green-400/10 blur-3xl"></div>
                    <div
                        class="absolute bottom-0 left-0 w-full h-px bg-gradient-to-r from-transparent via-green-400/30 to-transparent">
                    </div>

                    <div class="relative p-6 card-body">
                        <div class="flex items-start justify-between mb-5">
                            <div
                                class="flex items-center justify-center text-white shadow-lg size-14 rounded-2xl bg-gradient-to-br from-green-500 to-emerald-600 shadow-green-500/20">
                                <i data-lucide="clock-3" class="size-6"></i>
                            </div>

                            <div
                                class="px-3 py-1 text-[11px] font-semibold tracking-[0.18em] uppercase rounded-full bg-green-500/10 text-green-700 dark:bg-green-500/20 dark:text-green-700">
                                Live
                            </div>
                        </div>

                        <div class="space-y-2">
                            <p class="text-xs font-semibold tracking-[0.16em] uppercase text-slate-400 dark:text-slate-500">
                                Date and Time Today
                            </p>

                            <div class="space-y-1">
                                <h5 id="current-date"
                                    class="text-xl font-bold tracking-tight text-slate-800 dark:text-white"></h5>
                                <p id="current-time" class="text-sm font-medium text-slate-500 dark:text-slate-300"></p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Premium Quote Card --}}
                <div
                    class="relative overflow-hidden border shadow-sm card rounded-2xl border-white/60 bg-white/80 backdrop-blur-xl dark:border-slate-700/60 dark:bg-slate-800/70">
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-orange-500/[0.08] via-amber-500/[0.04] to-transparent">
                    </div>
                    <div class="absolute rounded-full -top-10 -right-10 size-36 bg-orange-400/10 blur-3xl"></div>
                    <div
                        class="absolute bottom-0 left-0 w-full h-px bg-gradient-to-r from-transparent via-orange-400/30 to-transparent">
                    </div>

                    <div class="relative p-6 card-body">
                        <div class="flex items-start justify-between mb-5">
                            <div
                                class="flex items-center justify-center text-white shadow-lg size-14 rounded-2xl bg-gradient-to-br from-orange-500 to-amber-500 shadow-orange-500/20">
                                <i data-lucide="quote" class="size-6"></i>
                            </div>

                            <i data-lucide="message-circle-more"
                                class="text-orange-200 size-20 dark:text-orange-500/20"></i>
                        </div>

                        <div class="space-y-3">
                            <p class="text-xs font-semibold tracking-[0.16em] uppercase text-slate-400 dark:text-slate-500">
                                Daily Inspiration
                            </p>

                            <h5 class="text-[15px] leading-7 font-semibold text-slate-800 dark:text-white">
                                “Education is one thing no one can take away from you.”
                            </h5>

                            <div class="flex items-center gap-2 pt-1">
                                <span class="w-8 h-px bg-orange-300 dark:bg-orange-400/40"></span>
                                <p class="text-sm font-medium text-slate-500 dark:text-slate-300">
                                    Elin Nordegren
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Premium Last Login Card --}}
                <div
                    class="relative overflow-hidden border shadow-sm card rounded-2xl border-white/60 bg-white/80 backdrop-blur-xl dark:border-slate-700/60 dark:bg-slate-800/70">
                    <div class="absolute inset-0 bg-gradient-to-br from-sky-500/[0.08] via-cyan-500/[0.04] to-transparent">
                    </div>
                    <div class="absolute rounded-full -top-12 -right-12 size-36 bg-sky-400/10 blur-3xl"></div>
                    <div
                        class="absolute bottom-0 left-0 w-full h-px bg-gradient-to-r from-transparent via-sky-400/30 to-transparent">
                    </div>

                    <div class="relative p-6 card-body">
                        <div class="flex items-start justify-between mb-5">
                            <div
                                class="flex items-center justify-center text-white shadow-lg size-14 rounded-2xl bg-gradient-to-br from-sky-500 to-cyan-500 shadow-sky-500/20">
                                <i data-lucide="shield-check" class="size-6"></i>
                            </div>

                            <div
                                class="flex items-center justify-center rounded-full size-10 bg-sky-500/10 text-sky-600 dark:bg-sky-500/20 dark:text-sky-300">
                                <i data-lucide="history" class="size-5"></i>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <p
                                class="text-xs font-semibold tracking-[0.16em] uppercase text-slate-400 dark:text-slate-500">
                                Last Logged In
                            </p>

                            <h5 class="text-base font-bold leading-7 tracking-tight text-slate-800 dark:text-white">
                                {{ !empty($studentdetails->last_seen)
                                    ? \Carbon\Carbon::parse($studentdetails->last_seen)->format('F j, Y • h:i A')
                                    : 'No login activity yet' }}
                            </h5>

                            <p class="text-sm text-slate-500 dark:text-slate-300">
                                Your most recent account access record
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="xl:col-span-4">
            <div class="sticky space-y-4 top-4">
                {{-- Section Header --}}
                <div class="px-1">
                    <p class="mb-1 text-[11px] font-semibold tracking-[0.22em] uppercase text-custom-500">
                        Applicant Overview
                    </p>
                    <h5 class="text-xl font-bold tracking-tight text-slate-800 dark:text-white">
                        Pre-registration Quick Information
                    </h5>
                    <p class="mt-1 text-sm text-slate-500 dark:text-slate-300">
                        View your current profile, program, registration, and student ID details.
                    </p>
                </div>

                {{-- Profile Status --}}
                <div
                    class="relative overflow-hidden border shadow-sm rounded-2xl border-white/60 bg-white/90 backdrop-blur-xl dark:border-zink-700/60 dark:bg-zink-800/80">
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-green-500/[0.06] via-emerald-500/[0.03] to-transparent">
                    </div>
                    <div class="absolute rounded-full -top-10 -right-10 size-28 bg-green-400/10 blur-3xl"></div>

                    <div class="relative p-5">
                        <div class="flex items-start gap-4">
                            @if ($applicant && $applicant->applicant_profile_status == 1)
                                <div
                                    class="flex items-center justify-center text-white shadow-lg shrink-0 size-14 rounded-2xl bg-gradient-to-br from-green-500 to-emerald-600 shadow-green-500/20">
                                    <i data-lucide="badge-check" class="size-6"></i>
                                </div>
                                <div class="min-w-0 grow">
                                    <div class="flex items-center gap-2 mb-1">
                                        <h5 class="text-base font-bold text-slate-800 dark:text-white">Published</h5>
                                        <span
                                            class="px-2.5 py-1 text-[11px] font-semibold rounded-full bg-green-100 text-green-700 dark:bg-green-500/20 dark:text-green-700">
                                            Completed
                                        </span>
                                    </div>
                                    <p class="text-sm text-slate-500 dark:text-zink-300">Student Profile Status</p>
                                </div>
                            @elseif ($applicant)
                                <div
                                    class="flex items-center justify-center text-white shadow-lg shrink-0 size-14 rounded-2xl bg-gradient-to-br from-amber-400 to-yellow-500 shadow-amber-500/20">
                                    <i data-lucide="square-pen" class="size-6"></i>
                                </div>
                                <div class="min-w-0 grow">
                                    <div class="flex items-center gap-2 mb-1">
                                        <h5 class="text-base font-bold text-slate-800 dark:text-white">Draft</h5>
                                        <span
                                            class="px-2.5 py-1 text-[11px] font-semibold rounded-full bg-yellow-100 text-yellow-700 dark:bg-yellow-500/20 dark:text-yellow-300">
                                            In Progress
                                        </span>
                                    </div>
                                    <p class="text-sm text-slate-500 dark:text-zink-300">Student Profile Status</p>
                                </div>
                            @else
                                <div
                                    class="flex items-center justify-center shadow-sm shrink-0 size-14 rounded-2xl bg-slate-100 text-slate-500 dark:bg-zink-700 dark:text-zink-300">
                                    <i data-lucide="minus" class="size-6"></i>
                                </div>
                                <div class="min-w-0 grow">
                                    <div class="flex items-center gap-2 mb-1">
                                        <h5 class="text-base font-bold text-slate-800 dark:text-white">No Record</h5>
                                        <span
                                            class="px-2.5 py-1 text-[11px] font-semibold rounded-full bg-slate-100 text-slate-600 dark:bg-zink-700 dark:text-zink-300">
                                            Empty
                                        </span>
                                    </div>
                                    <p class="text-sm text-slate-500 dark:text-zink-300">Student Profile Status</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Program --}}
                <div
                    class="relative overflow-hidden border shadow-sm rounded-2xl border-white/60 bg-white/90 backdrop-blur-xl dark:border-zink-700/60 dark:bg-zink-800/80">
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-violet-500/[0.05] via-fuchsia-500/[0.03] to-transparent">
                    </div>
                    <div class="absolute rounded-full -top-10 -right-10 size-28 bg-violet-400/10 blur-3xl"></div>

                    <div class="relative p-5">
                        <div class="flex items-start gap-4">
                            <div
                                class="flex items-center justify-center text-white shadow-lg shrink-0 size-14 rounded-2xl bg-gradient-to-br from-violet-500 to-purple-600 shadow-violet-500/20">
                                <i data-lucide="graduation-cap" class="size-6"></i>
                            </div>

                            <div class="min-w-0 grow">
                                <div class="flex items-center gap-2 mb-1">
                                    <h5 class="text-base font-bold text-slate-800 dark:text-white">Program</h5>
                                    <span
                                        class="px-2.5 py-1 text-[11px] font-semibold rounded-full bg-violet-100 text-violet-700 dark:bg-violet-500/20 dark:text-violet-700">
                                        Academic
                                    </span>
                                </div>

                                <div class="text-sm text-slate-600 dark:text-zink-300">
                                    @if (!$applicant)
                                        <span class="text-slate-400">---</span>
                                    @elseif ($applicant->policyId == null && $applicant->programName != null)
                                        <div class="space-y-3">
                                            <div class="font-medium text-slate-700 dark:text-zink-200">
                                                Thank you for choosing
                                                <span class="font-semibold text-custom-500">
                                                    {{ !empty($applicant->programName) ? $applicant->programName : '' }}
                                                    {{ !empty($applicant->majorDiscDesc) ? ' - ' . $applicant->majorDiscDesc : '' }}
                                                </span>.
                                            </div>

                                            <div
                                                class="p-3 border rounded-xl bg-amber-50 border-amber-200 text-amber-700 dark:bg-amber-500/10 dark:border-amber-500/20 dark:text-amber-700">
                                                While we truly appreciate your interest, the available slots for this
                                                program are
                                                limited and selection is based on ranking. At this time, you were not able
                                                to secure a
                                                slot. You may still choose another program from the available options.
                                            </div>

                                            <a href="{{ route('student.cee.result') }}"
                                                class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold text-green-700 transition-all duration-200 shadow-lg rounded-xl bg-gradient-to-r from-green-700 to-emerald-700 hover:shadow-green-500/25 hover:-translate-y-0.5">
                                                <i data-lucide="arrow-right-circle" class="size-4"></i>
                                                Go to Result Menu
                                            </a>
                                        </div>
                                    @elseif ($applicant->prereg_status == 'for_ranking' && $applicant->campus_id == null)
                                        <span class="text-slate-400">---</span>
                                    @else
                                        <div class="font-semibold text-slate-800 dark:text-white">
                                            {{ !empty($applicant->programName) ? $applicant->programName : '---' }}
                                            {{ !empty($applicant->majorDiscDesc) ? ' - ' . $applicant->majorDiscDesc : '' }}
                                        </div>
                                    @endif
                                </div>

                                <p class="mt-2 text-sm text-slate-500 dark:text-zink-300">Program Name</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Registration Status --}}
                <div
                    class="relative overflow-hidden border shadow-sm rounded-2xl border-white/60 bg-white/90 backdrop-blur-xl dark:border-zink-700/60 dark:bg-zink-800/80">
                    <div class="absolute inset-0 bg-gradient-to-br from-sky-500/[0.06] via-cyan-500/[0.03] to-transparent">
                    </div>
                    <div class="absolute rounded-full -top-10 -right-10 size-28 bg-sky-400/10 blur-3xl"></div>

                    <div class="relative p-5">
                        <div class="flex items-start gap-4">
                            <div
                                class="flex items-center justify-center text-white shadow-lg shrink-0 size-14 rounded-2xl bg-gradient-to-br from-sky-500 to-cyan-600 shadow-sky-500/20">
                                <i data-lucide="history" class="size-6"></i>
                            </div>

                            <div class="min-w-0 grow">
                                <div class="flex items-center gap-2 mb-1">
                                    <h5 class="text-base font-bold text-slate-800 dark:text-white">Registration Status</h5>
                                    <span
                                        class="px-2.5 py-1 text-[11px] font-semibold rounded-full bg-sky-100 text-sky-700 dark:bg-sky-500/20 dark:text-sky-700">
                                        Live Status
                                    </span>
                                </div>

                                <div class="space-y-3 text-sm text-slate-600 dark:text-zink-300">
                                    @if (!$applicant)
                                        <span class="text-slate-400">---</span>
                                    @elseif ($applicant->prereg_status == 'pending' && $applicant->status_id == null)
                                        <div class="font-medium text-slate-700 dark:text-zink-200">
                                            Program has been confirmed for enrollment.
                                        </div>

                                        @if ($applicant->applicant_profile_status == null || $applicant->applicant_profile_status == 0)
                                            <div
                                                class="p-4 border rounded-xl bg-rose-50 border-rose-200 dark:bg-rose-500/10 dark:border-rose-500/20">
                                                <p class="mb-3 font-medium text-rose-600 dark:text-rose-300">
                                                    Please proceed to Profile Registration to complete your
                                                    pre-registration.
                                                </p>

                                                <a href="{{ route('student.applicant-profile.step1.show') }}"
                                                    class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold text-white transition-all duration-200 shadow-lg rounded-xl bg-gradient-to-r from-green-500 to-emerald-600 hover:shadow-green-500/25 hover:-translate-y-0.5">
                                                    <i data-lucide="user-pen" class="size-4"></i>
                                                    Profile Registration
                                                </a>
                                            </div>
                                        @else
                                            @if (is_null($requirements))
                                                @if ($applicant->campus_id == 1)
                                                    <div
                                                        class="p-4 text-purple-700 border border-purple-200 rounded-xl bg-purple-50 dark:bg-purple-500/10 dark:border-purple-500/20 dark:text-purple-700">
                                                        Kindly submit the original copies of the required admission
                                                        documents to the
                                                        <b>Admission and Records Office (ARO), University of Southern
                                                            Mindanao,
                                                            Kabacan, Cotabato.</b>
                                                        <br>
                                                        If you have already submitted the required documents, please
                                                        disregard this
                                                        notice.
                                                    </div>
                                                @elseif($applicant->campus_id == 3)
                                                    <div
                                                        class="p-4 text-purple-700 border border-purple-200 rounded-xl bg-purple-50 dark:bg-purple-500/10 dark:border-purple-500/20 dark:text-purple-700">
                                                        Kindly submit the original copies of the required admission
                                                        documents to the
                                                        <b>Admission and Records Office (ARO), University of Southern
                                                            Mindanao –
                                                            Kidapawan City Campus, Kidapawan City.</b>
                                                        <br>
                                                        If you have already submitted the required documents, please
                                                        disregard this
                                                        notice.
                                                    </div>
                                                @endif
                                            @else
                                                @php
                                                    $labels = [
                                                        'goodmoral' => 'Good Moral Certificate',
                                                        'card' => 'Report Card',
                                                        'psa' => 'PSA Birth Certificate',
                                                        'hdismissal' => 'Honorable Dismissal',
                                                        'certificatetransfer' => 'Certificate of Transfer',
                                                        'transcript' => 'Transcript of Records',
                                                    ];
                                                @endphp

                                                <div class="flex flex-wrap gap-2 pt-1">
                                                    @foreach ($labels as $key => $label)
                                                        @if ($requirements->$key == 1)
                                                            <span
                                                                class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold border rounded-full bg-white border-green-200 text-green-600 shadow-sm dark:bg-zink-700 dark:border-green-700/40 dark:text-green-700">
                                                                <i data-lucide="check" class="size-3"></i>
                                                                {{ $label }}
                                                            </span>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            @endif
                                        @endif

                                        @if ($applicant->is_answered_nstp == 1)
                                            <div
                                                class="p-3 text-green-700 border border-green-200 rounded-xl bg-green-50 dark:bg-green-500/10 dark:border-green-500/20 dark:text-green-700">
                                                Please note that enrollment for CWTS or ROTC will take place after the NSTP
                                                orientation.
                                            </div>
                                        @endif
                                    @elseif ($applicant->prereg_status == 'for_ranking' && $applicant->campus_id != null)
                                        <span
                                            class="inline-flex items-center px-3 py-1.5 text-xs font-semibold border rounded-full bg-sky-100 border-transparent text-sky-700 dark:bg-sky-500/20 dark:text-sky-700">
                                            Please wait, ranking in progress.
                                        </span>
                                    @elseif ($applicant->prereg_status == 'for_ranking' && $applicant->campus_id == null)
                                        <span
                                            class="inline-flex items-center px-3 py-1.5 text-xs font-semibold border rounded-full bg-amber-100 border-transparent text-amber-700 dark:bg-amber-500/20 dark:text-amber-700">
                                            Please confirm the program.
                                        </span>
                                    @elseif ($applicant->policyId == null && $applicant->programName != null)
                                        <span class="text-slate-400">---</span>
                                    @elseif ($applicant->status_id == 0)
                                        <span
                                            class="inline-flex items-center px-3 py-1.5 text-xs font-semibold border rounded-full bg-orange-100 border-transparent text-orange-700 dark:bg-orange-500/20 dark:text-orange-700">
                                            Enrollment in progress
                                        </span>
                                    @elseif ($applicant->prereg_status == 'enrolled' || $applicant->status_id == 1)
                                        <div class="space-y-3">
                                            <span
                                                class="inline-flex items-center px-3 py-1.5 text-xs font-semibold border rounded-full bg-green-100 border-transparent text-green-700 dark:bg-green-500/20 dark:text-green-700">
                                                You are officially enrolled!
                                            </span>

                                            <div
                                                class="p-4 text-purple-700 border border-purple-200 rounded-xl bg-purple-50 dark:bg-purple-500/10 dark:border-purple-500/20 dark:text-purple-700">
                                                Tap the <b>Pre-registration Menu</b>, then tap the
                                                <b>Download COR button</b> to get your Certificate of Registration.
                                            </div>
                                        </div>
                                    @else
                                        <span class="text-slate-400">---</span>
                                    @endif
                                </div>

                                <p class="mt-2 text-sm text-slate-500 dark:text-zink-300">Status</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Student ID --}}
                <div
                    class="relative overflow-hidden border shadow-sm rounded-2xl border-white/60 bg-white/90 backdrop-blur-xl dark:border-zink-700/60 dark:bg-zink-800/80">
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-indigo-500/[0.06] via-blue-500/[0.03] to-transparent">
                    </div>
                    <div class="absolute rounded-full -top-10 -right-10 size-28 bg-indigo-400/10 blur-3xl"></div>

                    <div class="relative p-5">
                        <div class="flex items-start gap-4">
                            <div
                                class="flex items-center justify-center text-white shadow-lg shrink-0 size-14 rounded-2xl bg-gradient-to-br from-indigo-500 to-blue-600 shadow-indigo-500/20">
                                <i data-lucide="id-card" class="size-6"></i>
                            </div>

                            <div class="min-w-0 grow">
                                <div class="flex items-center gap-2 mb-1">
                                    <h5 class="text-base font-bold text-slate-800 dark:text-white">
                                        {{ $applicant->student_no ?? '---' }}
                                    </h5>
                                    <span
                                        class="px-2.5 py-1 text-[11px] font-semibold rounded-full bg-indigo-100 text-indigo-700 dark:bg-indigo-500/20 dark:text-indigo-700">
                                        Student ID
                                    </span>
                                </div>
                                <p class="text-sm text-slate-500 dark:text-zink-300">Student ID Number</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if ($applicant && $applicant->prereg_status == 'pending' && $applicant->is_answered_nstp == 0)
            <!--  NSTP Modal -->
            <div id="nstpModal" class="fixed inset-0 z-50 hidden">
                {{-- Backdrop --}}
                <div id="nstpModalOverlay" class="absolute inset-0 bg-slate-950/50 backdrop-blur-sm"></div>

                {{-- Modal Wrapper --}}
                <div class="relative flex items-center justify-center min-h-screen p-4">
                    <div
                        class="relative w-full max-w-2xl overflow-hidden border shadow-2xl rounded-3xl border-white/60 bg-white/95 backdrop-blur-xl dark:border-zink-700/60 dark:bg-zink-800/95">

                        {{-- Decorative top glow --}}
                        <div class="absolute inset-x-0 top-0 h-24 bg-green-500/5"></div>

                        {{-- Header --}}
                        <div class="relative px-6 pt-6 pb-4 border-b border-slate-200 dark:border-zink-700">
                            <div class="flex items-start gap-4">
                                <div
                                    class="flex items-center justify-center text-green-600 bg-green-100 rounded-2xl size-12 dark:bg-green-500/20 dark:text-green-300 shrink-0">
                                    <i data-lucide="shield-check" class="size-6"></i>
                                </div>

                                <div class="min-w-0 grow">
                                    <p class="mb-1 text-[11px] font-semibold tracking-[0.18em] uppercase text-green-500">
                                        Student Advisory
                                    </p>
                                    <h5 class="text-xl font-bold tracking-tight text-slate-800 dark:text-white">
                                        National Service Training Program (NSTP)
                                    </h5>
                                    <p class="mt-1 text-sm text-slate-500 dark:text-zink-300">
                                        Important information before proceeding
                                    </p>
                                </div>

                                <button id="closeModalBtn" type="button"
                                    class="inline-flex items-center justify-center rounded-xl size-10 text-slate-500 hover:bg-slate-100 hover:text-slate-700 dark:text-zink-300 dark:hover:bg-zink-700 dark:hover:text-white focus:outline-none focus:ring-2 focus:ring-slate-200">
                                    <i data-lucide="x" class="size-5"></i>
                                </button>
                            </div>
                        </div>

                        {{-- Body --}}
                        <div class="px-6 py-5">
                            <div
                                class="p-5 border rounded-2xl bg-slate-50 border-slate-200 dark:bg-zink-700/30 dark:border-zink-600">
                                <div class="space-y-4 text-sm leading-7 text-slate-600 dark:text-zink-200">
                                    <p>
                                        <strong class="text-slate-800 dark:text-white">The National Service Training
                                            Program (NSTP)</strong>
                                        is a government-mandated program in the Philippines designed to enhance civic
                                        consciousness,
                                        promote defense preparedness, and instill the values of service and patriotism among
                                        the youth.
                                        It is a required component for all students enrolled in higher education
                                        institutions and
                                        technical-vocational programs.
                                    </p>

                                    <p>
                                        Please be advised that enrollment for NSTP components such as
                                        <strong class="text-slate-800 dark:text-white">Civic Welfare Training Service
                                            (CWTS)</strong>
                                        and
                                        <strong class="text-slate-800 dark:text-white">Reserve Officers’ Training Corps
                                            (ROTC)</strong>
                                        will be conducted
                                        <strong class="text-green-600 dark:text-green-300">after the official NSTP
                                            Orientation</strong>.
                                        Students are encouraged to attend the orientation to be properly guided on the
                                        selection and
                                        enrollment process.
                                    </p>
                                </div>
                            </div>

                            {{-- Optional highlight note --}}
                            <div
                                class="flex gap-3 p-4 mt-4 border rounded-2xl border-amber-200 bg-amber-50 dark:border-amber-500/20 dark:bg-amber-500/10">
                                <div
                                    class="flex items-center justify-center rounded-xl size-10 bg-amber-100 text-amber-600 dark:bg-amber-500/20 dark:text-amber-300 shrink-0">
                                    <i data-lucide="badge-alert" class="size-5"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1 text-sm font-semibold text-slate-800 dark:text-white">
                                        Reminder
                                    </h6>
                                    <p class="text-sm leading-6 text-slate-600 dark:text-zink-300">
                                        You do not need to choose CWTS or ROTC yet. Final enrollment for NSTP will happen
                                        after the
                                        orientation.
                                    </p>
                                </div>
                            </div>
                        </div>

                        {{-- Footer --}}
                        <div
                            class="flex flex-col-reverse gap-3 px-6 py-4 border-t sm:flex-row sm:items-center sm:justify-end border-slate-200 dark:border-zink-700">

                            <button id="saveNstpPref" type="button"
                                class="inline-flex items-center justify-center w-full gap-2 px-5 py-2.5 text-sm font-semibold text-white rounded-xl bg-green-500 hover:bg-green-600 transition-all duration-200 shadow-sm hover:shadow-md focus:outline-none focus:ring-2 focus:ring-green-200 sm:w-auto">
                                <i data-lucide="check" class="size-4"></i>
                                OK, I Understand
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            @push('scripts')
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const modal = document.getElementById('nstpModal');
                        const overlay = document.getElementById('nstpModalOverlay');
                        const closeModalBtn = document.getElementById('closeModalBtn');
                        const saveNstpPref = document.getElementById('saveNstpPref');

                        if (!modal || !overlay || !closeModalBtn || !saveNstpPref) return;

                        function openModal() {
                            modal.classList.remove('hidden');
                            document.body.classList.add('overflow-hidden');
                            if (window.lucide) lucide.createIcons();
                        }

                        function closeModal() {
                            modal.classList.add('hidden');
                            document.body.classList.remove('overflow-hidden');
                        }

                        openModal();

                        overlay.addEventListener('click', closeModal);
                        closeModalBtn.addEventListener('click', closeModal);

                        saveNstpPref.addEventListener('click', function() {
                            const selectedNSTP = 2; // default ROTC

                            saveNstpPref.disabled = true;
                            saveNstpPref.classList.add('opacity-70', 'cursor-not-allowed');

                            fetch('{{ route('student.applicant-profile.nstp-pref.save') }}', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                        'Accept': 'application/json'
                                    },
                                    body: JSON.stringify({
                                        nstp: selectedNSTP
                                    })
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        if (typeof Toastify !== 'undefined') {
                                            Toastify({
                                                text: '<i class="fas fa-check-circle" style="margin-right: 8px;"></i>' +
                                                    (data.message || 'Saved successfully!'),
                                                duration: 3000,
                                                gravity: 'top',
                                                position: 'right',
                                                backgroundColor: '#22c55e',
                                                escapeMarkup: false
                                            }).showToast();
                                        }

                                        closeModal();
                                    } else {
                                        saveNstpPref.disabled = false;
                                        saveNstpPref.classList.remove('opacity-70', 'cursor-not-allowed');

                                        if (typeof Toastify !== 'undefined') {
                                            Toastify({
                                                text: data.message || 'Failed to save NSTP preference.',
                                                duration: 3000,
                                                gravity: 'top',
                                                position: 'right',
                                                backgroundColor: '#ef4444'
                                            }).showToast();
                                        } else {
                                            alert('Error: ' + (data.message || 'Failed to save NSTP preference.'));
                                        }
                                    }
                                })
                                .catch(error => {
                                    console.error('Request failed:', error);

                                    saveNstpPref.disabled = false;
                                    saveNstpPref.classList.remove('opacity-70', 'cursor-not-allowed');

                                    if (typeof Toastify !== 'undefined') {
                                        Toastify({
                                            text: 'An unexpected error occurred.',
                                            duration: 3000,
                                            gravity: 'top',
                                            position: 'right',
                                            backgroundColor: '#ef4444'
                                        }).showToast();
                                    } else {
                                        alert('An unexpected error occurred.');
                                    }
                                });
                        });

                        document.addEventListener('keydown', function(e) {
                            if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
                                closeModal();
                            }
                        });
                    });
                </script>
            @endpush
        @endif

        {{-- @if ($isreservation_exist > 0)
            <div class="col-span-6 xl:col-span-12">
                <div class="card">
                    <div class="card-body">
                        <h6 class="mb-4 text-15">YOUR USMCEE RESERVATION HISTORY
                        </h6>
                        <div class="overflow-x-auto">
                            <table class="w-full border-separate table-custom border-spacing-y-1">
                                <thead class="">
                                    <tr
                                        class="relative rounded-md bg-slate-50 after:absolute after:border-l-2 after:left-0 after:top-0 after:bottom-0 after:border-transparent dark:bg-zink-600 [&.active]:after:border-custom-500">
                                        <th class="px-3.5 py-2.5 font-semibold justify-center">Action</th>
                                        <th class="px-3.5 py-2.5 font-semibold ltr:text-left rtl:text-right">Status</th>
                                        <th class="px-3.5 py-2.5 font-semibold ltr:text-left rtl:text-right">App #</th>
                                        <th class="px-3.5 py-2.5 font-semibold ltr:text-left rtl:text-right">Schedule
                                        </th>
                                        <th class="px-3.5 py-2.5 font-semibold ltr:text-left rtl:text-right">Venue</th>
                                        <th class="px-3.5 py-2.5 font-semibold ltr:text-left rtl:text-right">Date
                                            Created</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($cee_reservation_records->isNotEmpty())
                                        @foreach ($cee_reservation_records as $data)
                                            <tr
                                                class="relative rounded-md bg-slate-50 after:absolute after:border-l-2 after:left-0 after:top-0 after:bottom-0 after:border-transparent dark:bg-zink-600 [&.active]:after:border-custom-500">

                                                <td class="px-3.5 py-2.5">
                                                    @if ($data->status === 'cancelled')
                                                        <a href="#"
                                                            class="flex items-center justify-center transition-all duration-200 ease-linear bg-slate-100 text-slate-500 btn hover:text-white hover:bg-slate-600 focus:text-white focus:bg-slate-600 focus:ring focus:ring-green-100 active:text-white active:bg-slate-600 active:ring active:ring-green-100 dark:bg-green-500/20 dark:text-slate-400 dark:hover:bg-slate-500 dark:hover:text-white dark:focus:bg-slate-500 dark:focus:text-white dark:active:bg-slate-500 dark:active:text-white dark:ring-slate-400/20">
                                                            Not Available
                                                        </a>
                                                    @elseif($data->status === 'pending')
                                                        <a href="{{ route('student.cee.exam-slip', ['app_no' => encrypt($data->app_no)]) }}"
                                                            target="_blank"
                                                            class="flex items-center justify-center text-green-500 transition-all duration-200 ease-linear bg-green-100 btn hover:text-white hover:bg-green-600 focus:text-white focus:bg-green-600 focus:ring focus:ring-green-100 active:text-white active:bg-green-600 active:ring active:ring-green-100 dark:bg-green-500/20 dark:text-green-400 dark:hover:bg-green-500 dark:hover:text-white dark:focus:bg-green-500 dark:focus:text-white dark:active:bg-green-500 dark:active:text-white dark:ring-green-400/20">
                                                            CEE Slip
                                                        </a>
                                                    @else
                                                        <a href="{{ route('student.cee.result') }}" target="_blank"
                                                            class="flex items-center justify-center text-green-500 transition-all duration-200 ease-linear bg-green-100 btn hover:text-white hover:bg-green-600 focus:text-white focus:bg-green-600 focus:ring focus:ring-green-100 active:text-white active:bg-green-600 active:ring active:ring-green-100 dark:bg-green-500/20 dark:text-green-400 dark:hover:bg-green-500 dark:hover:text-white dark:focus:bg-green-500 dark:focus:text-white dark:active:bg-green-500 dark:active:text-white dark:ring-green-400/20">
                                                            Result
                                                        </a>
                                                    @endif
                                                </td>

                                                <td class="px-3.5 py-2.5">
                                                    @if ($data->status === 'pending')
                                                        <span
                                                            class="inline-flex items-center px-2.5 py-0.5 text-xs font-medium rounded border bg-yellow-100 border-transparent text-yellow-500 dark:bg-yellow-500/20 dark:border-transparent">
                                                            <i data-lucide="circle-dashed"
                                                                class="size-3 ltr:mr-1 rtl:ml-1"></i>
                                                            Reserved</span>
                                                    @elseif ($data->status === 'cancelled')
                                                        <span
                                                            class="inline-flex items-center px-2.5 py-0.5 text-xs font-medium rounded border bg-red-100 border-transparent text-red-500 dark:bg-red-500/20 dark:border-transparent"><i
                                                                data-lucide="x-circle"
                                                                class="size-3 ltr:mr-1 rtl:ml-1"></i>
                                                            Cancelled</span>
                                                    @elseif($data->status === 'confirmed')
                                                        <span
                                                            class="inline-flex items-center px-2.5 py-0.5 text-xs font-medium rounded border bg-green-100 border-transparent text-green-500 dark:bg-green-500/20 dark:border-transparent"><i
                                                                data-lucide="check-circle-2"
                                                                class="size-3 ltr:mr-1 rtl:ml-1"></i> Confirmed</span>
                                                    @endif
                                                </td>
                                                <td class="px-3.5 py-2.5">{{ $data->app_no }}</td>
                                                <td class="px-3.5 py-2.5">
                                                    <span
                                                        class="inline-flex items-center px-2.5 py-0.5 text-xs font-medium rounded border bg-green-100 border-transparent text-green-500 dark:bg-green-500/20 dark:border-transparent">
                                                        {{ $data->session_name }}</span><br>
                                                    {{ $data->exam_session }} <br>
                                                    {{ \Carbon\Carbon::parse($data->schedule)->format('F j, Y') }}
                                                    [{{ $data->time }}]
                                                </td>
                                                <td class="px-3.5 py-2.5">
                                                    <span
                                                        class="inline-flex items-center px-2.5 py-0.5 text-xs font-medium rounded border bg-green-100 border-transparent text-green-500 dark:bg-green-500/20 dark:border-transparent">
                                                        {{ $data->campus }}</span><br>
                                                    {{ $data->college_name . '-' . $data->room_name }}
                                                </td>
                                                <td class="px-3.5 py-2.5">
                                                    {{ \Carbon\Carbon::parse($data->created_at)->setTimezone('Asia/Manila')->format('F j, Y h:i A') }}
                                                </td>



                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="8" class="px-3.5 py-2.5 text-center text-gray-500">
                                                No reservations available.
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endif --}}




    </div><!--end grid-->
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

    <script>
        function updateDateTime() {
            const now = new Date();

            const dateOptions = {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            };

            const timeOptions = {
                hour: 'numeric',
                minute: '2-digit',
                second: '2-digit',
                hour12: true
            };

            const dateEl = document.getElementById('current-date');
            const timeEl = document.getElementById('current-time');

            if (dateEl) dateEl.textContent = now.toLocaleDateString('en-US', dateOptions);
            if (timeEl) timeEl.textContent = now.toLocaleTimeString('en-US', timeOptions);
        }

        updateDateTime();
        setInterval(updateDateTime, 1000);
    </script>
@endpush
