<?php

namespace Darling\PHPJsonStorageUtilities\tests\classes\collections;

use \Darling\PHPJsonStorageUtilities\classes\collections\OwnerCollection;
use \Darling\PHPJsonStorageUtilities\classes\named\identifiers\Owner;
use \Darling\PHPJsonStorageUtilities\tests\PHPJsonStorageUtilitiesTest;
use \Darling\PHPJsonStorageUtilities\tests\interfaces\collections\OwnerCollectionTestTrait;
use \Darling\PHPTextTypes\classes\strings\Name;
use \Darling\PHPTextTypes\classes\strings\Text;

final class OwnerCollectionTest extends PHPJsonStorageUtilitiesTest
{

    /**
     * The OwnerCollectionTestTrait defines common tests for
     * implementations of the
     * Darling\PHPJsonStorageUtilities\interfaces\collections\OwnerCollection
     * interface.
     *
     * @see OwnerCollectionTestTrait
     *
     */
    use OwnerCollectionTestTrait;

    public function setUp(): void
    {
        $this->setExpectedCollection(
            [
                new Owner(
                    new Name(new Text($this->randomChars())),
                ),
                new Owner(
                    new Name(new Text($this->randomChars())),
                ),
                new Owner(
                    new Name(new Text($this->randomChars())),
                ),
                new Owner(
                    new Name(new Text($this->randomChars())),
                ),
                new Owner(
                    new Name(new Text($this->randomChars())),
                ),
            ]
        );
        $this->setOwnerCollectionTestInstance(
            new OwnerCollection(
                ...$this->expectedCollection(),
            )
        );
    }

}

