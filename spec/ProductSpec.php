<?php

namespace spec;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ProductSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedThrough('withSkuAndCost', [
            \Sku::fromString('RS1'),
            \Cost::fromFloat(12.3)
        ]);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Product');
    }
}
