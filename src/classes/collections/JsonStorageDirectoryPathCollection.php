<?php

namespace Darling\PHPJsonStorageUtilities\classes\collections;

use \Darling\PHPJsonStorageUtilities\interfaces\collections\JsonStorageDirectoryPathCollection as JsonStorageDirectoryPathCollectionInterface;
use \Darling\PHPJsonStorageUtilities\interfaces\filesystem\paths\JsonStorageDirectoryPath;

final class JsonStorageDirectoryPathCollection implements JsonStorageDirectoryPathCollectionInterface
{


    /**
     * @var array<int, JsonStorageDirectoryPath> $jsonStorageDirectoryPaths
     */
    private array $jsonStorageDirectoryPaths;

    public function __construct(
        JsonStorageDirectoryPath ...$jsonStorageDirectoryPaths
    ) {
        foreach($jsonStorageDirectoryPaths as $jsonStorageDirectoryPath) {
            $this->jsonStorageDirectoryPaths[] = $jsonStorageDirectoryPath;
        }
    }

    public function collection(): array
    {
        return $this->jsonStorageDirectoryPaths;
    }

}

