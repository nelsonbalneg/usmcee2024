@extends('student.layouts.master')
@section('title')
    USM-CEE | Programs
@endsection

@php
    use Carbon\Carbon;
    $start = Carbon::parse($site_settings->start_prereg_second_batch);
    $end = Carbon::parse($site_settings->end_prereg_second_batch);

    $start_batch_1 = Carbon::parse($site_settings->start_prereg);
    $end_batch_1 = Carbon::parse($site_settings->end_prereg);
@endphp


@section('contents')

    <x-page-header title="USMCEE 4.0 | Pre-registration Dashboard" :breadcrumbs="[
        ['label' => 'Home', 'url' => route('dashboard')],
        ['label' => 'Pre-registration', 'url' => '#!'],
        ['label' => 'Dashboard'],
    ]" />

    @if ($result && $result->csa >= 25)
        @if ($isPreregOpen)
            <div class="grid grid-cols-1 xl:grid-cols-12 gap-x-5">

                <div class="xl:col-span-6">
                    <div class="sticky top-[calc(theme('spacing.header')_*_1.3)]">
                        <div
                            class="relative overflow-hidden border shadow-sm rounded-2xl border-white/60 bg-white/90 backdrop-blur-xl dark:border-zink-700/60 dark:bg-zink-800/80">

                            {{-- Decorative layers --}}
                            <div
                                class="absolute inset-0 bg-gradient-to-br from-emerald-500/[0.05] via-sky-500/[0.03] to-transparent">
                            </div>
                            <div class="absolute rounded-full -top-10 -right-10 size-32 bg-emerald-400/10 blur-3xl"></div>
                            <div
                                class="absolute top-0 left-0 w-full h-px bg-gradient-to-r from-transparent via-emerald-400/30 to-transparent">
                            </div>

                            <div class="relative p-6">
                                {{-- Header --}}
                                <div class="mb-6">
                                    <p class="mb-1 text-[11px] font-semibold tracking-[0.22em] uppercase text-emerald-500">
                                        Enrollment Guide
                                    </p>
                                    <h6 class="text-lg font-bold tracking-tight text-slate-800 dark:text-white">
                                        Enrollment Process for Incoming Freshmen
                                    </h6>
                                    <p class="mt-1 text-sm text-slate-500 dark:text-zink-300">
                                        1st Semester, A.Y. 2026–2027
                                    </p>
                                </div>

                                {{-- Timeline --}}
                                <div class="space-y-5">

                                    {{-- Step 1 --}}
                                    <div class="relative pl-16">
                                        <div
                                            class="absolute left-[1.05rem] top-12 bottom-[-1.25rem] w-px bg-gradient-to-b from-emerald-200 via-slate-200 to-slate-100 dark:from-emerald-500/30 dark:via-zink-600 dark:to-zink-700">
                                        </div>

                                        <div
                                            class="absolute top-0 left-0 flex items-center justify-center bg-white border shadow-sm size-9 rounded-2xl border-slate-200 text-emerald-500 dark:border-zink-600 dark:bg-zink-700">
                                            @if (
                                                $applicant &&
                                                    ($applicant->applicant_profile_status == 0 ||
                                                        empty($applicant->applicant_profile_status) ||
                                                        is_null($applicant->applicant_profile_status)))
                                                <i data-lucide="circle-dot" class="size-4"></i>
                                            @else
                                                <i data-lucide="circle-check-big" class="size-4"></i>
                                            @endif
                                        </div>

                                        <div
                                            class="p-4 border rounded-2xl bg-slate-50/80 border-slate-200/70 dark:bg-zink-700/30 dark:border-zink-600">
                                            <div class="flex flex-wrap items-center gap-2 mb-2">
                                                <h6 class="font-bold tracking-tight text-slate-800 dark:text-white">
                                                    Profile Registration
                                                </h6>
                                                <span
                                                    class="px-2.5 py-1 text-[11px] font-semibold rounded-full bg-emerald-100 text-emerald-700 dark:bg-emerald-500/20 dark:text-emerald-600">
                                                    Step 1
                                                </span>
                                            </div>

                                            <p class="mb-4 text-sm text-slate-500 dark:text-zink-300">
                                                Confirmation of enrollment for qualified applicants. Encoding of personal
                                                information,
                                                including address, parent/guardian details, educational background, and
                                                other important
                                                information.
                                            </p>

                                            <a href="{{ route('student.applicant-profile.step1.show') }}"
                                                class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl bg-emerald-100 text-emerald-700 dark:bg-emerald-500/20 dark:text-emerald-700">
                                                <i data-lucide="user-pen" class="size-4"></i>
                                                Profile Registration
                                            </a>
                                        </div>
                                    </div>

                                    {{-- Step 2 --}}
                                    <div class="relative pl-16">
                                        <div
                                            class="absolute left-[1.05rem] top-12 bottom-[-1.25rem] w-px bg-gradient-to-b from-slate-200 via-slate-200 to-slate-100 dark:from-zink-600 dark:via-zink-600 dark:to-zink-700">
                                        </div>

                                        <div
                                            class="absolute top-0 left-0 flex items-center justify-center bg-white border shadow-sm size-9 rounded-2xl border-slate-200 text-emerald-500 dark:border-zink-600 dark:bg-zink-700">
                                            @if ($applicant && $applicant->applicant_profile_status == 1)
                                                @if (
                                                    $requirements &&
                                                        (($requirements->req_status == 0 || empty($requirements->req_status) || is_null($requirements->req_status)) &&
                                                            ($requirements->additional_req_status == 0 ||
                                                                empty($requirements->additional_req_status) ||
                                                                is_null($requirements->additional_req_status))))
                                                    <i data-lucide="file-axis-3d" class="size-4"></i>
                                                @else
                                                    <i data-lucide="circle-check-big" class="size-4"></i>
                                                @endif
                                            @else
                                                <i data-lucide="file-axis-3d" class="size-4"></i>
                                            @endif
                                        </div>

                                        <div
                                            class="p-4 border rounded-2xl bg-slate-50/80 border-slate-200/70 dark:bg-zink-700/30 dark:border-zink-600">
                                            <div class="flex flex-wrap items-center gap-2 mb-2">
                                                <h6 class="font-bold tracking-tight text-slate-800 dark:text-white">
                                                    Uploading of Requirements
                                                </h6>
                                                <span
                                                    class="px-2.5 py-1 text-[11px] font-semibold rounded-full bg-sky-100 text-sky-700 dark:bg-sky-500/20 dark:text-sky-700">
                                                    Step 2
                                                </span>
                                            </div>

                                            <p class="mb-4 text-sm text-slate-500 dark:text-zink-300">
                                                Upload electronic copies of pertinent requirements such as e-signature, Form
                                                138, and
                                                other necessary documents.
                                            </p>

                                            @if ($applicant && $applicant->applicant_profile_status == 1)
                                                <a href="{{ route('student.applicant-requirements.index') }}"
                                                    class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl bg-emerald-100 text-emerald-700 dark:bg-emerald-500/20 dark:text-emerald-700">
                                                    <i data-lucide="upload" class="size-4"></i>
                                                    Upload Requirements
                                                </a>
                                            @endif
                                        </div>
                                    </div>

                                    {{-- Step 3 --}}
                                    <div class="relative pl-16">
                                        <div
                                            class="absolute left-[1.05rem] top-12 bottom-[-1.25rem] w-px bg-gradient-to-b from-slate-200 via-slate-200 to-slate-100 dark:from-zink-600 dark:via-zink-600 dark:to-zink-700">
                                        </div>

                                        <div
                                            class="absolute top-0 left-0 flex items-center justify-center bg-white border shadow-sm size-9 rounded-2xl border-slate-200 text-emerald-500 dark:border-zink-600 dark:bg-zink-700">
                                            @if ($applicant && $applicant->applicant_profile_status == 1)
                                                @if (!empty($applicant->campus_id) && !is_null($applicant->prog_id))
                                                    <i data-lucide="circle-check-big" class="size-4"></i>
                                                @else
                                                    <i data-lucide="graduation-cap" class="size-4"></i>
                                                @endif
                                            @else
                                                <i data-lucide="graduation-cap" class="size-4"></i>
                                            @endif
                                        </div>

                                        <div
                                            class="p-4 border rounded-2xl bg-slate-50/80 border-slate-200/70 dark:bg-zink-700/30 dark:border-zink-600">
                                            <div class="flex flex-wrap items-center gap-2 mb-2">
                                                <h6 class="font-bold tracking-tight text-slate-800 dark:text-white">
                                                    Priority Program Confirmation
                                                </h6>
                                                <span
                                                    class="px-2.5 py-1 text-[11px] font-semibold rounded-full bg-violet-100 text-violet-700 dark:bg-violet-500/20 dark:text-violet-700">
                                                    Step 3
                                                </span>
                                            </div>

                                            <p class="mb-4 text-sm leading-7 text-slate-500 dark:text-zink-300">
                                                Confirm your priority program.
                                            </p>

                                            @if ($applicant && $applicant->applicant_profile_status == 1)
                                                <a href="{{ route('student.program-confirmation.index') }}"
                                                    class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl bg-emerald-100 text-emerald-700 dark:bg-emerald-500/20 dark:text-emerald-700">
                                                    <i data-lucide="graduation-cap" class="size-4"></i>
                                                    Program Confirmation
                                                </a>
                                            @endif
                                        </div>
                                    </div>

                                    {{-- Step 4 --}}
                                    <div class="relative pl-16">
                                        <div
                                            class="absolute left-[1.05rem] top-12 bottom-[-1.25rem] w-px bg-gradient-to-b from-slate-200 via-slate-200 to-slate-100 dark:from-zink-600 dark:via-zink-600 dark:to-zink-700">
                                        </div>

                                        <div
                                            class="absolute top-0 left-0 flex items-center justify-center bg-white border shadow-sm size-9 rounded-2xl border-slate-200 text-emerald-500 dark:border-zink-600 dark:bg-zink-700">
                                            @if ($applicant && ($applicant->status_id == 0 || $applicant->status_id == 1))
                                                <i data-lucide="circle-check-big" class="size-4"></i>
                                            @else
                                                <i data-lucide="layers" class="size-4"></i>
                                            @endif
                                        </div>

                                        <div
                                            class="p-4 border rounded-2xl bg-slate-50/80 border-slate-200/70 dark:bg-zink-700/30 dark:border-zink-600">
                                            <div class="flex flex-wrap items-center gap-2 mb-2">
                                                <h6 class="font-bold tracking-tight text-slate-800 dark:text-white">
                                                    Submission of Original Copies of Requirements
                                                </h6>
                                                <span
                                                    class="px-2.5 py-1 text-[11px] font-semibold rounded-full bg-amber-100 text-amber-700 dark:bg-amber-500/20 dark:text-amber-700">
                                                    April 20, 2026
                                                </span>
                                            </div>

                                            <p class="text-sm text-slate-500 dark:text-zink-300">
                                                Submit the original copies of pertinent requirements to the
                                                <b class="text-custom-500">Admission and Records Office (ARO)</b>.
                                            </p>
                                        </div>
                                    </div>

                                    {{-- Step 5 --}}
                                    <div class="relative pl-16">
                                        <div
                                            class="absolute left-[1.05rem] top-12 bottom-[-1.25rem] w-px bg-gradient-to-b from-slate-200 via-slate-200 to-slate-100 dark:from-zink-600 dark:via-zink-600 dark:to-zink-700">
                                        </div>

                                        <div
                                            class="absolute top-0 left-0 flex items-center justify-center bg-white border shadow-sm size-9 rounded-2xl border-slate-200 text-emerald-500 dark:border-zink-600 dark:bg-zink-700">
                                            @if (($applicant && $applicant->status_id == 0) || ($applicant && $applicant->status_id == 1))
                                                <i data-lucide="circle-check-big" class="size-4"></i>
                                            @else
                                                <i data-lucide="loader" class="size-4"></i>
                                            @endif
                                        </div>

                                        <div
                                            class="p-4 border rounded-2xl bg-slate-50/80 border-slate-200/70 dark:bg-zink-700/30 dark:border-zink-600">
                                            <div class="flex flex-wrap items-center gap-2 mb-2">
                                                <h6 class="font-bold tracking-tight text-slate-800 dark:text-white">
                                                    Processing of Enrollment
                                                </h6>
                                                <span
                                                    class="px-2.5 py-1 text-[11px] font-semibold rounded-full bg-orange-100 text-orange-700 dark:bg-orange-500/20 dark:text-orange-300">
                                                    Processing
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Step 6 --}}
                                    <div class="relative pl-16">
                                        <div
                                            class="absolute top-0 left-0 flex items-center justify-center bg-white border shadow-sm size-9 rounded-2xl border-slate-200 text-emerald-500 dark:border-zink-600 dark:bg-zink-700">
                                            @if ($applicant && $applicant->status_id == 1)
                                                <i data-lucide="download" class="size-4"></i>
                                            @else
                                                <i data-lucide="loader" class="size-4"></i>
                                            @endif
                                        </div>

                                        <div
                                            class="p-4 border rounded-2xl bg-slate-50/80 border-slate-200/70 dark:bg-zink-700/30 dark:border-zink-600">
                                            <div class="flex flex-wrap items-center gap-2 mb-2">
                                                <h6 class="font-bold tracking-tight text-slate-800 dark:text-white">
                                                    Downloading of Certificate of Registration
                                                </h6>
                                                <span
                                                    class="px-2.5 py-1 text-[11px] font-semibold rounded-full bg-green-100 text-green-700 dark:bg-green-500/20 dark:text-green-700">
                                                    Final Step
                                                </span>
                                            </div>

                                            @if (
                                                ($applicant && $applicant->prereg_status == 'enrolled') ||
                                                    ($applicant && $applicant->status_id == 1 && $applicant->temp_cor == 0))
                                                <a href="{{ route('student.download.cor') }}"
                                                    class="inline-flex items-center gap-2 px-4 py-2 mt-2 text-sm font-semibold text-white transition-all duration-200 shadow-lg rounded-xl  bg-emerald-600 hover:-translate-y-0.5 hover:shadow-green-500/25">
                                                    <i data-lucide="eye" class="size-4"></i>
                                                    View Certificate of Registration
                                                </a>
                                            @endif

                                            @if ($applicant && $applicant->temp_cor == 1 && $applicant->prereg_status == 'pending')
                                                <a href="{{ route('student.print.temp.cor', $applicant->id) }}"
                                                    class="inline-flex items-center gap-2 px-4 py-2 mt-2 text-sm font-semibold text-white transition-all duration-200 shadow-lg rounded-xl  bg-purple-600 hover:-translate-y-0.5 hover:shadow-purple-500/25">
                                                    <i data-lucide="eye" class="size-4"></i>
                                                    View  Certificate of Registration
                                                </a>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--end col-->


                <div class="xl:col-span-6">
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
                                                <h5 class="text-base font-bold text-slate-800 dark:text-white">Published
                                                </h5>
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
                                                <h5 class="text-base font-bold text-slate-800 dark:text-white">No Record
                                                </h5>
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
                                                        While we truly appreciate your interest, the available slots for
                                                        this
                                                        program are
                                                        limited and selection is based on ranking. At this time, you were
                                                        not able
                                                        to secure a
                                                        slot. You may still choose another program from the available
                                                        options.
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
                            <div
                                class="absolute inset-0 bg-gradient-to-br from-sky-500/[0.06] via-cyan-500/[0.03] to-transparent">
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
                                            <h5 class="text-base font-bold text-slate-800 dark:text-white">Registration
                                                Status</h5>
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
                                                                <b>Admission and Records Office (ARO), University of
                                                                    Southern
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
                                                                <b>Admission and Records Office (ARO), University of
                                                                    Southern
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
                                                        Please note that enrollment for CWTS or ROTC will take place after
                                                        the NSTP
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

            </div>
        @else
            <div class="flex gap-3 p-4 mb-4 text-sm text-red-500 rounded-md bg-red-50 dark:bg-red-400/20">
                <i data-lucide="check-circle" class="inline-block size-4 mt-0.5 shrink-0"></i>
                <div>
                    <h6 class="mb-1"> <span class="font-bold">Information!</span> USMCEE PREREGISTRATION UPDATE.
                    </h6>
                    <ul class="ml-2 list-disc list-inside">
                        <li>{{ $preregMessage }}</li>

                    </ul>
                </div>
            </div>
        @endif
    @else
        <div
            class="mb-4 text-yellow-700 bg-yellow-100 border-yellow-500 alert dark:bg-yellow-500/20 dark:border-yellow-400 dark:text-yellow-300">
            <div>
                <h6 class="mb-1"> <span class="font-bold">Information!</span> USMCEE PREREGISTRATION UPDATE.</h6>
                <ul class="ml-2 list-disc list-inside">
                    <li>Please wait for the official preregistration schedule.</li>
                </ul>
            </div>
        </div>
    @endif

@endsection
