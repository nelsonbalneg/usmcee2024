@php
    // Ensure birthdate is formatted for the date input
    $birthdate = $cee_profile->birthdate ? \Carbon\Carbon::parse($cee_profile->birthdate)->format('Y-m-d') : '';
@endphp
@extends('student.layouts.master')
@section('title')
    Pre-registration - Student Profile Form
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
            <li class="text-slate-700 dark:text-zink-100">
                Profile
            </li>
        </ul>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-12 gap-x-5">

        @if ($app_no && $result->csa >= 25)

            <div class="xl:col-span-3">
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
            </div><!--end col-->

            <div class="xl:col-span-9">
                <form id="studentProfileForm" action="{{ route('student.applicant-profile.store') }}" method="POST">
                    @csrf
                    {{-- Success & Error Alert Notifications --}}
                    @php
                        $alertTypes = [
                            'success' => ['color' => 'green', 'message' => session('success')],
                            'error' => [
                                'color' => 'red',
                                'message' => $errors->any()
                                    ? 'You should check in on some of those fields below.'
                                    : null,
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

                    {{-- Personal Information --}}
                    <div class="card">

                        <div class="card-body">


                            <h6 class="mb-4 text-blue-500 uppercase text-15"><i data-lucide="user"
                                    class="inline-block text-blue-500 size-4 dark:text-zink-200"></i> PERSONAL INFORMATION
                            </h6>

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

                            <div class="grid grid-cols-1 gap-5 lg:grid-cols-2 xl:grid-cols-12">

                                <div class="xl:col-span-6">
                                    <label for="student_type" class="inline-block mb-2 text-base font-medium">Student Type
                                        <sup class="text-red-500">* required</sup></label>
                                    <select
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        name="student_type" data-choices data-choices-search-false>
                                        <option value="">Select</option>
                                        <option value="1"
                                            {{ isset($applicant) && $applicant->student_type == 1 ? 'selected' : '' }}>
                                            New Student</option>
                                        <option value="2"
                                            {{ isset($applicant) && $applicant->student_type == 2 ? 'selected' : '' }}>
                                            Transferee</option>
                                        <option value="3"
                                            {{ isset($applicant) && $applicant->student_type == 3 ? 'selected' : '' }}>
                                            Shiftee</option>
                                    </select>
                                </div><!--end col-->

                                <div class="mb-4 xl:col-span-6">
                                    <label for="freshmen_type" class="inline-block mb-2 text-base font-medium">Freshmen Type
                                        <sup class="text-red-500">* required</sup></label>
                                    <select
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        name="freshmen_type" data-choices data-choices-search-false>
                                        <option value="">Select</option>
                                        <option value="1"
                                            {{ isset($applicant) && $applicant->freshmen_type == 1 ? 'selected' : '' }}>
                                            Graduated Grade 12</option>
                                        <option value="2"
                                            {{ isset($applicant) && $applicant->freshmen_type == 2 ? 'selected' : '' }}>
                                            On-going Grade 12</option>
                                        <option value="3"
                                            {{ isset($applicant) && $applicant->freshmen_type == 3 ? 'selected' : '' }}>
                                            High School (Did Not Undergo Senior High)</option>
                                    </select>
                                </div><!--end col-->

                                <input type="hidden" name="user_id" value="{{ $cee_profile->id }}">
                                <input type="hidden" name="app_no" value="{{ $app_no->app_no }}">

                                <div class="xl:col-span-4">
                                    <label for="last_name" class="inline-block mb-2 text-base font-medium">Last Name <sup
                                            class="text-blue-500">* Read Only</sup></label>
                                    <input type="text" name="last_name"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('last_name', $cee_profile->lastname) }}" readonly>
                                </div><!--end col-->

                                <div class="xl:col-span-4">
                                    <label for="first_name" class="inline-block mb-2 text-base font-medium">First Name <sup
                                            class="text-blue-500">* Read Only</sup></label>
                                    <input type="text" name="first_name"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('first_name', $cee_profile->firstname) }}" readonly>
                                </div><!--end col-->

                                <div class="xl:col-span-4">
                                    <label for="middle_name" class="inline-block mb-2 text-base font-medium">Middle Name
                                        <sup class="text-blue-500">* Read Only</sup></label>
                                    <input type="text" name="middle_name"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value={{ old('middle_name', $cee_profile->middlename) }} readonly>
                                </div><!--end col-->

                                <div class="xl:col-span-4">
                                    <label for="ext_name1" class="inline-block mb-2 text-base font-medium">Suffix
                                        <sup class="text-blue-500">* Read only</sup></label>
                                    <select
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        name="ext_name1" data-choices data-choices-search-false disabled>
                                        <option value="">-Select-</option>
                                        <option value="Jr" {{ $cee_profile->suffix == 'Jr' ? 'selected' : '' }}>Jr
                                        </option>
                                        <option value="Sr" {{ $cee_profile->suffix == 'Sr' ? 'selected' : '' }}>Sr
                                        </option>
                                        <option value="I" {{ $cee_profile->suffix == 'I' ? 'selected' : '' }}>I
                                        </option>
                                        <option value="II" {{ $cee_profile->suffix == 'II' ? 'selected' : '' }}>II
                                        </option>
                                        <option value="III" {{ $cee_profile->suffix == 'III' ? 'selected' : '' }}>III
                                        </option>
                                        <option value="IV" {{ $cee_profile->suffix == 'IV' ? 'selected' : '' }}>IV
                                        </option>
                                        <option value="V" {{ $cee_profile->suffix == 'V' ? 'selected' : '' }}>V
                                        </option>
                                        <option value="VI" {{ $cee_profile->suffix == 'VI' ? 'selected' : '' }}>VI
                                        </option>
                                        <option value="VII" {{ $cee_profile->suffix == 'VII' ? 'selected' : '' }}>VII
                                        </option>
                                        <option value="VIII" {{ $cee_profile->suffix == 'VIII' ? 'selected' : '' }}>VIII
                                        </option>
                                    </select>
                                    <input type="hidden" name="ext_name" value="{{ $cee_profile->suffix }}">
                                </div><!--end col-->


                                <div class="xl:col-span-4">
                                    <label for="birthdate" class="inline-block mb-2 text-base font-medium">Birthdate<sup
                                            class="text-blue-500">* Read only</sup></label>
                                    <input type="date" name="birthdate"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        placeholder="Select date" data-provider="flatpickr" data-date-format="M d, Y"
                                        value="{{ \Carbon\Carbon::parse($birthdate)->format('Y-m-d') }}" disabled>

                                    <input type="hidden" name="date_of_birth" value="{{ $birthdate }}">
                                </div><!--end col-->

                                <div class="xl:col-span-2">
                                    <label for="mobile_no" class="inline-block mb-2 text-base font-medium">Mobile No <sup
                                            class="text-blue-500">* Read Only</sup></label>
                                    <input type="text" name="mobile_no"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value={{ old('mobile_no', $cee_profile->phone) }} readonly>
                                </div><!--end col-->

                                <div class="xl:col-span-2">
                                    <label for="gender" class="inline-block mb-2 text-base font-medium">Sex <sup
                                            class="text-blue-500">* Read Only</sup></label>
                                    <input type="text" name="gender"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value={{ old('gender', $cee_profile->sex) }} readonly>
                                </div><!--end col-->

                                <div class="xl:col-span-4">
                                    <label for="email" class="inline-block mb-2 text-base font-medium">Email Address
                                        <sup class="text-blue-500">* Read Only</sup></label>
                                    <input type="text" name="email"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value={{ old('email', $cee_profile->email) }} readonly>
                                </div><!--end col-->

                                <div class="xl:col-span-4">
                                    <label for="civil_status_id" class="inline-block mb-2 text-base font-medium">Civil
                                        Status <sup class="text-red-500">* required</sup></label>
                                    <select
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        name="civil_status_id" data-choices data-choices-search-false>
                                        <option value="">Select Civil Status</option>
                                        <option value="1"
                                            {{ isset($applicant) && $applicant->civil_status_id == 1 ? 'selected' : '' }}>
                                            Single</option>
                                        <option value="2"
                                            {{ isset($applicant) && $applicant->civil_status_id == 2 ? 'selected' : '' }}>
                                            Married</option>
                                        <option value="3"
                                            {{ isset($applicant) && $applicant->civil_status_id == 3 ? 'selected' : '' }}>
                                            Separated</option>
                                        <option value="4"
                                            {{ isset($applicant) && $applicant->civil_status_id == 4 ? 'selected' : '' }}>
                                            Widow/er</option>
                                    </select>
                                </div><!--end col-->

                                <div class="xl:col-span-4">
                                    <label for="religion_id" class="inline-block mb-2 text-base font-medium">Religion <sup
                                            class="text-red-500">* required</sup></label>
                                    <select
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        name="religion_id" data-choices data-choices-search-false>
                                        <option value="">Select Religion</option>
                                        @foreach ($religions as $religion)
                                            <option value="{{ $religion['religionId'] }}"
                                                {{ isset($applicant) && $applicant->religion_id == $religion['religionId'] ? 'selected' : '' }}>
                                                {{ $religion['religion'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div><!--end col-->

                                <div class="xl:col-span-4">
                                    <label for="nationality_id"
                                        class="inline-block mb-2 text-base font-medium">Nationality<sup
                                            class="text-red-500">*
                                            required</sup></label>
                                    <select
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        name="nationality_id" data-choices data-choices-search-false>
                                        <option value="">Select Nationality</option>
                                        @foreach ($nationalities as $nationality)
                                            <option value="{{ $nationality['nationalityId'] }}"
                                                {{ isset($applicant) && $applicant->nationality_id == $nationality['nationalityId'] ? 'selected' : '' }}>
                                                {{ $nationality['nationality'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div><!--end col-->

                                <div class="xl:col-span-4">
                                    <label for="height" class="inline-block mb-2 text-base font-medium">Height (cm)<sup
                                            class="text-red-500">* required</sup></label>
                                    <input type="number" name="height"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        placeholder="Enter Height" value="{{ old('height', $applicant->height ?? '') }}"
                                        required>
                                </div><!--end col-->

                                <div class="xl:col-span-4">
                                    <label for="weight" class="inline-block mb-2 text-base font-medium">Weight (kg) <sup
                                            class="text-red-500">* required</sup></label>
                                    <input type="number" name="weight"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        placeholder="Enter weight" value="{{ old('weight', $applicant->weight ?? '') }}"
                                        required>
                                </div><!--end col-->

                                <div class="xl:col-span-4">
                                    <label for="blood_type" class="inline-block mb-2 text-base font-medium">Blood Type
                                        <sup class="text-red-500">* required</sup></label>
                                    <select
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        name="blood_type" data-choices required>
                                        <option value="">Select Blood Type</option>
                                        <option value="A+"
                                            {{ old('blood_type', isset($applicant) ? $applicant->blood_type : '') == 'A+' ? 'selected' : '' }}>
                                            A+</option>
                                        <option value="A-"
                                            {{ old('blood_type', isset($applicant) ? $applicant->blood_type : '') == 'A-' ? 'selected' : '' }}>
                                            A-</option>
                                        <option value="B+"
                                            {{ old('blood_type', isset($applicant) ? $applicant->blood_type : '') == 'B+' ? 'selected' : '' }}>
                                            B+</option>
                                        <option value="B-"
                                            {{ old('blood_type', isset($applicant) ? $applicant->blood_type : '') == 'B-' ? 'selected' : '' }}>
                                            B-</option>
                                        <option value="AB+"
                                            {{ old('blood_type', isset($applicant) ? $applicant->blood_type : '') == 'AB+' ? 'selected' : '' }}>
                                            AB+</option>
                                        <option value="AB-"
                                            {{ old('blood_type', isset($applicant) ? $applicant->blood_type : '') == 'AB-' ? 'selected' : '' }}>
                                            AB-</option>
                                        <option value="O+"
                                            {{ old('blood_type', isset($applicant) ? $applicant->blood_type : '') == 'O+' ? 'selected' : '' }}>
                                            O+</option>
                                        <option value="O-"
                                            {{ old('blood_type', isset($applicant) ? $applicant->blood_type : '') == 'O-' ? 'selected' : '' }}>
                                            O-</option>
                                    </select>
                                </div><!--end col-->

                                <div class="xl:col-span-2">
                                    <label for="no_of_brothers" class="inline-block mb-2 text-base font-medium">Number of
                                        Brothers
                                        <sup class="text-red-500">* required</sup>
                                    </label>
                                    <input type="number" name="no_of_brothers"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('no_of_brothers', $applicant->no_of_brothers ?? '') }}"
                                        placeholder="Enter Number of Brothers">
                                </div><!--end col-->

                                <div class="xl:col-span-2">
                                    <label for="no_of_sisters" class="inline-block mb-2 text-base font-medium">Number of
                                        Sisters
                                        <sup class="text-red-500">* required</sup>
                                    </label>
                                    <input type="number" name="no_of_sisters"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('no_of_sisters', $applicant->no_of_sisters ?? '') }}"
                                        placeholder="Enter Number of Sisters">
                                </div><!--end col-->

                                <div class="xl:col-span-2">
                                    <label for="is_illegitimate_child"
                                        class="inline-block mb-2 text-base font-medium">Legitimate Child?
                                        <sup class="text-red-500">* required</sup>
                                    </label>
                                    <select
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        name="is_illegitimate_child" data-choices>
                                        <option value="">Select</option>
                                        <option value="1"
                                            {{ old('is_illegitimate_child', isset($applicant) ? $applicant->is_illegitimate_child : '') == '1' ? 'selected' : '' }}>
                                            Yes</option>
                                        <option value="0"
                                            {{ old('is_illegitimate_child', isset($applicant) ? $applicant->is_illegitimate_child : '') == '0' ? 'selected' : '' }}>
                                            No</option>
                                    </select>
                                </div><!--end col-->
                                <div class="xl:col-span-2">
                                    <label for="tribe_id" class="inline-block mb-2 text-base font-medium">Tribe
                                        <sup class="text-red-500">* required</sup>
                                    </label>
                                    <select
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        name="tribe_id" data-choices>
                                        <option value="">Select a tribe</option>
                                        @foreach ($tribes as $tribe)
                                            <option value="{{ $tribe['tribeId'] }}"
                                                {{ old('tribe_id', isset($applicant) ? $applicant->tribe_id : '') == $tribe['tribeId'] ? 'selected' : '' }}>
                                                {{ $tribe['tribeName'] }}
                                            </option>
                                        @endforeach

                                    </select>
                                </div><!--end col-->

                                {{-- IP Member? --}}
                                <div class="xl:col-span-2">
                                    <label for="ip_member" class="inline-block mb-2 text-base font-medium">IP Member?
                                        <sup class="text-red-500">* required</sup>
                                    </label>
                                    <select
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        name="ip_member" data-choices>
                                        <option value="">Select</option>
                                        <option value="1"
                                            {{ old('ip_member', isset($applicant) ? $applicant->ip_member : '') == '1' ? 'selected' : '' }}>
                                            Yes</option>
                                        <option value="0"
                                            {{ old('ip_member', isset($applicant) ? $applicant->ip_member : '') == '0' ? 'selected' : '' }}>
                                            No</option>
                                    </select>
                                </div><!--end col-->


                                <div class="xl:col-span-2">
                                    <label for="ip_member_tribe" class="inline-block mb-2 text-base font-medium">IP Member
                                        Tribe
                                        <sup class="text-green-500">* optional</sup>
                                    </label>
                                    <input type="text" name="ip_member_tribe"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('ip_member_tribe', $applicant->ip_member_tribe ?? '') }}"
                                        placeholder="Enter IP Member Tribe">
                                </div><!--end col-->

                                {{-- IS PWD? --}}
                                <div class="xl:col-span-2">
                                    <label for="pwd_member" class="inline-block mb-2 text-base font-medium">PWD?
                                        <sup class="text-red-500">* required</sup>
                                    </label>
                                    <select
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        name="pwd_member" data-choices>
                                        <option value="">Select</option>
                                        <option value="1"
                                            {{ old('pwd_member', isset($applicant) ? $applicant->pwd_member : '') == '1' ? 'selected' : '' }}>
                                            Yes</option>
                                        <option value="0"
                                            {{ old('pwd_member', isset($applicant) ? $applicant->pwd_member : '') == '0' ? 'selected' : '' }}>
                                            No</option>
                                    </select>
                                </div><!--end col-->

                                <div class="xl:col-span-2">
                                    <label for="pwd_member_id" class="inline-block mb-2 text-base font-medium">
                                        PWD ID Number <sup class="text-red-500">* required</sup></label>
                                    <input type="text" name="pwd_member_id"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value={{ old('pwd_member_id', $applicant->pwd_member_id ?? '') }}>
                                </div><!--end col-->

                                <div class="xl:col-span-4">
                                    <label for="pwd_category" class="inline-block mb-2 text-base font-medium">
                                        PWD Category <sup class="text-red-500">* required</sup></label>
                                    <input type="text" name="pwd_category"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value={{ old('pwd_category', $applicant->pwd_category ?? '') }}>
                                </div><!--end col-->

                                {{-- IS Solo Parent? --}}
                                <div class="xl:col-span-2">
                                    <label for="solo_parent" class="inline-block mb-2 text-base font-medium">Solo Parent?
                                        <sup class="text-red-500">* required</sup>
                                    </label>
                                    <select
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        name="solo_parent" data-choices>
                                        <option value="">Select</option>
                                        <option value="1"
                                            {{ old('solo_parent', isset($applicant) ? $applicant->solo_parent : '') == '1' ? 'selected' : '' }}>
                                            Yes</option>
                                        <option value="0"
                                            {{ old('solo_parent', isset($applicant) ? $applicant->solo_parent : '') == '0' ? 'selected' : '' }}>
                                            No</option>
                                    </select>
                                </div><!--end col-->

                                <div class="xl:col-span-2">
                                    <label for="solo_parent_id" class="inline-block mb-2 text-base font-medium">Solo
                                        Parent ID
                                        <sup class="text-red-500">* required</sup></label>
                                    <input type="text" name="solo_parent_id"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('solo_parent_id', $applicant->solo_parent_id ?? '') }}">
                                </div><!--end col-->


                                <div class="xl:col-span-8">
                                    <label for="place_of_birth" class="inline-block mb-2 text-base font-medium">Place of
                                        Birth <sup class="text-red-500">* required</sup></label>
                                    <input type="text" name="place_of_birth"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('place_of_birth', $applicant->place_of_birth ?? '') }}">
                                </div><!--end col-->





                            </div><!--end grid-->

                        </div>
                    </div><!--end card-->

                    {{-- Residence and Permanent Address --}}
                    <div class="card">
                        <div class="card-body">

                            <div class="grid grid-cols-1 gap-5 lg:grid-cols-2 xl:grid-cols-12">
                                <div class="mt-2 xl:col-span-12">
                                    <h6 class="text-blue-500 uppercase text-15">
                                        <i data-lucide="map-pin-house"
                                            class="inline-block text-blue-500 size-4 dark:text-zink-200"></i>
                                        RESIDENCE AND PERMANENT ADDRESS
                                    </h6>
                                </div>

                                <!-- Residential Address Section -->
                                <div id="residentAddressSection" class="col-span-12 mt-4">
                                    <h6 class="text-green-500 uppercase text-15 xl:col-span-12">Residential Address</h6>
                                    <div class="grid grid-cols-1 gap-4 mt-4 md:grid-cols-2 xl:grid-cols-4">
                                        <div>
                                            <label for="res_region" class="inline-block mb-2 text-base font-medium">Region
                                                <sup class="text-red-500">* required</sup>
                                            </label>
                                            <select
                                                class="form-input border-slate-300 focus:outline-none focus:border-custom-500"
                                                id="res_region" name="res_region"></select>
                                            <input type="hidden" name="region_text-res" id="region-text-res" required>
                                        </div>

                                        <div>
                                            <label for="res_province"
                                                class="inline-block mb-2 text-base font-medium">Province
                                                <sup class="text-red-500">* required</sup>
                                            </label>
                                            <select
                                                class="form-input border-slate-300 focus:outline-none focus:border-custom-500"
                                                id="res_province" name="res_province">
                                                <option selected disabled>Choose Province</option>
                                            </select>
                                            <input type="hidden" name="province_text-res" id="province-text-res"
                                                required>
                                        </div>

                                        <div>
                                            <label for="res_towncity"
                                                class="inline-block mb-2 text-base font-medium">Municipality/City
                                                <sup class="text-red-500">* required</sup>
                                            </label>
                                            <select
                                                class="form-input border-slate-300 focus:outline-none focus:border-custom-500"
                                                id="res_towncity" name="res_towncity">
                                                <option selected disabled>Choose Municipality</option>
                                            </select>
                                            <input type="hidden" name="city_text-res" id="city-text-res" required>
                                        </div>

                                        <div>
                                            <label for="res_barangay"
                                                class="inline-block mb-2 text-base font-medium">Barangay
                                                <sup class="text-red-500">* required</sup>
                                            </label>
                                            <select
                                                class="form-input border-slate-300 focus:outline-none focus:border-custom-500"
                                                id="res_barangay" name="res_barangay">
                                                <option selected disabled>Choose Barangay</option>
                                            </select>
                                            <input type="hidden" name="barangay_text-res" id="barangay-text-res"
                                                required>
                                        </div>

                                        <div class="col-span-2">
                                            <label for="res_street" class="inline-block mb-2 text-base font-medium">Street
                                                <sup class="text-red-500">* required</sup>
                                            </label>
                                            <input type="text" id="res_street" name="res_street"
                                                class="w-full form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                                placeholder="Enter Street"
                                                value="{{ old('res_street', $applicant->res_street ?? '') }}" required>
                                        </div>

                                        <div class="col-span-2">
                                            <label for="res_zipcode" class="inline-block mb-2 text-base font-medium">Zip
                                                Code</label>
                                            <input type="text" id="res_zipcode" name="res_zipcode"
                                                class="w-full form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                                placeholder="Enter your zipcode"
                                                value="{{ old('res_zipcode', $applicant->res_zipcode ?? '') }}">
                                        </div>
                                    </div>
                                </div>

                                <!-- Permanent Address Section -->
                                <div id="permanentAddressSection" class="col-span-12 mt-4 ">
                                    <h6 class="text-green-500 uppercase text-15 xl:col-span-12">Permanent Address</h6>

                                    <div class="grid grid-cols-1 gap-4 mt-4 md:grid-cols-2 xl:grid-cols-4">
                                        <div>
                                            <label for="perm_region"
                                                class="inline-block mb-2 text-base font-medium">Region
                                                <sup class="text-red-500">* required</sup>
                                            </label>
                                            <select
                                                class="form-input border-slate-300 focus:outline-none focus:border-custom-500"
                                                id="perm_region" name="perm_region"></select>
                                            <input type="hidden" name="region_text-perm" id="region-text-perm">
                                        </div>

                                        <div>
                                            <label for="perm_province"
                                                class="inline-block mb-2 text-base font-medium">Province
                                                <sup class="text-red-500">* required</sup>
                                            </label>
                                            <select
                                                class="form-input border-slate-300 focus:outline-none focus:border-custom-500"
                                                id="perm_province" name="perm_province">
                                                <option selected disabled>Choose Province</option>
                                            </select>
                                            <input type="hidden" name="province_text-perm" id="province-text-perm">
                                        </div>

                                        <div>
                                            <label for="perm_towncity"
                                                class="inline-block mb-2 text-base font-medium">Municipality/City
                                                <sup class="text-red-500">* required</sup>
                                            </label>
                                            <select
                                                class="form-input border-slate-300 focus:outline-none focus:border-custom-500"
                                                id="perm_towncity" name="perm_towncity">
                                                <option selected disabled>Choose Municipality</option>
                                            </select>
                                            <input type="hidden" name="city_text-perm" id="city-text-perm">
                                        </div>

                                        <div>
                                            <label for="perm_barangay"
                                                class="inline-block mb-2 text-base font-medium">Barangay
                                                <sup class="text-red-500">* required</sup>
                                            </label>
                                            <select
                                                class="form-input border-slate-300 focus:outline-none focus:border-custom-500"
                                                id="perm_barangay" name="perm_barangay">
                                                <option selected disabled>Choose Barangay</option>
                                            </select>
                                            <input type="hidden" name="barangay_text-perm" id="barangay-text-perm">
                                        </div>

                                        <div class="col-span-2">
                                            <label for="perm_street"
                                                class="inline-block mb-2 text-base font-medium">Street
                                                <sup class="text-red-500">* required</sup>
                                            </label>
                                            <input type="text" id="perm_street" name="perm_street"
                                                class="w-full form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                                placeholder="Enter Street"
                                                value="{{ old('perm_street', $applicant->perm_street ?? '') }}">
                                        </div>

                                        <div class="col-span-2">
                                            <label for="perm_zipcode" class="inline-block mb-2 text-base font-medium">Zip
                                                Code</label>
                                            <input type="text" id="perm_zipcode" name="perm_zipcode"
                                                class="w-full form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                                placeholder="Enter your zipcode"
                                                value="{{ old('perm_zipcode', $applicant->perm_zipcode ?? '') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!--end card-->

                    {{-- parents  and Guardian Information --}}
                    <div class="card">
                        <div class="card-body">

                            <div class="grid grid-cols-1 gap-5 lg:grid-cols-2 xl:grid-cols-12">
                                <div class="mt-2 xl:col-span-12">
                                    <h6 class="text-blue-500 uppercase text-15"> <i data-lucide="monitor"
                                            class="inline-block text-blue-500 size-4 dark:text-zink-200"></i> PARENT AND
                                        GUARDIAN
                                        INFORMATION
                                    </h6>
                                </div>

                                <div class="xl:col-span-12">
                                    <h6 class="text-green-500 uppercase text-15 xl:col-span-12">PARENT INFORMATION</h6>
                                </div>

                                <div class="xl:col-span-4">
                                    <label for="father" class="inline-block mb-2 text-base font-medium">Father's Name
                                        <sup class="text-red-500">* required</sup>
                                    </label>
                                    <input type="text" name="father"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('father', $applicant->father ?? '') }}"
                                        placeholder="Enter Father's full name">
                                </div><!--end col-->

                                <div class="xl:col-span-4">
                                    <label for="father_birth_date"
                                        class="inline-block mb-2 text-base font-medium">Father's
                                        Birthdate
                                        <sup class="text-green-500">* optional</sup>
                                    </label>
                                    <input type="date" name="father_birth_date"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('father_birth_date', isset($applicant) ? \Carbon\Carbon::parse($applicant->father_birth_date)->format('Y-m-d') : '') }}"
                                        placeholder="Enter Father's Birthdate">
                                </div><!--end col-->

                                <div class="xl:col-span-4">
                                    <label for="father_educ_attain"
                                        class="inline-block mb-2 text-base font-medium">Father's
                                        Educationl Attainment
                                        <sup class="text-green-500">* optional</sup>
                                    </label>
                                    <input type="text" name="father_educ_attain"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('father_educ_attain', $applicant->father_educ_attain ?? '') }}"
                                        placeholder="Enter Father's educational attainment">
                                </div><!--end col-->

                                <div class="xl:col-span-4">
                                    <label for="father_occupation"
                                        class="inline-block mb-2 text-base font-medium">Father's
                                        Occupation</label>
                                    <input type="text" name="father_occupation"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('father_occupation', $applicant->father_occupation ?? '') }}"
                                        placeholder="Enter Father's Occupation">
                                </div><!--end col-->

                                <div class="xl:col-span-4">
                                    <label for="father_company" class="inline-block mb-2 text-base font-medium">Father's
                                        Company Name</label>
                                    <input type="text" name="father_company"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('father_company', $applicant->father_company ?? '') }}"
                                        placeholder="Enter Father's Company Name">
                                </div><!--end col-->
                                <div class="xl:col-span-4">
                                    <label for="father_company_address"
                                        class="inline-block mb-2 text-base font-medium">Father's
                                        Company Address</label>
                                    <input type="text" name="father_company_address"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('father_company_address', $applicant->father_company_address ?? '') }}"
                                        placeholder="Enter Father's Company Address">
                                </div><!--end col-->

                                <div class="xl:col-span-4">
                                    <label for="father_tel_no" class="inline-block mb-2 text-base font-medium">Father's
                                        Telephone No</label>
                                    <input type="text" name="father_tel_no"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('father_tel_no', $applicant->father_tel_no ?? '') }}"
                                        placeholder="Enter Father's Telephone #">
                                </div><!--end col-->

                                <div class="xl:col-span-4">
                                    <label for="father_email" class="inline-block mb-2 text-base font-medium">Father's
                                        Email</label>
                                    <input type="text" name="father_email"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('father_email', $applicant->father_email ?? '') }}"
                                        placeholder="Enter Father's email">
                                </div><!--end col-->

                                <div class="xl:col-span-4">
                                    <label for="father_income_from"
                                        class="inline-block mb-2 text-base font-medium">Father's
                                        Monthly Income</label>
                                    <input type="text" name="father_income_from"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('father_income_from', $applicant->father_income_from ?? '') }}"
                                        placeholder="Enter Father's monthly income">
                                </div><!--end col-->


                                <div class="xl:col-span-4">
                                    <label for="mother" class="inline-block mb-2 text-base font-medium">Mother's
                                        Name <sup class="text-red-500">* required</sup></label>
                                    <input type="text" name="mother"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('mother', $applicant->mother ?? '') }}"
                                        placeholder="Enter Mother's full name">
                                </div><!--end col-->

                                <div class="xl:col-span-4">
                                    <label for="mother_birth_date"
                                        class="inline-block mb-2 text-base font-medium">Mother's
                                        Birthdate
                                        <sup class="text-green-500">* optional</sup>
                                    </label>
                                    <input type="date" name="mother_birth_date"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('mother_birth_date', isset($applicant) ? \Carbon\Carbon::parse($applicant->mother_birth_date)->format('Y-m-d') : '') }}"
                                        placeholder="Enter Mothers's Birthdate">
                                </div><!--end col-->

                                <div class="xl:col-span-4">
                                    <label for="mother_educ_attain"
                                        class="inline-block mb-2 text-base font-medium">Mother's
                                        Educationl Attainment
                                        <sup class="text-green-500">* optional</sup>
                                    </label>
                                    <input type="text" name="mother_educ_attain"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('mother_educ_attain', $applicant->mother_educ_attain ?? '') }}"
                                        placeholder="Enter Mother's educational attainment">
                                </div><!--end col-->



                                <div class="xl:col-span-4">
                                    <label for="mother_occupation"
                                        class="inline-block mb-2 text-base font-medium">Mother's
                                        Occupation</label>
                                    <input type="text" name="mother_occupation"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('mother_occupation', $applicant->mother_occupation ?? '') }}"
                                        placeholder="Enter Mother's Occupation">
                                </div><!--end col-->

                                <div class="xl:col-span-4">
                                    <label for="mother_company" class="inline-block mb-2 text-base font-medium">Mother's
                                        Occupation</label>
                                    <input type="text" name="mother_company"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('mother_company', $applicant->mother_company ?? '') }}"
                                        placeholder="Enter Mother's Company Name">
                                </div><!--end col-->

                                <div class="xl:col-span-4">
                                    <label for="mother_company_address"
                                        class="inline-block mb-2 text-base font-medium">Mother's
                                        Company Address</label>
                                    <input type="text" name="mother_company_address"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('mother_company_address', $applicant->mother_company_address ?? '') }}"
                                        placeholder="Enter Mother's Company Address">
                                </div><!--end col-->

                                <div class="xl:col-span-4">
                                    <label for="mother_tel_no" class="inline-block mb-2 text-base font-medium">Mother's
                                        Telephone No</label>
                                    <input type="text" name="mother_tel_no"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('mother_tel_no', $applicant->mother_tel_no ?? '') }}"
                                        placeholder="Enter Mother's Telephone #">
                                </div><!--end col-->

                                <div class="xl:col-span-4">
                                    <label for="mother_email" class="inline-block mb-2 text-base font-medium">Mother's
                                        Email</label>
                                    <input type="email" name="mother_email"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('mother_email', $applicant->mother_email ?? '') }}"
                                        placeholder="Enter Mother's email">
                                </div><!--end col-->

                                <div class="xl:col-span-4">
                                    <label for="mother_income_from"
                                        class="inline-block mb-2 text-base font-medium">Mother's
                                        Monthly Income</label>
                                    <input type="text" name="mother_income_from"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('mother_income_from', $applicant->mother_income_from ?? '') }}"
                                        placeholder="Enter Mother's monthly income">
                                </div><!--end col-->

                                {{-- Guardian Information --}}
                                <div class="xl:col-span-12">
                                    <h6 class="text-green-500 uppercase text-15 xl:col-span-12">GUARDIAN INFORMATION</h6>
                                </div>

                                <div class="xl:col-span-6">
                                    <label for="guardian" class="inline-block mb-2 text-base font-medium">Guardian Full
                                        Name
                                        <sup class="text-red-500">* required</sup>
                                    </label>
                                    <input type="text" name="guardian"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('guardian', $applicant->guardian ?? '') }}"
                                        placeholder="Enter Guardian's full name">
                                </div><!--end col-->

                                <div class="xl:col-span-6">
                                    <label for="guardian_relationship"
                                        class="inline-block mb-2 text-base font-medium">Relationship
                                        <sup class="text-red-500">* required</sup>
                                    </label>
                                    <input type="text" name="guardian_relationship"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('guardian_relationship', $applicant->guardian_relationship ?? '') }}"
                                        placeholder="Enter relationship">
                                </div><!--end col-->

                                <div class="xl:col-span-6">
                                    <label for="guardian_occupation"
                                        class="inline-block mb-2 text-base font-medium">Guardian's
                                        Occupation <sup class="text-red-500">* required</label>
                                    <input type="text" name="guardian_occupation"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('guardian_occupation', $applicant->guardian_occupation ?? '') }}"
                                        placeholder="Enter Guardians's Occupation">
                                </div><!--end col-->

                                <div class="xl:col-span-6">
                                    <label for="guardian_company"
                                        class="inline-block mb-2 text-base font-medium">Guardian's
                                        Company Name <sup class="text-red-500">* required</label>
                                    <input type="text" name="guardian_company"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('guardian_company', $applicant->guardian_company ?? '') }}"
                                        placeholder="Enter Guardian's Company Name">
                                </div><!--end col-->

                                <div class="xl:col-span-6">
                                    <label for="guardian_telno" class="inline-block mb-2 text-base font-medium">Guardian's
                                        Telephone No</label>
                                    <input type="text" name="guardian_telno"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('guardian_telno', $applicant->guardian_telno ?? '') }}"
                                        placeholder="Enter Guardian's Telephone #">
                                </div><!--end col-->

                                <div class="xl:col-span-6">
                                    <label for="guardian_email" class="inline-block mb-2 text-base font-medium">Guardian's
                                        Email</label>
                                    <input type="email" name="guardian_email"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('guardian_email', $applicant->guardian_email ?? '') }}"
                                        placeholder="Enter Mother's email">
                                </div><!--end col-->

                                {{-- Guardian Address --}}
                                <div class="xl:col-span-12">
                                    <h6 class="text-green-500 uppercase text-15 xl:col-span-12">GUARDIAN ADDRESS</h6>
                                </div>

                                <div class="xl:col-span-3">
                                    <label for="guardian_region" class="inline-block mb-2 text-base font-medium">Region
                                        <sup class="text-red-500">* required</sup>
                                    </label>
                                    <select class="form-input border-slate-300 focus:outline-none focus:border-custom-500"
                                        id="guardian_region" name="guardian_region">
                                        <option selected="true" disabled>Choose Region</option>
                                    </select>
                                    <input type="hidden" name="region_text-guardian" id="region-text-guardian" required>
                                </div><!--end col-->

                                <div class="xl:col-span-3">
                                    <label for="guardian_province"
                                        class="inline-block mb-2 text-base font-medium">Province
                                        <sup class="text-red-500">* required</sup></label>
                                    <select class="form-input border-slate-300 focus:outline-none focus:border-custom-500"
                                        id="guardian_province" name="guardian_province">
                                        <option selected="true" disabled>Choose Province</option>
                                    </select>
                                    <input type="hidden" name="province_text-guardian" id="province-text-guardian"
                                        required>
                                </div><!--end col-->
                                <div class="xl:col-span-3">
                                    <label for="guardian_towncity"
                                        class="inline-block mb-2 text-base font-medium">Municipality/City
                                        <sup class="text-red-500">* required</sup></label>
                                    <select class="form-input border-slate-300 focus:outline-none focus:border-custom-500"
                                        id="guardian_towncity" name="guardian_towncity">
                                        <option selected="true" disabled>Choose Municipality</option>
                                    </select>
                                    <input type="hidden" name="city_text-guardian" id="city-text-guardian" required>
                                </div><!--end col-->

                                <div class="xl:col-span-3">
                                    <label for="guardian_barangay"
                                        class="inline-block mb-2 text-base font-medium">Barangay
                                        <sup class="text-red-500">* required</sup></label>
                                    <select class="form-input border-slate-300 focus:outline-none focus:border-custom-500"
                                        id="guardian_barangay" name="guardian_barangay">
                                        <option selected="true" disabled>Choose Barangay</option>
                                    </select>
                                    <input type="hidden" name="barangay_text-guardian" id="barangay-text-guardian"
                                        required>
                                </div><!--end col-->

                                <div class="xl:col-span-6">
                                    <label for="guardian_street" class="inline-block mb-2 text-base font-medium">Street
                                        <sup class="text-red-500">* required</sup>
                                    </label>
                                    <input type="text" id="guardian_street" name="guardian_street"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        placeholder="Enter Street"
                                        value="{{ old('guardian_telno', $applicant->guardian_street ?? '') }}" required>
                                </div><!--end col-->

                                <div class="xl:col-span-6">
                                    <label for="guardian_zipcode" class="inline-block mb-2 text-base font-medium">Zip
                                        Code<span></label>
                                    <input type="text" id="guardian_zipcode" name="guardian_zipcode"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('guardian_telno', $applicant->guardian_zipcode ?? '') }}"
                                        placeholder="Enter your zipcode">
                                </div><!--end col-->
                            </div><!--end grid-->

                        </div>
                    </div><!--end card-->

                    {{-- Educational Background --}}
                    <div class="card">
                        <div class="card-body">
                            <h6 class="mb-4 text-blue-500 uppercase text-15"><i data-lucide="school"
                                    class="inline-block text-blue-500 size-4 dark:text-zink-200"></i> EDUCATIONAL
                                BACKGROUND
                            </h6>
                            {{-- <form action="#!"> --}}
                            <div class="grid grid-cols-1 gap-5 lg:grid-cols-2 xl:grid-cols-12">

                                {{-- Elementary --}}
                                <div class="xl:col-span-4">
                                    <label for="elem_school" class="inline-block mb-2 text-base font-medium">Elementary
                                        <sup class="text-red-500">* required</sup></label>
                                    <input type="text" name="elem_school"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('elem_school', $applicant->elem_school ?? '') }}"
                                        placeholder="Enter name of elementary school" />
                                </div><!--end col-->

                                <div class="xl:col-span-4">
                                    <label for="elem_address" class="inline-block mb-2 text-base font-medium">Elementary
                                        Address <sup class="text-red-500">* required</sup></label>
                                    <input type="text" name="elem_address"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('elem_address', $applicant->elem_address ?? '') }}"
                                        placeholder="Enter name of elementary address">
                                </div><!--end col-->

                                <div class="xl:col-span-4">
                                    <label for="elem_incldates" class="inline-block mb-2 text-base font-medium">Inclusive
                                        Dates
                                        <sup class="text-red-500">* required</sup></label>
                                    <input type="text" name="elem_incldates"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('elem_incldates', $applicant->elem_incldates ?? '') }}"
                                        placeholder="Enter inclusive date ">
                                </div><!--end col-->

                                <div class="xl:col-span-12">
                                    <label for="elem_award_honor"
                                        class="inline-block mb-2 text-base font-medium">Elementary
                                        Awards/Honor
                                        <sup class="text-green-500">* optional</sup></label>
                                    <input type="text" name="elem_award_honor"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('elem_award_honor', $applicant->elem_award_honor ?? '') }}"
                                        placeholder="Enter name of elementary awards and/or honor">
                                </div><!--end col-->


                                {{-- HIgh school --}}
                                <div class="xl:col-span-4">
                                    <label for="hs_school" class="inline-block mb-2 text-base font-medium">High School
                                        <sup class="text-red-500">* required</sup></label>
                                    <input type="text" name="hs_school"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('hs_school', $applicant->hs_school ?? '') }}"
                                        placeholder="Enter name of high school" />
                                </div><!--end col-->

                                <div class="xl:col-span-4">
                                    <label for="hs_address" class="inline-block mb-2 text-base font-medium">High School
                                        Address <sup class="text-red-500">* required</sup></label>
                                    <input type="text" name="hs_address"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('hs_address', $applicant->hs_address ?? '') }}"
                                        placeholder="Enter name of high school address">
                                </div><!--end col-->

                                <div class="xl:col-span-4">
                                    <label for="hs_incldates" class="inline-block mb-2 text-base font-medium">Inclusive
                                        Dates
                                        <sup class="text-red-500">* required</sup></label>
                                    <input type="text" name="hs_incldates"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('hs_incldates', $applicant->hs_incldates ?? '') }}"
                                        placeholder="Enter inclusive date ">
                                </div><!--end col-->

                                <div class="xl:col-span-12">
                                    <label for="hs_award_honor" class="inline-block mb-2 text-base font-medium">High
                                        School
                                        Awards/Honor
                                        <sup class="text-green-500">* optional</sup></label>
                                    <input type="text" name="hs_award_honor"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('hs_award_honor', $applicant->hs_award_honor ?? '') }}"
                                        placeholder="Enter name of high school awards and/or honor">
                                </div><!--end col-->


                                {{-- Senior High school --}}
                                <div class="xl:col-span-4">
                                    <label for="shs_school" class="inline-block mb-2 text-base font-medium">Senior High
                                        School
                                        <sup class="text-red-500">* required</sup></label>
                                    <input type="text" name="shs_school"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('shs_school', $applicant->shs_school ?? '') }}"
                                        placeholder="Enter name of senior high school" />
                                </div><!--end col-->

                                <div class="xl:col-span-4">
                                    <label for="shs_address" class="inline-block mb-2 text-base font-medium">Senior High
                                        School
                                        Address <sup class="text-red-500">* required</sup></label>
                                    <input type="text" name="shs_address"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('shs_address', $applicant->shs_address ?? '') }}"
                                        placeholder="Enter name of senior high school address">
                                </div><!--end col-->

                                <div class="xl:col-span-4">
                                    <label for="shs_incldates" class="inline-block mb-2 text-base font-medium">Inclusive
                                        Dates
                                        <sup class="text-red-500">* required</sup></label>
                                    <input type="text" name="shs_incldates"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('shs_incldates', $applicant->shs_incldates ?? '') }}"
                                        placeholder="Enter inclusive date (e.g. June 11, 2023 - April 12, 2025)">
                                </div><!--end col-->

                                <div class="xl:col-span-12">
                                    <label for="shs_award_honor" class="inline-block mb-2 text-base font-medium">Senior
                                        High
                                        School
                                        Awards/Honor
                                        <sup class="text-green-500">* optional</sup></label>
                                    <input type="text" name="shs_award_honor"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('shs_award_honor', $applicant->shs_award_honor ?? '') }}"
                                        placeholder="Enter name of senior high school awards and/or honor">
                                </div><!--end col-->

                                {{-- Vocational school --}}
                                <div class="xl:col-span-4">
                                    <label for="vocational" class="inline-block mb-2 text-base font-medium">Vocational
                                        School
                                        <sup class="text-green-500">* optional</sup></label>
                                    <input type="text" name="vocational"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('vocational', $applicant->vocational ?? '') }}"
                                        placeholder="Enter name of vocational school" />
                                </div><!--end col-->

                                <div class="xl:col-span-4">
                                    <label for="vocational_address"
                                        class="inline-block mb-2 text-base font-medium">Vocational
                                        School
                                        Address <sup class="text-green-500">* optional</sup></label>
                                    <input type="text" name="vocational_address"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('vocational_address', $applicant->vocational_address ?? '') }}"
                                        placeholder="Enter name of vocational school address">
                                </div><!--end col-->


                                <div class="xl:col-span-4">
                                    <label for="vocational_degree"
                                        class="inline-block mb-2 text-base font-medium">Vocational
                                        Degree
                                        <sup class="text-green-500">* optional</sup></label>
                                    <input type="text" name="vocational_degree"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('vocational_degree', $applicant->vocational_degree ?? '') }}"
                                        placeholder="Enter name of vocational degree">
                                </div><!--end col-->

                                <div class="xl:col-span-4">
                                    <label for="vocational_incldates"
                                        class="inline-block mb-2 text-base font-medium">Inclusive Dates
                                        <sup class="text-green-500">* optional</sup></label>
                                    <input type="text" name="vocational_incldates"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('vocational_incldates', $applicant->vocational_incldates ?? '') }}"
                                        placeholder="Enter inclusive date ">
                                </div><!--end col-->

                                {{-- College school --}}
                                <div class="xl:col-span-4">
                                    <label for="college_school"
                                        class="inline-block mb-2 text-base font-medium">College/University
                                        <sup class="text-red-500">* required</sup></label>
                                    <input type="text" name="college_school"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('college_school', $applicant->college_school ?? '') }}"
                                        placeholder="Enter name of college last attended" />
                                </div><!--end col-->

                                <div class="xl:col-span-4">
                                    <label for="college_address"
                                        class="inline-block mb-2 text-base font-medium">College/University
                                        Address <sup class="text-red-500">* required</sup></label>
                                    <input type="text" name="college_address"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('college_address', $applicant->college_address ?? '') }}"
                                        placeholder="Enter name of college/university school address">
                                </div><!--end col-->


                                <div class="xl:col-span-4">
                                    <label for="college_degree" class="inline-block mb-2 text-base font-medium">College
                                        Degree
                                        <sup class="text-red-500">* required</sup></label>
                                    <input type="text" name="college_degree"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('college_degree', $applicant->college_degree ?? '') }}"
                                        placeholder="Enter name of college degree">
                                </div><!--end col-->

                                <div class="xl:col-span-4">
                                    <label for="college_incldates"
                                        class="inline-block mb-2 text-base font-medium">Inclusive
                                        Dates
                                        <sup class="text-green-500">* optional</sup></label>
                                    <input type="text" name="college_incldates"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('college_incldates', $applicant->college_incldates ?? '') }}"
                                        placeholder="Enter inclusive date ">
                                </div><!--end col-->
                            </div><!--end grid-->
                        </div>
                    </div><!--end card-->

                    {{-- Emergency Contact Details --}}
                    <div class="card">
                        <div class="card-body">
                            <h6 class="mb-4 text-blue-500 uppercase text-15"><i data-lucide="shield-alert"
                                    class="inline-block text-blue-500 size-4 dark:text-zink-200"></i> EMERGENCY CONTACT
                                DETAILS
                            </h6>
                            {{-- <form action="#!"> --}}
                            <div class="grid grid-cols-1 gap-5 lg:grid-cols-2 xl:grid-cols-12">

                                {{-- Elementary --}}
                                <div class="xl:col-span-4">
                                    <label for="emergency_contact"
                                        class="inline-block mb-2 text-base font-medium">Emergency
                                        Contact Full Name <sup class="text-red-500">* required</sup></label>
                                    <input type="text" name="emergency_contact"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('emergency_contact', $applicant->emergency_contact ?? '') }}"
                                        placeholder="Enter Emergency Contact Full Name " />
                                </div><!--end col-->

                                <div class="xl:col-span-4">
                                    <label for="emergency_mobileno"
                                        class="inline-block mb-2 text-base font-medium">Emergency
                                        Contact Mobile No.<sup class="text-red-500">* required</sup></label>
                                    <input type="text" name="emergency_mobileno"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('emergency_mobileno', $applicant->emergency_mobileno ?? '') }}"
                                        placeholder="Enter Emergency Contact Mobile No.">
                                </div><!--end col-->
                                <div class="xl:col-span-4">
                                    <label for="emergency_telno" class="inline-block mb-2 text-base font-medium">Emergency
                                        Contact Telephone No.<sup class="text-green-500">* optional</sup></label>
                                    <input type="text" name="emergency_telno"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('emergency_telno', $applicant->emergency_telno ?? '') }}"
                                        placeholder="Enter Emergency Contact Telephone No.">
                                </div><!--end col-->

                                <div class="xl:col-span-12">
                                    <label for="emergency_address"
                                        class="inline-block mb-2 text-base font-medium">Emergency
                                        Contact Address<sup class="text-red-500">* requred</sup></label>
                                    <input type="text" name="emergency_address"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        value="{{ old('emergency_address', $applicant->emergency_address ?? '') }}"
                                        placeholder="Enter Emergency Contact Address">
                                </div><!--end col-->



                            </div><!--end grid-->
                            <div class="flex gap-2 mt-4">
                                @if (
                                    $applicant->applicant_profile_status == 0 ||
                                        empty($applicant->applicant_profile_status) ||
                                        is_null(value: $applicant->applicant_profile_status))
                                    @if ($is_applicant_exist)
                                        <button type="submit" id="updateButton"
                                            class="text-white bg-yellow-500 border-yellow-500 btn hover:text-white hover:bg-yellow-600 hover:yellow-green-600 focus:text-white focus:bg-yellow-600 focus:border-yellow-600 focus:ring focus:ring-yellow-100 active:text-white active:bg-yellow-600 active:border-yellow-600 active:ring active:ring-yellow-100 dark:ring-yellow-400/10">
                                            <i data-lucide="pencil" class="inline-block size-4 dark:text-zink-200"></i>
                                            Update
                                            Information</button>

                                        <button type="submit" id="publishButton"
                                            class="text-white bg-green-500 border-green-500 btn hover:text-white hover:bg-green-600 hover:border-green-600 focus:text-white focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-100 active:text-white active:bg-green-600 active:border-green-600 active:ring active:ring-green-100 dark:ring-green-400/10">
                                            <i data-lucide="save" class="inline-block size-4 dark:text-zink-200"></i>
                                            Submit
                                            and Publish</button>
                                    @else
                                        <button type="submit" id="saveButton"
                                            class="text-white bg-green-500 border-green-500 btn hover:text-white hover:bg-green-600 hover:border-green-600 focus:text-white focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-100 active:text-white active:bg-green-600 active:border-green-600 active:ring active:ring-green-100 dark:ring-green-400/10">
                                            <i data-lucide="pencil-ruler"
                                                class="inline-block size-4 dark:text-zink-200"></i>
                                            Save My Information</button>
                                    @endif
                                @else
                                    <button type="button"
                                        class="text-green-500 bg-green-100 btn hover:text-white hover:bg-green-600 focus:text-white focus:bg-green-600 focus:ring focus:ring-green-100 active:text-white active:bg-green-600 active:ring active:ring-green-100 dark:bg-green-500/20 dark:text-green-400 dark:hover:bg-green-500 dark:hover:text-white dark:focus:bg-green-500 dark:focus:text-white dark:active:bg-green-500 dark:active:text-white dark:ring-green-400/20">
                                        <i data-lucide="circle-check-big"
                                            class="inline-block size-4 dark:text-zink-200"></i>
                                        Published</button>

                                    <a type="button" href="{{ route('student.applicant-requirements.index') }}"
                                        class="text-white bg-green-500 border-green-500 btn hover:text-white hover:bg-green-600 hover:border-green-600 focus:text-white focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-100 active:text-white active:bg-green-600 active:border-green-600 active:ring active:ring-green-100 dark:ring-green-400/10">
                                        Proceed to Next Step <i data-lucide="move-right"
                                            class="inline-block size-4 dark:text-zink-200"></i></a>
                                @endif


                            </div>
                        </div>
                    </div><!--end card-->

                </form>


            </div><!--end col-->
        @else
            <h1>Forbidden</h1>
        @endif


    </div><!--end grid-->
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const elements = document.querySelectorAll("[data-choices]");

            elements.forEach((element) => {
                new Choices(element, {
                    removeItemButton: true,
                    allowHTML: true,
                    searchEnabled: true,
                    itemSelectText: "Click to select",
                });
            });
        });
    </script>

    {{-- swal save --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("saveButton").addEventListener("click", function(event) {
                event.preventDefault(); // Prevent form submission

                Swal.fire({
                    title: "Please Read Me.",
                    text: "This will be saved as a draft. Please review all the details carefully. If there are any incorrect entries, you can update them. Once everything is correct, click the 'Publish' button to finalize.",
                    // text: "By submitting, you confirm that you have carefully reviewed all the details and they are accurate.",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, save it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById("studentProfileForm").submit(); // Submit form
                    }
                });
            });
        });
    </script>

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


    {{-- alert alert-success --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            setTimeout(function() {
                let alertBox = document.querySelector(".alert-success");
                if (alertBox) {
                    alertBox.style.transition = "opacity 0.5s";
                    alertBox.style.opacity = "0";
                    setTimeout(() => alertBox.remove(), 500); // Remove element after fade out
                }
            }, 3000); // Alert disappears after 3 seconds
        });
    </script>


    {{-- residential address --}}
    <script>
        $(document).ready(function() {
            var regionUrl = "{{ url('backend/assets/ph-json/region.json') }}";
            var provinceUrl = "{{ url('backend/assets/ph-json/province.json') }}";
            var cityUrl = "{{ url('backend/assets/ph-json/city.json') }}";
            var barangayUrl = "{{ url('backend/assets/ph-json/barangay.json') }}";

            var savedRegion = "{{ $applicant->res_region }}";
            var savedProvince = "{{ $applicant->res_province }}";
            var savedCity = "{{ $applicant->res_towncity }}";
            var savedBarangay = "{{ $applicant->res_barangay }}";

            // Populate Region Dropdown
            $.getJSON(regionUrl, function(data) {
                $('#res_region').append('<option selected disabled>Choose Region</option>');
                $.each(data, function(index, item) {
                    let selected = item.region_name == savedRegion ? "selected" : "";
                    $('#res_region').append(
                        `<option value="${item.region_code}" ${selected}>${item.region_name}</option>`
                    );
                });
                updateHiddenTextField('#res_region', '#region-text-res');

                // Trigger change event to load the Province dropdown if region is already selected
                if (savedRegion) $('#res_region').trigger('change');
            });

            // Province Dropdown based on Region selection
            $('#res_region').on('change', function() {
                var region_code = $(this).val();
                $('#res_province').empty().append('<option selected disabled>Choose Province</option>');

                $.getJSON(provinceUrl, function(data) {
                    var provinces = data.filter(function(province) {
                        return province.region_code == region_code;
                    });

                    $.each(provinces, function(index, item) {
                        let selected = item.province_name == savedProvince ? "selected" :
                            "";
                        $('#res_province').append(
                            `<option value="${item.province_code}" ${selected}>${item.province_name}</option>`
                        );
                    });
                    updateHiddenTextField('#res_province', '#province-text-res');

                    // Trigger change event to load the City dropdown if province is already selected
                    if (savedProvince) $('#res_province').trigger('change');
                });
            });

            // City Dropdown based on Province selection
            $('#res_province').on('change', function() {
                var province_code = $(this).val();
                $('#res_towncity').empty().append('<option selected disabled>Choose Municipality</option>');

                $.getJSON(cityUrl, function(data) {
                    var cities = data.filter(function(city) {
                        return city.province_code == province_code;
                    });

                    $.each(cities, function(index, item) {
                        let selected = item.city_name == savedCity ? "selected" : "";
                        $('#res_towncity').append(
                            `<option value="${item.city_code}" ${selected}>${item.city_name}</option>`
                        );
                    });
                    updateHiddenTextField('#res_towncity', '#city-text-res');

                    // Trigger change event to load the Barangay dropdown if city is already selected
                    if (savedCity) $('#res_towncity').trigger('change');
                });
            });

            // Barangay Dropdown based on City selection
            $('#res_towncity').on('change', function() {
                var city_code = $(this).val();
                $('#res_barangay').empty().append('<option selected disabled>Choose Barangay</option>');

                $.getJSON(barangayUrl, function(data) {
                    var barangays = data.filter(function(barangay) {
                        return barangay.city_code == city_code;
                    });

                    $.each(barangays, function(index, item) {
                        let selected = item.brgy_name == savedBarangay ? "selected" : "";
                        $('#res_barangay').append(
                            `<option value="${item.brgy_name}" ${selected}>${item.brgy_name}</option>`
                        );
                    });
                    updateHiddenTextField('#res_barangay', '#barangay-text-res');
                });
            });

            // Function to update hidden text field based on selected dropdown option
            function updateHiddenTextField(dropdownSelector, textFieldSelector) {
                var selectedText = $(dropdownSelector).find("option:selected").text();
                $(textFieldSelector).val(selectedText);
            }

            // Update hidden text fields on each dropdown change
            $('#res_region').on('change', function() {
                updateHiddenTextField('#res_region', '#region-text-res');
            });
            $('#res_province').on('change', function() {
                updateHiddenTextField('#res_province', '#province-text-res');
            });
            $('#res_towncity').on('change', function() {
                updateHiddenTextField('#res_towncity', '#city-text-res');
            });
            $('#res_barangay').on('change', function() {
                updateHiddenTextField('#res_barangay', '#barangay-text-res');
            });
        });
    </script>

    {{-- Permanent address --}}
    <script>
        $(document).ready(function() {
            var regionUrl = "{{ url('backend/assets/ph-json/region.json') }}";
            var provinceUrl = "{{ url('backend/assets/ph-json/province.json') }}";
            var cityUrl = "{{ url('backend/assets/ph-json/city.json') }}";
            var barangayUrl = "{{ url('backend/assets/ph-json/barangay.json') }}";

            var savedRegion = "{{ $applicant->perm_region }}";
            var savedProvince = "{{ $applicant->perm_province }}";
            var savedCity = "{{ $applicant->perm_towncity }}";
            var savedBarangay = "{{ $applicant->perm_barangay }}";

            // Populate Region Dropdown
            $.getJSON(regionUrl, function(data) {
                $('#perm_region').append('<option selected disabled>Choose Region</option>');
                $.each(data, function(index, item) {
                    let selected = item.region_name == savedRegion ? "selected" : "";
                    $('#perm_region').append(
                        `<option value="${item.region_code}" ${selected}>${item.region_name}</option>`
                    );
                });
                updateHiddenTextField('#perm_region', '#region-text-perm');

                // Trigger change event to load the Province dropdown if region is already selected
                if (savedRegion) $('#perm_region').trigger('change');
            });

            // Province Dropdown based on Region selection
            $('#perm_region').on('change', function() {
                var region_code = $(this).val();
                $('#perm_province').empty().append('<option selected disabled>Choose Province</option>');

                $.getJSON(provinceUrl, function(data) {
                    var provinces = data.filter(function(province) {
                        return province.region_code == region_code;
                    });

                    $.each(provinces, function(index, item) {
                        let selected = item.province_name == savedProvince ? "selected" :
                            "";
                        $('#perm_province').append(
                            `<option value="${item.province_code}" ${selected}>${item.province_name}</option>`
                        );
                    });
                    updateHiddenTextField('#perm_province', '#province-text-perm');

                    // Trigger change event to load the City dropdown if province is already selected
                    if (savedProvince) $('#perm_province').trigger('change');
                });
            });

            // City Dropdown based on Province selection
            $('#perm_province').on('change', function() {
                var province_code = $(this).val();
                $('#perm_towncity').empty().append(
                    '<option selected disabled>Choose Municipality</option>');

                $.getJSON(cityUrl, function(data) {
                    var cities = data.filter(function(city) {
                        return city.province_code == province_code;
                    });

                    $.each(cities, function(index, item) {
                        let selected = item.city_name == savedCity ? "selected" : "";
                        $('#perm_towncity').append(
                            `<option value="${item.city_code}" ${selected}>${item.city_name}</option>`
                        );
                    });
                    updateHiddenTextField('#perm_towncity', '#city-text-perm');

                    // Trigger change event to load the Barangay dropdown if city is already selected
                    if (savedCity) $('#perm_towncity').trigger('change');
                });
            });

            // Barangay Dropdown based on City selection
            $('#perm_towncity').on('change', function() {
                var city_code = $(this).val();
                $('#perm_barangay').empty().append('<option selected disabled>Choose Barangay</option>');

                $.getJSON(barangayUrl, function(data) {
                    var barangays = data.filter(function(barangay) {
                        return barangay.city_code == city_code;
                    });

                    $.each(barangays, function(index, item) {
                        let selected = item.brgy_name == savedBarangay ? "selected" : "";
                        $('#perm_barangay').append(
                            `<option value="${item.brgy_name}" ${selected}>${item.brgy_name}</option>`
                        );
                    });
                    updateHiddenTextField('#perm_barangay', '#barangay-text-perm');
                });
            });

            // Function to update hidden text field based on selected dropdown option
            function updateHiddenTextField(dropdownSelector, textFieldSelector) {
                var selectedText = $(dropdownSelector).find("option:selected").text();
                $(textFieldSelector).val(selectedText);
            }

            // Update hidden text fields on each dropdown change
            $('#perm_region').on('change', function() {
                updateHiddenTextField('#perm_region', '#region-text-perm');
            });
            $('#perm_province').on('change', function() {
                updateHiddenTextField('#perm_province', '#province-text-perm');
            });
            $('#perm_towncity').on('change', function() {
                updateHiddenTextField('#perm_towncity', '#city-text-perm');
            });
            $('#perm_barangay').on('change', function() {
                updateHiddenTextField('#perm_barangay', '#barangay-text-perm');
            });
        });
    </script>

    {{-- Guardian Addresss --}}
    <script>
        $(document).ready(function() {
            var regionUrl = "{{ url('backend/assets/ph-json/region.json') }}";
            var provinceUrl = "{{ url('backend/assets/ph-json/province.json') }}";
            var cityUrl = "{{ url('backend/assets/ph-json/city.json') }}";
            var barangayUrl = "{{ url('backend/assets/ph-json/barangay.json') }}";

            var savedRegion = "{{ $applicant->guardian_region }}";
            var savedProvince = "{{ $applicant->guardian_province }}";
            var savedCity = "{{ $applicant->guardian_towncity }}";
            var savedBarangay = "{{ $applicant->guardian_barangay }}";

            // Populate Region Dropdown
            $.getJSON(regionUrl, function(data) {
                $('#guardian_region').append('<option selected disabled>Choose Region</option>');
                $.each(data, function(index, item) {
                    let selected = item.region_name == savedRegion ? "selected" : "";
                    $('#guardian_region').append(
                        `<option value="${item.region_code}" ${selected}>${item.region_name}</option>`
                    );
                });
                updateHiddenTextField('#guardian_region', '#region-text-guardian');

                // Trigger change event to load the Province dropdown if region is already selected
                if (savedRegion) $('#guardian_region').trigger('change');
            });

            // Province Dropdown based on Region selection
            $('#guardian_region').on('change', function() {
                var region_code = $(this).val();
                $('#guardian_province').empty().append(
                    '<option selected disabled>Choose Province</option>');

                $.getJSON(provinceUrl, function(data) {
                    var provinces = data.filter(function(province) {
                        return province.region_code == region_code;
                    });

                    $.each(provinces, function(index, item) {
                        let selected = item.province_name == savedProvince ? "selected" :
                            "";
                        $('#guardian_province').append(
                            `<option value="${item.province_code}" ${selected}>${item.province_name}</option>`
                        );
                    });
                    updateHiddenTextField('#guardian_province', '#province-text-guardian');

                    // Trigger change event to load the City dropdown if province is already selected
                    if (savedProvince) $('#guardian_province').trigger('change');
                });
            });

            // City Dropdown based on Province selection
            $('#guardian_province').on('change', function() {
                var province_code = $(this).val();
                $('#guardian_towncity').empty().append(
                    '<option selected disabled>Choose Municipality</option>');

                $.getJSON(cityUrl, function(data) {
                    var cities = data.filter(function(city) {
                        return city.province_code == province_code;
                    });

                    $.each(cities, function(index, item) {
                        let selected = item.city_name == savedCity ? "selected" : "";
                        $('#guardian_towncity').append(
                            `<option value="${item.city_code}" ${selected}>${item.city_name}</option>`
                        );
                    });
                    updateHiddenTextField('#guardian_towncity', '#city-text-guardian');

                    // Trigger change event to load the Barangay dropdown if city is already selected
                    if (savedCity) $('#guardian_towncity').trigger('change');
                });
            });

            // Barangay Dropdown based on City selection
            $('#guardian_towncity').on('change', function() {
                var city_code = $(this).val();
                $('#guardian_barangay').empty().append(
                    '<option selected disabled>Choose Barangay</option>');

                $.getJSON(barangayUrl, function(data) {
                    var barangays = data.filter(function(barangay) {
                        return barangay.city_code == city_code;
                    });

                    $.each(barangays, function(index, item) {
                        let selected = item.brgy_name == savedBarangay ? "selected" : "";
                        $('#guardian_barangay').append(
                            `<option value="${item.brgy_name}" ${selected}>${item.brgy_name}</option>`
                        );
                    });
                    updateHiddenTextField('#guardian_barangay', '#barangay-text-guardian');
                });
            });

            // Function to update hidden text field based on selected dropdown option
            function updateHiddenTextField(dropdownSelector, textFieldSelector) {
                var selectedText = $(dropdownSelector).find("option:selected").text();
                $(textFieldSelector).val(selectedText);
            }

            // Update hidden text fields on each dropdown change
            $('#guardian_region').on('change', function() {
                updateHiddenTextField('#guardian_region', '#region-text-guardian');
            });
            $('#guardian_province').on('change', function() {
                updateHiddenTextField('#guardian_province', '#province-text-guardian');
            });
            $('#guardian_towncity').on('change', function() {
                updateHiddenTextField('#guardian_towncity', '#city-text-guardian');
            });
            $('#guardian_barangay').on('change', function() {
                updateHiddenTextField('#guardian_barangay', '#barangay-text-guardian');
            });
        });
    </script>
@endpush
