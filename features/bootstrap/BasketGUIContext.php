<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\MinkExtension\Context\RawMinkContext;

/**
 * Defines application features from the specific context.
 */
class BasketGUIContext extends RawMinkContext implements Context, SnippetAcceptingContext
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
        $this->catalogue = new FilesystemCatalogue();
    }

    /**
     * @BeforeScenario
     */
    public function clearCatalogue()
    {
        $this->catalogue->clear();
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
     * @When I add the product with SKU :sku from the catalogue to my basket
     */
    public function iAddTheProductWithSkuFromTheCatalogueToMyBasket($sku)
    {
        $this->visitCatalogue();
        $this->addProductToBasket($sku);
    }

    /**
     * @Then the total cost of my basket should be £:cost
     */
    public function theTotalCostOfMyBasketShouldBePs($cost)
    {
        $this->assertVisibleBasketCost($cost);
    }

    private function visitCatalogue()
    {
        $this->visitPath('/catalogue');
    }

    private function addProductToBasket($sku)
    {
        $this->assertProductIsOnPage($sku);
        $el = $this->getSession()->getPage()->find('css', ".product:contains('$sku')");
        $el->clickLink('Add to basket');
    }

    private function assertVisibleBasketCost($cost)
    {
        $this->assertSession()->pageTextContains("Total cost of basket: £$cost");
    }

    private function assertProductIsOnPage($sku)
    {
        $this->assertSession()->elementExists('css', ".product:contains('$sku')");
    }
}
