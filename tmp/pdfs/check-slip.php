<?php
require __DIR__.'/../../vendor/autoload.php';
$source = file_get_contents(__DIR__.'/../../resources/views/student/cee-slip/exam-slip.blade.php');
preg_match('~<style>(.*?)</style>~s', $source, $styles);
preg_match('~<table class="requirements">.*?</table>~s', $source, $requirements);
$pdf = new Dompdf\Dompdf();
$pdf->loadHtml('<html><head><style>'.$styles[1].'</style></head><body><div class="section-title">Examination-day requirements</div>'.$requirements[0].'</body></html>');
$pdf->render();
file_put_contents(__DIR__.'/checkbox-preview.pdf', $pdf->output());
echo substr_count($source, '<span class="requirement-checkbox"></span>')." checkboxes\n";
