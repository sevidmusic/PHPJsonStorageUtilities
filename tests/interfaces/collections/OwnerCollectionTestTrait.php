<?php

namespace Darling\PHPJsonStorageUtilities\tests\interfaces\collections;

use \Darling\PHPJsonStorageUtilities\interfaces\collections\OwnerCollection;
use \Darling\PHPJsonStorageUtilities\interfaces\named\identifiers\Owner;

/**
 * The OwnerCollectionTestTrait defines common tests for
 * implementations of the OwnerCollection interface.
 *
 * @see OwnerCollection
 *
 */
trait OwnerCollectionTestTrait
{

    /**
     * @var OwnerCollection $ownerCollection An instance of a
     *                                       OwnerCollection
     *                                       implementation
     *                                       to test.
     */
    protected OwnerCollection $ownerCollection;

    /**
     * @var array<int, Owner> $expectedCollection
     *                            The array of Owner instances that is
     *                            expected to be returned by the
     *                            OwnerCollection instance being
     *                            tested's collection() method.
     */
    private array $expectedCollection = [];

    /**
     * Set up an instance of a OwnerCollection implementation to test.
     *
     * This method must set the OwnerCollection implementation
     * instance to be tested via the setOwnerCollectionTestInstance()
     * method.
     *
     * This method must also set the array of Owner instances that is
     * expected to be returned by the OwnerCollection instance being
     * tested's collection() method via the setExpectedCollection()
     * method.
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
     *             new Owner(
     *                 new Name(new Text($this->randomChars())),
     *             ),
     *             new Owner(
     *                 new Name(new Text($this->randomChars())),
     *             ),
     *             new Owner(
     *                 new Name(new Text($this->randomChars())),
     *             ),
     *             new Owner(
     *                 new Name(new Text($this->randomChars())),
     *             ),
     *             new Owner(
     *                 new Name(new Text($this->randomChars())),
     *             ),
     *         ]
     *     );
     *     $this->setOwnerCollectionTestInstance(
     *         new OwnerCollection(
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
     * Return the OwnerCollection implementation instance to test.
     *
     * @return OwnerCollection
     *
     */
    protected function ownerCollectionTestInstance(): OwnerCollection
    {
        return $this->ownerCollection;
    }

    /**
     * Set the OwnerCollection implementation instance to test.
     *
     * @param OwnerCollection $ownerCollectionTestInstance
     *                            An instance of an implementation
     *                            of the OwnerCollection interface
     *                            to test.
     *
     * @return void
     *
     */
    protected function setOwnerCollectionTestInstance(
        OwnerCollection $ownerCollectionTestInstance
    ): void
    {
        $this->ownerCollection = $ownerCollectionTestInstance;
    }

    /**
     * Set the array of Owner instances that is expected to be
     * returned by the OwnerCollection instance being tested's
     * collection() method.
     *
     * @param array<int, Owner> $collection
     *
     * @return void
     *
     */
    protected function setExpectedCollection(array $collection): void
    {
        $this->expectedCollection = $collection;
    }

    /**
     * Return the array of Owner instances that is expected to be
     * returned by the OwnerCollection instance being tested's
     * collection() method.
     *
     * @return array<int, Owner>
     *
     */
    protected function expectedCollection(): array
    {
        return $this->expectedCollection;
    }

    /**
     * Test collection() returns the expected array of Owner
     * instances.
     *
     * @return void
     *
     * @covers OwnerCollection->collection()
     *
     */
    public function test_collection_returns_the_expected_array_of_Owner_instances(): void
    {
        $this->assertEquals(
            $this->expectedCollection(),
            $this->ownerCollectionTestInstance()->collection(),
            $this->testFailedMessage(
                $this->ownerCollectionTestInstance(),
                'collection',
                'return the expected array of Owner instances'
            ),
        );
    }

    abstract protected static function assertEquals(mixed $expected, mixed $actual, string $message = ''): void;
    abstract protected function testFailedMessage(object $object, string $method, string $message): string;

}

