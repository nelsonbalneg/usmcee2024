<?php

namespace App\Services;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ReservationNumberAudit
{
    /** Numeric numbers seed counters; CEE-prefixed history occupies a separate namespace. */
    public function inspect(): array
    {
        $errors = [];
        $counters = [];
        $legacyCount = 0;
        $duplicates = DB::table('reservations')->select('app_no')
            ->groupBy('app_no')->havingRaw('COUNT(*) > 1')->pluck('app_no')->all();
        foreach ($duplicates as $number) {
            $errors[] = 'Duplicate application number: '.var_export($number, true);
        }
        foreach (DB::table('reservations')->orderBy('id')->lazyById(500) as $row) {
            $number = (string) $row->app_no;
            // Explicit legacy policy: preserve CEE- followed by digits verbatim.
            // These identifiers can never equal a new all-numeric application number.
            // Do not infer a sequence, date, or session from their opaque suffix.
            if (preg_match('/^CEE-[0-9]+$/D', $number)) {
                $legacyCount++;
                continue;
            }
            try {
                if (!$row->created_at || (int) $row->cee_session_id < 1) {
                    throw new \RuntimeException;
                }
                $year = Carbon::parse($row->created_at, config('app.timezone'))->setTimezone('Asia/Manila')->year;
                $prefix = substr((string) $year, -2).$row->cee_session_id;
                if (!preg_match('/^'.preg_quote($prefix, '/').'([0-9]{5})$/D', $number, $matches) || (int) $matches[1] < 1) {
                    throw new \RuntimeException;
                }
                if (!DB::table('cee_sessions')->where('id', $row->cee_session_id)->exists()) {
                    throw new \RuntimeException;
                }
                $key = $year.':'.$row->cee_session_id;
                $counters[$key] = [
                    'year' => $year, 'cee_session_id' => $row->cee_session_id,
                    'last_sequence' => max($counters[$key]['last_sequence'] ?? 0, (int) $matches[1]),
                ];
            } catch (\Throwable $e) {
                $errors[] = "Reservation {$row->id}: ambiguous/invalid app_no ".var_export($row->app_no, true)." (session {$row->cee_session_id}, created_at {$row->created_at}). Explicit legacy mapping required.";
            }
        }
        return ['errors' => $errors, 'counters' => array_values($counters), 'legacy_count' => $legacyCount];
    }

    public function assertValid(): array
    {
        $audit = $this->inspect();
        if ($audit['errors']) {
            throw new \RuntimeException(implode(PHP_EOL, $audit['errors']));
        }
        return $audit['counters'];
    }
}
