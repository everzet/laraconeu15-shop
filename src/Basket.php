<?php

class Basket
{
    private $cost;

    public function __construct()
    {
        $this->cost = Cost::fromFloat(0.0);
    }

    public function addProductFromCatalogue(Sku $sku, Catalogue $catalogue)
    {
        $this->cost = $this->cost->add($catalogue->productWithSku($sku)->cost());
    }

    public function isTotalCost(Cost $cost)
    {
        return $this->cost->equals($cost);
    }
}
