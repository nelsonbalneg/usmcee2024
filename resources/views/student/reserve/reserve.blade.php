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
                CEE Reserve
            </li>
        </ul>
    </div>

    <!--start grid-->
    <div class="grid grid-cols-1 gap-x-5 xl:grid-cols-12">
        <!--start col-->
        <div class="xl:col-span-12">
            <!--start card-->
            {{-- <div class="card"> --}}
            @if ($reservation_details)

                @if ($reservation_details->status === 'confirmed' || $reservation_details->status === 'pending')

                    <div class="flex flex-col col-span-1 gap-3 card 2xl:col-span-12">
                        <div class="card-body">
                            <h6 class="mb-4 text-15">YOUR USMCEE RESERVATIONS
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
                                            <th class="px-3.5 py-2.5 font-semibold ltr:text-left rtl:text-right">CEE Term
                                            </th>
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
                                                        {{ $data->exam_session }} <br>
                                                        {{ \Carbon\Carbon::parse($data->schedule)->format('F j, Y') }}
                                                        [{{ $data->time }}]</td>
                                                    <td class="px-3.5 py-2.5">
                                                        {{ $data->college_name . '-' . $data->room_name }}</td>
                                                    <td class="px-3.5 py-2.5">{{ $data->cee_session_id }}</td>
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
                    </div><!--end card-->
                @elseif($reservation_details->status === 'cancelled')
                    {{-- check the endofreservation --}}
                    @if ($endofreservation && Carbon::parse($endofreservation, 'Asia/Manila')->isFuture())
                        <div class="card">
                            <div
                                class="flex gap-3 p-4 text-sm rounded-md text-custom-500 bg-custom-50 dark:bg-custom-400/20">
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
                                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                            value="{{ $ceeSession->id }}" @readonly(true)>
                                    </div><!--end col-->

                                    <div class="grid grid-cols-1 gap-5 xl:grid-cols-12">

                                        <div class="xl:col-span-6">
                                            <label for="is_repeat_exam" class="inline-block mb-2 text-base font-medium">CEE
                                                Retaker?<sup class="text-blue-500">* read only</sup></label>
                                            <input type="text" id="is_repeat_exam" name="is_repeat_exam"
                                                class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
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
                                                <option value="1">USM Main</option>
                                                <option value="3">USM KCC</option>
                                                <option value="5">USM PALMA CLUSTER</option>
                                                <option value="6">USM MLANG</option>
                                                <option value="7">USM Antipas</option>
                                                <option value="8">USM Pigcwayan</option>

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
                                            <input type="hidden" name="firstprogram_policy_id"
                                                id="firstprogram_policy_id">
                                        </div>


                                        <div class="xl:col-span-4">
                                            <label for="campus2" class="inline-block mb-2 text-base font-medium">Select
                                                Campus<sup class="text-red-500">* required</sup></label>
                                            <select id="campus-select2" name="campus2" data-choices
                                                class="form-input border-slate-300 focus:outline-none focus:border-custom-500">
                                                <option selected="true" disabled>Choose Campus</option>
                                                <option value="1">USM Main</option>
                                                <option value="3">USM KCC</option>
                                                <option value="5">USM PALMA CLUSTER</option>
                                                <option value="6">USM MLANG</option>
                                                <option value="7">USM Antipas</option>
                                                <option value="8">USM Pigcwayan</option>

                                            </select>
                                        </div>


                                        <div class="xl:col-span-8">
                                            <label for="secondprioprog"
                                                class="inline-block mb-2 text-base font-medium">Second
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
                                                <option value="1">USM Main</option>
                                                <option value="3">USM KCC</option>
                                                <option value="5">USM PALMA CLUSTER</option>
                                                <option value="6">USM MLANG</option>
                                                <option value="7">USM Antipas</option>
                                                <option value="8">USM Pigcwayan</option>

                                            </select>
                                        </div>

                                        <!-- Modal overlay for loading spinner -->
                                        <div id="loading-modal"
                                            class="fixed inset-0 z-50 flex items-center justify-center hidden bg-gray-800 bg-opacity-50">
                                            <div class="flex flex-col items-center p-4 bg-white rounded-lg shadow-lg">
                                                <svg class="w-10 h-10 mb-4 animate-spin text-custom-500"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24">
                                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                                        stroke="currentColor" stroke-width="4"></circle>
                                                    <path class="opacity-75" fill="currentColor"
                                                        d="M4 12a8 8 0 018-8V0a12 12 0 100 24v-4a8 8 0 01-8-8z"></path>
                                                </svg>
                                                <p class="font-medium text-gray-700">Loading programs, please wait...</p>
                                            </div>
                                        </div>


                                        <div class="xl:col-span-8">
                                            <label for="thirdprioprog"
                                                class="inline-block mb-2 text-base font-medium">Third
                                                Priority
                                                Program <sup class="text-red-500">* required</sup></label>
                                            <select id="program-select3" name="thirdprioprog" data-choices
                                                class="form-input border-slate-300 focus:outline-none focus:border-custom-500">
                                                <option selected="true" disabled>Choose Program</option>
                                            </select>
                                            <input type="hidden" name="thirdprioprog_desc" id="thirdprioprog_desc">
                                            <input type="hidden" name="thirdprogram_policy_id"
                                                id="thirdprogram_policy_id">
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

                                        {{-- <div class="xl:col-span-6">
                                        <label for="ceesession" class="inline-block mb-2 text-base font-medium">USMCEE
                                            Batch
                                            <sup class="text-red-500">* required</sup></label>
                                        <select
                                            class="form-input border-slate-300 focus:outline-none focus:border-custom-500"
                                            id="ceeexamsession" name="ceeexamsession">
                                            <option value="" selected>-Select Campus
                                            </option>
                                            <option value="Batch 1">Batch 1 (8:00 AM - 9:00 AM)
                                            </option>
                                            <option value="Batch 2">Batch 2 (10:00 AM - 1:00 PM)
                                            </option>
                                            <option value="Batch 3">Batch 3 (1:30 PM - 4:30 PM)
                                            </option>
                                        </select>
                                    </div> --}}

                                        <!--end col-->

                                        {{-- <div class="xl:col-span-6">
                                        <label for="room" class="inline-block mb-2 text-base font-medium">Room
                                            Assignment<sup class="text-red-500">* required</sup></label>
                                        <select id="room-select" name="room"
                                            class="form-input border-slate-300 focus:outline-none focus:border-custom-500"
                                            data-choices>
                                            <option selected="true" disabled>Choose Room</option>
                                        </select>
                                    </div> --}}

                                        <div class="flex justify-end gap-2 xl:col-span-12">
                                            <button type="button"
                                                class="text-red-500 bg-white btn hover:text-red-500 hover:bg-red-100 focus:text-red-500 focus:bg-red-100 active:text-red-500 active:bg-red-100 dark:bg-zink-700 dark:hover:bg-red-500/10 dark:focus:bg-red-500/10 dark:active:bg-red-500/10"><i
                                                    data-lucide="x" class="inline-block size-4"></i> <span
                                                    class="align-middle">Cancel</span></button>
                                            <button type="submit"
                                                class="text-white transition-all duration-200 ease-linear btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100">Submit</button>
                                        </div><!--end col-->
                                    </div>
                                </form>

                            </div>
                        </div>
                        {{-- If the reservation Closesd --}}
                    @else
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
                    @endif
                @endif
            @else
                {{-- check the endofreservation --}}
                @if ($endofreservation && Carbon::parse($endofreservation, 'Asia/Manila')->isFuture())
                    <div class="card">
                        <div class="flex gap-3 p-4 text-sm rounded-md text-custom-500 bg-custom-50 dark:bg-custom-400/20">
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
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ $ceeSession->id }}" @readonly(true)>
                                </div><!--end col-->

                                <div class="grid grid-cols-1 gap-5 xl:grid-cols-12">

                                    <div class="xl:col-span-6">
                                        <label for="is_repeat_exam" class="inline-block mb-2 text-base font-medium">CEE
                                            Retaker?<sup class="text-blue-500">* read only</sup></label>
                                        <input type="text" id="is_repeat_exam" name="is_repeat_exam"
                                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
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
                                            <option value="1">USM Main</option>
                                            <option value="3">USM KCC</option>
                                            <option value="5">USM PALMA CLUSTER</option>
                                            <option value="6">USM MLANG</option>
                                            <option value="7">USM Antipas</option>
                                            <option value="8">USM Pigcwayan</option>

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
                                            <option value="1">USM Main</option>
                                            <option value="3">USM KCC</option>
                                            <option value="5">USM PALMA CLUSTER</option>
                                            <option value="6">USM MLANG</option>
                                            <option value="7">USM Antipas</option>
                                            <option value="8">USM Pigcwayan</option>

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
                                            <option value="1">USM Main</option>
                                            <option value="3">USM KCC</option>
                                            <option value="5">USM PALMA CLUSTER</option>
                                            <option value="6">USM MLANG</option>
                                            <option value="7">USM Antipas</option>
                                            <option value="8">USM Pigcwayan</option>

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

                                    {{-- <div class="xl:col-span-6">
                              <label for="ceesession" class="inline-block mb-2 text-base font-medium">USMCEE
                                  Batch
                                  <sup class="text-red-500">* required</sup></label>
                              <select
                                  class="form-input border-slate-300 focus:outline-none focus:border-custom-500"
                                  id="ceeexamsession" name="ceeexamsession">
                                  <option value="" selected>-Select Campus
                                  </option>
                                  <option value="Batch 1">Batch 1 (8:00 AM - 9:00 AM)
                                  </option>
                                  <option value="Batch 2">Batch 2 (10:00 AM - 1:00 PM)
                                  </option>
                                  <option value="Batch 3">Batch 3 (1:30 PM - 4:30 PM)
                                  </option>
                              </select>
                          </div> --}}

                                    <!--end col-->

                                    {{-- <div class="xl:col-span-6">
                              <label for="room" class="inline-block mb-2 text-base font-medium">Room
                                  Assignment<sup class="text-red-500">* required</sup></label>
                              <select id="room-select" name="room"
                                  class="form-input border-slate-300 focus:outline-none focus:border-custom-500"
                                  data-choices>
                                  <option selected="true" disabled>Choose Room</option>
                              </select>
                          </div> --}}

                                    <div class="flex justify-end gap-2 xl:col-span-12">
                                        <button type="button"
                                            class="text-red-500 bg-white btn hover:text-red-500 hover:bg-red-100 focus:text-red-500 focus:bg-red-100 active:text-red-500 active:bg-red-100 dark:bg-zink-700 dark:hover:bg-red-500/10 dark:focus:bg-red-500/10 dark:active:bg-red-500/10"><i
                                                data-lucide="x" class="inline-block size-4"></i> <span
                                                class="align-middle">Cancel</span></button>
                                        <button type="submit"
                                            class="text-white transition-all duration-200 ease-linear btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100">Submit</button>
                                    </div><!--end col-->
                                </div>
                            </form>

                        </div>
                    </div>
                    {{-- If the reservation Closesd --}}
                @else
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

                // Set termId based on the selected campus
                let termId;
                switch (realCampusId) {
                    case "1":
                        termId = 101;
                        break; // USM Main
                    case "3":
                        termId = 70;
                        break; // USM KCC
                    case "5":
                        termId = 101;
                        break; // PALMA
                    case "6":
                        termId = 101;
                        break; // Mlang
                    case "7":
                        termId = 101;
                        break; // antipas
                    case "8":
                        termId = 101;
                        break; // Pigcwayan
                    default:
                        termId = null;
                        break;
                }

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
