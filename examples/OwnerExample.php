<?php

/**
 * This file demonstrates the usage of a Owner.
 *
 * A Owner is used to identify Json in storage, and will
 * typically be used in conjunction with a JsonFilePath or a
 * JsonFilesystemStorageQuery.
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

/**
 * Instantiate a new Owner.
 */
$owner = new Owner(
    new Name(new Text('Owner' . strval(rand(1, 100))))
);


/**
 * Use the Owner as part of the definition of a JsonFilePath.
 */
$jsonFilePath = new JsonFilePath(
    new JsonStorageDirectoryPath(
        new Name(
            new Text(
                'StorageDirectoryPathName' . strval(rand(1, 100))
            )
        )
    ),
    new Location(new Name(new Text('Location' . strval(rand(1, 100))))),
    new Container(Type::Array),
    $owner,
    new Name(new Text('Name' . strval(rand(1, 100)))),
    new Id(),
);


/**
 * Use the Owner as a JsonFilesystemStorageQuery parameter.
 */
$jsonFilesystemStorageQuery = new JsonFilesystemStorageQuery(
    owner: $owner,
);

/**
 * Echo the Owner.
 */
echo PHP_EOL . IntegrationTestUtilities::applyANSIColor(
    'Owner: ', rand(1, 231)
);

echo IntegrationTestUtilities::applyANSIColor(
        $owner->__toString(),
        rand(1, 231),
    );

/**
 * Echo the JsonFilePath that included the Owner in it's definition.
 */
echo PHP_EOL . IntegrationTestUtilities::applyANSIColor(
    'Json File Path that uses specified $owner: ', rand(1, 231)
);

echo IntegrationTestUtilities::applyANSIColor(
        $jsonFilePath->__toString(),
        rand(1, 231),
    );

/**
 * Echo the JsonFilesystemStorageQuery that the Owner was passed
 * to as a query parameter.
 */
echo PHP_EOL . IntegrationTestUtilities::applyANSIColor(
    'JsonFilesystemStorageQuery that uses specified $owner: ', rand(1, 231)
);

echo IntegrationTestUtilities::applyANSIColor(
        $jsonFilesystemStorageQuery->__toString(),
        rand(1, 231),
    );

