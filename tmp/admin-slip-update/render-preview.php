<?php
// Preview-only compatibility shim for sandbox file readability checks.
namespace Dompdf\Image { function is_readable($path) { return is_file($path); } }
namespace {
require 'C:/laragon/www/cee-admin/vendor/autoload.php';
$app = require 'C:/laragon/www/cee-admin/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();
$cee_reservation = (object) [
    'app_no' => '26310001', 'firstname' => '2027 NAME', 'lastname' => 'APELYIDO', 'middlename' => 'I', 'suffix' => '',
    'schedule' => '2026-11-30', 'time' => '7:00 AM - 9:00 AM', 'room_name' => 'CE - 12', 'campus' => 'Main Campus',
    'college_name' => 'College of Engineering and Information Technology', 'exam_session' => 'Batch 1',
    'is_repeat_exam' => 0, 'photo' => '../../usmcee/tmp/admin-slip-update/photo.jpg', 'map_file' => 'ceit',
];
$writer = new Endroid\QrCode\Writer\PngWriter();
$qr = new Endroid\QrCode\QrCode(data: '26310001,2027 NAME I APELYIDO', size: 300, margin: 10);
file_put_contents(__DIR__.'/qr.png', $writer->write($qr)->getString());
$qrCodeUrl = __DIR__.'/qr.png';
foreach (['standard', 'legacy'] as $case) {
    if ($case === 'legacy') {
        $cee_reservation->app_no = 'CEE-202601153636082304643';
        $cee_reservation->firstname = 'MARIA ANGELICA ISABELLA';
        $cee_reservation->lastname = 'DE LOS SANTOS';
        $cee_reservation->middlename = 'VILLANUEVA';
        $cee_reservation->suffix = 'JR.';
        $cee_reservation->map_file = 'not-present';
    }
    $html = view('admin.cee-slip.exam-slip', compact('cee_reservation', 'qrCodeUrl'))->render();
    if (substr_count($html, '<span class="requirement-checkbox"></span>') !== 6) throw new RuntimeException('Expected six checkboxes.');
    $pdf = Barryvdh\DomPDF\Facade\Pdf::loadHTML($html)->setOption('isRemoteEnabled', false)->setOption('chroot', [base_path(), __DIR__]);
    file_put_contents(__DIR__.'/admin-slip-'.$case.'.pdf', $pdf->output());
    echo $case.': '.$pdf->getDomPDF()->getCanvas()->get_page_count().' pages; 6 requirement checkboxes'.PHP_EOL;
}
}
