<?php

/**
 * This file demonstrates the usage of a LocationCollection.
 */

namespace Darling\PHPJsonStorageUtilities\examples;

include(dirname(__DIR__, 1) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php');

use \Darling\PHPJsonStorageUtilities\classes\collections\LocationCollection;
use \Darling\PHPJsonStorageUtilities\classes\named\identifiers\Location;
use \Darling\PHPJsonStorageUtilities\tests\IntegrationTestUtilities;
use \Darling\PHPTextTypes\classes\strings\Name;
use \Darling\PHPTextTypes\classes\strings\Text;

$locationCollection = new LocationCollection(
    new Location(new Name(new Text('Location' . strval(rand(1, 100))))),
    new Location(new Name(new Text('Location' . strval(rand(1, 100))))),
    new Location(new Name(new Text('Location' . strval(rand(1, 100))))),
    new Location(new Name(new Text('Location' . strval(rand(1, 100))))),
    new Location(new Name(new Text('Location' . strval(rand(1, 100))))),
    new Location(new Name(new Text('Location' . strval(rand(1, 100))))),
);

foreach($locationCollection->collection() as $index => $location) {
    echo PHP_EOL . 'Location[' . strval($index) . ']: ' .
        IntegrationTestUtilities::applyANSIColor(
            $location->__toString(),
            rand(1, 231)
        );
}

