<?php

namespace Darling\PHPJsonStorageUtilities\tests\interfaces\collections;

use \Darling\PHPJsonStorageUtilities\interfaces\collections\IdCollection;
use \Darling\PHPTextTypes\interfaces\strings\Id;

/**
 * The IdCollectionTestTrait defines common tests for implementations
 * of the IdCollection interface.
 *
 * @see IdCollection
 *
 */
trait IdCollectionTestTrait
{

    /**
     * @var IdCollection $idCollection An instance of a IdCollection
     *                                 implementation to test.
     */
    protected IdCollection $idCollection;

    /**
     * @var array<int, Id> The array of Id instances that is expected
     *                     to be returned by the IdCollection instance
     *                     being tested's collection() method.
     */
    private array $expectedCollection = [];

    /**
     * Set up an instance of a IdCollection implementation to test.
     *
     * This method must set the IdCollection implementation instance
     * to be tested via the setIdCollectionTestInstance() method.
     *
     * This method must also set the array of Id instances that is
     * expected to be returned by the IdCollection instance being
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
     *             new Id(),
     *             new Id(),
     *             new Id(),
     *             new Id(),
     *             new Id(),
     *         ]
     *     );
     *     $this->setIdCollectionTestInstance(
     *         new IdCollection(
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
     * Return the IdCollection implementation instance to test.
     *
     * @return IdCollection
     *
     */
    protected function idCollectionTestInstance(): IdCollection
    {
        return $this->idCollection;
    }

    /**
     * Set the IdCollection implementation instance to test.
     *
     * @param IdCollection $idCollectionTestInstance An instance of an
     *                                               implementation of
     *                                               the IdCollection
     *                                               interface to
     *                                               test.
     *
     * @return void
     *
     */
    protected function setIdCollectionTestInstance(
        IdCollection $idCollectionTestInstance
    ): void
    {
        $this->idCollection = $idCollectionTestInstance;
    }

    /**
     * Set the array of Id instances that is expected to be returned
     * by the IdCollection instance being tested's collection()
     * method.
     *
     * @param array<int, Id> $collection
     *
     * @return void
     *
     */
    protected function setExpectedCollection(array $collection): void
    {
        $this->expectedCollection = $collection;
    }

    /**
     * Return the array of Id instances that is expected to be
     * returned by the IdCollection instance being tested's
     * collection() method.
     *
     * @return array<int, Id>
     *
     */
    protected function expectedCollection(): array
    {
        return $this->expectedCollection;
    }

    /**
     * Test collection() returns the expected array of Id instances.
     *
     * @return void
     *
     * @covers IdCollection->collection()
     *
     */
    public function test_collection_returns_the_expected_array_of_Id_instances(): void
    {
        $this->assertEquals(
            $this->expectedCollection(),
            $this->idCollectionTestInstance()->collection(),
            $this->testFailedMessage(
                $this->idCollectionTestInstance(),
                'collection',
                'return the expected array of Id instances'
            ),
        );
    }

    abstract protected static function assertEquals(mixed $expected, mixed $actual, string $message = ''): void;
    abstract protected function testFailedMessage(object $object, string $method, string $message): string;

}

