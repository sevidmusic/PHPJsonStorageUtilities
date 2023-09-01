<?php

namespace Darling\PHPJsonStorageUtilities\classes\collections;

use \Darling\PHPJsonStorageUtilities\interfaces\collections\NameCollection as NameCollectionInterface;
use \Darling\PHPTextTypes\classes\strings\Name;

class NameCollection implements NameCollectionInterface
{

    /**
     * @var array<int, Name> $names
     */
    private array $names;

    public function __construct(
        Name ...$names
    ) {
        foreach($names as $name) {
            $this->names[] = $name;
        }
    }

    public function collection(): array
    {
        return $this->names;
    }

}
