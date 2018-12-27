<?php

namespace spec\App\DataTransformer;

use App\DataTransformer\MicrosecondsToReadableTime;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MicrosecondsToReadableTimeSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(MicrosecondsToReadableTime::class);
    }

    function it_transforms_time_to_a_readable_format()
    {
        $this->transform(10)->shouldReturn('10 seconds');
        $this->transform(1)->shouldReturn('1 seconds');
        $this->transform(0.1)->shouldReturn('0.1 seconds');

        $this->transform(0.01)->shouldReturn('10 ms');
        $this->transform(0.001)->shouldReturn('1 ms');

        $this->transform(0.0001)->shouldReturn('100 µs');
        $this->transform(0.00001)->shouldReturn('10 µs');
        $this->transform(0.000001)->shouldReturn('1 µs');

        $this->transform(0.0000001)->shouldReturn('100 ns');
        $this->transform(0.00000001)->shouldReturn('10 ns');
        $this->transform(0.000000001)->shouldReturn('1 ns');

        $this->transform(0.0000000001)->shouldReturn('100 ps');
        $this->transform(0.00000000001)->shouldReturn('10 ps');
        $this->transform(0.000000000001)->shouldReturn('1 ps');
    }
}
