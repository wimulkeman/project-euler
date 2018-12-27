<?php

namespace spec\App\DataTransformer;

use App\DataTransformer\BytesToAReadableFormat;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class BytesToAReadableFormatSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(BytesToAReadableFormat::class);
    }

    function it_transforms_the_bytes_to_a_readable_format()
    {
        $this->transform(0)->shouldReturn('0 bytes');
        $this->transform(20)->shouldReturn('20 bytes');
        $this->transform(-20)->shouldReturn('-20 bytes');

        $this->transform(1024)->shouldReturn('1 KB');
        $this->transform(2224)->shouldReturn('2.17 KB');

        $this->transform(1048576)->shouldReturn('1 MB');
        $this->transform(2348576)->shouldReturn('2.24 MB');
    }
}
