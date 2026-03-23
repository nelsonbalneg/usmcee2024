@extends('student.layouts.master')
@section('title')
    USM-CEE | Frequently Asked Questions
@endsection

@section('contents')
    <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
        <div class="grow">
            <h5 class="uppercase text-16">USMCEE 4.0 | Frequently Asked Questions</h5>
        </div>
        <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1 before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="#!" class="text-slate-400 dark:text-zink-200">Home</a>
            </li>
            <li class="text-slate-700 dark:text-zink-100">
                FAQs
            </li>
        </ul>
    </div>

    <div class="relative overflow-hidden card">
        <div class="p-8">
            <div class="grid grid-cols-1 gap-5 xl:grid-cols-12">
                <div class="xl:col-span-7">
                    <h4 class="mb-1">USMCEE Help & Support</h4>
                    <p class="mb-5 text-slate-500 dark:text-zink-200">
                        Browse frequently asked questions to guide you through the USMCEE process.
                    </p>

                    <div class="relative inline-block w-2/3">
                        <input type="text" id="faqSearch"
                            class="w-full py-2 pl-4 pr-8 form-input border-slate-200 dark:border-zink-500"
                            placeholder="Search FAQs...">
                        <i data-lucide="search" class="inline-block size-4 absolute right-2.5 top-2.5 text-slate-400"></i>
                    </div>

                    <div class="hidden xl:col-span-3 xl:col-start-10 xl:block">
                        <img src="{{ asset('backend/assets/images/faq.png') }}" alt=""
                            class="absolute h-[500px] -rotate-45 -top-28 ltr:right-8 rtl:left-8">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <h5 class="mb-5 underline">Frequently Asked Questions</h5>

    <div class="grid max-w-3xl grid-cols-1 mx-auto" id="faqContainer">
        @foreach ($faqs as $faq)
            <div class="faq-item">
                <div class="collapsible">
                    <button type="button"
                        class="flex items-center w-full p-3 text-left card collapsible-header group/item">
                        <span class="faq-question">{{ $faq->question }}</span>

                        <div class="ltr:ml-auto rtl:mr-auto shrink-0">
                            <i data-lucide="chevron-down" class="hidden size-4 group-[.show]/item:inline-block"></i>
                            <i data-lucide="chevron-up" class="inline-block size-4 group-[.show]/item:hidden"></i>
                        </div>
                    </button>

                    <div class="hidden collapsible-content card">
                        <div class="card-body text-slate-500 dark:text-zink-200 faq-answer">
                            {!! $faq->answer !!}
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <p id="faqNoResults" class="hidden mt-4 text-center text-slate-500 dark:text-zink-200">
        No matching FAQs found.
    </p>
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
