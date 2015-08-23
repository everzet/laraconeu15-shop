<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;

/**
 * Defines application features from the specific context.
 */
class BasketContext implements Context, SnippetAcceptingContext
{
    private $catalogue;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
        $this->catalogue = new Catalogue();
    }

    /**
     * @Transform :aSku
     */
    public function transformStringToASku($string)
    {
        return Sku::fromString($string);
    }

    /**
     * @Transform :aCost
     */
    public function transformStringToACost($string)
    {
        return Cost::fromFloat((float)$string);
    }

    /**
     * @Given there is a product with SKU :aSku and a cost of £:aCost in the catalogue
     */
    public function thereIsProductInTheCatalogue(Sku $aSku, Cost $aCost)
    {
        $aProduct = Product::withSkuAndCost($aSku, $aCost);
        $this->catalogue->addProduct($aProduct);
    }

    /**
     * @When I add the product with SKU :aSku from the catalogue to my basket
     */
    public function iAddTheProductToMyBasket(Sku $aSku)
    {
        $myBasket = new Basket();
        $myBasket->addProductFromCatalogue($aSku, $this->catalogue);
    }

    /**
     * @Then the total cost of my basket should be £:arg1
     */
    public function theTotalCostOfMyBasketShouldBePs($arg1)
    {
        throw new PendingException();
    }
}
