<?php

declare(strict_types = 1);


namespace App\Service;

class SumOfMultiplies
{
    public function getSumOfAvailableMultiplyNumbers(array $dividableBy, int $belowNumber): int
    {
        $sumOfMultiplies = 0;

        for ($i = 1; $i < $belowNumber; $i ++) {
            if ($i % 3 && $i % 5) {
                continue;
            }

            foreach ($dividableBy as $dividableNumber) {
                if ($i % $dividableNumber) {
                    continue;
                }

                $sumOfMultiplies += $i;
                break;
            }
        }

        return $sumOfMultiplies;
    }
}
