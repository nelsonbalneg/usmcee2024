<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   public function run(): void
    {
        DB::table('faqs')->insert([
            [
                'question' => 'What should I do if I cannot log in and receive the message “Log in failed. Check your credentials”?',
                'answer' => '
                    <p>If you see the message <strong>“Log in failed. Check your credentials,”</strong> it means that your username or password may be incorrect.</p>
                    <p>You can recover your account by clicking <strong>“Forgot Password”</strong> and following the steps using the details you provided during account creation.</p>
                    <p>If you still need assistance, you may contact <a href="https://agapay.usm.edu.ph" target="_blank">Agapay</a>, email us at <strong>uicto@usm.edu.ph</strong>, or visit the UICTO office.</p>
                ',
                'sort_order' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'question' => 'For retakers, when will the results be released, and how can they enroll if they pass?',
                'answer' => '
                    <p>Retakers will be notified through their USMCEE dashboard if they qualify in their first-choice program.</p>
                    <p>Applicants enrolled in another institution shall be classified as <strong>transferees</strong> and must comply with transfer admission requirements.</p>
                    <p>Applicants currently enrolled at the University of Southern Mindanao shall be considered <strong>shifters</strong> and will undergo evaluation based on university policies.</p>
                    <ul>
                        <li>Shifters who wish to go back to zero shall confirm enrollment with freshmen and transferees.</li>
                        <li>Those who wish to credit previous courses must wait for the open enrollment schedule.</li>
                    </ul>
                ',
                'sort_order' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'question' => 'For freshmen, is enrollment done on campus or online?',
                'answer' => '
                    <p>Enrollment for incoming freshmen is conducted <strong>online</strong>, except for programs requiring additional in-person procedures.</p>
                    <p>After confirming your program, you must submit original admission requirements to the <strong>Admission and Records Office</strong> by scheduled appointment.</p>
                    <p>Please refer to your USMCEE dashboard for complete instructions before visiting the university.</p>
                ',
                'sort_order' => 3,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'question' => 'Is it possible to log in using a different Gmail account?',
                'answer' => '
                    <p>No. You must use the <strong>same email address</strong> used during your examination slot reservation.</p>
                    <p>The University emphasizes securing your login credentials to ensure successful access to the USMCEE portal.</p>
                ',
                'sort_order' => 4,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'question' => 'How will I know if I passed?',
                'answer' => '
                    <p>Applicants will be notified through their <strong>USMCEE dashboard</strong> if they qualify in their first priority program.</p>
                    <p>First-priority qualifiers will be released on <strong>March 19, 2026</strong>.</p>
                    <p>If you do not confirm your slot, you may wait until <strong>March 25, 2026</strong> for additional confirmation slots.</p>
                    <p><strong>Note:</strong> Confirmation does not guarantee admission, as final acceptance is based on ranking.</p>
                ',
                'sort_order' => 5,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
