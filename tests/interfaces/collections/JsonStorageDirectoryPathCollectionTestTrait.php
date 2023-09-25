<?php

namespace Darling\PHPJsonStorageUtilities\tests\interfaces\collections;

use \Darling\PHPJsonStorageUtilities\interfaces\collections\JsonStorageDirectoryPathCollection;
use \Darling\PHPJsonStorageUtilities\interfaces\filesystem\paths\JsonStorageDirectoryPath;

/**
 * The JsonStorageDirectoryPathCollectionTestTrait defines common
 * tests for implementations of the JsonStorageDirectoryPathCollection
 * interface.
 *
 * @see JsonStorageDirectoryPathCollection
 *
 */
trait JsonStorageDirectoryPathCollectionTestTrait
{

    /**
     * @var JsonStorageDirectoryPathCollection $jsonStorageDirectoryPathCollection
     *                              An instance of a
     *                              JsonStorageDirectoryPathCollection
     *                              implementation to test.
     */
    protected JsonStorageDirectoryPathCollection $jsonStorageDirectoryPathCollection;

    /**
     * @var array<int, JsonStorageDirectoryPath> $expectedCollection
     *                              The array of
     *                              JsonStorageDirectoryPath
     *                              instances that is
     *                              expected to be
     *                              returned by the
     *                              JsonStorageDirectoryPathCollection
     *                              instance being
     *                              tested's collection()
     *                              method.
     */
    private array $expectedCollection = [];

    /**
     * Set up an instance of a JsonStorageDirectoryPathCollection
     * implementation to test.
     *
     * This method must set the JsonStorageDirectoryPathCollection
     * implementation instance to be tested via the
     * setJsonStorageDirectoryPathCollectionTestInstance() method.
     *
     * This method must also set the array of JsonStorageDirectoryPath
     * instances that is expected to be returned by the
     * JsonStorageDirectoryPathCollection instance being tested's
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
     *             new JsonStorageDirectoryPath(
     *                 new Name(new Text($this->randomChars())),
     *             ),
     *             new JsonStorageDirectoryPath(
     *                 new Name(new Text($this->randomChars())),
     *             ),
     *             new JsonStorageDirectoryPath(
     *                 new Name(new Text($this->randomChars())),
     *             ),
     *             new JsonStorageDirectoryPath(
     *                 new Name(new Text($this->randomChars())),
     *             ),
     *             new JsonStorageDirectoryPath(
     *                 new Name(new Text($this->randomChars())),
     *             ),
     *         ]
     *     );
     *     $this->setJsonStorageDirectoryPathCollectionTestInstance(
     *         new JsonStorageDirectoryPathCollection(
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
     * Return the JsonStorageDirectoryPathCollection implementation
     * instance to test.
     *
     * @return JsonStorageDirectoryPathCollection
     *
     */
    protected function jsonStorageDirectoryPathCollectionTestInstance(): JsonStorageDirectoryPathCollection
    {
        return $this->jsonStorageDirectoryPathCollection;
    }

    /**
     * Set the JsonStorageDirectoryPathCollection implementation
     * instance to test.
     *
     * @param JsonStorageDirectoryPathCollection $jsonStorageDirectoryPathCollectionTestInstance
     *                                           An instance of an
     *                                           implementation of
     *                                           the
     *                                           JsonStorageDirectoryPathCollection
     *                                           interface to test.
     *
     * @return void
     *
     */
    protected function setJsonStorageDirectoryPathCollectionTestInstance(
        JsonStorageDirectoryPathCollection $jsonStorageDirectoryPathCollectionTestInstance
    ): void
    {
        $this->jsonStorageDirectoryPathCollection =
            $jsonStorageDirectoryPathCollectionTestInstance;
    }

    /**
     * Set the array of JsonStorageDirectoryPath instances that is
     * expected to be returned by the JsonStorageDirectoryPathCollection
     * instance being tested's collection() method.
     *
     * @param array<int, JsonStorageDirectoryPath> $collection
     *
     * @return void
     *
     */
    protected function setExpectedCollection(array $collection): void
    {
        $this->expectedCollection = $collection;
    }

    /**
     * Return the array of JsonStorageDirectoryPath instances that is
     * expected to be returned by the JsonStorageDirectoryPathCollection
     * instance being tested's collection() method.
     *
     * @return array<int, JsonStorageDirectoryPath>
     *
     */
    protected function expectedCollection(): array
    {
        return $this->expectedCollection;
    }

    /**
     * Test collection() returns the expected array of
     * JsonStorageDirectoryPath instances.
     *
     * @return void
     *
     * @covers JsonStorageDirectoryPathCollection->collection()
     *
     */
    public function test_collection_returns_the_expected_array_of_JsonStorageDirectoryPath_instances(): void
    {
        $this->assertEquals(
            $this->expectedCollection(),
            $this->jsonStorageDirectoryPathCollectionTestInstance()->collection(),
            $this->testFailedMessage(
                $this->jsonStorageDirectoryPathCollectionTestInstance(),
                'collection',
                'return the expected array of JsonStorageDirectoryPath instances'
            ),
        );
    }

    abstract protected static function assertEquals(mixed $expected, mixed $actual, string $message = ''): void;
    abstract protected function testFailedMessage(object $object, string $method, string $message): string;

}

