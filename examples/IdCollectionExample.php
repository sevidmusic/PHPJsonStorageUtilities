<?php

/**
 * This file demonstrates the usage of a IdCollection.
 */

namespace Darling\PHPJsonStorageUtilities\examples;

include(
    dirname(__DIR__, 1) .
    DIRECTORY_SEPARATOR .
    'vendor' .
    DIRECTORY_SEPARATOR .
    'autoload.php'
);

use \Darling\PHPJsonStorageUtilities\classes\collections\IdCollection;
use \Darling\PHPJsonStorageUtilities\tests\IntegrationTestUtilities;
use \Darling\PHPTextTypes\classes\strings\Id;

$idCollection = new IdCollection(
    new Id(),
    new Id(),
    new Id(),
    new Id(),
    new Id(),
    new Id(),
);

foreach($idCollection->collection() as $index => $id) {
    echo PHP_EOL . 'Id[' . strval($index) . ']: ' .
        IntegrationTestUtilities::applyANSIColor(
            $id->__toString(),
            rand(1, 231)
        );
}

