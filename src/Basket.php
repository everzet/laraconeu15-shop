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
        // TODO: write logic here
    }

    public function isTotalCost(Cost $cost)
    {
        return $this->cost->equals($cost);
    }
}
