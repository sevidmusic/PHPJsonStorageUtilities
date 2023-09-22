<?php

namespace Darling\PHPJsonStorageUtilities\interfaces\named\identifiers;

use \Darling\PHPTextTypes\interfaces\strings\Name;
use \Stringable;

/**
 * A NamedIdentifier can be used to identify stored Json.
 *
 */
interface NamedIdentifier extends Stringable
{

    /**
     * Return the Name of this NamedIdentifier.
     *
     * @return Name
     *
     */
    public function name(): Name;

}

