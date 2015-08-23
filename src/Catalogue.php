<?php

class Catalogue
{
    private $products = [];

    public function addProduct(Product $product)
    {
        $this->products[(string)$product->sku()] = $product;
    }

    public function productWithSku(Sku $sku)
    {
        return $this->products[(string)$sku];
    }
}
