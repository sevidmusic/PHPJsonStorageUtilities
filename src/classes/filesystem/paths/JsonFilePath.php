<?php

namespace Darling\PHPJsonStorageUtilities\classes\filesystem\paths;

use \Darling\PHPJsonStorageUtilities\interfaces\filesystem\paths\JsonFilePath as JsonFilePathInterface;
use \Darling\PHPJsonStorageUtilities\interfaces\named\identifiers\Container;
use \Darling\PHPJsonStorageUtilities\interfaces\named\identifiers\Location;
use \Darling\PHPJsonStorageUtilities\interfaces\named\identifiers\Owner;
use \Darling\PHPJsonStorageUtilities\tests\interfaces\filesystem\paths\JsonFilePathTestTrait;
use \Darling\PHPTextTypes\interfaces\strings\Id;
use \Darling\PHPTextTypes\interfaces\strings\Name;

class JsonFilePath implements JsonFilePathInterface
{

    public function __construct(
        private JsonStorageDirectoryPath $jsonStorageDirectoryPath,
        private Location $location,
        private Container $container,
        private Owner $owner,
        private Name $name,
        private Id $id,
    )
    {
    }

    public function jsonStorageDirectoryPath(): JsonStorageDirectoryPath
    {
        return $this->jsonStorageDirectoryPath;
    }

    public function location(): Location
    {
        return $this->location;
    }

    public function container(): Container
    {
        return $this->container;
    }

    public function owner(): Owner
    {
        return $this->owner;
    }

    public function name(): Name
    {
        return $this->name;
    }

    public function id(): Id
    {
        return $this->id;
    }

    public function __toString(): string
    {
        return $this->jsonStorageDirectoryPath()->__toString() .
            DIRECTORY_SEPARATOR .
            $this->location()->__toString() .
            DIRECTORY_SEPARATOR .
            $this->container()->__toString() .
            DIRECTORY_SEPARATOR .
            $this->owner()->__toString() .
            DIRECTORY_SEPARATOR .
            $this->name()->__toString() .
            DIRECTORY_SEPARATOR .
            $this->shardId($this->id()) .
            '.json';
    }

    private function shardId(Id $id): string
    {
        $index = 3;
        $parentDir = substr($id->__toString(), 0, $index);
        $subDir = substr($id->__toString(), $index);
        return $parentDir . DIRECTORY_SEPARATOR . $subDir;
    }
}

