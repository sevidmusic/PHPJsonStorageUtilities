<?php

namespace Darling\PHPJsonStorageUtilities\tests\classes\collections;

use \Darling\PHPJsonStorageUtilities\classes\collections\LocationCollection;
use \Darling\PHPJsonStorageUtilities\classes\named\identifiers\Location;
use \Darling\PHPJsonStorageUtilities\tests\PHPJsonStorageUtilitiesTest;
use \Darling\PHPJsonStorageUtilities\tests\interfaces\collections\LocationCollectionTestTrait;
use \Darling\PHPTextTypes\classes\strings\Name;
use \Darling\PHPTextTypes\classes\strings\Text;

class LocationCollectionTest extends PHPJsonStorageUtilitiesTest
{

    /**
     * The LocationCollectionTestTrait defines common tests for
     * implementations of the
     * Darling\PHPJsonStorageUtilities\interfaces\collections\LocationCollection
     * interface.
     *
     * @see LocationCollectionTestTrait
     *
     */
    use LocationCollectionTestTrait;

    public function setUp(): void
    {
        $this->setExpectedCollection(
            [
                new Location(
                    new Name(new Text($this->randomChars())),
                ),
                new Location(
                    new Name(new Text($this->randomChars())),
                ),
                new Location(
                    new Name(new Text($this->randomChars())),
                ),
                new Location(
                    new Name(new Text($this->randomChars())),
                ),
                new Location(
                    new Name(new Text($this->randomChars())),
                ),
            ]
        );
        $this->setLocationCollectionTestInstance(
            new LocationCollection(
                ...$this->expectedCollection(),
            )
        );
    }

}

