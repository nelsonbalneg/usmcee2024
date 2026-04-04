@extends('student.layouts.master')
@section('title')
    Pre-registration - Additional Requirements
@endsection

@section('contents')
    <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
        <div class="grow">
            <h5 class="text-16">PRE-REGISTRATION - ADDITIONAL REQUIREMENTS</h5>
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
                <a href="#!" class="text-slate-400 dark:text-zink-200">Program Confirmation</a>
            </li>
            <li class="text-slate-700 dark:text-zink-100">
                Additional Requirements
            </li>
        </ul>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-12 gap-x-5">

        @if ($applicant->applicant_profile_status == 1)
            <div class="xl:col-span-3">
                <div class="card sticky top-[calc(theme('spacing.header')_*_1.3)]">
                    <div class="card-body">
                        <h6 class="mb-0 text-lg font-semibold text-blue-500 uppercase">Additional Requirement Checklist</h6>
                        <div class="mt-4">
                            <h3 class="text-lg font-semibold text-green-500 uppercase">For BS in Midwifery, BS in Nursing,
                                and BS in Pharmacy</h3>
                            <ul class="text-gray-700 list-disc list-inside">
                                <li><strong>For female:</strong> Hepatitis B Test Result, Chest X-Ray, and Pregnancy Test
                                </li>
                                <li><strong>For Male:</strong> Hepatitis B Test Result, and Chest X-Ray</li>
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
                                class="inline-block text-blue-500 size-4 dark:text-zink-200"></i> PRE-REGISTRATION ADDTIONAL
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


                        {{-- start hepa b --}}
                        {{-- start filter access --}}
                        @if (
                            $prog_policy_id->firstprogram_policy_id == 938 ||
                                $prog_policy_id->firstprogram_policy_id == 946 ||
                                $prog_policy_id->firstprogram_policy_id == 883 ||
                                $prog_policy_id->firstprogram_policy_id == 905 ||
                                $prog_policy_id->firstprogram_policy_id == 886 ||
                                $prog_policy_id->firstprogram_policy_id == 959 ||
                                $prog_policy_id->firstprogram_policy_id == 887 ||
                                $prog_policy_id->firstprogram_policy_id == 884)
                            <h6 class="mt-4 mb-0 text-15">Hepatitis B Test Result <sup class="text-red-500">*
                                    required</sup>
                            </h6>
                            @if (optional($requirements->first())->additional_req_status == 0)
                                <form action="{{ route('student.additional-applicant-requirements.hepab.store') }}"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @error('hepb_files.*')
                                        <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                                    @enderror
                                    <div class="grid items-center grid-cols-1 gap-2 xl:grid-cols-4">

                                        <input type="file" name="hepb_files[]" multiple="multiple" required
                                            class="mb-2 cursor-pointer form-file border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500">

                                        <button type="submit"
                                            class="text-white bg-green-500 border-green-500 btn hover:text-white hover:bg-green-600 hover:border-green-600 focus:text-white focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-100 active:text-white active:bg-green-600 active:border-green-600 active:ring active:ring-green-100 dark:ring-green-400/10">
                                            <i data-lucide="upload" class="inline-block size-4 dark:text-zink-200"></i>
                                            Upload</button>
                                    </div>
                                </form>
                            @endif

                            @if ($requirements->isNotEmpty())
                                <table class="w-full border-separate table-custom border-spacing-y-1">
                                    <thead class="">
                                        <tr
                                            class="relative rounded-md bg-slate-50 after:absolute after:border-l-2 after:left-0 after:top-0 after:bottom-0 after:border-transparent dark:bg-zink-600 [&.active]:after:border-custom-500">
                                            <th class="px-3.5 py-2.5 font-semibold ltr:text-left rtl:text-right">Details
                                            </th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($requirements as $requirement)
                                            @php
                                                $hepa_b_test_files = json_decode($requirement->hepa_b_test, true);
                                            @endphp

                                            @if (!empty($hepa_b_test_files))
                                                @foreach ($hepa_b_test_files as $file)
                                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                                        <td>
                                                            @if ($requirement->additional_req_status == 0)
                                                                <form
                                                                    action="{{ route('student.applicant-requirements.delete', ['requirement' => $requirement->id, 'type' => 'hepa_b_test']) }}"
                                                                    method="POST"
                                                                    onsubmit="return confirm('Are you sure you want to delete this file?');"
                                                                    style="display: inline;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                        class="inline-flex items-center px-4 py-2 mb-2 text-xs font-medium text-left text-red-500 bg-red-100 border border-transparent rounded dark:bg-red-500/20 dark:border-transparent">
                                                                        Delete
                                                                    </button>
                                                                </form>
                                                                <a class="inline-flex items-center px-4 py-2 text-xs font-medium text-left text-green-500 bg-green-100 border border-transparent rounded dark:bg-green-500/20 dark:border-transparent"
                                                                    href="{{ Storage::url(str_replace('doc/', 'hepa-b/', $file)) }}"
                                                                    target="_blank">View</a>

                                                                <a class="inline-flex items-center px-4 py-2 text-xs font-medium text-left text-yellow-500 bg-yellow-100 border border-transparent rounded dark:bg-yellow-500/20 dark:border-transparent"
                                                                    href="#"><i data-lucide="circle-dashed"
                                                                        class="size-3 ltr:mr-1 rtl:ml-1"></i> Pending</a>
                                                            @else
                                                                <a class="inline-flex items-center px-4 py-2 text-xs font-medium text-left text-green-500 bg-green-100 border border-transparent rounded dark:bg-green-500/20 dark:border-transparent"
                                                                    href="{{ Storage::url(str_replace('doc/', 'hepa-b/', $file)) }}"
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

                        @endif
                        {{-- end filter access --}}
                        {{-- end of hepa b --}}

                        {{-- start chest x-ray --}}
                        {{-- start filter access --}}
                        @if (
                            $prog_policy_id->firstprogram_policy_id == 524 ||
                                $prog_policy_id->firstprogram_policy_id == 310 ||
                                $prog_policy_id->firstprogram_policy_id == 311)
                            <h6 class="mt-4 mb-0 text-15">Chest X-ray Test <sup class="text-red-500">*
                                    required</sup>
                            </h6>
                            @if (optional($requirements->first())->additional_req_status == 0)
                                <form action="{{ route('student.additional-applicant-requirements.chest-xray.store') }}"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @error('chestxray_files.*')
                                        <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                                    @enderror
                                    <div class="grid items-center grid-cols-1 gap-2 xl:grid-cols-4">

                                        <input type="file" name="chestxray_files[]" multiple="multiple" required
                                            class="mb-2 cursor-pointer form-file border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500">

                                        <button type="submit"
                                            class="text-white bg-green-500 border-green-500 btn hover:text-white hover:bg-green-600 hover:border-green-600 focus:text-white focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-100 active:text-white active:bg-green-600 active:border-green-600 active:ring active:ring-green-100 dark:ring-green-400/10">
                                            <i data-lucide="upload" class="inline-block size-4 dark:text-zink-200"></i>
                                            Upload</button>
                                    </div>
                                </form>
                            @endif

                            @if ($requirements->isNotEmpty())
                                <table class="w-full border-separate table-custom border-spacing-y-1">
                                    <thead class="">
                                        <tr
                                            class="relative rounded-md bg-slate-50 after:absolute after:border-l-2 after:left-0 after:top-0 after:bottom-0 after:border-transparent dark:bg-zink-600 [&.active]:after:border-custom-500">
                                            <th class="px-3.5 py-2.5 font-semibold ltr:text-left rtl:text-right">Details
                                            </th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($requirements as $requirement)
                                            @php
                                                $chest_x_ray_files = json_decode($requirement->chest_x_ray, true);
                                            @endphp

                                            @if (!empty($chest_x_ray_files))
                                                @foreach ($chest_x_ray_files as $file)
                                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                                        <td>
                                                            @if ($requirement->additional_req_status == 0)
                                                                <form
                                                                    action="{{ route('student.applicant-requirements.delete', ['requirement' => $requirement->id, 'type' => 'chest-xray']) }}"
                                                                    method="POST"
                                                                    onsubmit="return confirm('Are you sure you want to delete this file?');"
                                                                    style="display: inline;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                        class="inline-flex items-center px-4 py-2 mb-2 text-xs font-medium text-left text-red-500 bg-red-100 border border-transparent rounded dark:bg-red-500/20 dark:border-transparent">
                                                                        Delete
                                                                    </button>
                                                                </form>
                                                                <a class="inline-flex items-center px-4 py-2 text-xs font-medium text-left text-green-500 bg-green-100 border border-transparent rounded dark:bg-green-500/20 dark:border-transparent"
                                                                    href="{{ Storage::url(str_replace('doc/', 'chest-xray/', $file)) }}"
                                                                    target="_blank">View</a>

                                                                <a class="inline-flex items-center px-4 py-2 text-xs font-medium text-left text-yellow-500 bg-yellow-100 border border-transparent rounded dark:bg-yellow-500/20 dark:border-transparent"
                                                                    href="#"><i data-lucide="circle-dashed"
                                                                        class="size-3 ltr:mr-1 rtl:ml-1"></i> Pending</a>
                                                            @else
                                                                <a class="inline-flex items-center px-4 py-2 text-xs font-medium text-left text-green-500 bg-green-100 border border-transparent rounded dark:bg-green-500/20 dark:border-transparent"
                                                                    href="{{ Storage::url(str_replace('doc/', 'chest-xray/', $file)) }}"
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
                        @endif
                        {{-- end filter access --}}
                        {{-- end chest x-ray --}}

                        {{-- start prenancy Test --}}
                        {{-- start filter access --}}
                        @if (
                            $applicant->gender == 'Female' &&
                                ($prog_policy_id->firstprogram_policy_id == 524 ||
                                    $prog_policy_id->firstprogram_policy_id == 310 ||
                                    $prog_policy_id->firstprogram_policy_id == 311))
                            <h6 class="mt-4 mb-0 text-15">Pregnancy Test <sup class="text-red-500">*
                                    required</sup>
                            </h6>
                            @if (optional($requirements->first())->additional_req_status == 0)
                                <form
                                    action="{{ route('student.additional-applicant-requirements.pregnancy-test.store') }}"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @error('pregnancyTest_files.*')
                                        <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                                    @enderror
                                    <div class="grid items-center grid-cols-1 gap-2 xl:grid-cols-4">

                                        <input type="file" name="pregnancyTest_files[]" multiple="multiple" required
                                            class="mb-2 cursor-pointer form-file border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500">

                                        <button type="submit"
                                            class="text-white bg-green-500 border-green-500 btn hover:text-white hover:bg-green-600 hover:border-green-600 focus:text-white focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-100 active:text-white active:bg-green-600 active:border-green-600 active:ring active:ring-green-100 dark:ring-green-400/10">
                                            <i data-lucide="upload" class="inline-block size-4 dark:text-zink-200"></i>
                                            Upload</button>
                                    </div>
                                </form>
                            @endif

                            @if ($requirements->isNotEmpty())
                                <table class="w-full border-separate table-custom border-spacing-y-1">
                                    <thead class="">
                                        <tr
                                            class="relative rounded-md bg-slate-50 after:absolute after:border-l-2 after:left-0 after:top-0 after:bottom-0 after:border-transparent dark:bg-zink-600 [&.active]:after:border-custom-500">
                                            <th class="px-3.5 py-2.5 font-semibold ltr:text-left rtl:text-right">Details
                                            </th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($requirements as $requirement)
                                            @php
                                                $pregnancy_test_files = json_decode($requirement->preg_test, true);
                                            @endphp

                                            @if (!empty($pregnancy_test_files))
                                                @foreach ($pregnancy_test_files as $file)
                                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                                        <td>
                                                            @if ($requirement->additional_req_status == 0)
                                                                <form
                                                                    action="{{ route('student.applicant-requirements.delete', ['requirement' => $requirement->id, 'type' => 'pregnancy-test']) }}"
                                                                    method="POST"
                                                                    onsubmit="return confirm('Are you sure you want to delete this file?');"
                                                                    style="display: inline;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                        class="inline-flex items-center px-4 py-2 mb-2 text-xs font-medium text-left text-red-500 bg-red-100 border border-transparent rounded dark:bg-red-500/20 dark:border-transparent">
                                                                        Delete
                                                                    </button>
                                                                </form>
                                                                <a class="inline-flex items-center px-4 py-2 text-xs font-medium text-left text-green-500 bg-green-100 border border-transparent rounded dark:bg-green-500/20 dark:border-transparent"
                                                                    href="{{ Storage::url(str_replace('doc/', 'pregnancy-test/', $file)) }}"
                                                                    target="_blank">View</a>

                                                                <a class="inline-flex items-center px-4 py-2 text-xs font-medium text-left text-yellow-500 bg-yellow-100 border border-transparent rounded dark:bg-yellow-500/20 dark:border-transparent"
                                                                    href="#"><i data-lucide="circle-dashed"
                                                                        class="size-3 ltr:mr-1 rtl:ml-1"></i> Pending</a>
                                                            @else
                                                                <a class="inline-flex items-center px-4 py-2 text-xs font-medium text-left text-green-500 bg-green-100 border border-transparent rounded dark:bg-green-500/20 dark:border-transparent"
                                                                    href="{{ Storage::url(str_replace('doc/', 'pregnancy-test/', $file)) }}"
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

                        @endif
                        {{-- end filter access --}}
                        {{-- end prenancy Test --}}

                        <div class="grid grid-cols-1 gap-5 mt-5 lg:grid-cols-2 xl:grid-cols-12">
                        </div>

                        <div class="flex gap-2 mt-4">

                            @if ($requirements->isNotEmpty() && optional($requirements->first())->additional_req_status == 0)
                                <button type="submit" id="submitButton"
                                    class="text-white bg-green-500 border-green-500 btn hover:text-white hover:bg-green-600 hover:border-green-600 focus:text-white focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-100 active:text-white active:bg-green-600 active:border-green-600 active:ring active:ring-green-100 dark:ring-green-400/10">
                                    <i data-lucide="upload" class="inline-block size-4 dark:text-zink-200"></i>
                                    Submit Requirements</button>
                            @elseif($requirements->isNotEmpty() && optional($requirements->first())->additional_req_status == 1)
                                <a type="button" href="{{ route('student.program-confirmation.index') }}"
                                    class="text-white bg-green-500 border-green-500 btn hover:text-white hover:bg-green-600 hover:border-green-600 focus:text-white focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-100 active:text-white active:bg-green-600 active:border-green-600 active:ring active:ring-green-100 dark:ring-green-400/10">
                                    Proceed to Program Confirmation<i data-lucide="move-right"
                                        class="inline-block size-4 dark:text-zink-200"></i></a>
                            @endif
                        </div>

                    </div>
                </div>

            </div>
        @else
            <div class="xl:col-span-12">
                <div
                    class="flex gap-1 px-4 py-3 text-sm text-red-500 border border-red-200 rounded-md md:items-center bg-red-50 dark:bg-red-400/20 dark:border-red-500/50">
                    <i data-lucide="alert-circle" class="h-4"></i>
                    <span class="font-bold">Error!</span> Access to this page is not allowed while your profile status is
                    in draft mode.
                </div>
            </div>

        @endif


    </div>
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
                        fetch("{{ route('student.additional-requirements.publish') }}", {
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
