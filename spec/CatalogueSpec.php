<?php

namespace spec;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CatalogueSpec extends ObjectBehavior
{
    function it_accepts_product_to_add(\Product $aProduct)
    {
        $this->addProduct($aProduct);
    }
}
