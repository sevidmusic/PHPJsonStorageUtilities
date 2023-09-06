<?php

namespace Darling\PHPJsonStorageUtilities\classes\filesystem\storage\drivers;

use \Darling\PHPJsonStorageUtilities\classes\filesystem\paths\JsonFilePath;
use \Darling\PHPJsonStorageUtilities\classes\named\identifiers\Container;
use \Darling\PHPJsonStorageUtilities\enumerations\Type;
use \Darling\PHPJsonStorageUtilities\interfaces\filesystem\paths\JsonStorageDirectoryPath;
use \Darling\PHPJsonStorageUtilities\interfaces\filesystem\storage\drivers\JsonFilesystemStorageDriver as JsonFilesystemStorageDriverInterface;
use \Darling\PHPJsonStorageUtilities\interfaces\filesystem\storage\queries\JsonFilesystemStorageQuery;
use \Darling\PHPJsonStorageUtilities\interfaces\named\identifiers\Location;
use \Darling\PHPJsonStorageUtilities\interfaces\named\identifiers\Owner;
use \Darling\PHPJsonUtilities\classes\decoders\JsonDecoder;
use \Darling\PHPJsonUtilities\interfaces\encoded\data\Json;
use \Darling\PHPTextTypes\classes\strings\ClassString;
use \Darling\PHPTextTypes\interfaces\strings\Id;
use \Darling\PHPTextTypes\interfaces\strings\Name;

class JsonFilesystemStorageDriver implements JsonFilesystemStorageDriverInterface
{

    public function jsonDecoder(): JsonDecoder
    {
        return new JsonDecoder();
    }

    public function write(
        Json $json,
        JsonStorageDirectoryPath $jsonStorageDirectoryPath,
        Location $location,
        Owner $owner,
        Name $name,
        Id $id,
    ): bool
    {
        $jsonFilePath = $this->jsonFilePath(
            $json,
            $jsonStorageDirectoryPath,
            $location,
            $owner,
            $name,
            $id,
        );
        if(file_exists($jsonFilePath->__toString())) {
            return false;
        }
        $parentDirectoryPath = dirname($jsonFilePath->__toString());
        if(!is_dir($parentDirectoryPath)) {
            mkdir($parentDirectoryPath, 0755, true);
        }
        if(is_dir($parentDirectoryPath)) {
            return file_put_contents(
                $jsonFilePath->__toString(),
                $json->__toString(),
                LOCK_EX
            ) > 0;
        }
        return false;
    }

    public function read(JsonFilesystemStorageQuery $jsonFilesystemStorageQuery): array {
        return [];
    }

    /**
     * Return an appropriate JsonFilePath.
     *
     * @return JsonFilePath
     *
     */
    private function jsonFilePath(
        Json $json,
        JsonStorageDirectoryPath $jsonStorageDirectoryPath,
        Location $location,
        Owner $owner,
        Name $name,
        Id $id,
    ): JsonFilePath
    {
        $container = new Container($this->determineType($json));
        return new JsonFilePath(
            $jsonStorageDirectoryPath,
            $location,
            $container,
            $owner,
            $name,
            $id,
        );
    }

    private function determineType(Json $json): Type|ClassString
    {
        $data = $this->jsonDecoder()->decode($json);
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
}

