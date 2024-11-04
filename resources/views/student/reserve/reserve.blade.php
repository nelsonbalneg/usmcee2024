@extends('student.layouts.master')
@section('title')
    BMS - My Profile
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



            <div class="card">
                @if ($application)
                    <div class="card-body">


                        <h6 class="mb-1 text-5">RESERVATION DETAILS</h6>
                        <hr class="mb-2" />
                        <div style="height: 500px;">
                            <iframe src="https://localapps.usm.edu.ph/campus-nav" frameborder="0" height="100%"
                                width="100%"></iframe>
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
                    <br>

                    <div class="card-body">

                        <form action="{{ route('student.reserve.store') }}" method="POST">
                            @csrf
                            <h6 class="mb-1 text-5">RESERVATION DETAILS</h6>
                            <hr class="mb-2" />

                            <div class="xl:col-span-6">
                                <input type="hidden" name="ceesession"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    value="{{ $ceeSession->id }}" @readonly(true)>
                            </div><!--end col-->

                            <div class="grid grid-cols-1 gap-5 xl:grid-cols-12">

                                <h6 class="mt-2 text-5">Priority Programs</h6>

                                <div class="xl:col-span-12">
                                    <label for="campus" class="inline-block mb-2 text-base font-medium">Select Campus<span
                                            class="text-red-500">*</span></label>
                                    <select id="campus-select" name="campus" data-choices
                                        class="form-input border-slate-300 focus:outline-none focus:border-custom-500">
                                        <option selected="true" disabled>Choose Campus</option>
                                        {{--  USM-KCC 3, MAIN -1, PALMA-5 MLANG-6 --}}
                                        {{-- @foreach ($campusList as $campus)
                                        <option value="{{ $campus['campusName'] }}"
                                            data-campus-name="{{ $campus['campusName'] }}">{{ $campus['campusName'] }}
                                        </option>
                                    @endforeach --}}
                                        <option value="1">USM Main</option>
                                        <option value="3">USM KCC</option>
                                        <option value="5">USM PALMA CLUSTER</option>
                                        <option value="6">USM MLANG</option>

                                    </select>
                                </div>

                                <div class="xl:col-span-6">
                                    <label for="firstprioprog" class="inline-block mb-2 text-base font-medium">First
                                        Priority
                                        Program <span class="text-red-500">*</span></label>
                                    <select id="program-select" name="firstprioprog"
                                        class="form-input border-slate-300 focus:outline-none focus:border-custom-500">
                                        <option selected="true" disabled>Choose Program</option>
                                    </select>
                                </div>



                                <div class="xl:col-span-6">
                                    <label for="firstpriomajor" class="inline-block mb-2 text-base font-medium">Major
                                        In</label>
                                    <select id="major-select" name="firstpriomajor"
                                        class="form-input border-slate-300 focus:outline-none focus:border-custom-500">
                                        <option selected="true" disabled>Choose Major</option>
                                    </select>
                                </div>

                                <div class="xl:col-span-6">
                                    <label for="secondprioprog" class="inline-block mb-2 text-base font-medium">Second
                                        Priority
                                        Program <span class="text-red-500">*</span></label>
                                    <select id="program-select2" name="secondprioprog"
                                        class="form-input border-slate-300 focus:outline-none focus:border-custom-500">
                                        <option selected="true" disabled>Choose Program</option>
                                    </select>
                                </div>
                                <div class="xl:col-span-6">
                                    <label for="secondpriomajor" class="inline-block mb-2 text-base font-medium">Major
                                        In</label>
                                    <select id="major-select2" name="secondpriomajor"
                                        class="form-input border-slate-300 focus:outline-none focus:border-custom-500">
                                        <option selected="true" disabled>Choose Major</option>
                                    </select>
                                </div>

                                <div class="xl:col-span-6">
                                    <label for="thirdprioprog" class="inline-block mb-2 text-base font-medium">Third
                                        Priority
                                        Program <span class="text-red-500">*</span></label>
                                    <select id="program-select3" name="thirdprioprog"
                                        class="form-input border-slate-300 focus:outline-none focus:border-custom-500">
                                        <option selected="true" disabled>Choose Program</option>
                                    </select>
                                </div>
                                <div class="xl:col-span-6">
                                    <label for="thirdpriomajor" class="inline-block mb-2 text-base font-medium">Major
                                        In</label>
                                    <select id="major-select2" name="thirdpriomajor"
                                        class="form-input border-slate-300 focus:outline-none focus:border-custom-500">
                                        <option selected="true" disabled>Choose Major</option>
                                    </select>
                                </div>

                                <div class="xl:col-span-12">
                                    <h6 class="mt-2 text-5">Examination Details</h6>
                                </div>

                                <div class="xl:col-span-6">
                                    <label for="ceesession" class="inline-block mb-2 text-base font-medium">USMCEE Session
                                        <span class="text-red-500">*</span></label>
                                    <select class="form-input border-slate-300 focus:outline-none focus:border-custom-500"
                                        id="ceeexamsession" name="ceeexamsession" onchange="loadRooms()">
                                        <option value="">-Select Examination Session
                                        </option>
                                        <option value="session 1">Session 1 (6:00 AM - 9:00 AM)
                                        </option>
                                        <option value="session 2">Session 2 (10:00 AM - 1:00 PM)
                                        </option>
                                        <option value="session 3">Session 3 (1:00 PM - 4:00 PM)
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
                @endif








            </div><!--end card-->
        </div><!--end col-->
    </div><!--end grid-->
@endsection
@push('scripts')
    <!-- Include SweetAlert library -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('form').on('submit', function(event) {
                event.preventDefault(); // Prevent default submission

                // Show SweetAlert confirmation dialog
                Swal.fire({
                    title: 'Are you sure?',
                    text: "I confirm that all data has been reviewed and is accurate. I understand that once saved, I will no longer be able to edit the information.",
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
        document.getElementById('campus-select').addEventListener('change', function() {
            const campusSelect = document.getElementById('campus-select');
            const selectedOption = campusSelect.options[campusSelect.selectedIndex];
            const campusName = selectedOption.getAttribute('data-campus-name');
            let tenantId = campusName === 'USM-KCC' ? 3 : 1; // Default tenantId is 1 unless 'USM-KCC' is selected

            // Select all program dropdowns
            const programSelects = [
                document.getElementById('program-select'),
                document.getElementById('program-select2'),
                document.getElementById('program-select3')
            ];

            // Function to set inner HTML for all program selects
            const setInnerHTMLForAll = (htmlContent) => {
                programSelects.forEach(select => {
                    select.innerHTML = htmlContent;
                });
            };

            // Show loading message on all selects
            setInnerHTMLForAll('<option selected="true" disabled>Loading Programs...</option>');




            // Make the API call with the dynamic tenantId
            fetch(`/api/programs?tenantId=${tenantId}`)
                .then(response => response.json())
                .then(data => {
                    // Set default option after loading
                    setInnerHTMLForAll('<option selected="true" disabled>Choose Program</option>');

                    // Populate each program select with options
                    data.forEach(program => {
                        const option = document.createElement('option');
                        option.value = program.progName;
                        option.textContent = `${program.progCode} - ${program.progName}`;

                        programSelects.forEach(select => {
                            select.appendChild(option.cloneNode(
                                true)); // Clone to avoid reusing the same node
                        });
                    });


                })
                .catch(error => {
                    console.error('Error fetching programs:', error);
                    setInnerHTMLForAll('<option selected="true" disabled>Error loading programs</option>');
                });
        });

        function loadRooms() {
            console.log('loadRooms function called');
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
                        console.log(data); // Check data here
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
