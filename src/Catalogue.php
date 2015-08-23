<?php

interface Catalogue extends IteratorAggregate
{
    public function addProduct(Product $product);

    public function productWithSku(Sku $sku);
}
