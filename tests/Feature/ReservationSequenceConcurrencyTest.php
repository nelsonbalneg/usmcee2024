<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\DB;
use Symfony\Component\Process\Process;
use Tests\TestCase;

class ReservationSequenceConcurrencyTest extends TestCase
{
    public function test_parallel_first_use_allocates_unique_committed_numbers(): void
    {
        if (getenv('RUN_RESERVATION_CONCURRENCY') !== '1') {
            $this->markTestSkipped('Requires an explicitly configured, migrated production-engine test database.');
        }
        $this->assertContains(DB::getDriverName(), ['mysql', 'pgsql', 'sqlsrv']);
        $this->assertStringEndsWith('_test', DB::connection()->getDatabaseName(), 'Use a dedicated database ending in _test.');
        $session = DB::table('cee_sessions')->insertGetId([
            'name' => 'Concurrency test', 'status' => 'inactive', 'created_at' => now(), 'updated_at' => now(),
        ]);
        $workers = [];
        try {
            for ($i = 0; $i < 8; $i++) {
                $worker = new Process([PHP_BINARY, base_path('tests/reservation-sequence-worker.php'), (string) $session], base_path());
                $worker->setTimeout(60);
                $worker->start();
                $workers[] = $worker;
            }
            foreach ($workers as $worker) {
                $worker->wait();
                $this->assertTrue($worker->isSuccessful(), $worker->getErrorOutput().$worker->getOutput());
            }
            $numbers = DB::table('reservations')->where('cee_session_id', $session)->pluck('app_no');
            $this->assertCount(40, $numbers);
            $this->assertCount(40, $numbers->unique());
            $this->assertSame(40, (int) DB::table('reservation_sequences')->where('cee_session_id', $session)->value('last_sequence'));
        } finally {
            foreach ($workers as $worker) { if ($worker->isRunning()) { $worker->stop(); } }
            DB::table('reservations')->where('cee_session_id', $session)->delete();
            DB::table('reservation_sequences')->where('cee_session_id', $session)->delete();
            DB::table('cee_sessions')->where('id', $session)->delete();
        }
    }
}
