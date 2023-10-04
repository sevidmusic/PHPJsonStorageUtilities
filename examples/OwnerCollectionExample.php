<?php

namespace Darling\PHPJsonStorageUtilities\examples;

include(dirname(__DIR__, 1) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php');

use \Darling\PHPJsonStorageUtilities\classes\collections\OwnerCollection;
use \Darling\PHPJsonStorageUtilities\classes\named\identifiers\Owner;
use \Darling\PHPJsonStorageUtilities\tests\IntegrationTestUtilities;
use \Darling\PHPTextTypes\classes\strings\Name;
use \Darling\PHPTextTypes\classes\strings\Text;

/**
 * This file demonstrates the usage of a OwnerCollection.
 */

$ownerCollection = new OwnerCollection(
    new Owner(new Name(new Text('Owner' . strval(rand(1, 100))))),
    new Owner(new Name(new Text('Owner' . strval(rand(1, 100))))),
    new Owner(new Name(new Text('Owner' . strval(rand(1, 100))))),
    new Owner(new Name(new Text('Owner' . strval(rand(1, 100))))),
    new Owner(new Name(new Text('Owner' . strval(rand(1, 100))))),
    new Owner(new Name(new Text('Owner' . strval(rand(1, 100))))),
);

foreach($ownerCollection->collection() as $index => $owner) {
    echo PHP_EOL . 'Owner[' . strval($index) . ']: ' .
        IntegrationTestUtilities::applyANSIColor(
            $owner->__toString(),
            rand(1, 231)
        );
}

