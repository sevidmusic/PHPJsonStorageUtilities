<?php

namespace Darling\PHPJsonStorageUtilities\interfaces\collections;

use \Darling\PHPTextTypes\interfaces\strings\Id;

/**
 * A IdCollection is a collection of Id implementation
 * instances.
 *
 */
interface IdCollection
{

    /**
     * Return a numerically indexed array of Id implementation
     * instances.
     *
     * @return array<int, Id>
     *
     */
    public function collection(): array;

}

