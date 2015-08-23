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

    function it_exposes_its_sku()
    {
        $this->sku()->shouldBeLike(\Sku::fromString('RS1'));
    }

    function it_exposes_its_cost()
    {
        $this->cost()->shouldBeLike(\Cost::fromFloat(12.3));
    }
}
