<?php

namespace Darling\PHPJsonStorageUtilities\interfaces\collections;

use \Darling\PHPJsonStorageUtilities\interfaces\filesystem\paths\JsonFilePath;

/**
 * A JsonFilePathCollection is a collection of JsonFilePath
 * implementation instances.
 *
 */
interface JsonFilePathCollection
{

    /**
     * Return a numerically indexed array of JsonFilePath
     * instances.
     *
     * @return array<int, JsonFilePath>
     *
     */
    public function collection(): array;

}
