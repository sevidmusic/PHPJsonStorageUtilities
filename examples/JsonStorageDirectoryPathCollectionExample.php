<?php

/**
 * This file demonstrates the usage of a JsonStorageDirectoryPathCollection.
 */

namespace Darling\PHPJsonStorageDirectoryPathStorageUtilities\examples;

include(dirname(__DIR__, 1) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php');

use Darling\PHPJsonStorageUtilities\classes\filesystem\paths\JsonStorageDirectoryPath;
use \Darling\PHPJsonStorageUtilities\classes\collections\JsonStorageDirectoryPathCollection;
use \Darling\PHPTextTypes\classes\strings\Name;
use \Darling\PHPTextTypes\classes\strings\Text;
use \Darling\PHPJsonStorageUtilities\tests\IntegrationTestUtilities;

$jsonStorageDirectoryPathCollection = new JsonStorageDirectoryPathCollection(
    new JsonStorageDirectoryPath(
        new Name(new Text('Name' . strval(rand(1, 100))))
    ),
    new JsonStorageDirectoryPath(
        new Name(new Text('Name' . strval(rand(1, 100))))
    ),
    new JsonStorageDirectoryPath(
        new Name(new Text('Name' . strval(rand(1, 100))))
    ),
    new JsonStorageDirectoryPath(
        new Name(new Text('Name' . strval(rand(1, 100))))
    ),
    new JsonStorageDirectoryPath(
        new Name(new Text('Name' . strval(rand(1, 100))))
    ),
    new JsonStorageDirectoryPath(
        new Name(new Text('Name' . strval(rand(1, 100))))
    ),
    new JsonStorageDirectoryPath(
        new Name(new Text('Name' . strval(rand(1, 100))))
    ),
);

foreach($jsonStorageDirectoryPathCollection->collection() as $index => $jsonStorageDirectoryPath) {
    echo PHP_EOL . 'JsonStorageDirectoryPath[' . strval($index) . ']: ' .
        IntegrationTestUtilities::applyANSIColor(
            $jsonStorageDirectoryPath->__toString(),
            rand(1, 231)
        );
}

