@extends('student.layouts.master')
@section('title')
    USM-CEE | Programs
@endsection

@php
    use Carbon\Carbon;
    $start = Carbon::parse($site_settings->start_prereg_second_batch);
    $end = Carbon::parse($site_settings->end_prereg_second_batch);
@endphp


@section('contents')
    <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
        <div class="grow">
            <h5 class="uppercase text-16">USMCEE 4.0 | Pre-registration Dashboard</h5>
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
            <li class="text-slate-700 dark:text-zink-100">
                Dashboard
            </li>
        </ul>
    </div>
    {{-- || (now()->between($start, $end) && $result->confirmation_batch == 2) --}}
    @if ($result->confirmation_batch == 1 || (now()->between($start, $end) && $result->confirmation_batch == 2))

        <div class="grid grid-cols-1 xl:grid-cols-12 gap-x-5">

            <div class="xl:col-span-3">

                <a href="https://drive.google.com/file/d/17K7A0XK0fkGALONUxJ28UxNs40-d5zTB/view?usp=sharing"
                    class="block w-full mt-2 mb-2 text-white border-custom-500 bg-custom-500 btn hover:text-white hover:bg-custom-600 hover:yellow-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/10">
                    <i data-lucide="book" class="inline-block h-4 align-middle"></i>
                    Download the Preregistration Guide
                </a>
                <div class="card sticky top-[calc(theme('spacing.header')_*_1.3)]">
                    <div class="card-body">
                        <h6 class="mb-4 text-15">MY PROFILE INFORMATION</h6>

                        <div class="px-4 rounded-md py-7 bg-sky-50 dark:bg-zinc-600">
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
            </div><!--end col-->

            <div class="xl:col-span-6">
                <div class="card sticky top-[calc(theme('spacing.header')_*_1.3)]">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="mb-4 uppercase text-15">Enrollment Process for incoming Freshmen (1st Semester, A.Y.
                                2025-2026 )</h6>
                            <div>
                                <div
                                    class="relative before:absolute ltr:before:border-l-2 rtl:before:border-r-2 ltr:before:left-3.5 rtl:before:right-3.5 before:top-1.5 before:-bottom-1.5 pb-4 dark:before:border-zink-500">
                                    <div class="relative flex gap-2">
                                        <div
                                            class="size-8 p-0.5 bg-white text-green-500 flex items-center justify-center border rounded-full shrink-0 border-slate-200 dark:border-zink-500 dark:bg-zink-700">
                                            @if (
                                                $applicant &&
                                                    ($applicant->applicant_profile_status == 0 ||
                                                        empty($applicant->applicant_profile_status) ||
                                                        is_null($applicant->applicant_profile_status)))
                                                <i data-lucide="circle-dot" class="size-4"></i>
                                            @else
                                                <i data-lucide="circle-check-big" class="size-4"></i>
                                            @endif
                                        </div>

                                        <div>
                                            <h6 class="mb-1">PROFILE REGISTRATION</h6>
                                            <p class="mb-2 text-slate-500 dark:text-zink-200">Confirmation of Enrollment for
                                                qualified applicants. Encoding of personal information, including address,
                                                parent/guardian details, educational background, and other important
                                                information. <br><b>April 21, 2025 - April 29, 2025</b></p>

                                            <a type="button" href="{{ route('student.applicant-profile.step1.show') }}"
                                                class="text-white bg-green-500 border-green-500 btn hover:text-white hover:bg-green-600 hover:border-green-600 focus:text-white focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-100 active:text-white active:bg-green-600 active:border-green-600 active:ring active:ring-green-100 dark:ring-green-400/10">
                                                <i data-lucide="user-pen"
                                                    class="inline-block size-4 dark:text-zink-200"></i>
                                                Profile Registration</a>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="relative before:absolute ltr:before:border-l-2 rtl:before:border-r-2 ltr:before:left-3.5 rtl:before:right-3.5 before:top-1.5 before:-bottom-1.5 pb-4 dark:before:border-zink-500">
                                    <div class="relative flex gap-2">

                                        @if ($applicant && $applicant->applicant_profile_status == 1)
                                            <div
                                                class="size-8 p-0.5 bg-white text-green-500 flex items-center justify-center border rounded-full shrink-0 border-slate-200 dark:border-zink-500 dark:bg-zink-700">
                                                @if (
                                                    $requirements &&
                                                        (($requirements->req_status == 0 || empty($requirements->req_status) || is_null($requirements->req_status)) &&
                                                            ($requirements->additional_req_status == 0 ||
                                                                empty($requirements->additional_req_status) ||
                                                                is_null($requirements->additional_req_status))))
                                                    <i data-lucide="file-axis-3d" class="size-4"></i>
                                                @else
                                                    <i data-lucide="circle-check-big" class="size-4"></i>
                                                @endif

                                            </div>
                                            <div>
                                                <h6 class="mb-1">UPLOADING OF REQUIREMENTS</h6>

                                                <p class="mb-2 text-slate-500 dark:text-zink-200">Uploading of electronic
                                                    copies
                                                    of
                                                    pertinent requirements such as e-signature, Form 138, and other
                                                    necessary
                                                    documents</p>
                                                <a type="button" href="{{ route('student.applicant-requirements.index') }}"
                                                    class="text-white bg-green-500 border-green-500 btn hover:text-white hover:bg-green-600 hover:border-green-600 focus:text-white focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-100 active:text-white active:bg-green-600 active:border-green-600 active:ring active:ring-green-100 dark:ring-green-400/10">
                                                    <i data-lucide="upload"
                                                        class="inline-block size-4 dark:text-zink-200"></i>
                                                    Upload Requirements</a>
                                            </div>
                                        @else
                                            <div
                                                class="size-8 p-0.5 bg-white text-green-500 flex items-center justify-center border rounded-full shrink-0 border-slate-200 dark:border-zink-500 dark:bg-zink-700">
                                                <i data-lucide="file-axis-3d" class="size-4"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-1">UPLOADING OF REQUIREMENTS</h6>

                                                <p class="mb-2 text-slate-500 dark:text-zink-200">Uploading of electronic
                                                    copies
                                                    of
                                                    pertinent requirements such as e-signature, Form 138, and other
                                                    necessary
                                                    documents</p>
                                            </div>
                                        @endif


                                    </div>
                                </div>
                                <div
                                    class="relative before:absolute ltr:before:border-l-2 rtl:before:border-r-2 ltr:before:left-3.5 rtl:before:right-3.5 before:top-1.5 before:-bottom-1.5 pb-4 dark:before:border-zink-500">
                                    <div class="relative flex gap-2">
                                        {{-- ||
                                        empty($applicant->prereg_status) ||
                                        is_null(value: $applicant->prereg_status) --}}
                                        @if ($applicant && $applicant->applicant_profile_status == 1)
                                            <div
                                                class="size-8 p-0.5 bg-white text-green-500 flex items-center justify-center border rounded-full shrink-0 border-slate-200 dark:border-zink-500 dark:bg-zink-700">
                                                @if (!empty($applicant->campus_id) && !is_null($applicant->prog_id))
                                                    <i data-lucide="circle-check-big" class="size-4"></i>
                                                @else
                                                    <i data-lucide="graduation-cap" class="size-4"></i>
                                                @endif
                                            </div>
                                            <div>
                                                <h6 class="mb-1">PRIORITY PROGRAM CONFIRMATION</h6>
                                                <p class="mb-2 text-slate-500 dark:text-zink-200">Confirmation of your
                                                    program.</p>
                                                <a type="button" href="{{ route('student.program-confirmation.index') }}"
                                                    class="text-white bg-green-500 border-green-500 btn hover:text-white hover:bg-green-600 hover:border-green-600 focus:text-white focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-100 active:text-white active:bg-green-600 active:border-green-600 active:ring active:ring-green-100 dark:ring-green-400/10">
                                                    <i data-lucide="graduation-cap"
                                                        class="inline-block size-4 dark:text-zink-200"></i> Program
                                                    Confirmation</a>
                                            </div>
                                        @else
                                            <div
                                                class="size-8 p-0.5 bg-white text-green-500 flex items-center justify-center border rounded-full shrink-0 border-slate-200 dark:border-zink-500 dark:bg-zink-700">
                                                <i data-lucide="graduation-cap" class="size-4"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-1">PRIORITY PROGRAM CONFIRMATION</h6>
                                                <p class="mb-2 text-slate-500 dark:text-zink-200">Confirmation of your
                                                    program.</p>
                                            </div>
                                        @endif


                                    </div>
                                </div>

                                <div
                                    class="relative before:absolute ltr:before:border-l-2 rtl:before:border-r-2 ltr:before:left-3.5 rtl:before:right-3.5 before:top-1.5 before:-bottom-1.5 pb-4 dark:before:border-zink-500">
                                    <div class="relative flex gap-2">

                                        <div
                                            class="size-8 p-0.5 bg-white text-green-500 flex items-center justify-center border rounded-full shrink-0 border-slate-200 dark:border-zink-500 dark:bg-zink-700">
                                            @if ($applicant && ($applicant->status_id == 0 || $applicant->status_id == 1))
                                                <i data-lucide="circle-check-big" class="size-4"></i>
                                            @else
                                                <i data-lucide="layers" class="size-4"></i>
                                            @endif
                                        </div>

                                        <div>
                                            <h6 class="mb-1">SUBMISSION OF ORIGINAL COPIES OF REQUIREMENTS</h6>
                                            <p class=" text-slate-500 dark:text-zink-200">Submission of original copies of
                                                pertinent requirements to the <b class="text-custom-500"> Admission and
                                                    Records
                                                    Office (ARO) </b>. This may be done face-to-face or via courier.<br>
                                                <b>April 28, 2025 - May 28, 2025</b>
                                            </p>
                                        </div>

                                    </div>
                                </div>

                                <div
                                    class="relative before:absolute ltr:before:border-l-2 rtl:before:border-r-2 ltr:before:left-3.5 rtl:before:right-3.5 before:top-1.5 before:-bottom-1.5 pb-4 dark:before:border-zink-500">
                                    <div class="relative flex gap-2">
                                        <div
                                            class="size-8 p-0.5 bg-white text-green-500 flex items-center justify-center border rounded-full shrink-0 border-slate-200 dark:border-zink-500 dark:bg-zink-700">
                                            @if (($applicant && $applicant->status_id == 0) || ($applicant && $applicant->status_id == 1))
                                                <i data-lucide="circle-check-big" class="size-4"></i>
                                            @else
                                                <i data-lucide="loader" class="size-4"></i>
                                            @endif

                                        </div>
                                        <div>
                                            <h6 class="mb-1">PROCESSING OF ENROLLMENT</h6>
                                        </div>
                                    </div>
                                </div>

                                <div class="relative">
                                    <div class="relative flex gap-2">
                                        <div
                                            class="size-8 p-0.5 bg-white text-green-500 flex items-center justify-center border rounded-full shrink-0 border-slate-200 dark:border-zink-500 dark:bg-zink-700">
                                            @if ($applicant && $applicant && $applicant->status_id == 1)
                                                <i data-lucide="download" class="size-4"></i>
                                            @else
                                                <i data-lucide="loader" class="size-4"></i>
                                            @endif
                                        </div>
                                        <div>
                                            <h6 class="mb-1">DOWNLOADING OF CERTIFICATE OF REGISTRATION</h6>
                                            @if (($applicant && $applicant->prereg_status == 'enrolled') || ($applicant && $applicant->status_id == 1))
                                                <a type="button" {{-- href="{{ route('student.prereg.cor-pdf.view') }}" --}}
                                                    href="{{ route('student.download.cor') }}"
                                                    class="text-white bg-green-500 border-green-500 btn hover:text-white hover:bg-green-600 hover:border-green-600 focus:text-white focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-100 active:text-white active:bg-green-600 active:border-green-600 active:ring active:ring-green-100 dark:ring-green-400/10">
                                                    <i data-lucide="eye"
                                                        class="inline-block size-4 dark:text-zink-200"></i> View
                                                    Certificate of Registration</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div><!--end card-->
                </div><!--end card-->
            </div><!--end col-->


            <div class="xl:col-span-3">
                {{-- Profile Status --}}
                <div class="card">
                    <div class="flex items-center gap-3 card-body">

                        @if ($applicant && $applicant->applicant_profile_status == 1)
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
                                @if ($applicant && $applicant->policyId == null && $applicant->programName != null)
                                    You did not qualify for <span
                                        class="text-custom-500">{{ !empty($applicant->programName) ? $applicant->programName : '' }}
                                        -
                                        {{ !empty($applicant->majorDiscDesc) ? $applicant->majorDiscDesc : '' }}</span>
                                    based on your ranking. <br><br> Tap or Click the <a class="text-green-500"
                                        href="{{ route('student.cee.result') }}">Result </a> Menu to select other program.
                                @elseif ($applicant && $applicant->prereg_status == 'for_ranking' && $applicant->campus_id == null)
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
                                @if ($applicant)
                                    @if ($applicant->prereg_status == 'pending' && $applicant->status_id == null)
                                        Program has been confirmed for enrollment.
                                        @if ($applicant->is_answered_nstp == 1)
                                            <br>
                                            <span
                                                class="mb-2 px-2.5 py-0.5 inline-block text-[11px] font-medium rounded border bg-green-100 border-transparent text-green-500 dark:bg-green-500/20 dark:border-transparent">
                                                NSTP PREFERENCE: {{ $applicant->nstp == 1 ? 'CWTS' : 'ROTC' }}
                                            </span>
                                        @endif

                                        {{-- check if requirements has been submittted --}}
                                        @if (is_null($requirements_submitted))
                                            <span
                                                class="px-2.5 py-0.5 inline-block text-[11px] font-medium rounded border bg-purple-100 border-transparent text-purple-500 dark:bg-purple-500/20 dark:border-transparent">
                                                Please submit the original copies of the required
                                                documents to the
                                                <b class="text-purple-500">Admission and Records
                                                    Office (ARO)</b> as soon as possible.
                                                Submission may be done in person or via courier. If
                                                you have already submitted your documents, kindly
                                                disregard this message.
                                            </span>
                                        @else
                                            @php
                                                $labels = [
                                                    'goodmoral' => 'Good Moral Certificate',
                                                    'card' => 'Report Card',
                                                    'psa' => 'PSA Birth Certificate',
                                                    'hdismissal' => 'Honorable Dismissal',
                                                    'certificatetransfer' => 'Certificate of Transfer',
                                                    'transcript' => 'Transcript of Records',
                                                ];
                                            @endphp

                                            <div class="flex flex-wrap items-center gap-2">
                                                @foreach ($labels as $key => $label)
                                                    @if ($requirements_submitted->$key == 1)
                                                        <span
                                                            class="flex items-center px-2.5 py-0.5 text-xs font-medium rounded border bg-white border-green-400 text-green-500 dark:bg-zink-700 dark:border-green-700">
                                                            <i data-lucide="check" class="size-3 ltr:ml-1 rtl:mr-1"></i>
                                                            {{ $label }}
                                                            <a href="#!"
                                                                class="text-green-400 transition hover:text-green-600"></a></span>
                                                    @endif
                                                @endforeach
                                            </div>
                                        @endif
                                    @elseif ($applicant->prereg_status == 'for_ranking' && $applicant->campus_id != null)
                                        Please wait, ranking in progress.
                                    @elseif ($applicant->prereg_status == 'for_ranking' && $applicant->campus_id == null)
                                        Please confirm the program.
                                    @elseif ($applicant->policyId == null && $applicant->programName != null)
                                        You did not qualify for the chosen program based on your ranking
                                    @elseif($applicant->status_id == 0)
                                        <span
                                            class="px-2.5 py-0.5 inline-block text-[11px] font-medium rounded border bg-orange-100 border-transparent text-orange-500 dark:bg-orange-500/20 dark:border-transparent">Enrollment
                                            in progress</span>
                                    @elseif($applicant->prereg_status == 'enrolled' || $applicant->status_id == 1)
                                        <span
                                            class="mb-2 px-2.5 py-0.5 inline-block text-[11px] font-medium rounded border bg-green-100 border-transparent text-green-500 dark:bg-green-500/20 dark:border-transparent">You
                                            are officially enrolled!</span>
                                        <span
                                            class="inline-block px-2.5 py-0.5 text-[11px] font-medium rounded bg-purple-100 text-purple-600 dark:bg-purple-500/20">
                                            Tap the <b class="text-purple-600">View Certificate of Registration </b>button
                                            to get your
                                            Certificate of Registration.
                                        </span>
                                    @else
                                        ---
                                    @endif
                                @endif
                            </h5>
                            <p class="text-slate-500 dark:text-zink-200">Status</p>
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





        </div>
    @else
        <div class="flex gap-3 p-4 text-sm rounded-md text-sky-500 bg-sky-50 dark:bg-sky-400/20">
            <i data-lucide="check-circle" class="inline-block size-4 mt-0.5 shrink-0"></i>
            <div>
                <h6 class="mb-1"> <span class="font-bold">Information!</span> USMCEE PREREGISTRATION UPDATE.</h6>
                <ul class="ml-2 list-disc list-inside">
                    <li>Please visit this page between <b> {{ \Carbon\Carbon::parse($start)->format('F j, Y g:i A') }} to
                            {{ \Carbon\Carbon::parse($end)->format('F j, Y g:i A') }} </b> for the second batch of
                        pre-registration.</li>

                </ul>
            </div>
        </div>
    @endif
@endsection
