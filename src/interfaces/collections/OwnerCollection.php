<?php

namespace Darling\PHPJsonStorageUtilities\interfaces\collections;

use \Darling\PHPJsonStorageUtilities\interfaces\named\identifiers\Owner;

interface OwnerCollection
{

    /**
     * Return a numerically indexed array of Owner instances.
     *
     * @return array<int, Owner>
     *
     */
    public function collection(): array;

}
