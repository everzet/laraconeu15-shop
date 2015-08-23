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

    public function totalCost()
    {
        if ($this->cost->equals(Cost::fromFloat(0.0))) {
            return $this->cost;
        }

        return $this->costWithVat()->add($this->deliveryCost());
    }

    public function isTotalCost(Cost $cost)
    {
        return $this->totalCost()->equals($cost);
    }

    private function costWithVat()
    {
        return $this->cost->addPercent(20);
    }

    private function deliveryCost()
    {
        if ($this->cost->isMoreThan($this->expensiveBasketThreshold())) {
            return $this->expensiveBasketDeliveryCost();
        }

        return $this->cheapBasketDeliveryCost();
    }

    private function expensiveBasketThreshold()
    {
        return Cost::fromFloat(10.0);
    }

    private function expensiveBasketDeliveryCost()
    {
        return Cost::fromFloat(2.0);
    }

    private function cheapBasketDeliveryCost()
    {
        return Cost::fromFloat(3.0);
    }
}
