@extends('student.layouts.master')
@php
    use Carbon\Carbon;
    $start = Carbon::parse($site_settings->start_prereg_second_batch);
    $end = Carbon::parse($site_settings->end_prereg_second_batch);
@endphp
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

            {{-- check if requirements has been publihed or has submitted requirements --}}
            @if ($has_requirement && $cee_profile->applicant_profile_status == 1)
                <div class="card">
                    <div class="card-body">

                        {{-- check if qualified for 1st batch --}}
                        {{-- @if ($is_qualified_pre_reg == 1 && $programData['reservationStatus'] == 'Open') --}}
                        {{-- start id prereg 1 --}}
                        @if ($is_qualified_pre_reg == 1)
                            @if (
                                $programData['reservationStatus'] == 'Open' ||
                                    $cee_profile->prereg_status == 'pending' ||
                                    $cee_profile->prereg_status == 'enrolled')
                                <input type="hidden" name="program_policy_id" value="{{ $programData['id'] }}">
                                <input type="hidden" name="user_id" value="{{ $cee_profile->user_id }}">

                                <div class="px-4 py-6 mx-auto text-center">

                                    @if ($cee_profile->prereg_status != 'pending')
                                        <div
                                            class="px-4 py-3 text-sm text-green-500 border border-green-200 rounded-md bg-green-50 dark:bg-green-400/20 dark:border-green-500/50">
                                            <span class="font-bold">Yahoo!</span> You belong to the first batch of
                                            qualifiers
                                            for
                                            Pre-registration.
                                            Kindly click the <b class="text-green-800">'Confirm'</b> button to confirm your
                                            interest
                                            in
                                            enrolling in the program.
                                        </div>
                                    @else
                                        <div class="max-w-4xl mx-auto space-y-4 text-center">

                                            {{-- Success Heading --}}
                                            <div>
                                                <p
                                                    class="mb-1 text-[11px] font-semibold tracking-[0.22em] uppercase text-green-500">
                                                    Pre-registration Status
                                                </p>

                                                <h5 class="text-xl font-bold tracking-tight text-slate-800 dark:text-white">
                                                    Congratulations,
                                                    <span class="text-custom-500">
                                                        {{ $cee_profile->first_name }}
                                                        {{ $cee_profile->middle_initial }}
                                                        {{ $cee_profile->last_name }}
                                                        {{ $cee_profile->ext_name }}
                                                    </span>
                                                </h5>

                                                <p class="mt-2 text-sm leading-7 text-slate-600 dark:text-zink-300">
                                                    Your pre-registration has been successfully completed.
                                                </p>
                                            </div>

                                            {{-- NSTP Notice --}}
                                            @if ($cee_profile->is_answered_nstp == 1)
                                                <div
                                                    class="inline-flex items-start max-w-2xl gap-2 px-4 py-3 text-sm text-green-700 border border-green-200 rounded-2xl bg-green-50 dark:border-green-500/20 dark:bg-green-500/10 dark:text-green-500">
                                                    <i data-lucide="badge-info" class="mt-0.5 size-4 shrink-0"></i>
                                                    <span class="text-left">
                                                        Please note that enrollment for <b>CWTS</b> or <b>ROTC</b> will take
                                                        place after the NSTP orientation.
                                                    </span>
                                                </div>
                                            @endif

                                            {{-- Requirements / Submission Notice --}}
                                            @if (is_null($requirements_submitted))
                                                <div
                                                    class="inline-flex items-start max-w-3xl gap-2 px-4 py-3 text-sm text-purple-700 border border-purple-200 rounded-2xl bg-purple-50 dark:border-purple-500/20 dark:bg-purple-500/10 dark:text-purple-500">
                                                    <i data-lucide="file-check" class="mt-0.5 size-4 shrink-0"></i>
                                                    <span class="text-left">
                                                        Submit the original copies of the pertinent requirements to the
                                                        <b>Admission and Records Office (ARO)</b> as soon as possible. If you already submitted your documents, kindly disregard this message.
                                                    </span>
                                                </div>
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

                                                <div class="pt-2">
                                                    <p class="mb-3 text-sm font-semibold text-slate-700 dark:text-zink-200">
                                                        Submitted Requirement Summary
                                                    </p>

                                                    <div class="flex flex-wrap items-center justify-center gap-2">
                                                        @foreach ($labels as $key => $label)
                                                            @if ($requirements_submitted->$key == 1)
                                                                <span
                                                                    class="inline-flex items-center gap-1 px-3 py-1 text-xs font-semibold text-green-700 bg-white border border-green-300 rounded-full dark:border-green-700 dark:bg-zink-700 dark:text-green-300">
                                                                    <i data-lucide="check" class="size-3"></i>
                                                                    {{ $label }}
                                                                </span>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    @endif

                                    {{-- dire --}}
                                    <div class="mt-6">

                                        {{-- Table Card --}}
                                        <div
                                            class="overflow-hidden bg-white border shadow-sm rounded-2xl border-slate-200 dark:border-zink-600 dark:bg-zink-800">


                                            {{-- Table --}}
                                            <div class="overflow-x-auto">
                                                <table class="w-full min-w-[720px]">
                                                    <thead class="bg-slate-50 dark:bg-zink-700/50">
                                                        <tr>
                                                            <th
                                                                class="px-4 py-3 text-xs font-semibold text-left uppercase text-slate-500 dark:text-zink-300">
                                                                Action
                                                            </th>
                                                            <th
                                                                class="px-4 py-3 text-xs font-semibold text-left uppercase text-slate-500 dark:text-zink-300">
                                                                Program
                                                            </th>
                                                            <th
                                                                class="px-4 py-3 text-xs font-semibold text-left uppercase text-slate-500 dark:text-zink-300">
                                                                Campus & College
                                                            </th>
                                                        </tr>
                                                    </thead>

                                                    <tbody class="divide-y divide-slate-200 dark:divide-zink-600">
                                                        <tr class="bg-white dark:bg-zink-800">

                                                            {{-- ACTION --}}
                                                            <td class="px-4 py-4 align-top">
                                                                @if ($slot_remaning > 0 || $cee_profile->prereg_status == 'pending')

                                                                    @if ($cee_profile->prereg_status != 'pending')

                                                                        @php
                                                                            $requiresAdditional = in_array(
                                                                                $programData['id'],
                                                                                [
                                                                                    938,
                                                                                    946,
                                                                                    883,
                                                                                    905,
                                                                                    886,
                                                                                    884,
                                                                                    887,
                                                                                    959,
                                                                                ],
                                                                            );
                                                                        @endphp

                                                                        @if ($requiresAdditional)
                                                                            @if ($has_additional_requirement)
                                                                                <button type="submit"
                                                                                    class="inline-flex gap-2 px-4 py-2 text-xs font-semibold text-white transition-all duration-200 bg-green-500 shadow-sm rounded-xl hover:bg-green-600 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-green-200">
                                                                                    <i data-lucide="thumbs-up"
                                                                                        class="size-3.5"></i>
                                                                                    Confirm
                                                                                </button>
                                                                            @else
                                                                                <a href="{{ route('student.add-requirements.index') }}"
                                                                                    class="inline-flex gap-2 px-4 py-2 text-xs font-semibold text-white transition-all duration-200 bg-green-500 shadow-sm rounded-xl hover:bg-green-600 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-green-200">
                                                                                    <i data-lucide="upload"
                                                                                        class="size-3.5"></i>
                                                                                    Submit Requirements
                                                                                </a>
                                                                            @endif
                                                                        @else
                                                                            <button type="submit"
                                                                                class="inline-flex gap-2 px-4 py-2 text-xs font-semibold text-white transition-all duration-200 bg-green-500 shadow-sm rounded-xl hover:bg-green-600 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-green-200">
                                                                                <i data-lucide="thumbs-up"
                                                                                    class="size-3.5"></i>
                                                                                Confirm
                                                                            </button>
                                                                        @endif
                                                                    @else
                                                                        <span
                                                                            class="inline-flex gap-2 px-4 py-2 ml-auto text-xs font-semibold text-green-700 bg-green-100 rounded-xl dark:bg-green-500/20 dark:text-green-500">
                                                                            <i data-lucide="check-circle"
                                                                                class="size-3.5"></i>
                                                                            Confirmed for Enrollment
                                                                        </span>
                                                                    @endif
                                                                @else
                                                                    <span
                                                                        class="inline-flex gap-2 px-4 py-2 text-xs font-semibold text-red-600 bg-red-100 rounded-xl dark:bg-red-500/20 dark:text-red-500">
                                                                        <i data-lucide="x-circle" class="size-3.5"></i>
                                                                        No more slots available
                                                                    </span>
                                                                @endif
                                                            </td>

                                                            {{-- PROGRAM --}}
                                                            <td class="px-4 py-4">
                                                                <div class="flex flex-col">
                                                                    <span
                                                                        class="font-semibold text-slate-800 dark:text-white">
                                                                        {{ $programData['programName'] }}
                                                                    </span>
                                                                    <span class="text-sm text-slate-500 dark:text-zink-300">
                                                                        {{ $programData['majorDiscDesc'] }}
                                                                    </span>
                                                                </div>
                                                            </td>

                                                            {{-- CAMPUS --}}
                                                            <td class="px-4 py-4">
                                                                <div class="flex flex-col">
                                                                    <span
                                                                        class="font-medium text-slate-800 dark:text-white">
                                                                        {{ $programData['campusName'] }}
                                                                    </span>
                                                                    <span class="text-sm text-slate-500 dark:text-zink-300">
                                                                        {{ $programData['collegeName'] }}
                                                                    </span>
                                                                </div>
                                                            </td>

                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @else
                                <h2>Program is not yet offered.</h2>
                            @endif
                        @else
                            {{-- check the date range for second batch qualifiers --}}
                            @if (now()->between($start, $end))

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
                                                <h6
                                                    class="mb-2 text-base font-bold tracking-tight text-slate-800 dark:text-white">
                                                    Important Reminder
                                                </h6>

                                                <div class="space-y-2 text-sm text-slate-600 dark:text-zink-200">
                                                    <p>
                                                        Below are the details of your selected program. Please note that
                                                        <span class="font-semibold text-sky-700 dark:text-sky-300">admission
                                                            is not automatic</span>,
                                                        as all qualifiers will still undergo a ranking process.
                                                    </p>

                                                    <p>
                                                        Narito ang detalye ng iyong napiling program. Pakatandaan na
                                                        <span class="font-semibold text-sky-700 dark:text-sky-300">
                                                            hindi awtomatikong ibibigay ang napili mong program
                                                        </span>
                                                        sapagkat lahat ng kwalipikado ay daraan sa proseso ng ranggohan
                                                        (ranking).
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Premium Two-Column Layout --}}
                                    <div class="grid grid-cols-1 gap-5 xl:grid-cols-12">
                                        {{-- Left: Summary Card --}}
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
                                                            <h6
                                                                class="text-lg font-bold tracking-tight text-slate-800 dark:text-white">
                                                                {{ $cee_profile->first_name }}
                                                                {{ $cee_profile->middle_initial }}
                                                                {{ $cee_profile->last_name }}
                                                                {{ $cee_profile->ext_name }}
                                                            </h6>
                                                            <p class="mt-1 text-sm text-slate-500 dark:text-zink-300">
                                                                {{ $cee_profile->email }}
                                                            </p>
                                                        </div>

                                                        <div class="shrink-0">
                                                            <span
                                                                class="inline-flex items-center px-3 py-1 text-xs font-semibold rounded-full bg-sky-100 text-sky-700 dark:bg-sky-500/20 dark:text-sky-500">
                                                                Program Summary
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- Program Details --}}
                                                <div class="p-5">
                                                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                                        <div
                                                            class="p-4 border rounded-2xl bg-slate-50 border-slate-200 dark:bg-zink-700/30 dark:border-zink-600">
                                                            <p
                                                                class="mb-1 text-xs font-semibold tracking-wide uppercase text-slate-400 dark:text-zink-400">
                                                                Program Selected
                                                            </p>
                                                            <h6
                                                                class="text-sm font-semibold leading-6 text-slate-800 dark:text-white">
                                                                {{ $programDataBatch2['programName'] }} -
                                                                {{ $programDataBatch2['majorDiscDesc'] }}
                                                            </h6>
                                                        </div>

                                                        <div
                                                            class="p-4 border rounded-2xl bg-slate-50 border-slate-200 dark:bg-zink-700/30 dark:border-zink-600">
                                                            <p
                                                                class="mb-1 text-xs font-semibold tracking-wide uppercase text-slate-400 dark:text-zink-400">
                                                                Campus and College
                                                            </p>
                                                            <h6
                                                                class="text-sm font-semibold leading-6 text-slate-800 dark:text-white">
                                                                {{ $programDataBatch2['realCampus'] }} -
                                                                {{ $programDataBatch2['collegeName'] }}
                                                            </h6>
                                                        </div>

                                                        <div
                                                            class="p-4 border rounded-2xl bg-slate-50 border-slate-200 dark:bg-zink-700/30 dark:border-zink-600 md:col-span-2">
                                                            <p
                                                                class="mb-1 text-xs font-semibold tracking-wide uppercase text-slate-400 dark:text-zink-400">
                                                                Date and Time of Selection
                                                            </p>
                                                            <h6
                                                                class="text-sm font-semibold leading-6 text-slate-800 dark:text-white">
                                                                {{ \Carbon\Carbon::parse($cee_profile->date_program_selected)->format('F j, Y g:i A') }}
                                                            </h6>
                                                        </div>
                                                    </div>

                                                    {{-- Status Block --}}
                                                    <div class="mt-5">
                                                        <div
                                                            class="p-4 border rounded-2xl bg-slate-50 border-slate-200 dark:bg-zink-700/30 dark:border-zink-600">
                                                            <p
                                                                class="mb-2 text-xs font-semibold tracking-wide uppercase text-slate-400 dark:text-zink-400">
                                                                Current Status
                                                            </p>

                                                            <div class="space-y-3">
                                                                @if ($cee_profile->prereg_status == 'for_ranking' && $cee_profile->campus_id == null)
                                                                    <span
                                                                        class="inline-flex items-center px-3 py-1 text-xs font-semibold text-yellow-700 bg-yellow-100 rounded-full dark:bg-yellow-500/20 dark:text-yellow-500">
                                                                        Selected
                                                                    </span>

                                                                    <div
                                                                        class="p-3 text-sm leading-6 text-purple-700 border border-purple-200 rounded-xl bg-purple-50 dark:bg-purple-500/10 dark:border-purple-500/20 dark:text-purple-500">
                                                                        Kindly click the <strong>“Confirm Program for
                                                                            Ranking”</strong> button on the right
                                                                        to continue.
                                                                    </div>
                                                                @elseif($cee_profile->prereg_status == 'pending')
                                                                    <span
                                                                        class="inline-flex items-center px-3 py-1 text-xs font-semibold rounded-full bg-emerald-100 text-emerald-700 dark:bg-emerald-500/20 dark:text-emerald-300">
                                                                        Confirmed
                                                                    </span>

                                                                    <div
                                                                        class="p-3 text-sm leading-6 text-purple-700 border border-purple-200 rounded-xl bg-purple-50 dark:bg-purple-500/10 dark:border-purple-500/20 dark:text-purple-500">
                                                                        Please submit the original copies of the required
                                                                        documents to the
                                                                        <b>Admission and Records Office (ARO)</b> as soon as
                                                                        possible. If you have already
                                                                        submitted your documents, kindly disregard this
                                                                        message.
                                                                    </div>
                                                                @elseif($cee_profile->prereg_status == 'cancelled')
                                                                    <span
                                                                        class="inline-flex items-center px-3 py-1 text-xs font-semibold text-red-700 bg-red-100 rounded-full dark:bg-red-500/20 dark:text-red-500">
                                                                        Cancelled
                                                                    </span>
                                                                @elseif($cee_profile->prereg_status == 'denied')
                                                                    <span
                                                                        class="inline-flex items-center px-3 py-1 text-xs font-semibold text-red-700 bg-red-100 rounded-full dark:bg-red-500/20 dark:text-red-500">
                                                                        Denied
                                                                    </span>
                                                                @elseif($cee_profile->prereg_status == 'enrolled')
                                                                    <span
                                                                        class="inline-flex items-center px-3 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded-full dark:bg-green-500/20 dark:text-green-500">
                                                                        You are officially enrolled!
                                                                    </span>

                                                                    <div
                                                                        class="p-3 text-sm leading-6 text-purple-700 border border-purple-200 rounded-xl bg-purple-50 dark:bg-purple-500/10 dark:border-purple-500/20 dark:text-purple-500">
                                                                        Tap the <b>Pre-registration Menu</b>, then tap the
                                                                        <b>View Certificate of Registration</b> button to
                                                                        get your Certificate of
                                                                        Registration.
                                                                    </div>
                                                                @else
                                                                    <span
                                                                        class="text-sm text-slate-400 dark:text-zink-400">---</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Right: Action Panel --}}
                                        <div class="xl:col-span-4">
                                            <div class="sticky top-[calc(theme('spacing.header')_*_1.3)]">
                                                <div
                                                    class="overflow-hidden bg-white border shadow-sm rounded-2xl border-slate-200 dark:border-zink-600 dark:bg-zink-800">
                                                    <div class="p-5 border-b border-slate-200 dark:border-zink-600">
                                                        <p
                                                            class="mb-1 text-[11px] font-semibold tracking-[0.16em] uppercase text-green-500">
                                                            Final Action
                                                        </p>
                                                        <h6
                                                            class="text-lg font-bold tracking-tight text-slate-800 dark:text-white">
                                                            Confirm for Ranking
                                                        </h6>
                                                        <p
                                                            class="mt-2 text-sm leading-6 text-slate-500 dark:text-zink-300">
                                                            You have reached the final step of the pre-registration process.
                                                        </p>
                                                    </div>

                                                    <div class="p-5 space-y-4">
                                                        <div
                                                            class="p-4 border rounded-2xl bg-slate-50 border-slate-200 dark:bg-zink-700/30 dark:border-zink-600">
                                                            <h6
                                                                class="mb-2 text-sm font-semibold text-slate-800 dark:text-white">
                                                                What happens next?
                                                            </h6>
                                                            <ul
                                                                class="space-y-2 text-sm text-slate-600 dark:text-zink-300">
                                                                <li class="flex gap-2">
                                                                    <i data-lucide="check"
                                                                        class="mt-1 text-green-500 size-4 shrink-0"></i>
                                                                    <span>Your selected program will be included in ranking
                                                                        evaluation.</span>
                                                                </li>
                                                                <li class="flex gap-2">
                                                                    <i data-lucide="check"
                                                                        class="mt-1 text-green-500 size-4 shrink-0"></i>
                                                                    <span>Admission is subject to available slots and
                                                                        ranking results.</span>
                                                                </li>
                                                                <li class="flex gap-2">
                                                                    <i data-lucide="check"
                                                                        class="mt-1 text-green-500 size-4 shrink-0"></i>
                                                                    <span>Please review your selected program details before
                                                                        confirming.</span>
                                                                </li>
                                                            </ul>
                                                        </div>

                                                        <div
                                                            class="p-4 border rounded-2xl bg-amber-50 border-amber-200 text-amber-700 dark:bg-amber-500/10 dark:border-amber-500/20 dark:text-amber-500">
                                                            <div class="flex gap-2">
                                                                <i data-lucide="shield-alert"
                                                                    class="mt-0.5 size-4 shrink-0"></i>
                                                                <p class="text-sm">
                                                                    Once confirmed, your selected program will proceed to
                                                                    ranking evaluation.
                                                                </p>
                                                            </div>
                                                        </div>

                                                        <button data-program="{{ $cee_profile['policyId'] }}"
                                                            class="inline-flex items-center justify-center w-full gap-2 px-5 py-3 text-sm font-semibold text-white transition-all duration-200 bg-green-500 shadow-sm rounded-xl confirmProgramforRankingBtn hover:bg-green-600 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-green-200">
                                                            <i data-lucide="check" class="size-4"></i>
                                                            Confirm Program for Ranking
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @elseif($has_policy_id == 0)
                                    <p class="text-slate-800">
                                        Oops! It seems that you have not confirmed your program yet. Please select your
                                        program by
                                        clicking or tapping the button below
                                        <br>

                                        <a href="{{ route('student.cee.result') }}"
                                            class="mt-4 text-white bg-green-500 border-green-500 btn hover:text-white hover:bg-green-600 hover:border-green-600 focus:text-white focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-100 active:text-white active:bg-green-600 active:border-green-600 active:ring active:ring-green-100 dark:ring-green-400/10">
                                            <i data-lucide="s" class="inline-block size-4 dark:text-zink-200"></i>Result
                                        </a>
                                    </p>
                                @endif
                            @else
                                <p class="mt-4 mb-4">Dear {{ $cee_profile->first_name }}
                                    {{ $cee_profile->middle_name }}
                                    {{ $cee_profile->last_name }}
                                    {{ $cee_profile->ext_name }},</p>

                                <p class="text-slate-800">Thank you for your interest in the University of Southern
                                    Mindanao. <b> We regret to inform you that you did not qualify for your first priority
                                        program </b>, <b class="text-custom-500">{{ $programData['programName'] }}
                                        {{ $programData['majorDiscDesc'] }}</b>, at the University of Southern
                                    Mindanao!

                                    <br><br>
                                    We understand that this may be disappointing. However, we would like to offer you the
                                    opportunity to explore other programs at USM that may be a good fit for your interests
                                    and qualifications.

                                    <br><br>
                                    On April 26, 2025 to April 29, 2025, we will be sending you a list of other available
                                    programs that you
                                    may consider for enrollment.
                                    <br><br>
                                    We encourage you to review this list carefully. We are committed to helping you find the
                                    right academic path at the University of Southern Mindanao.

                                </p>

                                <div class="grid grid-cols-1 mt-10 2xl:grid-cols-12">
                                    <div class="2xl:col-span-5">
                                        <p class="mb-5 text-slate-500 dark:text-zink-200">Sincerely,</p>
                                        <p class="mb-2 uppercase text-slate-800 dark:text-zink-200"> <b> LEORENCE C. TANDOG
                                            </b></p>
                                        <p class="text-slate-500 dark:text-zink-200">Vice President for Academic Affairs
                                        </p>
                                        <p class="text-slate-500 dark:text-zink-200">University of Southern Mindanao</p>
                                    </div>


                                    <div class="self-end mt-10 text-center 2xl:col-span-2 2xl:col-start-11">
                                        <hr class="mb-5 border-t-2 border-slate-200 dark:border-zink-700">
                                        <img src="{{ asset('backend/assets/images/logo-dark.png') }}" alt=""
                                            class="h-12 mx-auto">
                                        <h6>University of Southern Mindanao</h6>
                                    </div>
                                </div>
                            @endif
                        @endif

                    </div>
                    {{-- end card-body --}}
                </div>
            @else
                <h1>Please complete and publish your profile and requirements. </h1>
            @endif
        </div>

    </div>
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- swal confirm first batch --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("publishButton").addEventListener("click", function(event) {
                event.preventDefault();

                const programPolicyId = document.querySelector('input[name="program_policy_id"]').value;

                Swal.fire({
                    title: "Are you sure?",
                    text: "Submitting this will save your intent to pre-register for the program shown. Please ensure that all details are correct before proceeding. Once your intent is submitted, you will not be able to revert it",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, I confirm!",
                    cancelButtonText: "Cancel"
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch("{{ route('student.program-confirmation.comfirm') }}", {
                                method: "POST",
                                headers: {
                                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                                    "Content-Type": "application/json"
                                },
                                body: JSON.stringify({
                                    program_policy_id: programPolicyId
                                })
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    Swal.fire("Success!",
                                        "You have successfully pre-registered for your chosen program. Always monitor the progress of your enrollment through the Pre-registration Dashboard.",
                                        "success"
                                    ).then(() => location.reload());
                                } else {
                                    Swal.fire("Error!", data.message, "error");
                                }
                            })
                            .catch(error => {
                                Swal.fire("Error!",
                                    "Something went wrong. Please try again or contact the system administrator",
                                    "error");
                            });
                    }
                });
            });
        });
    </script>

    {{-- swal confirm second batch --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll(".confirmProgramforRankingBtn").forEach(button => {
                button.addEventListener("click", function(event) {
                    event.preventDefault();

                    const programPolicyId = this.getAttribute("data-program");

                    Swal.fire({
                        title: "Are you sure?",
                        //     html: `You're about to confirm the program with <strong>Policy ID: ${programPolicyId}</strong>.<br>
                    // Submitting this form will confirm your intent to pre-register for the program.`,
                        text: "Submitting this form will confirm your intent to pre-register for the program you have selected for ranking. Once submitted, your intent cannot be changed or withdrawn.",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Yes, I confirm!",
                        cancelButtonText: "Cancel"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            fetch("{{ route('student.confirm-program-ranking.second-batch') }}", {
                                    method: "POST",
                                    headers: {
                                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                                        "Content-Type": "application/json"
                                    },
                                    body: JSON.stringify({
                                        program_policy_id: programPolicyId
                                    })
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        Swal.fire(
                                            "Success!",
                                            "You have successfully pre-registered for your chosen program for ranking. Always monitor the progress of your enrollment through the Pre-registration Dashboard.",
                                            "success"
                                        ).then(() => {
                                            window.location.href =
                                                "{{ route('student.confirm-program-ranking.second-batch.index') }}";
                                        });
                                    } else {
                                        Swal.fire("Error!", data.message, "error");
                                    }
                                })
                                .catch(error => {
                                    Swal.fire("Error!",
                                        "Something went wrong. Please try again or contact the system administrator",
                                        "error");
                                });
                        }
                    });
                });
            });
        });
    </script>
@endpush
