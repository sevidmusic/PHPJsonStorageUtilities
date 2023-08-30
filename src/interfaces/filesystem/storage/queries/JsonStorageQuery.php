<?php

namespace Darling\PHPJsonStorageUtilities\interfaces\filesystem\storage\queries;

use \Darling\PHPJsonStorageUtilities\interfaces\filesystem\paths\JsonStorageDirectoryPath;
use \Darling\PHPJsonStorageUtilities\interfaces\filesystem\paths\JsonFilePath;

/**
 * Description of this interface.
 *
 * @example
 *
 * ```
 *
 * ```
 */
interface JsonStorageQuery
{


    /**
     * Return an array of JsonStorageDirectoryPath instances that
     * will determine which Json storage directories will be queried.
     *
     * @return array<int, JsonStorageDirectoryPath>
     *
     */
    public function jsonStorageDirectoryPaths(): array;

    /**
     * Return an array of JsonFilePath instances that will determine
     * which JsonFilePath will be queried.
     *
     * @return array<int, JsonFilePath>
     *
     */
    public function jsonFilePaths(): array;

}

