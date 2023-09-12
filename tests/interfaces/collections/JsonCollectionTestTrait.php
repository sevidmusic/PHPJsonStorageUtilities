<?php

namespace Darling\PHPJsonStorageUtilities\tests\interfaces\collections;

use \Darling\PHPJsonStorageUtilities\interfaces\collections\JsonCollection;
use \Darling\PHPJsonUtilities\interfaces\encoded\data\Json;

/**
 * The JsonCollectionTestTrait defines common tests for
 * implementations of the JsonCollection interface.
 *
 * @see JsonCollection
 *
 */
trait JsonCollectionTestTrait
{

    /**
     * @var JsonCollection $jsonCollection
     *                              An instance of a
     *                              JsonCollection
     *                              implementation to test.
     */
    protected JsonCollection $jsonCollection;

    /**
     * @var array<int, Json> $expectedCollection The array of Json
     *                                           instances that is
     *                                           expected to be
     *                                           returned by the
     *                                           JsonCollection
     *                                           instance being
     *                                           tested's
     *                                           collection()
     *                                           method.
     */
    private array $expectedCollection = [];

    /**
     * Set up an instance of a JsonCollection implementation to test.
     *
     * This method must also set the JsonCollection implementation instance
     * to be tested via the setJsonCollectionTestInstance() method.
     *
     * This method may also be used to perform any additional setup
     * required by the implementation being tested.
     *
     * @return void
     *
     * @example
     *
     * ```
     * protected function setUp(): void
     * {
     *     $this->setJsonCollectionTestInstance(
     *         new \Darling\PHPJsonStorageUtilities\classes\collections\JsonCollection()
     *     );
     * }
     *
     * ```
     *
     */
    abstract protected function setUp(): void;

    /**
     * Return the JsonCollection implementation instance to test.
     *
     * @return JsonCollection
     *
     */
    protected function jsonCollectionTestInstance(): JsonCollection
    {
        return $this->jsonCollection;
    }

    /**
     * Set the JsonCollection implementation instance to test.
     *
     * @param JsonCollection $jsonCollectionTestInstance
     *                              An instance of an
     *                              implementation of
     *                              the JsonCollection
     *                              interface to test.
     *
     * @return void
     *
     */
    protected function setJsonCollectionTestInstance(
        JsonCollection $jsonCollectionTestInstance
    ): void
    {
        $this->jsonCollection = $jsonCollectionTestInstance;
    }

    /**
     * Set the array of Json instances that is
     * expected to be returned by the JsonCollection
     * instance being tested's collection() method.
     *
     * @param array<int, Json> $collection
     *
     * @return void
     *
     */
    protected function setExpectedCollection(array $collection): void
    {
        $this->expectedCollection = $collection;
    }

    /**
     * Return the array of Json instances that is
     * expected to be returned by the JsonCollection
     * instance being tested's collection() method.
     *
     * @return array<int, Json>
     *
     */
    protected function expectedCollection(): array
    {
        return $this->expectedCollection;
    }

    /**
     * Test collection() returns the expected array of
     * Json instances.
     *
     * @return void
     *
     * @covers JsonCollection->collection()
     *
     */
    public function test_collection_returns_the_expected_array_of_Json_instances(): void
    {
        $this->assertEquals(
            $this->expectedCollection(),
            $this->jsonCollectionTestInstance()->collection(),
            $this->testFailedMessage(
                $this->jsonCollectionTestInstance(),
                'collection',
                'return the expected array of Json instances'
            ),
        );
    }
}

