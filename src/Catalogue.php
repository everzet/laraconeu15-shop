<?php

class Catalogue
{
    private $product;

    public function addProduct(Product $product)
    {
        $this->product = $product;
    }

    public function productWithSku(Sku $sku)
    {
        return $this->product;
    }
}
