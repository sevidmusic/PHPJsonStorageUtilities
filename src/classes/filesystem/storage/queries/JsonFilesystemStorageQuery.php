<?php

namespace Darling\PHPJsonStorageUtilities\classes\filesystem\storage\queries;

use \Darling\PHPJsonStorageUtilities\classes\filesystem\paths\JsonStorageDirectoryPath as JsonStorageDirectoryPathInstance;
use \Darling\PHPJsonStorageUtilities\interfaces\filesystem\paths\JsonFilePath;
use \Darling\PHPJsonStorageUtilities\interfaces\filesystem\paths\JsonStorageDirectoryPath;
use \Darling\PHPJsonStorageUtilities\interfaces\filesystem\storage\queries\JsonFilesystemStorageQuery as JsonFilesystemStorageQueryInterface;
use \Darling\PHPJsonStorageUtilities\interfaces\named\identifiers\Container;
use \Darling\PHPJsonStorageUtilities\interfaces\named\identifiers\Location;
use \Darling\PHPJsonStorageUtilities\interfaces\named\identifiers\Owner;
use \Darling\PHPTextTypes\classes\strings\Name as NameInstance;
use \Darling\PHPTextTypes\classes\strings\Text;
use \Darling\PHPTextTypes\interfaces\strings\Id;
use \Darling\PHPTextTypes\interfaces\strings\Name;

class JsonFilesystemStorageQuery implements JsonFilesystemStorageQueryInterface
{

    public function __construct(
        private JsonFilePath|null $jsonFilePath = null,
        private JsonStorageDirectoryPath|null $jsonStorageDirectoryPath = null,
        private Location|null $location = null,
        private Container|null $container = null,
        private Owner|null $owner = null,
        private Name|null $name = null,
        private Id|null $id = null,
    ) {}

    public function jsonStorageDirectoryPath(): JsonStorageDirectoryPath|null
    {
        return $this->jsonStorageDirectoryPath;
    }

    public function jsonFilePath(): JsonFilePath|null
    {
        return $this->jsonFilePath;
    }

    public function location(): Location|null
    {
        return $this->location;
    }

    public function container(): Container|null
    {
        return $this->container;
    }

    public function owner(): Owner|null
    {
        return $this->owner;
    }

    public function name(): Name|null
    {
        return $this->name;
    }

    public function id(): Id|null
    {
        return $this->id;
    }

    public function __toString(): string
    {
        if($this->jsonFilePath() instanceof JsonFilePath) {
            return $this->jsonFilePath()->__toString();
        }
        return (
            is_null($this->jsonStorageDirectoryPath())
            ? dirname($this->jsonStorageDirectoryPathInstance()) .
            DIRECTORY_SEPARATOR . '*'
            : $this->jsonStorageDirectoryPath()
        ) .
        DIRECTORY_SEPARATOR .
        (is_null($this->location()) ? '*' : $this->location()) .
        DIRECTORY_SEPARATOR .
        (is_null($this->container()) ? '*' : $this->container()) .
        DIRECTORY_SEPARATOR .
        (is_null($this->owner()) ? '*' : $this->owner()) .
        DIRECTORY_SEPARATOR .
        (is_null($this->name()) ? '*' : $this->name()) .
        DIRECTORY_SEPARATOR .
        (
            is_null($this->id())
            ? '*' . DIRECTORY_SEPARATOR . '*'
            : $this->shardId($this->id()) . '.json'
        );
    }

    private function jsonStorageDirectoryPathInstance(): JsonStorageDirectoryPath
    {
        return new JsonStorageDirectoryPathInstance(new NameInstance(new Text('DEFAULT')));
    }

    private function shardId(Id $id): string
    {
        $index = 3;
        $parentDir = substr($id->__toString(), 0, $index);
        $subDir = substr($id->__toString(), $index);
        return $parentDir . DIRECTORY_SEPARATOR . $subDir;
    }

}

