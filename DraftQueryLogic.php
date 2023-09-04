<?php

include('/home/darling/Git/PHPJsonStorageUtilities/vendor/autoload.php');

use \Darling\PHPJsonStorageUtilities\enumerations\Type;
use \Darling\PHPJsonStorageUtilities\classes\filesystem\paths\JsonStorageDirectoryPath;
use \Darling\PHPJsonStorageUtilities\classes\filesystem\paths\JsonFilePath;
use \Darling\PHPJsonStorageUtilities\classes\filesystem\storage\drivers\JsonFilesystemStorageDriver;
use \Darling\PHPJsonStorageUtilities\classes\named\identifiers\Container;
use \Darling\PHPJsonStorageUtilities\classes\named\identifiers\Location;
use \Darling\PHPJsonStorageUtilities\classes\named\identifiers\Owner;
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

var_dump(
    $jsonFilesystemStorageDriver->write(
        $json,
        $jsonStorageDirectoryPath,
        $location,
        $owner,
        $name,
        $id
    )
);

$jsonFilePath = new JsonFilePath(
        $jsonStorageDirectoryPath,
        $location,
        $container,
        $owner,
        $name,
        $id
);

var_dump(file_get_contents($jsonFilePath->__toString()));

$query = new \Darling\PHPJsonStorageUtilities\classes\filesystem\storage\queries\JsonFilesystemStorageQuery(jsonStorageDirectoryPath: $jsonStorageDirectoryPath);

$files = glob(
        $query->jsonStorageDirectoryPath()->__toString() .
        DIRECTORY_SEPARATOR . '*'.
        DIRECTORY_SEPARATOR . '*'.
        DIRECTORY_SEPARATOR . '*'.
        DIRECTORY_SEPARATOR . '*'.
        DIRECTORY_SEPARATOR . '*'.
        DIRECTORY_SEPARATOR . '*'
    );

foreach($files as $file) {
    echo $file . PHP_EOL;
}

