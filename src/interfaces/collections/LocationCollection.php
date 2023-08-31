<?php

namespace Darling\PHPJsonStorageUtilities\interfaces\collections;

use \Darling\PHPJsonStorageUtilities\interfaces\named\identifiers\Location;

interface LocationCollection
{

    /**
     * Return a numerically indexed array of Location
     * instances.
     *
     * @return array<int, Location>
     *
     */
    public function collection(): array;

}
