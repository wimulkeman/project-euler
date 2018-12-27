<?php

namespace App\DataTransformer;

class BytesToAReadableFormat
{
    public function transform(int $sizeInBytes): string
    {
        $isNegative = $sizeInBytes < 0;
        $sizeInBytes = \abs($sizeInBytes);

        $availableDescription = [
            'bytes',
            'KB',
            'MB',
            'GB',
            'TB',
        ];

        foreach ($availableDescription as $exponent => $readableSizeDescription) {
            if ($exponent === 0 && $sizeInBytes < 1024) {
                break;
            }

            if ($sizeInBytes >= \pow(1024, $exponent)
                && $sizeInBytes < \pow(1024, $exponent + 1)
            ) {
                break;
            }
        }

        $fullDescription = \round($sizeInBytes / \pow(1024, $exponent), 2) . ' ' . $readableSizeDescription;

        if ($isNegative) {
            $fullDescription = "-$fullDescription";
        }

        return $fullDescription;
    }
}
