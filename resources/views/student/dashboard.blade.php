@extends('student.layouts.master')
@section('title')
    USMCEE - My Profile
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endpush

@section('contents')
    <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
        <div class="grow">
            <h5 class="text-16">USMCEE 4.0 Dashboard</h5>
        </div>
        <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="#!" class="text-slate-400 dark:text-zink-200">Home</a>
            </li>
            <li class="text-slate-700 dark:text-zink-100">
                Dashboard
            </li>
        </ul>
    </div>

    <!--start grid-->
    <div class="grid grid-cols-1 xl:grid-cols-12 gap-x-5">

        <div class="xl:col-span-4">

            <a href="https://drive.google.com/file/d/17K7A0XK0fkGALONUxJ28UxNs40-d5zTB/view?usp=sharing"
                class="block w-full mt-2 mb-2 text-white border-custom-500 bg-custom-500 btn hover:text-white hover:bg-custom-600 hover:yellow-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/10">
                <i data-lucide="book" class="inline-block h-4 align-middle"></i>
                Download the Preregistration Guide
            </a>

            <div class="card sticky top-[calc(theme('spacing.header')_*_1.3)]">
                <div class="card-body">
                    <h6 class="mb-4 text-15">MY PROFILE</h6>

                    <div class="px-4 rounded-md py-7 bg-sky-50 dark:bg-zinc-600">
                        <img src="{{ asset($studentdetails->photo) }}" alt="Student Photo"
                            class="block mx-auto border border-gray-300 rounded-full h-s">
                    </div>
                    <div class="mt-3">
                        <h5 class="mb-0 text-blue-500 uppercase">{{ $studentdetails->lastname }},
                            {{ $studentdetails->firstname }}
                            {{ $studentdetails->middlename }} {{ $studentdetails->suffix }}</h5>
                        <p class="text-slate-500 dark:text-zink-200">
                            <i data-lucide="mail" class="inline-block size-4 text-slate-500 dark:text-zink-200"></i>
                            {{ $studentdetails->email }}
                        </p>
                        <p class="text-slate-500 dark:text-zink-200">
                            <i data-lucide="phone" class="inline-block size-4 text-slate-500 dark:text-zink-200"></i>
                            {{ $studentdetails->phone }}
                        </p>
                        <p class="text-slate-500 dark:text-zink-200">
                            <i data-lucide="calendar" class="inline-block size-4 text-slate-500 dark:text-zink-200"></i>
                            {{ \Carbon\Carbon::parse($studentdetails->birthdate)->format('F j, Y') }}
                        </p>
                    </div>
                </div>
            </div><!--end card-->
        </div><!--end col-->

        <div class="xl:col-span-4">
            <div
                class="order-1 md:col-span-6 lg:col-span-3 col-span-12 2xl:order-1 bg-green-100 dark:bg-green-500/20 card 2xl:col-span-2 group-data-[skin=bordered]:border-green-500/20 relative overflow-hidden">
                <div class="card-body">
                    <i data-lucide="clock"
                        class="absolute top-0 stroke-1 size-32 text-green-200/50 dark:text-green-500/20 ltr:-right-10 rtl:-left-10"></i>
                    <div class="flex items-center justify-center bg-green-500 rounded-md size-12 text-15 text-green-50">
                        <i data-lucide="clock"></i>
                    </div>
                    <p class="mt-2 text-lg font-semibold">
                        <span id="current-date" class="block"></span>
                        <span id="current-time" class="block"></span>
                    </p>
                    <p class="text-slate-500 dark:text-slate-200">Date and Time Today</p>

                </div>
            </div><!--end col-->

            <div
                class="order-2 md:col-span-6 lg:col-span-3 col-span-12 2xl:order-1 bg-orange-100 dark:bg-orange-500/20 card 2xl:col-span-2 group-data-[skin=bordered]:border-orange-500/20 relative overflow-hidden">
                <div class="card-body">
                    <i data-lucide="message-circle-more"
                        class="absolute top-0 stroke-1 size-32 text-orange-200/50 dark:text-orange-500/20 ltr:-right-10 rtl:-left-10"></i>
                    <h5 class="mt-1 mb-2">“Education is one thing no one can take away from you.”</h5>
                    <p class="text-slate-500 dark:text-slate-200">Elin Nordegren</p>
                </div>
            </div><!--end col-->

            <div
                class="order-3 md:col-span-6 lg:col-span-3 col-span-12 2xl:order-1 bg-sky-100 dark:bg-sky-500/20 card 2xl:col-span-2 group-data-[skin=bordered]:border-sky-500/20 relative overflow-hidden">
                <div class="card-body">
                    <i data-lucide="list-filter"
                        class="absolute top-0 stroke-1 size-32 text-sky-200/50 dark:text-sky-500/20 ltr:-right-10 rtl:-left-10"></i>
                    <div class="flex items-center justify-center rounded-md size-12 bg-sky-500 text-15 text-sky-50">
                        <i data-lucide="coins"></i>
                    </div>
                    <h5 class="mt-5 mb-2">{{ \Carbon\Carbon::parse($studentdetails->last_seen)->format('F j, Y h:i A') }}
                    </h5>
                    <p class="text-slate-500 dark:text-slate-200">Last Logged in</p>
                </div>
            </div><!--end col-->


        </div>

        @if ($applicant)
            <div class="xl:col-span-4">
                {{-- Profile Staatuss --}}
                <h5 class="mb-2 uppercase">Pre-registration Quick Information</h5>
                <div class="card">
                    <div class="flex items-center gap-3 card-body">

                        @if ($applicant->applicant_profile_status == 1)
                            <div
                                class="flex items-center justify-center text-green-500 bg-green-100 rounded-md size-12 text-15 dark:bg-green-500/20 shrink-0">
                                <i data-lucide="check-circle"></i>
                            </div>
                            <div class="grow">
                                <h5 class="mb-1 text-16"><span>Published</span></h5>
                                <p class="text-slate-500 dark:text-zink-200">Student Profile Status</p>
                            </div>
                        @else
                            <div
                                class="flex items-center justify-center text-yellow-500 bg-yellow-100 rounded-md size-12 text-15 dark:bg-yellow-500/20 shrink-0">
                                <i data-lucide="square-pen"></i>
                            </div>
                            <div class="grow">
                                <h5 class="mb-1 text-16"><span>Draft</span></h5>
                                <p class="text-slate-500 dark:text-zink-200">Student Profile Status</p>
                            </div>
                        @endif

                    </div>
                </div>
                {{-- Program --}}
                <div class="card">
                    <div class="flex items-center gap-3 card-body">
                        <div
                            class="flex items-center justify-center text-green-500 bg-green-100 rounded-md size-12 text-15 dark:bg-green-500/20 shrink-0">
                            <i data-lucide="graduation-cap"></i>
                        </div>
                        <div class="grow">
                            <h5 class="mb-1 text-16">
                                @if ($applicant->policyId == null && $applicant->programName != null)
                                    You did not qualify for <span
                                        class="text-custom-500">{{ !empty($applicant->programName) ? $applicant->programName : '' }}
                                        -
                                        {{ !empty($applicant->majorDiscDesc) ? $applicant->majorDiscDesc : '' }}</span>
                                    based on your ranking. <br><br> Tap or Click the <a class="text-green-500"
                                        href="{{ route('student.cee.result') }}">Result </a> Menu to select other program.
                                @elseif ($applicant->prereg_status == 'for_ranking' && $applicant->campus_id == null)
                                    ---
                                @else
                                    {{ !empty($applicant->programName) ? $applicant->programName : '' }} -
                                    {{ !empty($applicant->majorDiscDesc) ? $applicant->majorDiscDesc : '' }}
                                @endif
                            </h5>
                            <p class="text-slate-500 dark:text-zink-200">Program Name</p>
                        </div>
                    </div>
                </div>

                {{-- Prereg staus --}}
                <div class="card">
                    <div class="flex items-center gap-3 card-body">
                        <div
                            class="flex items-center justify-center text-purple-500 bg-purple-100 rounded-md size-12 text-15 dark:bg-purple-500/20 shrink-0">
                            <i data-lucide="history"></i>
                        </div>
                        <div class="grow">
                            {{--  {{ !empty($applicant->prereg_status) ? $applicant->prereg_status : '---' }} --}}

                            <h5 class="mb-1 text-16">
                                @if ($applicant->prereg_status == 'pending')
                                    Program has been confirmed for enrollment.
                                    @if ($applicant->is_answered_nstp == 1)
                                        <br>
                                        <span
                                            class="mb-2 px-2.5 py-0.5 inline-block text-[11px] font-medium rounded border bg-green-100 border-transparent text-green-500 dark:bg-green-500/20 dark:border-transparent">
                                            NSTP PREFERENCE: {{ $applicant->nstp == 1 ? 'CWTS' : 'ROTC' }}
                                        </span>
                                    @endif
                                    <span
                                        class="px-2.5 py-0.5 inline-block text-[11px] font-medium rounded border bg-purple-100 border-transparent text-purple-500 dark:bg-purple-500/20 dark:border-transparent">
                                        Submit the original copies of the pertinent requirements to the
                                        <b class="text-purple-500">Admission and Records Office (ARO)</b> on or before May
                                        16, 2025.
                                        Submission may be done in person or via courier.
                                    </span>
                                @elseif ($applicant->prereg_status == 'for_ranking' && $applicant->campus_id != null)
                                    Please wait, ranking in progress.
                                @elseif ($applicant->prereg_status == 'for_ranking' && $applicant->campus_id == null)
                                    Please confirm the program.
                                @elseif ($applicant->policyId == null && $applicant->programName != null)
                                    You did not qualify for the chosen program based on your ranking
                                @else
                                    ---
                                @endif
                            </h5>
                            <p class="text-slate-500 dark:text-zink-200">Pre-registration Status</p>
                        </div>
                    </div>
                </div>

                {{-- id Number --}}
                <div class="card">
                    <div class="flex items-center gap-3 card-body">
                        <div
                            class="flex items-center justify-center rounded-md size-12 text-sky-500 bg-sky-100 text-15 dark:bg-sky-500/20 shrink-0">
                            <i data-lucide="id-card"></i>
                        </div>
                        <div class="grow">
                            <h5 class="mb-1 text-16">{{ !empty($applicant->student_no) ? $applicant->student_no : '---' }}
                            </h5>
                            <p class="text-slate-500 dark:text-zink-200">Student ID Number</p>
                        </div>
                    </div>
                </div>
            </div>

            @if ($applicant->prereg_status == 'pending' && $applicant->is_answered_nstp == 0)
                <!-- Modal Structure -->
                <div id="nstpModal" class="fixed inset-0 z-50 flex items-center justify-center hidden ">
                    <div class="absolute inset-0 bg-gray-900 bg-opacity-50"></div> <!-- Overlay -->
                    <div class="relative w-screen md:w-[30rem] bg-white shadow rounded-md dark:bg-zinc-600 z-10">
                        <div
                            class="relative flex items-center justify-center p-4 bg-green-500 border-b dark:border-zinc-500">
                            <h5 class="w-full text-center text-white uppercase text-16">National Service Training Program
                                (NSTP)</h5>
                            <!-- X Button -->
                            <button id="closeModalBtn"
                                class="absolute hidden text-xl font-bold text-white top-3 right-3 hover:text-gray-200 focus:outline-none">
                                &times;
                            </button>
                        </div>
                        <div class="p-4 text-center">
                            <div class="xl:col-span-12">
                                <div
                                    class="px-4 py-3 text-sm text-green-500 border border-transparent rounded-md bg-green-50 dark:bg-green-400/20">
                                    <div class="items-center">
                                        <ul class="ml-2 list-disc list-inside">
                                            <p>
                                                <strong>The National Service Training Program (NSTP)</strong> is a
                                                Philippine program aimed at enhancing civic consciousness, defense
                                                preparedness, and the ethics of service and patriotism among the youth. It
                                                is a requirement for students in Philippine higher education and
                                                technical-vocational institutions.
                                            </p>
                                            <br>
                                            <p>
                                                As part of this update, we kindly ask all confirmed enrollees to select
                                                their NSTP preference below.
                                            </p>
                                            <br>

                                            <div class="mb-2 xl:col-span-6">
                                                <label for="nstp" class="block mb-2 text-base font-medium">
                                                    What is your NSTP peference?<sup class="text-red-500">* required</sup>
                                                </label>
                                                <select name="nstp" id="nstpSelect"
                                                    class="w-full p-2 transition duration-200 ease-in-out border rounded-md border-custom-300 focus:ring-custom-500 focus:border-custom-500"
                                                    data-choices>
                                                    <option value="1"
                                                        {{ $applicant->nstp == '1' ? 'selected' : '' }}>Civic Welfare
                                                        Training Service (CWTS)
                                                    </option>
                                                    <option value="2"
                                                        {{ $applicant->nstp == '2' ? 'selected' : '' }}>Reserve Officers'
                                                        Training Corps (ROTC)
                                                    </option>
                                                </select>
                                            </div>

                                            <button id="saveNstpPref"
                                                class="block w-full text-white bg-green-500 border-green-500 btn hover:text-white hover:bg-green-600 hover:border-green-600 focus:text-white focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-100 active:text-white active:bg-green-600 active:border-green-600 active:ring active:ring-green-100 dark:ring-green-400/10">
                                                Save
                                            </button>

                                        </ul>
                                    </div>

                                </div>
                            </div>
                            <button id="okButton"
                                class="hidden w-full mt-4 text-white border-slate-500 bg-slate-500 btn hover:text-white hover:bg-slate-600 hover:border-slate-600 focus:text-white focus:bg-slate-600 focus:border-slate-600 focus:ring focus:ring-slate-100 active:text-white active:bg-slate-600 active:border-slate-600 active:ring active:ring-slate-100 dark:ring-slate-400/10">
                                Close
                            </button>
                        </div>
                    </div>
                </div>

                @push('scripts')
                    {{-- this scipt is for pop up to update the applicant type --}}
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const modal = document.getElementById('nstpModal');
                            const overlay = modal.querySelector('.bg-gray-900'); // Overlay element
                            const okButton = document.getElementById('okButton');

                            // Show the modal when the page loads
                            modal.classList.remove('hidden');

                            // Prevent closing when clicking outside the modal
                            overlay.addEventListener('click', function(event) {
                                event.stopPropagation(); // Prevent the click from closing the modal
                            });

                            // Close modal when OK button is clicked
                            okButton.addEventListener('click', function() {
                                modal.classList.add('hidden');
                            });
                        });
                    </script>
                @endpush
            @endif
        @endif

        @if ($isreservation_exist > 0)
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
                </div>
            </div>
        @endif



    </div><!--end grid-->
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

    <script>
        function updateClock() {
            const now = new Date();

            const dateOptions = {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            };
            const timeOptions = {
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                hour12: true
            };

            document.getElementById('current-date').textContent = now.toLocaleDateString('en-US', dateOptions);
            document.getElementById('current-time').textContent = now.toLocaleTimeString('en-US', timeOptions);
        }

        setInterval(updateClock, 1000);
        updateClock(); // run once on load
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('nstpModal');
            const overlay = modal.querySelector('.bg-gray-900');
            const saveButton = document.getElementById('saveNstpPref');



            // Prevent closing when clicking outside the modal
            overlay.addEventListener('click', function(event) {
                event.stopPropagation();
            });

            // Save button click handler
            saveButton.addEventListener('click', function() {
                const selectedNSTP = document.getElementById('nstpSelect').value;

                fetch('{{ route('student.applicant-profile.nstp-pref.save') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            nstp: selectedNSTP
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Display the success message using Toastify
                            Toastify({
                                text: '<i class="fas fa-check-circle" style="margin-right: 8px;"></i>' +
                                    (data.message || "NSTP preference has been updated"),
                                duration: 3000,
                                gravity: "center",
                                position: "right",
                                backgroundColor: "#4CAF50", // Green for success
                                className: "success",
                                escapeMarkup: false
                            }).showToast();

                            const okButton = document.getElementById('closeModalBtn');
                            okButton.classList.remove('hidden');

                            closeModalBtn.addEventListener('click', function() {
                                modal.classList.add('hidden');
                            });

                            // Optional: disable the Save button to prevent resubmission
                            saveButton.disabled = true;

                        } else {
                            alert('Error: ' + data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Request failed:', error);
                        alert('An unexpected error occurred.');
                    });
            });
        });
    </script>
@endpush
