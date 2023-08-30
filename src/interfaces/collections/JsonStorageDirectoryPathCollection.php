<?php

namespace Darling\PHPJsonStorageUtilities\interfaces\collections;

use \Darling\PHPJsonStorageUtilities\interfaces\filesystem\paths\JsonStorageDirectoryPath;

interface JsonStorageDirectoryPathCollection
{

    /**
     * Return a numerically indexed array of JsonStorageDirectoryPath
     * instances.
     *
     * @return array<int, JsonStorageDirectoryPath>
     *
     */
    public function collection(): array;

}