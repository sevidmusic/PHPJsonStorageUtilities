<?php

namespace Darling\PHPJsonStorageUtilities\tests\classes\collections;

use \Darling\PHPJsonStorageUtilities\classes\collections\NameCollection;
use \Darling\PHPJsonStorageUtilities\tests\PHPJsonStorageUtilitiesTest;
use \Darling\PHPJsonStorageUtilities\tests\interfaces\collections\NameCollectionTestTrait;
use \Darling\PHPTextTypes\classes\strings\Name;
use \Darling\PHPTextTypes\classes\strings\Text;

class NameCollectionTest extends PHPJsonStorageUtilitiesTest
{

    /**
     * The NameCollectionTestTrait defines common tests for
     * implementations of the
     * Darling\PHPJsonStorageUtilities\interfaces\collections\NameCollection
     * interface.
     *
     * @see NameCollectionTestTrait
     *
     */
    use NameCollectionTestTrait;

    public function setUp(): void
    {
        $this->setExpectedCollection(
            [
                new Name(new Text($this->randomChars())),
                new Name(new Text($this->randomChars())),
                new Name(new Text($this->randomChars())),
                new Name(new Text($this->randomChars())),
                new Name(new Text($this->randomChars())),
            ]
        );
        $this->setNameCollectionTestInstance(
            new NameCollection(
                ...$this->expectedCollection(),
            )
        );
    }

}

