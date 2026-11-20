<?php

namespace Tests\Feature;

use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class ExaminationSlipCheckCodeTest extends TestCase
{
    public static function codes(): array
    {
        return ['saved value' => [17, '17'], 'leading zero' => ['01', '01'], 'zero' => [0, '0'], 'missing legacy value' => [null, 'N/A']];
    }

    #[DataProvider('codes')]
    public function test_saved_code_is_displayed_only_after_the_footer_date_without_a_label($storedCode, string $expected): void
    {
        $cee_reservation = (object) [
            'app_no' => '26310001', 'checksum' => $storedCode, 'lastname' => 'TEST', 'firstname' => 'Applicant',
            'middlename' => '', 'suffix' => '', 'schedule' => '2026-11-30', 'time' => '7:00 AM - 9:00 AM',
            'room_name' => 'CE - 12', 'campus' => 'Main Campus', 'college_name' => 'Engineering',
            'exam_session' => 'Batch 1', 'is_repeat_exam' => 0, 'photo' => '', 'map_file' => 'not-present',
        ];
        $qrCodeUrl = 'existing-verification-qr.png';
        $html = view('admin.cee-slip.exam-slip', compact('cee_reservation', 'qrCodeUrl'))->render();
        $doc = new \DOMDocument();
        $previous = libxml_use_internal_errors(true);
        $doc->loadHTML($html);
        libxml_clear_errors(); libxml_use_internal_errors($previous);
        $xpath = new \DOMXPath($doc);
        $this->assertSame(1, $xpath->query('//div[@class="footer"]//span[@class="footer-reference"]')->length);
        $this->assertSame($expected, $xpath->query('//div[@class="footer"]//span[@class="footer-reference"]')->item(0)->textContent);
        $this->assertStringNotContainsString('Check Code', $html);
        $this->assertSame(0, $xpath->query('//div[@class="check-code"]')->length);
        $this->assertSame(2, $xpath->query('//img[@src="existing-verification-qr.png"]')->length);
        $this->assertStringContainsString('size: A4 portrait', $html);
    }
}
