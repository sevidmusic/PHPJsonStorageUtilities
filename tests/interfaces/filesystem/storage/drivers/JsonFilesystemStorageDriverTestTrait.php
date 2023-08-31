<?php

namespace Darling\PHPJsonStorageUtilities\tests\interfaces\filesystem\storage\drivers;

use \Darling\PHPJsonStorageUtilities\interfaces\filesystem\storage\drivers\JsonFilesystemStorageDriver;
use \Darling\PHPJsonUtilities\interfaces\decoders\JsonDecoder;

/**
 * The JsonFilesystemStorageDriverTestTrait defines common tests for
 * implementations of the JsonFilesystemStorageDriver interface.
 *
 * @see JsonFilesystemStorageDriver
 *
 */
trait JsonFilesystemStorageDriverTestTrait
{

    /**
     * @var JsonFilesystemStorageDriver $jsonFilesystemStorageDriver
     *                              An instance of a
     *                              JsonFilesystemStorageDriver
     *                              implementation to test.
     */
    protected JsonFilesystemStorageDriver $jsonFilesystemStorageDriver;

    /**
     * Set up an instance of a JsonFilesystemStorageDriver implementation to test.
     *
     * This method must also set the JsonFilesystemStorageDriver implementation instance
     * to be tested via the setJsonFilesystemStorageDriverTestInstance() method.
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
     *     $this->setJsonFilesystemStorageDriverTestInstance(
     *         new \Darling\PHPJsonStorageUtilities\classes\filesystem\storage\drivers\JsonFilesystemStorageDriver()
     *     );
     * }
     *
     * ```
     *
     */
    abstract protected function setUp(): void;

    /**
     * Return the JsonFilesystemStorageDriver implementation instance to test.
     *
     * @return JsonFilesystemStorageDriver
     *
     */
    protected function jsonFilesystemStorageDriverTestInstance(): JsonFilesystemStorageDriver
    {
        return $this->jsonFilesystemStorageDriver;
    }

    /**
     * Set the JsonFilesystemStorageDriver implementation instance to test.
     *
     * @param JsonFilesystemStorageDriver $jsonFilesystemStorageDriverTestInstance
     *                              An instance of an
     *                              implementation of
     *                              the JsonFilesystemStorageDriver
     *                              interface to test.
     *
     * @return void
     *
     */
    protected function setJsonFilesystemStorageDriverTestInstance(
        JsonFilesystemStorageDriver $jsonFilesystemStorageDriverTestInstance
    ): void
    {
        $this->jsonFilesystemStorageDriver = $jsonFilesystemStorageDriverTestInstance;
    }

    /**
     * Test jsonDecoder() returns an instance of a JsonDecoder.
     *
     * @return void
     *
     * @covers JsonFilesystemStorageDriver->jsonDecoder()
     */
    public function test_jsonDecoder_returns_an_instance_of_a_JsonDecoder(): void
    {
        $this->assertTrue(
            $this->jsonFilesystemStorageDriverTestInstance()->jsonDecoder() instanceof JsonDecoder,
            $this->testFailedMessage(
                $this->jsonFilesystemStorageDriverTestInstance(),
                'jsonDecoder',
                'return an instance of a JsonDecoder',
            ),
        );
    }
}

