<?php

class Catalogue implements IteratorAggregate
{
    private $products = [];

    public function addProduct(Product $product)
    {
        $this->products[(string)$product->sku()] = $product;
    }

    public function productWithSku(Sku $sku)
    {
        if (!isset($this->products[(string)$sku])) {
            throw new InvalidArgumentException("Product with sku {$sku} is not in the catalogue.");
        }

        return $this->products[(string)$sku];
    }

    public function getIterator()
    {
        return new ArrayIterator(array_values($this->products));
    }
}
