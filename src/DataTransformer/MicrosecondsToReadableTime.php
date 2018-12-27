<?php

namespace App\DataTransformer;

class MicrosecondsToReadableTime
{
    public function transform(float $timeInSeconds): string
    {
        if ($timeInSeconds < 0.000000001) {
            $exponent = 12;
            $timeDescription = 'ps';
        } elseif ($timeInSeconds < 0.000001) {
            $exponent = 9;
            $timeDescription = 'ns';
        } elseif ($timeInSeconds < 0.001) {
            $exponent = 6;
            $timeDescription = 'µs';
        } elseif ($timeInSeconds < 0.1) {
            $exponent = 3;
            $timeDescription = 'ms';
        } else {
            $exponent = 0;
            $timeDescription = 'seconds';
        }

        return $timeInSeconds * \pow(10, $exponent) . ' ' . $timeDescription;
    }
}
