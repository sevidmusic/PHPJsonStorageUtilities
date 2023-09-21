<?php

namespace Darling\PHPJsonStorageUtilities\interfaces\collections;

use \Darling\PHPJsonStorageUtilities\interfaces\filesystem\paths\JsonStorageDirectoryPath;

/**
 * A JsonStorageDirectoryPathCollection is a collection of
 * JsonStorageDirectoryPath implementation instances.
 *
 */
interface JsonStorageDirectoryPathCollection
{

    /**
     * Return a numerically indexed array of JsonStorageDirectoryPath
     * implementation instances.
     *
     * @return array<int, JsonStorageDirectoryPath>
     *
     */
    public function collection(): array;

}

