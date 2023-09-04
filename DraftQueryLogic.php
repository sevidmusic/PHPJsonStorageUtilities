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
use \Darling\PHPTextTypes\interfaces\strings\Id as IdInterface;
use \Darling\PHPTextTypes\classes\strings\Name;
use \Darling\PHPTextTypes\classes\strings\Text;


/**
 * Return an array of Json data read from stroage based on the
 * provided $query.
 *
 * @param JsonFilesystemStorageQuery $query
 *
 * @return array<string, Json|string>
 *
 */
function mockRead(JsonFilesystemStorageQuery $query) : array
{
    // @TODO : Will be replaced by $this->JsonDecoder()
    $jsonDecoder = new JsonDecoder();
    $jsonFilePath = $query->jsonFilePath();
    if($jsonFilePath instanceof JsonFilePath) {
        return [
            $jsonFilePath->id()->__toString()
            =>
            new Json(
                $jsonDecoder->decodeJsonString(
                    strval(
                        file_get_contents($jsonFilePath->__toString())
                    )
                )
            )
        ];
    }
    $globString =
        (
            is_null($query->jsonStorageDirectoryPath())
            ? dirname(jsonStorageDirectoryPathInstance()) .
            DIRECTORY_SEPARATOR . '*'
            : $query->jsonStorageDirectoryPath()
        ) .
        DIRECTORY_SEPARATOR .
        (is_null($query->location()) ? '*' : $query->location()) .
        DIRECTORY_SEPARATOR .
        (is_null($query->container()) ? '*' : $query->container()) .
        DIRECTORY_SEPARATOR .
        (is_null($query->owner()) ? '*' : $query->owner()) .
        DIRECTORY_SEPARATOR .
        (is_null($query->name()) ? '*' : $query->name()) .
        DIRECTORY_SEPARATOR .
        (
            is_null($query->id())
            ? '*' . DIRECTORY_SEPARATOR . '*'
            : shardId($query->id()) . '.json'
        );
    #echo 'GLOB STRING: ' . $globString . PHP_EOL;
    $files = glob($globString);
    $data = [];
    if(is_array($files)) {
        foreach($files as $file) {
            $data[deriverId($file)] = new Json(
                $jsonDecoder->decodeJsonString(
                    strval(file_get_contents($file))
                )
            );
        }
    }
    return $data;
}

function deriverId(string $filePath) : string
{
    return str_replace([dirname($filePath, 2), DIRECTORY_SEPARATOR, '.json'], '', $filePath);
}

function jsonStorageDirectoryPathInstance(): JsonStorageDirectoryPath
{
    return new JsonStorageDirectoryPath(new Name(new Text('DEFAULT')));
}

function shardId(IdInterface $id): string
{
    $index = 3;
    $parentDir = substr($id->__toString(), 0, $index);
    $subDir = substr($id->__toString(), $index);
    return $parentDir . DIRECTORY_SEPARATOR . $subDir;
}

$values = [
    new Id(),
    'foo' . str_shuffle('abcdefghijklmnopqrstuvwxyz0123456789'),
    floatval(strval(rand(0, 100)) . strval(rand(0, 100))),
    rand(PHP_INT_MIN, PHP_INT_MAX),
    true,
    false,
    null,
    0,
    function() { return rand(0, 1); },
        [
            rand(0, 100),
            'enabled' => 0,
            rand(0, 100),
            'active' => false,
            rand(0, 100),
        ],
];

$jsonDecoder = new JsonDecoder();

$jsonFilesystemStorageDriver = new JsonFilesystemStorageDriver();

$value = $values[array_rand($values)];

$json = new Json($value);

$storageDirectoryNamess = [
    'StorageDirectory1',
    'StorageDirectory2',
    'StorageDirectory3'
];

$jsonStorageDirectoryPath = new JsonStorageDirectoryPath(
    new Name(
        new Text($storageDirectoryNamess[array_rand($storageDirectoryNamess)])
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

$queries = [
    new JsonFilesystemStorageQuery(jsonFilePath: $jsonFilePath),
    new JsonFilesystemStorageQuery(jsonStorageDirectoryPath: $jsonStorageDirectoryPath),
    new JsonFilesystemStorageQuery(location: $location),
    new JsonFilesystemStorageQuery(container: $container),
    new JsonFilesystemStorageQuery(owner: $owner),
    new JsonFilesystemStorageQuery(name: $name),
    new JsonFilesystemStorageQuery(id: $id),
    new JsonFilesystemStorageQuery(jsonFilePath: $jsonFilePath, jsonStorageDirectoryPath: $jsonStorageDirectoryPath, location: $location, container: $container, owner: $owner, name: $name, id: $id,),
    new JsonFilesystemStorageQuery(),
];

$files = mockRead($queries[array_rand($queries)]);

var_dump($files);
