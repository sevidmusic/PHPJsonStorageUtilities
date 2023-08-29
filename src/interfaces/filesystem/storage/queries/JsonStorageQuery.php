<?php

namespace Darling\PHPJsonStorageUtilities\interfaces\filesystem\storage\queries;

use \Darling\PHPJsonStorageUtilities\interfaces\filesystem\paths\JsonStorageDirectoryPath;

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
     * will determine which Json storage directory's will be queried.
     *
     * @return array<int, JsonStorageDirectoryPath>
     *
     */
    public function jsonStorageDirectoryPaths(): array;

}

