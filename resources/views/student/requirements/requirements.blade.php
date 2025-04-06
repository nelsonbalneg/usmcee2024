@extends('student.layouts.master')
@section('title')
    Pre-registration - Student Profile Form
@endsection

@push('styles')
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css"> --}}
@endpush


@section('contents')
    <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
        <div class="grow">
            <h5 class="text-16">PRE-REGISTRATION - REQUIREMENTS</h5>
        </div>
        <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="#!" class="text-slate-400 dark:text-zink-200">Home</a>
            </li>
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="#!" class="text-slate-400 dark:text-zink-200">Profile</a>
            </li>
            <li class="text-slate-700 dark:text-zink-100">
                Requirements
            </li>
        </ul>
    </div>


    @if ($applicant->applicant_profile_status == 1)
        <div class="grid grid-cols-1 xl:grid-cols-12 gap-x-5">

            <div class="xl:col-span-3">
                <div class="card sticky top-[calc(theme('spacing.header')_*_1.3)]">
                    <div class="card-body">
                        <h6 class="mb-0 text-lg font-semibold text-blue-500 uppercase">Initial Requirement Checklist</h6>

                        <p class="font-semibold text-gray-700 rounded-md">
                            This step is required to activate the Select Program menu.
                        </p>

                        <div class="mt-4">
                            <h3 class="text-lg font-semibold text-green-500">FRESHMEN</h3>
                            <ul class="text-gray-700 list-disc list-inside">
                                <li>Certificate of Good Moral Character</li>
                                <li>Enrollment Certification (Ongoing Grade 12)</li>
                                <li>Senior High School Card</li>
                                <li>PSA Birth Certificate</li>
                            </ul>
                        </div>

                        <div class="mt-4">
                            <h3 class="text-lg font-semibold text-green-500">TRANSFEREES</h3>
                            <ul class="text-gray-700 list-disc list-inside">
                                <li>Certificate of Good Moral Character</li>
                                <li>Honorable Dismissal</li>
                                <li>PSA Birth Certificate</li>
                                <li>TOR for Evaluation</li>
                            </ul>
                        </div>

                        <div class="mt-4">
                            <h3 class="text-lg font-semibold text-green-500 uppercase">For BS in Midwifery, BS in Nursing,
                                and BS in Pharmacy</h3>
                            <ul class="text-gray-700 list-disc list-inside">
                                <li><strong>For females:</strong> Hepatitis B Test Result, Chest X-Ray, and Pregnancy Test
                                </li>
                                <li><strong>For males:</strong> Hepatitis B Test Result, and Chest X-Ray</li>
                            </ul>
                        </div>

                        <div class="mt-4">
                            <h3 class="text-lg font-semibold text-green-500 uppercase">For BS in Hospitality Management, BS
                                in Nutrition and Dietetics, and BS in Food Technology</h3>
                            <ul class="text-gray-700 list-disc list-inside">
                                <li>Hepatitis B Test Result</li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>

            <div class="xl:col-span-9">

                <div class="card">
                    <div class="card-body">
                        <h6 class="mb-4 text-blue-500 uppercase text-15"><i data-lucide="upload"
                                class="inline-block text-blue-500 size-4 dark:text-zink-200"></i> PRE-REGISTRATION
                            REQUIREMENTS</h6>

                        <div class="mb-5 xl:col-span-12">
                            <div
                                class="flex gap-3 p-4 text-sm rounded-md text-custom-500 bg-custom-50 dark:bg-custom-400/20">
                                <i data-lucide="alert-circle" class="inline-block size-4 mt-0.5 shrink-0"></i>
                                <div>
                                    <h6 class="mb-1">Prohibition Against Fraud and Misrepresentation</h6>
                                    <ul class="ml-2 list-disc list-inside">
                                        <li>Providing an incorrect information violates university policy,
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

                        <h6 class="mb-0 text-15">Original PSA Birth Certificate <sup class="text-red-500">*
                                required</sup>
                        </h6>

                        @if (optional($requirements->first())->req_status == 0)
                            <p class="mb-4">If PSA i not yet available, download the commitment form at bitly fill out it,
                                sign, and upload a scanned copy.</p>

                            <form action="{{ route('student.applicant-requirements.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @error('psa_files.*')
                                    <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                                @enderror
                                <div class="grid items-center grid-cols-1 gap-2 xl:grid-cols-4">

                                    <input type="file" name="psa_files[]" multiple="multiple" required
                                        class="mb-2 cursor-pointer form-file border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500">

                                    <button type="submit"
                                        class="text-white bg-green-500 border-green-500 btn hover:text-white hover:bg-green-600 hover:border-green-600 focus:text-white focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-100 active:text-white active:bg-green-600 active:border-green-600 active:ring active:ring-green-100 dark:ring-green-400/10">
                                        <i data-lucide="upload" class="inline-block size-4 dark:text-zink-200"></i>
                                        Upload PSA</button>
                                </div>
                            </form>
                        @endif


                        @if ($requirements->isNotEmpty())
                            <table class="w-full mt-4 border-separate table-custom border-spacing-y-1">
                                <thead class="">
                                    <tr
                                        class="relative rounded-md bg-slate-50 after:absolute after:border-l-2 after:left-0 after:top-0 after:bottom-0 after:border-transparent dark:bg-zink-600 [&.active]:after:border-custom-500">
                                        <th class="px-3.5 py-2.5 font-semibold ltr:text-left rtl:text-right">Details</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($requirements as $requirement)
                                        @php
                                            $psa_files = json_decode($requirement->psa, true);
                                        @endphp

                                        @if (!empty($psa_files))
                                            @foreach ($psa_files as $file)
                                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                                    <td>
                                                        @if ($requirement->req_status == 0)
                                                            <a class="inline-flex items-center px-4 py-2 mb-2 text-xs font-medium text-left text-red-500 bg-red-100 border border-transparent rounded dark:bg-red-500/20 dark:border-transparent"
                                                                href="#">
                                                                Delete</a>
                                                            <a class="inline-flex items-center px-4 py-2 text-xs font-medium text-left text-green-500 bg-green-100 border border-transparent rounded dark:bg-green-500/20 dark:border-transparent"
                                                                href="{{ Storage::url(str_replace('doc/', 'psa/', $file)) }}"
                                                                target="_blank">View</a>

                                                            <a class="inline-flex items-center px-4 py-2 text-xs font-medium text-left text-yellow-500 bg-yellow-100 border border-transparent rounded dark:bg-yellow-500/20 dark:border-transparent"
                                                                href="#"><i data-lucide="circle-dashed"
                                                                    class="size-3 ltr:mr-1 rtl:ml-1"></i> Pending</a>
                                                        @else
                                                            <a class="inline-flex items-center px-4 py-2 text-xs font-medium text-left text-green-500 bg-green-100 border border-transparent rounded dark:bg-green-500/20 dark:border-transparent"
                                                                href="{{ Storage::url(str_replace('doc/', 'psa/', $file)) }}"
                                                                target="_blank">View</a>

                                                            <a class="inline-flex items-center px-4 py-2 text-xs font-medium text-left text-green-500 bg-green-100 border border-transparent rounded dark:bg-green-500/20 dark:border-transparent"
                                                                href="#"><i data-lucide="check-circle-2"
                                                                    class="size-3 ltr:mr-1 rtl:ml-1"></i> Submitted</a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div><!--end card-->


                <div class="card">

                    <div class="card-body">
                        <h6 class="mb-4 text-blue-500 uppercase text-15"><i data-lucide="upload"
                                class="inline-block text-blue-500 size-4 dark:text-zink-200"></i> ADDITIONAL
                            PRE-REGISTRATION REQUIREMENTS</h6>

                        <div class="mb-5 xl:col-span-12">
                            <div
                                class="flex gap-3 p-4 text-sm rounded-md text-custom-500 bg-custom-50 dark:bg-custom-400/20">
                                <i data-lucide="alert-circle" class="inline-block size-4 mt-0.5 shrink-0"></i>
                                <div>
                                    <h6 class="mb-1 font-semibold">Please take time to read this before proceeding.</h6>
                                    <ul class="ml-2 list-disc list-inside">
                                        <li>
                                            If the mentioned documents are unavailable, kindly download the Affidavit and
                                            Enrollment Certification via the following links:
                                        </li>
                                        <li>
                                            <strong>Affidavit:</strong>
                                            <a href="https://bit.ly/3NUgsAU"
                                                class="text-blue-600 underline hover:text-blue-800" target="_blank">
                                                https://bit.ly/3NUgsAU
                                            </a>
                                        </li>
                                        <li>
                                            <strong>Enrollment Certification:</strong>
                                            <a href="https://bit.ly/4440mIT"
                                                class="text-blue-600 underline hover:text-blue-800" target="_blank">
                                                https://bit.ly/4440mIT
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        {{-- GMC --}}

                        <h6 class="text-15">Certificate of Good Moral Character <sup class="text-red-500">*
                                required</sup></h6>
                        </h6>

                        {{-- show if the re_sttuss i not published --}}
                        @if (optional($requirements->first())->req_status == 0)
                            <form action="{{ route('student.requirements.gmc.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                @error('gmc_files.*')
                                    <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                                @enderror

                                <div class="grid items-center grid-cols-1 gap-2 xl:grid-cols-4">

                                    <input type="file" name="gmc_files[]" multiple="multiple" required
                                        class="mb-2 cursor-pointer form-file border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500">

                                    <button type="submit" id="uploadButton"
                                        class="text-white bg-green-500 border-green-500 btn hover:text-white hover:bg-green-600 hover:border-green-600 focus:text-white focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-100 active:text-white active:bg-green-600 active:border-green-600 active:ring active:ring-green-100 dark:ring-green-400/10">
                                        <i data-lucide="upload" class="inline-block size-4 dark:text-zink-200"></i>
                                        Upload GMC</button>
                                </div>
                            </form>
                        @endif


                        @if ($requirements->isNotEmpty())
                            <div class="w-full overflow-x-auto">
                                <table class="w-full mt-4 border-separate table-custom border-spacing-y-1 min-w-max">
                                    <thead>
                                        <tr
                                            class="relative rounded-md bg-slate-50 after:absolute after:border-l-2 after:left-0 after:top-0 after:bottom-0 after:border-transparent dark:bg-zink-600 [&.active]:after:border-custom-500">
                                            <th
                                                class="px-3.5 py-2.5 font-semibold ltr:text-left rtl:text-right whitespace-nowrap">
                                                Details</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($requirements as $requirement)
                                            @php
                                                $gmc_files = json_decode($requirement->good_moral_char, true);
                                            @endphp

                                            @if (!empty($gmc_files))
                                                @foreach ($gmc_files as $file)
                                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                                        <td class="px-4 py-2 whitespace-nowrap">
                                                            @if ($requirement->req_status == 0)
                                                                <a class="inline-flex items-center px-4 py-2 mb-2 text-xs font-medium text-red-500 bg-red-100 border border-transparent rounded dark:bg-red-500/20 dark:border-transparent"
                                                                    href="#">
                                                                    Delete
                                                                </a>
                                                                <a class="inline-flex items-center px-4 py-2 text-xs font-medium text-green-500 bg-green-100 border border-transparent rounded dark:bg-green-500/20 dark:border-transparent"
                                                                    href="{{ Storage::url(str_replace('doc/', 'gmc/', $file)) }}"
                                                                    target="_blank">
                                                                    View
                                                                </a>
                                                                <a class="inline-flex items-center px-4 py-2 text-xs font-medium text-left text-yellow-500 bg-yellow-100 border border-transparent rounded dark:bg-yellow-500/20 dark:border-transparent"
                                                                    href="#"><i data-lucide="circle-dashed"
                                                                        class="size-3 ltr:mr-1 rtl:ml-1"></i> Pending</a>
                                                            @else
                                                                <a class="inline-flex items-center px-4 py-2 text-xs font-medium text-green-500 bg-green-100 border border-transparent rounded dark:bg-green-500/20 dark:border-transparent"
                                                                    href="{{ Storage::url(str_replace('doc/', 'gmc/', $file)) }}"
                                                                    target="_blank">
                                                                    View
                                                                </a>

                                                                <a class="inline-flex items-center px-4 py-2 text-xs font-medium text-left text-green-500 bg-green-100 border border-transparent rounded dark:bg-green-500/20 dark:border-transparent"
                                                                    href="#"><i data-lucide="check-circle-2"
                                                                        class="size-3 ltr:mr-1 rtl:ml-1"></i> Submitted</a>
                                                            @endif

                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif

                        {{-- end GMC --}}

                        {{-- SHS Card --}}
                        <h6 class="mt-10 text-15">Senior High School Card <sup class="text-red-500">*
                                required</sup></h6>

                        {{-- show if the re_sttuss i not published --}}
                        @if (optional($requirements->first())->req_status == 0)
                            <form action="{{ route('student.requirements.card.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                @error('shs_files.*')
                                    <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                                @enderror
                                <div class="grid items-center grid-cols-1 gap-2 xl:grid-cols-4">

                                    <input type="file" name="shs_files[]" multiple="multiple" required
                                        class="mb-2 cursor-pointer form-file border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500">

                                    <button type="submit" id="uploadButton"
                                        class="text-white bg-green-500 border-green-500 btn hover:text-white hover:bg-green-600 hover:border-green-600 focus:text-white focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-100 active:text-white active:bg-green-600 active:border-green-600 active:ring active:ring-green-100 dark:ring-green-400/10">
                                        <i data-lucide="upload" class="inline-block size-4 dark:text-zink-200"></i>
                                        Upload Card</button>
                                </div>
                            </form>
                        @endif

                        @if ($requirements->isNotEmpty())
                            <div class="w-full overflow-x-auto">

                                <table class="w-full mt-4 border-separate table-custom border-spacing-y-1 min-w-max">
                                    <thead>
                                        <tr
                                            class="relative rounded-md bg-slate-50 after:absolute after:border-l-2 after:left-0 after:top-0 after:bottom-0 after:border-transparent dark:bg-zink-600 [&.active]:after:border-custom-500">
                                            <th
                                                class="px-3.5 py-2.5 font-semibold ltr:text-left rtl:text-right whitespace-nowrap">
                                                Details</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($requirements as $requirement)
                                            @php
                                                $shs_files = json_decode($requirement->shs_card, true);
                                            @endphp

                                            @if (!empty($shs_files))
                                                @foreach ($shs_files as $file)
                                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                                        <td class="px-4 py-2 whitespace-nowrap">
                                                            @if ($requirement->req_status == 0)
                                                                <a class="inline-flex items-center px-4 py-2 mb-2 text-xs font-medium text-red-500 bg-red-100 border border-transparent rounded dark:bg-red-500/20 dark:border-transparent"
                                                                    href="#">Delete</a>
                                                                <a class="inline-flex items-center px-4 py-2 text-xs font-medium text-green-500 bg-green-100 border border-transparent rounded dark:bg-green-500/20 dark:border-transparent"
                                                                    href="{{ Storage::url(str_replace('doc/', 'card/', $file)) }}"
                                                                    target="_blank">View</a>

                                                                <a class="inline-flex items-center px-4 py-2 text-xs font-medium text-left text-yellow-500 bg-yellow-100 border border-transparent rounded dark:bg-yellow-500/20 dark:border-transparent"
                                                                    href="#"><i data-lucide="circle-dashed"
                                                                        class="size-3 ltr:mr-1 rtl:ml-1"></i> Pending</a>
                                                            @else
                                                                <a class="inline-flex items-center px-4 py-2 text-xs font-medium text-green-500 bg-green-100 border border-transparent rounded dark:bg-green-500/20 dark:border-transparent"
                                                                    href="{{ Storage::url(str_replace('doc/', 'card/', $file)) }}"
                                                                    target="_blank">View</a>

                                                                <a class="inline-flex items-center px-4 py-2 text-xs font-medium text-left text-green-500 bg-green-100 border border-transparent rounded dark:bg-green-500/20 dark:border-transparent"
                                                                    href="#"><i data-lucide="check-circle-2"
                                                                        class="size-3 ltr:mr-1 rtl:ml-1"></i> Submitted</a>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                        {{-- END SHS CARD --}}

                        {{-- Start Enrollment Certification --}}
                        <h6 class="mt-10 text-15">Enrollment Certification (On-going Grade 12) <sup class="text-red-500">*
                                required</sup></h6>

                        {{-- show if the re_sttuss i not published --}}
                        @if (optional($requirements->first())->req_status == 0)
                            <form action="{{ route('student.requirements.certification.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                @error('enrollment_certification.*')
                                    <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                                @enderror

                                <div class="grid items-center grid-cols-1 gap-2 xl:grid-cols-4">

                                    <input type="file" name="enrollment_certification[]" multiple="multiple" required
                                        class="mb-2 cursor-pointer form-file border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500">

                                    <button type="submit" id="uploadButton"
                                        class="text-white bg-green-500 border-green-500 btn hover:text-white hover:bg-green-600 hover:border-green-600 focus:text-white focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-100 active:text-white active:bg-green-600 active:border-green-600 active:ring active:ring-green-100 dark:ring-green-400/10">
                                        <i data-lucide="upload" class="inline-block size-4 dark:text-zink-200"></i>
                                        Upload Enrollment Certification</button>
                                </div>
                            </form>
                        @endif

                        @if ($requirements->isNotEmpty())
                            <div class="w-full overflow-x-auto">
                                <table class="w-full mt-4 border-separate table-custom border-spacing-y-1 min-w-max">
                                    <thead>
                                        <tr
                                            class="relative rounded-md bg-slate-50 after:absolute after:border-l-2 after:left-0 after:top-0 after:bottom-0 after:border-transparent dark:bg-zink-600 [&.active]:after:border-custom-500">
                                            <th
                                                class="px-3.5 py-2.5 font-semibold ltr:text-left rtl:text-right whitespace-nowrap">
                                                Details</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($requirements as $requirement)
                                            @php
                                                $enrollment_certification_files = json_decode(
                                                    $requirement->enrolment_certification,
                                                    true,
                                                );
                                            @endphp

                                            @if (!empty($enrollment_certification_files))
                                                @foreach ($enrollment_certification_files as $file)
                                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                                        <td class="px-4 py-2 whitespace-nowrap">
                                                            @if ($requirement->req_status == 0)
                                                                <a class="inline-flex items-center px-4 py-2 mb-2 text-xs font-medium text-red-500 bg-red-100 border border-transparent rounded dark:bg-red-500/20 dark:border-transparent"
                                                                    href="#">
                                                                    Delete
                                                                </a>
                                                                <a class="inline-flex items-center px-4 py-2 text-xs font-medium text-green-500 bg-green-100 border border-transparent rounded dark:bg-green-500/20 dark:border-transparent"
                                                                    href="{{ Storage::url(str_replace('doc/', 'certification/', $file)) }}"
                                                                    target="_blank">
                                                                    View
                                                                </a>
                                                                <a class="inline-flex items-center px-4 py-2 text-xs font-medium text-left text-yellow-500 bg-yellow-100 border border-transparent rounded dark:bg-yellow-500/20 dark:border-transparent"
                                                                    href="#"><i data-lucide="circle-dashed"
                                                                        class="size-3 ltr:mr-1 rtl:ml-1"></i> Pending</a>
                                                            @else
                                                                <a class="inline-flex items-center px-4 py-2 text-xs font-medium text-green-500 bg-green-100 border border-transparent rounded dark:bg-green-500/20 dark:border-transparent"
                                                                    href="{{ Storage::url(str_replace('doc/', 'certification/', $file)) }}"
                                                                    target="_blank">
                                                                    View
                                                                </a>
                                                                <a class="inline-flex items-center px-4 py-2 text-xs font-medium text-left text-green-500 bg-green-100 border border-transparent rounded dark:bg-green-500/20 dark:border-transparent"
                                                                    href="#"><i data-lucide="check-circle-2"
                                                                        class="size-3 ltr:mr-1 rtl:ml-1"></i> Submitted</a>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                        {{-- End Enrollment Certification --}}

                        {{-- start Horable dismissal --}}

                        <h6 class="mt-10 text-15">Honorable Dismissal (Transferee) <sup class="text-red-500">*
                                required</sup></h6>

                        {{-- show if the re_sttuss i not published --}}
                        @if (optional($requirements->first())->req_status == 0)
                            <form action="{{ route('student.requirements.honorable-dismissal.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                @error('honorable_dismisal_files.*')
                                    <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                                @enderror

                                <div class="grid items-center grid-cols-1 gap-2 xl:grid-cols-4">

                                    <input type="file" name="honorable_dismisal_files[]" multiple="multiple"
                                        class="mb-2 cursor-pointer form-file border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500"
                                        placeholder="Enter your name">

                                    <button type="submit" id="uploadButton"
                                        class="text-white bg-green-500 border-green-500 btn hover:text-white hover:bg-green-600 hover:border-green-600 focus:text-white focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-100 active:text-white active:bg-green-600 active:border-green-600 active:ring active:ring-green-100 dark:ring-green-400/10">
                                        <i data-lucide="upload" class="inline-block size-4 dark:text-zink-200"></i>
                                        Upload Honorable Dismissal</button>
                                </div>
                            </form>
                        @endif

                        @if ($requirements->isNotEmpty())
                            <div class="w-full overflow-x-auto">
                                <table class="w-full mt-4 border-separate table-custom border-spacing-y-1 min-w-max">
                                    <thead>
                                        <tr
                                            class="relative rounded-md bg-slate-50 after:absolute after:border-l-2 after:left-0 after:top-0 after:bottom-0 after:border-transparent dark:bg-zink-600 [&.active]:after:border-custom-500">
                                            <th
                                                class="px-3.5 py-2.5 font-semibold ltr:text-left rtl:text-right whitespace-nowrap">
                                                Details</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($requirements as $requirement)
                                            @php
                                                $honorable_dismisal_files = json_decode(
                                                    $requirement->honorable_dismisal,
                                                    true,
                                                );
                                            @endphp

                                            @if (!empty($honorable_dismisal_files))
                                                @foreach ($honorable_dismisal_files as $file)
                                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                                        <td class="px-4 py-2 whitespace-nowrap">
                                                            @if ($requirement->req_status == 0)
                                                                <a class="inline-flex items-center px-4 py-2 mb-2 text-xs font-medium text-red-500 bg-red-100 border border-transparent rounded dark:bg-red-500/20 dark:border-transparent"
                                                                    href="#">
                                                                    Delete
                                                                </a>
                                                                <a class="inline-flex items-center px-4 py-2 text-xs font-medium text-green-500 bg-green-100 border border-transparent rounded dark:bg-green-500/20 dark:border-transparent"
                                                                    href="{{ Storage::url(str_replace('doc/', 'honorable-dismissal/', $file)) }}"
                                                                    target="_blank">
                                                                    View
                                                                </a>
                                                                <a class="inline-flex items-center px-4 py-2 text-xs font-medium text-left text-yellow-500 bg-yellow-100 border border-transparent rounded dark:bg-yellow-500/20 dark:border-transparent"
                                                                    href="#"><i data-lucide="circle-dashed"
                                                                        class="size-3 ltr:mr-1 rtl:ml-1"></i> Pending</a>
                                                            @else
                                                                <a class="inline-flex items-center px-4 py-2 text-xs font-medium text-green-500 bg-green-100 border border-transparent rounded dark:bg-green-500/20 dark:border-transparent"
                                                                    href="{{ Storage::url(str_replace('doc/', 'honorable-dismissal/', $file)) }}"
                                                                    target="_blank">
                                                                    View
                                                                </a>
                                                                <a class="inline-flex items-center px-4 py-2 text-xs font-medium text-left text-green-500 bg-green-100 border border-transparent rounded dark:bg-green-500/20 dark:border-transparent"
                                                                    href="#"><i data-lucide="check-circle-2"
                                                                        class="size-3 ltr:mr-1 rtl:ml-1"></i> Submitted</a>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                        {{-- end Honorable dismissal --}}

                        {{-- start TOR --}}

                        <h6 class="mt-10 text-15">Transcript of Records - TOR (Transferee) <sup class="text-red-500">*
                                required</sup></h6>

                        @if (optional($requirements->first())->req_status == 0)
                            <form action="{{ route('student.requirements.tor.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                @error('tor_files.*')
                                    <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                                @enderror
                                <div class="grid items-center grid-cols-1 gap-2 xl:grid-cols-4">

                                    <input type="file" name="tor_files[]" multiple="multiple"
                                        class="mb-2 cursor-pointer form-file border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500"
                                        placeholder="Enter your name">

                                    <button type="submit" id="uploadButton"
                                        class="text-white bg-green-500 border-green-500 btn hover:text-white hover:bg-green-600 hover:border-green-600 focus:text-white focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-100 active:text-white active:bg-green-600 active:border-green-600 active:ring active:ring-green-100 dark:ring-green-400/10">
                                        <i data-lucide="upload" class="inline-block size-4 dark:text-zink-200"></i>
                                        Upload TOR</button>
                                </div>
                            </form>
                        @endif

                        @if ($requirements->isNotEmpty())
                            <div class="w-full overflow-x-auto">
                                <table class="w-full mt-4 border-separate border-spacing-y-1 min-w-max">
                                    <thead>
                                        <tr
                                            class="relative rounded-md bg-slate-50 dark:bg-zink-600 after:absolute after:border-l-2 after:left-0 after:top-0 after:bottom-0 after:border-transparent">
                                            <th class="px-3.5 py-2 font-semibold text-left whitespace-nowrap">Details</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($requirements as $requirement)
                                            @php
                                                $tor_files = json_decode($requirement->tor, true);
                                            @endphp

                                            @if (!empty($tor_files))
                                                @foreach ($tor_files as $file)
                                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                                        <td class="px-4 py-2 whitespace-nowrap">
                                                            @if ($requirement->req_status == 0)
                                                                <a class="inline-flex items-center px-4 py-2 mb-2 text-xs font-medium text-red-500 bg-red-100 border border-transparent rounded dark:bg-red-500/20 dark:border-transparent"
                                                                    href="#">
                                                                    Delete
                                                                </a>
                                                                <a class="inline-flex items-center px-4 py-2 text-xs font-medium text-green-500 bg-green-100 border border-transparent rounded dark:bg-green-500/20 dark:border-transparent"
                                                                    href="{{ Storage::url(str_replace('doc/', 'tor/', $file)) }}"
                                                                    target="_blank">
                                                                    View
                                                                </a>
                                                                <a class="inline-flex items-center px-4 py-2 text-xs font-medium text-left text-yellow-500 bg-yellow-100 border border-transparent rounded dark:bg-yellow-500/20 dark:border-transparent"
                                                                    href="#"><i data-lucide="circle-dashed"
                                                                        class="size-3 ltr:mr-1 rtl:ml-1"></i> Pending</a>
                                                            @else
                                                                <a class="inline-flex items-center px-4 py-2 text-xs font-medium text-green-500 bg-green-100 border border-transparent rounded dark:bg-green-500/20 dark:border-transparent"
                                                                    href="{{ Storage::url(str_replace('doc/', 'tor/', $file)) }}"
                                                                    target="_blank">
                                                                    View
                                                                </a>
                                                                <a class="inline-flex items-center px-4 py-2 text-xs font-medium text-left text-green-500 bg-green-100 border border-transparent rounded dark:bg-green-500/20 dark:border-transparent"
                                                                    href="#"><i data-lucide="check-circle-2"
                                                                        class="size-3 ltr:mr-1 rtl:ml-1"></i> Submitted</a>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                        {{-- end Honorable dismissal --}}

                        <div class="grid grid-cols-1 gap-5 mt-5 lg:grid-cols-2 xl:grid-cols-12">
                        </div>

                        <div class="flex gap-2 mt-4">

                            @if ($requirements->isNotEmpty() && optional($requirements->first())->req_status == 0)
                                <button type="submit" id="submitButton"
                                    class="text-white bg-green-500 border-green-500 btn hover:text-white hover:bg-green-600 hover:border-green-600 focus:text-white focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-100 active:text-white active:bg-green-600 active:border-green-600 active:ring active:ring-green-100 dark:ring-green-400/10">
                                    <i data-lucide="upload" class="inline-block size-4 dark:text-zink-200"></i>
                                    Submit Requirements</button>
                            @elseif($requirements->isNotEmpty() && optional($requirements->first())->req_status == 1)
                                <a type="button" href="{{ route('student.applicant-requirements.index') }}"
                                    class="text-white bg-green-500 border-green-500 btn hover:text-white hover:bg-green-600 hover:border-green-600 focus:text-white focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-100 active:text-white active:bg-green-600 active:border-green-600 active:ring active:ring-green-100 dark:ring-green-400/10">
                                    Proceed to Next Step <i data-lucide="move-right"
                                        class="inline-block size-4 dark:text-zink-200"></i></a>
                            @endif
                        </div>
                    </div>


                </div>

            </div>


        </div>
    @elseif($applicant->applicant_profile_status == 0)
        <div class="flex gap-3 p-4 text-sm text-red-500 rounded-md bg-red-50 dark:bg-red-400/20">
            <i data-lucide="alert-triangle" class="inline-block size-4 mt-0.5 shrink-0"></i>
            <div>
                <h6 class="mb-1">Something is very wrong!</h6>
                <p class="mb-2">Upon checking your profile status, it has not been submitted or finalized yet and remains
                    in draft mode.</p>
                <a href="{{ route('student.applicant-profile.index') }}"
                    class="font-semibold text-red-600 transition hover:text-red-700"><i data-lucide="move-left"
                        class="inline-block h-4 align-middle"></i> Go Back </a>
            </div>
        </div>
    @else
        <h4>
            No Profile yet!
        </h4>
    @endif
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- swal publish --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("submitButton").addEventListener("click", function(event) {
                event.preventDefault(); // Prevent default action

                Swal.fire({
                    title: "Are you sure?",
                    text: "Submitting this will finalize your application requirements. Please ensure all details are correct before proceeding. Once your application requirements are published, you will not be able to update them.",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, publish it!",
                    cancelButtonText: "Cancel"
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Send AJAX request to publish
                        fetch("{{ route('student.requirements.publish') }}", {
                                method: "PUT",
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
                                            "Your uploaded requirements has been published. Click Proceed to Next Step",
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
