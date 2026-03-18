@extends('student.layouts.master')
@section('title')
    USM-CEE | Result
@endsection

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

    <div class="grid grid-cols-1 2xl:grid-cols-12">
        @if ($cee_result->isNotEmpty())
            <div class="flex flex-col col-span-1 gap-3 card 2xl:col-span-12">
                <div class="card-body">
                    <h6 class="mb-4 text-15">
                        USM-CEE RESULT OF
                        {{ strtoupper($reservation->lastname . ', ' . $reservation->firstname . ' ' . $reservation->middlename . ', ' . $reservation->suffix) }}
                    </h6>

                    <div class="overflow-x-auto">
                        <table class="w-full border-separate table-custom border-spacing-y-1">
                            <thead class="ltr:text-left rtl:text-right">
                                <tr
                                    class="relative rounded-md bg-slate-50 after:absolute after:border-l-2 after:left-0 after:top-0 after:bottom-0 after:border-transparent dark:bg-zink-600 [&.active]:after:border-custom-500">
                                    <th class="px-3.5 py-2.5 font-semibold">Action</th>
                                    <th class="px-3.5 py-2.5 font-semibold">App #</th>
                                    <th class="px-3.5 py-2.5 font-semibold">CEE Term</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cee_result as $result)
                                    @php
                                        $isActiveSession = optional($result->cee_term)->status === 'active';
                                    @endphp

                                    <tr
                                        class="relative rounded-md bg-slate-50 after:absolute after:border-l-2 after:left-0 after:top-0 after:bottom-0 after:border-transparent dark:bg-zink-600 [&.active]:after:border-custom-500">
                                        <td class="px-3.5 py-2.5">
                                            <div class="flex space-x-2">
                                                @if ($isActiveSession)
                                                    <a href="{{ route('student.cee.result-message', ['app_no' => encrypt($result->app_no)]) }}"
                                                        class="flex items-center justify-center text-green-500 transition-all duration-200 ease-linear bg-green-100 btn hover:text-white hover:bg-green-600 focus:text-white focus:bg-green-600 focus:ring focus:ring-green-100 active:text-white active:bg-green-600 active:ring active:ring-green-100 dark:bg-green-500/20 dark:text-green-400 dark:hover:bg-green-500 dark:hover:text-white dark:focus:bg-green-500 dark:focus:text-white dark:active:bg-green-500 dark:active:text-white dark:ring-green-400/20">
                                                        View Result
                                                    </a>
                                                @else
                                                    <span
                                                        class="flex items-center justify-center transition-all duration-200 ease-linear cursor-not-allowed bg-slate-100 text-slate-500 btn dark:bg-slate-500/20 dark:text-slate-400">
                                                        View Result Disabled
                                                    </span>
                                                @endif
                                            </div>
                                        </td>

                                        <td class="px-3.5 py-2.5">
                                            <a href="#"
                                                class="transition-all duration-150 ease-linear text-custom-500 hover:text-custom-600">
                                                {{ $result->app_no }}
                                            </a>
                                        </td>

                                        <td class="px-3.5 py-2.5">
                                            {{ $result->cee_term->name ?? 'N/A' }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @else
            <div class="flex flex-col col-span-1 gap-3 2xl:col-span-12">
                <div
                    class="px-4 py-3 text-sm bg-white border rounded-md border-custom-300 text-custom-500 dark:bg-zink-700 dark:border-custom-500">
                    <span class="font-bold">Hi!</span> No Result yet.
                </div>
            </div>
        @endif
    </div>
@endsection
