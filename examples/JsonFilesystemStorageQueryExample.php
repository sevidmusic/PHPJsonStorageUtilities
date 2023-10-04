<?php

namespace Darling\PHPJsonStorageUtilities\examples;

include(dirname(__DIR__, 1) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php');

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
use \stdClass;

/**
 * Instantiate a new JsonFilesystemStorageDriver.
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
        "Json Instance" => new Json('Encoded Json Instance' . strval(rand(1, 100))),
        "json string" => json_encode('json string ' . strval(rand(1, 100))),
        "float" => floatval(
            strval(rand(0, 100)) .
            '.' .
            strval(rand(1, 100))
        ),
    ],
];

/**
 * Instantiate a new JsonStorageDirectoryPath which will determine
 * the path to the json storage directory that all of the Json in
 * this example will be written to.
 */
$jsonStorageDirectoryPath = new JsonStorageDirectoryPath(
    new Name(
        new Text('JsonStorageDirectoryName' . strval(rand(1, 100)))
    )
);

for($writes = 0; $writes <= rand(10, 20); $writes++) {

    /**
     * Randomly select some data from the $data array and encode
     * it as Json.
     */
    $json = new Json($data[array_rand($data)]);

    /**
     * Instantiate a new JsonFilePath to emulate the path to the json file
     * that the Json is expected to be written to. This will be used to
     * query storage later.
     */
    $expectedJsonFilePath = new JsonFilePath(
        jsonStorageDirectoryPath: $jsonStorageDirectoryPath,
        location: new Location(new Name(new Text('Location' . strval($writes)))),
        container: new Container(
            /**
             * In the future Container::determineType(Json $json) should
             * be used to determine Type for Container.
             *
             * @see https://github.com/sevidmusic/PHPJsonStorageUtilities/issues/34
             */
            IntegrationTestUtilities::determineType($json),
        ),
        owner: new Owner(new Name(new Text('Owner' . strval($writes)))),
        name: new Name(new Text('Name' . strval($writes))),
        id: new Id(),
    );

    /**
     * Write the json to storage
     */
    $jsonFilesystemStorageDriver->write(
        $json,
        $expectedJsonFilePath->jsonStorageDirectoryPath(),
        $expectedJsonFilePath->location(),
        $expectedJsonFilePath->owner(),
        $expectedJsonFilePath->name(),
        $expectedJsonFilePath->id(),
    );

}

/**
 * Instantiate a JsonFilesystemStorageQuery that will be passed to
 * the $jsonFilesystemStorageDriver->read() method to query the Json
 * in storage.
 *
 * In this example the JsonFilesystemStorageQuery will only specify a
 * single query parameter:
 *
 * @param JsonStorageDirectoryPath|null $jsonStorageDirectoryPath
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
 */
$jsonFilesystemStorageQuery = new JsonFilesystemStorageQuery(
    jsonStorageDirectoryPath: $jsonStorageDirectoryPath
);

/**
 * Call JsonFilesystemStorageDriver->storedJsonFilePaths() to obtain a
 * JsonFilePathCollection of JsonFilePaths for the Json in storage
 * that matches the specified JsonFilesystemStorageQuery.
 *
 * The JsonFilesystemStorageQuery in this example only specifies a
 * jsonStorageDirectoryPath.
 *
 * This will result in storedJsonFilePaths() returning a
 * JsonFilePathCollection that contains JsonFilePaths for
 * all of the Json that is stored in the specified
 * JsonStorageDirectoryPath.
 */
$jsonFilePathCollection = $jsonFilesystemStorageDriver->storedJsonFilePaths(
    $jsonFilesystemStorageQuery
);

echo PHP_EOL . IntegrationTestUtilities::applyANSIColor(
    'The following query:', rand(1, 231)
) . PHP_EOL;

echo PHP_EOL . IntegrationTestUtilities::applyANSIColor(
    $jsonFilesystemStorageQuery->__toString(), rand(1, 231)
) . PHP_EOL;

echo PHP_EOL . IntegrationTestUtilities::applyANSIColor(
    'Produced the following matches:', rand(1, 231)
) . PHP_EOL;

/**
 * Echo the JsonFilePaths for any stored Json that matched the
 * JsonFilesystemStorageQuery that was passed to
 * $jsonFilesystemStorageDriver->storedJsonFilePaths()
 */
foreach($jsonFilePathCollection->collection() as $index => $json) {
    echo PHP_EOL . 'Json ' . strval($index) . ':' .
        IntegrationTestUtilities::applyANSIColor(
            $json->__toString(),
            rand(1, 231)
        );
}

/**
 * Delete the JsonStorageDirectory that was used in this example.
 */
$jsonFilesystemStorageDriver->delete(
    $jsonFilesystemStorageQuery
);

