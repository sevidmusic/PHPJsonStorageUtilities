<?php

namespace Darling\PHPJsonStorageUtilities\interfaces\collections;

use \Darling\PHPJsonStorageUtilities\interfaces\named\identifiers\Owner;

/**
 * A OwnerCollection is a collection of Owner implementation
 * instances.
 *
 */
interface OwnerCollection
{

    /**
     * Return a numerically indexed array of Owner implementation
     * instances.
     *
     * @return array<int, Owner>
     *
     */
    public function collection(): array;

}

