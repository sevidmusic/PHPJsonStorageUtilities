<?php

namespace Darling\PHPJsonStorageUtilities\tests\classes\identifiers;

use \Darling\PHPJsonStorageUtilities\classes\identifiers\Owner;
use \Darling\PHPJsonStorageUtilities\tests\PHPJsonStorageUtilitiesTest;
use \Darling\PHPJsonStorageUtilities\tests\interfaces\identifiers\OwnerTestTrait;

class OwnerTest extends PHPJsonStorageUtilitiesTest
{

    /**
     * The OwnerTestTrait defines
     * common tests for implementations of the
     * Darling\PHPJsonStorageUtilities\interfaces\identifiers\Owner
     * interface.
     *
     * @see OwnerTestTrait
     *
     */
    use OwnerTestTrait;

    public function setUp(): void
    {
        $this->setOwnerTestInstance(
            new Owner()
        );
    }
}

