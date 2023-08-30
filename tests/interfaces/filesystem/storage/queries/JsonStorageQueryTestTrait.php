<?php

namespace Darling\PHPJsonStorageUtilities\tests\interfaces\filesystem\storage\queries;

use \Darling\PHPJsonStorageUtilities\interfaces\filesystem\paths\JsonStorageDirectoryPath;
use \Darling\PHPJsonStorageUtilities\interfaces\filesystem\storage\queries\JsonStorageQuery;

/**
 * The JsonStorageQueryTestTrait defines common tests for
 * implementations of the JsonStorageQuery interface.
 *
 * @see JsonStorageQuery
 *
 */
trait JsonStorageQueryTestTrait
{

    /**
     * @var JsonStorageQuery $jsonStorageQuery An instance of a
     *                                         JsonStorageQuery
     *                                         implementation to
     *                                         test.
     */
    protected JsonStorageQuery $jsonStorageQuery;

    /**
     * @var array<int, JsonStorageDirectoryPath> The array of
     *                                           JsonStorageDirectoryPath
     *                                           instances that is
     *                                           expected to be
     *                                           returned by the
     *                                           JsonStorageQuery
     *                                           being tested's
     *                                           jsonStorageDirectoryPaths()
     *                                           method.
     */
    private array $expectedJsonStorageDirectoryPaths;

    /**
     * Set up an instance of a JsonStorageQuery implementation to test.
     *
     * This method must also set the JsonStorageQuery implementation instance
     * to be tested via the setJsonStorageQueryTestInstance() method.
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
     *     $this->setJsonStorageQueryTestInstance(
     *         new \Darling\PHPJsonStorageUtilities\classes\filesystem\storage\queries\JsonStorageQuery()
     *     );
     * }
     *
     * ```
     *
     */
    abstract protected function setUp(): void;

    /**
     * Return the JsonStorageQuery implementation instance to test.
     *
     * @return JsonStorageQuery
     *
     */
    protected function jsonStorageQueryTestInstance(): JsonStorageQuery
    {
        return $this->jsonStorageQuery;
    }

    /**
     * Set the JsonStorageQuery implementation instance to test.
     *
     * @param JsonStorageQuery $jsonStorageQueryTestInstance
     *                              An instance of an
     *                              implementation of
     *                              the JsonStorageQuery
     *                              interface to test.
     *
     * @return void
     *
     */
    protected function setJsonStorageQueryTestInstance(
        JsonStorageQuery $jsonStorageQueryTestInstance
    ): void
    {
        $this->jsonStorageQuery = $jsonStorageQueryTestInstance;
    }

    /**
     * Set the array of JsonStorageDirectoryPath instances
     * that is expected to be returned by the JsonStorageQuery
     * instance being tested's jsonStorageDirectoryPaths() method.
     *
     * @param array<int, JsonStorageDirectoryPath> $jsonStorageDirectoryPaths
     *
     */
    protected function setExpectedJsonStorageDirectoryPaths(
        array $jsonStorageDirectoryPaths
    ): void
    {
        $this->expectedJsonStorageDirectoryPaths = $jsonStorageDirectoryPaths;
    }

    /**
     * Return the array of JsonStorageDirectoryPath instances
     * that is expected to be returned by the JsonStorageQuery
     * instance being tested's jsonStorageDirectoryPaths() method.
     *
     * @return array<int, JsonStorageDirectoryPath>
     *
     */
    protected function expectedJsonStorageDirectoryPaths(): array
    {
        return $this->expectedJsonStorageDirectoryPaths;
    }

    /**
     * Test that the jsonStorageDirectoryPaths() method returns the
     * expected array of JsonStorageDirectoryPath instances.
     *
     * @return void
     *
     * @covers JsonStorageQuery->jsonStorageDirectoryPaths()
     *
     */
    public function test_jsonStorageDirectoryPaths_returns_an_array_of_the_expected_JsonStorageDirectoryPath_instances(): void
    {
        $this->assertEquals(
            $this->expectedJsonStorageDirectoryPaths(),
            $this->jsonStorageQueryTestInstance()->jsonStorageDirectoryPaths(),
            $this->testFailedMessage(
                $this->jsonStorageQueryTestInstance(),
                'jsonStorageDirectoryPaths',
                'return an array of the expected ' .
                'JsonStorageDirectoryPath instances'
            ),
        );
    }

}

