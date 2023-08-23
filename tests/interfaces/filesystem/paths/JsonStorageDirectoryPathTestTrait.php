<?php

namespace Darling\PHPJsonStorageUtilities\tests\interfaces\filesystem\paths;

use \Darling\PHPJsonStorageUtilities\interfaces\filesystem\paths\JsonStorageDirectoryPath;
use \Darling\PHPTextTypes\classes\strings\Name;

/**
 * The JsonStorageDirectoryPathTestTrait defines common tests for
 * implementations of the JsonStorageDirectoryPath interface.
 *
 * @see JsonStorageDirectoryPath
 *
 */
trait JsonStorageDirectoryPathTestTrait
{

    /**
     * @var JsonStorageDirectoryPath $jsonStorageDirectoryPath
     *                              An instance of a
     *                              JsonStorageDirectoryPath
     *                              implementation to test.
     */
    protected JsonStorageDirectoryPath $jsonStorageDirectoryPath;

    private Name $expectedName;

    /**
     * Set up an instance of a JsonStorageDirectoryPath implementation
     * to test.
     *
     * This method must also set the JsonStorageDirectoryPath
     * implementation instance to be tested via the
     * setJsonStorageDirectoryPathTestInstance() method.
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
     *     $this->setJsonStorageDirectoryPathTestInstance(
     *         new \Darling\PHPJsonStorageUtilities\classes\filesystem\paths\JsonStorageDirectoryPath()
     *     );
     * }
     *
     * ```
     *
     */
    abstract protected function setUp(): void;

    /**
     * Return the JsonStorageDirectoryPath implementation instance to
     * test.
     *
     * @return JsonStorageDirectoryPath
     *
     */
    protected function jsonStorageDirectoryPathTestInstance(): JsonStorageDirectoryPath
    {
        return $this->jsonStorageDirectoryPath;
    }

    /**
     * Set the JsonStorageDirectoryPath implementation instance to test.
     *
     * @param JsonStorageDirectoryPath $jsonStorageDirectoryPathTestInstance
     *                              An instance of an
     *                              implementation of
     *                              the JsonStorageDirectoryPath
     *                              interface to test.
     *
     * @return void
     *
     */
    protected function setJsonStorageDirectoryPathTestInstance(
        JsonStorageDirectoryPath $jsonStorageDirectoryPathTestInstance
    ): void
    {
        $this->jsonStorageDirectoryPath = $jsonStorageDirectoryPathTestInstance;
    }

    private function expectedStorageDirectoryPath(): string
    {
        $userInfo = posix_getpwuid(posix_geteuid());
        if(is_array($userInfo) && isset($userInfo['dir'])) {
            $storageDirectoryPath = realpath(
                $userInfo['dir'] .
                DIRECTORY_SEPARATOR .
                '.local' .
                DIRECTORY_SEPARATOR .
                'share'
            );
        }
        return (
            isset($storageDirectoryPath)
            &&
            $storageDirectoryPath !== false
            &&
            is_writable($storageDirectoryPath)
            ? $storageDirectoryPath
            : DIRECTORY_SEPARATOR . 'tmp'
        ) .
        DIRECTORY_SEPARATOR .
        'darling' .
        DIRECTORY_SEPARATOR .
        'data' .
        DIRECTORY_SEPARATOR .
        $this->expectedName()->__toString();
    }

    private function setExpectedName(Name $name): void
    {
        $this->expectedName = $name;
    }

    private function expectedName(): Name
    {
        return $this->expectedName;
    }

    /**
     * Test __toString() returns the expected root directroy path.
     *
     * @return void
     *
     * @covers JsonStorageDirectoryPath->__toString()
     */
    public function test___toString_returns_the_expectedStorageDirectroyPath(): void {
        $this->assertEquals(
            $this->expectedStorageDirectoryPath(),
            $this->jsonStorageDirectoryPathTestInstance()->__toString(),
            $this->testFailedMessage(
                $this->jsonStorageDirectoryPathTestInstance(),
                '__toString',
                'return the expected storage directory path: ' .
                $this->expectedStorageDirectoryPath(),
            ),
        );
    }

    /**
     * Test name() returns the expected name.
     * @return void
     *
     * @covers JsonStorageDirectoryPath->name()
     */
    public function test_name_returns_the_expected_name(): void
    {
        $this->assertEquals(
            $this->expectedName(),
            $this->jsonStorageDirectoryPathTestInstance()->name(),
            $this->testFailedMessage(
                $this->jsonStorageDirectoryPathTestInstance(),
                'name',
                'return the expected name: ' .
                $this->expectedName(),
            ),
        );
    }
}

