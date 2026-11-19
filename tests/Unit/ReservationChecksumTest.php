<?php

namespace Tests\Unit;

use App\Services\ReservationChecksum;
use PHPUnit\Framework\TestCase;

class ReservationChecksumTest extends TestCase
{
    public function test_multiplies_first_two_digits_and_adds_remaining_digits(): void
    {
        $this->assertSame(17, ReservationChecksum::calculate('26310001'));
        $this->assertSame(18, ReservationChecksum::calculate('26310002'));
        $this->assertSame(0, ReservationChecksum::calculate('0000'));
    }

    public function test_legacy_and_missing_numbers_have_no_checksum(): void
    {
        $this->assertNull(ReservationChecksum::calculate('CEE-20261119'));
        $this->assertNull(ReservationChecksum::calculate(null));
        $this->assertNull(ReservationChecksum::calculate(''));
        $this->assertNull(ReservationChecksum::calculate('2'));
    }
}
