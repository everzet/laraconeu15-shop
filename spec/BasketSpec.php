<?php

namespace spec;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class BasketSpec extends ObjectBehavior
{
    function it_accepts_products_from_the_catalogue(\Catalogue $catalogue)
    {
        $this->addProductFromCatalogue(\Sku::fromString('RS1'), $catalogue);
    }

    function it_can_tell_if_its_total_cost_matches_given_one()
    {
        $this->isTotalCost(\Cost::fromFloat(0.0))->shouldReturn(true);
        $this->isTotalCost(\Cost::fromFloat(10.0))->shouldReturn(false);
    }
}
