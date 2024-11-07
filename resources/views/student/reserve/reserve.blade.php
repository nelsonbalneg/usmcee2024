@extends('student.layouts.master')
@section('title')
    USMCEE - My Profile
@endsection

@push('styles')
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
            @if ($existingReservation)
                @php
                    $encryptedAppNo = Crypt::encryptString($existingReservation->app_no);
                @endphp
                <div class="block tab-pane" id="overviewTabs">
                    <div class="grid grid-cols-1 gap-x-5 2xl:grid-cols-12">
                        <div class="2xl:col-span-12">
                            <div class="grid grid-cols-1 gap-x-5 xl:grid-cols-12">

                                <div class="text-center card bg-custom-500 xl:col-span-3">
                                    <div class="flex flex-col h-full card-body">
                                        <img src="{{ asset(Auth::user()->photo) }}" alt=""
                                            class="w-2/6 mx-auto rounded-full">
                                        <div class="mt-5 mb-auto">
                                            <h5 class="mb-1 text-white">Congratulations!
                                                {{ $existingReservation->applicant->firstname }}</h5>
                                            <p class="text-custom-200">You have successfully reserve a slot. Kindly click
                                                the <b>Application Number </b> download your CEE slip.</p>
                                        </div>
                                        <div class="p-3 mt-5 rounded-md bg-custom-600">
                                            {{-- <h2 class="mb-1 text-white">{{ $existingReservation->app_no }}</h2> --}}
                                            <a href="{{ route('student.cee.exam-slip', ['app_no' => $encryptedAppNo]) }}"
                                                class="text-decoration-none" target="_blank">
                                                <h2 class="mb-1 text-white">{{ $existingReservation->app_no }}</h2>
                                            </a>
                                            {{-- <p class="text-custom-200">Application Number</p> --}}
                                        </div>
                                    </div>
                                </div><!--end col-->
                                <div class="xl:col-span-4">
                                    <div class="card">
                                        <div class="bg-slate-200 card-body rounded-t-md dark:bg-zink-600">
                                            <h6 class="mb-1 text-15">USMCEE Reservation Details</h6>
                                        </div>
                                        <div class="card-body">

                                            <div class="overflow-x-auto">
                                                <table class="w-full ltr:text-left rtl:ext-right">
                                                    <tbody>
                                                        <tr>
                                                            <th class="pt-2 font-semibold ps-0" scope="row">Learner
                                                                Rerefence Number</th>
                                                            <td class="pt-2 text-right text-slate-500 dark:text-zink-200">
                                                                {{ $existingReservation->applicant->lrn }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="py-2 font-semibold ps-0" scope="row">Full Name
                                                            </th>
                                                            <td class="py-2 text-right text-slate-500 dark:text-zink-200">
                                                                {{ $existingReservation->applicant->lastname }},
                                                                {{ $existingReservation->applicant->firstname }}
                                                                {{ $existingReservation->applicant->middlename }}
                                                                {{ $existingReservation->applicant->suffix }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="py-2 font-semibold ps-0" scope="row">Sex</th>
                                                            <td class="py-2 text-right text-slate-500 dark:text-zink-200">
                                                                {{ $existingReservation->applicant->sex }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="py-2 font-semibold ps-0" scope="row">Phone No</th>
                                                            <td class="py-2 text-right text-slate-500 dark:text-zink-200">
                                                                {{ $existingReservation->applicant->phone }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="py-2 font-semibold ps-0" scope="row">Email</th>
                                                            <td class="py-2 text-right text-slate-500 dark:text-zink-200">
                                                                {{ $existingReservation->applicant->email }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="py-2 font-semibold ps-0" scope="row">Birth Date
                                                            </th>
                                                            <td class="py-2 text-right text-slate-500 dark:text-zink-200">
                                                                {{ \Carbon\Carbon::parse($existingReservation->applicant->birthdate)->format('F j, Y') }}
                                                            </td>
                                                        </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div><!--end col-->

                                <div class="xl:col-span-5">
                                    <div class="card">
                                        <div class="bg-slate-200 card-body rounded-t-md dark:bg-zink-600">
                                            <h6 class="mb-1 text-15">Priority Programs and Schedule </h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="overflow-x-auto">
                                                <table class="w-full ltr:text-left rtl:ext-right">
                                                    <tbody>
                                                        <tr>
                                                            <th class="py-2 font-semibold ps-0" scope="row">First
                                                                Priority</th>
                                                            <td class="py-2 text-right text-slate-500 dark:text-zink-200">
                                                                {{ $existingReservation->firstpriorty_desc }} <b>
                                                                    (
                                                                    @if ($existingReservation->campus_id == 1)
                                                                        USM-Main
                                                                    @elseif ($existingReservation->campus_id == 3)
                                                                        USM KCC
                                                                    @elseif ($existingReservation->campus_id == 5)
                                                                        USM PALMA CLUSTER
                                                                    @elseif ($existingReservation->campus_id == 6)
                                                                        USM MLANG
                                                                    @else
                                                                        Unknown Campus
                                                                    @endif)
                                                                </b>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <th class="py-2 font-semibold ps-0" scope="row">Second
                                                                Priority</th>
                                                            <td class="py-2 text-right text-slate-500 dark:text-zink-200">
                                                                {{ $existingReservation->secondpriority_desc }} <b>
                                                                    (
                                                                    @if ($existingReservation->campus_id_prio_prog_2 == 1)
                                                                        USM-Main
                                                                    @elseif ($existingReservation->campus_id_prio_prog_2 == 3)
                                                                        USM KCC
                                                                    @elseif ($existingReservation->campus_id_prio_prog_2 == 5)
                                                                        USM PALMA CLUSTER
                                                                    @elseif ($existingReservation->campus_id_prio_prog_2 == 6)
                                                                        USM MLANG
                                                                    @else
                                                                        Unknown Campus
                                                                    @endif)
                                                                </b>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <th class="py-2 font-semibold ps-0" scope="row">Third
                                                                Priority</th>
                                                            <td class="py-2 text-right text-slate-500 dark:text-zink-200">
                                                                {{ $existingReservation->thirdpriorty_desc }}
                                                                <b>(
                                                                    @if ($existingReservation->campus_id_prio_prog_3 == 1)
                                                                        USM-Main
                                                                    @elseif ($existingReservation->campus_id_prio_prog_3 == 3)
                                                                        USM KCC
                                                                    @elseif ($existingReservation->campus_id_prio_prog_3 == 5)
                                                                        USM PALMA CLUSTER
                                                                    @elseif ($existingReservation->campus_id_prio_prog_3 == 6)
                                                                        USM MLANG
                                                                    @else
                                                                        Unknown Campus
                                                                    @endif)
                                                                </b>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th class="py-2 font-semibold ps-0" scope="row">Session and
                                                                Date</th>
                                                            <td class="py-2 text-right text-slate-500 dark:text-zink-200">
                                                                <b> {{ strtoupper($existingReservation->exam_session) }}
                                                                    <b>
                                                                        {{ \Carbon\Carbon::parse($existingReservation->room->schedule)->format('F j, Y') }}
                                                                        (
                                                                        {{ $existingReservation->room->time }})
                                                            </td>

                                                        </tr>
                                                        <tr>
                                                            <th class="py-2 font-semibold ps-0" scope="row">Examination
                                                                Place</th>
                                                            <td class="py-2 text-right text-slate-500 dark:text-zink-200">
                                                                {{ $existingReservation->room->college_name }} ({{ $existingReservation->room->room_name }} )
                                                                </td>
                                                        </tr>
                                                        <tr>
                                                            <th class="py-2 font-semibold ps-0" scope="row">Status</th>
                                                            <td class="py-2 text-right text-slate-500 dark:text-zink-200">
                                                                @if ($existingReservation->is_repeat_exam == 'No')
                                                                    First Time Taker
                                                                @elseif ($existingReservation->is_repeat_exam == 'Yes')
                                                                    Retaker
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div><!--end col-->

                            </div><!--end grid-->

                        </div><!--end col-->
                    </div><!--end grid-->

                </div><!--end tab pane-->

                <div class="card">
                    <div class="bg-slate-200 card-body rounded-t-md dark:bg-zink-600">
                        <h6 class="mb-1 text-15">USM Interactive Map</h6>
                    </div>
                    <div class="card-body">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3959.0913334125385!2d124.83410507650434!3d7.115413992888201!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x32f88d6eb36848a5%3A0x284e2a004693d67b!2sUniversity%20of%20Southern%20Mindanao!5e0!3m2!1sen!2sph!4v1730724031596!5m2!1sen!2sph"
                            width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>

                </div>
            @else
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
                                        Retaker?</label>
                                    <input type="text" id="is_repeat_exam" name="is_repeat_exam"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="<?php echo $isRetaker ? 'Yes' : 'No'; ?>" @readonly(true)>
                                </div><!--end col-->

                                <div class="xl:col-span-12">
                                    <h6 class=" text-5">Priority Programs</h6>

                                </div>

                                <div class="xl:col-span-4">
                                    <label for="campus" class="inline-block mb-2 text-base font-medium">Select
                                        Campus<span class="text-red-500">*</span></label>
                                    <select id="campus-select" name="campus"
                                        class="form-input border-slate-300 focus:outline-none focus:border-custom-500">
                                        <option selected="true" disabled>Choose Campus</option>
                                        <option value="1">USM Main</option>
                                        <option value="3">USM KCC</option>
                                        <option value="5">USM PALMA CLUSTER</option>
                                        <option value="6">USM MLANG</option>

                                    </select>
                                </div>

                                <div class="xl:col-span-8">
                                    <label for="firstprioprog" class="inline-block mb-2 text-base font-medium">First
                                        Priority
                                        Program <span class="text-red-500">*</span></label>
                                    <select id="program-select" name="firstprioprog" select2
                                        class="form-input border-slate-300 focus:outline-none focus:border-custom-500">
                                        <option selected="true" disabled>Choose Program</option>
                                    </select>
                                    <input type="hidden" name="firstprioprog_desc" id="firstprioprog_desc">
                                </div>


                                <div class="xl:col-span-4">
                                    <label for="campus2" class="inline-block mb-2 text-base font-medium">Select
                                        Campus<span class="text-red-500">*</span></label>
                                    <select id="campus-select2" name="campus2"
                                        class="form-input border-slate-300 focus:outline-none focus:border-custom-500">
                                        <option selected="true" disabled>Choose Campus</option>
                                        <option value="1">USM Main</option>
                                        <option value="3">USM KCC</option>
                                        <option value="5">USM PALMA CLUSTER</option>
                                        <option value="6">USM MLANG</option>

                                    </select>
                                </div>


                                <div class="xl:col-span-8">
                                    <label for="secondprioprog" class="inline-block mb-2 text-base font-medium">Second
                                        Priority
                                        Program <span class="text-red-500">*</span></label>
                                    <select id="program-select2" name="secondprioprog"
                                        class="form-input border-slate-300 focus:outline-none focus:border-custom-500">
                                        <option selected="true" disabled>Choose Program</option>
                                    </select>
                                    <input type="hidden" name="secondprioprog_desc" id="secondprioprog_desc">
                                </div>


                                <div class="xl:col-span-4">
                                    <label for="campus3" class="inline-block mb-2 text-base font-medium">Select
                                        Campus<span class="text-red-500">*</span></label>
                                    <select id="campus-select3" name="campus3"
                                        class="form-input border-slate-300 focus:outline-none focus:border-custom-500">
                                        <option selected="true" disabled>Choose Campus</option>
                                        <option value="1">USM Main</option>
                                        <option value="3">USM KCC</option>
                                        <option value="5">USM PALMA CLUSTER</option>
                                        <option value="6">USM MLANG</option>

                                    </select>
                                </div>
                                <div class="xl:col-span-8">
                                    <label for="thirdprioprog" class="inline-block mb-2 text-base font-medium">Third
                                        Priority
                                        Program <span class="text-red-500">*</span></label>
                                    <select id="program-select3" name="thirdprioprog"
                                        class="form-input border-slate-300 focus:outline-none focus:border-custom-500">
                                        <option selected="true" disabled>Choose Program</option>
                                    </select>
                                    <input type="hidden" name="thirdprioprog_desc" id="thirdprioprog_desc">
                                </div>


                                <div class="xl:col-span-12">
                                    <h6 class="mt-2 text-5">Examination Details</h6>
                                </div>

                                <div class="xl:col-span-6">
                                    <label for="ceesession" class="inline-block mb-2 text-base font-medium">USMCEE
                                        Batch
                                        <span class="text-red-500">*</span></label>
                                    <select class="form-input border-slate-300 focus:outline-none focus:border-custom-500"
                                        id="ceeexamsession" name="ceeexamsession" onchange="loadRooms()">
                                        <option value="">-Select Examination Session
                                        </option>
                                        <option value="batch 1">Batch 1 (6:00 AM - 9:00 AM)
                                        </option>
                                        <option value="batch 2">Batch 2 (10:00 AM - 1:00 PM)
                                        </option>
                                        <option value="batch 3">Batch 3 (2:00 PM - 5:00 PM)
                                        </option>
                                    </select>
                                </div><!--end col-->

                                <div class="xl:col-span-6">
                                    <label for="room" class="inline-block mb-2 text-base font-medium">Room
                                        Assignment<span class="text-red-500">*</span></label>
                                    <select id="room-select" name="room"
                                        class="form-input border-slate-300 focus:outline-none focus:border-custom-500">
                                        <option selected="true" disabled>Choose Room</option>
                                    </select>
                                </div>

                                <div class="xl:col-span-12 flex justify-end gap-2">
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
            @endif

        </div><!--end col-->
    </div><!--end grid-->
@endsection
@push('scripts')
    <!-- Include SweetAlert library -->
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

        document.addEventListener('DOMContentLoaded', function() {
            const campusSelect1 = document.getElementById('campus-select');
            const programSelect1 = document.getElementById('program-select');
            const firstPriorityDescInput = document.getElementById('firstprioprog_desc');

            const campusSelect2 = document.getElementById('campus-select2');
            const programSelect2 = document.getElementById('program-select2');
            const secondPriorityDescInput = document.getElementById('secondprioprog_desc');

            const campusSelect3 = document.getElementById('campus-select3');
            const programSelect3 = document.getElementById('program-select3');
            const thirdPriorityDescInput = document.getElementById('thirdprioprog_desc');


            function loadPrograms(campusSelect, programSelect) {
                const realCampusId = campusSelect.value;

                // Set termId based on the selected campus
                let termId;
                switch (realCampusId) {
                    case "1":
                        termId = 99;
                        break; // USM Main
                    case "3":
                        termId = 68;
                        break; // USM KCC
                    case "5":
                        termId = 99;
                        break; // PALMA
                    case "6":
                        termId = 68;
                        break; // Mlang
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
            });

            programSelect2.addEventListener('change', () => {
                const selectedOption = programSelect2.options[programSelect2.selectedIndex];
                secondPriorityDescInput.value = selectedOption.getAttribute('data-program-name');
            });

            programSelect3.addEventListener('change', () => {
                const selectedOption = programSelect3.options[programSelect3.selectedIndex];
                thirdPriorityDescInput.value = selectedOption.getAttribute('data-program-name');
            });
        });

        function loadRooms() {
            const ceesession = document.getElementById('ceeexamsession').value;
            const roomSelect = document.getElementById('room-select');

            // Clear current options
            roomSelect.innerHTML = '<option selected="true" disabled>Choose Room</option>';

            if (ceesession) {
                fetch(`/student/cee/rooms-by-session?ceesession=${ceesession}`, {
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        data.forEach(room => {
                            const option = document.createElement('option');
                            option.value = room.id;
                            option.textContent =
                                `${room.room_name} - ${room.college_name} - (Slots: ${room.capacity})`;
                            roomSelect.appendChild(option);
                        });
                    })
                    .catch(error => console.error('Error fetching rooms:', error));
            }
        }
    </script>
@endpush
