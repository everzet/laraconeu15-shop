<?php

require_once __DIR__ . '/../vendor/autoload.php';

$app = new Silex\Application();
$app['debug'] = true;

$catalogue = new FilesystemCatalogue();

$app->get(
    '/catalogue',
    function () use ($catalogue) {
        $page = "<ul>";
        foreach ($catalogue as $product) {
            $page .= "<li class='product'>{$product->sku()}<a
            href='/catalogue/{$product->sku()}/add-to-basket'>Add to basket</a></li>";
        }
        $page .= "</ul>";

        return $page;
    }
);

$app->get(
    '/catalogue/{sku}/add-to-basket',
    function ($sku) use ($catalogue) {
        $basket = new Basket();
        $basket->addProductFromCatalogue(Sku::fromString($sku), $catalogue);

        return "Total cost of basket: £{$basket->totalCost()}";
    }
);
$app->run();
