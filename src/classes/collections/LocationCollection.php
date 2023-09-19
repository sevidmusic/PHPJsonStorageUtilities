<?php

namespace Darling\PHPJsonStorageUtilities\classes\collections;

use \Darling\PHPJsonStorageUtilities\interfaces\collections\LocationCollection as LocationCollectionInterface;
use \Darling\PHPJsonStorageUtilities\interfaces\named\identifiers\Location;

final class LocationCollection implements LocationCollectionInterface
{

    /**
     * @var array<int, Location> $locations
     */
    private array $locations = [];

    public function __construct(Location ...$locations) {
        foreach($locations as $location) {
            $this->locations[] = $location;
        }
    }

    public function collection(): array
    {
        return $this->locations;
    }

}

