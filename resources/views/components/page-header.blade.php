@props([
    'title' => 'Page Title',
    'subtitle' => null,
    'module' => null,
    'moduleIcon' => 'layout-dashboard',
    'section' => null,
    'sectionIcon' => 'file-text',
    'breadcrumbs' => [],
])

<div class="mt-4 mb-4 print:hidden">
    <div
        class="flex flex-col gap-3 rounded-[20px] border border-slate-200/80 bg-slate-50/60 px-4 py-4 md:flex-row md:items-center md:justify-between">
        <div class="min-w-0 grow">
            @if ($module || $section)
                <div class="flex flex-wrap items-center gap-2 mb-2">
                    @if ($module)
                        <span
                            class="inline-flex items-center gap-1.5 rounded-full border border-indigo-200 bg-indigo-50 px-3 py-1 text-[11px] font-semibold uppercase tracking-[0.22em] text-indigo-600">
                            <i data-lucide="{{ $moduleIcon }}" class="size-3.5"></i>
                            {{ $module }}
                        </span>
                    @endif

                    @if ($section)
                        <span
                            class="inline-flex items-center gap-1.5 rounded-full border border-slate-200 bg-white px-3 py-1 text-[11px] font-semibold uppercase tracking-[0.18em] text-slate-500">
                            <i data-lucide="{{ $sectionIcon }}" class="size-3.5"></i>
                            {{ $section }}
                        </span>
                    @endif
                </div>
            @endif

            <h5 class="text-[15px] font-semibold uppercase tracking-tight text-slate-500">
                {{ $title }}
            </h5>

            @if ($subtitle)
                <p class="mt-1 text-sm text-slate-500">
                    {{ $subtitle }}
                </p>
            @endif
        </div>

        @if (!empty($breadcrumbs))
            <ul class="flex flex-wrap items-center gap-2 text-sm shrink-0">
                @foreach ($breadcrumbs as $index => $crumb)
                    <li>
                        @if (!empty($crumb['url']))
                            <a href="{{ $crumb['url'] }}"
                                class="inline-flex items-center rounded-full border border-slate-200 bg-white px-3 py-1.5 text-xs font-medium text-slate-500 transition hover:border-indigo-200 hover:text-indigo-600">
                                {{ $crumb['label'] }}
                            </a>
                        @else
                            <span
                                class="inline-flex items-center rounded-full border border-slate-200 bg-white px-3 py-1.5 text-xs font-semibold text-slate-600">
                                {{ $crumb['label'] }}
                            </span>
                        @endif
                    </li>

                    @if (!$loop->last)
                        <li class="text-slate-300">
                            <i data-lucide="chevron-right" class="size-4"></i>
                        </li>
                    @endif
                @endforeach
            </ul>
        @endif
    </div>
</div>
