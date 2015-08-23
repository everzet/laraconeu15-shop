<?php

namespace spec;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class BasketSpec extends ObjectBehavior
{
    function it_costs_nothing_when_empty()
    {
        $this->isTotalCost(\Cost::fromFloat(0.0))->shouldReturn(true);
    }

    function it_properly_calculates_delivery_cost_for_cheap_products(
        \Catalogue $catalogue, \Product $aProduct
    ) {
        $catalogue->productWithSku(\Sku::fromString('RS1'))->willReturn($aProduct);
        $aProduct->cost()->willReturn(\Cost::fromFloat(5.0));

        $this->addProductFromCatalogue(\Sku::fromString('RS1'), $catalogue);
        $this->isTotalCost(\Cost::fromFloat(9.0))->shouldReturn(true);
    }
}
