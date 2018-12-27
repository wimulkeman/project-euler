<?php

declare(strict_types = 1);


namespace App\Service;

class SumOfMultiplies
{
    public function getSumOfAvailableMultiplyNumbers(array $dividableBy, int $belowNumber): int
    {
        $maxNumber = $belowNumber - 1;

        $multiplications = [];

        foreach ($dividableBy as $multiplyNumber) {
            if ($multiplyNumber > $maxNumber) {
                continue;
            }

            $numberOfMultiplications = \floor($maxNumber / $multiplyNumber);

            for ($i = 1; $i <= $numberOfMultiplications; $i ++) {
                $multiplications[] = $i * $multiplyNumber;
            }
        }

        return \array_sum(\array_unique($multiplications));
    }
}
