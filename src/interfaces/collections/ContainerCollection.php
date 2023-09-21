<?php

namespace Darling\PHPJsonStorageUtilities\interfaces\collections;

use \Darling\PHPJsonStorageUtilities\interfaces\named\identifiers\Container;

/**
 * A ContainerCollection is a collection of Container implementation
 * instances.
 *
 */
interface ContainerCollection
{

    /**
     * Return a numerically indexed array of Container implementation
     * instances.
     *
     * @return array<int, Container>
     *
     */
    public function collection(): array;

}

