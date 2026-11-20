<?php

namespace Tests\Unit;

use App\Exceptions\ReservationDatabaseBusy;
use App\Services\ReservationTransaction;
use Illuminate\Support\Facades\DB;
use PDOException;
use Tests\TestCase;

class ReservationTransactionTest extends TestCase
{
    private function runner(): ReservationTransaction
    {
        return new class extends ReservationTransaction {
            protected function pause(int $attempt): void {}
        };
    }

    public function test_sql_server_timeout_retries_the_whole_operation(): void
    {
        $error = new PDOException('Lock request time out period exceeded.');
        $error->errorInfo = ['HY000', 1222, $error->getMessage()];
        DB::shouldReceive('transactionLevel')->andReturn(0);
        DB::shouldReceive('getDriverName')->once()->andReturn('sqlsrv');
        $calls = 0;
        DB::shouldReceive('transaction')->twice()->with(\Mockery::type(\Closure::class), 1)
            ->andReturnUsing(fn ($callback) => $callback());
        $result = $this->runner()->run(function () use (&$calls, $error) {
            if (++$calls === 1) { throw $error; }
            return 'committed';
        });
        $this->assertSame('committed', $result);
        $this->assertSame(2, $calls);
    }

    public function test_repeated_deadlocks_stop_after_five_attempts(): void
    {
        DB::shouldReceive('transactionLevel')->andReturn(0);
        $calls = 0;
        DB::shouldReceive('transaction')->times(5)->with(\Mockery::type(\Closure::class), 1)
            ->andReturnUsing(fn ($callback) => $callback());
        try {
            $this->runner()->run(function () use (&$calls) {
                $calls++;
                throw new PDOException('deadlock detected', 40001);
            });
            $this->fail('Expected busy exception');
        } catch (ReservationDatabaseBusy $error) {
            $this->assertSame(5, $calls);
            $this->assertInstanceOf(PDOException::class, $error->getPrevious());
        }
    }

    public function test_non_transient_failures_are_not_retried(): void
    {
        DB::shouldReceive('transactionLevel')->once()->andReturn(0);
        DB::shouldReceive('transaction')->once()->andThrow(new \RuntimeException('Invalid reservation'));
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Invalid reservation');
        $this->runner()->run(fn () => null);
    }

    public function test_nested_transaction_leaves_retries_to_its_caller(): void
    {
        DB::shouldReceive('transactionLevel')->once()->andReturn(1);
        DB::shouldReceive('transaction')->once()->with(\Mockery::type(\Closure::class), 1)
            ->andThrow(new PDOException('deadlock detected', 40001));
        $this->expectException(PDOException::class);
        $this->runner()->run(fn () => null);
    }
}
