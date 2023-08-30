<?php

namespace Darling\PHPJsonStorageUtilities\classes\filesystem\storage\queries;

use \Darling\PHPJsonStorageUtilities\interfaces\filesystem\paths\JsonStorageDirectoryPath;
use \Darling\PHPJsonStorageUtilities\interfaces\filesystem\paths\JsonFilePath;
use \Darling\PHPJsonStorageUtilities\interfaces\named\identifiers\Location;
use \Darling\PHPJsonStorageUtilities\interfaces\named\identifiers\Container;
use \Darling\PHPJsonStorageUtilities\interfaces\filesystem\storage\queries\JsonStorageQuery as JsonStorageQueryInterface;

class JsonStorageQuery implements JsonStorageQueryInterface
{

    /**
     * Instantiate a new JsonStorageQuery instance.
     *
     * @param array<int, JsonStorageDirectoryPath>|null $jsonStorageDirectoryPaths
     * @param array<int, JsonFilePath>|null $jsonFilePaths
     * @param array<int, Location>|null $locations
     * @param array<int, Container>|null $containers
     *
     */
    public function __construct(
        private array|null $jsonStorageDirectoryPaths = null,
        private array|null $jsonFilePaths = null,
        private array|null $locations = null,
        private array|null $containers = null,
    ) { }

    public function jsonStorageDirectoryPaths(): array
    {
        return $this->jsonStorageDirectoryPaths ?? [];
    }

    public function jsonFilePaths(): array
    {
        return $this->jsonFilePaths ?? [];
    }

    public function locations(): array
    {
        return $this->locations ?? [];
    }

    public function containers(): array
    {
        return $this->containers ?? [];
    }
}

