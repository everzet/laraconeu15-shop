<?php

namespace spec;

use InvalidArgumentException;
use IteratorAggregate;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class InMemoryCatalogueSpec extends ObjectBehavior
{
    function it_is_IteratorAggregate()
    {
        $this->shouldHaveType(IteratorAggregate::class);
    }

    function it_stores_individual_products(\Product $aProduct)
    {
        $sku = \Sku::fromString('RS1');
        $aProduct->sku()->willReturn($sku);

        $this->addProduct($aProduct);
        $this->productWithSku($sku)->shouldReturn($aProduct);
    }

    function it_can_store_multiple_products(\Product $product1, \Product $product2)
    {
        $sku1 = \Sku::fromString('RS1');
        $product1->sku()->willReturn($sku1);

        $sku2 = \Sku::fromString('RS2');
        $product2->sku()->willReturn($sku2);

        $this->addProduct($product1);
        $this->addProduct($product2);

        $this->productWithSku($sku1)->shouldReturn($product1);
        $this->productWithSku($sku2)->shouldReturn($product2);
    }

    function it_can_return_iterator_for_stored_products(\Product $aProduct)
    {
        $this->getIterator()->shouldHaveCount(0);

        $aProduct->sku()->willReturn(\Sku::fromString('RS1'));
        $this->addProduct($aProduct);

        $this->getIterator()->shouldHaveCount(1);
    }

    function it_throws_an_exception_when_trying_to_retrieve_not_stored_product()
    {
        $this->shouldThrow(InvalidArgumentException::class)
            ->duringProductWithSku(\Sku::fromString('RS1'));
    }
}
