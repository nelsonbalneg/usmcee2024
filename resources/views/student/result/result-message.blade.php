@extends('student.layouts.master')
@section('title')
    USM-CEE | Result
@endsection
@php
    use Carbon\Carbon;
    $start = Carbon::parse($site_settings->start_prereg_second_batch);
    $end = Carbon::parse($site_settings->end_prereg_second_batch);
@endphp



@section('contents')
    <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
        <div class="grow">
            <h5 class="text-16">USM - College Entrance Examination System 4.0</h5>
        </div>
        <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="#!" class="text-slate-400 dark:text-zink-200">Home</a>
            </li>
            <li class="text-slate-700 dark:text-zink-100">
                CEE Result
            </li>
        </ul>
    </div>


    @if (optional($cee_result))
        <div class="grid grid-cols-1 2xl:grid-cols-12">
            <div class="relative card 2xl:col-span-8 2xl:col-start-3">
                <div class="p-8">
                    <div class="text-center">
                        <h5
                            class="relative before:absolute before:h-[1px] before:inset-x-0 before:-bottom-2.5 inline-block before:bg-gradient-to-r before:from-white dark:before:from-zink-700 before:via-custom-500 before:to-white dark:before:to-zink-700 dark:before:via-custom-500">
                            USM-CEE RESULT</h5>
                    </div>
                    <div class="mt-10 overflow-x-auto">
                        @if ($cee_result->csa < 25)
                            <p class="text-slate-800">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Thank you for your
                                interest in pursuing your tertiary education at the University of Southern Mindanao. We
                                appreciate the time and effort you invested in our admission process.

                                <br><br>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;After careful evaluation of all examination
                                results, <strong class="text-red-500">we regret to inform you that your performance did not
                                    meet the requirement for admission into any of our offered programs at this
                                    time</strong>.

                                <br><br>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;We recommend exploring alternative
                                educational pathways that may align with your interests and career goals.
                            </p>
                        @elseif($cee_result->csa >= 25)
                            @if ($is_qualified_pre_reg == 1 && !now()->between($start, $end))
                                <h4>Congratulations! You Qualified for Your Priority Program at USM!</h4>

                                <p class="mt-4 mb-4">Dear {{ $cee_result->firstname }}
                                    {{ $cee_result->middlename ? strtoupper(substr($cee_result->middlename, 0, 1)) . '.' : '' }}
                                    {{ $cee_result->lastname }}
                                    {{ $cee_result->suffix }},</p>
                                <p class="text-slate-800">We are pleased to
                                    inform you that you have qualified for your first priority program, <b
                                        class="text-custom-500">{{ $programResponse['programName'] }}
                                        {{ $programResponse['majorDiscDesc'] }}</b>, at the University of Southern Mindanao!
                                    Congratulations on this achievement!

                                    <br><br>
                                    To begin your enrollment process
                                    immediately, please click or tap the Confirm button below, <strong>not later than April
                                        25, 2025:</strong><br>

                                    <a href="{{ route('student.prereg.index') }}"
                                        class="mt-4 text-white bg-green-500 border-green-500 btn hover:text-white hover:bg-green-600 hover:border-green-600 focus:text-white focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-100 active:text-white active:bg-green-600 active:border-green-600 active:ring active:ring-green-100 dark:ring-green-400/10">
                                        <i data-lucide="thumbs-up" class="inline-block size-4 dark:text-zink-200"></i>
                                        Confirm</a>

                                    <br><br>
                                    If you choose not to enroll in your
                                    priority program, or if you would like to explore other program options, we will be
                                    sending you a list of other available programs on April 24.
                                    <br><br>
                                    Congratulations once again, and we look forward to welcoming you to USM!

                                </p>
                            @else
                                @if (($is_qualified_pre_reg == 1 || $is_qualified_pre_reg == 0) && now()->between($start, $end))
                                    {{-- <h4>Update on Your USM Enrollment Application</h4> --}}

                                    <h6 class="mt-4">Dear {{ $cee_result->firstname }}
                                        {{ $cee_result->middlename ? strtoupper(substr($cee_result->middlename, 0, 1)) . '.' : '' }}
                                        {{ $cee_result->lastname }}
                                        {{ $cee_result->suffix }},</h6>

                                    <br>

                                    <p class="text-slate-800">


                                        Below is the list of other available programs that you may consider for enrollment.
                                        We encourage you to review this list carefully. We are committed to helping you find
                                        the right academic path at the University of Southern Mindanao.<br><br>

                                        However, please note that you will not be admitted automatically to your chosen
                                        program as all qualifiers will undergo ranking. <br><br>

                                        <hr><br>
                                        Narito ang listahan ng iba pang mga akademik program na maaari mong isaalang-alang
                                        para sa pag-enroll. Hinihikayat ka naming suriing mabuti ang listahang ito. Nakatuon
                                        kami sa pagtulong sa iyo upang mahanap mo ang angkop na akademik program sa
                                        University of Southern Mindanao.<br><br>

                                        Gayunpaman, pakatandaan na hindi awtomatikong ibibigay ang napili mong program
                                        sapagkat lahat ng kwalipikado ay daraan sa proseso ng ranggohan (ranking).<br><br>

                                        @if (isset($qualifiedCampuses['qualifiedCampuses']) && !empty($qualifiedCampuses['qualifiedCampuses']))
                                            <div class="overflow-x-auto">

                                                @foreach ($qualifiedCampuses['qualifiedCampuses'] as $campus)
                                                    <div class="w-full mb-4 whitespace-nowrap">
                                                        <h5
                                                            class="p-2 text-left text-green-500 bg-green-100 dark:bg-zink-600 dark:text-zink-200">
                                                            {{ $campus['campusName'] }}</h5>

                                                        <div class="overflow-x-auto">
                                                            <table class="w-full whitespace-nowrap">
                                                                <thead
                                                                    class="text-left bg-slate-100 text-slate-500 dark:bg-zink-600 dark:text-zink-200">
                                                                    <tr>
                                                                        <th
                                                                            class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500">
                                                                            Action</th>
                                                                        <th>Ranking Slot</th>
                                                                        <th>Policy ID</th>
                                                                        <th>Program</th>

                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($campus['qualifiedPrograms'] as $program)
                                                                        <tr
                                                                            class="even:bg-slate-50 hover:bg-slate-50 even:hover:bg-slate-100 dark:even:bg-zink-600/50 dark:hover:bg-zink-600 dark:even:hover:bg-zink-600">
                                                                            <td
                                                                                class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                                                                                <button id="selectProgram"
                                                                                    class="text-white border-custom-500 bg-custom-500 btn hover:text-white hover:bg-custom-600 hover:yellow-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/10">
                                                                                    Select</button>
                                                                            </td>
                                                                            <td
                                                                                class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                                                                                {{ $program['rankingOpenSlotsRemaining'] }}
                                                                            </td>
                                                                            <td
                                                                            class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                                                                            {{ $program['policyId'] }}
                                                                        </td>
                                                                            <td
                                                                                class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                                                                                {{ $program['program'] }}{{ !empty($program['major']) ? ' - ' . $program['major'] : '' }}
                                                                            </td>

                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <div class="alert alert-info">
                                                No qualified programs found.
                                            </div>
                                        @endif
                                    </p>
                                @else
                                    <h4>Update on Your USM Enrollment Application</h4>

                                    <p class="mt-4 mb-4">Dear {{ $cee_result->firstname }}
                                        {{ $cee_result->middlename ? strtoupper(substr($cee_result->middlename, 0, 1)) . '.' : '' }}
                                        {{ $cee_result->lastname }}
                                        {{ $cee_result->suffix }},</p>

                                    <br>

                                    <p class="text-slate-800">Thank you for your interest in the University of Southern
                                        Mindanao. <b> We regret to inform you that you did not qualify for your first
                                            priority
                                            program </b>, <b class="text-custom-500">{{ $programResponse['programName'] }}
                                            {{ $programResponse['majorDiscDesc'] }}</b>, at the University of Southern
                                        Mindanao!

                                        <br><br>
                                        We understand that this may be disappointing. However, we would like to offer you
                                        the
                                        opportunity to explore other programs at USM that may be a good fit for your
                                        interests
                                        and qualifications.

                                        <br><br>
                                        On April 26, 2025 to April 29, 2025, we will be sending you a list of other
                                        available programs that you
                                        may consider for enrollment.

                                        We encourage you to review this list carefully. We are committed to helping you find
                                        the
                                        right academic path at the University of Southern Mindanao.
                                    </p>
                                @endif
                            @endif
                        @endif
                    </div>

                    <div class="grid grid-cols-1 mt-10 2xl:grid-cols-12">
                        <div class="2xl:col-span-5">
                            <p class="mb-5 text-slate-500 dark:text-zink-200">Sincerely,</p>
                            <p class="mb-2 uppercase text-slate-800 dark:text-zink-200"> <b> LEORENCE C. TANDOG </b></p>
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

                </div>
            </div>
        </div>
    @endif
@endsection
