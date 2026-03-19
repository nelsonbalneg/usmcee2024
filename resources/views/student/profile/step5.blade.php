@extends('student.layouts.master')
@section('title')
    Pre-registration - Emergency Contact Information
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css">
@endpush

@section('contents')
    <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
        <div class="grow">
            <h5 class="text-16">PRE-REGISTRATION - STUDENT PROFILE FORM </h5>
        </div>
        <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="#!" class="text-slate-400 dark:text-zink-200">Home</a>
            </li>
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="#!" class="text-slate-400 dark:text-zink-200">Pre-registration</a>
            </li>
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="#!" class="text-slate-400 dark:text-zink-200">Applicant Profile</a>
            </li>
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="#!" class="text-slate-400 dark:text-zink-200"> Personal Information</a>
            </li>
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="#!" class="text-slate-400 dark:text-zink-200"> Parent and Guardian Information</a>
            </li>
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="#!" class="text-slate-400 dark:text-zink-200"> Educational Background</a>
            </li>
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="#!" class="text-slate-400 dark:text-zink-200"> Emergency Contact Information</a>
            </li>
            <li class="text-slate-700 dark:text-zink-100">
                Final Step
            </li>
        </ul>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-12 gap-x-5">
        @if ($app_no && $result->csa >= 25)
            {{-- <div class="xl:col-span-3">
                <div class="card sticky top-[calc(theme('spacing.header')_*_1.3)]">
                    <div class="card-body">
                        <h6 class="mb-4 text-15">MY PROFILE INFORMATION</h6>

                        <div class="px-5 py-8 rounded-md bg-sky-50 dark:bg-zinc-600">
                            <img src="{{ asset($cee_profile->photo) }}" alt="Student Photo"
                                class="block mx-auto border border-gray-300 rounded-full h-s">
                        </div>
                        <div class="mt-3">
                            <h5 class="mb-0 text-blue-500 uppercase">{{ $cee_profile->lastname }},
                                {{ $cee_profile->firstname }}
                                {{ $cee_profile->middlename }} {{ $cee_profile->suffix }}</h5>
                            <p class="text-slate-500 dark:text-zink-200">
                                <i data-lucide="mail" class="inline-block size-4 text-slate-500 dark:text-zink-200"></i>
                                {{ $cee_profile->email }}
                            </p>
                            <p class="text-slate-500 dark:text-zink-200">
                                <i data-lucide="phone" class="inline-block size-4 text-slate-500 dark:text-zink-200"></i>
                                {{ $cee_profile->phone }}
                            </p>
                            <p class="text-slate-500 dark:text-zink-200">
                                <i data-lucide="calendar" class="inline-block size-4 text-slate-500 dark:text-zink-200"></i>
                                {{ \Carbon\Carbon::parse($cee_profile->birthdate)->format('F j, Y') }}
                            </p>
                        </div>
                    </div>
                </div><!--end card-->
            </div><!--end col--> --}}

            <div class="xl:col-span-12">
                @php
                    $alertTypes = [
                        'success' => ['color' => 'green', 'message' => session('success')],
                        'error' => [
                            'color' => 'red',
                            'message' => $errors->any() ? 'You should check in on some of those fields below.' : null,
                        ],
                    ];
                @endphp

                @foreach ($alertTypes as $type => $alert)
                    @if ($alert['message'])
                        <div
                            class="flex gap-1 px-4 py-3 mb-2 text-sm text-{{ $alert['color'] }}-500 border border-{{ $alert['color'] }}-200 rounded-md md:items-center bg-{{ $alert['color'] }}-50 dark:bg-{{ $alert['color'] }}-400/20 dark:border-{{ $alert['color'] }}-500/50">
                            <i data-lucide="alert-circle" class="h-4"></i>
                            <div>
                                <span class="font-bold">{{ ucfirst($type) }}!</span> {{ $alert['message'] }}
                                @if ($type === 'error')
                                    <ul class="mt-1 list-disc list-inside">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>
                    @endif
                @endforeach

                <div class="card">
                    <div class="card-body">
                        <div class="grid grid-cols-1 gap-5 lg:grid-cols-2 xl:grid-cols-12">

                            <div class="xl:col-span-12">
                                <div class="px-4 py-6 mx-auto text-center lg:w-2/3">

                                    @if ($applicant->applicant_profile_status == 1)
                                        <i data-lucide="check-circle"
                                            class="block w-10 h-10 mx-auto mb-4 text-green-500 fill-green-100 dark:fill-green-500/20 animate-icons"></i>

                                        <h5 class="mb-2 uppercase">Student Applicant Profile has been published
                                            successfully! 🎉</h5>
                                        <p class="mb-5 text-slate-500 text-15">
                                            Congratulations! Your profile has been successfully saved and published. Please
                                            proceed to the next step: the uploading of requirements.<br><br>
                                            Click the <b>'Upload Requirements'</b> button to submit all needed requirements.
                                        </p>
                                    @else
                                        <i data-lucide="square-pen"
                                            class="block w-10 h-10 mx-auto mb-4 text-yellow-500 fill-yellow-100 dark:fill-yellow-500/20 animate-icons"></i>

                                        <h5 class="mb-2 uppercase">Student Applicant Profile has been saved as a DRAFT!🎉
                                        </h5>
                                        <p class="mb-5 text-slate-500 text-15">
                                            You may still update your information while your profile status is set to DRAFT.
                                            Please click the <a href="{{ route('student.applicant-profile.step4.show') }}"
                                                class="text-blue-500 hover:text-blue-700">Previous</a> button to go back and
                                            review your details carefully.
                                            If you find any incorrect entries, you can edit them before proceeding.
                                            Once everything is correct, click the<b> Submit</b> button to proceed to the next
                                            step.
                                        </p>
                                    @endif



                                    @if (
                                        $applicant->applicant_profile_status == 0 ||
                                            empty($applicant->applicant_profile_status) ||
                                            is_null(value: $applicant->applicant_profile_status))
                                        <button type="submit" id="publishButton"
                                            class="text-white bg-green-500 border-green-500 btn hover:text-white hover:bg-green-600 hover:border-green-600 focus:text-white focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-100 active:text-white active:bg-green-600 active:border-green-600 active:ring active:ring-green-100 dark:ring-green-400/10">
                                            <i data-lucide="save" class="inline-block size-4 dark:text-zink-200"></i>
                                            Submit</button>
                                    @else
                                        <a type="button" href="{{ route('student.applicant-requirements.index') }}"
                                            class="text-white bg-green-500 border-green-500 btn hover:text-white hover:bg-green-600 hover:border-green-600 focus:text-white focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-100 active:text-white active:bg-green-600 active:border-green-600 active:ring active:ring-green-100 dark:ring-green-400/10">
                                            Upload Requirements <i data-lucide="move-right"
                                                class="inline-block size-4 dark:text-zink-200"></i></a>
                                    @endif
                                </div>

                            </div>


                        </div>

                        <div class="flex justify-between mt-4">
                            <a href="{{ route('student.applicant-profile.step4.show') }}"
                                class="flex items-center gap-1 text-white border-slate-500 bg-slate-500 btn hover:text-white hover:bg-slate-600 hover:border-slate-600 focus:text-white focus:bg-slate-600 focus:border-slate-600 focus:ring focus:ring-green-100 active:text-white active:bg-slate-600 active:border-slate-600 active:ring active:ring-slate-100 dark:ring-slate-400/10">
                                <i data-lucide="arrow-left" class="inline-block size-4 dark:text-zink-200"></i>
                                Previous
                            </a>
                        </div>
                    </div>
                    {{-- END card body --}}
                </div>

            </div>
            {{-- end col-9 --}}
        @else
            <div class="relative p-3 pr-12 text-sm bg-red-500 border border-transparent rounded-md text-red-50">
                <button class="absolute top-0 bottom-0 right-0 p-3 text-red-200 transition hover:text-red-100"><i
                        data-lucide="x" class="h-5"></i></button>
                <span class="font-bold">Error!</span> Oops! You are not allowed to access this page.
            </div>
        @endif
    </div>

@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- swal publish --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("publishButton").addEventListener("click", function(event) {
                event.preventDefault(); // Prevent default action

                Swal.fire({
                    title: "Are you sure?",
                    text: "Submitting this will publish your application. Please ensure all details are correct before proceeding. Once your profile information is published, you will not be able to update it.",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, publish it!",
                    cancelButtonText: "Cancel"
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Send AJAX request to publish
                        fetch("{{ route('student.student-profile.publish') }}", {
                                method: "POST",
                                headers: {
                                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                                    "Content-Type": "application/json"
                                },
                                body: JSON.stringify({})
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    Swal.fire("Success!",
                                            "Your profile has been published. Click Proceed to Next Step to Upload Pre-registration Requirements",
                                            "success")
                                        .then(() => location.reload()); // Reload the page
                                } else {
                                    Swal.fire("Error!", data.message, "error");
                                }
                            })
                            .catch(error => {
                                Swal.fire("Error!", "Something went wrong. Please try again.",
                                    "error");
                            });
                    }
                });
            });
        });
    </script>
@endpush
