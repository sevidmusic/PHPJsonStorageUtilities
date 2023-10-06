<?php

/**
 * This file demonstrates the usage of a Container.
 *
 * A Container is used to identify Json in storage, and will
 * typically be used in conjunction with a JsonFilePath or a
 * JsonFilesystemStorageQuery.
 *
 * A Container's value is a hash of either the value returned by
 * a ClassString instance's __toString() method, or a hash of
 * one of the Type enumeration's cases.
 *
 */

namespace Darling\PHPJsonStorageUtilities\examples;

include(
    dirname(__DIR__, 1) .
    DIRECTORY_SEPARATOR .
    'vendor' .
    DIRECTORY_SEPARATOR .
    'autoload.php'
);

use \Darling\PHPJsonStorageUtilities\classes\filesystem\paths\JsonFilePath;
use \Darling\PHPJsonStorageUtilities\classes\filesystem\paths\JsonStorageDirectoryPath;
use \Darling\PHPJsonStorageUtilities\classes\filesystem\storage\queries\JsonFilesystemStorageQuery;
use \Darling\PHPJsonStorageUtilities\classes\named\identifiers\Container;
use \Darling\PHPJsonStorageUtilities\classes\named\identifiers\Owner;
use \Darling\PHPJsonStorageUtilities\classes\named\identifiers\Location;
use \Darling\PHPJsonStorageUtilities\enumerations\Type;
use \Darling\PHPJsonStorageUtilities\tests\IntegrationTestUtilities;
use \Darling\PHPTextTypes\classes\strings\Id;
use \Darling\PHPTextTypes\classes\strings\Name;
use \Darling\PHPTextTypes\classes\strings\Text;

/*
 * Define an array of the possible cases defined by the
 * Type enumeration.
 */
$types = Type::cases();

/**
 * Instantiate a new Container using a randomly selected Type.
 */
$container = new Container($types[array_rand($types)]);

/**
 * Use the Container as part of the definition of a JsonFilePath.
 */
$jsonFilePath = new JsonFilePath(
    new JsonStorageDirectoryPath(
        new Name(
            new Text(
                'StorageDirectoryPathName' . strval(rand(1, 100))
            )
        )
    ),
    new Location(new Name(new Text('Owner' . strval(rand(1, 100))))),
    $container,
    new Owner(new Name(new Text('Owner' . strval(rand(1, 100))))),
    new Name(new Text('Name' . strval(rand(1, 100)))),
    new Id(),
);


/**
 * Use the Container as a JsonFilesystemStorageQuery parameter.
 */
$jsonFilesystemStorageQuery = new JsonFilesystemStorageQuery(
    container: $container,
);

/**
 * Echo the Container.
 */
echo PHP_EOL . IntegrationTestUtilities::applyANSIColor(
    'Container: ', rand(1, 231)
);

echo IntegrationTestUtilities::applyANSIColor(
        $container->__toString(),
        rand(1, 231),
    );

/**
 * Echo the JsonFilePath that included the Container in it's definition.
 */
echo PHP_EOL . IntegrationTestUtilities::applyANSIColor(
    'Json File Path that uses specified $container: ', rand(1, 231)
);

echo IntegrationTestUtilities::applyANSIColor(
        $jsonFilePath->__toString(),
        rand(1, 231),
    );

/**
 * Echo the JsonFilesystemStorageQuery that the Container was passed
 * to as a query parameter.
 */
echo PHP_EOL . IntegrationTestUtilities::applyANSIColor(
    'JsonFilesystemStorageQuery that uses specified $container: ',
    rand(1, 231)
);

echo IntegrationTestUtilities::applyANSIColor(
        $jsonFilesystemStorageQuery->__toString(),
        rand(1, 231),
    );

