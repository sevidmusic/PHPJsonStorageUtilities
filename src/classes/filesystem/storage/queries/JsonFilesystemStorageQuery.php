<?php

namespace Darling\PHPJsonStorageUtilities\classes\filesystem\storage\queries;

use \Darling\PHPJsonStorageUtilities\interfaces\filesystem\paths\JsonFilePath;
use \Darling\PHPJsonStorageUtilities\interfaces\filesystem\paths\JsonStorageDirectoryPath;
use \Darling\PHPJsonStorageUtilities\interfaces\filesystem\storage\queries\JsonFilesystemStorageQuery as JsonFilesystemStorageQueryInterface;
use \Darling\PHPJsonStorageUtilities\interfaces\named\identifiers\Container;
use \Darling\PHPJsonStorageUtilities\interfaces\named\identifiers\Location;
use \Darling\PHPJsonStorageUtilities\interfaces\named\identifiers\Owner;
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

}

