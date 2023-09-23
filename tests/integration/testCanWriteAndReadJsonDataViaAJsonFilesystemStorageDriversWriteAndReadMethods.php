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
use \Darling\PHPJsonStorageUtilities\enumerations\Type;
use \Darling\PHPJsonUtilities\classes\encoded\data\Json;
use \Darling\PHPTextTypes\classes\strings\Id;
use \Darling\PHPTextTypes\classes\strings\Name;
use \Darling\PHPTextTypes\classes\strings\Text;

function applyCliColor(string $string, int $colorCode): string {
    /**
     * \033[0m : reset color
     * \033[48;5;{$colorCode}m : set background color
     * \033[38;5;{$colorCode}m : set foreground color
     */
    return "\033[0m\033[48;5;" .
        strval($colorCode) .
        "m\033[38;5;0m " .
        $string .
        " \033[0m";
}

$data = [new Id(), 'Foo', rand(PHP_INT_MIN, PHP_INT_MAX)];

$expectedContainer = new Container(Type::Array);

$json = new Json($data);

$jsonFilesystemStorageDriver = new JsonFilesystemStorageDriver();

$jsonStorageDirectoryPath = new JsonStorageDirectoryPath(
    new Name(new Text('Data'))
);

$location = new Location(new Name(new Text('Location')));

$owner = new Owner(new Name(new Text('Owner')));

$name = new Name(new Text('Name'));

$id = new Id();

$expectedJsonFilePath = new JsonFilePath(
    jsonStorageDirectoryPath: $jsonStorageDirectoryPath,
    location: $location,
    container: $expectedContainer,
    owner: $owner,
    name: $name,
    id: $id,
);

echo PHP_EOL .
    'Writing json to file: ' .
    applyCliColor($expectedJsonFilePath->__toString(), 9);

echo PHP_EOL . match(
    $jsonFilesystemStorageDriver->write(
        $json,
        $jsonStorageDirectoryPath,
        $location,
        $owner,
        $name,
        $id,
    )
) {
    true => applyCliColor('Json was written successfully', 2),
    false => applyCliColor('Failed to write Json', 1),
} . PHP_EOL;

/** Should read all stored Json from the $expectedContainer */
$jsonFilesystemStorageQuery = new JsonFilesystemStorageQuery(
    container: $expectedContainer
);

foreach(
    $jsonFilesystemStorageDriver->read($jsonFilesystemStorageQuery)
                                ->collection()
    as
    $json
) {
   echo PHP_EOL . applyCliColor('Read json: ', 2) . applyCliColor($json, 9) . PHP_EOL;
}

