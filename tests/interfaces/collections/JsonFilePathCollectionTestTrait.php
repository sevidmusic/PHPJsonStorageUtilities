<?php

namespace Darling\PHPJsonStorageUtilities\tests\interfaces\collections;

use \Darling\PHPJsonStorageUtilities\interfaces\collections\JsonFilePathCollection;
use \Darling\PHPJsonStorageUtilities\interfaces\filesystem\paths\JsonFilePath;

/**
 * The JsonFilePathCollectionTestTrait defines common tests for
 * implementations of the JsonFilePathCollection interface.
 *
 * @see JsonFilePathCollection
 *
 */
trait JsonFilePathCollectionTestTrait
{

    /**
     * @var JsonFilePathCollection $jsonFilePathCollection
     *                                 An instance of a
     *                                 JsonFilePathCollection
     *                                 implementation to test.
     */
    protected JsonFilePathCollection $jsonFilePathCollection;

    /**
     * @var array<int, JsonFilePath> $expectedCollection
     *                                   The array of JsonFilePath
     *                                   instances that is expected
     *                                   to be returned by the
     *                                   JsonFilePathCollection
     *                                   instance being tested's
     *                                   collection() method.
     */
    private array $expectedCollection = [];

    /**
     * Set up an instance of a JsonFilePathCollection implementation
     * to test.
     *
     * This method must set the JsonFilePathCollection
     * implementation instance to be tested via the
     * setJsonFilePathCollectionTestInstance() method.
     *
     * This method must also set the array of JsonFilePath instances
     * that is expected to be returned by the JsonFilePathCollection
     * instance being tested's collection() method via the
     * setExpectedCollection() method.
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
     *             new JsonFilePath(
     *                 new JsonStorageDirectoryPath(
     *                     new Name(new Text($this->randomChars()))
     *                 ),
     *                 new Location(
     *                     new Name(new Text($this->randomChars()))
     *                 ),
     *                 new Container(
     *                     new ClassString(Id::class)
     *                 ),
     *                 new Owner(
     *                     new Name(new Text($this->randomChars()))
     *                 ),
     *                 new Name(new Text($this->randomChars())),
     *                 new Id(),
     *             ),
     *         ]
     *     );
     *     $this->setJsonFilePathCollectionTestInstance(
     *         new JsonFilePathCollection(
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
     * Return the JsonFilePathCollection implementation instance to
     * test.
     *
     * @return JsonFilePathCollection
     *
     */
    protected function jsonFilePathCollectionTestInstance(): JsonFilePathCollection
    {
        return $this->jsonFilePathCollection;
    }

    /**
     * Set the JsonFilePathCollection implementation instance to test.
     *
     * @param JsonFilePathCollection $jsonFilePathCollectionTestInstance
     *                                   An instance of an
     *                                   implementation of
     *                                   the JsonFilePathCollection
     *                                   interface to test.
     *
     * @return void
     *
     */
    protected function setJsonFilePathCollectionTestInstance(
        JsonFilePathCollection $jsonFilePathCollectionTestInstance
    ): void
    {
        $this->jsonFilePathCollection = $jsonFilePathCollectionTestInstance;
    }

    /**
     * Set the array of JsonFilePath instances that is expected to be
     * returned by the JsonFilePathCollection instance being tested's
     * collection() method.
     *
     * @param array<int, JsonFilePath> $collection
     *
     * @return void
     *
     */
    protected function setExpectedCollection(array $collection): void
    {
        $this->expectedCollection = $collection;
    }

    /**
     * Return the array of JsonFilePath instances that is expected
     * to be returned by the JsonFilePathCollection instance being
     * tested's collection() method.
     *
     * @return array<int, JsonFilePath>
     *
     */
    protected function expectedCollection(): array
    {
        return $this->expectedCollection;
    }

    /**
     * Test collection() returns the expected array of JsonFilePath
     * instances.
     *
     * @return void
     *
     * @covers JsonFilePathCollection->collection()
     *
     */
    public function test_collection_returns_the_expected_array_of_JsonFilePath_instances(): void
    {
        $this->assertEquals(
            $this->expectedCollection(),
            $this->jsonFilePathCollectionTestInstance()->collection(),
            $this->testFailedMessage(
                $this->jsonFilePathCollectionTestInstance(),
                'collection',
                'return the expected array of JsonFilePath instances'
            ),
        );
    }

    abstract protected static function assertEquals(mixed $expected, mixed $actual, string $message = ''): void;
    abstract protected function testFailedMessage(object $object, string $method, string $message): string;

}

