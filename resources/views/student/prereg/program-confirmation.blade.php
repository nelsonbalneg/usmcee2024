@extends('student.layouts.master')
@php
    use Carbon\Carbon;
    $start = Carbon::parse($site_settings->start_prereg_second_batch);
    $end = Carbon::parse($site_settings->end_prereg_second_batch);
@endphp
@section('title')
    USM-CEE | Programs Confirmation
@endsection

@section('contents')
    <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
        <div class="grow">
            <h5 class="uppercase text-16">USMCEE 4.0 | Program Confirmation</h5>
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
                Program Confirmation
                {{-- <input type="text" name="program_policy_id" value="{{ $programData['reservationStatus'] }}"> --}}
            </li>
        </ul>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-12 gap-x-5">

        <div class="xl:col-span-12">

            {{-- check if requirements has been publihed or has submitted requirements --}}
            @if ($has_requirement && $cee_profile->applicant_profile_status == 1)
                <div class="card">
                    <div class="card-body">

                        {{-- check if qualified for 1st batch --}}
                        @if ($is_qualified_pre_reg == 1 &&  $programData['reservationStatus'] == "Open")
                            <input type="hidden" name="program_policy_id" value="{{ $programData['id'] }}">
                            <input type="hidden" name="user_id" value="{{ $cee_profile->user_id }}">

                            <div class="px-4 py-6 mx-auto text-center">

                                @if ($cee_profile->prereg_status != 'pending')
                                    <div
                                        class="px-4 py-3 text-sm text-green-500 border border-green-200 rounded-md bg-green-50 dark:bg-green-400/20 dark:border-green-500/50">
                                        <span class="font-bold">Yahoo!</span> You belong to the first batch of qualifiers
                                        for
                                        Pre-registration.
                                        Kindly click the <b class="text-green-800">'Confirm'</b> button to confirm your
                                        interest
                                        in
                                        enrolling in the program.
                                    </div>
                                @else
                                    <h5 class="mb-2 uppercase">Congratulations, <b
                                            class="text-custom-500">{{ $cee_profile->first_name }}
                                            {{ $cee_profile->middle_initial }}
                                            {{ $cee_profile->last_name }} {{ $cee_profile->ext_name }}!</b> Pre-registration
                                        is successful.</h5>
                                @endif

                                <div class="mt-5 overflow-x-auto">
                                    <table class="w-full">
                                        <thead class="ltr:text-left rtl:text-right">
                                            <tr>
                                                <th
                                                    class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500">
                                                    Action</th>
                                                {{-- @if ($cee_profile->prereg_status != 'pending')
                                                    <th
                                                        class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500">
                                                        Slot</th>
                                                @endif --}}
                                                <th
                                                    class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500">
                                                    Program Name</th>
                                                <th
                                                    class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500">
                                                    Campus & College</th>


                                            </tr>
                                        </thead>
                                        <tbody class="ltr:text-left rtl:text-right">
                                            <tr
                                                class="odd:bg-white even:bg-slate-50 dark:odd:bg-zink-700 dark:even:bg-zink-600">
                                                <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">

                                                    {{-- start check if there is slot remaning --}}
                                                    @if ($slot_remaning > 0 || $cee_profile->prereg_status == 'pending')

                                                        {{-- start check if user already confirmed --}}
                                                        @if ($cee_profile->prereg_status != 'pending')

                                                            {{-- start filter if midwife 524, nursing 310, pharma 311, hospitality mgnt 46, nutrition 58, food tech 186 --}}
                                                            @if (
                                                                $programData['id'] == 783 ||
                                                                    $programData['id'] == 725 ||
                                                                    $programData['id'] == 727 ||
                                                                    $programData['id'] == 812 ||
                                                                    $programData['id'] == 731 ||
                                                                    $programData['id'] == 730)
                                                                {{-- start check if additional Requirements has been uploaded adn published --}}
                                                                @if ($has_additional_requirement)
                                                                    <button type="submit" id="publishButton"
                                                                        class="text-white bg-green-500 border-green-500 btn hover:text-white hover:bg-green-600 hover:border-green-600 focus:text-white focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-100 active:text-white active:bg-green-600 active:border-green-600 active:ring active:ring-green-100 dark:ring-green-400/10">
                                                                        <i data-lucide="thumbs-up"
                                                                            class="inline-block size-4 dark:text-zink-200"></i>
                                                                        Confirm</button>
                                                                @else
                                                                    <a href="{{ route('student.add-requirements.index') }}"
                                                                        class="text-white bg-green-500 border-green-500 btn hover:text-white hover:bg-green-600 hover:border-green-600 focus:text-white focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-100 active:text-white active:bg-green-600 active:border-green-600 active:ring active:ring-green-100 dark:ring-green-400/10">
                                                                        <i data-lucide="upload"
                                                                            class="inline-block size-4 dark:text-zink-200"></i>
                                                                        Submit Additional Requirements</a>
                                                                @endif
                                                                {{-- end check if additional Requirements has been uploaded adn published --}}
                                                            @else
                                                                <button type="submit" id="publishButton"
                                                                    class="text-white bg-green-500 border-green-500 btn hover:text-white hover:bg-green-600 hover:border-green-600 focus:text-white focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-100 active:text-white active:bg-green-600 active:border-green-600 active:ring active:ring-green-100 dark:ring-green-400/10">
                                                                    <i data-lucide="thumbs-up"
                                                                        class="inline-block size-4 dark:text-zink-200"></i>
                                                                    Confirm</button>
                                                            @endif
                                                            {{-- end filter if midwife 524, nursing 310, pharma 311, hospitality mgnt 46, nutrition 58, food tech 186 --}}
                                                        @else
                                                            <a type="button" href="{{ route('student.prereg.index') }}"
                                                                class="text-green-500 bg-green-100 btn hover:text-white hover:bg-green-600 focus:text-white focus:bg-green-600 focus:ring focus:ring-green-100 active:text-white active:bg-green-600 active:ring active:ring-green-100 dark:bg-green-500/20 dark:text-green-400 dark:hover:bg-green-500 dark:hover:text-white dark:focus:bg-green-500 dark:focus:text-white dark:active:bg-green-500 dark:active:text-white dark:ring-green-400/20">
                                                                <i data-lucide="check-circle"
                                                                    class="inline-block size-4 dark:text-zink-200"></i>
                                                                Confirmed</a>
                                                        @endif
                                                        {{-- end check if user already confirmed --}}
                                                    @else
                                                        <button type="button"
                                                            class="text-red-500 bg-red-100 btn hover:text-white hover:bg-red-600 focus:text-white focus:bg-red-600 focus:ring focus:ring-red-100 active:text-white active:bg-red-600 active:ring active:ring-red-100 dark:bg-red-500/20 dark:text-red-500 dark:hover:bg-red-500 dark:hover:text-white dark:focus:bg-red-500 dark:focus:text-white dark:active:bg-red-500 dark:active:text-white dark:ring-red-400/20">
                                                            No more slots available</button>
                                                    @endif
                                                    {{-- end check if there is slot remaning --}}

                                                </td>
                                                {{-- hide if the program has been reserved --}}
                                                {{-- @if ($cee_profile->prereg_status != 'pending')
                                                    <td
                                                        class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                                                        {{ $slot_remaning }}
                                                    </td>
                                                @endif --}}
                                                <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                                                    {{ $programData['programName'] }} -
                                                    {{ $programData['majorDiscDesc'] }}
                                                </td>
                                                <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                                                    {{ $programData['campusName'] }}<br>{{ $programData['collegeName'] }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @else
                            {{-- check the date range for second batch qualifiers --}}
                            @if (now()->between($start, $end))
                                <div>
                                    <div
                                        class="flex gap-3 p-4 text-sm rounded-md text-sky-500 bg-sky-50 dark:bg-sky-400/20">
                                        <i data-lucide="check-circle" class="inline-block size-4 mt-0.5 shrink-0"></i>
                                        <div>
                                            <h6 class="mb-1"> <span class="font-bold">Yahoo!</span> You belong to the
                                                second batch qualifiers for pre-registration.</h6>
                                            <ul class="ml-2 list-disc list-inside">
                                                <li>The table below shows the programs you are qualified to enroll in.
                                                </li>
                                                <li> Kindly click the <b class="text-sky-800">'Select'</b> button, then
                                                    click <b class="text-sky-800">'Confirm'</b> to finalize your
                                                    interest in enrolling in the program.</li>
                                            </ul>
                                        </div>
                                    </div>

                                    {{-- <input type="hidden" name="second_batch_app_no" value="{{ $cee_profile->app_no }}">
                                    <input type="hidden" name="second_user_id" value="{{ $cee_profile->user_id }}"> --}}
                                    <input type="hidden" name="second_csa" value="{{ $result->csa }}">
                                </div>

                                <div class="card-body">
                                    <h2>Coming Soon!</h2>
                                    {{-- <h6 class="mb-4 text-15">Programs You Are Qualified to Pre-register</h6>

                                    <div class="overflow-x-auto">
                                        <table class="w-full">
                                            <thead class="ltr:text-left rtl:text-right">
                                                <tr>
                                                    <th
                                                        class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500">
                                                        Action</th>
                                                    <th
                                                        class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500">
                                                        Slot</th>
                                                    <th
                                                        class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500">
                                                        Program Name</th>
                                                    <th
                                                        class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500">
                                                        Campus & College</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr
                                                    class="odd:bg-white even:bg-slate-50 dark:odd:bg-zink-700 dark:even:bg-zink-600">
                                                    <td>
                                                        <button type="submit" id="publishButton"
                                                            class="text-white bg-green-500 border-green-500 btn hover:text-white hover:bg-green-600 hover:border-green-600 focus:text-white focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-100 active:text-white active:bg-green-600 active:border-green-600 active:ring active:ring-green-100 dark:ring-green-400/10">
                                                            <i data-lucide="check"
                                                                class="inline-block size-4 dark:text-zink-200"></i>
                                                            Select</button>
                                                    </td>
                                                    <td
                                                        class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                                                        <a href="#!"
                                                            class="transition-all duration-150 ease-linear text-custom-500 hover:text-custom-600">98</a>
                                                    </td>
                                                    <td
                                                        class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                                                        BS Computer Science</td>
                                                    <td
                                                        class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                                                        Main Campus - CEIT</td>


                                                </tr>
                                                <tr
                                                    class="odd:bg-white even:bg-slate-50 dark:odd:bg-zink-700 dark:even:bg-zink-600">
                                                    <td>
                                                        <button type="submit" id="publishButton"
                                                            class="text-white bg-green-500 border-green-500 btn hover:text-white hover:bg-green-600 hover:border-green-600 focus:text-white focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-100 active:text-white active:bg-green-600 active:border-green-600 active:ring active:ring-green-100 dark:ring-green-400/10">
                                                            <i data-lucide="check"
                                                                class="inline-block size-4 dark:text-zink-200"></i>
                                                            Select</button>
                                                    </td>
                                                    <td
                                                        class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                                                        <a href="#!"
                                                            class="transition-all duration-150 ease-linear text-custom-500 hover:text-custom-600">98</a>
                                                    </td>
                                                    <td
                                                        class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                                                        BS Computer Science</td>
                                                    <td
                                                        class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                                                        Main Campus - CEIT</td>


                                                </tr>
                                                <tr
                                                    class="odd:bg-white even:bg-slate-50 dark:odd:bg-zink-700 dark:even:bg-zink-600">
                                                    <td>
                                                        <button type="submit" id="publishButton"
                                                            class="text-white bg-green-500 border-green-500 btn hover:text-white hover:bg-green-600 hover:border-green-600 focus:text-white focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-100 active:text-white active:bg-green-600 active:border-green-600 active:ring active:ring-green-100 dark:ring-green-400/10">
                                                            <i data-lucide="check"
                                                                class="inline-block size-4 dark:text-zink-200"></i>
                                                            Select</button>
                                                    </td>
                                                    <td
                                                        class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                                                        <a href="#!"
                                                            class="transition-all duration-150 ease-linear text-custom-500 hover:text-custom-600">98</a>
                                                    </td>
                                                    <td
                                                        class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                                                        BS Computer Science</td>
                                                    <td
                                                        class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                                                        KCC - Engineering</td>


                                                </tr>
                                                <tr
                                                    class="odd:bg-white even:bg-slate-50 dark:odd:bg-zink-700 dark:even:bg-zink-600">
                                                    <td>
                                                        <button type="submit" id="publishButton"
                                                            class="text-white bg-green-500 border-green-500 btn hover:text-white hover:bg-green-600 hover:border-green-600 focus:text-white focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-100 active:text-white active:bg-green-600 active:border-green-600 active:ring active:ring-green-100 dark:ring-green-400/10">
                                                            <i data-lucide="check"
                                                                class="inline-block size-4 dark:text-zink-200"></i>
                                                            Select</button>
                                                    </td>
                                                    <td
                                                        class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                                                        <a href="#!"
                                                            class="transition-all duration-150 ease-linear text-custom-500 hover:text-custom-600">98</a>
                                                    </td>
                                                    <td
                                                        class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                                                        BS Computer Science</td>
                                                    <td
                                                        class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                                                        PPALMA - CED</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div> --}}
                                </div>
                            @else
                                <p class="mt-4 mb-4">Dear {{ $cee_profile->first_name }}
                                    {{ $cee_profile->middle_name }}
                                    {{ $cee_profile->last_name }}
                                    {{ $cee_profile->ext_name }},</p>

                                <p class="text-slate-800">Thank you for your interest in the University of Southern
                                    Mindanao. <b> We regret to inform you that you did not qualify for your first priority
                                        program </b>, <b class="text-custom-500">{{ $programData['programName'] }}
                                        {{ $programData['majorDiscDesc'] }}</b>, at the University of Southern
                                    Mindanao!

                                    <br><br>
                                    We understand that this may be disappointing. However, we would like to offer you the
                                    opportunity to explore other programs at USM that may be a good fit for your interests
                                    and qualifications.

                                    <br><br>
                                    On April 24, 2025, we will be sending you a list of other available programs that you
                                    may consider for enrollment.
                                    <br><br>
                                    We encourage you to review this list carefully. We are committed to helping you find the
                                    right academic path at the University of Southern Mindanao.

                                </p>

                                <div class="grid grid-cols-1 mt-10 2xl:grid-cols-12">
                                    <div class="2xl:col-span-5">
                                        <p class="mb-5 text-slate-500 dark:text-zink-200">Sincerely,</p>
                                        <p class="mb-2 uppercase text-slate-800 dark:text-zink-200"> <b> LEORENCE C. TANDOG
                                            </b></p>
                                        <p class="text-slate-500 dark:text-zink-200">Vice President for Academic Affair</p>
                                        <p class="text-slate-500 dark:text-zink-200">University of Southern Mindanao</p>
                                    </div>


                                    <div class="self-end mt-10 text-center 2xl:col-span-2 2xl:col-start-11">
                                        <hr class="mb-5 border-t-2 border-slate-200 dark:border-zink-700">
                                        <img src="{{ asset('backend/assets/images/logo-dark.png') }}" alt=""
                                            class="h-12 mx-auto">
                                        <h6>University of Southern Mindanao</h6>
                                    </div>
                                </div>
                            @endif
                        @endif

                    </div>
                    {{-- end card-body --}}
                </div>
            @else
                <h1>Please complete and publish your profile and requirements. </h1>
            @endif
        </div>

    </div>
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- swal confirm --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("publishButton").addEventListener("click", function(event) {
                event.preventDefault();

                const programPolicyId = document.querySelector('input[name="program_policy_id"]').value;

                Swal.fire({
                    title: "Are you sure?",
                    text: "Submitting this will save your intent to pre-register for the program shown. Please ensure that all details are correct before proceeding. Once your intent is submitted, you will not be able to revert it",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, I confirm!",
                    cancelButtonText: "Cancel"
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch("{{ route('student.program-confirmation.comfirm') }}", {
                                method: "POST",
                                headers: {
                                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                                    "Content-Type": "application/json"
                                },
                                body: JSON.stringify({
                                    program_policy_id: programPolicyId
                                })
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    Swal.fire("Success!",
                                        "You have successfully pre-registered for your chosen program. Always monitor the progress of your enrollment through the Pre-registration Dashboard.",
                                        "success"
                                    ).then(() => location.reload());
                                } else {
                                    Swal.fire("Error!", data.message, "error");
                                }
                            })
                            .catch(error => {
                                Swal.fire("Error!",
                                    "Something went wrong. Please try again or contact the system administrator",
                                    "error");
                            });
                    }
                });
            });
        });
    </script>
@endpush
