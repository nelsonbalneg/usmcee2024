@extends('student.layouts.master')
@section('title')
    USM-CEE | Terms and Conditions
@endsection


@section('contents')
    <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
        <div class="grow">
            <h5 class="text-16">USM-CEE | Terms and Conditions</h5>
        </div>
        <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="#!" class="text-slate-400 dark:text-zink-200">Home</a>
            </li>
            <li class="text-slate-700 dark:text-zink-100">
                Terms and Conditions
            </li>
        </ul>
    </div>
    <div class="flex items-center justify-center min-h-screen px-4 bg-slate-100">
        <div class="w-full max-w-3xl overflow-hidden bg-white border shadow-sm border-slate-200 rounded-2xl">
            <div class="px-6 py-5 border-b border-slate-200 bg-sky-50">
                <h1 class="text-xl font-semibold text-slate-800">
                    {{ $activeTermsPolicy->title }}
                </h1>
                <p class="mt-1 text-sm text-slate-500">
                    Version {{ $activeTermsPolicy->version }}
                    @if ($activeTermsPolicy->effective_date)
                        • Effective {{ \Carbon\Carbon::parse($activeTermsPolicy->effective_date)->format('F d, Y') }}
                    @endif
                </p>
            </div>

            <div class="px-6 py-5 max-h-[60vh] overflow-y-auto">
                {!! $activeTermsPolicy->content !!}
            </div>

        </div>
    </div>
@endsection
