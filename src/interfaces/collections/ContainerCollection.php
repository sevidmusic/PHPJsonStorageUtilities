<?php

namespace Darling\PHPJsonStorageUtilities\interfaces\collections;

use \Darling\PHPJsonStorageUtilities\interfaces\named\identifiers\Container;

interface ContainerCollection
{

    /**
     * Return a numerically indexed array of Container instances.
     *
     * @return array<int, Container>
     *
     */
    public function collection(): array;

}
