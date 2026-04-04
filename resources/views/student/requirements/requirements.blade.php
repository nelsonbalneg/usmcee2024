@extends('student.layouts.master')
@section('title')
    Pre-registration - Student Profile Form
@endsection

@push('styles')
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css"> --}}
@endpush


@section('contents')

    <x-page-header title="USMCEE 4.0 | PRE-REGISTRATION - REQUIREMENTS" :breadcrumbs="[
        ['label' => 'Home', 'url' => route('dashboard')],
        ['label' => 'Pre-registration', 'url' => '#!'],
        ['label' => 'Requirements'],
    ]" />


    @if ($applicant->applicant_profile_status == 1)
        <div class="grid grid-cols-1 xl:grid-cols-12 gap-x-5">

            {{-- requirements --}}
            <div class="xl:col-span-4">
                @include('student.partials.requirements-checklist')
            </div>

            <div class="xl:col-span-8">

                <div class="card">
                    <div class="card-body">
                        <div class="mb-6">
                            {{-- Section Header --}}
                            <div class="mb-4">
                                <p class="mb-1 text-[11px] font-semibold tracking-[0.22em] uppercase text-sky-500">
                                    Document Submission
                                </p>
                                <h6
                                    class="flex items-center gap-2 text-lg font-bold tracking-tight uppercase text-slate-800 dark:text-white">
                                    Pre-registration Requirements
                                </h6>
                            </div>

                            {{-- Fraud Warning --}}
                            <div
                                class="relative mb-4 overflow-hidden border shadow-sm rounded-2xl border-custom-200 bg-gradient-to-br from-custom-50 to-white dark:border-custom-500/20 dark:bg-custom-500/10">
                                <div class="absolute rounded-full -top-8 -right-8 size-24 bg-custom-400/10 blur-2xl"></div>

                                <div class="relative p-5">
                                    <div class="flex gap-3">
                                        <div
                                            class="flex items-center justify-center text-white shadow-lg shrink-0 rounded-xl size-11 bg-custom-500 shadow-custom-500/20">
                                            <i data-lucide="alert-circle" class="size-5"></i>
                                        </div>

                                        <div class="min-w-0">
                                            <div class="mb-3">
                                                <p
                                                    class="mb-1 text-[11px] font-semibold tracking-[0.16em] uppercase text-custom-500">
                                                    Important Notice
                                                </p>
                                                <h6
                                                    class="text-base font-bold tracking-tight text-slate-800 dark:text-white">
                                                    Prohibition Against Fraud and Misrepresentation
                                                </h6>
                                            </div>

                                            <div class="space-y-2 text-sm text-slate-600 dark:text-zink-200">
                                                <div class="flex gap-2">
                                                    <i data-lucide="dot" class="mt-1 shrink-0 size-4 text-custom-500"></i>
                                                    <p>
                                                        Providing incorrect information violates university policy,
                                                        compromising academic integrity
                                                        and the security of student records.
                                                    </p>
                                                </div>

                                                <div class="flex gap-2">
                                                    <i data-lucide="dot" class="mt-1 shrink-0 size-4 text-custom-500"></i>
                                                    <p>
                                                        Such misrepresentation may incur penalties under Articles 172 and
                                                        315 of the Revised
                                                        Penal Code.
                                                    </p>
                                                </div>

                                                <div class="flex gap-2">
                                                    <i data-lucide="dot" class="mt-1 shrink-0 size-4 text-custom-500"></i>
                                                    <p>
                                                        USM reserves the right to take disciplinary and legal actions,
                                                        including denial of
                                                        admission and potential prosecution under Philippine law.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Affidavit Notice --}}
                            <div
                                class="relative overflow-hidden border border-orange-200 shadow-sm rounded-2xl bg-gradient-to-br from-orange-50 to-white dark:border-orange-500/20 dark:bg-orange-500/10">
                                <div class="absolute rounded-full -top-8 -right-8 size-24 bg-orange-400/10 blur-2xl"></div>

                                <div class="relative p-5">
                                    <div class="flex gap-3">
                                        {{-- <div
                                            class="flex items-center justify-center text-white shadow-lg shrink-0 rounded-xl size-11 bg-gradient-to-br from-orange-500 to-amber-500 shadow-orange-500/20">
                                            <i data-lucide="file-warning" class="size-5"></i>
                                        </div> --}}

                                        <div class="w-full min-w-0">
                                            <div class="mb-3">
                                                <p
                                                    class="mb-1 text-[11px] font-semibold tracking-[0.16em] uppercase text-orange-500">
                                                    Alternative Requirement
                                                </p>
                                                <h6
                                                    class="text-base font-bold tracking-tight text-slate-800 dark:text-white">
                                                    Affidavit of Undertaking
                                                </h6>
                                            </div>

                                            <p class="text-sm text-slate-600 dark:text-zink-200">
                                                <span class="font-semibold text-orange-600 dark:text-orange-300">
                                                    If credentials are not yet available,
                                                </span>
                                                please download the affidavit of undertaking, fill it out, sign it, and
                                                upload the scanned copy.
                                            </p>

                                            <div class="mt-4">
                                                <a href="https://drive.google.com/file/d/1EaLXVYuxuEj47ShaM38fk9f_41bRdaEb/view?usp=sharing"
                                                    class="inline-flex items-center gap-2 px-4 py-2.5 text-sm font-semibold text-white rounded-xl
                                                                    bg-orange-500 hover:bg-orange-600
                                                                    shadow-sm hover:shadow-md
                                                                    transition-all duration-200 hover:-translate-y-[1px]
                                                                    focus:outline-none focus:ring-2 focus:ring-orange-200">

                                                    <i data-lucide="download" class="size-4"></i>
                                                    Download Affidavit of Undertaking
                                                </a>
                                            </div>

                                            <div
                                                class="px-4 py-3 mt-4 text-sm text-orange-700 border border-orange-200 rounded-xl bg-orange-50 dark:border-orange-500/20 dark:bg-orange-500/10 dark:text-orange-700">
                                                <span class="font-bold">Note:</span> No enrollment will be processed with
                                                incomplete admission
                                                requirements.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Original PSA Birth Certificate --}}
                        <div class="space-y-4">

                            {{-- Header --}}
                            <div class="flex items-center justify-between">
                                <div>
                                    <h6 class="text-base font-bold text-slate-800 dark:text-white">
                                        Original PSA Birth Certificate
                                        <span class="ml-1 text-xs font-semibold text-red-500 uppercase">Required</span>
                                    </h6>
                                    <p class="mt-1 text-sm text-slate-500 dark:text-zink-300">
                                        Upload a clear scanned copy of your original PSA birth certificate.
                                    </p>
                                </div>
                            </div>

                            {{-- Upload Form --}}
                            @if (optional($requirements->first())->req_status == 0)
                                <form action="{{ route('student.applicant-requirements.store') }}" method="POST"
                                    enctype="multipart/form-data"
                                    class="p-4 border rounded-2xl bg-slate-50/70 border-slate-200 dark:bg-zink-700/30 dark:border-zink-600">
                                    @csrf

                                    @error('psa_files.*')
                                        <div class="mb-3 text-sm text-red-500">{{ $message }}</div>
                                    @enderror

                                    <div class="space-y-4">
                                        {{-- Drag and Drop Area --}}
                                        <label for="psa_files"
                                            class="block p-6 text-center transition bg-white border-2 border-dashed cursor-pointer rounded-2xl border-slate-300 hover:border-green-400 hover:bg-slate-50 dark:bg-zink-800 dark:border-zink-600 dark:hover:border-green-500">
                                            <div class="flex flex-col items-center justify-center">
                                                <div
                                                    class="flex items-center justify-center w-12 h-12 mb-3 text-green-600 bg-green-100 rounded-full dark:bg-green-500/20 dark:text-green-300">
                                                    <i data-lucide="upload-cloud" class="size-5"></i>
                                                </div>

                                                <h6 class="mb-1 text-sm font-semibold text-slate-700 dark:text-white">
                                                    Drag and drop files here
                                                </h6>
                                                <p class="text-xs text-slate-500 dark:text-zink-300">
                                                    or click to browse multiple files
                                                </p>
                                            </div>

                                            <input id="psa_files" type="file" name="psa_files[]" multiple required
                                                class="hidden">
                                        </label>

                                        {{-- Selected Files Preview --}}
                                        <div id="psa-file-preview" class="hidden space-y-2">
                                            <h6
                                                class="text-xs font-semibold tracking-wide uppercase text-slate-500 dark:text-zink-300">
                                                Selected Files
                                            </h6>
                                            <div id="psa-file-list" class="space-y-2"></div>
                                        </div>

                                        {{-- Upload Button --}}
                                        <div class="flex justify-end">
                                            <button type="submit"
                                                class="inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold text-white rounded-xl bg-green-500 hover:bg-green-600 transition-all duration-200 shadow-sm hover:shadow-md focus:outline-none focus:ring-2 focus:ring-green-200">
                                                <i data-lucide="upload" class="size-4"></i>
                                                Upload PSA
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            @endif

                            {{-- Uploaded Files --}}
                            @if ($requirements->isNotEmpty())
                                <div class="space-y-3">
                                    <div class="flex items-center justify-between">
                                        <h6
                                            class="text-sm font-bold tracking-wide uppercase text-slate-600 dark:text-zink-200">
                                            Uploaded Files
                                        </h6>
                                    </div>

                                    @foreach ($requirements as $requirement)
                                        @php
                                            $psa_files = json_decode($requirement->psa, true);
                                        @endphp

                                        @if (!empty($psa_files))
                                            @foreach ($psa_files as $file)
                                                @php
                                                    $fileUrl = Storage::url(str_replace('doc/', 'psa/', $file));
                                                    $fileName = basename($file);
                                                    $extension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                                                    $isImage = in_array($extension, [
                                                        'jpg',
                                                        'jpeg',
                                                        'png',
                                                        'gif',
                                                        'webp',
                                                    ]);
                                                @endphp

                                                <div
                                                    class="p-4 bg-white border rounded-2xl border-slate-200 dark:bg-zink-800 dark:border-zink-600">
                                                    <div
                                                        class="flex flex-col gap-4 md:flex-row md:items-start md:justify-between">

                                                        {{-- Left Side --}}
                                                        <div class="flex items-start min-w-0 gap-3">
                                                            <div
                                                                class="flex items-center justify-center w-11 h-11 rounded-xl bg-slate-100 text-slate-600 dark:bg-zink-700 dark:text-zink-200 shrink-0">
                                                                @if ($isImage)
                                                                    <i data-lucide="image" class="size-5"></i>
                                                                @else
                                                                    <i data-lucide="file-text" class="size-5"></i>
                                                                @endif
                                                            </div>

                                                            <div class="min-w-0">
                                                                <h6
                                                                    class="text-sm font-semibold truncate text-slate-800 dark:text-white">
                                                                    {{ $fileName }}
                                                                </h6>
                                                                <p
                                                                    class="text-xs uppercase text-slate-500 dark:text-zink-300">
                                                                    PSA Document
                                                                </p>

                                                                <div class="flex flex-wrap items-center gap-2 mt-2">
                                                                    @if ($requirement->req_status == 0)
                                                                        <span
                                                                            class="inline-flex items-center gap-1 px-3 py-1 text-xs font-semibold text-yellow-700 bg-yellow-100 rounded-full dark:bg-yellow-500/20 dark:text-yellow-500">
                                                                            <i data-lucide="circle-dashed"
                                                                                class="size-3"></i>
                                                                            Pending for Submission
                                                                        </span>
                                                                    @else
                                                                        <span
                                                                            class="inline-flex items-center gap-1 px-3 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded-full dark:bg-green-500/20 dark:text-green-500">
                                                                            <i data-lucide="check-circle-2"
                                                                                class="size-3"></i>
                                                                            Submitted
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>

                                                        {{-- Right Side --}}
                                                        <div class="flex flex-wrap items-center gap-2">
                                                            <a href="{{ $fileUrl }}" target="_blank"
                                                                class="inline-flex items-center gap-1 px-3 py-2 text-xs font-semibold text-green-600 bg-green-100 rounded-lg dark:bg-green-500/20 dark:text-green-300 hover:bg-green-200 dark:hover:bg-green-500/30">
                                                                <i data-lucide="eye" class="size-3"></i>
                                                                View
                                                            </a>

                                                            <a href="{{ $fileUrl }}" download
                                                                class="inline-flex items-center gap-1 px-3 py-2 text-xs font-semibold rounded-lg text-sky-600 bg-sky-100 dark:bg-sky-500/20 dark:text-sky-300 hover:bg-sky-200 dark:hover:bg-sky-500/30">
                                                                <i data-lucide="download" class="size-3"></i>
                                                                Download
                                                            </a>

                                                            @if ($requirement->req_status == 0)
                                                                <form
                                                                    action="{{ route('student.applicant-requirements.delete', ['requirement' => $requirement->id, 'type' => 'psa']) }}"
                                                                    method="POST"
                                                                    onsubmit="return confirm('Delete this file?');">
                                                                    @csrf
                                                                    @method('DELETE')

                                                                    <button type="submit"
                                                                        class="inline-flex items-center gap-1 px-3 py-2 text-xs font-semibold text-red-600 bg-red-100 rounded-lg dark:bg-red-500/20 dark:text-red-300 hover:bg-red-200 dark:hover:bg-red-500/30">
                                                                        <i data-lucide="trash-2" class="size-3"></i>
                                                                        Delete
                                                                    </button>
                                                                </form>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    {{-- Optional Image Preview --}}
                                                    @if ($isImage)
                                                        <div
                                                            class="mt-4 overflow-hidden border rounded-xl border-slate-200 dark:border-zink-600">
                                                            <img src="{{ $fileUrl }}" alt="PSA Preview"
                                                                class="object-cover w-full max-h-64">
                                                        </div>
                                                    @endif
                                                </div>
                                            @endforeach
                                        @endif
                                    @endforeach
                                </div>
                            @endif
                        </div>

                        {{-- Script --}}
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const input = document.getElementById('psa_files');
                                const previewWrapper = document.getElementById('psa-file-preview');
                                const fileList = document.getElementById('psa-file-list');

                                if (input) {
                                    input.addEventListener('change', function() {
                                        fileList.innerHTML = '';

                                        if (this.files.length > 0) {
                                            previewWrapper.classList.remove('hidden');

                                            Array.from(this.files).forEach(file => {
                                                const item = document.createElement('div');
                                                item.className =
                                                    'flex items-center justify-between px-3 py-2 bg-white border rounded-xl border-slate-200 dark:bg-zink-800 dark:border-zink-600';

                                                item.innerHTML = `
                            <div class="flex items-center min-w-0 gap-2">
                                <div class="flex items-center justify-center w-8 h-8 rounded-lg bg-slate-100 text-slate-600 dark:bg-zink-700 dark:text-zink-200 shrink-0">
                                    <i data-lucide="file" class="size-4"></i>
                                </div>
                                <div class="min-w-0">
                                    <p class="text-sm font-medium truncate text-slate-700 dark:text-white">${file.name}</p>
                                    <p class="text-xs text-slate-500 dark:text-zink-300">${(file.size / 1024 / 1024).toFixed(2)} MB</p>
                                </div>
                            </div>
                        `;

                                                fileList.appendChild(item);
                                            });

                                            if (window.lucide) {
                                                lucide.createIcons();
                                            }
                                        } else {
                                            previewWrapper.classList.add('hidden');
                                        }
                                    });
                                }
                            });
                        </script>


                        {{-- GMC --}}

                        <div class="space-y-4">

                            {{-- Header --}}
                            <div class="mt-10">
                                <h6 class="text-base font-bold text-slate-800 dark:text-white">
                                    Certificate of Good Moral Character
                                    <span class="ml-1 text-xs font-semibold text-red-500 uppercase">Required</span>
                                </h6>
                                <p class="mt-1 text-sm text-slate-500 dark:text-zink-300">
                                    Upload a clear scanned copy of your Certificate of Good Moral Character.
                                </p>
                            </div>

                            {{-- Upload Form --}}
                            @if (optional($requirements->first())->req_status == 0)
                                <form action="{{ route('student.requirements.gmc.store') }}" method="POST"
                                    enctype="multipart/form-data"
                                    class="p-4 border rounded-2xl bg-slate-50/70 border-slate-200 dark:bg-zink-700/30 dark:border-zink-600">
                                    @csrf

                                    @error('gmc_files.*')
                                        <div class="mb-3 text-sm text-red-500">{{ $message }}</div>
                                    @enderror

                                    <div class="space-y-4">
                                        {{-- Drag and Drop Area --}}
                                        <label for="gmc_files"
                                            class="block p-6 text-center transition bg-white border-2 border-dashed cursor-pointer rounded-2xl border-slate-300 hover:border-green-400 hover:bg-slate-50 dark:bg-zink-800 dark:border-zink-600 dark:hover:border-green-500">
                                            <div class="flex flex-col items-center justify-center">
                                                <div
                                                    class="flex items-center justify-center w-12 h-12 mb-3 text-green-600 bg-green-100 rounded-full dark:bg-green-500/20 dark:text-green-300">
                                                    <i data-lucide="upload-cloud" class="size-5"></i>
                                                </div>

                                                <h6 class="mb-1 text-sm font-semibold text-slate-700 dark:text-white">
                                                    Drag and drop files here
                                                </h6>
                                                <p class="text-xs text-slate-500 dark:text-zink-300">
                                                    or click to browse multiple files
                                                </p>
                                            </div>

                                            <input id="gmc_files" type="file" name="gmc_files[]" multiple required
                                                class="hidden">
                                        </label>

                                        {{-- Selected Files Preview --}}
                                        <div id="gmc-file-preview" class="hidden space-y-2">
                                            <h6
                                                class="text-xs font-semibold tracking-wide uppercase text-slate-500 dark:text-zink-300">
                                                Selected Files
                                            </h6>
                                            <div id="gmc-file-list" class="space-y-2"></div>
                                        </div>

                                        {{-- Upload Button --}}
                                        <div class="flex justify-end">
                                            <button type="submit" id="uploadButton"
                                                class="inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold text-white rounded-xl bg-green-500 hover:bg-green-600 transition-all duration-200 shadow-sm hover:shadow-md focus:outline-none focus:ring-2 focus:ring-green-200">
                                                <i data-lucide="upload" class="size-4"></i>
                                                Upload GMC
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            @endif

                            {{-- Uploaded Files --}}
                            @if ($requirements->isNotEmpty())
                                <div class="space-y-3">
                                    <div class="flex items-center justify-between">
                                        <h6
                                            class="text-sm font-bold tracking-wide uppercase text-slate-600 dark:text-zink-200">
                                            Uploaded Files
                                        </h6>
                                    </div>

                                    @foreach ($requirements as $requirement)
                                        @php
                                            $gmc_files = json_decode($requirement->good_moral_char, true);
                                        @endphp

                                        @if (!empty($gmc_files))
                                            @foreach ($gmc_files as $file)
                                                @php
                                                    $fileUrl = Storage::url(str_replace('doc/', 'gmc/', $file));
                                                    $fileName = basename($file);
                                                    $extension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                                                    $isImage = in_array($extension, [
                                                        'jpg',
                                                        'jpeg',
                                                        'png',
                                                        'gif',
                                                        'webp',
                                                    ]);
                                                @endphp

                                                <div
                                                    class="p-4 bg-white border rounded-2xl border-slate-200 dark:bg-zink-800 dark:border-zink-600">
                                                    <div
                                                        class="flex flex-col gap-4 md:flex-row md:items-start md:justify-between">

                                                        {{-- Left Side --}}
                                                        <div class="flex items-start min-w-0 gap-3">
                                                            <div
                                                                class="flex items-center justify-center w-11 h-11 rounded-xl bg-slate-100 text-slate-600 dark:bg-zink-700 dark:text-zink-200 shrink-0">
                                                                @if ($isImage)
                                                                    <i data-lucide="image" class="size-5"></i>
                                                                @else
                                                                    <i data-lucide="file-text" class="size-5"></i>
                                                                @endif
                                                            </div>

                                                            <div class="min-w-0">
                                                                <h6
                                                                    class="text-sm font-semibold truncate text-slate-800 dark:text-white">
                                                                    {{ $fileName }}
                                                                </h6>
                                                                <p
                                                                    class="text-xs uppercase text-slate-500 dark:text-zink-300">
                                                                    Good Moral Certificate
                                                                </p>

                                                                <div class="flex flex-wrap items-center gap-2 mt-2">
                                                                    @if ($requirement->req_status == 0)
                                                                        <span
                                                                            class="inline-flex items-center gap-1 px-3 py-1 text-xs font-semibold text-yellow-700 bg-yellow-100 rounded-full dark:bg-yellow-500/20 dark:text-yellow-500">
                                                                            <i data-lucide="circle-dashed"
                                                                                class="size-3"></i>
                                                                            Pending for Submission
                                                                        </span>
                                                                    @else
                                                                        <span
                                                                            class="inline-flex items-center gap-1 px-3 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded-full dark:bg-green-500/20 dark:text-green-500">
                                                                            <i data-lucide="check-circle-2"
                                                                                class="size-3"></i>
                                                                            Submitted
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>

                                                        {{-- Right Side --}}
                                                        <div class="flex flex-wrap items-center gap-2">
                                                            <a href="{{ $fileUrl }}" target="_blank"
                                                                class="inline-flex items-center gap-1 px-3 py-2 text-xs font-semibold text-green-600 bg-green-100 rounded-lg dark:bg-green-500/20 dark:text-green-300 hover:bg-green-200 dark:hover:bg-green-500/30">
                                                                <i data-lucide="eye" class="size-3"></i>
                                                                View
                                                            </a>

                                                            <a href="{{ $fileUrl }}" download
                                                                class="inline-flex items-center gap-1 px-3 py-2 text-xs font-semibold rounded-lg text-sky-600 bg-sky-100 dark:bg-sky-500/20 dark:text-sky-300 hover:bg-sky-200 dark:hover:bg-sky-500/30">
                                                                <i data-lucide="download" class="size-3"></i>
                                                                Download
                                                            </a>

                                                            @if ($requirement->req_status == 0)
                                                                <form
                                                                    action="{{ route('student.applicant-requirements.delete', ['requirement' => $requirement->id, 'type' => 'gmc']) }}"
                                                                    method="POST"
                                                                    onsubmit="return confirm('Delete this file?');">
                                                                    @csrf
                                                                    @method('DELETE')

                                                                    <button type="submit"
                                                                        class="inline-flex items-center gap-1 px-3 py-2 text-xs font-semibold text-red-600 bg-red-100 rounded-lg dark:bg-red-500/20 dark:text-red-300 hover:bg-red-200 dark:hover:bg-red-500/30">
                                                                        <i data-lucide="trash-2" class="size-3"></i>
                                                                        Delete
                                                                    </button>
                                                                </form>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    {{-- Optional Image Preview --}}
                                                    @if ($isImage)
                                                        <div
                                                            class="mt-4 overflow-hidden border rounded-xl border-slate-200 dark:border-zink-600">
                                                            <img src="{{ $fileUrl }}" alt="GMC Preview"
                                                                class="object-cover w-full max-h-64">
                                                        </div>
                                                    @endif
                                                </div>
                                            @endforeach
                                        @endif
                                    @endforeach
                                </div>
                            @endif
                        </div>

                        {{-- Script --}}
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const input = document.getElementById('gmc_files');
                                const previewWrapper = document.getElementById('gmc-file-preview');
                                const fileList = document.getElementById('gmc-file-list');

                                if (input) {
                                    input.addEventListener('change', function() {
                                        fileList.innerHTML = '';

                                        if (this.files.length > 0) {
                                            previewWrapper.classList.remove('hidden');

                                            Array.from(this.files).forEach(file => {
                                                const item = document.createElement('div');
                                                item.className =
                                                    'flex items-center justify-between px-3 py-2 bg-white border rounded-xl border-slate-200 dark:bg-zink-800 dark:border-zink-600';

                                                item.innerHTML = `
                            <div class="flex items-center min-w-0 gap-2">
                                <div class="flex items-center justify-center w-8 h-8 rounded-lg bg-slate-100 text-slate-600 dark:bg-zink-700 dark:text-zink-200 shrink-0">
                                    <i data-lucide="file" class="size-4"></i>
                                </div>
                                <div class="min-w-0">
                                    <p class="text-sm font-medium truncate text-slate-700 dark:text-white">${file.name}</p>
                                    <p class="text-xs text-slate-500 dark:text-zink-300">${(file.size / 1024 / 1024).toFixed(2)} MB</p>
                                </div>
                            </div>
                        `;

                                                fileList.appendChild(item);
                                            });

                                            if (window.lucide) {
                                                lucide.createIcons();
                                            }
                                        } else {
                                            previewWrapper.classList.add('hidden');
                                        }
                                    });
                                }
                            });
                        </script>
                        {{-- end GMC --}}

                        @if ($applicant->student_type == 1)
                            {{-- SHS Card --}}
                            <div class="space-y-4">

                                {{-- Header --}}
                                <div class="mt-10">
                                    <h6 class="text-base font-bold text-slate-800 dark:text-white">
                                        Senior High School Card
                                        <span class="ml-1 text-xs font-semibold text-red-500 uppercase">Required</span>
                                    </h6>
                                    <p class="mt-1 text-sm text-slate-500 dark:text-zink-300">
                                        Upload a clear scanned copy of your Senior High School Card.
                                    </p>
                                </div>

                                {{-- Upload Form --}}
                                @if (optional($requirements->first())->req_status == 0)
                                    <form action="{{ route('student.requirements.card.store') }}" method="POST"
                                        enctype="multipart/form-data"
                                        class="p-4 border rounded-2xl bg-slate-50/70 border-slate-200 dark:bg-zink-700/30 dark:border-zink-600">
                                        @csrf

                                        @error('shs_files.*')
                                            <div class="mb-3 text-sm text-red-500">{{ $message }}</div>
                                        @enderror

                                        <div class="space-y-4">
                                            {{-- Drag and Drop Area --}}
                                            <label for="shs_files"
                                                class="block p-6 text-center transition bg-white border-2 border-dashed cursor-pointer rounded-2xl border-slate-300 hover:border-green-400 hover:bg-slate-50 dark:bg-zink-800 dark:border-zink-600 dark:hover:border-green-500">
                                                <div class="flex flex-col items-center justify-center">
                                                    <div
                                                        class="flex items-center justify-center w-12 h-12 mb-3 text-green-600 bg-green-100 rounded-full dark:bg-green-500/20 dark:text-green-300">
                                                        <i data-lucide="upload-cloud" class="size-5"></i>
                                                    </div>

                                                    <h6 class="mb-1 text-sm font-semibold text-slate-700 dark:text-white">
                                                        Drag and drop files here
                                                    </h6>
                                                    <p class="text-xs text-slate-500 dark:text-zink-300">
                                                        or click to browse multiple files
                                                    </p>
                                                </div>

                                                <input id="shs_files" type="file" name="shs_files[]" multiple required
                                                    class="hidden">
                                            </label>

                                            {{-- Selected Files Preview --}}
                                            <div id="shs-file-preview" class="hidden space-y-2">
                                                <h6
                                                    class="text-xs font-semibold tracking-wide uppercase text-slate-500 dark:text-zink-300">
                                                    Selected Files
                                                </h6>
                                                <div id="shs-file-list" class="space-y-2"></div>
                                            </div>

                                            {{-- Upload Button --}}
                                            <div class="flex justify-end">
                                                <button type="submit" id="uploadButton"
                                                    class="inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold text-white rounded-xl bg-green-500 hover:bg-green-600 transition-all duration-200 shadow-sm hover:shadow-md focus:outline-none focus:ring-2 focus:ring-green-200">
                                                    <i data-lucide="upload" class="size-4"></i>
                                                    Upload Card
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                @endif

                                {{-- Uploaded Files --}}
                                @if ($requirements->isNotEmpty())
                                    <div class="space-y-3">
                                        <div class="flex items-center justify-between">
                                            <h6
                                                class="text-sm font-bold tracking-wide uppercase text-slate-600 dark:text-zink-200">
                                                Uploaded Files
                                            </h6>
                                        </div>

                                        @foreach ($requirements as $requirement)
                                            @php
                                                $shs_files = json_decode($requirement->shs_card, true);
                                            @endphp

                                            @if (!empty($shs_files))
                                                @foreach ($shs_files as $file)
                                                    @php
                                                        $fileUrl = Storage::url(str_replace('doc/', 'card/', $file));
                                                        $fileName = basename($file);
                                                        $extension = strtolower(
                                                            pathinfo($fileName, PATHINFO_EXTENSION),
                                                        );
                                                        $isImage = in_array($extension, [
                                                            'jpg',
                                                            'jpeg',
                                                            'png',
                                                            'gif',
                                                            'webp',
                                                        ]);
                                                    @endphp

                                                    <div
                                                        class="p-4 bg-white border rounded-2xl border-slate-200 dark:bg-zink-800 dark:border-zink-600">
                                                        <div
                                                            class="flex flex-col gap-4 md:flex-row md:items-start md:justify-between">

                                                            {{-- Left Side --}}
                                                            <div class="flex items-start min-w-0 gap-3">
                                                                <div
                                                                    class="flex items-center justify-center w-11 h-11 rounded-xl bg-slate-100 text-slate-600 dark:bg-zink-700 dark:text-zink-200 shrink-0">
                                                                    @if ($isImage)
                                                                        <i data-lucide="image" class="size-5"></i>
                                                                    @else
                                                                        <i data-lucide="file-text" class="size-5"></i>
                                                                    @endif
                                                                </div>

                                                                <div class="min-w-0">
                                                                    <h6
                                                                        class="text-sm font-semibold truncate text-slate-800 dark:text-white">
                                                                        {{ $fileName }}
                                                                    </h6>
                                                                    <p
                                                                        class="text-xs uppercase text-slate-500 dark:text-zink-300">
                                                                        Senior High School Card
                                                                    </p>

                                                                    <div class="flex flex-wrap items-center gap-2 mt-2">
                                                                        @if ($requirement->req_status == 0)
                                                                            <span
                                                                                class="inline-flex items-center gap-1 px-3 py-1 text-xs font-semibold text-yellow-700 bg-yellow-100 rounded-full dark:bg-yellow-500/20 dark:text-yellow-500">
                                                                                <i data-lucide="circle-dashed"
                                                                                    class="size-3"></i>
                                                                                Pending for Submission
                                                                            </span>
                                                                        @else
                                                                            <span
                                                                                class="inline-flex items-center gap-1 px-3 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded-full dark:bg-green-500/20 dark:text-green-500">
                                                                                <i data-lucide="check-circle-2"
                                                                                    class="size-3"></i>
                                                                                Submitted
                                                                            </span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            {{-- Right Side --}}
                                                            <div class="flex flex-wrap items-center gap-2">
                                                                <a href="{{ $fileUrl }}" target="_blank"
                                                                    class="inline-flex items-center gap-1 px-3 py-2 text-xs font-semibold text-green-600 bg-green-100 rounded-lg dark:bg-green-500/20 dark:text-green-300 hover:bg-green-200 dark:hover:bg-green-500/30">
                                                                    <i data-lucide="eye" class="size-3"></i>
                                                                    View
                                                                </a>

                                                                <a href="{{ $fileUrl }}" download
                                                                    class="inline-flex items-center gap-1 px-3 py-2 text-xs font-semibold rounded-lg text-sky-600 bg-sky-100 dark:bg-sky-500/20 dark:text-sky-300 hover:bg-sky-200 dark:hover:bg-sky-500/30">
                                                                    <i data-lucide="download" class="size-3"></i>
                                                                    Download
                                                                </a>

                                                                @if ($requirement->req_status == 0)
                                                                    <form
                                                                        action="{{ route('student.applicant-requirements.delete', ['requirement' => $requirement->id, 'type' => 'card']) }}"
                                                                        method="POST"
                                                                        onsubmit="return confirm('Delete this file?');">
                                                                        @csrf
                                                                        @method('DELETE')

                                                                        <button type="submit"
                                                                            class="inline-flex items-center gap-1 px-3 py-2 text-xs font-semibold text-red-600 bg-red-100 rounded-lg dark:bg-red-500/20 dark:text-red-300 hover:bg-red-200 dark:hover:bg-red-500/30">
                                                                            <i data-lucide="trash-2" class="size-3"></i>
                                                                            Delete
                                                                        </button>
                                                                    </form>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        {{-- Optional Image Preview --}}
                                                        @if ($isImage)
                                                            <div
                                                                class="mt-4 overflow-hidden border rounded-xl border-slate-200 dark:border-zink-600">
                                                                <img src="{{ $fileUrl }}" alt="SHS Card Preview"
                                                                    class="object-cover w-full max-h-64">
                                                            </div>
                                                        @endif
                                                    </div>
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </div>
                                @endif
                            </div>

                            {{-- Script --}}
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    const input = document.getElementById('shs_files');
                                    const previewWrapper = document.getElementById('shs-file-preview');
                                    const fileList = document.getElementById('shs-file-list');

                                    if (input) {
                                        input.addEventListener('change', function() {
                                            fileList.innerHTML = '';

                                            if (this.files.length > 0) {
                                                previewWrapper.classList.remove('hidden');

                                                Array.from(this.files).forEach(file => {
                                                    const item = document.createElement('div');
                                                    item.className =
                                                        'flex items-center justify-between px-3 py-2 bg-white border rounded-xl border-slate-200 dark:bg-zink-800 dark:border-zink-600';

                                                    item.innerHTML = `
                            <div class="flex items-center min-w-0 gap-2">
                                <div class="flex items-center justify-center w-8 h-8 rounded-lg bg-slate-100 text-slate-600 dark:bg-zink-700 dark:text-zink-200 shrink-0">
                                    <i data-lucide="file" class="size-4"></i>
                                </div>
                                <div class="min-w-0">
                                    <p class="text-sm font-medium truncate text-slate-700 dark:text-white">${file.name}</p>
                                    <p class="text-xs text-slate-500 dark:text-zink-300">${(file.size / 1024 / 1024).toFixed(2)} MB</p>
                                </div>
                            </div>
                        `;

                                                    fileList.appendChild(item);
                                                });

                                                if (window.lucide) {
                                                    lucide.createIcons();
                                                }
                                            } else {
                                                previewWrapper.classList.add('hidden');
                                            }
                                        });
                                    }
                                });
                            </script>
                            {{-- END SHS CARD --}}

                            {{-- Start Enrollment Certification --}}
                            {{-- <h6 class="mt-10 text-15">Enrollment Certification (On-going Grade 12) <sup
                                class="text-green-500">*
                                optional</sup></h6> --}}

                            {{-- show if the re_sttuss i not published --}}
                            {{-- @if (optional($requirements->first())->req_status == 0)
                            <form action="{{ route('student.requirements.certification.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                @error('enrollment_certification.*')
                                    <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                                @enderror

                                <div class="grid items-center grid-cols-1 gap-2 xl:grid-cols-4">

                                    <input type="file" name="enrollment_certification[]" multiple="multiple"
                                        required
                                        class="mb-2 cursor-pointer form-file border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500">

                                    <button type="submit" id="uploadButton"
                                        class="text-white bg-green-500 border-green-500 btn hover:text-white hover:bg-green-600 hover:border-green-600 focus:text-white focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-100 active:text-white active:bg-green-600 active:border-green-600 active:ring active:ring-green-100 dark:ring-green-400/10">
                                        <i data-lucide="upload" class="inline-block size-4 dark:text-zink-200"></i>
                                        Upload Enrollment Certification</button>
                                </div>
                            </form>
                        @endif

                        @if ($requirements->isNotEmpty())
                            <div class="w-full overflow-x-auto">
                                <table class="w-full mt-4 border-separate table-custom border-spacing-y-1 min-w-max">
                                    <thead>
                                        <tr
                                            class="relative rounded-md bg-slate-50 after:absolute after:border-l-2 after:left-0 after:top-0 after:bottom-0 after:border-transparent dark:bg-zink-600 [&.active]:after:border-custom-500">
                                            <th
                                                class="px-3.5 py-2.5 font-semibold ltr:text-left rtl:text-right whitespace-nowrap">
                                                Details</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($requirements as $requirement)
                                            @php
                                                $enrollment_certification_files = json_decode(
                                                    $requirement->enrolment_certification,
                                                    true,
                                                );
                                            @endphp

                                            @if (!empty($enrollment_certification_files))
                                                @foreach ($enrollment_certification_files as $file)
                                                    <tr
                                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                                        <td class="px-4 py-2 whitespace-nowrap">
                                                            @if ($requirement->req_status == 0)
                                                                <form
                                                                    action="{{ route('student.applicant-requirements.delete', ['requirement' => $requirement->id, 'type' => 'certification']) }}"
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
                                                                <a class="inline-flex items-center px-4 py-2 text-xs font-medium text-green-500 bg-green-100 border border-transparent rounded dark:bg-green-500/20 dark:border-transparent"
                                                                    href="{{ Storage::url(str_replace('doc/', 'certification/', $file)) }}"
                                                                    target="_blank">
                                                                    View
                                                                </a>
                                                                <a class="inline-flex items-center px-4 py-2 text-xs font-medium text-left text-yellow-500 bg-yellow-100 border border-transparent rounded dark:bg-yellow-500/20 dark:border-transparent"
                                                                    href="#"><i data-lucide="circle-dashed"
                                                                        class="size-3 ltr:mr-1 rtl:ml-1"></i>
                                                                    Pending</a>
                                                            @else
                                                                <a class="inline-flex items-center px-4 py-2 text-xs font-medium text-green-500 bg-green-100 border border-transparent rounded dark:bg-green-500/20 dark:border-transparent"
                                                                    href="{{ Storage::url(str_replace('doc/', 'certification/', $file)) }}"
                                                                    target="_blank">
                                                                    View
                                                                </a>
                                                                <a class="inline-flex items-center px-4 py-2 text-xs font-medium text-left text-green-500 bg-green-100 border border-transparent rounded dark:bg-green-500/20 dark:border-transparent"
                                                                    href="#"><i data-lucide="check-circle-2"
                                                                        class="size-3 ltr:mr-1 rtl:ml-1"></i>
                                                                    Submitted</a>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif --}}
                            {{-- End Enrollment Certification --}}

                        @endif


                        @if ($applicant->student_type != 1)
                            {{-- start Horable dismissal --}}
                            <div class="space-y-4">

                                {{-- Header --}}
                                <div class="mt-10">
                                    <h6 class="text-base font-bold text-slate-800 dark:text-white">
                                        Honorable Dismissal (Transferee)
                                        <span class="ml-1 text-xs font-semibold text-red-500 uppercase">Required</span>
                                    </h6>
                                    <p class="mt-1 text-sm text-slate-500 dark:text-zink-300">
                                        Upload a clear scanned copy of your Honorable Dismissal document.
                                    </p>
                                </div>

                                {{-- Upload Form --}}
                                @if (optional($requirements->first())->req_status == 0)
                                    <form action="{{ route('student.requirements.honorable-dismissal.store') }}"
                                        method="POST" enctype="multipart/form-data"
                                        class="p-4 border rounded-2xl bg-slate-50/70 border-slate-200 dark:bg-zink-700/30 dark:border-zink-600">
                                        @csrf

                                        @error('honorable_dismisal_files.*')
                                            <div class="mb-3 text-sm text-red-500">{{ $message }}</div>
                                        @enderror

                                        <div class="space-y-4">
                                            {{-- Drag and Drop Area --}}
                                            <label for="honorable_dismisal_files"
                                                class="block p-6 text-center transition bg-white border-2 border-dashed cursor-pointer rounded-2xl border-slate-300 hover:border-green-400 hover:bg-slate-50 dark:bg-zink-800 dark:border-zink-600 dark:hover:border-green-500">
                                                <div class="flex flex-col items-center justify-center">
                                                    <div
                                                        class="flex items-center justify-center w-12 h-12 mb-3 text-green-600 bg-green-100 rounded-full dark:bg-green-500/20 dark:text-green-300">
                                                        <i data-lucide="upload-cloud" class="size-5"></i>
                                                    </div>

                                                    <h6 class="mb-1 text-sm font-semibold text-slate-700 dark:text-white">
                                                        Drag and drop files here
                                                    </h6>
                                                    <p class="text-xs text-slate-500 dark:text-zink-300">
                                                        or click to browse multiple files
                                                    </p>
                                                </div>

                                                <input id="honorable_dismisal_files" type="file"
                                                    name="honorable_dismisal_files[]" multiple class="hidden">
                                            </label>

                                            {{-- Selected Files Preview --}}
                                            <div id="honorable-file-preview" class="hidden space-y-2">
                                                <h6
                                                    class="text-xs font-semibold tracking-wide uppercase text-slate-500 dark:text-zink-300">
                                                    Selected Files
                                                </h6>
                                                <div id="honorable-file-list" class="space-y-2"></div>
                                            </div>

                                            {{-- Upload Button --}}
                                            <div class="flex justify-end">
                                                <button type="submit" id="uploadButton"
                                                    class="inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold text-white rounded-xl bg-green-500 hover:bg-green-600 transition-all duration-200 shadow-sm hover:shadow-md focus:outline-none focus:ring-2 focus:ring-green-200">
                                                    <i data-lucide="upload" class="size-4"></i>
                                                    Upload Honorable Dismissal
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                @endif

                                {{-- Uploaded Files --}}
                                @if ($requirements->isNotEmpty())
                                    <div class="space-y-3">
                                        <div class="flex items-center justify-between">
                                            <h6
                                                class="text-sm font-bold tracking-wide uppercase text-slate-600 dark:text-zink-200">
                                                Uploaded Files
                                            </h6>
                                        </div>

                                        @foreach ($requirements as $requirement)
                                            @php
                                                $honorable_dismisal_files = json_decode(
                                                    $requirement->honorable_dismisal,
                                                    true,
                                                );
                                            @endphp

                                            @if (!empty($honorable_dismisal_files))
                                                @foreach ($honorable_dismisal_files as $file)
                                                    @php
                                                        $fileUrl = Storage::url(
                                                            str_replace('doc/', 'honorable_dismisal/', $file),
                                                        );
                                                        $fileName = basename($file);
                                                        $extension = strtolower(
                                                            pathinfo($fileName, PATHINFO_EXTENSION),
                                                        );
                                                        $isImage = in_array($extension, [
                                                            'jpg',
                                                            'jpeg',
                                                            'png',
                                                            'gif',
                                                            'webp',
                                                        ]);
                                                    @endphp

                                                    <div
                                                        class="p-4 bg-white border rounded-2xl border-slate-200 dark:bg-zink-800 dark:border-zink-600">
                                                        <div
                                                            class="flex flex-col gap-4 md:flex-row md:items-start md:justify-between">

                                                            {{-- Left Side --}}
                                                            <div class="flex items-start min-w-0 gap-3">
                                                                <div
                                                                    class="flex items-center justify-center w-11 h-11 rounded-xl bg-slate-100 text-slate-600 dark:bg-zink-700 dark:text-zink-200 shrink-0">
                                                                    @if ($isImage)
                                                                        <i data-lucide="image" class="size-5"></i>
                                                                    @else
                                                                        <i data-lucide="file-text" class="size-5"></i>
                                                                    @endif
                                                                </div>

                                                                <div class="min-w-0">
                                                                    <h6
                                                                        class="text-sm font-semibold truncate text-slate-800 dark:text-white">
                                                                        {{ $fileName }}
                                                                    </h6>
                                                                    <p
                                                                        class="text-xs uppercase text-slate-500 dark:text-zink-300">
                                                                        Honorable Dismissal
                                                                    </p>

                                                                    <div class="flex flex-wrap items-center gap-2 mt-2">
                                                                        @if ($requirement->req_status == 0)
                                                                            <span
                                                                                class="inline-flex items-center gap-1 px-3 py-1 text-xs font-semibold text-yellow-700 bg-yellow-100 rounded-full dark:bg-yellow-500/20 dark:text-yellow-500">
                                                                                <i data-lucide="circle-dashed"
                                                                                    class="size-3"></i>
                                                                                Pending for Submission
                                                                            </span>
                                                                        @else
                                                                            <span
                                                                                class="inline-flex items-center gap-1 px-3 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded-full dark:bg-green-500/20 dark:text-green-500">
                                                                                <i data-lucide="check-circle-2"
                                                                                    class="size-3"></i>
                                                                                Submitted
                                                                            </span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            {{-- Right Side --}}
                                                            <div class="flex flex-wrap items-center gap-2">
                                                                <a href="{{ $fileUrl }}" target="_blank"
                                                                    class="inline-flex items-center gap-1 px-3 py-2 text-xs font-semibold text-green-600 bg-green-100 rounded-lg dark:bg-green-500/20 dark:text-green-300 hover:bg-green-200 dark:hover:bg-green-500/30">
                                                                    <i data-lucide="eye" class="size-3"></i>
                                                                    View
                                                                </a>

                                                                <a href="{{ $fileUrl }}" download
                                                                    class="inline-flex items-center gap-1 px-3 py-2 text-xs font-semibold rounded-lg text-sky-600 bg-sky-100 dark:bg-sky-500/20 dark:text-sky-300 hover:bg-sky-200 dark:hover:bg-sky-500/30">
                                                                    <i data-lucide="download" class="size-3"></i>
                                                                    Download
                                                                </a>

                                                                @if ($requirement->req_status == 0)
                                                                    <form
                                                                        action="{{ route('student.applicant-requirements.delete', ['requirement' => $requirement->id, 'type' => 'honorable-dismissal']) }}"
                                                                        method="POST"
                                                                        onsubmit="return confirm('Delete this file?');">
                                                                        @csrf
                                                                        @method('DELETE')

                                                                        <button type="submit"
                                                                            class="inline-flex items-center gap-1 px-3 py-2 text-xs font-semibold text-red-600 bg-red-100 rounded-lg dark:bg-red-500/20 dark:text-red-300 hover:bg-red-200 dark:hover:bg-red-500/30">
                                                                            <i data-lucide="trash-2" class="size-3"></i>
                                                                            Delete
                                                                        </button>
                                                                    </form>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        {{-- Optional Image Preview --}}
                                                        @if ($isImage)
                                                            <div
                                                                class="mt-4 overflow-hidden border rounded-xl border-slate-200 dark:border-zink-600">
                                                                <img src="{{ $fileUrl }}"
                                                                    alt="Honorable Dismissal Preview"
                                                                    class="object-cover w-full max-h-64">
                                                            </div>
                                                        @endif
                                                    </div>
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </div>
                                @endif
                            </div>

                            {{-- Script --}}
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    const input = document.getElementById('honorable_dismisal_files');
                                    const previewWrapper = document.getElementById('honorable-file-preview');
                                    const fileList = document.getElementById('honorable-file-list');

                                    if (input) {
                                        input.addEventListener('change', function() {
                                            fileList.innerHTML = '';

                                            if (this.files.length > 0) {
                                                previewWrapper.classList.remove('hidden');

                                                Array.from(this.files).forEach(file => {
                                                    const item = document.createElement('div');
                                                    item.className =
                                                        'flex items-center justify-between px-3 py-2 bg-white border rounded-xl border-slate-200 dark:bg-zink-800 dark:border-zink-600';

                                                    item.innerHTML = `
                            <div class="flex items-center min-w-0 gap-2">
                                <div class="flex items-center justify-center w-8 h-8 rounded-lg bg-slate-100 text-slate-600 dark:bg-zink-700 dark:text-zink-200 shrink-0">
                                    <i data-lucide="file" class="size-4"></i>
                                </div>
                                <div class="min-w-0">
                                    <p class="text-sm font-medium truncate text-slate-700 dark:text-white">${file.name}</p>
                                    <p class="text-xs text-slate-500 dark:text-zink-300">${(file.size / 1024 / 1024).toFixed(2)} MB</p>
                                </div>
                            </div>
                        `;

                                                    fileList.appendChild(item);
                                                });

                                                if (window.lucide) {
                                                    lucide.createIcons();
                                                }
                                            } else {
                                                previewWrapper.classList.add('hidden');
                                            }
                                        });
                                    }
                                });
                            </script>
                            {{-- end Honorable dismissal --}}

                            {{-- start TOR --}}

                            <div class="space-y-4">

                                {{-- Header --}}
                                <div class="mt-10">
                                    <h6 class="text-base font-bold text-slate-800 dark:text-white">
                                        Transcript of Records (TOR - Transferee)
                                        <span class="ml-1 text-xs font-semibold text-red-500 uppercase">Required</span>
                                    </h6>
                                    <p class="mt-1 text-sm text-slate-500 dark:text-zink-300">
                                        Upload a clear scanned copy of your Transcript of Records.
                                    </p>
                                </div>

                                {{-- Upload Form --}}
                                @if (optional($requirements->first())->req_status == 0)
                                    <form action="{{ route('student.requirements.tor.store') }}" method="POST"
                                        enctype="multipart/form-data"
                                        class="p-4 border rounded-2xl bg-slate-50/70 border-slate-200 dark:bg-zink-700/30 dark:border-zink-600">
                                        @csrf

                                        @error('tor_files.*')
                                            <div class="mb-3 text-sm text-red-500">{{ $message }}</div>
                                        @enderror

                                        <div class="space-y-4">

                                            {{-- Drag & Drop --}}
                                            <label for="tor_files"
                                                class="block p-6 text-center transition bg-white border-2 border-dashed cursor-pointer rounded-2xl border-slate-300 hover:border-green-400 hover:bg-slate-50 dark:bg-zink-800 dark:border-zink-600 dark:hover:border-green-500">
                                                <div class="flex flex-col items-center justify-center">
                                                    <div
                                                        class="flex items-center justify-center w-12 h-12 mb-3 text-green-600 bg-green-100 rounded-full dark:bg-green-500/20 dark:text-green-300">
                                                        <i data-lucide="upload-cloud" class="size-5"></i>
                                                    </div>

                                                    <h6 class="mb-1 text-sm font-semibold text-slate-700 dark:text-white">
                                                        Drag and drop files here
                                                    </h6>
                                                    <p class="text-xs text-slate-500 dark:text-zink-300">
                                                        or click to browse multiple files
                                                    </p>
                                                </div>

                                                <input id="tor_files" type="file" name="tor_files[]" multiple
                                                    class="hidden">
                                            </label>

                                            {{-- Preview --}}
                                            <div id="tor-file-preview" class="hidden space-y-2">
                                                <h6
                                                    class="text-xs font-semibold tracking-wide uppercase text-slate-500 dark:text-zink-300">
                                                    Selected Files
                                                </h6>
                                                <div id="tor-file-list" class="space-y-2"></div>
                                            </div>

                                            {{-- Upload Button --}}
                                            <div class="flex justify-end">
                                                <button type="submit"
                                                    class="inline-flex items-center gap-2 px-4 py-2.5 text-sm font-semibold text-white rounded-xl bg-green-500 hover:bg-green-600 transition-all duration-200 shadow-sm hover:shadow-md focus:outline-none focus:ring-2 focus:ring-green-200">
                                                    <i data-lucide="upload" class="size-4"></i>
                                                    Upload TOR
                                                </button>
                                            </div>

                                        </div>
                                    </form>
                                @endif

                                {{-- Uploaded Files --}}
                                @if ($requirements->isNotEmpty())
                                    <div class="space-y-3">
                                        <div class="flex items-center justify-between">
                                            <h6
                                                class="text-sm font-bold tracking-wide uppercase text-slate-600 dark:text-zink-200">
                                                Uploaded Files
                                            </h6>
                                        </div>

                                        @foreach ($requirements as $requirement)
                                            @php
                                                $tor_files = json_decode($requirement->tor, true);
                                            @endphp

                                            @if (!empty($tor_files))
                                                @foreach ($tor_files as $file)
                                                    @php
                                                        $fileUrl = Storage::url(str_replace('doc/', 'tor/', $file));
                                                        $fileName = basename($file);
                                                        $extension = strtolower(
                                                            pathinfo($fileName, PATHINFO_EXTENSION),
                                                        );
                                                        $isImage = in_array($extension, [
                                                            'jpg',
                                                            'jpeg',
                                                            'png',
                                                            'gif',
                                                            'webp',
                                                        ]);
                                                    @endphp

                                                    <div
                                                        class="p-4 bg-white border rounded-2xl border-slate-200 dark:bg-zink-800 dark:border-zink-600">
                                                        <div
                                                            class="flex flex-col gap-4 md:flex-row md:items-start md:justify-between">

                                                            {{-- Left Side --}}
                                                            <div class="flex items-start min-w-0 gap-3">
                                                                <div
                                                                    class="flex items-center justify-center w-11 h-11 rounded-xl bg-slate-100 text-slate-600 dark:bg-zink-700 dark:text-zink-200 shrink-0">
                                                                    @if ($isImage)
                                                                        <i data-lucide="image" class="size-5"></i>
                                                                    @else
                                                                        <i data-lucide="file-text" class="size-5"></i>
                                                                    @endif
                                                                </div>

                                                                <div class="min-w-0">
                                                                    <h6
                                                                        class="text-sm font-semibold truncate text-slate-800 dark:text-white">
                                                                        {{ $fileName }}
                                                                    </h6>
                                                                    <p
                                                                        class="text-xs uppercase text-slate-500 dark:text-zink-300">
                                                                        Transcript of Records
                                                                    </p>

                                                                    <div class="flex flex-wrap items-center gap-2 mt-2">
                                                                        @if ($requirement->req_status == 0)
                                                                            <span
                                                                                class="inline-flex items-center gap-1 px-3 py-1 text-xs font-semibold text-yellow-700 bg-yellow-100 rounded-full dark:bg-yellow-500/20 dark:text-yellow-500">
                                                                                <i data-lucide="circle-dashed"
                                                                                    class="size-3"></i>
                                                                                Pending for Submission
                                                                            </span>
                                                                        @else
                                                                            <span
                                                                                class="inline-flex items-center gap-1 px-3 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded-full dark:bg-green-500/20 dark:text-green-500">
                                                                                <i data-lucide="check-circle-2"
                                                                                    class="size-3"></i>
                                                                                Submitted
                                                                            </span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            {{-- Right Side --}}
                                                            <div class="flex flex-wrap items-center gap-2">
                                                                <a href="{{ $fileUrl }}" target="_blank"
                                                                    class="inline-flex items-center gap-1 px-3 py-2 text-xs font-semibold text-green-600 bg-green-100 rounded-lg dark:bg-green-500/20 dark:text-green-300 hover:bg-green-200 dark:hover:bg-green-500/30">
                                                                    <i data-lucide="eye" class="size-3"></i>
                                                                    View
                                                                </a>

                                                                <a href="{{ $fileUrl }}" download
                                                                    class="inline-flex items-center gap-1 px-3 py-2 text-xs font-semibold rounded-lg text-sky-600 bg-sky-100 dark:bg-sky-500/20 dark:text-sky-300 hover:bg-sky-200 dark:hover:bg-sky-500/30">
                                                                    <i data-lucide="download" class="size-3"></i>
                                                                    Download
                                                                </a>

                                                                @if ($requirement->req_status == 0)
                                                                    <form
                                                                        action="{{ route('student.applicant-requirements.delete', ['requirement' => $requirement->id, 'type' => 'tor']) }}"
                                                                        method="POST"
                                                                        onsubmit="return confirm('Delete this file?');">
                                                                        @csrf
                                                                        @method('DELETE')

                                                                        <button type="submit"
                                                                            class="inline-flex items-center gap-1 px-3 py-2 text-xs font-semibold text-red-600 bg-red-100 rounded-lg dark:bg-red-500/20 dark:text-red-300 hover:bg-red-200 dark:hover:bg-red-500/30">
                                                                            <i data-lucide="trash-2" class="size-3"></i>
                                                                            Delete
                                                                        </button>
                                                                    </form>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        {{-- Optional Image Preview --}}
                                                        @if ($isImage)
                                                            <div
                                                                class="mt-4 overflow-hidden border rounded-xl border-slate-200 dark:border-zink-600">
                                                                <img src="{{ $fileUrl }}" alt="TOR Preview"
                                                                    class="object-cover w-full max-h-64">
                                                            </div>
                                                        @endif
                                                    </div>
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </div>
                                @endif

                            </div>

                            {{-- Preview Script --}}
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    const input = document.getElementById('tor_files');
                                    const preview = document.getElementById('tor-file-preview');
                                    const list = document.getElementById('tor-file-list');

                                    if (!input) return;

                                    input.addEventListener('change', function() {
                                        list.innerHTML = '';

                                        if (this.files.length > 0) {
                                            preview.classList.remove('hidden');

                                            Array.from(this.files).forEach(file => {
                                                const item = document.createElement('div');
                                                item.className =
                                                    'flex items-center gap-2 px-3 py-2 bg-white border rounded-xl border-slate-200 dark:bg-zink-800 dark:border-zink-600';

                                                item.innerHTML = `
                    <i data-lucide="file" class="size-4 text-slate-500"></i>
                    <div>
                        <p class="text-sm font-medium">${file.name}</p>
                        <p class="text-xs text-slate-500">${(file.size/1024/1024).toFixed(2)} MB</p>
                    </div>
                `;

                                                list.appendChild(item);
                                            });

                                            if (window.lucide) lucide.createIcons();
                                        } else {
                                            preview.classList.add('hidden');
                                        }
                                    });
                                });
                            </script>
                            {{-- end Honorable dismissal --}}
                        @endif

                        @if (in_array($applicant->policyId, [938, 946, 883, 905, 886, 884, 959, 887]))
                            <div class="space-y-4">

                                {{-- Header --}}
                                <div class="mt-10">
                                    <h6 class="text-base font-bold text-slate-800 dark:text-white">
                                        Hepatitis B Test Result
                                        <span class="ml-1 text-xs font-semibold text-red-500 uppercase">Required</span>
                                    </h6>
                                    <p class="mt-1 text-sm text-slate-500 dark:text-zink-300">
                                        Upload your laboratory result for Hepatitis B test.
                                    </p>
                                </div>

                                {{-- Upload Form --}}
                                @if (optional($requirements->first())->req_status == 0)
                                    <form action="{{ route('student.additional-applicant-requirements-2.hepab.store') }}"
                                        method="POST" enctype="multipart/form-data"
                                        class="p-4 border rounded-2xl bg-slate-50/70 border-slate-200 dark:bg-zink-700/30 dark:border-zink-600">
                                        @csrf

                                        @error('hepb_files.*')
                                            <div class="mb-3 text-sm text-red-500">{{ $message }}</div>
                                        @enderror

                                        <div class="space-y-4">

                                            {{-- Drag & Drop --}}
                                            <label for="hepb_files"
                                                class="block p-6 text-center transition bg-white border-2 border-dashed cursor-pointer rounded-2xl border-slate-300 hover:border-green-400 hover:bg-slate-50 dark:bg-zink-800 dark:border-zink-600 dark:hover:border-green-500">
                                                <div class="flex flex-col items-center justify-center">
                                                    <div
                                                        class="flex items-center justify-center w-12 h-12 mb-3 text-green-600 bg-green-100 rounded-full dark:bg-green-500/20 dark:text-green-300">
                                                        <i data-lucide="upload-cloud" class="size-5"></i>
                                                    </div>

                                                    <h6 class="mb-1 text-sm font-semibold text-slate-700 dark:text-white">
                                                        Drag and drop files here
                                                    </h6>
                                                    <p class="text-xs text-slate-500 dark:text-zink-300">
                                                        or click to browse multiple files
                                                    </p>
                                                </div>

                                                <input id="hepb_files" type="file" name="hepb_files[]" multiple
                                                    required class="hidden">
                                            </label>

                                            {{-- Preview --}}
                                            <div id="hepb-file-preview" class="hidden space-y-2">
                                                <h6
                                                    class="text-xs font-semibold tracking-wide uppercase text-slate-500 dark:text-zink-300">
                                                    Selected Files
                                                </h6>
                                                <div id="hepb-file-list" class="space-y-2"></div>
                                            </div>

                                            {{-- Upload Button --}}
                                            <div class="flex justify-end">
                                                <button type="submit"
                                                    class="inline-flex items-center gap-2 px-4 py-2.5 text-sm font-semibold text-white rounded-xl bg-green-500 hover:bg-green-600 transition-all duration-200 shadow-sm hover:shadow-md focus:outline-none focus:ring-2 focus:ring-green-200">
                                                    <i data-lucide="upload" class="size-4"></i>
                                                    Upload Hepatitis B Result
                                                </button>
                                            </div>

                                        </div>
                                    </form>
                                @endif

                                {{-- Uploaded Files --}}
                                @if ($requirements->isNotEmpty())
                                    <div class="space-y-3">
                                        <h6
                                            class="text-sm font-bold tracking-wide uppercase text-slate-600 dark:text-zink-200">
                                            Uploaded Files
                                        </h6>

                                        @foreach ($requirements as $requirement)
                                            @php
                                                $files = json_decode($requirement->hepa_b_test, true);
                                            @endphp

                                            @if (!empty($files))
                                                @foreach ($files as $file)
                                                    @php
                                                        $fileUrl = Storage::url(str_replace('doc/', 'hepa-b/', $file));
                                                        $fileName = basename($file);
                                                        $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                                                        $isImage = in_array($ext, [
                                                            'jpg',
                                                            'jpeg',
                                                            'png',
                                                            'webp',
                                                            'gif',
                                                        ]);
                                                    @endphp

                                                    <div
                                                        class="p-4 bg-white border rounded-2xl border-slate-200 dark:bg-zink-800 dark:border-zink-600">
                                                        <div class="flex flex-col gap-4 md:flex-row md:justify-between">

                                                            {{-- Left --}}
                                                            <div class="flex items-start min-w-0 gap-3">
                                                                <div
                                                                    class="flex items-center justify-center w-11 h-11 rounded-xl bg-slate-100 text-slate-600 dark:bg-zink-700 dark:text-zink-200">
                                                                    <i data-lucide="{{ $isImage ? 'image' : 'file-text' }}"
                                                                        class="size-5"></i>
                                                                </div>

                                                                <div>
                                                                    <h6
                                                                        class="text-sm font-semibold truncate text-slate-800 dark:text-white">
                                                                        {{ $fileName }}
                                                                    </h6>
                                                                    <p
                                                                        class="text-xs uppercase text-slate-500 dark:text-zink-300">
                                                                        Hepatitis B Test Result
                                                                    </p>

                                                                    <div class="mt-2">
                                                                        @if ($requirement->req_status == 0)
                                                                            <span
                                                                                class="inline-flex items-center gap-1 px-3 py-1 text-xs font-semibold text-yellow-700 bg-yellow-100 rounded-full dark:bg-yellow-500/20 dark:text-yellow-500">
                                                                                <i data-lucide="circle-dashed"
                                                                                    class="size-3"></i>
                                                                                Pending for Submission
                                                                            </span>
                                                                        @else
                                                                            <span
                                                                                class="inline-flex items-center gap-1 px-3 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded-full dark:bg-green-500/20 dark:text-green-500">
                                                                                <i data-lucide="check-circle-2"
                                                                                    class="size-3"></i>
                                                                                Submitted
                                                                            </span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            {{-- Actions --}}
                                                            <div class="flex flex-wrap items-center gap-2">
                                                                <a href="{{ $fileUrl }}" target="_blank"
                                                                    class="inline-flex items-center gap-1 px-3 py-2 text-xs font-semibold text-green-600 bg-green-100 rounded-lg dark:bg-green-500/20 dark:text-green-300">
                                                                    <i data-lucide="eye" class="size-3"></i>
                                                                    View
                                                                </a>

                                                                <a href="{{ $fileUrl }}" download
                                                                    class="inline-flex items-center gap-1 px-3 py-2 text-xs font-semibold rounded-lg text-sky-600 bg-sky-100 dark:bg-sky-500/20 dark:text-sky-300">
                                                                    <i data-lucide="download" class="size-3"></i>
                                                                    Download
                                                                </a>

                                                                @if ($requirement->req_status == 0)
                                                                    <form
                                                                        action="{{ route('student.applicant-requirements.delete', ['requirement' => $requirement->id, 'type' => 'hepa_b_test']) }}"
                                                                        method="POST"
                                                                        onsubmit="return confirm('Delete this file?');">
                                                                        @csrf
                                                                        @method('DELETE')

                                                                        <button
                                                                            class="inline-flex items-center gap-1 px-3 py-2 text-xs font-semibold text-red-600 bg-red-100 rounded-lg dark:bg-red-500/20 dark:text-red-300">
                                                                            <i data-lucide="trash-2" class="size-3"></i>
                                                                            Delete
                                                                        </button>
                                                                    </form>
                                                                @endif
                                                            </div>

                                                        </div>

                                                        {{-- Image Preview --}}
                                                        @if ($isImage)
                                                            <div
                                                                class="mt-4 overflow-hidden border rounded-xl border-slate-200 dark:border-zink-600">
                                                                <img src="{{ $fileUrl }}"
                                                                    class="object-cover w-full max-h-64">
                                                            </div>
                                                        @endif
                                                    </div>
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </div>
                                @endif

                            </div>

                            {{-- preview --}}
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {

                                    const input = document.getElementById('hepb_files');
                                    const previewWrapper = document.getElementById('hepb-file-preview');
                                    const fileList = document.getElementById('hepb-file-list');

                                    if (!input) return;

                                    input.addEventListener('change', function() {
                                        fileList.innerHTML = '';

                                        if (this.files.length > 0) {
                                            previewWrapper.classList.remove('hidden');

                                            Array.from(this.files).forEach(file => {
                                                const item = document.createElement('div');
                                                item.className =
                                                    'flex items-center justify-between px-3 py-2 bg-white border rounded-xl border-slate-200 dark:bg-zink-800 dark:border-zink-600';

                                                item.innerHTML = `
                    <div class="flex items-center min-w-0 gap-2">
                        <div class="flex items-center justify-center w-8 h-8 rounded-lg bg-slate-100 text-slate-600 dark:bg-zink-700 dark:text-zink-200 shrink-0">
                            <i data-lucide="file" class="size-4"></i>
                        </div>
                        <div class="min-w-0">
                            <p class="text-sm font-medium truncate text-slate-700 dark:text-white">${file.name}</p>
                            <p class="text-xs text-slate-500 dark:text-zink-300">${(file.size / 1024 / 1024).toFixed(2)} MB</p>
                        </div>
                    </div>
                `;

                                                fileList.appendChild(item);
                                            });

                                            if (window.lucide) {
                                                lucide.createIcons();
                                            }

                                        } else {
                                            previewWrapper.classList.add('hidden');
                                        }
                                    });

                                });
                            </script>

                        @endif

                        {{-- start chest x-ray --}}
                        {{-- start filter access --}}
                        @if (in_array($applicant->policyId, [946, 883, 938, 959]))

                            <div class="space-y-4">

                                {{-- Header --}}
                                <div class="mt-6">
                                    <h6 class="text-base font-bold text-slate-800 dark:text-white">
                                        Chest X-ray Test
                                        <span class="ml-1 text-xs font-semibold text-red-500 uppercase">Required</span>
                                    </h6>
                                    <p class="mt-1 text-sm text-slate-500 dark:text-zink-300">
                                        Upload your chest X-ray test result.
                                    </p>
                                </div>

                                {{-- Upload Form --}}
                                @if (optional($requirements->first())->req_status == 0)
                                    <form
                                        action="{{ route('student.additional-applicant-requirements-2.chest-xray.store') }}"
                                        method="POST" enctype="multipart/form-data"
                                        class="p-4 border rounded-2xl bg-slate-50/70 border-slate-200 dark:bg-zink-700/30 dark:border-zink-600">
                                        @csrf

                                        @error('chestxray_files.*')
                                            <div class="mb-3 text-sm text-red-500">{{ $message }}</div>
                                        @enderror

                                        <div class="space-y-4">

                                            {{-- Drag & Drop --}}
                                            <label for="chestxray_files"
                                                class="block p-6 text-center transition bg-white border-2 border-dashed cursor-pointer rounded-2xl border-slate-300 hover:border-green-400 hover:bg-slate-50 dark:bg-zink-800 dark:border-zink-600 dark:hover:border-green-500">
                                                <div class="flex flex-col items-center justify-center">
                                                    <div
                                                        class="flex items-center justify-center w-12 h-12 mb-3 text-green-600 bg-green-100 rounded-full dark:bg-green-500/20 dark:text-green-300">
                                                        <i data-lucide="upload-cloud" class="size-5"></i>
                                                    </div>

                                                    <h6 class="mb-1 text-sm font-semibold text-slate-700 dark:text-white">
                                                        Drag and drop files here
                                                    </h6>
                                                    <p class="text-xs text-slate-500 dark:text-zink-300">
                                                        or click to browse multiple files
                                                    </p>
                                                </div>

                                                <input id="chestxray_files" type="file" name="chestxray_files[]"
                                                    multiple required class="hidden">
                                            </label>

                                            {{-- Preview --}}
                                            <div id="chestxray-file-preview" class="hidden space-y-2">
                                                <h6
                                                    class="text-xs font-semibold tracking-wide uppercase text-slate-500 dark:text-zink-300">
                                                    Selected Files
                                                </h6>
                                                <div id="chestxray-file-list" class="space-y-2"></div>
                                            </div>

                                            {{-- Upload Button --}}
                                            <div class="flex justify-end">
                                                <button type="submit"
                                                    class="inline-flex items-center gap-2 px-4 py-2.5 text-sm font-semibold text-white rounded-xl bg-green-500 hover:bg-green-600 transition-all duration-200 shadow-sm hover:shadow-md focus:outline-none focus:ring-2 focus:ring-green-200">
                                                    <i data-lucide="upload" class="size-4"></i>
                                                    Upload Chest X-Ray Result
                                                </button>
                                            </div>

                                        </div>
                                    </form>
                                @endif

                                {{-- Uploaded Files --}}
                                @if ($requirements->isNotEmpty())
                                    <div class="space-y-3">
                                        <h6
                                            class="text-sm font-bold tracking-wide uppercase text-slate-600 dark:text-zink-200">
                                            Uploaded Files
                                        </h6>

                                        @foreach ($requirements as $requirement)
                                            @php
                                                $files = json_decode($requirement->chest_x_ray, true);
                                            @endphp

                                            @if (!empty($files))
                                                @foreach ($files as $file)
                                                    @php
                                                        $fileUrl = Storage::url(
                                                            str_replace('doc/', 'chest-xray/', $file),
                                                        );
                                                        $fileName = basename($file);
                                                        $extension = strtolower(
                                                            pathinfo($fileName, PATHINFO_EXTENSION),
                                                        );
                                                        $isImage = in_array($extension, [
                                                            'jpg',
                                                            'jpeg',
                                                            'png',
                                                            'gif',
                                                            'webp',
                                                        ]);
                                                    @endphp

                                                    <div
                                                        class="p-4 bg-white border rounded-2xl border-slate-200 dark:bg-zink-800 dark:border-zink-600">
                                                        <div
                                                            class="flex flex-col gap-4 md:flex-row md:items-start md:justify-between">

                                                            {{-- Left Side --}}
                                                            <div class="flex items-start min-w-0 gap-3">
                                                                <div
                                                                    class="flex items-center justify-center w-11 h-11 rounded-xl bg-slate-100 text-slate-600 dark:bg-zink-700 dark:text-zink-200 shrink-0">
                                                                    @if ($isImage)
                                                                        <i data-lucide="image" class="size-5"></i>
                                                                    @else
                                                                        <i data-lucide="file-text" class="size-5"></i>
                                                                    @endif
                                                                </div>

                                                                <div class="min-w-0">
                                                                    <h6
                                                                        class="text-sm font-semibold truncate text-slate-800 dark:text-white">
                                                                        {{ $fileName }}
                                                                    </h6>
                                                                    <p
                                                                        class="text-xs uppercase text-slate-500 dark:text-zink-300">
                                                                        Chest X-ray Test
                                                                    </p>

                                                                    <div class="flex flex-wrap items-center gap-2 mt-2">
                                                                        @if ($requirement->req_status == 0)
                                                                            <span
                                                                                class="inline-flex items-center gap-1 px-3 py-1 text-xs font-semibold text-yellow-700 bg-yellow-100 rounded-full dark:bg-yellow-500/20 dark:text-yellow-500">
                                                                                <i data-lucide="circle-dashed"
                                                                                    class="size-3"></i>
                                                                                Pending for Submission
                                                                            </span>
                                                                        @else
                                                                            <span
                                                                                class="inline-flex items-center gap-1 px-3 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded-full dark:bg-green-500/20 dark:text-green-500">
                                                                                <i data-lucide="check-circle-2"
                                                                                    class="size-3"></i>
                                                                                Submitted
                                                                            </span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            {{-- Right Side --}}
                                                            <div class="flex flex-wrap items-center gap-2">
                                                                <a href="{{ $fileUrl }}" target="_blank"
                                                                    class="inline-flex items-center gap-1 px-3 py-2 text-xs font-semibold text-green-600 bg-green-100 rounded-lg dark:bg-green-500/20 dark:text-green-300 hover:bg-green-200 dark:hover:bg-green-500/30">
                                                                    <i data-lucide="eye" class="size-3"></i>
                                                                    View
                                                                </a>

                                                                <a href="{{ $fileUrl }}" download
                                                                    class="inline-flex items-center gap-1 px-3 py-2 text-xs font-semibold rounded-lg text-sky-600 bg-sky-100 dark:bg-sky-500/20 dark:text-sky-300 hover:bg-sky-200 dark:hover:bg-sky-500/30">
                                                                    <i data-lucide="download" class="size-3"></i>
                                                                    Download
                                                                </a>

                                                                @if ($requirement->req_status == 0)
                                                                    <form
                                                                        action="{{ route('student.applicant-requirements.delete', ['requirement' => $requirement->id, 'type' => 'chest-xray']) }}"
                                                                        method="POST"
                                                                        onsubmit="return confirm('Delete this file?');">
                                                                        @csrf
                                                                        @method('DELETE')

                                                                        <button type="submit"
                                                                            class="inline-flex items-center gap-1 px-3 py-2 text-xs font-semibold text-red-600 bg-red-100 rounded-lg dark:bg-red-500/20 dark:text-red-300 hover:bg-red-200 dark:hover:bg-red-500/30">
                                                                            <i data-lucide="trash-2" class="size-3"></i>
                                                                            Delete
                                                                        </button>
                                                                    </form>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        {{-- Optional Image Preview --}}
                                                        @if ($isImage)
                                                            <div
                                                                class="mt-4 overflow-hidden border rounded-xl border-slate-200 dark:border-zink-600">
                                                                <img src="{{ $fileUrl }}" alt="Chest X-ray Preview"
                                                                    class="object-cover w-full max-h-64">
                                                            </div>
                                                        @endif
                                                    </div>
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </div>
                                @endif

                            </div>

                            {{-- Preview Script --}}
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    const input = document.getElementById('chestxray_files');
                                    const previewWrapper = document.getElementById('chestxray-file-preview');
                                    const fileList = document.getElementById('chestxray-file-list');

                                    if (!input) return;

                                    input.addEventListener('change', function() {
                                        fileList.innerHTML = '';

                                        if (this.files.length > 0) {
                                            previewWrapper.classList.remove('hidden');

                                            Array.from(this.files).forEach(file => {
                                                const item = document.createElement('div');
                                                item.className =
                                                    'flex items-center justify-between px-3 py-2 bg-white border rounded-xl border-slate-200 dark:bg-zink-800 dark:border-zink-600';

                                                item.innerHTML = `
                    <div class="flex items-center min-w-0 gap-2">
                        <div class="flex items-center justify-center w-8 h-8 rounded-lg bg-slate-100 text-slate-600 dark:bg-zink-700 dark:text-zink-200 shrink-0">
                            <i data-lucide="file" class="size-4"></i>
                        </div>
                        <div class="min-w-0">
                            <p class="text-sm font-medium truncate text-slate-700 dark:text-white">${file.name}</p>
                            <p class="text-xs text-slate-500 dark:text-zink-300">${(file.size / 1024 / 1024).toFixed(2)} MB</p>
                        </div>
                    </div>
                `;

                                                fileList.appendChild(item);
                                            });

                                            if (window.lucide) {
                                                lucide.createIcons();
                                            }
                                        } else {
                                            previewWrapper.classList.add('hidden');
                                        }
                                    });
                                });
                            </script>
                        @endif
                        {{-- end filter access --}}
                        {{-- end chest x-ray --}}


                        {{-- start prenancy Test --}}
                        {{-- start filter access --}}
                        @if ($applicant->gender === 'Female' && in_array($applicant->policyId, [946, 883, 938, 959]))

                            <div class="space-y-4">

                                {{-- Header --}}
                                <div class="mt-6">
                                    <h6 class="text-base font-bold text-slate-800 dark:text-white">
                                        Pregnancy Test
                                        <span class="ml-1 text-xs font-semibold text-red-500 uppercase">Required</span>
                                    </h6>
                                    <p class="mt-1 text-sm text-slate-500 dark:text-zink-300">
                                        Upload your pregnancy test result.
                                    </p>
                                </div>

                                {{-- Upload Form --}}
                                @if (optional($requirements->first())->req_status == 0)
                                    <form
                                        action="{{ route('student.additional-applicant-requirements-2.pregnancy-test.store') }}"
                                        method="POST" enctype="multipart/form-data"
                                        class="p-4 border rounded-2xl bg-slate-50/70 border-slate-200 dark:bg-zink-700/30 dark:border-zink-600">
                                        @csrf

                                        @error('pregnancyTest_files.*')
                                            <div class="mb-3 text-sm text-red-500">{{ $message }}</div>
                                        @enderror

                                        <div class="space-y-4">

                                            {{-- Drag & Drop --}}
                                            <label for="pregnancyTest_files"
                                                class="block p-6 text-center transition bg-white border-2 border-dashed cursor-pointer rounded-2xl border-slate-300 hover:border-green-400 hover:bg-slate-50 dark:bg-zink-800 dark:border-zink-600 dark:hover:border-green-500">
                                                <div class="flex flex-col items-center justify-center">
                                                    <div
                                                        class="flex items-center justify-center w-12 h-12 mb-3 text-green-600 bg-green-100 rounded-full dark:bg-green-500/20 dark:text-green-300">
                                                        <i data-lucide="upload-cloud" class="size-5"></i>
                                                    </div>

                                                    <h6 class="mb-1 text-sm font-semibold text-slate-700 dark:text-white">
                                                        Drag and drop files here
                                                    </h6>
                                                    <p class="text-xs text-slate-500 dark:text-zink-300">
                                                        or click to browse multiple files
                                                    </p>
                                                </div>

                                                <input id="pregnancyTest_files" type="file"
                                                    name="pregnancyTest_files[]" multiple required class="hidden">
                                            </label>

                                            {{-- Preview --}}
                                            <div id="pregnancy-file-preview" class="hidden space-y-2">
                                                <h6
                                                    class="text-xs font-semibold tracking-wide uppercase text-slate-500 dark:text-zink-300">
                                                    Selected Files
                                                </h6>
                                                <div id="pregnancy-file-list" class="space-y-2"></div>
                                            </div>

                                            {{-- Upload Button --}}
                                            <div class="flex justify-end">
                                                <button type="submit"
                                                    class="inline-flex items-center gap-2 px-4 py-2.5 text-sm font-semibold text-white rounded-xl bg-green-500 hover:bg-green-600 transition-all duration-200 shadow-sm hover:shadow-md focus:outline-none focus:ring-2 focus:ring-green-200">
                                                    <i data-lucide="upload" class="size-4"></i>
                                                    Upload Pregnancy Test
                                                </button>
                                            </div>

                                        </div>
                                    </form>
                                @endif

                                {{-- Uploaded Files --}}
                                @if ($requirements->isNotEmpty())
                                    <div class="space-y-3">
                                        <h6
                                            class="text-sm font-bold tracking-wide uppercase text-slate-600 dark:text-zink-200">
                                            Uploaded Files
                                        </h6>

                                        @foreach ($requirements as $requirement)
                                            @php
                                                $files = json_decode($requirement->preg_test, true);
                                            @endphp

                                            @if (!empty($files))
                                                @foreach ($files as $file)
                                                    @php
                                                        $fileUrl = Storage::url(
                                                            str_replace('doc/', 'pregnancy-test/', $file),
                                                        );
                                                        $fileName = basename($file);
                                                        $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                                                        $isImage = in_array($ext, [
                                                            'jpg',
                                                            'jpeg',
                                                            'png',
                                                            'webp',
                                                            'gif',
                                                        ]);
                                                    @endphp

                                                    <div
                                                        class="p-4 bg-white border rounded-2xl border-slate-200 dark:bg-zink-800 dark:border-zink-600">
                                                        <div class="flex flex-col gap-4 md:flex-row md:justify-between">

                                                            {{-- Left --}}
                                                            <div class="flex items-start min-w-0 gap-3">
                                                                <div
                                                                    class="flex items-center justify-center w-11 h-11 rounded-xl bg-slate-100 text-slate-600 dark:bg-zink-700 dark:text-zink-200">
                                                                    <i data-lucide="{{ $isImage ? 'image' : 'file-text' }}"
                                                                        class="size-5"></i>
                                                                </div>

                                                                <div>
                                                                    <h6
                                                                        class="text-sm font-semibold truncate text-slate-800 dark:text-white">
                                                                        {{ $fileName }}
                                                                    </h6>
                                                                    <p
                                                                        class="text-xs uppercase text-slate-500 dark:text-zink-300">
                                                                        Pregnancy Test
                                                                    </p>

                                                                    <div class="mt-2">
                                                                        @if ($requirement->req_status == 0)
                                                                            <span
                                                                                class="inline-flex items-center gap-1 px-3 py-1 text-xs font-semibold text-yellow-700 bg-yellow-100 rounded-full dark:bg-yellow-500/20 dark:text-yellow-500">
                                                                                <i data-lucide="circle-dashed"
                                                                                    class="size-3"></i>
                                                                                Pending for Submission
                                                                            </span>
                                                                        @else
                                                                            <span
                                                                                class="inline-flex items-center gap-1 px-3 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded-full dark:bg-green-500/20 dark:text-green-500">
                                                                                <i data-lucide="check-circle-2"
                                                                                    class="size-3"></i>
                                                                                Submitted
                                                                            </span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            {{-- Actions --}}
                                                            <div class="flex flex-wrap items-center gap-2">
                                                                <a href="{{ $fileUrl }}" target="_blank"
                                                                    class="inline-flex items-center gap-1 px-3 py-2 text-xs font-semibold text-green-600 bg-green-100 rounded-lg dark:bg-green-500/20 dark:text-green-300">
                                                                    <i data-lucide="eye" class="size-3"></i>
                                                                    View
                                                                </a>

                                                                <a href="{{ $fileUrl }}" download
                                                                    class="inline-flex items-center gap-1 px-3 py-2 text-xs font-semibold rounded-lg text-sky-600 bg-sky-100 dark:bg-sky-500/20 dark:text-sky-300">
                                                                    <i data-lucide="download" class="size-3"></i>
                                                                    Download
                                                                </a>

                                                                @if ($requirement->req_status == 0)
                                                                    <form
                                                                        action="{{ route('student.applicant-requirements.delete', ['requirement' => $requirement->id, 'type' => 'pregnancy-test']) }}"
                                                                        method="POST"
                                                                        onsubmit="return confirm('Delete this file?');">
                                                                        @csrf
                                                                        @method('DELETE')

                                                                        <button
                                                                            class="inline-flex items-center gap-1 px-3 py-2 text-xs font-semibold text-red-600 bg-red-100 rounded-lg dark:bg-red-500/20 dark:text-red-300">
                                                                            <i data-lucide="trash-2" class="size-3"></i>
                                                                            Delete
                                                                        </button>
                                                                    </form>
                                                                @endif
                                                            </div>

                                                        </div>

                                                        {{-- Image Preview --}}
                                                        @if ($isImage)
                                                            <div
                                                                class="mt-4 overflow-hidden border rounded-xl border-slate-200 dark:border-zink-600">
                                                                <img src="{{ $fileUrl }}"
                                                                    class="object-cover w-full max-h-64">
                                                            </div>
                                                        @endif
                                                    </div>
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </div>
                                @endif

                            </div>

                            {{-- Script --}}
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    const input = document.getElementById('pregnancyTest_files');
                                    const previewWrapper = document.getElementById('pregnancy-file-preview');
                                    const fileList = document.getElementById('pregnancy-file-list');

                                    if (!input) return;

                                    input.addEventListener('change', function() {
                                        fileList.innerHTML = '';

                                        if (this.files.length > 0) {
                                            previewWrapper.classList.remove('hidden');

                                            Array.from(this.files).forEach(file => {
                                                const item = document.createElement('div');
                                                item.className =
                                                    'flex items-center justify-between px-3 py-2 bg-white border rounded-xl border-slate-200 dark:bg-zink-800 dark:border-zink-600';

                                                item.innerHTML = `
                    <div class="flex items-center min-w-0 gap-2">
                        <div class="flex items-center justify-center w-8 h-8 rounded-lg bg-slate-100 text-slate-600 dark:bg-zink-700 dark:text-zink-200 shrink-0">
                            <i data-lucide="file" class="size-4"></i>
                        </div>
                        <div class="min-w-0">
                            <p class="text-sm font-medium truncate text-slate-700 dark:text-white">${file.name}</p>
                            <p class="text-xs text-slate-500 dark:text-zink-300">${(file.size / 1024 / 1024).toFixed(2)} MB</p>
                        </div>
                    </div>
                `;

                                                fileList.appendChild(item);
                                            });

                                            if (window.lucide) lucide.createIcons();
                                        } else {
                                            previewWrapper.classList.add('hidden');
                                        }
                                    });
                                });
                            </script>

                        @endif
                        {{-- end filter access --}}
                        {{-- end prenancy Test --}}
                        <div class="sticky z-20 mt-6 bottom-4">
                            <div
                                class="p-4 border shadow-lg rounded-2xl border-white/60 bg-white/95 backdrop-blur dark:border-zink-700/60 dark:bg-zink-800/95">

                                <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                                    {{-- Reminder Notice --}}
                                    <div class="flex items-start min-w-0 gap-3">
                                        <div
                                            class="flex items-center justify-center w-10 h-10 rounded-xl bg-amber-100 text-amber-600 dark:bg-amber-500/20 dark:text-amber-300 shrink-0">
                                            <i data-lucide="shield-alert" class="size-5"></i>
                                        </div>

                                        <div class="min-w-0">
                                            <h6 class="mb-1 text-sm font-bold text-slate-800 dark:text-white">
                                                Final Submission Reminder
                                            </h6>
                                            <p class="text-sm leading-6 text-slate-600 dark:text-zink-300">
                                                Before clicking the
                                                <span class="font-semibold text-slate-800 dark:text-white">"Submit
                                                    Requirements"</span>
                                                button, please ensure that all required documents have been successfully
                                                uploaded.
                                            </p>
                                        </div>
                                    </div>

                                    {{-- Action Buttons --}}
                                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center shrink-0">
                                        @if ($requirements->isNotEmpty() && optional($requirements->first())->req_status == 0)
                                            <button type="submit" id="submitButton"
                                                class="inline-flex items-center justify-center gap-2 px-5 py-2.5 text-sm font-semibold text-white rounded-xl bg-green-500 hover:bg-green-600 transition-all duration-200 shadow-sm hover:shadow-md focus:outline-none focus:ring-2 focus:ring-green-200">
                                                <i data-lucide="upload" class="size-4"></i>
                                                Submit Requirements
                                            </button>
                                        @elseif($requirements->isNotEmpty() && optional($requirements->first())->req_status == 1)
                                            <button type="submit" id="unpostButton"
                                                class="inline-flex items-center justify-center gap-2 px-5 py-2.5 text-sm font-semibold text-white rounded-xl bg-slate-500 hover:bg-slate-600 transition-all duration-200 shadow-sm hover:shadow-md focus:outline-none focus:ring-2 focus:ring-slate-200">
                                                <i data-lucide="x" class="size-4"></i>
                                                Unpost Requirements
                                            </button>

                                            <a href="{{ route('student.program-confirmation.index') }}"
                                                class="inline-flex items-center justify-center gap-2 px-5 py-2.5 text-sm font-semibold text-white rounded-xl bg-green-500 hover:bg-green-600 transition-all duration-200 shadow-sm hover:shadow-md focus:outline-none focus:ring-2 focus:ring-green-200">
                                                Proceed to Next Step
                                                <i data-lucide="move-right" class="size-4"></i>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--end card-->
            </div>


        </div>
    @elseif($applicant->applicant_profile_status == 0)
        <div class="flex gap-3 p-4 text-sm text-red-500 rounded-md bg-red-50 dark:bg-red-400/20">
            <i data-lucide="alert-triangle" class="inline-block size-4 mt-0.5 shrink-0"></i>
            <div>
                <h6 class="mb-1">Something is very wrong!</h6>
                <p class="mb-2">Upon checking your profile status, it has not been submitted or finalized yet and remains
                    in draft mode.</p>
                <a href="{{ route('student.applicant-profile.step1.show') }}"
                    class="font-semibold text-red-600 transition hover:text-red-700"><i data-lucide="move-left"
                        class="inline-block h-4 align-middle"></i> Go Back </a>
            </div>
        </div>
    @else
        <div class="p-4 mt-4 border rounded-2xl border-slate-200 bg-slate-50 dark:border-zink-600 dark:bg-zink-800/60">
            <div class="flex items-start gap-3">
                <i data-lucide="info" class="mt-0.5 size-5 text-slate-500"></i>
                <div>
                    <h4 class="font-semibold text-slate-800 dark:text-white">No profile found</h4>
                    <p class="text-sm text-slate-600 dark:text-zink-300">
                        Please complete your student profile first before accessing the requirements page.
                    </p>
                </div>
            </div>
        </div>
    @endif
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
                        fetch("{{ route('student.requirements.publish') }}", {
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

    {{-- sswal unposst --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("unpostButton").addEventListener("click", function(event) {
                event.preventDefault(); // Prevent default action

                Swal.fire({
                    title: "Are you sure to unpost the requirements?",
                    text: "Unposting will allow you to edit the requirements again. You are allowed to unpost a requirement up to three times",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, unpost it!",
                    cancelButtonText: "Cancel"
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Send AJAX request to publish
                        fetch("{{ route('student.requirements.unpost') }}", {
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
                                            "Requirements has been unposted. You can now edit the requirements.",
                                            "success")
                                        .then(() => {
                                            // Redirect to the specific route instead of reloading
                                            window.location.href =
                                                "{{ route('student.applicant-requirements.index') }}";
                                        });
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
