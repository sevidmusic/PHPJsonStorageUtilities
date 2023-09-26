<?php

namespace Darling\PHPJsonStorageUtilities\tests\interfaces\named\identifiers;

use \Darling\PHPJsonStorageUtilities\interfaces\named\identifiers\Location;
use \Darling\PHPJsonStorageUtilities\tests\interfaces\named\identifiers\NamedIdentifierTestTrait;

/**
 * The LocationTestTrait defines common tests for implementations of
 * the Location interface.
 *
 * @see Location
 *
 */
trait LocationTestTrait
{

    use NamedIdentifierTestTrait;

    /**
     * @var Location $location An instance of a Location
     *                         implementation to test.
     */
    protected Location $location;

    /**
     * Set up an instance of a Location implementation to test.
     *
     * This method must set the Location implementation instance
     * to be tested via the setLocationTestInstance() method.
     *
     * This method must also set the Name that is expected to be
     * returned by the Location implementation instance being
     * tested's name() method via the setExpectedName() method.
     *
     * This method must also set the Location implementation
     * being tested as the NamedIdentifier implementation to
     * test via the setNamedIdentifierTestInstance() method.
     *
     * This method may also be used to perform any additional setup
     * required by the implementation being tested.
     *
     * @return void
     *
     * @example
     *
     * ```
     * public function setUp(): void
     * {
     *     $expectedName = new Name(new Text($this->randomChars()));
     *     $location = new Location($expectedName);
     *     $this->setExpectedName($expectedName);
     *     $this->setNamedIdentifierTestInstance($location);
     *     $this->setLocationTestInstance(
     *         new Location($expectedName)
     *     );
     * }
     *
     * ```
     *
     */
    abstract protected function setUp(): void;

    /**
     * Return the Location implementation instance to test.
     *
     * @return Location
     *
     */
    protected function locationTestInstance(): Location
    {
        return $this->location;
    }

    /**
     * Set the Location implementation instance to test.
     *
     * @param Location $locationTestInstance
     *                              An instance of an
     *                              implementation of
     *                              the Location
     *                              interface to test.
     *
     * @return void
     *
     */
    protected function setLocationTestInstance(
        Location $locationTestInstance
    ): void
    {
        $this->location = $locationTestInstance;
    }

}

