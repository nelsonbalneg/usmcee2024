<?php

namespace Database\Seeders;

use App\Models\TermsPolicy;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TermsPolicySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TermsPolicy::create([
            'title' => 'Terms & Conditions',
            'version' => '1.0',
            'is_active' => true,
            'effective_date' => now()->toDateString(),
            'content' => '
    <p class="text-justify">
        Welcome to the University of Southern Mindanao (USM) College Entrance Examination
        Registration Website. By accessing and using this website, you agree to comply with and
        be bound by these Terms and Conditions, which govern your use of this application. If
        you do not agree, please refrain from using this site.
    </p>

    <br>

    <div class="flex gap-1 px-3 py-3 mb-5 text-sm border border-yellow-200 rounded-md md:items-center text-black-500 bg-yellow-50">
        <h6 class="mb-1 font-bold">Eligibility and Accurate Information</h6>
    </div>

    <ul class="px-3 space-y-3 text-justify list-disc list-inside rounded-md">
        <li>Only eligible applicants, specifically senior high school students, may use this website to register for the USM College Entrance Examination.</li>
        <li>All information provided must be complete, accurate, and truthful. By submitting your application, you confirm that you meet the eligibility requirements.</li>
        <li>Providing false information or misrepresenting your qualifications may lead to disqualification from the application process and will be handled in accordance with applicable Philippine laws.</li>
    </ul>

    <div class="flex gap-1 px-3 py-3 mt-5 mb-5 text-sm border border-yellow-200 rounded-md md:items-center text-black-500 bg-yellow-50">
        <h6 class="mb-1 font-bold">Data Privacy and Confidentiality</h6>
    </div>

    <ul class="px-3 space-y-3 text-justify list-disc list-inside rounded-md">
        <li>Your information will be used solely for processing your application, in compliance with the Data Privacy Act of 2012 (Republic Act No. 10173).</li>
        <li>By using this site, you consent to the collection, use, and processing of your personal information as necessary for entrance examination-related transactions.</li>
        <li>USM will take appropriate measures to protect your data from unauthorized access. However, it is your responsibility to maintain the confidentiality of your login credentials and to promptly report any suspected unauthorized use of your account.</li>
    </ul>

    <div class="flex gap-1 px-3 py-3 mt-5 mb-5 text-sm border border-yellow-200 rounded-md md:items-center text-black-500 bg-yellow-50">
        <h6 class="mb-1 font-bold">Use of Screenshots and System Content</h6>
    </div>

    <ul class="px-3 space-y-3 text-justify list-disc list-inside rounded-md">
        <li>Users are strictly prohibited from capturing, reproducing, posting, sharing, or distributing screenshots, screen recordings, reports, pages, or any other content from the USMCEE System that contains personal data or sensitive personal data without proper authorization and lawful basis.</li>
        <li>This includes, but is not limited to, applicant names, application numbers, examination results, rankings, admission status, contact information, uploaded documents, and other records that may directly or indirectly identify an individual.</li>
        <li>Any authorized use of screenshots or system images for official reporting, training, documentation, or presentation must ensure that all personal and identifiable information is fully removed, masked, blurred, anonymized, or replaced with approved sample or dummy data.</li>
        <li>Unauthorized disclosure or sharing of such content through social media, messaging applications, presentations, or other platforms may constitute a violation of Republic Act No. 10173, or the Data Privacy Act of 2012, and may subject the responsible party to administrative, civil, or criminal liability.</li>
    </ul>

    <div class="flex gap-1 px-3 py-3 mt-5 mb-5 text-sm border border-yellow-200 rounded-md md:items-center text-black-500 bg-yellow-50">
        <h6 class="mb-1 font-bold">Prohibition Against Fraud and Misrepresentation</h6>
    </div>

    <ul class="px-3 space-y-3 text-justify list-disc list-inside rounded-md">
        <li>Any form of fraud or misrepresentation, including the submission of falsified documents or impersonation, is strictly prohibited.</li>
        <li>USM reserves the right to take disciplinary and legal actions for fraudulent applications, including denial of admission and cancellation of registration.</li>
    </ul>

    <div class="flex gap-1 px-3 py-3 mt-5 mb-5 text-sm border border-yellow-200 rounded-md md:items-center text-black-500 bg-yellow-50">
        <h6 class="mb-1 font-bold">Use of the Web Application</h6>
    </div>

    <ul class="px-3 space-y-3 text-justify list-disc list-inside rounded-md">
        <li>This application is intended exclusively for entrance examination applications.</li>
        <li>Unauthorized uses, including disruptive or damaging activities, may result in suspension of access and possible legal action.</li>
    </ul>

    <div class="flex gap-1 px-3 py-3 mt-5 mb-5 text-sm border border-yellow-200 rounded-md md:items-center text-black-500 bg-yellow-50">
        <h6 class="mb-1 font-bold">Acceptance and Changes to Terms</h6>
    </div>

    <ul class="px-3 space-y-3 text-justify list-disc list-inside rounded-md">
        <li>By submitting your application, you acknowledge that you have read, understood, and agree to these Terms and Conditions.</li>
        <li>USM reserves the right to modify these Terms and Conditions as necessary to reflect changes in university policies or applicable laws. Any updates will be posted on this portal.</li>
    </ul>

    <div class="flex gap-1 px-3 py-3 mt-5 mb-5 text-sm border border-yellow-200 rounded-md md:items-center text-black-500 bg-yellow-50">
        <h6 class="mb-1 font-bold">Limitation of Liability</h6>
    </div>

    <ul class="px-3 space-y-3 text-justify list-disc list-inside rounded-md">
        <li>USM will not be liable for damages, losses, or liabilities arising from your use of this website, except as required by law.</li>
    </ul>
',
        ]);
    }
}
