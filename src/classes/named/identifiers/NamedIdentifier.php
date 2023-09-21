<?php

namespace Darling\PHPJsonStorageUtilities\classes\named\identifiers;

use \Darling\PHPJsonStorageUtilities\interfaces\named\identifiers\NamedIdentifier as NamedIdentifierInterface;
use \Darling\PHPTextTypes\classes\strings\Name;

class NamedIdentifier implements NamedIdentifierInterface
{

    /**
     * Instantiate a new NamedIdentifier  instance.
     *
     * @param Name $name
     *
     */
    public function __construct(private Name $name) {}

    public function name(): Name
    {
        return $this->name;
    }

    public function __toString(): string
    {
        return $this->name->__toString();
    }

}

