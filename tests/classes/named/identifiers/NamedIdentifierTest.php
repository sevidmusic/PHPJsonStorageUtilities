<?php

namespace Darling\PHPJsonStorageUtilities\tests\classes\named\identifiers;

use \Darling\PHPJsonStorageUtilities\classes\named\identifiers\NamedIdentifier;
use \Darling\PHPJsonStorageUtilities\tests\PHPJsonStorageUtilitiesTest;
use \Darling\PHPJsonStorageUtilities\tests\interfaces\named\identifiers\NamedIdentifierTestTrait;
use \Darling\PHPTextTypes\classes\strings\Name;
use \Darling\PHPTextTypes\classes\strings\Text;

class NamedIdentifierTest extends PHPJsonStorageUtilitiesTest
{

    /**
     * The NamedIdentifierTestTrait defines common tests for
     * implementations of the
     * Darling\PHPJsonStorageUtilities\interfaces\named\identifiers\NamedIdentifier
     * interface.
     *
     * @see NamedIdentifierTestTrait
     *
     */
    use NamedIdentifierTestTrait;

    public function setUp(): void
    {
        $expectedName = new Name(new Text($this->randomChars()));
        $this->setExpectedName($expectedName);
        $this->setNamedIdentifierTestInstance(
            new NamedIdentifier($expectedName)
        );
    }
}

