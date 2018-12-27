<?php

namespace spec\App\Service;

use App\Service\SumOfMultiplies;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SumOfMultipliesSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(SumOfMultiplies::class);
    }

    function it_returns_the_sum_of_all_the_available_multiplication_numbers()
    {
        $this->getSumOfAvailableMultiplyNumbers([3, 5], 10)
            ->shouldReturn(23);

        $this->getSumOfAvailableMultiplyNumbers([3, 5, 11], 10)
            ->shouldReturn(23);

        $this->getSumOfAvailableMultiplyNumbers([11], 10)
            ->shouldReturn(0);
    }
}
