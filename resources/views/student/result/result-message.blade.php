@extends('student.layouts.master')
@section('title')
    USM-CEE | Result
@endsection
@php
    use Carbon\Carbon;
    $start = Carbon::parse($site_settings->start_prereg_second_batch);
    $end = Carbon::parse($site_settings->end_prereg_second_batch);

    $start_batch_1 = Carbon::parse($site_settings->start_prereg);
    $end_batch_1 = Carbon::parse($site_settings->end_prereg);
@endphp



@section('contents')
    <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
        <div class="grow">
            <h5 class="text-16">USM - Preregistration</h5>
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

                            <h4 class="uppercase">Update on Your USMCEE Result</h4>

                            <p class="mt-4 mb-4">
                                Dear {{ $cee_result->firstname }}
                                {{ $cee_result->middlename ? strtoupper(substr($cee_result->middlename, 0, 1)) . '.' : '' }}
                                {{ $cee_result->lastname }}
                                {{ $cee_result->suffix }},
                            </p>
                            <p class="text-slate-800">
                                Thank you for your interest in joining the University of Southern Mindanao!

                                <br><br>
                                We truly admire your determination to
                                pursue a college education. However, we encourage you to consider other schools where you
                                can continue working toward your goals.
                                <br><br>
                                We wish you success in your endeavors!
                            </p>
                        @elseif($cee_result->csa >= 25)
                            @if ($is_qualified_pre_reg == 1 && !now()->between($start, $end))

                                {{-- add if student is enrolled in first priority --}}
                                {{-- @if ($cee_profile->prereg_status == 'pending' || $cee_profile->prereg_status == 'enrolled') --}}
                                {{-- @if ($cee_profile && ($cee_profile->prereg_status === 'pending' || $cee_profile->prereg_status === 'enrolled')) --}}
                                @if (
                                    $cee_profile &&
                                        $ceeActiveession &&
                                        $cee_profile->preregistration_id == $ceeActiveession->id &&
                                        ($cee_profile->prereg_status === 'pending' || $cee_profile->prereg_status === 'enrolled'))
                                    <p class="text-slate-800">
                                        Congratulations! You have successfully preregistered for your first priority
                                        program at the University of Southern Mindanao!
                                    </p>
                                    <br>

                                    <div class="flex flex-col gap-3">
                                        <div class="border rounded-md border-slate-200 dark:border-zink-500">
                                            <div class="flex flex-wrap items-center gap-3 p-2">
                                                <div class="rounded-full size-10 shrink-0">
                                                    <img src="{{ asset(Auth::user()->photo) }}" alt=""
                                                        class="h-10 rounded-full">
                                                </div>
                                                <div class="grow">
                                                    <h6 class="mb-1">
                                                        <a href="#!">
                                                            {{ $cee_result->firstname }}
                                                            {{ $cee_result->middlename ? strtoupper(substr($cee_result->middlename, 0, 1)) . '.' : '' }}
                                                            {{ $cee_result->lastname }}
                                                            {{ $cee_result->suffix }}
                                                        </a>
                                                    </h6>
                                                    <p class="text-slate-500 dark:text-zink-200">{{ $cee_result->email }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="p-2 border-t border-slate-200 dark:border-zink-500">
                                                <div class="flex flex-col gap-3">
                                                    <p class="text-slate-500 dark:text-zink-200 shrink-0">
                                                        <b>Program Selected: </b><br>
                                                        <span class="align-middle">
                                                            {{ $programDataBatch2['programName'] ?? '---' }} -
                                                            {{ $programDataBatch2['majorDiscDesc'] ?? '---' }}
                                                        </span>
                                                    </p>

                                                    <p class="text-slate-500 dark:text-zink-200 shrink-0">
                                                        <b>Campus and College: </b><br>
                                                        <span class="align-middle">
                                                            {{ $programDataBatch2['realCampus'] ?? '---' }} -
                                                            {{ $programDataBatch2['collegeName'] ?? '---' }}
                                                        </span>
                                                    </p>

                                                    <p class="text-slate-500 dark:text-zink-200 shrink-0">
                                                        <b>Date and Time: </b><br>
                                                        <span class="align-middle">
                                                            {{ $cee_profile->date_program_selected ? \Carbon\Carbon::parse($cee_profile->date_program_selected)->format('F j, Y g:i A') : '---' }}
                                                        </span>
                                                    </p>

                                                    <p class="text-slate-500 dark:text-zink-200 shrink-0">
                                                        <b>Status:</b><br>
                                                        <span class="align-middle">
                                                            @if ($cee_profile->prereg_status == 'for_ranking')
                                                                <span
                                                                    class="px-2.5 py-0.5 inline-block text-[11px] font-medium rounded border bg-yellow-100 border-transparent text-yellow-500 dark:bg-yellow-500/20 dark:border-transparent">
                                                                    Selected
                                                                </span>
                                                            @elseif($cee_profile->prereg_status == 'pending' && $cee_profile->status_id == null)
                                                                <span
                                                                    class="px-2.5 py-0.5 inline-block text-[11px] font-medium rounded border bg-custom-100 border-transparent text-custom-500 dark:bg-custom-500/20 dark:border-transparent">
                                                                    Confirmed
                                                                </span>
                                                            @elseif($cee_profile->prereg_status == 'cancelled')
                                                                <span
                                                                    class="px-2.5 py-0.5 inline-block text-[11px] font-medium rounded border bg-red-100 border-transparent text-red-500 dark:bg-red-500/20 dark:border-transparent">
                                                                    Cancelled
                                                                </span>
                                                            @elseif($cee_profile->prereg_status == 'denied')
                                                                <span
                                                                    class="px-2.5 py-0.5 inline-block text-[11px] font-medium rounded border bg-red-100 border-transparent text-red-500 dark:bg-red-500/20 dark:border-transparent">
                                                                    Denied
                                                                </span>
                                                            @elseif($cee_profile->prereg_status == 'enrolled' || $cee_profile->status_id == 1)
                                                                <span
                                                                    class="mb-2 px-2.5 py-0.5 inline-block text-[11px] font-medium rounded border bg-green-100 border-transparent text-green-500 dark:bg-green-500/20 dark:border-transparent">
                                                                    You are officially enrolled!
                                                                </span>
                                                                <span
                                                                    class="inline-block px-2.5 py-0.5 text-[11px] font-medium rounded bg-purple-100 text-purple-600 dark:bg-purple-500/20">
                                                                    Tap the <b class="text-purple-600">Pre-registration
                                                                        Menu</b>, then tap the
                                                                    <b class="text-purple-600">View Certificate of
                                                                        Registration</b> button to get your
                                                                    Certificate of Registration.
                                                                </span>
                                                            @else
                                                                ---
                                                            @endif
                                                        </span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @elseif(now()->between($start_batch_1, $end_batch_1) || now()->between($start, $end))
                                    <h4>You Qualified for Your Priority Program at USM!</h4>

                                    <p class="mt-4 mb-4">
                                        Dear {{ $cee_result->firstname }}
                                        {{ $cee_result->middlename ? strtoupper(substr($cee_result->middlename, 0, 1)) . '.' : '' }}
                                        {{ $cee_result->lastname }}
                                        {{ $cee_result->suffix }},
                                    </p>

                                    <p class="mb-4">Congratulations!</p>
                                    <p class="text-slate-800">
                                        Based on your USM College Entrance Examination (USMCEE) result, you have qualified
                                        for admission to the program:
                                        <b class="text-custom-500">
                                            {{ $programResponse['programName'] ?? '---' }}
                                            {{ $programResponse['majorDiscDesc'] ?? '' }} - 
                                            {{ $programResponse['realCampus'] ?? '' }}
                                        </b>.
                                        Please confirm your chosen program by clicking the Confirm button below on or before
                                        March 23, 2026.
                                        <br><br>

                                        <a href="{{ route('student.prereg.index') }}"
                                            class="mt-2 text-white bg-green-500 border-green-500 btn hover:text-white hover:bg-green-600 hover:border-green-600 focus:text-white focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-100 active:text-white active:bg-green-600 active:border-green-600 active:ring active:ring-green-100 dark:ring-green-400/10">
                                            <i data-lucide="thumbs-up" class="inline-block size-4 dark:text-zink-200"></i>
                                            Confirm
                                        </a>


                                        <hr class="mt-4 border-t-2 border-slate-200 dark:border-zink-700">
                                    <h5 class="self-end mt-5">Other Programs You May Qualify For
                                    </h5>
                                    <p class="mt-4"> If you prefer to enroll in any of these programs, <b> wait until
                                            March 24, 2026
                                            for slot confirmation</b>. <br><br>
                                        Please note that admission is not guaranteed, as acceptance will still be based on
                                        ranking and the availability of slots.</p><br>
                                    @if (isset($qualifiedCampuses['qualifiedCampuses']) && !empty($qualifiedCampuses['qualifiedCampuses']))
                                        <div class="overflow-x-auto">
                                            @foreach ($qualifiedCampuses['qualifiedCampuses'] as $campus)
                                                <div class="w-full mb-2 whitespace-nowrap">
                                                    <h5
                                                        class="p-2 text-left text-green-500 bg-green-100 dark:bg-zink-600 dark:text-zink-200">
                                                        @if (!empty($campus['qualifiedPrograms']))
                                                            {{ $campus['qualifiedPrograms'][0]['realCampus'] }}
                                                        @else
                                                            {{ $campus['campusName'] }}
                                                        @endif
                                                    </h5>

                                                    <div class="overflow-x-auto">
                                                        <table class="w-full whitespace-nowrap">
                                                            <thead
                                                                class="text-left bg-slate-100 text-slate-500 dark:bg-zink-600 dark:text-zink-200">
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($campus['qualifiedPrograms'] as $program)
                                                                    <tr
                                                                        class="even:bg-slate-50 hover:bg-slate-50 even:hover:bg-slate-100 dark:even:bg-zink-600/50 dark:hover:bg-zink-600 dark:even:hover:bg-zink-600">
                                                                        <td
                                                                            class="px-2 py-1 border-y border-slate-200 dark:border-zink-500">
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
                                @else
                                    <p class="mt-4 mb-4">
                                        Dear {{ $cee_result->firstname }}
                                        {{ $cee_result->middlename ? strtoupper(substr($cee_result->middlename, 0, 1)) . '.' : '' }}
                                        {{ $cee_result->lastname }}
                                        {{ $cee_result->suffix }},
                                    </p>
                                    <p class="text-slate-800">
                                        Please be informed that the Preregistration has ended.
                                        <br><br>
                                    </p>
                                @endif
                                {{-- end if --}}
                            @else
                                @if (($is_qualified_pre_reg == 1 || $is_qualified_pre_reg == 0) && now()->between($start, $end))

                                    {{-- start --}}
                                    @if ($has_policy_id == 0)
                                        <h6 class="mt-4">Dear {{ $cee_result->firstname }}
                                            {{ $cee_result->middlename ? strtoupper(substr($cee_result->middlename, 0, 1)) . '.' : '' }}
                                            {{ $cee_result->lastname }}
                                            {{ $cee_result->suffix }},</h6>
                                        <br>
                                        <p class="text-slate-800">

                                            @if ($cee_profile && $cee_profile->policyId == null && $cee_profile->programName != null)
                                                <strong class="mb-4 text-custom-500">
                                                    We understand that you have selected
                                                    {{ $cee_profile->programName }}
                                                    {{ $cee_profile->majorDiscDesc }}. However, we regret to inform you
                                                    that you did not qualify for the said program based on your ranking.
                                                    Please choose another program from the available options offered to
                                                    you.
                                                </strong>
                                                <br> <br>
                                            @endif
                                            You passed the <b class="text-green-500">USM College Entrance Examination
                                                (USMCEE)</b> .<br>Admission to programs
                                            is subject to ranking and the availability of slots. Please select your
                                            preferred program on <b>March 24, 2026</b>, from the list below.<br><br>

                                            @if (isset($qualifiedCampuses['qualifiedCampuses']) && !empty($qualifiedCampuses['qualifiedCampuses']))
                                                <div class="overflow-x-auto">
                                                    @foreach ($qualifiedCampuses['qualifiedCampuses'] as $campus)
                                                        <div class="w-full mb-4 whitespace-nowrap">
                                                            <h5
                                                                class="p-2 text-left text-green-500 bg-green-100 dark:bg-zink-600 dark:text-zink-200">
                                                                @if (!empty($campus['qualifiedPrograms']))
                                                                    {{ $campus['qualifiedPrograms'][0]['realCampus'] }}
                                                                @else
                                                                    {{ $campus['campusName'] }}
                                                                @endif
                                                            </h5>

                                                            <div class="overflow-x-auto">
                                                                <table class="w-full whitespace-nowrap">
                                                                    <thead
                                                                        class="text-left bg-slate-100 text-slate-500 dark:bg-zink-600 dark:text-zink-200">
                                                                        <tr>
                                                                            <th
                                                                                class="px-2 py-1 font-semibold border-b border-slate-200 dark:border-zink-500">
                                                                            </th>
                                                                            <th>Program Name</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($campus['qualifiedPrograms'] as $program)
                                                                            <tr
                                                                                class="even:bg-slate-50 hover:bg-slate-50 even:hover:bg-slate-100 dark:even:bg-zink-600/50 dark:hover:bg-zink-600 dark:even:hover:bg-zink-600">
                                                                                <td
                                                                                    class="px-2 py-1 border-y border-slate-200 dark:border-zink-500">
                                                                                    <button
                                                                                        data-program="{{ $program['policyId'] }}"
                                                                                        class="text-white selectProgramBtn border-custom-500 bg-custom-500 btn hover:text-white hover:bg-custom-600 hover:yellow-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/10">
                                                                                        Select</button>
                                                                                </td>
                                                                                <td
                                                                                    class="px-2 py-1 border-y border-slate-200 dark:border-zink-500">
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
                                                <div class="mt-2 mb-2 alert alert-info">
                                                    No qualified programs found.
                                                </div>
                                            @endif
                                        </p>
                                    @elseif($has_policy_id == 1)
                                        <p class="text-slate-800">
                                            Below are the details of your selected program.
                                            Please note that admission is not automatic, as all qualifiers will undergo
                                            a
                                            ranking process. <br><br>
                                        </p>
                                        <div class="flex flex-col gap-3">
                                            <div class="border rounded-md border-slate-200 dark:border-zink-500">
                                                <div class="flex flex-wrap items-center gap-3 p-2">
                                                    <div class="rounded-full size-10 shrink-0">
                                                        <img src="{{ asset(Auth::user()->photo) }}" alt=""
                                                            class="h-10 rounded-full">
                                                    </div>
                                                    <div class="grow">
                                                        <h6 class="mb-1"><a href="#!">{{ $cee_result->firstname }}
                                                                {{ $cee_result->middlename ? strtoupper(substr($cee_result->middlename, 0, 1)) . '.' : '' }}
                                                                {{ $cee_result->lastname }}
                                                                {{ $cee_result->suffix }}</a></h6>
                                                        <p class="text-slate-500 dark:text-zink-200">
                                                            {{ $cee_result->email }}</p>
                                                    </div>
                                                </div>
                                                <div class="p-2 border-t border-slate-200 dark:border-zink-500">
                                                    <div class="flex flex-col gap-3">
                                                        <p class="text-slate-500 dark:text-zink-200 shrink-0"><b>Program
                                                                Selected: </b><br><span class="align-middle">
                                                                {{ $programDataBatch2['programName'] }} -
                                                                {{ $programDataBatch2['majorDiscDesc'] }}</span></p>
                                                        <p class="text-slate-500 dark:text-zink-200 shrink-0"><b>Campus
                                                                and
                                                                College: </b><br><span
                                                                class="align-middle">{{ $programDataBatch2['realCampus'] }}
                                                                - {{ $programDataBatch2['collegeName'] }}</span></p>
                                                        <p class="text-slate-500 dark:text-zink-200 shrink-0"><b>Date
                                                                and
                                                                Time: </b><br><span
                                                                class="align-middle">{{ \Carbon\Carbon::parse($cee_profile->date_program_selected)->format('F j, Y g:i A') }}</span>
                                                        </p>
                                                        <p class="text-slate-500 dark:text-zink-200 shrink-0"><b>Status:
                                                            </b><br>
                                                            <span class="align-middle">
                                                                @if ($cee_profile->prereg_status == 'for_ranking' && $cee_profile->campus_id == null)
                                                                    <span
                                                                        class="mb-2 px-2.5 py-0.5 inline-block text-[11px] font-medium rounded border bg-yellow-100 border-transparent text-yellow-500 dark:bg-yellow-500/20 dark:border-transparent">
                                                                        Selected
                                                                    </span>
                                                                    <span
                                                                        class="px-2.5 py-0.5 inline-block text-[11px] font-medium rounded border bg-purple-100 border-transparent text-purple-500 dark:bg-purple-500/20 dark:border-transparent">
                                                                        Kindly finish all the steps to confirm your
                                                                        selected
                                                                        program for ranking.
                                                                    </span>
                                                                @elseif($cee_profile->prereg_status == 'pending' && $cee_profile->status_id == null)
                                                                    <span
                                                                        class="mb-2 px-2.5 py-0.5 inline-block text-[11px] font-medium rounded borsder bg-custom-100 border-transparent text-custom-500 dark:bg-custom-500/20 dark:border-transparent uppercase">
                                                                        Confirmed for enrollment
                                                                    </span>
                                                                    @if ($cee_profile->is_answered_nstp == 1)
                                                                        <br>
                                                                        <span
                                                                            class="px-2.5 py-0.5 inline-block text-[11px] font-medium rounded border bg-green-100 border-transparent text-green-500 dark:bg-green-500/20 dark:border-transparent">
                                                                            NSTP PREFERENCE:
                                                                            {{ $cee_profile->nstp == 1 ? 'CWTS' : 'ROTC' }}
                                                                        </span>
                                                                    @endif
                                                                    {{-- check if requirements has been submittted --}}
                                                                    @if (is_null($requirements_submitted))
                                                                        <span
                                                                            class="px-2.5 py-0.5 inline-block text-[11px] font-medium rounded border bg-purple-100 border-transparent text-purple-500 dark:bg-purple-500/20 dark:border-transparent">
                                                                            Please submit the original copies of the
                                                                            required
                                                                            documents to the
                                                                            <b class="text-purple-500">Admission and
                                                                                Records
                                                                                Office (ARO)</b> as soon as possible.
                                                                            If
                                                                            you have already submitted your documents,
                                                                            kindly
                                                                            disregard this message.
                                                                        </span>
                                                                    @else
                                                                        @php
                                                                            $labels = [
                                                                                'goodmoral' => 'Good Moral Certificate',
                                                                                'card' => 'Report Card',
                                                                                'psa' => 'PSA Birth Certificate',
                                                                                'hdismissal' => 'Honorable Dismissal',
                                                                                'certificatetransfer' =>
                                                                                    'Certificate of Transfer',
                                                                                'transcript' => 'Transcript of Records',
                                                                            ];
                                                                        @endphp

                                                                        <div class="flex flex-wrap items-center gap-2">
                                                                            @foreach ($labels as $key => $label)
                                                                                @if ($requirements_submitted->$key == 1)
                                                                                    <span
                                                                                        class="flex items-center px-2.5 py-0.5 text-xs font-medium rounded border bg-white border-green-400 text-green-500 dark:bg-zink-700 dark:border-green-700">
                                                                                        <i data-lucide="check"
                                                                                            class="size-3 ltr:ml-1 rtl:mr-1"></i>
                                                                                        {{ $label }}
                                                                                        <a href="#!"
                                                                                            class="text-green-400 transition hover:text-green-600"></a></span>
                                                                                @endif
                                                                            @endforeach
                                                                        </div>
                                                                    @endif
                                                                @elseif($cee_profile->prereg_status == 'for_ranking' && $cee_profile->campus_id != null)
                                                                    <span
                                                                        class="px-2.5 py-0.5 inline-block text-[11px] font-medium rounded borsder bg-custom-100 border-transparent text-custom-500 dark:bg-custom-500/20 dark:border-transparent">Confirmed
                                                                        for Ranking</span>
                                                                @elseif($cee_profile->prereg_status == 'cancelled')
                                                                    <span
                                                                        class="px-2.5 py-0.5 inline-block text-[11px] font-medium rounded border bg-red-100 border-transparent text-red-500 dark:bg-red-500/20 dark:border-transparent">Cancelled</span>
                                                                @elseif($cee_profile->prereg_status == 'denied')
                                                                    <span
                                                                        class="px-2.5 py-0.5 inline-block text-[11px] font-medium rounded border bg-red-100 border-transparent text-red-500 dark:bg-red-500/20 dark:border-transparent">Denied
                                                                    </span>
                                                                @elseif($cee_profile->status_id == 0)
                                                                    <span
                                                                        class="px-2.5 py-0.5 inline-block text-[11px] font-medium rounded border bg-orange-100 border-transparent text-orange-500 dark:bg-orange-500/20 dark:border-transparent">Enrollment
                                                                        in progress</span>
                                                                @elseif($cee_profile->prereg_status == 'enrolled' || $cee_profile->status_id == 1)
                                                                    <span
                                                                        class="mb-2 px-2.5 py-0.5 inline-block text-[11px] font-medium rounded border bg-green-100 border-transparent text-green-500 dark:bg-green-500/20 dark:border-transparent">You
                                                                        are officially enrolled!</span><br>
                                                                    <span
                                                                        class="inline-block px-2.5 py-0.5 text-[11px] font-medium rounded bg-purple-100 text-purple-600 dark:bg-purple-500/20">
                                                                        Tap the <b class="text-purple-600">Pre-registration
                                                                            Menu</b>, then
                                                                        tap the <b class="text-purple-600">View
                                                                            Certificate
                                                                            of Registration </b>button to get
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

                                            @if ($cee_profile->campus_id == null)
                                                <p class="text-slate-800">
                                                    Please proceed to Profile Registration by tapping or clicking the
                                                    <strong>"Profile Registration"</strong> button below.<br>
                                                    <a href="{{ route('student.applicant-profile.step1.show') }}"
                                                        class="mt-4 text-white bg-green-500 border-green-500 btn hover:text-white hover:bg-green-600 hover:border-green-600 focus:text-white focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-100 active:text-white active:bg-green-600 active:border-green-600 active:ring active:ring-green-100 dark:ring-green-400/10">
                                                        <i data-lucide="user"
                                                            class="inline-block size-4 dark:text-zink-200"></i>
                                                        Profile Registration</a>
                                                </p>
                                            @endif
                                        </div>
                                    @endif

                                    {{-- end --}}
                                @else
                                    {{-- message for second batch qualified applicants --}}
                                    <h4>Update on Your USMCEE Result</h4>

                                    <p class="mt-4 mb-4">Dear {{ $cee_result->firstname }}
                                        {{ $cee_result->middlename ? strtoupper(substr($cee_result->middlename, 0, 1)) . '.' : '' }}
                                        {{ $cee_result->lastname }}
                                        {{ $cee_result->suffix }},</p>

                                    <br>


                                    You passed the <b class="text-green-500">USM College Entrance Examination
                                        (USMCEE)</b> .<br>Admission to programs
                                    is subject to ranking and the availability of slots. Please select your
                                    preferred program on <b>March 24, 2026</b>, from the list below.<br><br>
                                    @if (isset($qualifiedCampuses['qualifiedCampuses']) && !empty($qualifiedCampuses['qualifiedCampuses']))
                                        <div class="overflow-x-auto">
                                            @foreach ($qualifiedCampuses['qualifiedCampuses'] as $campus)
                                                <div class="w-full mb-2 whitespace-nowrap">
                                                    <h5
                                                        class="p-2 text-left text-green-500 bg-green-100 dark:bg-zink-600 dark:text-zink-200">
                                                        @if (!empty($campus['qualifiedPrograms']))
                                                            {{ $campus['qualifiedPrograms'][0]['realCampus'] }}
                                                        @else
                                                            {{ $campus['campusName'] }}
                                                        @endif
                                                    </h5>

                                                    <div class="overflow-x-auto">
                                                        <table class="w-full whitespace-nowrap">
                                                            <thead
                                                                class="text-left bg-slate-100 text-slate-500 dark:bg-zink-600 dark:text-zink-200">
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($campus['qualifiedPrograms'] as $program)
                                                                    <tr
                                                                        class="even:bg-slate-50 hover:bg-slate-50 even:hover:bg-slate-100 dark:even:bg-zink-600/50 dark:hover:bg-zink-600 dark:even:hover:bg-zink-600">
                                                                        <td
                                                                            class="px-2 py-1 border-y border-slate-200 dark:border-zink-500">
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
                                @endif
                            @endif


                        @endif
                    </div>

                    <div class="grid grid-cols-1 mt-10 2xl:grid-cols-12">
                        <div class="self-end mt-10 2xl:col-span-2">
                            <hr class="mb-5 border-t-2 border-slate-200 dark:border-zink-700">
                            <img src="{{ asset('backend/assets/images/logo-dark.png') }}" alt=""
                                class="h-12 mx-auto">
                            {{-- <h6>University of Southern Mindanao</h6> --}}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    @endif
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const buttons = document.querySelectorAll('.selectProgramBtn');

            buttons.forEach(button => {
                button.addEventListener('click', function() {
                    const programPolicyId = this.getAttribute('data-program'); // Get policyId here

                    Swal.fire({
                        title: "Are you sure?",
                        text: `Submitting this will save your intent to preregister in the selected program for ranking`,
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Yes, I confirm!",
                        cancelButtonText: "Cancel"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Use the same programPolicyId inside the .then() block
                            fetch("{{ route('student.ranking.second-batch') }}", {
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
                                                "You have successfully selected the program.",
                                                "success")
                                            .then(() => location.reload());
                                    } else {
                                        Swal.fire("Error!", data.message ||
                                            "Unknown error", "error");
                                    }
                                })
                                .catch(() => {
                                    Swal.fire("Error!",
                                        "Something went wrong. Try again later.",
                                        "error");
                                });
                        }
                    });
                });
            });
        });
    </script>
@endpush
