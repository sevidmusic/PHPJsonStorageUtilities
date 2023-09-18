<?php

namespace Darling\PHPJsonStorageUtilities\classes\collections;

use \Darling\PHPJsonStorageUtilities\interfaces\collections\JsonFilePathCollection as JsonFilePathCollectionInterface;
use \Darling\PHPJsonStorageUtilities\interfaces\filesystem\paths\JsonFilePath;

final class JsonFilePathCollection implements JsonFilePathCollectionInterface
{

    /**
     * @var array<int, JsonFilePath> $jsonFilePaths
     */
    private array $jsonFilePaths = [];

    public function __construct(
        JsonFilePath ...$jsonFilePaths
    ) {
        foreach($jsonFilePaths as $jsonFilePath) {
            $this->jsonFilePaths[] = $jsonFilePath;
        }
    }

    public function collection(): array
    {
        return $this->jsonFilePaths;
    }

}

