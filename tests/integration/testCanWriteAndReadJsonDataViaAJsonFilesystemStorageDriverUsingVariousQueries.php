<?php

namespace Darling\PHPJsonStorageUtilities\tests\integration;

include(dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php');

use \Darling\PHPJsonStorageUtilities\classes\filesystem\paths\JsonFilePath;
use \Darling\PHPJsonStorageUtilities\classes\filesystem\paths\JsonStorageDirectoryPath;
use \Darling\PHPJsonStorageUtilities\classes\filesystem\storage\drivers\JsonFilesystemStorageDriver;
use \Darling\PHPJsonStorageUtilities\classes\filesystem\storage\queries\JsonFilesystemStorageQuery;
use \Darling\PHPJsonStorageUtilities\classes\named\identifiers\Container;
use \Darling\PHPJsonStorageUtilities\classes\named\identifiers\Location;
use \Darling\PHPJsonStorageUtilities\classes\named\identifiers\Owner;
use \Darling\PHPJsonUtilities\classes\decoders\JsonDecoder;
use \Darling\PHPJsonUtilities\classes\encoded\data\Json;
use \Darling\PHPTextTypes\classes\strings\Id;
use \Darling\PHPTextTypes\classes\strings\Name;
use \Darling\PHPTextTypes\classes\strings\Text;
use \Darling\PHPJsonStorageUtilities\tests\IntegrationTestUtilities;

$jsonFilesystemStorageDriver = new JsonFilesystemStorageDriver();
$jsonDecoder = new JsonDecoder();
$data = [
    new \Darling\PHPTextTypes\classes\strings\Id(),
    'Foo' . strval(rand(PHP_INT_MIN, PHP_INT_MAX)),
    rand(PHP_INT_MIN, PHP_INT_MAX),
    [
        new \Darling\PHPTextTypes\classes\strings\Id(),
        'Foo' . strval(rand(PHP_INT_MIN, PHP_INT_MAX)),
        rand(PHP_INT_MIN, PHP_INT_MAX),
    ],
];
$containers = [];
$jsons = [];
$jsonStorageDirectoryPaths =[];
$locations =[];
$containers = [];
$owners =[];
$names =[];
$ids = [];
$jsonFilePaths = [];
for($jsonWrites = 0; $jsonWrites < rand(10, 20); $jsonWrites++) {

    $json = new Json($data[array_rand($data)]);
    $jsonStorageDirectoryPath = new JsonStorageDirectoryPath(
        new Name(
            new Text('Data' . strval(rand(1, 3)))
        )
    );
    $location = new Location(
        new Name(
            new Text('Location' . strval(rand(1, 3)))
        )
    );
    $container = new Container(IntegrationTestUtilities::determineType($json, $jsonDecoder));
    $owner = new Owner(
        new Name(new Text('Owner' . strval(rand(1, 3))))
    );
    $name = new Name(new Text('Name' . strval(rand(1, 3))));
    $id = new Id();
    $jsonFilePath = new JsonFilePath(
        $jsonStorageDirectoryPath,
        $location,
        $container,
        $owner,
        $name,
        $id
    );
    $jsons[] = $json;
    $jsonStorageDirectoryPaths[] = $jsonStorageDirectoryPath;
    $locations[] = $location;
    $containers[] = $container;
    $owners[] = $owner;
    $names[] = $name;
    $ids[] = $id;
    $jsonFilePaths[] = $jsonFilePath;
    echo PHP_EOL .
        'Writing to the following path: ' .
        IntegrationTestUtilities::applyANSIColor($jsonFilePath->__toString(), 1) .
        (
            $jsonFilesystemStorageDriver->write(
                $json,
                $jsonStorageDirectoryPath,
                $location,
                $owner,
                $name,
                $id,
            )
            ? IntegrationTestUtilities::applyANSIColor('file was written', 2)
            : IntegrationTestUtilities::applyANSIColor('failed to write file', 1)
        ) .
        PHP_EOL;
    ;
}

$jsonFilesystemStorageQuery = new JsonFilesystemStorageQuery(
    jsonStorageDirectoryPath: (
        rand(0, 1) === 0 ? null : $jsonStorageDirectoryPath
    ),
    location: (rand(0, 1) === 0 ? null : $location),
    container: (rand(0, 1) === 0 ? null : $container),
    owner: (rand(0, 1) === 0 ? null : $owner),
    name: (rand(0, 1) === 0 ? null : $name),
    id: (rand(0, 1) === 0 ? null : $id),
    jsonFilePath: (rand(0, 1) === 0 ? null : $jsonFilePath),
);

echo PHP_EOL .
    PHP_EOL .
    'Reading based on the following JsonFilesystemStorageQuery: ' .
    PHP_EOL .
    PHP_EOL .
    '    ' .
    IntegrationTestUtilities::applyANSIColor($jsonFilesystemStorageQuery->__toString(), 5) .
    PHP_EOL .
    PHP_EOL;
$jsonCollection = $jsonFilesystemStorageDriver->read(
    $jsonFilesystemStorageQuery
);
echo PHP_EOL .
    PHP_EOL .
    'Number of items read from storage: ' .
    IntegrationTestUtilities::applyANSIColor(strval(count($jsonCollection->collection())), 165);
foreach($jsonCollection->collection() as $json) {
    echo PHP_EOL .
        'Json read: ' .
        IntegrationTestUtilities::applyANSIColor($json->__toString(), 6);
    echo PHP_EOL . 'Decoded value: ' . PHP_EOL;
    var_dump($jsonDecoder->decode($json));
}

