<?php

namespace Darling\PHPJsonStorageUtilities\interfaces\collections;

use \Darling\PHPTextTypes\classes\strings\Name;

interface NameCollection
{

    /**
     * Return a numerically indexed array of Name instances.
     *
     * @return array<int, Name>
     *
     */
    public function collection(): array;

}
