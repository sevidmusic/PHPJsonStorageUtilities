<?php

namespace Darling\PHPJsonStorageUtilities\tests\integration;

include(dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php');

use \Darling\PHPJsonStorageUtilities\classes\filesystem\paths\JsonStorageDirectoryPath;
use \Darling\PHPJsonStorageUtilities\classes\filesystem\storage\drivers\JsonFilesystemStorageDriver;
use \Darling\PHPJsonStorageUtilities\classes\named\identifiers\Location;
use \Darling\PHPJsonStorageUtilities\classes\named\identifiers\Owner;
use \Darling\PHPJsonUtilities\classes\encoded\data\Json;
use \Darling\PHPTextTypes\classes\strings\Id;
use \Darling\PHPTextTypes\classes\strings\Name;
use \Darling\PHPTextTypes\classes\strings\Text;
use \Darling\PHPJsonStorageUtilities\tests\IntegrationTestUtilities;

$data = [
    new \Darling\PHPTextTypes\classes\strings\Id(),
    'Foo' . strval(rand(PHP_INT_MIN, PHP_INT_MAX)),
    rand(PHP_INT_MIN, PHP_INT_MAX),
];

$json = new Json($data);

$jsonFilesystemStorageDriver = new JsonFilesystemStorageDriver();

$jsonStorageDirectoryPath = new JsonStorageDirectoryPath(
    new Name(new Text('Data'))
);

$location = new Location(new Name(new Text('Location')));

$owner = new Owner(new Name(new Text('Owner')));

$name = new Name(new Text('Name'));

$id = new Id();

echo match(
    $jsonFilesystemStorageDriver->write(
        $json,
        $jsonStorageDirectoryPath,
        $location,
        $owner,
        $name,
        $id,
    )
) {
    true => IntegrationTestUtilities::applyANSIColor(
        'Test Passed',
        85
    ),
    false => IntegrationTestUtilities::applyANSIColor(
        'Test Failed',
        196
    )
};

IntegrationTestUtilities::deleteTestJsonStorageDirectory(
    $jsonStorageDirectoryPath
);
