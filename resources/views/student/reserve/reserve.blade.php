@php
    use Carbon\Carbon;
@endphp
@extends('student.layouts.master')
@section('title')
    USMCEE - My Profile
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
@endpush

@section('contents')

    <x-page-header title="USMCEE 4.0 " :breadcrumbs="[['label' => 'Home', 'url' => route('dashboard')], ['label' => 'Reservation']]" />

    <!--start grid-->
    <div class="grid grid-cols-1 gap-x-5 xl:grid-cols-12">
        <!--start col-->
        <div class="xl:col-span-12">
            <!--start card-->
            {{-- <div class="card"> --}}

            <div class="flex flex-col col-span-1 gap-3 card 2xl:col-span-12">
                <div class="card-body">
                    <div
                        class="overflow-hidden bg-white border shadow-sm rounded-2xl border-slate-200 dark:border-zink-600 dark:bg-zink-800">
                        {{-- Header --}}
                        <div class="px-6 py-5 border-b border-slate-200 dark:border-zink-600">
                            <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
                                <div>
                                    <p class="mb-1 text-[11px] font-semibold tracking-[0.18em] uppercase text-custom-500">
                                        Reservation Records
                                    </p>
                                    <h6 class="text-lg font-bold tracking-tight text-slate-800 dark:text-white">
                                        Your USMCEE Reservations
                                    </h6>
                                    <p class="mt-1 text-sm text-slate-500 dark:text-zink-300">
                                        View your reservation history, schedule, venue, and available actions.
                                    </p>
                                </div>

                                <div class="shrink-0">
                                    <span
                                        class="inline-flex items-center px-3 py-1 text-xs font-semibold rounded-full bg-sky-100 text-sky-700 dark:bg-sky-500/20 dark:text-sky-300">
                                        {{ $cee_reservation_records->count() }}
                                        {{ $cee_reservation_records->count() > 1 ? 'Reservations' : 'Reservation' }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        {{-- Table --}}
                        <div class="p-4 md:p-5">
                            <div class="overflow-hidden border rounded-2xl border-slate-200 dark:border-zink-600">
                                <div class="overflow-x-auto">
                                    <table class="w-full min-w-[980px]">
                                        <thead class="bg-slate-50 dark:bg-zink-700/50">
                                            <tr>
                                                <th
                                                    class="px-4 py-3 text-xs font-semibold tracking-wide text-left uppercase text-slate-500 dark:text-zink-300">
                                                    Action
                                                </th>
                                                <th
                                                    class="px-4 py-3 text-xs font-semibold tracking-wide text-left uppercase text-slate-500 dark:text-zink-300">
                                                    Status
                                                </th>
                                                <th
                                                    class="px-4 py-3 text-xs font-semibold tracking-wide text-left uppercase text-slate-500 dark:text-zink-300">
                                                    App #
                                                </th>
                                                <th
                                                    class="px-4 py-3 text-xs font-semibold tracking-wide text-left uppercase text-slate-500 dark:text-zink-300">
                                                    Schedule
                                                </th>
                                                <th
                                                    class="px-4 py-3 text-xs font-semibold tracking-wide text-left uppercase text-slate-500 dark:text-zink-300">
                                                    Venue
                                                </th>
                                                <th
                                                    class="px-4 py-3 text-xs font-semibold tracking-wide text-left uppercase text-slate-500 dark:text-zink-300">
                                                    Date Created
                                                </th>
                                            </tr>
                                        </thead>

                                        <tbody class="divide-y divide-slate-200 dark:divide-zink-600">
                                            @if ($cee_reservation_records->isNotEmpty())
                                                @foreach ($cee_reservation_records as $data)
                                                    @php
                                                        $isActiveSession = $data->session_status === 'active';
                                                    @endphp

                                                    <tr
                                                        class="transition-colors duration-200 bg-white hover:bg-slate-50/70 dark:bg-zink-800 dark:hover:bg-zink-700/30">
                                                        {{-- Action --}}
                                                        <td class="px-4 py-4">
                                                            @if ($data->status === 'cancelled')
                                                                <span
                                                                    class="inline-flex items-center justify-center gap-2 px-4 py-2 text-xs font-semibold cursor-not-allowed rounded-xl bg-slate-100 text-slate-500 dark:bg-slate-500/20 dark:text-slate-400">
                                                                    <i data-lucide="ban" class="size-3.5"></i>
                                                                    Not Available
                                                                </span>
                                                            @elseif ($data->status === 'pending')
                                                                <a href="{{ route('student.cee.exam-slip', ['app_no' => encrypt($data->app_no)]) }}"
                                                                    target="_blank"
                                                                    class="inline-flex items-center justify-center gap-2 px-4 py-2 text-xs font-semibold text-white transition-all duration-200 bg-green-500 shadow-sm rounded-xl hover:bg-green-600 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-green-200">
                                                                    <i data-lucide="file-text" class="size-3.5"></i>
                                                                    CEE Slip
                                                                </a>
                                                            @else
                                                                @if ($isActiveSession)
                                                                    <a href="{{ route('student.cee.result') }}"
                                                                        target="_blank"
                                                                        class="inline-flex items-center justify-center gap-2 px-4 py-2 text-xs font-semibold text-white transition-all duration-200 bg-green-500 shadow-sm rounded-xl hover:bg-green-600 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-green-200">
                                                                        <i data-lucide="eye" class="size-3.5"></i>
                                                                        Result
                                                                    </a>
                                                                @else
                                                                    <span
                                                                        class="inline-flex items-center justify-center gap-2 px-4 py-2 text-xs font-semibold cursor-not-allowed rounded-xl bg-slate-100 text-slate-500 dark:bg-slate-500/20 dark:text-slate-400">
                                                                        <i data-lucide="lock" class="size-3.5"></i>
                                                                        Result Unavailable
                                                                    </span>
                                                                @endif
                                                            @endif
                                                        </td>

                                                        {{-- Status --}}
                                                        <td class="px-4 py-4">
                                                            @if ($data->status === 'pending')
                                                                <span
                                                                    class="inline-flex items-center gap-1 px-3 py-1 text-xs font-semibold text-yellow-700 bg-yellow-100 rounded-full dark:bg-yellow-500/20 dark:text-yellow-500">
                                                                    <i data-lucide="circle-dashed" class="size-3"></i>
                                                                    Reserved
                                                                </span>
                                                            @elseif ($data->status === 'cancelled')
                                                                <span
                                                                    class="inline-flex items-center gap-1 px-3 py-1 text-xs font-semibold text-red-700 bg-red-100 rounded-full dark:bg-red-500/20 dark:text-red-500">
                                                                    <i data-lucide="x-circle" class="size-3"></i>
                                                                    Cancelled
                                                                </span>
                                                            @elseif ($data->status === 'confirmed')
                                                                <span
                                                                    class="inline-flex items-center gap-1 px-3 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded-full dark:bg-green-500/20 dark:text-green-500">
                                                                    <i data-lucide="check-circle-2" class="size-3"></i>
                                                                    Confirmed
                                                                </span>
                                                            @endif
                                                        </td>

                                                        {{-- App Number --}}
                                                        <td class="px-4 py-4">
                                                            <div class="flex flex-col">
                                                                <span class="font-semibold text-slate-800 dark:text-white">
                                                                    {{ $data->app_no }}
                                                                </span>
                                                                <span class="text-xs text-slate-400 dark:text-zink-400">
                                                                    Application Reference
                                                                </span>
                                                            </div>
                                                        </td>

                                                        {{-- Schedule --}}
                                                        <td class="px-4 py-4">
                                                            <div class="space-y-2">
                                                                <span
                                                                    class="inline-flex items-center px-3 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded-full dark:bg-green-500/20 dark:text-green-500">
                                                                    {{ $data->session_name }}
                                                                </span>

                                                                <div class="text-sm text-slate-700 dark:text-zink-100">
                                                                    <div class="font-medium">{{ $data->exam_session }}</div>
                                                                    <div class="text-slate-500 dark:text-zink-300">
                                                                        {{ \Carbon\Carbon::parse($data->schedule)->format('F j, Y') }}
                                                                        <span
                                                                            class="font-medium text-slate-700 dark:text-zink-100">
                                                                            [{{ $data->time }}]
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>

                                                        {{-- Venue --}}
                                                        <td class="px-4 py-4">
                                                            <div class="space-y-2">
                                                                <span
                                                                    class="inline-flex items-center px-3 py-1 text-xs font-semibold rounded-full bg-sky-100 text-sky-700 dark:bg-sky-500/20 dark:text-sky-300">
                                                                    {{ $data->campus }}
                                                                </span>

                                                                <div class="text-sm text-slate-700 dark:text-zink-100">
                                                                    {{ $data->college_name . ' - ' . $data->room_name }}
                                                                </div>
                                                            </div>
                                                        </td>

                                                        {{-- Date Created --}}
                                                        <td class="px-4 py-4">
                                                            <div class="text-sm text-slate-700 dark:text-zink-100">
                                                                {{ \Carbon\Carbon::parse($data->created_at)->setTimezone('Asia/Manila')->format('F j, Y h:i A') }}
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="6" class="px-4 py-10 text-center">
                                                        <div class="flex flex-col items-center justify-center gap-3">
                                                            <div
                                                                class="flex items-center justify-center rounded-2xl size-12 bg-slate-100 text-slate-500 dark:bg-zink-700 dark:text-zink-300">
                                                                <i data-lucide="calendar-x-2" class="size-5"></i>
                                                            </div>
                                                            <div>
                                                                <h6 class="font-semibold text-slate-800 dark:text-white">
                                                                    No reservations available
                                                                </h6>
                                                                <p class="mt-1 text-sm text-slate-500 dark:text-zink-300">
                                                                    You do not have any USMCEE reservation records yet.
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            {{-- Helper text --}}
                            <p class="mt-3 text-xs text-slate-400 dark:text-zink-400">
                                Reservation actions depend on your reservation status and whether the related CEE session is
                                currently active.
                            </p>
                        </div>
                    </div>
                </div>
            </div><!--end card-->

            @if ($reservationCount == 0)

                {{-- check the endofreservation --}}
                {{-- @if ($endofreservation && Carbon::parse($endofreservation, 'Asia/Manila')->isFuture())
                    <div class="card">
                        <div class="flex gap-3 p-4 text-sm text-green-500 rounded-md bg-ounde-50 dark:bg-ounde-400/20">
                            <i data-lucide="alert-circle" class="inline-block size-4 mt-0.5 shrink-0"></i>
                            <div>
                                <h6 class="mb-1">Kindly read this note before proceeding to CEE Slot Reservation</h6>
                                <p><b>Note:</b> Please ensure that you provide accurate and correct information.
                                    Double-check
                                    all details before submitting, as you will not be able to edit them once saved. </p>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">

                            <form action="{{ route('student.reserve.store') }}" method="POST">
                                @csrf
                                <h6 class="mb-1 text-5">RESERVATION DETAILS</h6>
                                <hr class="mb-4" />

                                <div class="xl:col-span-6">
                                    <input type="hidden" name="ceesession"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-green-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ $ceeSession->id }}" @readonly(true)>
                                </div><!--end col-->

                                <div class="grid grid-cols-1 gap-5 xl:grid-cols-12">

                                    <div class="xl:col-span-6">
                                        <label for="is_repeat_exam" class="inline-block mb-2 text-base font-medium">CEE
                                            Retaker?<sup class="text-green-500">* read only</sup></label>
                                        <input type="text" id="is_repeat_exam" name="is_repeat_exam"
                                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-green-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                            value="<?php echo $isRetaker ? 'Yes' : 'No'; ?>" @readonly(true)>
                                    </div><!--end col-->

                                    <div class="xl:col-span-12">
                                        <h6 class="text-blue-500 text-5">PRIORITY PROGRAMS</h6>

                                    </div>

                                    <div class="xl:col-span-4">
                                        <label for="campus" class="inline-block mb-2 text-base font-medium">Select
                                            Campus<sup class="text-red-500">* required</sup></label>
                                        <select id="campus-select" name="campus" data-choices
                                            class="form-input border-slate-300 focus:outline-none focus:border-custom-500">
                                            <option selected="true" disabled>Choose Campus</option>
                                            @foreach ($campusNames as $campusName)
                                                <option value="{{ $campusName->real_campus_id }} "
                                                    data-termid="{{ $campusName->termid }}">
                                                    {{ $campusName->campus_name }}
                                                </option>
                                            @endforeach


                                        </select>
                                    </div>

                                    <div class="xl:col-span-8">
                                        <label for="firstprioprog" class="inline-block mb-2 text-base font-medium">First
                                            Priority
                                            Program <sup class="text-red-500">* required</sup></label>
                                        <select id="program-select" name="firstprioprog" data-choices
                                            class="form-input border-slate-300 focus:outline-none focus:border-custom-500">
                                            <option selected="true" disabled>Choose Program</option>
                                        </select>
                                        <input type="hidden" name="firstprioprog_desc" id="firstprioprog_desc">
                                        <input type="hidden" name="firstprogram_policy_id" id="firstprogram_policy_id">
                                    </div>


                                    <div class="xl:col-span-4">
                                        <label for="campus2" class="inline-block mb-2 text-base font-medium">Select
                                            Campus<sup class="text-red-500">* required</sup></label>
                                        <select id="campus-select2" name="campus2" data-choices
                                            class="form-input border-slate-300 focus:outline-none focus:border-custom-500">
                                            <option selected="true" disabled>Choose Campus</option>
                                            @foreach ($campusNames as $campusName)
                                                <option value="{{ $campusName->real_campus_id }} "
                                                    data-termid="{{ $campusName->termid }}">
                                                    {{ $campusName->campus_name }}
                                                </option>
                                            @endforeach


                                        </select>
                                    </div>


                                    <div class="xl:col-span-8">
                                        <label for="secondprioprog" class="inline-block mb-2 text-base font-medium">Second
                                            Priority
                                            Program <sup class="text-red-500">* required</sup></label>
                                        <select id="program-select2" name="secondprioprog" data-choices
                                            class="form-input border-slate-300 focus:outline-none focus:border-custom-500">
                                            <option selected="true" disabled>Choose Program</option>
                                        </select>
                                        <input type="hidden" name="secondprioprog_desc" id="secondprioprog_desc">
                                        <input type="hidden" name="secondprogram_policy_id"
                                            id="secondprogram_policy_id">
                                    </div>


                                    <div class="xl:col-span-4">
                                        <label for="campus3" class="inline-block mb-2 text-base font-medium">Select
                                            Campus<sup class="text-red-500">* required</sup></label>
                                        <select id="campus-select3" name="campus3" data-choices
                                            class="form-input border-slate-300 focus:outline-none focus:border-custom-500">
                                            <option selected="true" disabled>Choose Campus</option>
                                            @foreach ($campusNames as $campusName)
                                                <option value="{{ $campusName->real_campus_id }} "
                                                    data-termid="{{ $campusName->termid }}">
                                                    {{ $campusName->campus_name }}
                                                </option>
                                            @endforeach


                                        </select>
                                    </div>

                                    <!-- Modal overlay for loading spinner -->
                                    <div id="loading-modal"
                                        class="fixed inset-0 z-50 flex items-center justify-center hidden bg-gray-800 bg-opacity-50">
                                        <div class="flex flex-col items-center p-4 bg-white rounded-lg shadow-lg">
                                            <svg class="w-10 h-10 mb-4 animate-spin text-custom-500"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                <circle class="opacity-25" cx="12" cy="12" r="10"
                                                    stroke="currentColor" stroke-width="4"></circle>
                                                <path class="opacity-75" fill="currentColor"
                                                    d="M4 12a8 8 0 018-8V0a12 12 0 100 24v-4a8 8 0 01-8-8z"></path>
                                            </svg>
                                            <p class="font-medium text-gray-700">Loading programs, please wait...</p>
                                        </div>
                                    </div>


                                    <div class="xl:col-span-8">
                                        <label for="thirdprioprog" class="inline-block mb-2 text-base font-medium">Third
                                            Priority
                                            Program <sup class="text-red-500">* required</sup></label>
                                        <select id="program-select3" name="thirdprioprog" data-choices
                                            class="form-input border-slate-300 focus:outline-none focus:border-custom-500">
                                            <option selected="true" disabled>Choose Program</option>
                                        </select>
                                        <input type="hidden" name="thirdprioprog_desc" id="thirdprioprog_desc">
                                        <input type="hidden" name="thirdprogram_policy_id" id="thirdprogram_policy_id">
                                    </div>


                                    <div class="xl:col-span-12">
                                        <h6 class="mt-2 text-blue-500 text-5">EXAMINATION VENUE</h6>
                                    </div>

                                    <div class="xl:col-span-12">
                                        <label for="campus" class="inline-block mb-2 text-base font-medium">Select
                                            Examination Venue
                                            <sup class="text-red-500">* required</sup></label>

                                        <select
                                            class="form-input border-slate-300 focus:outline-none focus:border-custom-500"
                                            id="examcampus" name="venue_campus">
                                            <option value="" selecteds>-Select
                                            </option>
                                            <option value="Main Campus">Main Campus
                                            </option>
                                            <option value="USM KCC">USM KCC
                                            </option>
                                            <option value="USM PALMA">USM PALMA
                                            </option>
                                        </select>

                                        <label id="activeSlotsLabel"
                                            class="hidden block mt-2 text-base font-medium text-blue-500">
                                            Active Slots for <span id="selectedCampus"></span>: <span
                                                id="activeSlots">0</span>
                                        </label>

                                        <label for="campus" class="block mt-2 text-base font-medium text-green-500">
                                            Note: The system will automatically select and assign a room for your
                                            reservation.
                                        </label>
                                    </div><!--end col-->

                                    <div class="flex justify-end gap-2 xl:col-span-12">
                                        <button type="button"
                                            class="text-red-500 bg-white btn hover:text-red-500 hover:bg-red-100 focus:text-red-500 focus:bg-red-100 active:text-red-500 active:bg-red-100 dark:bg-zink-700 dark:hover:bg-red-500/10 dark:focus:bg-red-500/10 dark:active:bg-red-500/10"><i
                                                data-lucide="x" class="inline-block size-4"></i> <span
                                                class="align-middle">Cancel</span></button>
                                        <button type="submit"
                                            class="text-white transition-all duration-200 ease-linear bg-green-500 border-green-500 btn hover:text-white hover:bg-green-600 hover:border-green-600 focus:text-white focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-100 active:text-white active:bg-green-600 active:border-green-600 active:ring active:ring-green-100">Submit</button>
                                    </div><!--end col-->
                                </div>
                            </form>

                        </div>
                    </div> --}}
                {{-- If the reservation Closesd --}}
                {{-- @else
                    <div class="card">
                        <div class="flex gap-3 p-4 text-sm text-red-500 rounded-md bg-red-50 dark:bg-red-400/20">
                            <i data-lucide="alert-circle" class="inline-block size-4 mt-0.5 shrink-0"></i>
                            <div>
                                <h6 class="mb-1">Hi there, {{ Auth::user()->firstname }} !</h6>
                                <p class="mb-0">Please be informed that the USMCEE Slot Reservation is officially
                                    closed.
                                </p>
                                <p class="mb-2">Thank you!</p>
                            </div>
                        </div>
                    </div>
                @endif --}}

                @if ($endofreservation && Carbon::parse($endofreservation, 'Asia/Manila')->isFuture())
                    {{-- Notice --}}
                    <div
                        class="mb-5 overflow-hidden border border-green-200 shadow-sm rounded-2xl bg-green-50 dark:border-green-500/20 dark:bg-green-500/10">
                        <div class="flex gap-3 p-5">
                            <div
                                class="flex items-center justify-center text-green-600 bg-white rounded-xl size-11 shrink-0 dark:bg-zink-800 dark:text-green-300">
                                <i data-lucide="badge-info" class="size-5"></i>
                            </div>

                            <div class="min-w-0">
                                <h6 class="mb-1 text-base font-bold tracking-tight text-slate-800 dark:text-white">
                                    Kindly read this note before proceeding to CEE Slot Reservation
                                </h6>
                                <p class="text-sm leading-6 text-slate-600 dark:text-zink-300">
                                    <span class="font-semibold text-slate-800 dark:text-white">Note:</span>
                                    Please ensure that you provide accurate and correct information. Double-check all
                                    details before
                                    submitting, as you will not be able to edit them once saved.
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Reservation Form Card --}}
                    <div
                        class="overflow-hidden bg-white border shadow-sm card rounded-2xl border-slate-200 dark:border-zink-600 dark:bg-zink-800">
                        <div class="p-0 card-body">

                            {{-- Header --}}
                            <div class="px-6 py-5 border-b border-slate-200 dark:border-zink-600">
                                <p class="mb-1 text-[11px] font-semibold tracking-[0.18em] uppercase text-custom-500">
                                    Reservation Form
                                </p>
                                <h6 class="text-lg font-bold tracking-tight text-slate-800 dark:text-white">
                                    Reservation Details
                                </h6>
                                <p class="mt-1 text-sm text-slate-500 dark:text-zink-300">
                                    Complete the details below to reserve your USMCEE slot.
                                </p>
                            </div>

                            <div class="p-6">
                                <form action="{{ route('student.reserve.store') }}" method="POST">
                                    @csrf

                                    <input type="hidden" name="ceesession" value="{{ $ceeSession->id }}" readonly>

                                    <div class="grid grid-cols-1 gap-5 xl:grid-cols-12">

                                        {{-- Retaker --}}
                                        <div class="xl:col-span-6">
                                            <label for="is_repeat_exam"
                                                class="inline-block mb-2 text-sm font-semibold text-slate-700 dark:text-zink-100">
                                                CEE Retaker?
                                                <span class="text-xs font-medium text-green-500">read only</span>
                                            </label>
                                            <input type="text" id="is_repeat_exam" name="is_repeat_exam"
                                                class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-600 focus:border-green-500 focus:outline-none dark:border-zink-600 dark:bg-zink-700 dark:text-zink-100"
                                                value="{{ $isRetaker ? 'Yes' : 'No' }}" readonly>
                                        </div>

                                        {{-- Priority Programs Header --}}
                                        <div class="pt-2 xl:col-span-12">
                                            <div class="flex items-center gap-3">
                                                <div
                                                    class="flex items-center justify-center rounded-xl size-10 bg-sky-100 text-sky-600 dark:bg-sky-500/20 dark:text-sky-300">
                                                    <i data-lucide="graduation-cap" class="size-5"></i>
                                                </div>
                                                <div>
                                                    <h6
                                                        class="text-base font-bold tracking-tight text-slate-800 dark:text-white">
                                                        Priority Programs
                                                    </h6>
                                                    <p class="text-sm text-slate-500 dark:text-zink-300">
                                                        Choose your first, second, and third priority programs.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- First Priority --}}
                                        <div class="xl:col-span-4">
                                            <label for="campus-select"
                                                class="inline-block mb-2 text-sm font-semibold text-slate-700 dark:text-zink-100">
                                                Select Campus <span class="text-red-500">*</span>
                                            </label>
                                            <select id="campus-select" name="campus" data-choices
                                                class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm focus:border-custom-500 focus:outline-none dark:border-zink-600 dark:bg-zink-700 dark:text-zink-100">
                                                <option selected disabled>Choose Campus</option>
                                                @foreach ($campusNames as $campusName)
                                                    <option value="{{ $campusName->real_campus_id }}"
                                                        data-termid="{{ $campusName->termid }}">
                                                        {{ $campusName->campus_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="xl:col-span-8">
                                            <label for="program-select"
                                                class="inline-block mb-2 text-sm font-semibold text-slate-700 dark:text-zink-100">
                                                First Priority Program <span class="text-red-500">*</span>
                                            </label>
                                            <select id="program-select" name="firstprioprog" data-choices
                                                class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm focus:border-custom-500 focus:outline-none dark:border-zink-600 dark:bg-zink-700 dark:text-zink-100">
                                                <option selected disabled>Choose Program</option>
                                            </select>
                                            <input type="hidden" name="firstprioprog_desc" id="firstprioprog_desc">
                                            <input type="hidden" name="firstprogram_policy_id"
                                                id="firstprogram_policy_id">
                                        </div>

                                        {{-- Second Priority --}}
                                        <div class="xl:col-span-4">
                                            <label for="campus-select2"
                                                class="inline-block mb-2 text-sm font-semibold text-slate-700 dark:text-zink-100">
                                                Select Campus <span class="text-red-500">*</span>
                                            </label>
                                            <select id="campus-select2" name="campus2" data-choices
                                                class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm focus:border-custom-500 focus:outline-none dark:border-zink-600 dark:bg-zink-700 dark:text-zink-100">
                                                <option selected disabled>Choose Campus</option>
                                                @foreach ($campusNames as $campusName)
                                                    <option value="{{ $campusName->real_campus_id }}"
                                                        data-termid="{{ $campusName->termid }}">
                                                        {{ $campusName->campus_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="xl:col-span-8">
                                            <label for="program-select2"
                                                class="inline-block mb-2 text-sm font-semibold text-slate-700 dark:text-zink-100">
                                                Second Priority Program <span class="text-red-500">*</span>
                                            </label>
                                            <select id="program-select2" name="secondprioprog" data-choices
                                                class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm focus:border-custom-500 focus:outline-none dark:border-zink-600 dark:bg-zink-700 dark:text-zink-100">
                                                <option selected disabled>Choose Program</option>
                                            </select>
                                            <input type="hidden" name="secondprioprog_desc" id="secondprioprog_desc">
                                            <input type="hidden" name="secondprogram_policy_id"
                                                id="secondprogram_policy_id">
                                        </div>

                                        {{-- Third Priority --}}
                                        <div class="xl:col-span-4">
                                            <label for="campus-select3"
                                                class="inline-block mb-2 text-sm font-semibold text-slate-700 dark:text-zink-100">
                                                Select Campus <span class="text-red-500">*</span>
                                            </label>
                                            <select id="campus-select3" name="campus3" data-choices
                                                class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm focus:border-custom-500 focus:outline-none dark:border-zink-600 dark:bg-zink-700 dark:text-zink-100">
                                                <option selected disabled>Choose Campus</option>
                                                @foreach ($campusNames as $campusName)
                                                    <option value="{{ $campusName->real_campus_id }}"
                                                        data-termid="{{ $campusName->termid }}">
                                                        {{ $campusName->campus_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="xl:col-span-8">
                                            <label for="program-select3"
                                                class="inline-block mb-2 text-sm font-semibold text-slate-700 dark:text-zink-100">
                                                Third Priority Program <span class="text-red-500">*</span>
                                            </label>
                                            <select id="program-select3" name="thirdprioprog" data-choices
                                                class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm focus:border-custom-500 focus:outline-none dark:border-zink-600 dark:bg-zink-700 dark:text-zink-100">
                                                <option selected disabled>Choose Program</option>
                                            </select>
                                            <input type="hidden" name="thirdprioprog_desc" id="thirdprioprog_desc">
                                            <input type="hidden" name="thirdprogram_policy_id"
                                                id="thirdprogram_policy_id">
                                        </div>

                                        {{-- Examination Venue Header --}}
                                        <div class="pt-2 xl:col-span-12">
                                            <div class="flex items-center gap-3">
                                                <div
                                                    class="flex items-center justify-center text-green-600 bg-green-100 rounded-xl size-10 dark:bg-green-500/20 dark:text-green-300">
                                                    <i data-lucide="map-pinned" class="size-5"></i>
                                                </div>
                                                <div>
                                                    <h6
                                                        class="text-base font-bold tracking-tight text-slate-800 dark:text-white">
                                                        Examination Venue
                                                    </h6>
                                                    <p class="text-sm text-slate-500 dark:text-zink-300">
                                                        Select your preferred examination venue.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="xl:col-span-12">
                                            <label for="examcampus"
                                                class="inline-block mb-2 text-sm font-semibold text-slate-700 dark:text-zink-100">
                                                Select Examination Venue <span class="text-red-500">*</span>
                                            </label>

                                            <select id="examcampus" name="venue_campus"
                                                class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm focus:border-custom-500 focus:outline-none dark:border-zink-600 dark:bg-zink-700 dark:text-zink-100">
                                                <option value="" selected>- Select -</option>
                                                <option value="Main Campus">Main Campus</option>
                                                <option value="USM KCC">USM KCC</option>
                                                <option value="USM PALMA">USM PALMA</option>
                                            </select>

                                            <div id="activeSlotsLabel"
                                                class="hidden px-4 py-3 mt-3 text-sm border rounded-xl border-sky-200 bg-sky-50 text-sky-700 dark:border-sky-500/20 dark:bg-sky-500/10 dark:text-sky-500">
                                                Active Slots for <span id="selectedCampus" class="font-semibold"></span>:
                                                <span id="activeSlots" class="font-bold">0</span>
                                            </div>

                                            <div
                                                class="px-4 py-3 mt-3 text-sm text-green-700 border border-green-200 rounded-xl bg-green-50 dark:border-green-500/20 dark:bg-green-500/10 dark:text-green-500">
                                                <span class="font-semibold">Note:</span>
                                                The system will automatically select and assign a room for your reservation.
                                            </div>
                                        </div>

                                        {{-- Actions --}}
                                        <div class="flex justify-end gap-3 pt-2 xl:col-span-12">
                                            <button type="button"
                                                class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-semibold text-red-600 transition-all duration-200 bg-white border border-red-200 rounded-xl hover:bg-red-50 dark:bg-zink-700 dark:border-red-500/20 dark:text-red-300 dark:hover:bg-red-500/10">
                                                <i data-lucide="x" class="size-4"></i>
                                                Cancel
                                            </button>

                                            <button type="submit"
                                                class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-semibold text-white transition-all duration-200 bg-green-500 shadow-sm rounded-xl hover:bg-green-600 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-green-200">
                                                <i data-lucide="check" class="size-4"></i>
                                                Submit Reservation
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    {{-- Loading Modal --}}
                    <div id="loading-modal"
                        class="fixed inset-0 z-50 flex items-center justify-center hidden bg-slate-950/50 backdrop-blur-sm">
                        <div
                            class="flex flex-col items-center p-6 bg-white border shadow-xl rounded-2xl border-slate-200 dark:bg-zink-800 dark:border-zink-600">
                            <svg class="w-10 h-10 mb-4 animate-spin text-custom-500" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0a12 12 0 100 24v-4a8 8 0 01-8-8z"></path>
                            </svg>
                            <p class="font-medium text-slate-700 dark:text-zink-100">
                                Loading programs, please wait...
                            </p>
                        </div>
                    </div>
                @else
                    {{-- Reservation Closed --}}
                    <div
                        class="overflow-hidden border border-red-200 shadow-sm rounded-2xl bg-red-50 dark:border-red-500/20 dark:bg-red-500/10">
                        <div class="flex gap-3 p-5">
                            <div
                                class="flex items-center justify-center text-red-600 bg-white rounded-xl size-11 shrink-0 dark:bg-zink-800 dark:text-red-300">
                                <i data-lucide="alert-circle" class="size-5"></i>
                            </div>

                            <div class="min-w-0">
                                <h6 class="mb-1 text-base font-bold tracking-tight text-slate-800 dark:text-white">
                                    Hi there, {{ Auth::user()->firstname }}!
                                </h6>
                                <p class="text-sm text-slate-600 dark:text-zink-500">
                                    Please be informed that the <span class="font-semibold">USMCEE Slot Reservation</span>
                                    is officially closed.
                                </p>
                                <p class="mt-2 text-sm font-medium text-slate-700 dark:text-zink-100">
                                    Thank you!
                                </p>
                            </div>
                        </div>
                    </div>
                @endif

            @endif

        </div><!--end col-->
    </div><!--end grid-->
@endsection
@push('scripts')
    <!-- Include SweetAlert library -->
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('message'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    icon: "{{ session('status') === 'error' ? 'error' : 'success' }}",
                    title: "{{ session('status') === 'error' ? 'Error' : 'Success' }}",
                    text: "{{ session('message') }}",
                    confirmButtonText: 'OK'
                });
            });
        </script>
    @endif

    @if ($errors->any())
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Validation Errors',
                    html: '{!! implode('<br>', $errors->all()) !!}',
                    confirmButtonText: 'OK'
                });
            });
        </script>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Call the duplicate check endpoint
            fetch("{{ route('student.check.duplicate.records') }}")
                .then(response => response.json())
                .then(data => {
                    if (data.hasDuplicates) {
                        Swal.fire({
                            title: 'Warning',
                            html: "It appears that you may have multiple accounts registered in the system. Please refer to our <a href='https://www.facebook.com/theUSMofficial/posts/pfbid023dhP2MebE75xskEstWatNpjLBQH6CWh3XG6HWDYEMBk7QPHv4DAYpk2KvDBi4cFgl?rdid=BrbqOM3Yujlp2Z1p#' target='_blank'>Facebook announcement</a> for reference.",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: '',
                            showConfirmButton: false,
                            showCancelButton: false,
                            cancelButtonText: 'Close',
                            allowOutsideClick: false
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Action after confirmation if needed
                            }
                        });

                    }
                })
                .catch(error => console.error('Error:', error));
        });
        // Get the select elements and the modal
        const selects = ['campus-select', 'campus-select2', 'campus-select3'].map(id => document.getElementById(id));
        const loadingModal = document.getElementById('loading-modal');

        // Function to show the loading modal
        function showLoadingModal(selectElement) {
            loadingModal.classList.remove('hidden'); // Show the modal
            selectElement.disabled = true; // Disable the specific select element

            // Hide the modal and enable the select element after 10 seconds
            setTimeout(() => {
                loadingModal.classList.add('hidden');
                selectElement.disabled = false;
            }, 3000);
        }

        // Add event listeners for each select element
        selects.forEach(select => {
            select.addEventListener('change', function() {
                showLoadingModal(select);
            });
        });
    </script>

    <script>
        let selectedCampus = '';

        // Function to fetch and update active slots
        function fetchActiveSlots() {
            if (selectedCampus) {
                fetch("{{ route('student.count-active-slots') }}?campus=" + encodeURIComponent(selectedCampus))
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('activeSlots').innerText = data.activeSlots;
                    })
                    .catch(error => console.error('Error fetching slots:', error));
            }
        }

        document.getElementById('examcampus').addEventListener('change', function() {
            selectedCampus = this.value;
            let activeSlotsLabel = document.getElementById('activeSlotsLabel');
            let selectedCampusSpan = document.getElementById('selectedCampus');

            if (selectedCampus) {
                selectedCampusSpan.innerText = selectedCampus;
                activeSlotsLabel.classList.remove('hidden'); // Show label
                fetchActiveSlots(); // Fetch immediately when user selects a campus
            } else {
                activeSlotsLabel.classList.add('hidden'); // Hide label if no campus selected
            }
        });

        // Automatically fetch active slots every 10 seconds
        setInterval(fetchActiveSlots, 10000);
    </script>


    <script>
        // if (navigator.geolocation) {
        //     navigator.geolocation.getCurrentPosition(
        //         (position) => {
        //             console.log("Latitude:", position.coords.latitude);
        //             console.log("Longitude:", position.coords.longitude);
        //         },
        //         (error) => {
        //             if (error.code === error.PERMISSION_DENIED) {
        //                 alert("Please enable location access for a better experience.");
        //                 // Optionally, provide instructions or a link to help users enable location.
        //             }
        //         }
        //     );
        // } else {
        //     alert("Geolocation is not supported by this browser.");
        // }

        $(document).ready(function() {
            $('form').on('submit', function(event) {
                event.preventDefault(); // Prevent default submission

                // Show SweetAlert confirmation dialog
                Swal.fire({
                    title: 'Are you sure?',
                    text: "I confirm that all data are correct and reviewed. I understand that once saved, I will no longer be able to edit the information.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, save it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // If confirmed, submit the form
                        this.submit();
                    }
                });
            });
        });

        // Initialize Choices on the room select element
        document.addEventListener('DOMContentLoaded', function() {
            const campusSelect1 = document.getElementById('campus-select');
            const programSelect1 = document.getElementById('program-select');
            const firstPriorityDescInput = document.getElementById('firstprioprog_desc');
            const firstprogram_policy_id_Input = document.getElementById('firstprogram_policy_id');

            const campusSelect2 = document.getElementById('campus-select2');
            const programSelect2 = document.getElementById('program-select2');
            const secondPriorityDescInput = document.getElementById('secondprioprog_desc');
            const secondprogram_policy_id_Input = document.getElementById('secondprogram_policy_id');

            const campusSelect3 = document.getElementById('campus-select3');
            const programSelect3 = document.getElementById('program-select3');
            const thirdPriorityDescInput = document.getElementById('thirdprioprog_desc');
            const thirdprogram_policy_id_Input = document.getElementById('thirdprogram_policy_id');


            function loadPrograms(campusSelect, programSelect) {
                const realCampusId = campusSelect.value;
                const termId = campusSelect.selectedOptions[0].dataset.termid;

                if (!realCampusId || !termId) return; // Exit if missing values

                programSelect.innerHTML = '<option selected disabled>Please wait...</option>';

                fetch(`/student/cee/get-programs-by-campus?termId=${termId}&realCampusId=${realCampusId}`)
                    .then(response => response.json())
                    .then(data => {
                        programSelect.innerHTML = '<option selected disabled>Choose Program</option>';
                        data.forEach(program => {
                            const option = document.createElement('option');
                            option.value = program.programId;
                            option.textContent = program.majorDiscDesc ?
                                `${program.programName} - ${program.majorDiscDesc}` : program
                                .programName;
                            option.setAttribute('data-program-name', program.programName);
                            option.setAttribute('data-program-policy_id', program.id);
                            programSelect.appendChild(option);
                        });
                    })
                    .catch(error => {
                        console.error('Error loading programs:', error);
                        programSelect.innerHTML = '<option selected disabled>Error loading programs</option>';
                    });
            }

            campusSelect1.addEventListener('change', () => loadPrograms(campusSelect1, programSelect1));
            campusSelect2.addEventListener('change', () => loadPrograms(campusSelect2, programSelect2));
            campusSelect3.addEventListener('change', () => loadPrograms(campusSelect3, programSelect3));

            // Update priority description inputs when a program is selected
            programSelect1.addEventListener('change', () => {
                const selectedOption = programSelect1.options[programSelect1.selectedIndex];
                firstPriorityDescInput.value = selectedOption.getAttribute('data-program-name');
                firstprogram_policy_id_Input.value = selectedOption.getAttribute('data-program-policy_id');
            });

            programSelect2.addEventListener('change', () => {
                const selectedOption = programSelect2.options[programSelect2.selectedIndex];
                secondPriorityDescInput.value = selectedOption.getAttribute('data-program-name');
                secondprogram_policy_id_Input.value = selectedOption.getAttribute('data-program-policy_id');
            });

            programSelect3.addEventListener('change', () => {
                const selectedOption = programSelect3.options[programSelect3.selectedIndex];
                thirdPriorityDescInput.value = selectedOption.getAttribute('data-program-name');
                thirdprogram_policy_id_Input.value = selectedOption.getAttribute('data-program-policy_id');
            });
        });
    </script>
@endpush
