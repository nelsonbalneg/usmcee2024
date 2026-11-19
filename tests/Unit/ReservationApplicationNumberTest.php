<?php

namespace Tests\Unit;

use App\Services\ReservationApplicationNumber;
use Illuminate\Support\Carbon;
use Mockery;
use PHPUnit\Framework\Attributes\PreserveGlobalState;
use PHPUnit\Framework\Attributes\RunTestsInSeparateProcesses;
use Tests\TestCase;

#[RunTestsInSeparateProcesses]
#[PreserveGlobalState(false)]
class ReservationApplicationNumberTest extends TestCase
{
    protected function tearDown(): void
    {
        Carbon::setTestNow();
        parent::tearDown();
    }

    public function test_first_number_matches_requested_format(): void
    {
        Carbon::setTestNow(Carbon::parse('2026-11-19'));
        $model = Mockery::mock('alias:App\Models\Reservation');
        $count = Mockery::mock();
        $count->shouldReceive('count')->once()->andReturn(0);
        $model->shouldReceive('where')->with('cee_session_id', 3)->once()->andReturn($count);
        $exists = Mockery::mock();
        $exists->shouldReceive('exists')->once()->andReturn(false);
        $model->shouldReceive('where')->with('app_no', '26310001')->once()->andReturn($exists);

        $this->assertSame('26310001', (new ReservationApplicationNumber)->next(3));
    }

    public function test_uses_session_count_and_skips_existing_numbers(): void
    {
        Carbon::setTestNow(Carbon::parse('2026-11-19'));
        $model = Mockery::mock('alias:App\Models\Reservation');
        $count = Mockery::mock();
        $count->shouldReceive('count')->once()->andReturn(10015);
        $model->shouldReceive('where')->with('cee_session_id', 3)->once()->andReturn($count);
        foreach (['26310015' => true, '26310016' => true, '26310017' => false] as $number => $taken) {
            $exists = Mockery::mock();
            $exists->shouldReceive('exists')->once()->andReturn($taken);
            $model->shouldReceive('where')->with('app_no', (string) $number)->once()->andReturn($exists);
        }

        $this->assertSame('26310017', (new ReservationApplicationNumber)->next(3));
    }

    public function test_large_count_is_used_without_adding_10000(): void
    {
        Carbon::setTestNow(Carbon::parse('2026-11-19'));
        $model = Mockery::mock('alias:App\Models\Reservation');
        $count = Mockery::mock();
        $count->shouldReceive('count')->once()->andReturn(18123);
        $model->shouldReceive('where')->with('cee_session_id', 3)->once()->andReturn($count);
        $exists = Mockery::mock();
        $exists->shouldReceive('exists')->once()->andReturn(false);
        $model->shouldReceive('where')->with('app_no', '26318123')->once()->andReturn($exists);

        $this->assertSame('26318123', (new ReservationApplicationNumber)->next(3));
    }

    public function test_count_eleven_produces_10011_suffix(): void
    {
        Carbon::setTestNow(Carbon::parse('2026-11-19'));
        $model = Mockery::mock('alias:App\Models\Reservation');
        $count = Mockery::mock();
        $count->shouldReceive('count')->once()->andReturn(11);
        $model->shouldReceive('where')->with('cee_session_id', 3)->once()->andReturn($count);
        $exists = Mockery::mock();
        $exists->shouldReceive('exists')->once()->andReturn(false);
        $model->shouldReceive('where')->with('app_no', '26310011')->once()->andReturn($exists);

        $this->assertSame('26310011', (new ReservationApplicationNumber)->next(3));
    }
}
