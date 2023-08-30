<?php

namespace Darling\PHPJsonStorageUtilities\classes\filesystem\storage\queries;

use \Darling\PHPJsonStorageUtilities\interfaces\filesystem\paths\JsonStorageDirectoryPath;
use \Darling\PHPJsonStorageUtilities\interfaces\filesystem\paths\JsonFilePath;
use \Darling\PHPJsonStorageUtilities\interfaces\filesystem\storage\queries\JsonStorageQuery as JsonStorageQueryInterface;

class JsonStorageQuery implements JsonStorageQueryInterface
{

    /**
     * Instantiate a new JsonStorageQuery instance.
     *
     * @param array<int, JsonStorageDirectoryPath>|null $jsonStorageDirectoryPaths
     * @param array<int, JsonFilePath>|null $jsonFilePaths
     *
     */
    public function __construct(
        private readonly array|null $jsonStorageDirectoryPaths = null,
        private readonly array|null $jsonFilePaths = null,
    ) { }

    public function jsonStorageDirectoryPaths(): array
    {
        return $this->jsonStorageDirectoryPaths ?? [];
    }

    public function jsonFilePaths(): array
    {
        return $this->jsonFilePaths ?? [];
    }
}

