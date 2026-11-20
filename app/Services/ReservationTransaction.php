<?php

namespace App\Services;

use App\Exceptions\ReservationDatabaseBusy;
use Closure;
use Illuminate\Database\DetectsConcurrencyErrors;
use Illuminate\Support\Facades\DB;
use PDOException;
use Throwable;

class ReservationTransaction
{
    use DetectsConcurrencyErrors;

    /** Retry the entire operation only after rollback, never inside a caller's transaction. */
    public function run(Closure $operation): mixed
    {
        if (DB::transactionLevel() > 0) {
            return DB::transaction($operation, 1);
        }

        for ($attempt = 1; $attempt <= 5; $attempt++) {
            try {
                return DB::transaction($operation, 1);
            } catch (Throwable $error) {
                if (!$this->retryable($error) || DB::transactionLevel() !== 0) {
                    throw $error;
                }
                if ($attempt === 5) {
                    throw new ReservationDatabaseBusy('Reservation service is busy. Please try again shortly.', 0, $error);
                }
                // No database locks are held while backing off. Jitter separates competing retries.
                $this->pause($attempt);
            }
        }
    }

    private function retryable(Throwable $error): bool
    {
        if ($this->causedByConcurrencyError($error)) {
            return true;
        }
        // PDO SQL Server reports lock timeout (1222) and deadlock victim (1205) here.
        return $error instanceof PDOException
            && DB::getDriverName() === 'sqlsrv'
            && in_array((int) ($error->errorInfo[1] ?? 0), [1205, 1222], true);
    }

    protected function pause(int $attempt): void
    {
        $ceiling = min(400, 50 * (2 ** ($attempt - 1)));
        usleep(random_int((int) ($ceiling / 2), $ceiling) * 1000);
    }
}
