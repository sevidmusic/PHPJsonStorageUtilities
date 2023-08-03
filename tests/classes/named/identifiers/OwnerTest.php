<?php

namespace Darling\PHPJsonStorageUtilities\tests\classes\named\identifiers;

use \Darling\PHPJsonStorageUtilities\classes\named\identifiers\Owner;
use \Darling\PHPJsonStorageUtilities\tests\PHPJsonStorageUtilitiesTest;
use \Darling\PHPJsonStorageUtilities\tests\interfaces\named\identifiers\OwnerTestTrait;
use \Darling\PHPTextTypes\classes\strings\Name;
use \Darling\PHPTextTypes\classes\strings\Text;

class OwnerTest extends PHPJsonStorageUtilitiesTest
{

    /**
     * The OwnerTestTrait defines common tests for implementations of
     * the Darling\PHPJsonStorageUtilities\interfaces\named\identifiers\Owner
     * interface.
     *
     * @see OwnerTestTrait
     *
     */
    use OwnerTestTrait;

    public function setUp(): void
    {
        $expectedName = new Name(new Text($this->randomChars()));
        $container = new Owner($expectedName);
        $this->setExpectedName($expectedName);
        $this->setNamedIdentifierTestInstance($container);
        $this->setOwnerTestInstance(
            new Owner($expectedName)
        );
    }
}

