<?php

namespace Darling\PHPJsonStorageUtilities\interfaces\collections;

use \Darling\PHPJsonUtilities\interfaces\encoded\data\Json;

/**
 * A JsonCollection is a collection of Json implementation
 * instances.
 *
 */
interface JsonCollection
{

    /**
     * Return a numerically indexed array of Json implementation
     * instances.
     *
     * @return array<int, Json>
     *
     */
    public function collection(): array;

}

