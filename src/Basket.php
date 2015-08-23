<?php

class Basket
{
    private $cost;

    const VAT = 20;
    const DELIVERY_COST = 3.0;

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
        return $this->totalCost()->equals($cost);
    }

    private function totalCost()
    {
        if ($this->cost->equals(Cost::fromFloat(0.0))) {
            return $this->cost;
        }

        return $this->costWithVat()->add($this->deliveryCost());
    }

    private function costWithVat()
    {
        return $this->cost->addPercent(self::VAT);
    }

    private function deliveryCost()
    {
        if ($this->cost->isMoreThan(Cost::fromFloat(10.0))) {
            return Cost::fromFloat(2.0);
        }

        return Cost::fromFloat(self::DELIVERY_COST);
    }
}
