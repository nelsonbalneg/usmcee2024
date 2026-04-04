@extends('student.layouts.master')
@section('title')
    USM-CEE | Result
@endsection
@php
    use Carbon\Carbon;
    $start = Carbon::parse($site_settings->start_prereg_second_batch);
    $end = Carbon::parse($site_settings->end_prereg_second_batch);

    $start_batch_1 = Carbon::parse($site_settings->start_prereg);
    $end_batch_1 = Carbon::parse($site_settings->end_prereg);
@endphp



@section('contents')

    <x-page-header title="USMCEE 4.0 | Preregistration" :breadcrumbs="[['label' => 'Home', 'url' => route('dashboard')], ['label' => 'CEE Result']]" />


    @if (optional($cee_result))
        <div class="grid grid-cols-1 2xl:grid-cols-12">
            <div class="relative card 2xl:col-span-12">
                <div class="p-6 md:p-8 max-w-[1400px] mx-auto">
                    <div class="text-center">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-[11px] font-semibold tracking-[0.25em] uppercase text-custom-500">
                                    Examination Result
                                </p>
                                <h5 class="mt-1 text-xl font-bold text-slate-800 dark:text-white">
                                    USM-CEE RESULT
                                </h5>
                            </div>

                            <span
                                class="px-3 py-1 text-xs font-semibold rounded-full bg-sky-100 text-sky-700 dark:bg-sky-500/20 dark:text-sky-500">
                                Official
                            </span>
                        </div>
                    </div>
                    <div class="mt-10 overflow-x-auto">
                        @if ($cee_result->csa < $ceeActiveession->min_csa)

                            <div class="max-w-3xl space-y-4">

                                <p class="text-[11px] font-semibold tracking-[0.25em] uppercase text-rose-500">
                                    Result Update
                                </p>

                                <h4 class="text-xl font-bold tracking-tight text-slate-800 dark:text-white">
                                    Update on Your USMCEE Result
                                </h4>

                                <p class="text-sm leading-7 text-slate-600 dark:text-zink-300">
                                    Dear {{ $cee_result->firstname }}
                                    {{ $cee_result->middlename ? strtoupper(substr($cee_result->middlename, 0, 1)) . '.' : '' }}
                                    {{ $cee_result->lastname }}
                                    {{ $cee_result->suffix }},
                                </p>

                                <div class="space-y-4 text-sm leading-7 text-slate-600 dark:text-zink-300">
                                    <p>
                                        Thank you for your interest in joining the
                                        <span class="font-semibold text-slate-800 dark:text-white">
                                            University of Southern Mindanao
                                        </span>.
                                    </p>

                                    <p>
                                        We truly admire your determination to pursue a college education. While we regret to
                                        inform you
                                        that you were not able to secure admission at this time, we encourage you to
                                        continue exploring
                                        opportunities in other institutions where you can further develop your potential.
                                    </p>

                                    <p class="font-medium text-slate-700 dark:text-zink-100">
                                        We sincerely wish you success in your academic journey and future endeavors.
                                    </p>
                                </div>

                            </div>
                        @elseif($cee_result->csa >= $ceeActiveession->min_csa)
                            @if ($is_qualified_pre_reg == 1 && !now()->between($start, $end))

                                {{-- add if student is enrolled in first priority --}}
                                {{-- @if ($cee_profile->prereg_status == 'pending' || $cee_profile->prereg_status == 'enrolled') --}}
                                {{-- @if ($cee_profile && ($cee_profile->prereg_status === 'pending' || $cee_profile->prereg_status === 'enrolled')) --}}
                                @if (
                                    $cee_profile &&
                                        $ceeActiveession &&
                                        $cee_profile->preregistration_id == $ceeActiveession->id &&
                                        ($cee_profile->prereg_status === 'pending' || $cee_profile->prereg_status === 'enrolled'))
                                    <p class="text-slate-800">
                                        Congratulations! You have successfully preregistered for your first priority
                                        program at the University of Southern Mindanao!
                                    </p>
                                    <br>

                                    <div class="flex flex-col gap-3">
                                        <div class="border rounded-md border-slate-200 dark:border-zink-500">
                                            <div class="flex flex-wrap items-center gap-3 p-2">
                                                <div class="rounded-full size-10 shrink-0">
                                                    <img src="{{ asset(Auth::user()->photo) }}" alt=""
                                                        class="h-10 rounded-full">
                                                </div>
                                                <div class="grow">
                                                    <h6 class="mb-1">
                                                        <a href="#!">
                                                            {{ $cee_result->firstname }}
                                                            {{ $cee_result->middlename ? strtoupper(substr($cee_result->middlename, 0, 1)) . '.' : '' }}
                                                            {{ $cee_result->lastname }}
                                                            {{ $cee_result->suffix }}
                                                        </a>
                                                    </h6>
                                                    <p class="text-slate-500 dark:text-zink-200">{{ $cee_result->email }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="p-2 border-t border-slate-200 dark:border-zink-500">
                                                <div class="flex flex-col gap-3">
                                                    <p class="text-slate-500 dark:text-zink-200 shrink-0">
                                                        <b>Program Selected: </b><br>
                                                        <span class="align-middle">
                                                            {{ $programDataBatch2['programName'] ?? '---' }} -
                                                            {{ $programDataBatch2['majorDiscDesc'] ?? '---' }}
                                                        </span>
                                                    </p>

                                                    <p class="text-slate-500 dark:text-zink-200 shrink-0">
                                                        <b>Campus and College: </b><br>
                                                        <span class="align-middle">
                                                            {{ $programDataBatch2['realCampus'] ?? '---' }} -
                                                            {{ $programDataBatch2['collegeName'] ?? '---' }}
                                                        </span>
                                                    </p>

                                                    <p class="text-slate-500 dark:text-zink-200 shrink-0">
                                                        <b>Date and Time: </b><br>
                                                        <span class="align-middle">
                                                            {{ $cee_profile->date_program_selected ? \Carbon\Carbon::parse($cee_profile->date_program_selected)->format('F j, Y g:i A') : '---' }}
                                                        </span>
                                                    </p>

                                                    <p class="text-slate-500 dark:text-zink-200 shrink-0">
                                                        <b>Status:</b><br>
                                                        <span class="align-middle">
                                                            @if ($cee_profile->prereg_status == 'for_ranking')
                                                                <span
                                                                    class="px-2.5 py-0.5 inline-block text-[11px] font-medium rounded border bg-yellow-100 border-transparent text-yellow-500 dark:bg-yellow-500/20 dark:border-transparent">
                                                                    Selected
                                                                </span>
                                                            @elseif($cee_profile->prereg_status == 'pending' && $cee_profile->status_id == null)
                                                                <span
                                                                    class="px-2.5 py-0.5 inline-block text-[11px] font-medium rounded border bg-custom-100 border-transparent text-custom-500 dark:bg-custom-500/20 dark:border-transparent">
                                                                    Confirmed
                                                                </span>
                                                            @elseif($cee_profile->prereg_status == 'cancelled')
                                                                <span
                                                                    class="px-2.5 py-0.5 inline-block text-[11px] font-medium rounded border bg-red-100 border-transparent text-red-500 dark:bg-red-500/20 dark:border-transparent">
                                                                    Cancelled
                                                                </span>
                                                            @elseif($cee_profile->prereg_status == 'denied')
                                                                <span
                                                                    class="px-2.5 py-0.5 inline-block text-[11px] font-medium rounded border bg-red-100 border-transparent text-red-500 dark:bg-red-500/20 dark:border-transparent">
                                                                    Denied
                                                                </span>
                                                            @elseif($cee_profile->prereg_status == 'enrolled' || $cee_profile->status_id == 1)
                                                                <span
                                                                    class="mb-2 px-2.5 py-0.5 inline-block text-[11px] font-medium rounded border bg-green-100 border-transparent text-green-500 dark:bg-green-500/20 dark:border-transparent">
                                                                    You are officially enrolled!
                                                                </span>
                                                                <span
                                                                    class="inline-block px-2.5 py-0.5 text-[11px] font-medium rounded bg-purple-100 text-purple-600 dark:bg-purple-500/20">
                                                                    Tap the <b class="text-purple-600">Pre-registration
                                                                        Menu</b>, then tap the
                                                                    <b class="text-purple-600">View Certificate of
                                                                        Registration</b> button to get your
                                                                    Certificate of Registration.
                                                                </span>
                                                            @else
                                                                ---
                                                            @endif
                                                        </span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @elseif(now()->between($start_batch_1, $end_batch_1) || now()->between($start, $end))
                                    <h4>You Qualified for Your Priority Program at USM!</h4>

                                    <p class="mt-4 mb-4">
                                        Dear {{ $cee_result->firstname }}
                                        {{ $cee_result->middlename ? strtoupper(substr($cee_result->middlename, 0, 1)) . '.' : '' }}
                                        {{ $cee_result->lastname }}
                                        {{ $cee_result->suffix }},
                                    </p>

                                    <p class="mb-4">Congratulations!</p>
                                    <p class="text-slate-800">
                                        Based on your USM College Entrance Examination (USMCEE) result, you have qualified
                                        for admission to the program:
                                        <b class="text-custom-500">
                                            {{ $programResponse['programName'] ?? '---' }}
                                            {{ $programResponse['majorDiscDesc'] ?? '' }} -
                                            {{ $programResponse['realCampus'] ?? '' }}
                                        </b>.
                                        Please confirm your chosen program by clicking the Confirm button below on or before
                                        March 24, 2026.
                                        <br><br>

                                        <a href="{{ route('student.prereg.index') }}"
                                            class="mt-2 text-white bg-green-500 border-green-500 btn hover:text-white hover:bg-green-600 hover:border-green-600 focus:text-white focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-100 active:text-white active:bg-green-600 active:border-green-600 active:ring active:ring-green-100 dark:ring-green-400/10">
                                            <i data-lucide="thumbs-up" class="inline-block size-4 dark:text-zink-200"></i>
                                            Confirm
                                        </a>


                                        <hr class="mt-4 border-t-2 border-slate-200 dark:border-zink-700">
                                    <h5 class="self-end mt-5">Other Programs You May Qualify For
                                    </h5>
                                    <p class="mt-4"> If you prefer to enroll in any of these programs, <b> wait until
                                            March 25, 2026
                                            for slot confirmation</b>. <br><br>
                                        Please note that admission is not guaranteed, as acceptance will still be based on
                                        ranking and the availability of slots.</p><br>
                                    @if (isset($qualifiedCampuses['qualifiedCampuses']) && !empty($qualifiedCampuses['qualifiedCampuses']))
                                        <div class="overflow-x-auto">
                                            @foreach ($qualifiedCampuses['qualifiedCampuses'] as $campus)
                                                <div class="w-full mb-2 whitespace-nowrap">
                                                    <h5
                                                        class="p-2 text-left text-green-500 bg-green-100 dark:bg-zink-600 dark:text-zink-200">
                                                        @if (!empty($campus['qualifiedPrograms']))
                                                            {{ $campus['qualifiedPrograms'][0]['realCampus'] }}
                                                        @else
                                                            {{ $campus['campusName'] }}
                                                        @endif
                                                    </h5>

                                                    <div class="overflow-x-auto">
                                                        <table class="w-full whitespace-nowrap">
                                                            <thead
                                                                class="text-left bg-slate-100 text-slate-500 dark:bg-zink-600 dark:text-zink-200">
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($campus['qualifiedPrograms'] as $program)
                                                                    <tr
                                                                        class="even:bg-slate-50 hover:bg-slate-50 even:hover:bg-slate-100 dark:even:bg-zink-600/50 dark:hover:bg-zink-600 dark:even:hover:bg-zink-600">
                                                                        <td
                                                                            class="px-2 py-1 border-y border-slate-200 dark:border-zink-500">
                                                                            {{ $program['program'] }}{{ !empty($program['major']) ? ' - ' . $program['major'] : '' }}
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <div class="alert alert-info">
                                            No qualified programs found.
                                        </div>
                                    @endif
                                @else
                                    <p class="mt-4 mb-4">
                                        Dear {{ $cee_result->firstname }}
                                        {{ $cee_result->middlename ? strtoupper(substr($cee_result->middlename, 0, 1)) . '.' : '' }}
                                        {{ $cee_result->lastname }}
                                        {{ $cee_result->suffix }},
                                    </p>
                                    <p class="text-slate-800">
                                        Please be informed that the Preregistration has ended.
                                        <br><br>
                                    </p>
                                @endif
                                {{-- end if --}}
                            @else
                                @if (($is_qualified_pre_reg == 1 || $is_qualified_pre_reg == 0) && now()->between($start, $end))

                                    {{-- start --}}
                                    @if ($has_policy_id == 0)
                                        <div class="max-w-6xl mx-auto space-y-5">

                                            {{-- Intro / Eligibility Notice --}}
                                            <div
                                                class="p-6 border shadow-sm rounded-3xl border-sky-200 bg-sky-50 dark:border-sky-500/20 dark:bg-sky-500/10">
                                                <div class="flex items-start gap-4">
                                                    <div
                                                        class="flex items-center justify-center rounded-2xl size-12 bg-sky-100 text-sky-600 dark:bg-sky-500/20 dark:text-sky-300 shrink-0">
                                                        <i data-lucide="sparkles" class="size-6"></i>
                                                    </div>

                                                    <div class="min-w-0">
                                                        <p
                                                            class="mb-1 text-[11px] font-semibold tracking-[0.18em] uppercase text-sky-500">
                                                            Program Selection
                                                        </p>
                                                        <h4
                                                            class="text-xl font-bold tracking-tight text-slate-800 dark:text-white">
                                                            Choose Your Preferred Program
                                                        </h4>

                                                        <p class="mt-4 text-sm leading-7 text-slate-600 dark:text-zink-300">
                                                            Dear {{ $cee_result->firstname }}
                                                            {{ $cee_result->middlename ? strtoupper(substr($cee_result->middlename, 0, 1)) . '.' : '' }}
                                                            {{ $cee_result->lastname }}
                                                            {{ $cee_result->suffix }},
                                                        </p>

                                                        <div
                                                            class="mt-4 space-y-4 text-sm leading-7 text-slate-600 dark:text-zink-300">
                                                            @if ($cee_profile && $cee_profile->policyId == null && $cee_profile->programName != null)
                                                                <div
                                                                    class="p-4 border rounded-2xl border-amber-200 bg-amber-50 text-amber-700 dark:border-amber-500/20 dark:bg-amber-500/10 dark:text-amber-300">
                                                                    Thank you for choosing
                                                                    <span class="font-semibold">
                                                                        {{ $cee_profile->programName }}
                                                                        {{ $cee_profile->majorDiscDesc }}
                                                                    </span>.
                                                                    While we truly appreciate your interest, the available
                                                                    slots for this program are limited
                                                                    and selection is based on ranking. At this time, you
                                                                    were not able to secure a slot.
                                                                    You may still choose another program from the available
                                                                    options.
                                                                </div>
                                                            @endif

                                                            <p>
                                                                You passed the <b class="text-green-500">USM College
                                                                    Entrance Examination (USMCEE)</b>.
                                                                Admission to programs is subject to ranking and the
                                                                availability of slots.
                                                                Please select your preferred program from the list below.
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Qualified Programs by Campus --}}
                                            @if (isset($qualifiedCampuses['qualifiedCampuses']) && !empty($qualifiedCampuses['qualifiedCampuses']))
                                                <div class="space-y-4">
                                                    @foreach ($qualifiedCampuses['qualifiedCampuses'] as $campus)
                                                        <div
                                                            class="overflow-hidden bg-white border shadow-sm rounded-2xl border-slate-200 dark:border-zink-600 dark:bg-zink-800">

                                                            {{-- Campus Header --}}
                                                            <div
                                                                class="px-4 py-3 border-b border-slate-200 bg-slate-50 dark:border-zink-600 dark:bg-zink-700/40">
                                                                <div class="flex items-center gap-3">
                                                                    <div
                                                                        class="flex items-center justify-center text-green-600 bg-green-100 rounded-xl size-10 dark:bg-green-500/20 dark:text-green-300 shrink-0">
                                                                        <i data-lucide="building-2" class="size-4"></i>
                                                                    </div>

                                                                    <div>
                                                                        <p
                                                                            class="text-xs font-semibold tracking-wide uppercase text-slate-400 dark:text-zink-400">
                                                                            Campus
                                                                        </p>
                                                                        <h6
                                                                            class="font-semibold text-slate-800 dark:text-white">
                                                                            @if (!empty($campus['qualifiedPrograms']))
                                                                                {{ $campus['qualifiedPrograms'][0]['realCampus'] }}
                                                                            @else
                                                                                {{ $campus['campusName'] }}
                                                                            @endif
                                                                        </h6>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            {{-- Program Table --}}
                                                            <div class="overflow-x-auto">
                                                                <table class="w-full min-w-[680px]">
                                                                    <thead class="bg-white dark:bg-zink-800">
                                                                        <tr>
                                                                            <th
                                                                                class="px-4 py-3 text-xs font-semibold tracking-wide text-left uppercase text-slate-500 dark:text-zink-300">
                                                                                Action
                                                                            </th>
                                                                            <th
                                                                                class="px-4 py-3 text-xs font-semibold tracking-wide text-left uppercase text-slate-500 dark:text-zink-300">
                                                                                Program Name
                                                                            </th>
                                                                        </tr>
                                                                    </thead>

                                                                    <tbody
                                                                        class="divide-y divide-slate-200 dark:divide-zink-600">
                                                                        @foreach ($campus['qualifiedPrograms'] as $program)
                                                                            <tr
                                                                                class="transition-colors duration-200 bg-white hover:bg-slate-50 dark:bg-zink-800 dark:hover:bg-zink-700/30">
                                                                                <td class="px-4 py-3 align-top">
                                                                                    <button
                                                                                        data-program="{{ $program['policyId'] }}"
                                                                                        class="inline-flex items-center gap-2 px-4 py-2 text-xs font-semibold text-white transition-all duration-200 shadow-sm rounded-xl selectProgramBtn bg-custom-500 hover:bg-custom-600 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-custom-200">
                                                                                        <i data-lucide="check"
                                                                                            class="size-3"></i>
                                                                                        Select
                                                                                    </button>
                                                                                </td>

                                                                                <td class="px-4 py-3">
                                                                                    <div class="flex items-start gap-3">
                                                                                        <div
                                                                                            class="flex items-center justify-center rounded-lg size-8 bg-slate-100 text-slate-500 dark:bg-zink-700 dark:text-zink-300 shrink-0">
                                                                                            <i data-lucide="graduation-cap"
                                                                                                class="size-4"></i>
                                                                                        </div>
                                                                                        <span
                                                                                            class="text-sm text-slate-700 dark:text-zink-100">
                                                                                            {{ $program['program'] }}{{ !empty($program['major']) ? ' - ' . $program['major'] : '' }}
                                                                                        </span>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @else
                                                <div
                                                    class="p-4 text-sm border rounded-2xl border-slate-200 bg-slate-50 text-slate-600 dark:border-zink-600 dark:bg-zink-700/30 dark:text-zink-300">
                                                    No qualified programs found.
                                                </div>
                                            @endif
                                        </div>
                                    @elseif($has_policy_id == 1)
                                        {{-- Intro Notice --}}
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
                                                    <p class="text-sm leading-7 text-slate-600 dark:text-zink-200">
                                                        Below are the details of your selected program. Please note that
                                                        admission is not automatic,
                                                        as all qualifiers will undergo a ranking process.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Premium Two-Column Layout --}}
                                        <div class="grid grid-cols-1 gap-5 xl:grid-cols-12">

                                            {{-- Left: Program Summary --}}
                                            <div class="xl:col-span-8">
                                                <div
                                                    class="overflow-hidden bg-white border shadow-sm rounded-2xl border-slate-200 dark:border-zink-600 dark:bg-zink-800">

                                                    {{-- Profile Header --}}
                                                    <div class="p-5 border-b border-slate-200 dark:border-zink-600">
                                                        <div class="flex flex-col gap-4 sm:flex-row sm:items-center">
                                                            <div class="shrink-0">
                                                                <img src="{{ asset(Auth::user()->photo) }}"
                                                                    alt="Profile Photo"
                                                                    class="object-cover border-2 border-white rounded-full shadow-sm size-16 dark:border-zink-700">
                                                            </div>

                                                            <div class="min-w-0 grow">
                                                                <p
                                                                    class="mb-1 text-[11px] font-semibold tracking-[0.16em] uppercase text-slate-400 dark:text-zink-400">
                                                                    Applicant Information
                                                                </p>
                                                                <h6
                                                                    class="text-lg font-bold tracking-tight text-slate-800 dark:text-white">
                                                                    {{ $cee_result->firstname }}
                                                                    {{ $cee_result->middlename ? strtoupper(substr($cee_result->middlename, 0, 1)) . '.' : '' }}
                                                                    {{ $cee_result->lastname }}
                                                                    {{ $cee_result->suffix }}
                                                                </h6>
                                                                <p class="mt-1 text-sm text-slate-500 dark:text-zink-300">
                                                                    {{ $cee_result->email }}
                                                                </p>
                                                            </div>

                                                            <div class="shrink-0">
                                                                <span
                                                                    class="inline-flex items-center px-3 py-1 text-xs font-semibold rounded-full bg-sky-100 text-sky-700 dark:bg-sky-500/20 dark:text-sky-500">
                                                                    Program Selection Summary
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
                                                                    Date and Time
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
                                                                            Kindly finish all the steps to confirm your
                                                                            selected program for ranking.
                                                                        </div>
                                                                    @elseif($cee_profile->prereg_status == 'pending' && $cee_profile->status_id == null)
                                                                        <span
                                                                            class="inline-flex items-center px-3 py-1 text-xs font-semibold uppercase rounded-full bg-sky-100 text-sky-700 dark:bg-sky-500/20 dark:text-sky-500">
                                                                            Confirmed for Enrollment
                                                                        </span>

                                                                        @if ($cee_profile->is_answered_nstp == 1)
                                                                            <div
                                                                                class="p-3 text-sm leading-6 text-green-700 border border-green-200 rounded-xl bg-green-50 dark:bg-green-500/10 dark:border-green-500/20 dark:text-green-500">
                                                                                Please note that enrollment for CWTS or ROTC
                                                                                will take place after the NSTP
                                                                                orientation.
                                                                            </div>
                                                                        @endif

                                                                        @if (is_null($requirements_submitted))
                                                                            <div
                                                                                class="p-3 text-sm text-purple-700 border border-purple-200 rounded-xl bg-purple-50 dark:bg-purple-500/10 dark:border-purple-500/20 dark:text-purple-500">
                                                                                Please submit the original copies of the
                                                                                required documents to the
                                                                                <b>Admission and Records Office (ARO)</b> as
                                                                                soon as possible.
                                                                                If you have already submitted your
                                                                                documents, kindly disregard this message.
                                                                            </div>
                                                                        @else
                                                                            @php
                                                                                $labels = [
                                                                                    'goodmoral' =>
                                                                                        'Good Moral Certificate',
                                                                                    'card' => 'Report Card',
                                                                                    'psa' => 'PSA Birth Certificate',
                                                                                    'hdismissal' =>
                                                                                        'Honorable Dismissal',
                                                                                    'certificatetransfer' =>
                                                                                        'Certificate of Transfer',
                                                                                    'transcript' =>
                                                                                        'Transcript of Records',
                                                                                ];
                                                                            @endphp

                                                                            <div>
                                                                                <p
                                                                                    class="mb-2 text-sm font-medium text-slate-700 dark:text-zink-200">
                                                                                    Submitted Requirement Summary
                                                                                </p>
                                                                                <div class="flex flex-wrap gap-2">
                                                                                    @foreach ($labels as $key => $label)
                                                                                        @if ($requirements_submitted->$key == 1)
                                                                                            <span
                                                                                                class="inline-flex items-center gap-1 px-3 py-1 text-xs font-semibold text-green-700 bg-white border border-green-300 rounded-full dark:bg-zink-700 dark:border-green-700 dark:text-green-500">
                                                                                                <i data-lucide="check"
                                                                                                    class="size-3"></i>
                                                                                                {{ $label }}
                                                                                            </span>
                                                                                        @endif
                                                                                    @endforeach
                                                                                </div>
                                                                            </div>
                                                                        @endif
                                                                    @elseif($cee_profile->prereg_status == 'for_ranking' && $cee_profile->campus_id != null)
                                                                        <span
                                                                            class="inline-flex items-center px-3 py-1 text-xs font-semibold rounded-full bg-sky-100 text-sky-700 dark:bg-sky-500/20 dark:text-sky-500">
                                                                            Confirmed for Ranking
                                                                        </span>
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
                                                                    @elseif($cee_profile->status_id == 0)
                                                                        <span
                                                                            class="inline-flex items-center px-3 py-1 text-xs font-semibold text-orange-700 bg-orange-100 rounded-full dark:bg-orange-500/20 dark:text-orange-500">
                                                                            Enrollment in Progress
                                                                        </span>
                                                                    @elseif($cee_profile->prereg_status == 'enrolled' || $cee_profile->status_id == 1)
                                                                        <span
                                                                            class="inline-flex items-center px-3 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded-full dark:bg-green-500/20 dark:text-green-500">
                                                                            You are officially enrolled!
                                                                        </span>

                                                                        <div
                                                                            class="p-3 text-sm text-purple-700 border border-purple-200 rounded-xl bg-purple-50 dark:bg-purple-500/10 dark:border-purple-500/20 dark:text-purple-500">
                                                                            Tap the <b>Pre-registration Menu</b>, then tap
                                                                            the
                                                                            <b>View Certificate of Registration</b> button
                                                                            to get your Certificate of
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

                                            {{-- Right: Action / Guidance Panel --}}
                                            <div class="xl:col-span-4">
                                                <div class="sticky top-[calc(theme('spacing.header')_*_1.3)]">
                                                    <div
                                                        class="overflow-hidden bg-white border shadow-sm rounded-2xl border-slate-200 dark:border-zink-600 dark:bg-zink-800">
                                                        <div class="p-5 border-b border-slate-200 dark:border-zink-600">
                                                            <p
                                                                class="mb-1 text-[11px] font-semibold tracking-[0.16em] uppercase text-green-500">
                                                                Next Step
                                                            </p>
                                                            <h6
                                                                class="text-lg font-bold tracking-tight text-slate-800 dark:text-white">
                                                                What You Need to Do
                                                            </h6>
                                                            <p class="mt-2 text-sm text-slate-500 dark:text-zink-300">
                                                                Follow the guidance below based on your current program
                                                                status.
                                                            </p>
                                                        </div>

                                                        <div class="p-5 space-y-4">
                                                            <div
                                                                class="p-4 border rounded-2xl bg-slate-50 border-slate-200 dark:bg-zink-700/30 dark:border-zink-600">
                                                                <h6
                                                                    class="mb-2 text-sm font-semibold text-slate-800 dark:text-white">
                                                                    Quick Notes
                                                                </h6>

                                                                <ul
                                                                    class="space-y-2 text-sm text-slate-600 dark:text-zink-300">
                                                                    <li class="flex gap-2">
                                                                        <i data-lucide="check"
                                                                            class="mt-1 text-green-500 size-4 shrink-0"></i>
                                                                        <span>Review your selected program and status
                                                                            carefully.</span>
                                                                    </li>
                                                                    <li class="flex gap-2">
                                                                        <i data-lucide="check"
                                                                            class="mt-1 text-green-500 size-4 shrink-0"></i>
                                                                        <span>Admission depends on ranking, document
                                                                            compliance, and available slots.</span>
                                                                    </li>
                                                                    <li class="flex gap-2">
                                                                        <i data-lucide="check"
                                                                            class="mt-1 text-green-500 size-4 shrink-0"></i>
                                                                        <span>Monitor this panel regularly for your next
                                                                            required action.</span>
                                                                    </li>
                                                                </ul>
                                                            </div>

                                                            @if ($cee_profile->campus_id == null)
                                                                <div
                                                                    class="p-4 border rounded-2xl bg-amber-50 border-amber-200 text-amber-700 dark:bg-amber-500/10 dark:border-amber-500/20 dark:text-amber-500">
                                                                    <div class="flex gap-2">
                                                                        <i data-lucide="user-round-pen"
                                                                            class="mt-0.5 size-4 shrink-0"></i>
                                                                        <p class="text-sm leading-6">
                                                                            Please proceed to profile registration to
                                                                            continue your pre-registration process.
                                                                        </p>
                                                                    </div>
                                                                </div>

                                                                <a href="{{ route('student.applicant-profile.step1.show') }}"
                                                                    class="inline-flex items-center justify-center w-full gap-2 px-5 py-3 text-sm font-semibold text-white transition-all duration-200 bg-green-500 shadow-sm rounded-xl hover:bg-green-600 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-green-200">
                                                                    <i data-lucide="user" class="size-4"></i>
                                                                    Profile Registration
                                                                </a>
                                                            @elseif($cee_profile->prereg_status == 'for_ranking' && $cee_profile->campus_id != null)
                                                                <div
                                                                    class="p-4 border rounded-2xl bg-sky-50 border-sky-200 text-sky-700 dark:bg-sky-500/10 dark:border-sky-500/20 dark:text-sky-500">
                                                                    <div class="flex gap-2">
                                                                        <i data-lucide="loader-circle"
                                                                            class="mt-0.5 size-4 shrink-0"></i>
                                                                        <p class="text-sm leading-6">
                                                                            Your selected program is already confirmed for
                                                                            ranking. Please wait for the next update.
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            @elseif($cee_profile->prereg_status == 'pending' && $cee_profile->status_id == null)
                                                                <div
                                                                    class="p-4 text-purple-700 border border-purple-200 rounded-2xl bg-purple-50 dark:bg-purple-500/10 dark:border-purple-500/20 dark:text-purple-500">
                                                                    <div class="flex gap-2">
                                                                        <i data-lucide="file-check"
                                                                            class="mt-0.5 size-4 shrink-0"></i>
                                                                        <p class="text-sm leading-6">
                                                                            Your program is confirmed for enrollment. Make
                                                                            sure you submit the required original documents.
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            @elseif($cee_profile->prereg_status == 'enrolled' || $cee_profile->status_id == 1)
                                                                <div
                                                                    class="p-4 text-green-700 border border-green-200 rounded-2xl bg-green-50 dark:bg-green-500/10 dark:border-green-500/20 dark:text-green-500">
                                                                    <div class="flex gap-2">
                                                                        <i data-lucide="badge-check"
                                                                            class="mt-0.5 size-4 shrink-0"></i>
                                                                        <p class="text-sm leading-6">
                                                                            Congratulations! You may now access your
                                                                            Certificate of Registration from the
                                                                            Pre-registration menu.
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            @else
                                                                <div
                                                                    class="p-4 border rounded-2xl bg-slate-50 border-slate-200 text-slate-600 dark:bg-zink-700/30 dark:border-zink-600 dark:text-zink-500">
                                                                    <div class="flex gap-2">
                                                                        <i data-lucide="info"
                                                                            class="mt-0.5 size-4 shrink-0"></i>
                                                                        <p class="text-sm leading-6">
                                                                            Please monitor your current status and follow
                                                                            the required next step when available.
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    {{-- end --}}
                                @else
                                    {{-- Message for second batch qualified applicants --}}
                                    <div class="max-w-5xl mx-auto space-y-5">

                                        {{-- Intro Notice --}}
                                        <div
                                            class="p-6 border shadow-sm rounded-3xl border-sky-200 bg-sky-50 dark:border-sky-500/20 dark:bg-sky-500/10">
                                            <div class="flex items-start gap-4">
                                                <div
                                                    class="flex items-center justify-center rounded-2xl size-12 bg-sky-100 text-sky-600 dark:bg-sky-500/20 dark:text-sky-300 shrink-0">
                                                    <i data-lucide="clipboard-check" class="size-6"></i>
                                                </div>

                                                <div class="min-w-0">
                                                    <p
                                                        class="mb-1 text-[11px] font-semibold tracking-[0.18em] uppercase text-sky-500">
                                                        Result Update
                                                    </p>
                                                    <h4
                                                        class="text-xl font-bold tracking-tight text-slate-800 dark:text-white">
                                                        Update on Your USMCEE Result
                                                    </h4>

                                                    <p class="mt-4 text-sm leading-7 text-slate-600 dark:text-zink-300">
                                                        Dear {{ $cee_result->firstname }}
                                                        {{ $cee_result->middlename ? strtoupper(substr($cee_result->middlename, 0, 1)) . '.' : '' }}
                                                        {{ $cee_result->lastname }}
                                                        {{ $cee_result->suffix }},
                                                    </p>

                                                    <div
                                                        class="mt-4 space-y-4 text-sm leading-7 text-slate-600 dark:text-zink-300">
                                                        <p>
                                                            You passed the <b class="text-green-500">USM College Entrance
                                                                Examination (USMCEE)</b>.
                                                        </p>

                                                        <p>
                                                            Admission to programs is subject to ranking and the
                                                            availability
                                                            of slots.
                                                            Please review the programs below that you may still qualify for.
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Qualified Programs by Campus --}}
                                        @if (isset($qualifiedCampuses['qualifiedCampuses']) && !empty($qualifiedCampuses['qualifiedCampuses']))
                                            <div class="space-y-4">
                                                @foreach ($qualifiedCampuses['qualifiedCampuses'] as $campus)
                                                    <div
                                                        class="overflow-hidden bg-white border shadow-sm rounded-2xl border-slate-200 dark:border-zink-600 dark:bg-zink-800">

                                                        {{-- Campus Header --}}
                                                        <div
                                                            class="px-4 py-3 border-b border-slate-200 bg-slate-50 dark:border-zink-600 dark:bg-zink-700/40">
                                                            <div class="flex items-center gap-2">
                                                                <div
                                                                    class="flex items-center justify-center text-green-600 bg-green-100 rounded-xl size-9 dark:bg-green-500/20 dark:text-green-300 shrink-0">
                                                                    <i data-lucide="building-2" class="size-4"></i>
                                                                </div>

                                                                <div>
                                                                    <p
                                                                        class="text-xs font-semibold tracking-wide uppercase text-slate-400 dark:text-zink-400">
                                                                        Campus
                                                                    </p>
                                                                    <h6
                                                                        class="font-semibold text-slate-800 dark:text-white">
                                                                        @if (!empty($campus['qualifiedPrograms']))
                                                                            {{ $campus['qualifiedPrograms'][0]['realCampus'] }}
                                                                        @else
                                                                            {{ $campus['campusName'] }}
                                                                        @endif
                                                                    </h6>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        {{-- Program List --}}
                                                        <div class="overflow-x-auto">
                                                            <table class="w-full">
                                                                <thead class="bg-white dark:bg-zink-800">
                                                                    <tr>
                                                                        <th
                                                                            class="px-4 py-3 text-xs font-semibold tracking-wide text-left uppercase text-slate-500 dark:text-zink-300">
                                                                            Qualified Programs
                                                                        </th>
                                                                    </tr>
                                                                </thead>

                                                                <tbody
                                                                    class="divide-y divide-slate-200 dark:divide-zink-600">
                                                                    @foreach ($campus['qualifiedPrograms'] as $program)
                                                                        <tr class="bg-white dark:bg-zink-800">
                                                                            <td
                                                                                class="px-4 py-3 text-sm text-slate-700 dark:text-zink-100">
                                                                                <div class="flex items-start gap-3">
                                                                                    <div
                                                                                        class="flex items-center justify-center rounded-lg size-8 bg-slate-100 text-slate-500 dark:bg-zink-700 dark:text-zink-300 shrink-0">
                                                                                        <i data-lucide="graduation-cap"
                                                                                            class="size-4"></i>
                                                                                    </div>
                                                                                    <span>
                                                                                        {{ $program['program'] }}{{ !empty($program['major']) ? ' - ' . $program['major'] : '' }}
                                                                                    </span>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <div
                                                class="p-4 text-sm border rounded-2xl border-slate-200 bg-slate-50 text-slate-600 dark:border-zink-600 dark:bg-zink-700/30 dark:text-zink-300">
                                                No qualified programs found.
                                            </div>
                                        @endif
                                    </div>


                                @endif
                            @endif


                        @endif
                    </div>

                    <div class="grid grid-cols-1 mt-10 2xl:grid-cols-12">
                        <div class="self-end mt-10 2xl:col-span-2">
                            <hr class="mb-5 border-t-2 border-slate-200 dark:border-zink-700">
                            <img src="{{ asset('backend/assets/images/logo-dark.png') }}" alt=""
                                class="h-12 mx-auto">
                            {{-- <h6>University of Southern Mindanao</h6> --}}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    @endif
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const buttons = document.querySelectorAll('.selectProgramBtn');

            buttons.forEach(button => {
                button.addEventListener('click', function() {
                    const programPolicyId = this.getAttribute('data-program'); // Get policyId here

                    Swal.fire({
                        title: "Are you sure?",
                        text: `Submitting this will save your intent to preregister in the selected program for ranking`,
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Yes, I confirm!",
                        cancelButtonText: "Cancel"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Use the same programPolicyId inside the .then() block
                            fetch("{{ route('student.ranking.second-batch') }}", {
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
                                                "You have successfully selected the program.",
                                                "success")
                                            .then(() => location.reload());
                                    } else {
                                        Swal.fire("Error!", data.message ||
                                            "Unknown error", "error");
                                    }
                                })
                                .catch(() => {
                                    Swal.fire("Error!",
                                        "Something went wrong. Try again later.",
                                        "error");
                                });
                        }
                    });
                });
            });
        });
    </script>
@endpush
