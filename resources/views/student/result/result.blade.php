@extends('student.layouts.master')
@section('title')
    USM-CEE | Result
@endsection

@section('contents')
    <x-page-header title="USMCEE 4.0 | CEE Result" :breadcrumbs="[['label' => 'Home', 'url' => route('dashboard')], ['label' => 'CEE Result']]" />

    <div class="grid grid-cols-1 2xl:grid-cols-12">
        @if ($cee_result->isNotEmpty())
            <div class="col-span-1 2xl:col-span-12">
                <div
                    class="overflow-hidden bg-white border shadow-sm card rounded-2xl border-slate-200 dark:border-zink-600 dark:bg-zink-800">
                    <div class="p-0 card-body">
                        {{-- Header --}}
                        <div class="px-6 py-5 border-b border-slate-200 dark:border-zink-600">
                            <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
                                <div>
                                    <p class="mb-1 text-[11px] font-semibold tracking-[0.18em] uppercase text-custom-500">
                                        Examination Result
                                    </p>
                                    <h6 class="text-lg font-bold tracking-tight text-slate-800 dark:text-white">
                                        USM-CEE Result of
                                        <span class="text-custom-500">
                                            {{ strtoupper(trim($reservation->lastname . ', ' . $reservation->firstname . ' ' . $reservation->middlename . ' ' . $reservation->suffix)) }}
                                        </span>
                                    </h6>
                                    <p class="mt-1 text-sm text-slate-500 dark:text-zink-300">
                                        View your available CEE result records below.
                                    </p>
                                </div>

                                <div class="shrink-0">
                                    <span
                                        class="inline-flex items-center px-3 py-1 text-xs font-semibold rounded-full bg-sky-100 text-sky-700 dark:bg-sky-500/20 dark:text-sky-300">
                                        {{ $cee_result->count() }} {{ $cee_result->count() > 1 ? 'Results' : 'Result' }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        {{-- Table --}}
                        <div class="p-4 md:p-5">
                            <div class="overflow-hidden border rounded-2xl border-slate-200 dark:border-zink-600">
                                <div class="overflow-x-auto">
                                    <table class="w-full min-w-[700px]">
                                        <thead class="bg-slate-50 dark:bg-zink-700/50">
                                            <tr>
                                                <th
                                                    class="px-4 py-3 text-xs font-semibold tracking-wide text-left uppercase text-slate-500 dark:text-zink-300">
                                                    Action
                                                </th>
                                                <th
                                                    class="px-4 py-3 text-xs font-semibold tracking-wide text-left uppercase text-slate-500 dark:text-zink-300">
                                                    Application No.
                                                </th>
                                                <th
                                                    class="px-4 py-3 text-xs font-semibold tracking-wide text-left uppercase text-slate-500 dark:text-zink-300">
                                                    CEE Term
                                                </th>
                                                <th
                                                    class="px-4 py-3 text-xs font-semibold tracking-wide text-left uppercase text-slate-500 dark:text-zink-300">
                                                    Availability
                                                </th>
                                            </tr>
                                        </thead>

                                        <tbody class="divide-y divide-slate-200 dark:divide-zink-600">
                                            @foreach ($cee_result as $result)
                                                @php
                                                    $isActiveSession = optional($result->cee_term)->status === 'active';
                                                @endphp

                                                <tr
                                                    class="transition-colors duration-200 bg-white hover:bg-slate-50/70 dark:bg-zink-800 dark:hover:bg-zink-700/30">
                                                    <td class="px-4 py-4">
                                                        @if ($isActiveSession)
                                                            <a href="{{ route('student.cee.result-message', ['app_no' => encrypt($result->app_no)]) }}"
                                                                class="inline-flex items-center gap-2 px-4 py-2 text-xs font-semibold text-white transition-all duration-200 bg-green-500 shadow-sm rounded-xl hover:bg-green-600 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-green-200">
                                                                <i data-lucide="eye" class="size-3.5"></i>
                                                                View Result
                                                            </a>
                                                        @else
                                                            <span
                                                                class="inline-flex items-center gap-2 px-4 py-2 text-xs font-semibold cursor-not-allowed rounded-xl bg-slate-100 text-slate-500 dark:bg-slate-500/20 dark:text-slate-400">
                                                                <i data-lucide="lock" class="size-3.5"></i>
                                                                View Disabled
                                                            </span>
                                                        @endif
                                                    </td>

                                                    <td class="px-4 py-4">
                                                        <div class="flex flex-col">
                                                            <span class="font-semibold text-slate-800 dark:text-white">
                                                                {{ $result->app_no }}
                                                            </span>
                                                            <span class="text-xs text-slate-400 dark:text-zink-400">
                                                                Applicant Reference
                                                            </span>
                                                        </div>
                                                    </td>

                                                    <td class="px-4 py-4">
                                                        <div class="flex flex-col">
                                                            <span class="font-medium text-slate-700 dark:text-zink-100">
                                                                {{ $result->cee_term->name ?? 'N/A' }}
                                                            </span>
                                                            <span class="text-xs text-slate-400 dark:text-zink-400">
                                                                Examination Session
                                                            </span>
                                                        </div>
                                                    </td>

                                                    <td class="px-4 py-4">
                                                        @if ($isActiveSession)
                                                            <span
                                                                class="inline-flex items-center gap-1 px-3 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded-full dark:bg-green-500/20 dark:text-green-300">
                                                                <i data-lucide="check-circle-2" class="size-3"></i>
                                                                Available
                                                            </span>
                                                        @else
                                                            <span
                                                                class="inline-flex items-center gap-1 px-3 py-1 text-xs font-semibold rounded-full bg-slate-100 text-slate-600 dark:bg-slate-500/20 dark:text-slate-300">
                                                                <i data-lucide="clock-3" class="size-3"></i>
                                                                Unavailable
                                                            </span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            {{-- Optional helper text --}}
                            <p class="mt-3 text-xs text-slate-400 dark:text-zink-400">
                                Only results from an active CEE term can be opened.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="col-span-1 2xl:col-span-12">
                <div
                    class="overflow-hidden bg-white border shadow-sm rounded-2xl border-slate-200 dark:border-zink-600 dark:bg-zink-800">
                    <div class="p-6">
                        <div class="flex items-start gap-4">
                            <div
                                class="flex items-center justify-center rounded-2xl size-12 bg-sky-100 text-sky-600 dark:bg-sky-500/20 dark:text-sky-300 shrink-0">
                                <i data-lucide="file-search" class="size-5"></i>
                            </div>

                            <div>
                                <p class="mb-1 text-[11px] font-semibold tracking-[0.18em] uppercase text-custom-500">
                                    Examination Result
                                </p>
                                <h6 class="text-lg font-bold tracking-tight text-slate-800 dark:text-white">
                                    No result available yet
                                </h6>
                                <p class="mt-1 text-sm leading-6 text-slate-600 dark:text-zink-300">
                                    Hi! Your USM-CEE result is not available yet. Please check back again later once the
                                    result
                                    has been released.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
