@extends('student.layouts.master')
@section('title')
    Pre-registration | Certificate of Registration
@endsection


@section('contents')
    <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
        <div class="grow">
            <h5 class="uppercase text-16">Pre-registration - Certificate of Registration (COR)</h5>
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
                COR
            </li>
        </ul>
    </div>

    <div class="grid grid-cols-1 gap-x-5 xl:grid-cols-12">
        <!--start col-->
        <div class="xl:col-span-12">
            <!-- Display PDF in an iframe -->
            <div>
                <iframe src="{{ $pdfUrl }}" width="100%" height="600px"></iframe>
            </div>

            {{-- <!-- Download Link -->
            <div>
                <a href="{{route('student.generate-dtr.report')}}" class="btn btn-primary">Download PDF</a>
            </div> --}}

            <a href="{{ $downloadUrl }}"
                class="block w-full mt-2 mb-2 text-white border-custom-500 bg-custom-500 btn hover:text-white hover:bg-custom-600 hover:yellow-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/10">
                <i data-lucide="download" class="inline-block h-4 align-middle"></i>
                Download
            </a>
        </div>
    </div>
@endsection
