<?php

namespace Darling\PHPJsonStorageUtilities\interfaces\collections;

use \Darling\PHPJsonUtilities\interfaces\encoded\data\Json;

/**
 * Description of this interface.
 *
 * @example
 *
 * ```
 *
 * ```
 */
interface JsonCollection
{

    /**
     * Return a numerically indexed array of Json
     * instances.
     *
     * @return array<int, Json>
     *
     */
    public function collection(): array;

}

