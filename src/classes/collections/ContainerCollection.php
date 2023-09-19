<?php

namespace Darling\PHPJsonStorageUtilities\classes\collections;

use \Darling\PHPJsonStorageUtilities\interfaces\collections\ContainerCollection as ContainerCollectionInterface;
use \Darling\PHPJsonStorageUtilities\interfaces\named\identifiers\Container;

final class ContainerCollection implements ContainerCollectionInterface
{

    /**
     * @var array<int, Container> $containers
     */
    private array $containers = [];

    public function __construct(Container ...$containers) {
        foreach($containers as $container) {
            $this->containers[] = $container;
        }
    }

    public function collection(): array
    {
        return $this->containers;
    }

}

