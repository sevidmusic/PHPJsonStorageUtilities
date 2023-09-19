<?php

namespace Darling\PHPJsonStorageUtilities\classes\collections;

use \Darling\PHPJsonStorageUtilities\interfaces\collections\IdCollection as IdCollectionInterface;
use \Darling\PHPTextTypes\interfaces\strings\Id;

final class IdCollection implements IdCollectionInterface
{

    /**
     * @var array<int, Id> $ids
     */
    private array $ids = [];

    public function __construct(Id ...$ids) {
        foreach($ids as $id) {
            $this->ids[] = $id;
        }
    }

    public function collection(): array
    {
        return $this->ids;
    }

}

