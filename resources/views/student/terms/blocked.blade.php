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

            <div class="px-6 py-5 border-t border-slate-200 bg-slate-50">
                <label class="flex items-start gap-3 mb-4">
                    <input type="checkbox" id="acceptTermsCheckbox"
                        class="mt-1 rounded border-slate-300 text-sky-600 focus:ring-sky-500">
                    <span class="text-sm text-slate-700">
                        I have read and understood the Terms and Conditions, including the prohibition against unauthorized
                        screenshots, screen recordings, and sharing of personal data from the USMCEE System.
                    </span>
                </label>

                <div class="flex justify-end">
                    <button id="acceptTermsBtn" data-policy-id="{{ $activeTermsPolicy->id }}" disabled
                        class="px-4 py-2 text-sm font-medium text-white rounded-lg bg-slate-400">
                        Accept and Continue
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkbox = document.getElementById('acceptTermsCheckbox');
            const button = document.getElementById('acceptTermsBtn');

            checkbox.addEventListener('change', function() {
                if (this.checked) {
                    button.disabled = false;
                    button.classList.remove('bg-slate-400');
                    button.classList.add('bg-sky-600', 'hover:bg-sky-700');
                } else {
                    button.disabled = true;
                    button.classList.remove('bg-sky-600', 'hover:bg-sky-700');
                    button.classList.add('bg-slate-400');
                }
            });

            button.addEventListener('click', async function() {
                try {
                    const response = await fetch("{{ route('student.terms-policy.accept') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                            "Accept": "application/json"
                        },
                        body: JSON.stringify({
                            terms_policy_id: this.dataset.policyId
                        })
                    });

                    const data = await response.json();

                    if (data.success) {
                        window.location.href = data.redirect;
                        return;
                    }

                    alert('Unable to record acceptance.');
                } catch (error) {
                    console.error(error);
                    alert('An error occurred while recording your acceptance.');
                }
            });
        });
    </script>
@endsection
