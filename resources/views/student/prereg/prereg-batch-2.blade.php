@extends('student.layouts.master')
@section('title')
    USM-CEE | Programs Confirmation
@endsection

@section('contents')
    <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
        <div class="grow">
            <h5 class="uppercase text-16">USMCEE 4.0 - Preregistration</h5>
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
            </li>
        </ul>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-12 gap-x-5">

        <div class="xl:col-span-12">

            <div class="card">
                <div class="card-body">
                    @if ($has_policy_id == 1)
                        <div class="flex gap-3 p-4 mb-4 text-sm rounded-md text-sky-500 bg-sky-50 dark:bg-sky-400/20">
                            <i data-lucide="check-circle" class="inline-block size-4 mt-0.5 shrink-0"></i>
                            <div>
                                <h6 class="mb-1"> <span class="font-bold">Important!</span> Kindly read the
                                    statements below.</h6>
                                <ul class="ml-2 list-disc list-inside">
                                    <li> Below are the details of your selected program.
                                        Please note that <b class="text-sky-800"> admission is not
                                            automatic,</b> as all qualifiers will undergo a
                                        ranking process
                                    </li>
                                    <li>
                                        Narito ang detalye ng iyong napiling program. Pakatandaan na <b
                                            class="text-sky-800"> hindi awtomatikong
                                            ibibigay ang napili mong program </b>
                                        sapagkat lahat ng kwalipikado ay daraan sa proseso ng ranggohan
                                        (ranking).
                                    </li>


                                </ul>
                            </div>
                        </div>

                        <div class="flex flex-col gap-3">
                            <div class="border rounded-md border-slate-200 dark:border-zink-500">
                                <div class="flex flex-wrap items-center gap-3 p-2">
                                    <div class="rounded-full size-10 shrink-0">
                                        <img src="{{ asset(Auth::user()->photo) }}" alt=""
                                            class="h-10 rounded-full">
                                    </div>
                                    <div class="grow">
                                        <h6 class="mb-1"><a href="#!">{{ $prereg_profile->first_name }}
                                                {{ $prereg_profile->middle_initial }}
                                                {{ $prereg_profile->last_name }}
                                                {{ $prereg_profile->ext_name }}</a></h6>
                                        <p class="text-slate-500 dark:text-zink-200">
                                            {{ $prereg_profile->email }}</p>
                                    </div>
                                </div>
                                <div class="p-2 border-t border-slate-200 dark:border-zink-500">
                                    <div class="flex flex-col gap-3">
                                        <p class="text-slate-500 dark:text-zink-200 shrink-0"><b>Program
                                                Selected: </b><br><span class="align-middle">
                                                {{ $prereg_profile->programName }} - {{ $prereg_profile->majorDiscDesc }}
                                            </span>
                                        </p>
                                        <p class="text-slate-500 dark:text-zink-200 shrink-0"><b>Campus and
                                                College: </b><br><span class="align-middle">
                                                {{ $prereg_profile->campusName }}
                                                - {{ $prereg_profile->collegeName }}</span></p>
                                        <p class="text-slate-500 dark:text-zink-200 shrink-0"><b>Date and
                                                Time: </b><br><span
                                                class="align-middle">{{ \Carbon\Carbon::parse($prereg_profile->date_confirmed)->format('F j, Y g:i A') }}</span>
                                        </p>
                                        <p class="text-slate-500 dark:text-zink-200 shrink-0"><b>Status:
                                            </b><br>
                                            <span class="align-middle">
                                                @if ($prereg_profile->prereg_status == 'for_ranking')
                                                    <span
                                                        class="mb-2 px-2.5 py-0.5 inline-block text-[11px] font-medium rounded borsder bg-custom-100 border-transparent text-custom-500 dark:bg-custom-500/20 dark:border-transparent">Confirmed
                                                        for Ranking</span>
                                                    <span
                                                        class="px-2.5 py-0.5 inline-block text-[11px] font-medium rounded borsder bg-purple-100 border-transparent text-purple-500 dark:bg-purple-500/20 dark:border-transparent">
                                                        Please wait, ranking on progress.
                                                    </span>
                                                @elseif($prereg_profile->prereg_status == 'pending' && $prereg_profile->status_id == null)
                                                    <span
                                                        class="mb-2 px-2.5 py-0.5 inline-block text-[11px] font-medium rounded borsder bg-custom-100 border-transparent text-custom-500 dark:bg-custom-500/20 dark:border-transparent">
                                                        Confirmed for Enrollment
                                                    </span>
                                                    @if ($prereg_profile->is_answered_nstp == 1)
                                                        <br>
                                                        <span
                                                            class="mb-2 px-2.5 py-0.5 inline-block text-[11px] font-medium rounded border bg-green-100 border-transparent text-green-500 dark:bg-green-500/20 dark:border-transparent">
                                                            NSTP PREFERENCE:
                                                            {{ $prereg_profile->nstp == 1 ? 'CWTS' : 'ROTC' }}
                                                        </span>
                                                    @endif
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
                                                @elseif($prereg_profile->prereg_status == 'cancelled')
                                                    <span
                                                        class="px-2.5 py-0.5 inline-block text-[11px] font-medium rounded border bg-red-100 border-transparent text-red-500 dark:bg-red-500/20 dark:border-transparent">Cancelled</span>
                                                @elseif($prereg_profile->prereg_status == 'denied')
                                                    <span
                                                        class="px-2.5 py-0.5 inline-block text-[11px] font-medium rounded border bg-red-100 border-transparent text-red-500 dark:bg-red-500/20 dark:border-transparent">Denied</span>
                                                @elseif($prereg_profile->prereg_status == 'enrolled' || $prereg_profile->status_id == 1)
                                                    <span
                                                        class="mb-2 px-2.5 py-0.5 inline-block text-[11px] font-medium rounded border bg-green-100 border-transparent text-green-500 dark:bg-green-500/20 dark:border-transparent">You
                                                        are officially enrolled!</span><br>
                                                    <span
                                                        class="inline-block px-2.5 py-0.5 text-[11px] font-medium rounded bg-purple-100 text-purple-600 dark:bg-purple-500/20">
                                                        Tap the <b class="text-purple-600">Pre-registration Menu</b>, then
                                                        tap the <b class="text-purple-600">View Certificate of Registration
                                                        </b>button to get
                                                        your Certificate of
                                                        Registration.
                                                    </span>
                                                @else
                                                    ---
                                                @endif
                                            </span>
                                        </p>

                                    </div>
                                </div>
                            </div>
                        @elseif($has_policy_id == 0)
                            <p class="text-slate-800">
                                Oops! It seems that you have not confirmed your program yet. Please select your program by
                                clicking or tapping the button below
                                <br>

                                <a href="{{ route('student.cee.result') }}"
                                    class="mt-4 text-white bg-green-500 border-green-500 confirmProgramforRankingBtn btn hover:text-white hover:bg-green-600 hover:border-green-600 focus:text-white focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-100 active:text-white active:bg-green-600 active:border-green-600 active:ring active:ring-green-100 dark:ring-green-400/10">
                                    <i data-lucide="percent" class="inline-block size-4 dark:text-zink-200"></i>Result
                                </a>
                            </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
