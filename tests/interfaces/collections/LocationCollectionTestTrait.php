<?php

namespace Darling\PHPJsonStorageUtilities\tests\interfaces\collections;

use \Darling\PHPJsonStorageUtilities\interfaces\collections\LocationCollection;
use \Darling\PHPJsonStorageUtilities\interfaces\named\identifiers\Location;

/**
 * The LocationCollectionTestTrait defines common tests for
 * implementations of the LocationCollection interface.
 *
 * @see LocationCollection
 *
 */
trait LocationCollectionTestTrait
{

    /**
     * @var LocationCollection $locationCollection
     *                              An instance of a
     *                              LocationCollection
     *                              implementation to test.
     */
    protected LocationCollection $locationCollection;

    /**
     * @var array<int, Location> $expectedCollection
     *                           The array of Location instances that
     *                           is expected to be returned by the
     *                           LocationCollection instance being
     *                           tested's collection() method.
     */
    private array $expectedCollection = [];

    /**
     * Set up an instance of a LocationCollection implementation to
     * test.
     *
     * This method must set the LocationCollection
     * implementation instance to be tested via the
     * setLocationCollectionTestInstance() method.
     *
     * This method must also set the array of Location
     * instances that is expected to be returned by the
     * LocationCollection instance being tested's
     * collection() method via the setExpectedCollection() method.
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
     *     $this->setExpectedCollection(
     *         [
     *             new Location(
     *                 new Name(new Text($this->randomChars())),
     *             ),
     *             new Location(
     *                 new Name(new Text($this->randomChars())),
     *             ),
     *             new Location(
     *                 new Name(new Text($this->randomChars())),
     *             ),
     *             new Location(
     *                 new Name(new Text($this->randomChars())),
     *             ),
     *             new Location(
     *                 new Name(new Text($this->randomChars())),
     *             ),
     *         ]
     *     );
     *     $this->setLocationCollectionTestInstance(
     *         new LocationCollection(
     *             ...$this->expectedCollection(),
     *         )
     *     );
     * }
     *
     * ```
     *
     */
    abstract protected function setUp(): void;

    /**
     * Return the LocationCollection implementation instance to test.
     *
     * @return LocationCollection
     *
     */
    protected function locationCollectionTestInstance(): LocationCollection
    {
        return $this->locationCollection;
    }

    /**
     * Set the LocationCollection implementation instance to test.
     *
     * @param LocationCollection $locationCollectionTestInstance
     *                                           An instance of an
     *                                           implementation of
     *                                           the
     *                                           LocationCollection
     *                                           interface to test.
     *
     * @return void
     *
     */
    protected function setLocationCollectionTestInstance(
        LocationCollection $locationCollectionTestInstance
    ): void
    {
        $this->locationCollection = $locationCollectionTestInstance;
    }

    /**
     * Set the array of Location instances that is expected to be
     * returned by the LocationCollection instance being tested's
     * collection() method.
     *
     * @param array<int, Location> $collection
     *
     * @return void
     *
     */
    protected function setExpectedCollection(array $collection): void
    {
        $this->expectedCollection = $collection;
    }

    /**
     * Return the array of Location instances that is expected to be
     * returned by the LocationCollection instance being tested's
     * collection() method.
     *
     * @return array<int, Location>
     *
     */
    protected function expectedCollection(): array
    {
        return $this->expectedCollection;
    }

    /**
     * Test collection() returns the expected array of Location
     * instances.
     *
     * @return void
     *
     * @covers LocationCollection->collection()
     *
     */
    public function test_collection_returns_the_expected_array_of_Location_instances(): void
    {
        $this->assertEquals(
            $this->expectedCollection(),
            $this->locationCollectionTestInstance()->collection(),
            $this->testFailedMessage(
                $this->locationCollectionTestInstance(),
                'collection',
                'return the expected array of Location instances'
            ),
        );
    }

    abstract protected static function assertEquals(mixed $expected, mixed $actual, string $message = ''): void;
    abstract protected function testFailedMessage(object $object, string $method, string $message): string;

}

