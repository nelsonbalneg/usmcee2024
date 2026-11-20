@extends('admin.layouts.master')
@section('title')
    USM-AES | Reservations
@endsection

@push('styles')
    <link rel="stylesheet" src="{{ asset('backend/assets/toastify/toastify.min.css') }}" />
    <link rel="stylesheet" src="{{ asset('backend/assets/fa/fontawesome.min.css') }}" />
@endpush

@section('contents')
    <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
        <div class="grow">
            <h5 class="uppercase text-16">USM-Admission and Enrollment System</h5>
            <span
                class="delivery_status px-2.5 py-0.5 text-xs inline-block font-medium rounded border bg-green-100 border-green-200 text-green-500 dark:bg-green-500/20 dark:border-green-500/20">
                ACTIVE CEE EXAM TERM: {{ $activeSession->name }}</span>
        </div>
        <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="#!" class="text-slate-400 dark:text-zink-200">Reservations</a>
            </li>
        </ul>
    </div>

    <!--start grid-->
    <div class="grid grid-cols-1 gap-x-5 xl:grid-cols-12">
        <!--start col-->
        <div class="xl:col-span-12">
            <!--start card-->
            <div class="card" id="usersTable">
                <div class="card-body">
                    <div class="flex">
                        <h6 class="uppercase text-15 grow">All Reservation Records</h6>
                        <div class="flex items-center gap-2 space-x-4">
                            <!-- Create Reservation Button -->
                            <a type="button" href="{{ route('admin.reservation.create.index') }}" target="_blank"
                                class="flex items-center justify-center h-10 px-4 text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">
                                <i data-lucide="plus" class="inline-block size-4"></i>
                                <span class="align-middle">Create Reservation</span>
                            </a>

                            <!-- Dropdown for Filter -->
                            <div class="relative dropdown">
                                <button type="button"
                                    class="flex items-center justify-center p-0 bg-white size-8 text-slate-500 btn hover:text-slate-600 hover:bg-slate-100 focus:text-slate-600 focus:bg-slate-100 active:text-slate-700 active:bg-slate-200 dark:bg-zinc-700 dark:hover:bg-slate-500/10 dark:focus:bg-slate-500/10 dark:active:bg-slate-500/10 dropdown-toggle"
                                    id="dailyVisitInsightsDropdown" data-bs-toggle="dropdown">
                                    <i data-lucide="more-vertical" class="inline-block size-4"></i>
                                </button>

                                <ul class="absolute z-50 hidden py-2 mt-2 bg-white rounded-md shadow-md dropdown-menu min-w-[14rem] dark:bg-zinc-600"
                                    aria-labelledby="dailyVisitInsightsDropdown">
                                    <div class="px-3 py-2">
                                        <label for="cee-term-select"
                                            class="block text-sm font-medium text-slate-600 dark:text-white">
                                            Filter by CEE Terms
                                        </label>
                                        <select id="cee-term-select" name="cee_session_id" data-choices
                                            class="w-full mt-1 form-input border-slate-300 focus:outline-none focus:border-custom-500 min-w-[12rem]">
                                            <option disabled>Select Term</option>
                                            @foreach ($ceeSessions as $session)
                                                <option value="{{ $session->id }}"
                                                    {{ isset($activeSession) && $activeSession->id == $session->id ? 'selected' : '' }}>
                                                    {{ $session->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="border-dashed card-body border-y border-slate-200 dark:border-zink-500">
                    <table id="dbData" class="display stripe group" style="width:100%">
                        <thead>
                            <tr>
                                <th>Examinee Details</th>
                                <th>Schedule</th>
                                <th>SecondTaker?</th>
                                <th>Date Created</th>
                                <th>Status</th>
                                <th>Booklet</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div><!--end card-->
        </div><!--end col-->
    </div><!--end grid-->


    <!-- view Modal Structure -->
    <div id="viewModal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
        <div class="absolute inset-0 bg-gray-900 bg-opacity-50"></div> <!-- Overlay -->
        <div class="relative w-screen md:w-[30rem] bg-white shadow rounded-md dark:bg-zinc-600 z-10">
            <div class="flex items-center justify-between p-4 border-b dark:border-zinc-500">
                <h5 class="text-16">Priority Programs</h5>
                <button id="closeModalButton"
                    class="transition-all duration-200 ease-linear text-slate-400 hover:text-red-500">
                    <i data-lucide="x" class="size-5"></i>
                </button>
            </div>
            <div class="p-4">
                <form id="viewForm" method="POST">
                    @csrf
                    <div id="alert-error-msg"
                        class="hidden px-4 py-3 text-sm text-red-500 border border-transparent rounded-md bg-red-50 dark:bg-red-500/20">
                    </div>
                    <div class="grid grid-cols-1 gap-4 xl:grid-cols-12">

                        <div class="xl:col-span-12">
                            <label for="firstprio" class="inline-block mb-2 text-base font-medium">First Priority</label>
                            <input type="text" id="firstprio" name="firstprio"
                                class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                placeholder="LRN" value="{{ old('firstprio') }}">
                        </div>

                        <div class="xl:col-span-12">
                            <label for="secondprio" class="inline-block mb-2 text-base font-medium">Second Priority</label>
                            <input type="text" id="secondprio" name="secondprio"
                                class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                placeholder="First name" value="{{ old('secondprio') }}">
                        </div>
                        <div class="xl:col-span-12">
                            <label for="thirdpriorty_desc" class="inline-block mb-2 text-base font-medium">Third
                                Priority</label>
                            <input type="text" id="thirdpriorty_desc" name="thirdpriorty_desc"
                                class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                placeholder="Last name" value="{{ old('thirdpriorty_desc') }}">
                        </div>

                    </div>

                    <div class="flex justify-end gap-2 mt-4">
                        <button type="reset" id="closeModalButton" data-modal-close="addEmployeeModal"
                            class="text-red-500 bg-white btn hover:text-red-500 hover:bg-red-100 focus:text-red-500 focus:bg-red-100 active:text-red-500 active:bg-red-100 dark:bg-zink-600 dark:hover:bg-red-500/10 dark:focus:bg-red-500/10 dark:active:bg-red-500/10">Close</button>
                    </div>
            </div>

            </form>
        </div>
    </div>

    <!-- Add Booklet Number Structure -->
    <div id="addBooketNo" class="fixed inset-0 z-50 flex items-center justify-center hidden">
        <div class="absolute inset-0 bg-gray-900 bg-opacity-50"></div> <!-- Overlay -->
        <div class="relative w-screen md:w-[30rem] bg-white shadow rounded-md dark:bg-zinc-600 z-10">
            <div class="flex items-center justify-between p-4 border-b dark:border-zinc-500">
                <h5 class="text-16">Booklet Details</h5>
                <button id="closeModalButton"
                    class="transition-all duration-200 ease-linear text-slate-400 hover:text-red-500">
                    <i data-lucide="x" class="size-5"></i>
                </button>
            </div>
            <div class="p-4">
                <form id="addBookletForm" method="POST">
                    @csrf
                    <div id="alert-error-msg"
                        class="hidden px-4 py-3 text-sm text-red-500 border border-transparent rounded-md bg-red-50 dark:bg-red-500/20">
                    </div>
                    <div class="grid grid-cols-1 gap-4 xl:grid-cols-12">
                        <input type="hidden" id="user_id_for_booklet" name="user_id">
                        <input type="hidden" id="cee_session_id" name="cee_session_id">
                        <input type="hidden" id="app_no" name="app_no">

                        <div class="xl:col-span-12">
                            <label for="bookletNo" class="inline-block mb-2 text-base font-medium">Booklet
                                Number</label>
                            <input type="text" id="bookletNo" name="bookletNo"
                                class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                placeholder="Enter Booket Number " value="{{ old('bookletNo') }}" required>
                        </div>
                        <div class="xl:col-span-12">
                            <label for="envelopeNo" class="inline-block mb-2 text-base font-medium">Envelope
                                Number</label>
                            <input type="text" id="envelopeNo" name="envelopeNo"
                                class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                placeholder="Enter Envelop Number " value="{{ old('envelopeNo') }}" required>
                        </div>

                        <div class="xl:col-span-12">
                            <label for="revision_no" class="inline-block mb-2 text-base font-medium">Booklet Revision
                                Number</label>
                            <input type="text" id="revision_no" name="revision_no"
                                class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                placeholder="Enter Booklet Revision Number " value="{{ old('revision_no') }}">
                        </div>
                    </div>

                    <div class="flex justify-end gap-2 mt-4">
                        <button type="reset" id="closeModalButton" data-modal-close="addEmployeeModal"
                            class="text-red-500 bg-white btn hover:text-red-500 hover:bg-red-100 focus:text-red-500 focus:bg-red-100 active:text-red-500 active:bg-red-100 dark:bg-zink-600 dark:hover:bg-red-500/10 dark:focus:bg-red-500/10 dark:active:bg-red-500/10">Cancel</button>
                        <button type="submit" class="text-white bg-custom-500 btn hover:bg-custom-600">Save Booklet
                            Number</button>
                    </div>
                </form>
            </div>


        </div>
    </div>

    <!-- add Structure -->
    <div id="adjustRoomModal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
        <!-- Overlay -->
        <div class="absolute inset-0 bg-gray-900 bg-opacity-50"></div>

        <!-- Modal Content -->
        <div class="relative w-screen md:w-[30rem] bg-white shadow rounded-md dark:bg-zinc-600 z-10">
            <!-- Modal Header -->
            <div class="flex items-center justify-between p-4 border-b dark:border-zinc-500">
                <h5 class="font-semibold text-16">Adjust Room Assignment</h5>
                <button id="cancelAddModal" class="transition text-slate-400 hover:text-red-500">
                    <i data-lucide="x" class="size-5"></i>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="p-4">
                <form id="adjustForm" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 gap-4">

                        <input type="hidden" id="adjust_res_id" name="reservation_id">

                        <!-- Current room assignment -->
                        <div>
                            <span id="exam_venue"
                                class="mb-2 px-2.5 py-0.5 text-xs inline-block font-medium rounded border bg-purple-100 border-purple-200 text-purple-500 dark:bg-purple-500/20 dark:border-purple-500/20"></span>
                            <span id="exam_schedule"
                                class="delivery_status px-2.5 py-0.5 text-xs inline-block font-medium rounded border bg-sky-100 border-sky-200 text-sky-500 dark:bg-sky-500/20 dark:border-sky-500/20">
                            </span>
                        </div>

                        <!-- exam batch -->
                        <div>
                            <label for="ceeexamsession" class="block mb-2 text-base font-medium">Exam Batch</label>
                            <select class="form-input border-slate-300 focus:outline-none focus:border-custom-500"
                                id="ceeexamsession" name="ceeexamsession">
                                <option value="">--Select--</option>
                                <option value="Batch 1">Batch 1 (08:00 AM - 10:00 AM)
                                </option>
                                <option value="Batch 2">Batch 2 (11:00 AM - 01:00 PM)
                                </option>
                                <option value="Batch 3">Batch 3 (02:00 PM - 04:00 PM)
                                </option>
                                <option value="Batch 4">Batch 4 (06:00 PM - 08:00 PM)
                                </option>
                            </select>
                        </div>
                        <!-- college name -->
                        <div>
                            <label for="room" class="inline-block mb-2 text-base font-medium">New Room Assignment<sup
                                    class="text-red-500">* required</sup></label>
                            <select id="room-select" name="room"
                                class="form-input border-slate-300 focus:outline-none focus:border-custom-500">
                                <option selected="true" disabled>Choose Room</option>
                            </select>
                        </div>
                    </div>

                    <!-- Modal Footer -->
                    <div class="flex justify-end gap-2 mt-4">
                        <button type="reset" id="cancelAddModal"
                            class="text-red-500 bg-white btn hover:bg-red-100">Cancel</button>
                        <button type="submit" class="text-white bg-custom-500 btn hover:bg-custom-600">Save
                            Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('backend/assets/js/datatables/jquery-3.7.0.js') }}"></script>
    <script src="{{ asset('backend/assets/js/datatables/data-tables.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/datatables/data-tables.tailwindcss.min.js') }}"></script>

    <!-- Sweetalerts JS -->
    <script src="{{ asset('backend/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('backend/assets/toastify/toastify-js.min.js') }}"></script>
    {{-- <script>
        document.getElementById('dropdownButton').addEventListener('click', function() {
            const dropdownMenu = document.getElementById('dropdownMenu');
            dropdownMenu.classList.toggle('hidden');
        });
    </script> --}}

    <script>
        // send pdf copy of cee-slip entry
        $('body').on('click', '.send-email', function(event) {
            event.preventDefault();

            let deleteUrl = $(this).attr('href');

            Swal.fire({
                title: 'Are you sure?',
                text: "You are about to send CEE-slip via email.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Send it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'POST',
                        url: deleteUrl,
                        success: function(data) {
                            Swal.fire('Sent', data.message, 'success');
                        },
                        error: function(xhr, status, error) {
                            Swal.fire('Unable to Delete!',
                                'An error occurred while processing your request.',
                                'error');
                        }
                    });
                }
            });
        });
    </script>


    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $(document).ready(function() {
            loadData();
        });


        function loadData() {

            // Get default selected session
            let activeSessionId = $('#cee-term-select').val();

            // Get the page number from sessionStorage if available
            let currentPage = sessionStorage.getItem('currentPage') ? parseInt(sessionStorage.getItem('currentPage')) : 0;

            // Check if DataTable is already initialized and destroy it if it is
            if ($.fn.DataTable.isDataTable('#dbData')) {
                $('#dbData').DataTable().destroy();
            }

            var table = $('#dbData').DataTable({
                responsive: true,
                columnDefs: [{
                        width: "10%",
                        targets: [0]
                    },
                    {
                        className: "text-start custom-middle-align",
                        targets: [0, 1, 2, 3, 4, 5]
                    },
                ],
                language: {
                    "processing": `<div class="table-loader-wrapper"> <div class="loader"></div></div>`
                },
                processing: true,
                serverSide: true,
                deferRender: true, // Improves performance by delaying rendering
                ajax: {
                    url: "{{ route('admin.reservation.get-data') }}",
                    type: "GET",
                    dataType: "JSON",
                    data: function(d) {
                        d.cee_session_id = $('#cee-term-select').val() ||
                            activeSessionId; // Load selected or default session
                    }
                },
                columns: [{
                        data: 'fullname',
                        name: 'fullname'
                    },
                    {
                        data: 'college_name',
                        name: 'college_name'
                    },
                    {
                        data: 'is_repeat_exam',
                        name: 'is_repeat_exam'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        render: function(data, type, row) {
                            // Check if data is valid to avoid errors
                            if (!data) return '';

                            // Parse the date and set the timezone to Asia/Manila
                            const date = new Date(data);
                            const options = {
                                year: 'numeric',
                                month: 'short',
                                day: 'numeric',
                                hour: '2-digit',
                                minute: '2-digit',
                                second: '2-digit',
                                timeZone: 'Asia/Manila'
                            };

                            // Format date according to Asia/Manila timezone
                            return new Intl.DateTimeFormat('en-US', options).format(date);
                        }
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'bookletNo',
                        name: 'bookletNo'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                order: [
                    [3, "desc"]
                ],
                pageLength: 25, // Set default number of rows per page
                lengthMenu: [10, 25, 50, 100], // Allow users to select number of rows
                drawCallback: function() {
                    lucide.createIcons();
                },
                // Once the table is initialized, move to the stored page
                initComplete: function() {
                    if (currentPage) {
                        table.page(currentPage).draw('page');
                    }
                }
            });
            // Save the current page in sessionStorage when page changes
            table.on('page.dt', function() {
                let pageInfo = table.page.info();
                sessionStorage.setItem('currentPage', pageInfo.page);
            });

            // Save the current page in sessionStorage when search is initiated
            $('#dbData_filter input').on('input', function() {
                let searchValue = $(this).val();

                // If the search is cleared, use the stored page number
                if (searchValue === '') {
                    currentPage = sessionStorage.getItem('currentPage') ? parseInt(sessionStorage.getItem(
                        'currentPage')) : 0;
                    table.page(currentPage).draw(false);
                } else {
                    let pageInfo = table.page.info();
                    sessionStorage.setItem('currentPage', pageInfo.page);
                }
            });

            // Reload table when session is changed
            $('#cee-term-select').change(function() {
                table.ajax.reload(); // Refresh table based on new session ID
            });
        }

        // delete entry
        $('body').on('click', '.delete-reservation', function(event) {
            event.preventDefault();

            let deleteUrl = $(this).attr('href');

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'DELETE',
                        url: deleteUrl,
                        success: function(data) {
                            if (data.status == 'success') {
                                // Get the current page number
                                var table = $('#dbData').DataTable();
                                var currentPage = table.page();

                                Swal.fire('Deleted!', data.message, 'success')
                                    .then(() => {
                                        // Remove the row from the DataTable and redraw without changing the pagination
                                        table.row($(event.target).closest('tr')).remove()
                                            .draw(false);

                                        // Maintain the current page
                                        table.page(currentPage).draw(false);
                                    });
                            } else if (data.status == 'error') {
                                Swal.fire('Unable to Delete!', data.message, 'error');
                            }
                        },
                        error: function(xhr, status, error) {
                            Swal.fire('Unable to Delete!',
                                'An error occurred while processing your request.',
                                'error');
                        }
                    });
                }
            });
        });


        // Initialize modal open event using jQuery edit entry
        $('body').on('click', '.view-detail', function(event) {
            event.preventDefault();

            let id = $(this).data('id');
            let viewUrl = '/admin/reservation/view-details/' + id;

            $.ajax({
                url: viewUrl,
                method: 'GET',
                success: function(response) {

                    const campusNames = {
                        1: "USM-Main",
                        3: "USM KCC",
                        5: "USM PALMA CLUSTER",
                        6: "USM MLANG",
                        7: "USM Antipas",
                        8: "USM Pigcwayan"
                    };

                    //populate the select elements
                    let reservation = response.reservation;

                    const campusName1 = campusNames[reservation.campus_id] || "Unknown Campus";
                    const campusName2 = campusNames[reservation.campus_id_prio_prog_2] ||
                        "Unknown Campus";
                    const campusName3 = campusNames[reservation.campus_id_prio_prog_3] ||
                        "Unknown Campus";

                    // fill the values
                    $('#firstprio').val(reservation.firstpriorty_desc + ' (' + campusName1 + ')');
                    $('#secondprio').val(reservation.secondpriority_desc + ' (' + campusName2 + ')');
                    $('#thirdpriorty_desc').val(reservation.thirdpriorty_desc + ' (' + campusName3 +
                        ')');

                    $("#editModal").modal('show');
                },
                error: function(xhr, status, error) {
                    var errorMessage = xhr.responseJSON && xhr.responseJSON.message ?
                        xhr.responseJSON.message :
                        'An error occurred while processing your request.';
                    swal('Unable to Delete!', errorMessage, 'error');
                }
            })

            $('#viewModal').removeClass('hidden'); // Open modal
        });

        // Event delegation for dynamically loaded .change-status toggle buttons
        $('body').on('change', '.change-status', function() {
            let isChecked = $(this).is(':checked');
            let id = $(this).data('id');

            $.ajax({
                url: "{{ route('admin.reservation.cee-examinee-type.update') }}",
                method: 'PUT',
                data: {
                    status: isChecked,
                    id: id
                },
                success: function(data) {
                    Toastify({
                        text: '<i class="fas fa-check-circle" style="margin-right: 8px;"></i>' +
                            (data.message || "Status has been updated."),
                        duration: 3000,
                        gravity: "top",
                        position: "right",
                        backgroundColor: "#4CAF50",
                        className: "success",
                        escapeMarkup: false
                    }).showToast();
                },
                error: function(xhr, status, error) {
                    let errorMsg = "An error occurred.";
                    try {
                        const response = JSON.parse(xhr.responseText);
                        errorMsg = response.message || errorMsg;
                    } catch (e) {
                        // fallback
                    }

                    Toastify({
                        text: '<i class="fas fa-exclamation-circle" style="margin-right: 8px;"></i>' +
                            errorMsg,
                        duration: 3000,
                        gravity: "top",
                        position: "right",
                        backgroundColor: "#f56565",
                        className: "error",
                        escapeMarkup: false
                    }).showToast();
                }
            });
        });


        // JavaScript for closing the modal
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('viewModal');
            const closeModalButtons = modal.querySelectorAll('#closeModalButton');

            // Close Modal when clicking close buttons
            closeModalButtons.forEach(button => {
                button.addEventListener('click', () => {
                    modal.classList.add('hidden');
                });
            });

            // Close when clicking outside the modal content
            modal.addEventListener('click', (event) => {
                if (event.target === modal || event.target.classList.contains('bg-opacity-50')) {
                    modal.classList.add('hidden');
                }
            });
        });
    </script>

    <script>
        // Initialize modal open event using jQuery edit entry
        $('body').on('click', '.add_booklet_no', function(event) {
            event.preventDefault();

            let user_id = $(this).data('id');
            let cee_session_id = $(this).data('session-id'); // Corrected key
            let app_no = $(this).data('app-no'); // Correct

            $('#user_id_for_booklet').val(user_id);
            $('#cee_session_id').val(cee_session_id);
            $('#app_no').val(app_no);

            $('#addBooketNo').removeClass('hidden'); // Open modal
        });

        // JavaScript for closing the modal
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('addBooketNo');
            const closeModalButtons = modal.querySelectorAll('#closeModalButton');

            // Close Modal when clicking close buttons
            closeModalButtons.forEach(button => {
                button.addEventListener('click', () => {
                    modal.classList.add('hidden');
                });
            });

            // Close when clicking outside the modal content
            modal.addEventListener('click', (event) => {
                if (event.target === modal || event.target.classList.contains('bg-opacity-50')) {
                    modal.classList.add('hidden');
                }
            });
        });

        // Handle form submission
        $('#addBookletForm').submit(function(event) {
            event.preventDefault();

            let formData = {
                _token: $('input[name="_token"]').val(), // CSRF token
                user_id: $('#user_id_for_booklet').val(),
                cee_term_id: $('#cee_session_id').val(), // FIXED: Changed cee_session_id to cee_term_id
                app_no: $('#app_no').val(),
                bookletNo: $('#bookletNo').val(),
                envelopeNo: $('#envelopeNo').val(),
                revision_no: $('#revision_no').val(),
            };

            $.ajax({
                url: '{{ route('admin.cee.reservation.booklet.store') }}',
                method: 'POST',
                data: formData,
                success: function(response) {
                    Swal.fire('Success!', 'Booklet Number Saved Successfully!', 'success');
                    $('#addBooketNo').addClass('hidden'); // Close modal
                    $('#addBookletForm')[0].reset(); // Reset form
                },
                error: function(xhr) {
                    let errorMessage = xhr.responseJSON && xhr.responseJSON.message ?
                        xhr.responseJSON.message :
                        'An error occurred while saving.';
                    Swal.fire('Error!', errorMessage, 'error');
                }
            });
        });
    </script>

    <script>
        function updateStatus(id, status) {
            $.ajax({
                url: "{{ route('admin.update.reservation.status') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id,
                    status: status
                },
                success: function(response) {
                    // Display the success message using Toastify
                    Toastify({
                        text: '<i class="fas fa-check-circle" style="margin-right: 8px;"></i>' +
                            (response.message || "Status has been updated"),
                        duration: 3000,
                        gravity: "top",
                        position: "right",
                        backgroundColor: "#4CAF50", // Green for success
                        className: "success",
                        escapeMarkup: false
                    }).showToast();
                },
                error: function(xhr) {
                    alert("Something went wrong!");
                }
            });
        }
    </script>

    {{-- script for room adjustment --}}
    <script>
        // Initialize modal open event using jQuery edit entry
        $('body').on('click', '.adjust-room', function(event) {
            event.preventDefault();

            let id = $(this).data('id');
            let editUrl = '/admin/cee/room-adjust/' + id + '/edit';

            $.ajax({
                url: editUrl,
                method: 'GET',
                success: function(response) {

                    //populate the select elements
                    let reservationDetails = response.reservationDetails;
                    let roomDetails = response.roomDetails;

                    // fill the values
                    $('#adjust_res_id').val(reservationDetails.id);
                    $('#exam_venue')
                        .text(
                            `${roomDetails.campus} - ${roomDetails.college_name} - ${roomDetails.room_name}`
                        ),
                        $('#exam_schedule')
                        .text(
                            `${roomDetails.exam_session} - ${roomDetails.schedule} [${roomDetails.time}]`
                        )
                },
                error: function(xhr, status, error) {
                    var errorMessage = xhr.responseJSON && xhr.responseJSON.message ?
                        xhr.responseJSON.message :
                        'An error occurred while processing your request.';
                    swal('Unable to Delete!', errorMessage, 'error');
                }
            });
            $('#adjustRoomModal').removeClass('hidden'); // Open modal
        });

        // JavaScript for closing the modal
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('adjustRoomModal');
            const closeModalButtons = modal.querySelectorAll('#cancelAddModal');

            // Close Modal when clicking close buttons
            closeModalButtons.forEach(button => {
                button.addEventListener('click', () => {
                    modal.classList.add('hidden');
                });
            });

            // Close when clicking outside the modal content
            modal.addEventListener('click', (event) => {
                if (event.target === modal || event.target.classList.contains('bg-opacity-50')) {
                    modal.classList.add('hidden');
                }
            });
        });

        //update form
        $('#adjustForm').submit(function(event) {
            event.preventDefault();

            // Get form data
            var formData = $(this).serialize();
            var reservationId = $('#adjust_res_id').val();

            // AJAX PUT request for updating data
            $.ajax({
                url: '/admin/cee/room-adjust/' + reservationId,
                method: 'POST', // Use POST method
                data: formData, // Send _method=PUT parameter
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    $('#adjustRoomModal').addClass('hidden');

                    Swal.fire("Success", data.message, 'success', {
                        button: true,
                        button: "OK"
                    });

                    // Reload or redraw the table (if using DataTables)
                    if ($.fn.DataTable.isDataTable('#dbData')) {
                        $('#dbData').DataTable().ajax.reload(null,
                            false); // false = retain pagination
                    } else {
                        location.reload(); // Fallback to full page reload if not using DataTables
                    }
                },
                error: function(xhr, status, error) {
                    var response = xhr.responseJSON; // Parse the JSON error response

                    if (response && response.errors) {
                        // Loop through each validation error and display them as individual alerts
                        let errorMessages = '';
                        Object.values(response.errors).forEach(function(errorArray) {
                            errorMessages += errorArray.join('<br>') +
                                '<br>'; // Concatenate error messages
                        });

                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            html: errorMessages, // Use `html` to display formatted error list
                            confirmButtonText: 'OK',
                        });
                    } else {
                        // General error (e.g., server error)
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'An unexpected error occurred. Please try again later.',
                            confirmButtonText: 'OK',
                        });
                    }
                }
            });
        });
    </script>

    {{-- room select room adjustment --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const roomSelect = document.getElementById('room-select');
            const ceeSessionSelect = document.getElementById('ceeexamsession');
            let choicesInstance;

            // Define the loadRooms function to reset and fetch rooms
            function loadRooms() {
                const ceesession = ceeSessionSelect.value;

                // Clear any previous selection in room-select and reset it
                if (choicesInstance) {
                    console.log('Destroying existing Choices instance');
                    choicesInstance.destroy();
                    choicesInstance = null; // Clear reference to allow reinitialization
                }

                // Clear roomSelect options directly
                roomSelect.innerHTML = '<option value="" disabled selected>Choose Room</option>';
                roomSelect.value = ''; // Clear any selected value in the DOM

                // Reinitialize Choices.js with custom templates for styling
                choicesInstance = new Choices(roomSelect, {
                    searchEnabled: true,
                    // placeholderValue: 'Choose Room',
                    noResultsText: 'No rooms available',
                    callbackOnCreateTemplates: function(template) {
                        return {
                            item: (classNames, data) => {
                                // Customize the selected item rendering
                                return template(`
                            <div class="${classNames.item} ${
                            data.highlighted
                                ? classNames.highlightedState
                                : classNames.itemSelectable
                        }" data-item data-id="${data.id}" data-value="${data.value}" ${
                            data.active ? 'aria-selected="true"' : ''
                        }>
                                ${data.label}
                            </div>
                        `);
                            },
                            choice: (classNames, data) => {
                                // Customize the dropdown options rendering
                                return template(`
                            <div class="${classNames.item} ${
                            classNames.itemChoice
                        } ${data.disabled ? classNames.itemDisabled : ''}" data-select-text="${
                            this.config.itemSelectText
                        }" data-choice ${
                            data.disabled
                                ? 'data-choice-disabled aria-disabled="true"'
                                : 'data-choice-selectable'
                        } data-id="${data.id}" data-value="${data.value}" ${
                            data.groupId > 0 ? 'role="treeitem"' : 'role="option"'
                        }>
                                <span style="color: ${
                                  data.customProperties?.color || 'black'
                                };">${data.label}</span>
                            </div>
                        `);
                            },
                        };
                    },
                });

                // If a batch session is selected, fetch room data
                if (ceesession) {
                    fetch(`/admin/cee/rooms-by-session?ceesession=${ceesession}`, {
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                    'content'
                                ),
                            },
                        })
                        .then((response) => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then((data) => {
                            const roomOptions = data.map((room) => ({
                                value: room.id,
                                label: `[${room.exam_session}] ${room.room_name} - ${room.college_name} - (Slots: ${room.capacity})`,
                                customProperties: {
                                    color: room.status === 'active' ? 'green' : 'red',
                                },
                            }));
                            // Populate the dropdown with fetched room data
                            choicesInstance.setChoices(roomOptions, 'value', 'label', true);
                        })
                        .catch((error) => console.error('Error fetching rooms:', error));
                }
            }

            // Attach the loadRooms function to the onchange event of ceeexamsession select
            ceeSessionSelect.addEventListener('change', loadRooms);
        });
    </script>
@endpush
