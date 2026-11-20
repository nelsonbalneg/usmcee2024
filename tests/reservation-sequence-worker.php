<?php

require __DIR__.'/../vendor/autoload.php';
$app = require __DIR__.'/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();
if (getenv('RUN_RESERVATION_CONCURRENCY') !== '1' ||
    !str_ends_with(Illuminate\Support\Facades\DB::connection()->getDatabaseName(), '_test')) {
    throw new RuntimeException('Dedicated test database required.');
}
for ($i = 0; $i < 5; $i++) {
    app(App\Services\ReservationApplicationNumber::class)->createReservation((int) $argv[1], [
        'user_id' => 1, 'campus_id' => '1', 'firstpriorty' => 'Test',
        'exam_session' => 'AM', 'room_id' => 1, 'status' => 'pending',
    ]);
}
