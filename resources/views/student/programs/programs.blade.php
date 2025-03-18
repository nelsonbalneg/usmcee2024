@extends('student.layouts.master')
@section('title')
    USM-CEE | Programs
@endsection

@section('contents')
    <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
        <div class="grow">
            <h5 class="text-16">USMCEE 4.0 | Program Enlistment</h5>
        </div>
        <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="#!" class="text-slate-400 dark:text-zink-200">Home</a>
            </li>
            <li class="text-slate-700 dark:text-zink-100">
                Programs
            </li>
        </ul>
    </div>

    <div class="grid grid-cols-1 mb-10 gap-x-5 md:grid-cols-2 xl:grid-cols-12">
        <div class="xl:col-span-3">
            <div class="card">
                <div class="flex items-center gap-3 card-body">
                    <div
                        class="flex items-center justify-center text-green-500 bg-green-100 rounded-md size-12 text-15 dark:bg-green-500/20 shrink-0">
                        <i data-lucide="percent"></i>
                    </div>
                    <div class="grow">
                        <h5 class="mb-1 text-16"><span class="counter-value" data-target="{{$examinee->csa}}"></span></h5>
                        <p class="text-slate-500 dark:text-zink-200">CSA</p>
                    </div>
                </div>
            </div>
        </div><!--end col-->
        <div class="xl:col-span-3">
            <div class="card">
                <div class="flex items-center gap-3 card-body">
                    <div
                        class="flex items-center justify-center text-green-500 bg-green-100 rounded-md size-12 text-15 dark:bg-green-500/20 shrink-0">
                        <i data-lucide="graduation-cap"></i>
                    </div>
                    <div class="grow">
                        <h5 class="mb-1 text-16">---</h5>
                        <p class="text-slate-500 dark:text-zink-200">Program Selected</p>
                    </div>
                </div>
            </div>
        </div><!--end col-->
        <div class="xl:col-span-3">
            <div class="card">
                <div class="flex items-center gap-3 card-body">
                    <div
                        class="flex items-center justify-center text-purple-500 bg-purple-100 rounded-md size-12 text-15 dark:bg-purple-500/20 shrink-0">
                        <i data-lucide="history"></i>
                    </div>
                    <div class="grow">
                        <h5 class="mb-1 text-16">---</h5>
                        <p class="text-slate-500 dark:text-zink-200">Status</p>
                    </div>
                </div>
            </div>
        </div><!--end col-->
        <div class="xl:col-span-3">
            <div class="card">
                <div class="flex items-center gap-3 card-body">
                    <div
                        class="flex items-center justify-center rounded-md size-12 text-sky-500 bg-sky-100 text-15 dark:bg-sky-500/20 shrink-0">
                        <i data-lucide="id-card"></i>
                    </div>
                    <div class="grow">
                        <h5 class="mb-1 text-16">---</h5>
                        <p class="text-slate-500 dark:text-zink-200">Student ID Number</p>
                    </div>
                </div>
            </div>
        </div><!--end col-->
    </div><!--end grid-->


    <div class="grid grid-cols-1 2xl:grid-cols-12">
        <div class="flex flex-col col-span-1 gap-3 card 2xl:col-span-12">

            <div class="card-body">
                Hi {{ $examinee->fullname }}
            </div>

        </div>
    </div>
@endsection
