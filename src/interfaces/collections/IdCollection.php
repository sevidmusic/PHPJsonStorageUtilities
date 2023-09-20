<?php

namespace Darling\PHPJsonStorageUtilities\interfaces\collections;

use \Darling\PHPTextTypes\interfaces\strings\Id;

interface IdCollection
{

    /**
     * Return a numerically indexed array of Id instances.
     *
     * @return array<int, Id>
     *
     */
    public function collection(): array;

}
