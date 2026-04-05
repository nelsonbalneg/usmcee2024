@extends('student.layouts.master')
@section('title')
    USM-CEE | Frequently Asked Questions
@endsection

@section('contents')
    <x-page-header title="USMCEE 4.0 | Frequently Asked Questions" :breadcrumbs="[['label' => 'Home', 'url' => route('dashboard')], ['label' => 'Frequently Asked Questions']]" />


    <div
        class="relative overflow-hidden border shadow-sm rounded-2xl border-custom-200 bg-gradient-to-br from-custom-50 to-white dark:border-custom-500/20 dark:bg-custom-500/10">

        <div class="px-6 py-10 md:px-10">
            <div class="grid items-center gap-8 xl:grid-cols-12">

                {{-- LEFT CONTENT --}}
                <div class=" xl:col-span-6">

                    <p class="text-[11px] font-semibold tracking-[0.25em] uppercase text-custom-500">
                        Help Center
                    </p>

                    <h1 class="text-3xl font-bold tracking-tight text-slate-800 dark:text-white">
                        USMCEE Help & Support
                    </h1>

                    <p class="max-w-md mb-3 text-sm text-slate-500 dark:text-zink-300">
                        Browse frequently asked questions to guide you through the USMCEE process and quickly
                        find the information you need.
                    </p>

                    {{-- SEARCH --}}
                    <div class="relative max-w-md">
                        <input type="text" id="faqSearch"
                            class="w-full px-3 py-3 pr-4 text-sm border rounded-2xl border-slate-200 bg-slate-50 pl-11 text-slate-700 placeholder:text-slate-400 focus:border-custom-500 focus:bg-white focus:outline-none dark:border-zink-600 dark:bg-zink-700 dark:text-zink-100"
                            placeholder="Search FAQs...">
                    </div>

                </div>

                {{-- RIGHT IMAGE --}}
                <div class="relative flex justify-center xl:col-span-6 xl:justify-end">

                    {{-- soft background glow --}}
                    <div class="absolute w-[300px] h-[300px] bg-custom-500/10 rounded-full blur-3xl"></div>
                </div>

            </div>
        </div>
    </div>

    {{-- FAQ Section Header --}}
    <div class="mt-8 mb-4">
        <p class="text-[11px] font-semibold tracking-[0.22em] uppercase text-custom-500">
            Support Topics
        </p>
        <h5 class="mt-1 text-xl font-bold tracking-tight text-slate-800 dark:text-white">
            Frequently Asked Questions
        </h5>
        <p class="mt-1 text-sm text-slate-500 dark:text-zink-300">
            Click a question below to view the answer.
        </p>
    </div>

    {{-- FAQ List --}}
    <div class="grid max-w-4xl grid-cols-1 gap-3" id="faqContainer">
        @foreach ($faqs as $faq)
            <div
                class="overflow-hidden transition-all duration-200 bg-white border shadow-sm faq-item rounded-2xl border-slate-200 dark:border-zink-600 dark:bg-zink-800">
                <div class="collapsible group/item">
                    <button type="button"
                        class="flex items-center w-full gap-3 px-5 py-4 text-left transition-colors duration-200 collapsible-header hover:bg-slate-50 dark:hover:bg-zink-700/40">
                        <div
                            class="flex items-center justify-center rounded-xl size-9 bg-slate-100 text-slate-500 dark:bg-zink-700 dark:text-zink-300 shrink-0">
                            <i data-lucide="help-circle" class="size-4"></i>
                        </div>

                        <span class="flex-1 text-sm font-semibold faq-question text-slate-800 dark:text-white">
                            {{ $faq->question }}
                        </span>

                        <div class="shrink-0 text-slate-400">
                            <i data-lucide="chevron-down" class="hidden size-4 group-[.show]/item:inline-block"></i>
                            <i data-lucide="chevron-up" class="inline-block size-4 group-[.show]/item:hidden"></i>
                        </div>
                    </button>

                    <div class="hidden border-t collapsible-content border-slate-200 dark:border-zink-600">
                        <div class="px-5 py-4 text-sm leading-7 text-slate-600 dark:text-zink-300 faq-answer">
                            {!! $faq->answer !!}
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- No Results --}}
    <div id="faqNoResults"
        class="hidden px-5 py-6 mt-6 text-sm text-center border rounded-2xl border-slate-200 bg-slate-50 text-slate-500 dark:border-zink-600 dark:bg-zink-800 dark:text-zink-300">
        No matching FAQs found.
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('faqSearch');
            const faqItems = document.querySelectorAll('.faq-item');
            const noResults = document.getElementById('faqNoResults');

            if (!searchInput || !faqItems.length) return;

            searchInput.addEventListener('input', function() {
                const keyword = this.value.toLowerCase().trim();
                let visibleCount = 0;

                faqItems.forEach(item => {
                    const question = item.querySelector('.faq-question')?.innerText.toLowerCase() ||
                        '';
                    const answer = item.querySelector('.faq-answer')?.innerText.toLowerCase() || '';
                    const content = `${question} ${answer}`;

                    if (content.includes(keyword)) {
                        item.classList.remove('hidden');
                        visibleCount++;
                    } else {
                        item.classList.add('hidden');
                    }
                });

                if (noResults) {
                    noResults.classList.toggle('hidden', visibleCount > 0);
                }
            });
        });
    </script>
@endpush
