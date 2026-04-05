@extends('student.layouts.master')
@section('title')
    USMCEE - Account Information
@endsection

@push('styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
@endpush

@section('contents')

    <x-page-header title="USMCEE - Profile" subtitle="Manage your personal profile" :breadcrumbs="[['label' => 'Home', 'url' => route('dashboard')], ['label' => 'My Profile', 'url' => '#!']]" />

    <!--start grid-->
    <div class="grid grid-cols-1 gap-x-5 xl:grid-cols-12">
        <!--start col-->
        <div class="xl:col-span-12">
            <!--start card-->

            <div class="card">
                <div class="card-body">

                    <div class="grid grid-cols-1 gap-5 lg:grid-cols-12 2xl:grid-cols-12">

                        <form id="profile-form"
                            action="{{ route('student.cee.update-photo', ['id' => $studentdetails->id]) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="lg:col-span-2 2xl:col-span-1">
                                <div
                                    class="relative inline-block rounded-full shadow-md size-21 bg-slate-100 profile-user xl:size-28">
                                    @if (empty($studentdetails->photo))
                                        <img src="data:image/jpeg;base64,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"
                                            alt="" name='photo'
                                            class="object-cover w-full h-full rounded-full user-profile-image">
                                    @else
                                        <img src="{{ asset($studentdetails->photo) }}" alt=""
                                            class="object-cover w-full h-full rounded-full user-profile-image">
                                    @endif
                                    <div
                                        class="absolute bottom-0 flex items-center justify-center rounded-full size-8 ltr:right-0 rtl:left-0 profile-photo-edit">
                                        <input id="profile-img-file-input" name="photo" type="file"
                                            class="hidden profile-img-file-input">
                                        <label for="profile-img-file-input"
                                            class="flex items-center justify-center bg-white rounded-full shadow-lg cursor-pointer size-8 dark:bg-zink-600 profile-photo-edit">
                                            <i data-lucide="image-plus"
                                                class="size-4 text-slate-500 fill-slate-200 dark:text-zink-200 dark:fill-zink-500"></i>
                                        </label>
                                    </div>
                                </div>
                            </div><!--end col-->

                        </form>



                        <div class="lg:col-span-10 2xl:col-span-9">
                            <h5 class="mb-1">Hi! {{ $studentdetails->firstname }} {{ $studentdetails->middlename }}
                                {{ $studentdetails->lastname }} {{ $studentdetails->ssuffix }} <i data-lucide="badge-check"
                                    class="inline-block size-4 text-sky-500 fill-sky-100 dark:fill-custom-500/20"></i>
                            </h5>
                            <div class="flex gap-3 mb-4">
                                <p class="text-slate-500 dark:text-zink-200"><i data-lucide="phone"
                                        class="inline-block size-4 ltr:mr-1 rtl:ml-1 text-slate-500 dark:text-zink-200 fill-slate-100 dark:fill-zink-500"></i>
                                    {{ $studentdetails->phone }}</p>
                                <p class="text-slate-500 dark:text-zink-200"><i data-lucide="mail"
                                        class="inline-block size-4 ltr:mr-1 rtl:ml-1 text-slate-500 dark:text-zink-200 fill-slate-100 dark:fill-zink-500"></i>
                                    {{ $studentdetails->email }}</p>

                                <p class="text-slate-500 dark:text-zink-200"><i data-lucide="calendar-days"
                                        class="inline-block size-4 ltr:mr-1 rtl:ml-1 text-slate-500 dark:text-zink-200 fill-slate-100 dark:fill-zink-500"></i>
                                    {{ $studentdetails->birthdate }}</p>
                            </div>
                            <p class="text-slate-500 dark:text-zink-200"><i data-lucide="info"
                                    class="inline-block text-orange-500 size-4 fill-orange-100 dark:fill-orange-500/20"></i>
                                Please take time to complete your profile to be able to reserve a slot in USM-CEE for
                                <b>{{ $ceeActiveession->name }}</b>.
                            </p>
                            <p class="text-orange-500 text-slate-500 dark:text-zink-200"><i data-lucide="info"
                                    class="inline-block text-orange-500 size-4 fill-orange-100 dark:fill-orange-500/20"></i>
                                Please
                                ensure that you provide
                                accurate and
                                correct information.</p>
                            <p class="text-orange-500 text-slate-500 dark:text-zink-200"><i data-lucide="info"
                                    class="inline-block text-orange-500 size-4 fill-orange-100 dark:fill-orange-500/20"></i>
                                Double-check
                                all details before submitting, as you will not be able to edit them once saved.</p>
                        </div>
                    </div><!--end grid-->
                </div>
            </div><!--end card-->

            <div class="mb-3">
                <ul
                    class="inline-flex flex-wrap items-center gap-2 p-3 text-sm font-normal bg-green-100 rounded dark:bg-zink-600">

                    <li
                        class="relative before:content-['\ea54'] before:font-remix before:ltr:-right-1 before:rtl:-left-1 before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:rtl:rotate-180 before:text-slate-500 dark:before:text-zink-200">
                        <a href="{{ route('student.profile.index') }}"
                            class="flex items-center gap-1 text-slate-700 dark:text-zink-400">

                            @if (!empty($studentdetails?->schoolid) && !empty($studentdetails?->applicant_type))
                                <i data-lucide="circle-check" class="text-green-600 size-4"></i>
                            @else
                                <i data-lucide="circle" class="size-3"></i>
                            @endif

                            Account Information
                        </a>
                    </li>
                    @if (!empty($studentdetails?->schoolid) && !empty($studentdetails?->applicant_type))
                        <li class="flex items-center gap-1 text-slate-200 dark:text-zink-100">
                            <a href="{{ route('student.ched-applicant-profile.index') }}"
                                class="flex items-center gap-1 text-slate-400 dark:text-zink-100">
                                @if ($ched_applicant_Profile?->status == 1 && $ched_applicant_Profile?->user_id)
                                    <i data-lucide="circle-check" class="text-green-400 size-4"></i>
                                @else
                                    <i data-lucide="circle" class="size-3"></i>
                                @endif

                                Personal Information
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('student.profile.update', ['profile' => $studentdetails->id]) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 gap-5 xl:grid-cols-12">

                            <div class="xl:col-span-12">
                                <div
                                    class="flex gap-3 p-4 text-sm text-green-500 rounded-md bg-green-50 dark:bg-green-400/20">
                                    <i data-lucide="alert-circle" class="inline-block size-4 mt-0.5 shrink-0"></i>
                                    <div>
                                        <h6 class="mb-1">Prohibition Against Fraud and Misrepresentation</h6>
                                        <ul class="ml-2 list-disc list-inside">
                                            <li>Providing an incorrect LRN or School ID violates university policy,
                                                compromising academic integrity and the security of student records. </li>
                                            <li>
                                                Such misrepresentation may incur penalties under Articles 172 and 315 of the
                                                Revised Penal Code.
                                            </li>
                                            <li>
                                                USM reserves the right to take disciplinary and legal actions, including
                                                denial of admission and potential prosecution under Philippine law.
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4 xl:col-span-6">
                                <label for="apptype" class="block mb-2 text-base font-medium">
                                    Applicant Type<sup class="text-red-500">* required</sup>
                                </label>
                                <select id="apptype-select" name="apptype"
                                    class="w-full p-2 transition duration-200 ease-in-out border rounded-md border-slate-300 focus:ring-green-500 focus:border-green-500"
                                    onchange="setLRNBasedOnApplicantType()" data-choices>
                                    <option value="" {{ $studentdetails->applicant_type == '' ? 'selected' : '' }}
                                        disabled>--Select--</option>
                                    <option value="transferee"
                                        {{ $studentdetails->applicant_type == 'transferee' ? 'selected' : '' }}>Transferee
                                    </option>
                                    <option value="shs"
                                        {{ $studentdetails->applicant_type == 'shs' ? 'selected' : '' }}>SHS
                                        Graduate/Graduating</option>
                                    <option value="second_courser"
                                        {{ $studentdetails->applicant_type == 'second_courser' ? 'selected' : '' }}>Second
                                        Courser
                                    </option>
                                    <option value="hs_grad"
                                        {{ $studentdetails->apapplicant_type == 'hs_grad' ? 'selected' : '' }}>
                                        High School Graduate</option>
                                    <option value="shiftee"
                                        {{ $studentdetails->applicant_type == 'shiftee' ? 'selected' : '' }}>
                                        Shiftee</option>
                                </select>
                            </div>
                            <div class="xl:col-span-6"></div>
                            @if (in_array($studentdetails->applicant_type, ['transferee', 'second_courser', 'hs_grad', 'shiftee']))
                            @else
                                <div class="xl:col-span-6 lrn-track-container">
                                    <label for="lrn" class="inline-block mb-2 text-base font-medium">Learner
                                        Reference
                                        Number<sup id="lrn-sup" class="text-red-500">* required</sup></label>
                                    <input type="number" id="lrn" name="lrn"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        placeholder="Enter your 12 digits LRN" value="{{ $studentdetails->lrn }}"
                                        data-user-id="{{ $studentdetails->id }}" onblur="validateLRN()">
                                    @error('lrn')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div><!--end col-->


                                <div class="xl:col-span-6 lrn-track-container">
                                    <label for="track" class="inline-block mb-2 text-base font-medium">Track<sup
                                            id="track-sup" class="text-red-500">* required</sup></label>
                                    <input type="text" id="track" name="track"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        placeholder="Enter your SHS track" value="{{ $studentdetails->track }}">
                                    @error('track')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div><!--end col-->
                            @endif


                            <div class="xl:col-span-3">
                                <label for="choices-single-default" class="inline-block mb-2 text-base font-medium">School
                                    ID
                                    <sup class="text-red-500">* required</sup></label>


                                <input type="text" id="school_id" name="school_id"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    placeholder="School ID" value="{{ $studentdetails->schoolid }}"
                                    onchange="handleChange(this.value)">
                                @error('school_id')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror

                                <!-- Help message below input -->
                                <p class="mt-2 text-sm text-custom-600">
                                    If you don’t know your School ID,
                                    <a href="{{ route('student.schoolname.index') }}"
                                        class="font-medium underline hover:text-blue-800">
                                        Click here
                                    </a>
                                </p>
                            </div><!--end col-->

                            <div class="xl:col-span-3">
                                <label for="school_name" class="inline-block mb-2 text-base font-medium">School Name <sup
                                        class="text-green-500">* read only</sup></span></label>
                                <input type="text" id="school_name" name="school_name"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    readonly placeholder=" School Name" value="{{ $studentdetails->shs_school }}">
                                @error('school_name')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div><!--end col-->

                            <div class="xl:col-span-6">
                                <label for="school_address" class="inline-block mb-2 text-base font-medium">School Address
                                    <sup class="text-green-500">* read only</sup></label>
                                <input type="text" id="school_address" name="school_address"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    readonly placeholder="Enter School Address"
                                    value="{{ $studentdetails->school_address }}">
                                @error('school_address')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div><!--end col-->


                            <div class="xl:col-span-12">
                                <h6 class="mb-1 text-green-500 text-15">ADDRESS INFORMATION</h6>
                            </div>

                            <div class="xl:col-span-3">
                                <label for="region" class="inline-block mb-2 text-base font-medium">Region <span
                                        class="text-red-500">*</span></label>
                                <select class="form-input border-slate-300 focus:outline-none focus:border-custom-500"
                                    id="region" name="region">
                                    <option selected="true" disabled>Choose Region</option>
                                </select>
                                <input type="hidden" name="region_text" id="region-text" required>
                            </div><!--end col-->

                            <div class="xl:col-span-3">
                                <label for="province" class="inline-block mb-2 text-base font-medium">Province <span
                                        class="text-red-500">*</span></label>
                                <select class="form-input border-slate-300 focus:outline-none focus:border-custom-500"
                                    id="province" name="province">
                                    <option selected="true" disabled>Choose Province</option>
                                </select>
                                <input type="hidden" name="province_text" id="province-text" required>
                            </div><!--end col-->

                            <div class="xl:col-span-3">
                                <label for="city" class="inline-block mb-2 text-base font-medium">Municipality/City
                                    <span class="text-red-500">*</span></label>
                                <select class="form-input border-slate-300 focus:outline-none focus:border-custom-500"
                                    id="city" name="city">
                                    <option selected="true" disabled>Choose Municipality</option>
                                </select>
                                <input type="hidden" name="city_text" id="city-text" required>
                            </div><!--end col-->

                            <div class="xl:col-span-3">
                                <label for="barangay" class="inline-block mb-2 text-base font-medium">Barangay <span
                                        class="text-red-500">*</span></label>
                                <select class="form-input border-slate-300 focus:outline-none focus:border-custom-500"
                                    id="barangay" name="barangay">
                                    <option selected="true" disabled>Choose Barangay</option>
                                </select>
                                <input type="hidden" name="barangay_text" id="barangay-text" required>
                            </div><!--end col-->

                            <div class="xl:col-span-6">
                                <label for="street" class="inline-block mb-2 text-base font-medium">Street<span></label>
                                <input type="text" id="street" name="street"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    placeholder="Enter Street" value="{{ $studentdetails->street }}" required>
                            </div><!--end col-->

                            <div class="xl:col-span-6">
                                <label for="zipcode" class="inline-block mb-2 text-base font-medium">Zip
                                    Code<span></label>
                                <input type="text" id="zipcode" name="zipcode"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    placeholder="Enter your zipcode" value="{{ $studentdetails->zipcode }}"
                                    onblur="validateZipcode()">
                            </div><!--end col-->

                            @if (empty($studentdetails->applicant_type) || empty($studentdetails->lrn))
                                <div class="flex justify-end gap-2 xl:col-span-12">
                                    <button type="button"
                                        class="text-red-500 bg-white btn hover:text-red-500 hover:bg-red-100 focus:text-red-500 focus:bg-red-100 active:text-red-500 active:bg-red-100 dark:bg-zink-700 dark:hover:bg-red-500/10 dark:focus:bg-red-500/10 dark:active:bg-red-500/10"><i
                                            data-lucide="x" class="inline-block size-4"></i> <span
                                            class="align-middle">Cancel</span></button>
                                    <button type="submit"
                                        class="text-white transition-all duration-200 ease-linear btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100">Submit</button>
                                </div><!--end col-->
                            @endif

                    </form><!--end form-->
                </div>

            </div><!--end card-->
        </div><!--end col-->
    </div><!--end grid-->




    {{-- <!-- Modal -->
    <div id="pageLoadModal" class="fixed inset-0 flex items-center justify-center hidden bg-black bg-opacity-50">
        <!-- Modal box -->
        <div class="relative p-0 overflow-hidden bg-white rounded-lg shadow-lg w-96">
            <div class="w-screen md:w-[30rem] bg-white shadow rounded-md dark:bg-zink-600 flex flex-col h-full">
                <div class="flex items-center justify-between p-4 border-b border-slate-200 dark:border-zink-500">
                    <h5 class="text-16">
                        Welcome to USMCEE {{ Auth::user()->firstname }}
                        {{ Auth::user()->lastname }}
                        {{ Auth::user()->middlename }} {{ Auth::user()->suffix }}
                    </h5>
                    <!-- Add an ID to the close button -->
                    <button id="closeModalBtn"
                        class="transition-all duration-200 ease-linear text-slate-500 hover:text-red-500 dark:text-zink-200 dark:hover:text-red-500">
                        <i data-lucide="x" class="size-5"></i>
                    </button>
                </div>
                <div class="max-h-[calc(theme('height.screen')_-_180px)] p-4 overflow-y-auto mb-5">
                    <p class="mb-4">Kindly click the User Guide button below to help you navigate the USMCEE System.</p>
                    <!-- User Guide Button -->
                    <a href="https://drive.google.com/file/d/11uex4NLsFaez7bJv0LNUUqSZMCR2W1pZ/view?usp=sharing"
                        target="_blank" class="px-4 py-2 text-white rounded bg-emerald-500 hover:bg-emerald-600">
                        User Guide
                    </a>
                </div>
            </div>
        </div>
    </div> --}}

@endsection

@push('scripts')
    <!-- Include SweetAlert library -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('pageLoadModal');
            const closeBtn = document.getElementById('closeModalBtn');

            // Show modal
            modal.classList.remove('hidden');

            // Close modal on button click
            closeBtn.addEventListener('click', () => modal.classList.add('hidden'));

            // Close modal if user clicks outside the modal content
            modal.addEventListener('click', (e) => {
                if (e.target === modal) {
                    modal.classList.add('hidden');
                }
            });
        });
    </script>


    @if (session('message'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Success!',
                    text: "{{ session('message') }}", // Retrieve the message from session
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href =
                            "{{ route('student.dashboard') }}"; // Redirect after confirmation
                    }
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



        function validateZipcode() {
            const lrnInput = document.getElementById('zipcode');

            // Check if the LRN is exactly 12 digits and contains numbers only
            if (!/^\d{4}$/.test(lrnInput.value)) {
                Toastify({
                    text: 'ZIPCODE must be exactly 4 digits.',
                    duration: 3000,
                    gravity: "top",
                    position: "right",
                    backgroundColor: "#f56565", // Red for error
                    className: "error",
                }).showToast();

                // Clear the input field
                lrnInput.value = '';
            }
        }
    </script>
    <script>
        // function validateLRN() {
        //     const lrnInput = document.getElementById('lrn');
        //     const lrnValue = lrnInput.value;

        //     // Check if the LRN is exactly 12 digits and contains numbers only
        //     if (!/^\d{12}$/.test(lrnValue)) {
        //         Toastify({
        //             text: 'LRN must be exactly 12 digits.',
        //             duration: 3000,
        //             gravity: "top",
        //             position: "right",
        //             backgroundColor: "#f56565", // Red for error
        //             className: "error",
        //         }).showToast();

        //         // Clear the input field
        //         lrnInput.value = '';
        //     }

        // }

        function validateLRN() {
            const lrnInput = document.getElementById('lrn');
            const lrnValue = lrnInput.value.trim();

            // Check if the LRN is exactly 12 digits
            if (!/^\d{12}$/.test(lrnValue)) {
                Toastify({
                    text: 'LRN must be exactly 12 digits.',
                    duration: 3000,
                    gravity: "top",
                    position: "right",
                    backgroundColor: "#f56565",
                    className: "error",
                }).showToast();
                lrnInput.value = '';
                return;
            }

            // Check uniqueness via AJAX
            fetch(`{{ route('student.check-lrn') }}?lrn=${lrnValue}&id=${lrnInput.dataset.userId}`)
                .then(response => response.json())
                .then(data => {
                    if (!data.unique) {
                        Toastify({
                            text: 'This LRN is already taken.',
                            duration: 3000,
                            gravity: "top",
                            position: "right",
                            backgroundColor: "#f56565",
                            className: "error",
                        }).showToast();
                        lrnInput.value = '';
                    }
                })
                .catch(error => console.error('Error checking LRN:', error));
        }


        document.getElementById('profile-img-file-input').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                // Preview the selected image
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('profile-image-preview').src = e.target.result;
                };
                reader.readAsDataURL(file);

                // Automatically submit the form after previewing
                document.getElementById('profile-form').submit();
            }
        });



        async function handleChange(schoolid) {
            const school_name = document.getElementById("school_name");
            const school_address = document.getElementById("school_address");

            // If schoolid is empty, clear the fields and return early
            if (!schoolid) {
                clearSchoolFields(school_name, school_address);
                return;
            }

            try {
                const data = await fetchSchoolData(schoolid);

                if (Array.isArray(data) && data.length > 0) {
                    const school = data[0];
                    populateSchoolFields(school, school_name, school_address);
                } else {
                    handleSchoolNotFound(school_name, school_address);
                    school_name.value = '';
                    school_address.value = '';
                }
            } catch (error) {
                school_name.value = '';
                school_address.value = '';
                Toastify({
                    text: 'Invalid School ID',
                    duration: 3000,
                    gravity: "top",
                    position: "right",
                    backgroundColor: "#f56565", // Red for error
                    className: "error",
                }).showToast();
            }
        }

        // Fetch school data from the server
        async function fetchSchoolData(schoolid) {
            // const url = schoolid ?
            //      `http://127.0.0.1:8000/student/cee/schoolname?schoolid=${encodeURIComponent(schoolid)}` :
            //     'http://127.0.0.1:8000/student/cee/schoolname';

            const schoolListUrl = "{{ route('student.school_list.index') }}";
            const url = schoolid ?
                `${schoolListUrl}?schoolid=${encodeURIComponent(schoolid)}` :
                schoolListUrl;

            const response = await fetch(url, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json'
                }
            });

            if (!response.ok) {
                school_name.value = '';
                school_address.value = '';
            }

            return await response.json();
        }

        // Populate school fields if data is found
        function populateSchoolFields(school, school_name, school_address) {
            school_name.value = school.school_name;
            school_address.value = school.school_address;
        }

        // Handle scenario when school is not found
        function handleSchoolNotFound(school_name, school_address) {
            Toastify({
                text: 'School not found.',
                duration: 3000,
                gravity: "top",
                position: "right",
                backgroundColor: "#f56565", // Red for error
                className: "error",
            }).showToast();
            clearSchoolFields(school_name, school_address);
        }

        // Clear the school name and address fields
        function clearSchoolFields(school_name, school_address) {
            school_name.value = '';
            school_address.value = '';
        }

        function setLRNBasedOnApplicantType() {
            const appTypeSelect = document.getElementById('apptype-select');
            const lrnContainer = document.querySelectorAll('.lrn-track-container');
            const lrnInput = document.getElementById('lrn');
            const trackInput = document.getElementById('track');
            const lrnSup = document.getElementById('lrn-sup');
            const trackSup = document.getElementById('track-sup');


            switch (appTypeSelect.value) {
                case 'transferee':
                    lrnInput.value = '000000000000';
                    trackInput.value = 'N/A';
                    lrnInput.readOnly = true;
                    lrnSup.textContent = '* readonly'; // Default label
                    trackSup.textContent = '* readonly'; // Default label
                    lrnContainer.forEach(container => container.style.display = 'none');
                    break;
                case 'second_courser':
                    lrnInput.value = '111111111111';
                    trackInput.value = 'N/A';
                    lrnInput.readOnly = true;
                    lrnSup.textContent = '* readonly'; // Default label
                    trackSup.textContent = '* readonly'; // Default label
                    lrnContainer.forEach(container => container.style.display = 'none');
                    break;
                case 'hs_grad':
                    lrnInput.value = '222222222222';
                    trackInput.value = 'N/A';
                    lrnInput.readOnly = true;
                    lrnSup.textContent = '* readonly'; // Default label
                    trackSup.textContent = '* readonly'; // Default label
                    lrnContainer.forEach(container => container.style.display = 'none');
                    break;
                case 'shiftee':
                    lrnInput.value = '333333333333';
                    trackInput.value = 'N/A';
                    lrnInput.readOnly = true;
                    lrnSup.textContent = '* readonly'; // Default label
                    trackSup.textContent = '* readonly'; // Default label
                    lrnContainer.forEach(container => container.style.display = 'none');
                    break;
                case 'shs':
                    lrnInput.readOnly = false; // Allow editing for SHS
                    trackInput.readOnly = false; // Allow editing for SHS
                    lrnSup.textContent = '* required'; // Change to required
                    trackSup.textContent = '* required'; // Change to required
                    lrnContainer.forEach(container => container.style.display = 'block');
                    break;
                default:
                    lrnInput.value = '';
                    lrnInput.readOnly = false;
                    trackInput.readOnly = false;
                    break;
            }
        }


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

            // URLs for JSON files
            var regionUrl = "{{ url('backend/assets/ph-json/region.json') }}";
            var provinceUrl = "{{ url('backend/assets/ph-json/province.json') }}";
            var cityUrl = "{{ url('backend/assets/ph-json/city.json') }}";
            var barangayUrl = "{{ url('backend/assets/ph-json/barangay.json') }}";

            // Saved values from the database (passed from the backend)
            var savedRegion = "{{ $studentdetails->region }}";
            var savedProvince = "{{ $studentdetails->province }}";
            var savedCity = "{{ $studentdetails->city }}";
            var savedBarangay = "{{ $studentdetails->brgy }}";

            // Populate Region Dropdown
            $.getJSON(regionUrl, function(data) {
                $('#region').append('<option selected disabled>Choose Region</option>');
                $.each(data, function(index, item) {
                    let selected = item.region_name == savedRegion ? "selected" : "";
                    $('#region').append(
                        `<option value="${item.region_code}" ${selected}>${item.region_name}</option>`
                    );
                });
                updateHiddenTextField('#region', '#region-text');

                // Trigger change event to load the Province dropdown if region is already selected
                if (savedRegion) $('#region').trigger('change');
            });

            // Province Dropdown based on Region selection
            $('#region').on('change', function() {
                var region_code = $(this).val();
                $('#province').empty().append('<option selected disabled>Choose Province</option>');

                $.getJSON(provinceUrl, function(data) {
                    var provinces = data.filter(function(province) {
                        return province.region_code == region_code;
                    });

                    $.each(provinces, function(index, item) {
                        let selected = item.province_name == savedProvince ? "selected" :
                            "";
                        $('#province').append(
                            `<option value="${item.province_code}" ${selected}>${item.province_name}</option>`
                        );
                    });
                    updateHiddenTextField('#province', '#province-text');

                    // Trigger change event to load the City dropdown if province is already selected
                    if (savedProvince) $('#province').trigger('change');
                });
            });

            // City Dropdown based on Province selection
            $('#province').on('change', function() {
                var province_code = $(this).val();
                $('#city').empty().append('<option selected disabled>Choose Municipality</option>');

                $.getJSON(cityUrl, function(data) {
                    var cities = data.filter(function(city) {
                        return city.province_code == province_code;
                    });

                    $.each(cities, function(index, item) {
                        let selected = item.city_name == savedCity ? "selected" : "";
                        $('#city').append(
                            `<option value="${item.city_code}" ${selected}>${item.city_name}</option>`
                        );
                    });
                    updateHiddenTextField('#city', '#city-text');

                    // Trigger change event to load the Barangay dropdown if city is already selected
                    if (savedCity) $('#city').trigger('change');
                });
            });

            // Barangay Dropdown based on City selection
            $('#city').on('change', function() {
                var city_code = $(this).val();
                $('#barangay').empty().append('<option selected disabled>Choose Barangay</option>');

                $.getJSON(barangayUrl, function(data) {
                    var barangays = data.filter(function(barangay) {
                        return barangay.city_code == city_code;
                    });

                    $.each(barangays, function(index, item) {
                        let selected = item.brgy_name == savedBarangay ? "selected" : "";
                        $('#barangay').append(
                            `<option value="${item.brgy_name}" ${selected}>${item.brgy_name}</option>`
                        );
                    });
                    updateHiddenTextField('#barangay', '#barangay-text');
                });
            });

            // Function to update hidden text field based on selected dropdown option
            function updateHiddenTextField(dropdownSelector, textFieldSelector) {
                var selectedText = $(dropdownSelector).find("option:selected").text();
                $(textFieldSelector).val(selectedText);
            }

            // Update hidden text fields on each dropdown change
            $('#region').on('change', function() {
                updateHiddenTextField('#region', '#region-text');
            });
            $('#province').on('change', function() {
                updateHiddenTextField('#province', '#province-text');
            });
            $('#city').on('change', function() {
                updateHiddenTextField('#city', '#city-text');
            });
            $('#barangay').on('change', function() {
                updateHiddenTextField('#barangay', '#barangay-text');
            });
        });
    </script>

    <script>
        document.getElementById('profile-img-file-input').addEventListener('change', function(event) {
            const imageInput = event.target;
            const reader = new FileReader();

            // When the file is loaded, update the image preview
            reader.onload = function(e) {
                document.querySelector('.user-profile-image').src = e.target.result;
            }

            // Read the file if it exists
            if (imageInput.files && imageInput.files[0]) {
                reader.readAsDataURL(imageInput.files[0]);
            }
        });
    </script>
@endpush
