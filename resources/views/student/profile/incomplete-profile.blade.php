@extends('student.layouts.master')

@section('title', 'Incomplete Profile')

@section('contents')

    <div
        class="col-span-12 mt-4 md:order-9 lg:col-span-6 lg:row-span-2 xl:col-span-4 xl:row-span-2 2xl:row-span-2 2xl:col-span-3 card">
        <div class="card-body">
            <h6 class="mb-3 font-semibold text-15">Profile Completeness Checkpoint</h6>

            <div class="flex gap-3 p-4 mt-3 border border-yellow-200 rounded-md bg-yellow-50">
                <div class="shrink-0">
                    <img src="{{ asset('backend/assets/images/support.png') }}" alt="" class="h-20">
                </div>

                <div class="w-full">
                    <h6 class="mb-1 font-medium text-yellow-600 text-15">
                        Action Required
                    </h6>

                    @if (
                        ($studentProfile->applicant_profile_status == null || $studentProfile->applicant_profile_status == 0) &&
                            $studentProfile->prereg_status == 'pending')

                        <p class="mb-4 text-sm leading-relaxed text-slate-600">
                            It appears that your applicant profile is not yet complete.
                            A <span class="font-medium text-yellow-600">complete and published profile</span> is required to
                            proceed for enrollment. After completing your profile, please upload all required documents to
                            continue your
                            application.
                        </p>

                        <div class="flex flex-wrap gap-2">


                            {{-- Continue Profile --}}
                            <a href="{{ route('student.applicant-profile.step1.show') }}"
                                class="inline-flex items-center gap-2 px-5 py-2 text-white transition bg-green-500 rounded-lg shadow-sm hover:bg-green-600">
                                <i data-lucide="arrow-right-circle" class="size-4"></i>
                                Continue Profile
                            </a>
                        </div>
                    @else
                        <p class="mb-4 text-sm leading-relaxed text-slate-600">
                            No required documents have been uploaded.
                            Kindly upload your requirements to <span class="font-medium text-yellow-600">unblock
                                access</span> and proceed.
                        </p>

                        <div class="flex flex-wrap gap-2">

                            {{-- Upload Requirements (ONLY if NO requirements yet) --}}
                            @if (!$hasRequirements)
                                <a href="{{ route('student.applicant-requirements.index') }}"
                                    class="inline-flex items-center gap-2 px-5 py-2 text-white transition bg-green-500 rounded-lg shadow-sm hover:bg-green-600">
                                    <i data-lucide="upload" class="size-4"></i>
                                    Upload Requirements
                                </a>
                                </a>
                            @endif

                        </div>

                    @endif

                    {{-- Optional status message --}}
                    @if ($hasRequirements)
                        <p class="mt-3 text-xs text-green-600">
                            ✔ Your requirements have already been submitted.
                        </p>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection
