<?php

/**
 * This file demonstrates how to use the JsonFilesystemStorageQuery
 * in conjunction with a JsonFilesystemStorageDriver to query Json
 * that exists in storage.
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
use \Darling\PHPJsonStorageUtilities\classes\filesystem\storage\drivers\JsonFilesystemStorageDriver;
use \Darling\PHPJsonStorageUtilities\classes\filesystem\storage\queries\JsonFilesystemStorageQuery;
use \Darling\PHPJsonStorageUtilities\classes\named\identifiers\Container;
use \Darling\PHPJsonStorageUtilities\classes\named\identifiers\Location;
use \Darling\PHPJsonStorageUtilities\classes\named\identifiers\Owner;
use \Darling\PHPJsonStorageUtilities\tests\IntegrationTestUtilities;
use \Darling\PHPJsonUtilities\classes\encoded\data\Json;
use \Darling\PHPTextTypes\classes\strings\Id;
use \Darling\PHPTextTypes\classes\strings\Name;
use \Darling\PHPTextTypes\classes\strings\Text;
use \Darling\PHPTextTypes\classes\strings\ClassString;
use \stdClass;

/**
 * Instantiate a new JsonStorageDirectoryPath which will determine
 * the path to the Json storage directory that all of the Json in
 * this example will be written to.
 */
$jsonStorageDirectoryPath = new JsonStorageDirectoryPath(
    new Name(
        new Text('JsonStorageDirectoryName' . strval(rand(1, 100)))
    )
);

/**
 * Instantiate a JsonFilesystemStorageQuery that will be used to
 * query the Json in storage.
 *
 * In this example the JsonFilesystemStorageQuery will only specify
 * two query parameters:
 *
 * @param JsonStorageDirectoryPath|null $jsonStorageDirectoryPath
 * @param Container|null $container
 *
 * Though any combination of the following parameters is possible:
 *
 * @param JsonFilePath|null $jsonFilePath
 * @param JsonStorageDirectoryPath|null $jsonStorageDirectoryPath
 * @param Location|null $location
 * @param Container|null $container
 * @param Owner|null $owner
 * @param Name|null $name
 * @param Id|null $id
 *
 * By specifying a JsonStorageDirectoryPath and a Container, this
 * query will target all of the Json in storage that exists in
 * the specified JsonStorageDirectoryPath whose Container
 * matches the specified Container.
 *
 */
$jsonFilesystemStorageQuery = new JsonFilesystemStorageQuery(
    jsonStorageDirectoryPath: $jsonStorageDirectoryPath,
    container: new Container(new ClassString(Id::class)),
);

/**
 * Instantiate a new JsonFilesystemStorageDriver which will be used
 * to write Json to storage.
 */
$jsonFilesystemStorageDriver = new JsonFilesystemStorageDriver();

/**
 * Create an array of data.
 */
$data = [
    new Id(),
    'Foo' . strval(rand(1, 100)),
    rand(PHP_INT_MIN, PHP_INT_MAX),
    function () : void {},
    new stdClass(),
    new Json('Encoded Json Instance' . strval(rand(1, 100))),
    json_encode('json string ' . strval(rand(1, 100))),
    floatval(
        strval(rand(0, 100)) .
        '.' .
        strval(rand(1, 100))
    ),
    [
        "Id" => new Id(),
        "string" => 'Foo' . strval(rand(1, 100)),
        "int" => rand(PHP_INT_MIN, PHP_INT_MAX),
        "closure" => function () : void {},
        "object" => new stdClass(),
        "Json Instance" => new Json(
            'Encoded Json Instance' . strval(rand(1, 100))
        ),
        "json string" => json_encode(
            'json string ' . strval(rand(1, 100))
        ),
        "float" => floatval(
            strval(rand(0, 100)) .
            '.' .
            strval(rand(1, 100))
        ),
    ],
];

/**
 * Write a bunch of Json to storage.
 */
for($writes = 0; $writes <= rand(10, 20); $writes++) {

    /**
     * Randomly select some data from the $data array and encode
     * it as Json.
     */
    $json = new Json($data[array_rand($data)]);

    /**
     * Write the Json to storage
     */
    $jsonFilesystemStorageDriver->write(
        $json,
        $jsonStorageDirectoryPath,
        new Location(
            new Name(new Text('Location' . strval($writes)))
        ),
        new Owner(
            new Name(new Text('Owner' . strval($writes)))
        ),
        new Name(new Text('Name' . strval($writes))),
        new Id(),
    );

}

/**
 * Call JsonFilesystemStorageDriver->storedJsonFilePaths() to obtain
 * a JsonFilePathCollection of JsonFilePaths for the Json in storage
 * that matches the specified JsonFilesystemStorageQuery.
 *
 * In this example the JsonFilesystemStorageQuery speicifes a
 * JsonStorageDirectoryPath and a Container. This will target
 * all of the Json in storage that exists in the specified
 * JsonStorageDirectoryPath whose Container matches the
 * specified Container.
 */
$jsonFilePathCollection = $jsonFilesystemStorageDriver->storedJsonFilePaths(
    $jsonFilesystemStorageQuery
);

echo PHP_EOL .
    IntegrationTestUtilities::applyANSIColor(
    'The following query:', rand(1, 231)
    ) .
    PHP_EOL;

echo PHP_EOL .
    IntegrationTestUtilities::applyANSIColor(
    $jsonFilesystemStorageQuery->__toString(), rand(1, 231)
    ) .
    PHP_EOL;

echo PHP_EOL .
    IntegrationTestUtilities::applyANSIColor(
    'Produced the following matches:', rand(1, 231)
    ) .
    PHP_EOL;

/**
 * Echo the JsonFilePath and Json for any stored Json that
 * matched the JsonFilesystemStorageQuery that was passed to
 * the $jsonFilesystemStorageDriver->storedJsonFilePaths()
 * method.
 */
foreach($jsonFilePathCollection->collection() as $jsonFilePath) {
    $jsonFilesystemStorageQuery = new JsonFilesystemStorageQuery(
        jsonFilePath: $jsonFilePath
    );
    echo PHP_EOL . 'Json File Path: ' .
        IntegrationTestUtilities::applyANSIColor(
            $jsonFilePath->__toString(),
            rand(1, 231)
        );
    echo PHP_EOL .
        'Json: ' .
        IntegrationTestUtilities::applyANSIColor(
            (
                $jsonFilesystemStorageDriver->read(
                    jsonFilesystemStorageQuery: $jsonFilesystemStorageQuery
                )->collection()[0] ?? ''
            ),
            rand(1, 231)
        ) .
        PHP_EOL .
        PHP_EOL;
}

/**
 * Delete the JsonStorageDirectory that the Json in this example was
 * written to.
 */
$jsonFilesystemStorageDriver->delete(
    $jsonFilesystemStorageQuery
);

