<?php

namespace App\Services;

class ReservationChecksum
{
    public static function calculate(?string $applicationNumber): ?int
    {
        if ($applicationNumber === null || !preg_match('/^[0-9]{2,}$/D', $applicationNumber)) {
            return null;
        }

        $checksum = (int) $applicationNumber[0] * (int) $applicationNumber[1];
        for ($index = 2; $index < strlen($applicationNumber); $index++) {
            $checksum += (int) $applicationNumber[$index];
        }

        return $checksum;
    }
}
