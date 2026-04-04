@php
    $previewId = str_replace('_files', '-file-preview', $section['input_id']);
    $listId = str_replace('_files', '-file-list', $section['input_id']);
@endphp

<div class="space-y-4 {{ $loop ?? null ? 'mt-10' : '' }}">
    <div class="{{ request()->routeIs('*') ? 'mt-10' : '' }}">
        <h6 class="text-base font-bold text-slate-800 dark:text-white">
            {{ $section['title'] }}
            @if ($section['required'])
                <span class="ml-1 text-xs font-semibold text-red-500 uppercase">Required</span>
            @endif
        </h6>
        <p class="mt-1 text-sm text-slate-500 dark:text-zink-300">
            {{ $section['description'] }}
        </p>
    </div>

    @if ($isEditable)
        <form action="{{ $section['store_route'] }}" method="POST" enctype="multipart/form-data"
            class="p-4 border rounded-2xl bg-slate-50/70 border-slate-200 dark:bg-zink-700/30 dark:border-zink-600">
            @csrf

            @error($section['error_key'])
                <div class="mb-3 text-sm text-red-500">{{ $message }}</div>
            @enderror

            <div class="space-y-4">
                <label for="{{ $section['input_id'] }}"
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

                    <input id="{{ $section['input_id'] }}" type="file" name="{{ $section['input_name'] }}" multiple
                        @if ($section['required']) required @endif class="hidden">
                </label>

                <div id="{{ $previewId }}" class="hidden space-y-2">
                    <h6 class="text-xs font-semibold tracking-wide uppercase text-slate-500 dark:text-zink-300">
                        Selected Files
                    </h6>
                    <div id="{{ $listId }}" class="space-y-2"></div>
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                        class="inline-flex items-center gap-2 px-4 py-2.5 text-sm font-semibold text-white rounded-xl bg-green-500 hover:bg-green-600 transition-all duration-200 shadow-sm hover:shadow-md focus:outline-none focus:ring-2 focus:ring-green-200">
                        <i data-lucide="upload" class="size-4"></i>
                        {{ $section['upload_label'] }}
                    </button>
                </div>
            </div>
        </form>
    @endif

    @if ($requirements->isNotEmpty())
        <div class="space-y-3">
            <div class="flex items-center justify-between">
                <h6 class="text-sm font-bold tracking-wide uppercase text-slate-600 dark:text-zink-200">
                    Uploaded Files
                </h6>
            </div>

            @foreach ($requirements as $requirement)
                @php
                    $files = json_decode(data_get($requirement, $section['json_column']), true);
                @endphp

                @if (!empty($files))
                    @foreach ($files as $file)
                        @php
                            $fileUrl = Storage::url(str_replace('doc/', $section['folder'] . '/', $file));
                            $fileName = basename($file);
                            $extension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                            $isImage = in_array($extension, $imageExtensions);
                        @endphp

                        <div
                            class="p-4 bg-white border rounded-2xl border-slate-200 dark:bg-zink-800 dark:border-zink-600">
                            <div class="flex flex-col gap-4 md:flex-row md:items-start md:justify-between">
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
                                        <h6 class="text-sm font-semibold truncate text-slate-800 dark:text-white">
                                            {{ $fileName }}
                                        </h6>
                                        <p class="text-xs uppercase text-slate-500 dark:text-zink-300">
                                            {{ $section['file_label'] }}
                                        </p>

                                        <div class="flex flex-wrap items-center gap-2 mt-2">
                                            @if ($requirement->req_status == 0)
                                                <span
                                                    class="inline-flex items-center gap-1 px-3 py-1 text-xs font-semibold text-yellow-700 bg-yellow-100 rounded-full dark:bg-yellow-500/20 dark:text-yellow-500">
                                                    <i data-lucide="circle-dashed" class="size-3"></i>
                                                    Pending for Submission
                                                </span>
                                            @else
                                                <span
                                                    class="inline-flex items-center gap-1 px-3 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded-full dark:bg-green-500/20 dark:text-green-500">
                                                    <i data-lucide="check-circle-2" class="size-3"></i>
                                                    Submitted
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

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
                                            action="{{ route('student.applicant-requirements.delete', ['requirement' => $requirement->id, 'type' => $section['delete_type']]) }}"
                                            method="POST" onsubmit="return confirm('Delete this file?');">
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

                            @if ($isImage)
                                <div
                                    class="mt-4 overflow-hidden border rounded-xl border-slate-200 dark:border-zink-600">
                                    <img src="{{ $fileUrl }}" alt="{{ $section['file_label'] }} Preview"
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
