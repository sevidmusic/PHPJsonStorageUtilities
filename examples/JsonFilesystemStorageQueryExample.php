<?php

namespace Darling\PHPJsonStorageUtilities\examples;

include(dirname(__DIR__, 1) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php');

use Darling\PHPJsonStorageUtilities\enumerations\Type;
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

// Instantiate a new JsonFilesystemStorageDriver
$jsonFilesystemStorageDriver = new JsonFilesystemStorageDriver();

// Create some data to store.
$data = [new Id(), 'Foo' . strval(rand(1, 100)), rand(PHP_INT_MIN, PHP_INT_MAX)];

// Encode the data as json
$json = new Json($data);

$jsonStorageDirectoryPath = new JsonStorageDirectoryPath(
    new Name(
        new Text('JsonStorageDirectoryName' . strval(rand(1, 100)))
    )
);
for($writes = 0; $writes <= rand(10, 20); $writes++) {

    // Instantiate a new JsonFilePath. The JsonFilePath will determine
    // the path where the json will be written to.
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
            Type::Array,
        ),
        owner: new Owner(new Name(new Text('Owner' . strval($writes)))),
        name: new Name(new Text('Name' . strval($writes))),
        id: new Id(),
    );

    // Write the json to storage
    $jsonFilesystemStorageDriver->write(
        $json,
        $expectedJsonFilePath->jsonStorageDirectoryPath(),
        $expectedJsonFilePath->location(),
        $expectedJsonFilePath->owner(),
        $expectedJsonFilePath->name(),
        $expectedJsonFilePath->id(),
    );
}

// Instantiate a JsonFilesystemStorageQuery that will be
// used to read the json that was stored on the call to
// $jsonFilesystemStorageDriver->write(...)
$jsonFilesystemStorageQuery = new JsonFilesystemStorageQuery(
    jsonStorageDirectoryPath: $jsonStorageDirectoryPath
);

// Get a JsonCollection of the Json in storage that
// matches the specified $jsonFilesystemStorageQuery
$jsonFilePathCollectiong = $jsonFilesystemStorageDriver->storedJsonFilePaths(
    $jsonFilesystemStorageQuery
);

echo PHP_EOL . IntegrationTestUtilities::applyANSIColor('The following query:', rand(1, 231)) . PHP_EOL;
echo PHP_EOL . IntegrationTestUtilities::applyANSIColor($jsonFilesystemStorageQuery->__toString(), rand(1, 231)) . PHP_EOL;
echo PHP_EOL . IntegrationTestUtilities::applyANSIColor('Produced the following matches:', rand(1, 231)) . PHP_EOL;

// echo any stored json that matched the JsonFilesystemStorageQuery
// that was passed to $jsonFilesystemStorageDriver->read()
foreach($jsonFilePathCollectiong->collection() as $index => $json) {
    echo PHP_EOL . 'Json ' . strval($index) . ':' .
        IntegrationTestUtilities::applyANSIColor(
            $json->__toString(),
            rand(1, 231)
        );
}

// Delete the JsonStorageDirectory that was used in this example.
$jsonFilesystemStorageDriver->delete(
    $jsonFilesystemStorageQuery
);

