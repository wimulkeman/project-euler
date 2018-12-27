<?php
require_once 'vendor/autoload.php';

$solveProblem = !empty($_SERVER['argv'][1])
    ? (int) $_SERVER['argv'][1] : null ;

$timer = new \App\Service\Timer();

/**
 * == Problem 1 ==
 *
 * Multiples of 3 and 5
 *
 * If we list all the natural numbers below 10 that are multiples of 3 or 5, we get 3, 5, 6 and 9. The sum of these multiples is 23.
 *
 * Find the sum of all the multiples of 3 or 5 below 1000.
 *
 * @see https://projecteuler.net/problem=1
 */
if (!$solveProblem || $solveProblem === 1) {
    $timer->startTimer('Problem 1');

    $sumOfMultiplies = new \App\Service\SumOfMultiplies();
    $solution1 = $sumOfMultiplies->getSumOfAvailableMultiplyNumbers([3, 5], 1000);

    $timer->stopTimer('Problem 1');

    echo "Solution problem 1: $solution1\n";
}

echo <<<string
---------------------------
Time conversions:

    1000 ms = 1 second
       1 ms = 0.001 seconds
    
    1000 µs = 1 ms
       1 µs = 0.001 ms
       
    1000 ns = 1 µs
       1 ns = 0.001 µs
       
    1000 ps = 1 ns
       1 ps = 0.001 ns
---------------------------
string;

print_r($timer->getTimer());