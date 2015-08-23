<?php

namespace spec;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SkuSpec extends ObjectBehavior
{
    const SKU_STRING = 'RS1';

    function let()
    {
        $this->beConstructedThrough('fromString', [self::SKU_STRING]);
    }

    function it_can_be_converted_back_to_string()
    {
        $this->__toString()->shouldReturn(self::SKU_STRING);
    }
}
