<?php

namespace Darling\PHPJsonStorageUtilities\examples;

include(dirname(__DIR__, 1) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php');

use \Darling\PHPJsonStorageUtilities\classes\filesystem\paths\JsonFilePath;
use \Darling\PHPJsonStorageUtilities\classes\filesystem\paths\JsonStorageDirectoryPath;
use \Darling\PHPJsonStorageUtilities\classes\named\identifiers\Container;
use \Darling\PHPJsonStorageUtilities\classes\named\identifiers\Location;
use \Darling\PHPJsonStorageUtilities\classes\named\identifiers\Owner;
use \Darling\PHPJsonStorageUtilities\enumerations\Type;
use \Darling\PHPJsonStorageUtilities\tests\IntegrationTestUtilities;
use \Darling\PHPTextTypes\classes\strings\Id;
use \Darling\PHPTextTypes\classes\strings\Name;
use \Darling\PHPTextTypes\classes\strings\Text;

/**
 * This file demonstrates the usage of a JsonFilePath.
 */

$jsonFilePath = new JsonFilePath(
    new JsonStorageDirectoryPath(
        new Name(
            new Text(
                'StorageDirectoryPathName' . strval(rand(1, 100))
            )
        )
    ),
    new Location(
        new Name(new Text('Location' . strval(rand(1, 100))))
    ),
    new Container(Type::UnknownType),
    new Owner(new Name(new Text('Owner' . strval(rand(1, 100))))),
    new Name(new Text('Name' . strval(rand(1, 100)))),
    new Id(),
);

echo PHP_EOL .
    'JsonFilePath:' .
    IntegrationTestUtilities::applyANSIColor(
        $jsonFilePath->__toString(), rand(1, 231)
    );

