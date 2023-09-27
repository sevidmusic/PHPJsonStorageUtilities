<?php

namespace Darling\PHPJsonStorageUtilities\examples;

include(dirname(__DIR__, 1) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php');

use \Darling\PHPJsonStorageUtilities\classes\collections\JsonCollection;
use \Darling\PHPJsonUtilities\classes\encoded\data\Json;
use \Darling\PHPTextTypes\classes\strings\Id;
use \Darling\PHPJsonStorageUtilities\tests\IntegrationTestUtilities;

/**
 * This file demonstrates the usage of a JsonCollection.
 */

$jsonCollection = new JsonCollection(
    new Json(new Id()),
    new Json([1, 2, 3]),
    new Json(456.789),
    new Json(10),
    new Json(true),
    new Json(false),
    new Json(null),
    new Json('string'),
    new Json(json_encode('json string')),
);

foreach($jsonCollection->collection() as $index => $json) {
    echo PHP_EOL . 'Json ' . strval($index) . ':' .
        IntegrationTestUtilities::applyANSIColor(
            $json->__toString(),
            rand(1, 231)
        );
}

