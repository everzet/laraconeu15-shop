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

    function it_is_initializable()
    {
        $this->shouldHaveType('Sku');
    }
}
