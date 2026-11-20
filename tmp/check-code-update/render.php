<?php
namespace Dompdf\Image { function is_readable($path) { return is_file($path); } }
namespace {
$side = $argv[1] ?? 'student';
$root = $side === 'admin' ? 'C:/laragon/www/cee-admin' : 'C:/laragon/www/usmcee';
require $root.'/vendor/autoload.php';
$app = require $root.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();
$cee_reservation = (object) [
    'app_no' => '26310001', 'checksum' => 17, 'firstname' => '2027 NAME', 'lastname' => 'APELYIDO', 'middlename' => 'I', 'suffix' => '',
    'schedule' => '2026-11-30', 'time' => '7:00 AM - 9:00 AM', 'room_name' => 'CE - 12', 'campus' => 'Main Campus',
    'college_name' => 'College of Engineering and Information Technology', 'exam_session' => 'Batch 1',
    'is_repeat_exam' => 0, 'photo' => '../../usmcee/tmp/admin-slip-update/photo.jpg', 'map_file' => 'ceit',
];

$cee_reservation->photo = $side === 'admin' ? '../../usmcee/tmp/admin-slip-update/photo.jpg' : '../tmp/admin-slip-update/photo.jpg';
$qrCodeUrl = 'C:/laragon/www/usmcee/tmp/admin-slip-update/qr.png';
foreach (['standard' => 17, 'leading-zero' => '01', 'zero' => 0, 'missing' => null, 'long-name' => 17] as $case => $checksum) {
    $cee_reservation->checksum = $checksum;
    if ($case === 'long-name') {
        $cee_reservation->firstname = 'MARIA ANGELICA ISABELLA';
        $cee_reservation->lastname = 'DE LOS SANTOS';
        $cee_reservation->middlename = 'VILLANUEVA';
        $cee_reservation->suffix = 'JR.';
        $cee_reservation->app_no = 'CEE-202601153636082304643';
    }
    $html = view($side === 'admin' ? 'admin.cee-slip.exam-slip' : 'student.cee-slip.exam-slip', compact('cee_reservation', 'qrCodeUrl'))->render();
    $doc = new DOMDocument(); libxml_use_internal_errors(true); $doc->loadHTML($html); libxml_clear_errors();
    $xpath = new DOMXPath($doc);
    $footerCode = $xpath->query('//div[@class="footer"]//span[@class="footer-reference"]')->item(0)?->textContent;
    if ($footerCode !== (string) ($checksum ?? 'N/A') || str_contains($html, 'Check Code')) throw new RuntimeException('Incorrect footer code: '.$case);
    $pdf = Barryvdh\DomPDF\Facade\Pdf::loadHTML($html)->setOption('isRemoteEnabled', false)->setOption('chroot', [$root, 'C:/laragon/www/usmcee/tmp/admin-slip-update']);
    $bytes = $pdf->output();
    file_put_contents(__DIR__.'/'.$side.'-'.$case.'.pdf', $bytes);
    $pages = $pdf->getDomPDF()->getCanvas()->get_page_count();
    echo $side.' '.$case.': '.$pages.' pages; footer value = '.($checksum ?? 'N/A').PHP_EOL;
    if ($case === 'standard') file_put_contents('C:/laragon/www/usmcee/output/pdf/'.$side.'-check-code-preview.pdf', $bytes);
}
}
