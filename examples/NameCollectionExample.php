<?php

/**
 * This file demonstrates the usage of a NameCollection.
 */

namespace Darling\PHPJsonStorageUtilities\examples;

include(dirname(__DIR__, 1) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php');

use \Darling\PHPJsonStorageUtilities\classes\collections\NameCollection;
use \Darling\PHPJsonStorageUtilities\tests\IntegrationTestUtilities;
use \Darling\PHPTextTypes\classes\strings\Name;
use \Darling\PHPTextTypes\classes\strings\Text;

$nameCollection = new NameCollection(
    new Name(new Text('Name' . strval(rand(1, 100)))),
    new Name(new Text('Name' . strval(rand(1, 100)))),
    new Name(new Text('Name' . strval(rand(1, 100)))),
    new Name(new Text('Name' . strval(rand(1, 100)))),
    new Name(new Text('Name' . strval(rand(1, 100)))),
    new Name(new Text('Name' . strval(rand(1, 100)))),
);

foreach($nameCollection->collection() as $index => $name) {
    echo PHP_EOL . 'Name[' . strval($index) . ']: ' .
        IntegrationTestUtilities::applyANSIColor(
            $name->__toString(),
            rand(1, 231)
        );
}

