<?php

namespace Darling\PHPJsonStorageUtilities\tests\integration;

include(dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php');

use \Darling\PHPJsonStorageUtilities\classes\filesystem\paths\JsonStorageDirectoryPath;
use \Darling\PHPJsonStorageUtilities\classes\filesystem\paths\JsonFilePath;
use \Darling\PHPJsonStorageUtilities\classes\filesystem\storage\drivers\JsonFilesystemStorageDriver;
use \Darling\PHPJsonStorageUtilities\classes\filesystem\storage\queries\JsonFilesystemStorageQuery;
use \Darling\PHPJsonStorageUtilities\classes\named\identifiers\Container;
use \Darling\PHPJsonStorageUtilities\classes\named\identifiers\Location;
use \Darling\PHPJsonStorageUtilities\classes\named\identifiers\Owner;
use \Darling\PHPJsonUtilities\classes\encoded\data\Json;
use \Darling\PHPTextTypes\classes\strings\Id;
use \Darling\PHPTextTypes\classes\strings\Name;
use \Darling\PHPTextTypes\classes\strings\Text;
use \Darling\PHPJsonStorageUtilities\tests\IntegrationTestUtilities;
use \Darling\PHPJsonUtilities\classes\decoders\JsonDecoder;

$jsonDecoder = new JsonDecoder();

$data = [new Id(), 'Foo', rand(PHP_INT_MIN, PHP_INT_MAX)];

$json = new Json($data);

$jsonFilesystemStorageDriver = new JsonFilesystemStorageDriver();

$jsonStorageDirectoryPath = new JsonStorageDirectoryPath(
    new Name(new Text('Data'))
);

$location = new Location(new Name(new Text('Location')));

$container = new Container(
    IntegrationTestUtilities::determineType($json, $jsonDecoder)
);
$owner = new Owner(new Name(new Text('Owner')));

$name = new Name(new Text('Name'));

$id = new Id();

$expectedJsonFilePath = new JsonFilePath(
    jsonStorageDirectoryPath: $jsonStorageDirectoryPath,
    location: $location,
    container: $container,
    owner: $owner,
    name: $name,
    id: $id,
);

$jsonFilesystemStorageDriver->write(
    $json,
    $jsonStorageDirectoryPath,
    $location,
    $owner,
    $name,
    $id,
);

$jsonFilesystemStorageQuery = new JsonFilesystemStorageQuery(
    jsonFilePath: $expectedJsonFilePath
);

$expectedCount = glob($jsonFilesystemStorageQuery->__toString());

$jsonCollection = $jsonFilesystemStorageDriver->read(
    $jsonFilesystemStorageQuery
);

echo match(
    count($jsonCollection->collection())
    ===
    count(is_array($expectedCount) ? $expectedCount : [])
) {
    true => IntegrationTestUtilities::applyANSIColor('Test Passed', 85),
    false => IntegrationTestUtilities::applyANSIColor('Test Failed', 196),
};

IntegrationTestUtilities::deleteTestJsonStorageDirectory(
    $jsonStorageDirectoryPath
);

