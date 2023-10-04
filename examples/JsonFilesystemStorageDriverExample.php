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
 * Instantiate a new JsonFilesystemStorageDriver
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
    jsonStorageDirectoryPath: new JsonStorageDirectoryPath(
        new Name(
            new Text(
                'JsonStorageDirectoryName' . strval(rand(1, 100))
            )
        )
    ),
    location: new Location(
        new Name(new Text('Location' . strval(rand(1, 100))))
    ),
    container: new Container(
        /**
         * In the future Container::determineType(Json $json) should
         * be used to determine Type for Container.
         *
         * @see https://github.com/sevidmusic/PHPJsonStorageUtilities/issues/34
         */
        IntegrationTestUtilities::determineType($json),
    ),
    owner: new Owner(new Name(new Text('Owner' . strval(rand(1, 100))))),
    name: new Name(new Text('Name' . strval(rand(1, 100)))),
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

/**
 * Instantiate a JsonFilesystemStorageQuery that will be passed to
 * the $jsonFilesystemStorageDriver->read() method to query the Json
 * in storage.
 *
 * In this example the JsonFilesystemStorageQuery will only specify a
 * single query parameter:
 *
 * @param JsonFilePath|null $jsonFilePath
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
 * If specified, the jsonFilePath parameter will always take
 * precedence over the other parameters.
 */
$jsonFilesystemStorageQuery = new JsonFilesystemStorageQuery(
    jsonFilePath: $expectedJsonFilePath
);

/**
 * Call JsonFilesystemStorageDriver->read() to obtain a
 * JsonCollection of the Json in storage that matches the
 * specified JsonFilesystemStorageQuery.
 *
 * The JsonFilesystemStorageQuery in this example only specifies a
 * jsonFilePath.
 *
 * If a json file exists at the path that matches the specified
 * JsonFilePath, then it's Json will be the only Json included
 * in the JsonCollection returned by read().
 *
 * If a json file does not exist at the path that matches the
 * specified JsonFilePath then an empty JsonCollection will be
 * returned by read().
 */
$jsonCollection = $jsonFilesystemStorageDriver->read(
    $jsonFilesystemStorageQuery
);

/**
 * Echo any stored Json that matched the JsonFilesystemStorageQuery
 * that was passed to $jsonFilesystemStorageDriver->read()
 */
foreach($jsonCollection->collection() as $index => $json) {
    echo PHP_EOL .
        PHP_EOL .
        IntegrationTestUtilities::applyANSIColor(
            'Path to json file:', rand(1, 231)
        ) .
        IntegrationTestUtilities::applyANSIColor(
            (
                $jsonFilesystemStorageQuery->jsonFilePath()?->__toString()
                ??
                'path is unknown'
            ),
            rand(1, 231)
        ) .
        PHP_EOL .
        PHP_EOL .
        IntegrationTestUtilities::applyANSIColor(
            'Json: ', rand(1, 231)
        ) .
        IntegrationTestUtilities::applyANSIColor(
            $json->__toString(),
            rand(1, 231)
        ) .
        PHP_EOL;
}

/**
 * Instantiate a JsonFilesystemStorageQuery that will be used to
 * delete the entire JsonStorageDirectory that was used in this
 * example.
 */
$jsonFilesystemStorageQuery = new JsonFilesystemStorageQuery(
    jsonStorageDirectoryPath: $expectedJsonFilePath->jsonStorageDirectoryPath()
);

/**
 * Delete the JsonStorageDirectory that was used in this example.
 */
$jsonFilesystemStorageDriver->delete(
    $jsonFilesystemStorageQuery
);

