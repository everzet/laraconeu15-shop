<?php

namespace spec;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CatalogueSpec extends ObjectBehavior
{
    function it_stores_individual_products(\Product $aProduct)
    {
        $sku = \Sku::fromString('RS1');
        $aProduct->sku()->willReturn($sku);

        $this->addProduct($aProduct);
        $this->productWithSku($sku)->shouldReturn($aProduct);
    }
}
