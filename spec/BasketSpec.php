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
}
