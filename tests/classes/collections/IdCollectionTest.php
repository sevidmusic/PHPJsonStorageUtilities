<?php

namespace Darling\PHPJsonStorageUtilities\tests\classes\collections;

use \Darling\PHPJsonStorageUtilities\classes\collections\IdCollection;
use \Darling\PHPJsonStorageUtilities\tests\PHPJsonStorageUtilitiesTest;
use \Darling\PHPJsonStorageUtilities\tests\interfaces\collections\IdCollectionTestTrait;
use \Darling\PHPTextTypes\classes\strings\Id;
use \Darling\PHPTextTypes\classes\strings\Name;
use \Darling\PHPTextTypes\classes\strings\Text;

class IdCollectionTest extends PHPJsonStorageUtilitiesTest
{

    /**
     * The IdCollectionTestTrait defines
     * common tests for implementations of the
     * Darling\PHPJsonStorageUtilities\interfaces\collections\IdCollection
     * interface.
     *
     * @see IdCollectionTestTrait
     *
     */
    use IdCollectionTestTrait;

    public function setUp(): void
    {
        $this->setExpectedCollection(
            [
                new Id(),
                new Id(),
                new Id(),
                new Id(),
                new Id(),
            ]
        );
        $this->setIdCollectionTestInstance(
            new IdCollection(
                ...$this->expectedCollection(),
            )
        );
    }

}

