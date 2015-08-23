<?php

namespace spec;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class BasketSpec extends ObjectBehavior
{
    function it_can_tell_if_its_total_cost_matches_given_one()
    {
        $this->isTotalCost(\Cost::fromFloat(0.0))->shouldReturn(true);
        $this->isTotalCost(\Cost::fromFloat(10.0))->shouldReturn(false);
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
