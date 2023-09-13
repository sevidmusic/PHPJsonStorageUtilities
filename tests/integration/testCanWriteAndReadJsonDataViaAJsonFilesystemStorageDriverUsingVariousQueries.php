<?php

include(dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php');

use Darling\PHPJsonStorageUtilities\classes\filesystem\paths\JsonFilePath;
use Darling\PHPJsonUtilities\classes\decoders\JsonDecoder;
use \Darling\PHPTextTypes\classes\strings\Id;
use \Darling\PHPTextTypes\classes\strings\Name;
use \Darling\PHPTextTypes\classes\strings\ClassString;
use \Darling\PHPJsonStorageUtilities\classes\named\identifiers\Owner;
use \Darling\PHPJsonStorageUtilities\classes\named\identifiers\Location;
use \Darling\PHPJsonStorageUtilities\classes\filesystem\paths\JsonStorageDirectoryPath;
use \Darling\PHPJsonStorageUtilities\enumerations\Type;
use \Darling\PHPJsonUtilities\classes\encoded\data\Json;

function determineType(Json $json): Type|ClassString
{
    $jsonDecoder = new JsonDecoder();
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
    $jsonStorageDirectoryPath = new JsonStorageDirectoryPath(new Name(new \Darling\PHPTextTypes\classes\strings\Text('Data' . strval(rand(1, 3)))));
    $location = new Location(new Name(new \Darling\PHPTextTypes\classes\strings\Text('Location' . strval(rand(1, 3)))));
    $container = new \Darling\PHPJsonStorageUtilities\classes\named\identifiers\Container(determineType($json));
    $owner = new Owner(new Name(new \Darling\PHPTextTypes\classes\strings\Text('Owner' . strval(rand(1, 3)))));
    $name = new Name(new \Darling\PHPTextTypes\classes\strings\Text('Name' . strval(rand(1, 3))));
    $id = new Id();
    $jsonFilePath = new JsonFilePath($jsonStorageDirectoryPath, $location, $container, $owner, $name, $id);
    $jsons[] = $json;
    $jsonStorageDirectoryPaths[] = $jsonStorageDirectoryPath;
    $locations[] = $location;
    $containers[] = $container;
    $owners[] = $owner;
    $names[] = $name;
    $ids[] = $id;
    $jsonFilePaths[] = $jsonFilePath;
    var_dump($jfsd->write($json, $jsonStorageDirectoryPath, $location, $owner, $name, $id));
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

echo PHP_EOL . PHP_EOL . 'Query: ' . $jfsq->__toString() . PHP_EOL . PHP_EOL;
var_dump($jfsd->read($jfsq));

