<?php

namespace Darling\PHPJsonStorageUtilities\classes\collections;

use \Darling\PHPJsonStorageUtilities\interfaces\collections\OwnerCollection as OwnerCollectionInterface;
use \Darling\PHPJsonStorageUtilities\interfaces\named\identifiers\Owner;

final class OwnerCollection implements OwnerCollectionInterface
{


    /**
     * @var array<int, Owner> $owners
     */
    private array $owners;

    public function __construct(
        Owner ...$owners
    ) {
        foreach($owners as $owner) {
            $this->owners[] = $owner;
        }
    }

    public function collection(): array
    {
        return $this->owners;
    }

}

