<?php

namespace Darling\PHPJsonStorageUtilities\tests\integration;

include(dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php');


use \Darling\PHPTextTypes\classes\strings\Text;
use \Darling\PHPJsonStorageUtilities\classes\named\identifiers\Container;
use \Darling\PHPJsonStorageUtilities\classes\filesystem\paths\JsonFilePath;
use \Darling\PHPJsonUtilities\classes\decoders\JsonDecoder;
use \Darling\PHPTextTypes\classes\strings\Id;
use \Darling\PHPTextTypes\classes\strings\Name;
use \Darling\PHPTextTypes\classes\strings\ClassString;
use \Darling\PHPJsonStorageUtilities\classes\named\identifiers\Owner;
use \Darling\PHPJsonStorageUtilities\classes\named\identifiers\Location;
use \Darling\PHPJsonStorageUtilities\classes\filesystem\paths\JsonStorageDirectoryPath;
use \Darling\PHPJsonStorageUtilities\enumerations\Type;
use \Darling\PHPJsonUtilities\classes\encoded\data\Json;

function applyCliColor(string $string, int $colorCode): string {
    /**
     * \033[0m : reset color
     * \033[48;5;{$colorCode}m : set background color
     * \033[38;5;{$colorCode}m : set foreground color
     */
    return "\033[0m\033[48;5;" . strval($colorCode) . "m\033[38;5;0m " . $string . " \033[0m";
}

function determineType(Json $json, JsonDecoder $jsonDecoder): Type|ClassString
{
    $data = $jsonDecoder->decode($json);
    if(is_object($data)) {
        return new ClassString($data);
    }
    return match(gettype($data)) {
        Type::Array->value => Type::Array,
        Type::Bool->value => Type::Bool,
        Type::Float->value => Type::Float,
        Type::Int->value => Type::Int,
        Type::Null->value => Type::Null,
        Type::String->value => Type::String,
        Type::Object->value => Type::Object,
        Type::Resource->value => Type::Resource,
        Type::ResourceClosed->value => Type::ResourceClosed,
        Type::UnknownType->value => Type::UnknownType,
    };
}

$jfsd = new \Darling\PHPJsonStorageUtilities\classes\filesystem\storage\drivers\JsonFilesystemStorageDriver();
$jsonDecoder = new JsonDecoder();
$data = [
    new \Darling\PHPTextTypes\classes\strings\Id(),
    'Foo',
    rand(PHP_INT_MIN, PHP_INT_MAX),
    [
        new \Darling\PHPTextTypes\classes\strings\Id(),
        'Foo',
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
    $container = new Container(determineType($json, $jsonDecoder));
    $owner = new Owner(new Name(new Text('Owner' . strval(rand(1, 3)))));
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
        applyCliColor($jsonFilePath->__toString(), 1) .
        ($jfsd->write($json, $jsonStorageDirectoryPath, $location, $owner, $name, $id) ? 'file was written' : 'failed to write file') .
        PHP_EOL;
    ;
}

$jfsq = new \Darling\PHPJsonStorageUtilities\classes\filesystem\storage\queries\JsonFilesystemStorageQuery(
    jsonStorageDirectoryPath: (rand(0, 1) === 0 ? null : $jsonStorageDirectoryPath),
    location: (rand(0, 1) === 0 ? null : $location),
    container: (rand(0, 1) === 0 ? null : $container),
    owner: (rand(0, 1) === 0 ? null : $owner),
    name: (rand(0, 1) === 0 ? null : $name),
    id: (rand(0, 1) === 0 ? null : $id),
    jsonFilePath: (rand(0, 1) === 0 ? null : $jsonFilePath),
);

echo PHP_EOL . PHP_EOL . 'Reading based on the following JsonFilesystemStorageQuery: ' .PHP_EOL . PHP_EOL . '    ' . applyCliColor($jfsq->__toString(), 5) . PHP_EOL . PHP_EOL;
$jsonCollection = $jfsd->storedJsonFilePaths($jfsq);
echo PHP_EOL . PHP_EOL . 'Number of items read from storage: ' . applyCliColor(strval(count($jsonCollection->collection())), 7);
echo PHP_EOL . 'Json File Paths: ' . PHP_EOL;
foreach($jsonCollection->collection() as $json) {
    echo PHP_EOL . applyCliColor($json->__toString(), 6);
}

