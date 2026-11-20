<?php

namespace Tests\Unit;

use App\Exceptions\ReservationSequenceExhausted;
use App\Services\ReservationApplicationNumber;
use App\Services\ReservationNumberAudit;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class ReservationApplicationNumberTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        // Isolated connection: never run destructive schema setup against the application DB.
        config(['database.default' => 'sequence_test', 'database.connections.sequence_test' => [
            'driver' => 'sqlite', 'database' => ':memory:', 'prefix' => '',
        ]]);
        Schema::create('operation_logs', function (Blueprint $t) {
            $t->id(); $t->integer('user_id')->nullable(); $t->string('model'); $t->string('action'); $t->text('data')->nullable(); $t->timestamps();
        });
        Schema::create('cee_sessions', function (Blueprint $t) { $t->id(); });
        Schema::create('reservations', function (Blueprint $t) {
            $t->id(); $t->integer('cee_session_id'); $t->string('app_no')->unique();
            $t->integer('checksum')->nullable(); $t->timestamps();
        });
        (require database_path('migrations/2026_11_20_000001_create_reservation_sequences_table.php'))->up();
        DB::table('cee_sessions')->insert([['id' => 3], ['id' => 14]]);
        Carbon::setTestNow(Carbon::parse('2026-11-20', 'Asia/Manila'));
    }

    protected function tearDown(): void
    {
        Carbon::setTestNow();
        DB::purge('sequence_test');
        parent::tearDown();
    }

    private function create(int $session = 3): \App\Models\Reservation
    {
        return app(ReservationApplicationNumber::class)->createReservation($session, []);
    }

    public function test_padded_sequences_and_independent_sessions_and_years(): void
    {
        for ($i = 1; $i <= 101; $i++) {
            $this->assertSame('263'.str_pad($i, 5, '0', STR_PAD_LEFT), $this->create()->app_no);
        }
        $this->assertSame('261400001', $this->create(14)->app_no);
        Carbon::setTestNow(Carbon::parse('2027-01-01', 'Asia/Manila'));
        $this->assertSame('27300001', $this->create()->app_no);
    }

    public function test_deleted_numbers_are_not_reused(): void
    {
        $this->create()->delete();
        $this->assertSame('26300002', $this->create()->app_no);
    }

    public function test_caller_rollback_reverts_allocation_and_reservation(): void
    {
        try {
            DB::transaction(function () { $this->create(); throw new \RuntimeException('failure'); });
        } catch (\RuntimeException $e) {
            $this->assertSame('failure', $e->getMessage());
        }
        $this->assertSame(0, DB::table('reservations')->count());
        $this->assertSame('26300001', $this->create()->app_no);
    }

    public function test_unique_constraint_rejects_duplicate(): void
    {
        $number = $this->create()->app_no;
        $this->expectException(\Illuminate\Database\QueryException::class);
        DB::table('reservations')->insert(['cee_session_id' => 3, 'app_no' => $number]);
    }

    public function test_overflow_does_not_create_reservation(): void
    {
        $this->create();
        DB::table('reservation_sequences')->update(['last_sequence' => 99999]);
        try { $this->create(); $this->fail('Expected overflow'); }
        catch (ReservationSequenceExhausted $e) {
            $this->assertSame(1, DB::table('reservations')->count());
            $this->assertSame(99999, DB::table('reservation_sequences')->value('last_sequence'));
        }
    }

    public function test_missing_session_is_rejected(): void
    {
        $this->expectException(\Illuminate\Database\Eloquent\ModelNotFoundException::class);
        $this->create(999);
    }

    public function test_historical_high_water_mark_preserves_legacy_number(): void
    {
        DB::table('reservations')->insert(['cee_session_id' => 3, 'app_no' => '26310017',
            'created_at' => '2026-11-01 00:00:00', 'updated_at' => '2026-11-01 00:00:00']);
        (require database_path('migrations/2026_11_20_000001_create_reservation_sequences_table.php'))->up();
        $this->assertSame('26310018', $this->create()->app_no);
        $this->assertTrue(DB::table('reservations')->where('app_no', '26310017')->exists());
    }

    public function test_cee_prefixed_history_is_preserved_without_consuming_numeric_sequences(): void
    {
        $numbers = ['CEE-202601153636082304643', 'CEE-202601153871382304644', 'CEE-202601153873662304645'];
        foreach ($numbers as $number) {
            DB::table('reservations')->insert(['cee_session_id' => 3, 'app_no' => $number,
                'created_at' => '2026-01-15 07:32:39.500']);
        }
        $audit = app(ReservationNumberAudit::class)->inspect();
        $this->assertSame([], $audit['errors']);
        $this->assertSame(3, $audit['legacy_count']);
        $this->assertSame([], $audit['counters']);
        (require database_path('migrations/2026_11_20_000001_create_reservation_sequences_table.php'))->up();
        $this->assertSame('26300001', $this->create()->app_no);
        $this->assertSame($numbers, DB::table('reservations')->where('app_no', 'like', 'CEE-%')->orderBy('id')->pluck('app_no')->all());
    }

    public function test_mixed_legacy_and_numeric_history_uses_numeric_high_water_mark(): void
    {
        foreach (['CEE-202601153636082304643', '26310017'] as $number) {
            DB::table('reservations')->insert(['cee_session_id' => 3, 'app_no' => $number,
                'created_at' => '2026-01-15 07:32:39']);
        }
        (require database_path('migrations/2026_11_20_000001_create_reservation_sequences_table.php'))->up();
        $this->assertSame('26310018', $this->create()->app_no);
    }

    public function test_malformed_cee_number_still_blocks_migration(): void
    {
        DB::table('reservations')->insert(['cee_session_id' => 3, 'app_no' => 'CEE-invalid',
            'created_at' => '2026-01-15']);
        $this->expectException(\RuntimeException::class);
        app(ReservationNumberAudit::class)->assertValid();
    }

    public function test_ambiguous_history_blocks_initialization(): void
    {
        DB::table('reservations')->insert(['cee_session_id' => 3, 'app_no' => 'legacy', 'created_at' => '2026-11-01']);
        $this->expectException(\RuntimeException::class);
        app(ReservationNumberAudit::class)->assertValid();
    }
}
