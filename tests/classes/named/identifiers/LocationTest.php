<?php

namespace Darling\PHPJsonStorageUtilities\tests\classes\named\identifiers;

use \Darling\PHPJsonStorageUtilities\classes\named\identifiers\Location;
use \Darling\PHPJsonStorageUtilities\tests\PHPJsonStorageUtilitiesTest;
use \Darling\PHPJsonStorageUtilities\tests\interfaces\named\identifiers\LocationTestTrait;
use \Darling\PHPTextTypes\classes\strings\Name;
use \Darling\PHPTextTypes\classes\strings\Text;

final class LocationTest extends PHPJsonStorageUtilitiesTest
{

    /**
     * The LocationTestTrait defines common tests for implementations
     * of the
     * Darling\PHPJsonStorageUtilities\interfaces\named\identifiers\Location
     * interface.
     *
     * @see LocationTestTrait
     *
     */
    use LocationTestTrait;

    public function setUp(): void
    {
        $expectedName = new Name(new Text($this->randomChars()));
        $location = new Location($expectedName);
        $this->setExpectedName($expectedName);
        $this->setNamedIdentifierTestInstance($location);
        $this->setLocationTestInstance(
            new Location($expectedName)
        );
    }
}

