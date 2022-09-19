<?php
declare(strict_types=1);

// reikia bootstrap logikos
// reikia kviesti klases, naudojantis ju pilnais pavadinimais (FQCN)


namespace Inga\InventoryCheckerComposer;

//require './bootstrap.php'; // sis nebereikalingas nes yra vendor
require './vendor/autoload.php';

use Inga\InventoryCheckerComposer\Service\Logger;
use Inga\InventoryCheckerComposer\Service\InputProcessor;
use Inga\InventoryCheckerComposer\Service\InventoryChecker;
use Inga\InventoryCheckerComposer\Exception\InventoryException;

$inputProcessor = new InputProcessor();
$productsData = $inputProcessor->getProductsData($argv[1]);

$inventoryChecker = new InventoryChecker();
try {
    foreach ($productsData as $product) {
        $inventoryChecker->check($product['product_id'], $product['quantity']);
    }
    echo 'all products have the requested quantity in stock';
} catch (InventoryException $exception) {
    echo $exception->getMessage();
    $logger = new Logger();
    $logger->log($exception->getMessage());
}

// pagrindinis
// butinai reikia require './bootstrap.php';
// kol nera >use< prie klases turi buti pilnas pavadinimas
// iskvietimas teminale ... php -f index.php "1:1"
// papulti i reikama faila  terminale ... cd Inventory_checker