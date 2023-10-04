<?php

namespace Darling\PHPJsonStorageUtilities\examples;

include(dirname(__DIR__, 1) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php');

use \Darling\PHPJsonStorageUtilities\classes\collections\ContainerCollection;
use \Darling\PHPJsonStorageUtilities\classes\named\identifiers\Container;
use \Darling\PHPJsonStorageUtilities\enumerations\Type;
use \Darling\PHPJsonStorageUtilities\tests\IntegrationTestUtilities;
use \Darling\PHPTextTypes\classes\strings\ClassString;

/**
 * This file demonstrates the usage of a ContainerCollection.
 */

$containerCollection = new ContainerCollection(
    new Container(Type::Bool),
    new Container(Type::String),
    new Container(Type::Int),
    new Container(Type::Float),
    new Container(new ClassString(ContainerCollection::class)),
    new Container(Type::Array),
);

foreach($containerCollection->collection() as $index => $container) {
    echo PHP_EOL . 'Container[' . strval($index) . ']: ' .
        IntegrationTestUtilities::applyANSIColor(
            $container->__toString(),
            rand(1, 231)
        );
}

