<?php

namespace App\Console\Commands;

use App\Services\ReservationNumberAudit;
use Illuminate\Console\Command;

class AuditReservationNumbers extends Command
{
    protected $signature = 'reservations:audit-numbers';
    protected $description = 'Read-only audit of historical application numbers before sequence migration';

    public function handle(ReservationNumberAudit $audit): int
    {
        $result = $audit->inspect();
        foreach ($result['errors'] as $error) {
            $this->error($error);
        }
        $this->info(count($result['counters']).' year/session counters identified.');
        $this->info($result['legacy_count'].' CEE-prefixed legacy numbers preserved outside the numeric sequence.');
        return $result['errors'] ? self::FAILURE : self::SUCCESS;
    }
}
