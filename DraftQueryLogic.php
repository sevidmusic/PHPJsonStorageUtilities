<?php

include('/home/darling/Git/PHPJsonStorageUtilities/vendor/autoload.php');

use \Darling\PHPJsonStorageUtilities\classes\filesystem\paths\JsonFilePath;
use \Darling\PHPJsonStorageUtilities\classes\filesystem\paths\JsonStorageDirectoryPath;
use \Darling\PHPJsonStorageUtilities\classes\filesystem\storage\drivers\JsonFilesystemStorageDriver;
use \Darling\PHPJsonStorageUtilities\classes\filesystem\storage\queries\JsonFilesystemStorageQuery;
use \Darling\PHPJsonStorageUtilities\classes\named\identifiers\Container;
use \Darling\PHPJsonStorageUtilities\classes\named\identifiers\Location;
use \Darling\PHPJsonStorageUtilities\classes\named\identifiers\Owner;
use \Darling\PHPJsonStorageUtilities\enumerations\Type;
use \Darling\PHPJsonUtilities\classes\decoders\JsonDecoder;
use \Darling\PHPJsonUtilities\classes\encoded\data\Json;
use \Darling\PHPTextTypes\classes\strings\ClassString;
use \Darling\PHPTextTypes\classes\strings\Id;
use \Darling\PHPTextTypes\classes\strings\Name;
use \Darling\PHPTextTypes\classes\strings\Text;

$values = [
    new Id(),
    'foo' . str_shuffle('abcdefghijklmnopqrstuvwxyz0123456789'),
    420.342342342342342,
    234,
    true,
    false,
    null,
    0,
    -123423234,
    -89273648239742346.23423847,
    function() { return rand(0, 1); },
    [1, 2, 3],
];

$jsonDecoder = new JsonDecoder();

$jsonFilesystemStorageDriver = new JsonFilesystemStorageDriver();

$value = $values[array_rand($values)];

$json = new Json($value);

$jsonStorageDirectoryPath = new JsonStorageDirectoryPath(
    new Name(
        new Text('StorageDirectoryName')
    )
);

$location = new Location(new Name(new Text('Location')));

$container = new Container(
    (
        is_object($value)
        ? new ClassString($value)
        : match(gettype($value)) {
            Type::Array->value => Type::Array,
            Type::Bool->value => Type::Bool,
            Type::Float->value => Type::Float,
            Type::Int->value => Type::Int,
            Type::Null->value => Type::Null,
            Type::String->value => Type::String,
        }
    )
);

$owner = new Owner(new Name(new Text('Owner')));

$name = new Name(new Text('Name'));

$id = new Id();

$jsonFilesystemStorageDriver->write(
    $json,
    $jsonStorageDirectoryPath,
    $location,
    $owner,
    $name,
    $id
);

$jsonFilePath = new JsonFilePath(
        $jsonStorageDirectoryPath,
        $location,
        $container,
        $owner,
        $name,
        $id
);

# var_dump(file_get_contents($jsonFilePath->__toString()));

$query = new JsonFilesystemStorageQuery(
    #jsonFilePath: $jsonFilePath,
    jsonStorageDirectoryPath: $jsonStorageDirectoryPath,
    #location: $location,
    container: $container,
    #owner: $owner,
    name: $name,
    #id: $id,
);

$globString =
    (is_null($query->jsonStorageDirectoryPath()) ? dirname($jsonStorageDirectoryPath) . DIRECTORY_SEPARATOR . '*': $query->jsonStorageDirectoryPath()) .
    DIRECTORY_SEPARATOR .
    (is_null($query->location()) ? '*' : $query->location()) .
    DIRECTORY_SEPARATOR .
    (is_null($query->container()) ? '*' : $query->container()) .
    DIRECTORY_SEPARATOR .
    (is_null($query->owner()) ? '*' : $query->owner()) .
    DIRECTORY_SEPARATOR .
    (is_null($query->name()) ? '*' : $query->name()) .
    DIRECTORY_SEPARATOR .
    (is_null($query->id()) ? '*' : $query->id()) .
    DIRECTORY_SEPARATOR . '*';




echo $globString;

$files = glob($globString);

var_dump(count($files));
