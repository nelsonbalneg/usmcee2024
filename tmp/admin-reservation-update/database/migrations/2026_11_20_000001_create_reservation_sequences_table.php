<?php

use App\Services\ReservationNumberAudit;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Run with ALL reservation writers stopped; MySQL DDL implicitly commits.
        $counters = app(ReservationNumberAudit::class)->assertValid();
        if (!Schema::hasTable('reservation_sequences')) {
            Schema::create('reservation_sequences', function (Blueprint $table) {
                $table->id();
                $table->unsignedSmallInteger('year');
                $table->unsignedBigInteger('cee_session_id');
                $table->unsignedInteger('last_sequence')->default(0);
                $table->timestamps();
                $table->unique(['year', 'cee_session_id']);
            });
        }
        DB::transaction(function () use ($counters) {
            foreach ($counters as $counter) {
                $existing = DB::table('reservation_sequences')->where('year', $counter['year'])
                    ->where('cee_session_id', $counter['cee_session_id'])->lockForUpdate()->first();
                $counter['last_sequence'] = max($counter['last_sequence'], $existing->last_sequence ?? 0);
                DB::table('reservation_sequences')->updateOrInsert([
                    'year' => $counter['year'], 'cee_session_id' => $counter['cee_session_id'],
                ], $counter + ['created_at' => now(), 'updated_at' => now()]);
            }
        });
        if (!Schema::hasIndex('reservations', 'reservations_app_no_unique')) {
            Schema::table('reservations', fn (Blueprint $table) => $table->unique('app_no', 'reservations_app_no_unique'));
        }
    }

    public function down(): void
    {
        throw new RuntimeException('Sequence high-water marks must be preserved. Use a reviewed forward migration.');
    }
};
