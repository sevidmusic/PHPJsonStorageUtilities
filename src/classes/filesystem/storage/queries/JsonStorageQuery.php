<?php

namespace Darling\PHPJsonStorageUtilities\classes\filesystem\storage\queries;

use \Darling\PHPJsonStorageUtilities\interfaces\filesystem\paths\JsonStorageDirectoryPath;
use \Darling\PHPJsonStorageUtilities\interfaces\filesystem\storage\queries\JsonStorageQuery as JsonStorageQueryInterface;

class JsonStorageQuery implements JsonStorageQueryInterface
{

    /**
     * Instantiate a new JsonStorageQuery instance.
     *
     * @param array<int, JsonStorageDirectoryPath> $jsonStorageDirectoryPaths
     *
     */
    public function __construct(
        private readonly array $jsonStorageDirectoryPaths,
    ) { }

    public function jsonStorageDirectoryPaths(): array
    {
        return $this->jsonStorageDirectoryPaths;
    }

}

