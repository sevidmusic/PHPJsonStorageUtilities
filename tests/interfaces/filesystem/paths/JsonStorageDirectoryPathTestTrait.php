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

    private Name $expectedName;
    /**
     * @var JsonStorageDirectoryPath $jsonStorageDirectoryPath
     *                              An instance of a
     *                              JsonStorageDirectoryPath
     *                              implementation to test.
     */
    protected JsonStorageDirectoryPath $jsonStorageDirectoryPath;

    /**
     * Set up an instance of a JsonStorageDirectoryPath implementation to test.
     *
     * This method must also set the JsonStorageDirectoryPath implementation instance
     * to be tested via the setJsonStorageDirectoryPathTestInstance() method.
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
     * Return the JsonStorageDirectoryPath implementation instance to test.
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

    /**
     * Set the Name that is expected to be returned by the
     * JsonStorageDirectoryPath instance being tested's
     * directoryName() method.
     *
     * @return void
     *
     */
    protected function setExpectedName(Name $name): void
    {
        $this->expectedName = $name;
    }

    /**
     * Return the Name that is expected to be returned by the
     * JsonStorageDirectoryPath instance being tested's
     * directoryName() method.
     *
     * @return Name
     *
     */
    protected function expectedName(): Name
    {
        return $this->expectedName;
    }


    private function expectedRootDirectoryPath(): string
    {
        $userInfo = posix_getpwuid(posix_geteuid());
        return (
            is_array($userInfo)
            &&
            isset($userInfo['dir'])
            &&
            file_exists(
                $userInfo['dir'] .
                DIRECTORY_SEPARATOR .
                '.local' .
                DIRECTORY_SEPARATOR .
                'share'
            )
            ? $userInfo['dir'] .
            DIRECTORY_SEPARATOR .
            '.local' .
            DIRECTORY_SEPARATOR .
            'share'
            : DIRECTORY_SEPARATOR . 'tmp'
        );
    }

    private function expectedParentDirectoryPath(): string
    {
        return $this->expectedRootDirectoryPath() .
            DIRECTORY_SEPARATOR .
            'darling' .
            DIRECTORY_SEPARATOR .
            'data';

    }

    private function expectedStorageDirectoryPath(): string
    {
        return $this->expectedParentDirectoryPath() .
            DIRECTORY_SEPARATOR .
            $this->expectedName();
    }

    /**
     * Test that the name() method returns the expected Name.
     *
     * @return void
     *
     * @covers JsonStorageDirectoryPath::directoryName()
     *
     */
    public function test_directoryName_returns_the_expected_name(): void
    {
        $this->assertEquals(
            $this->expectedName(),
            $this->jsonStorageDirectoryPathTestInstance()->directoryName(),
            $this->testFailedMessage(
                $this->jsonStorageDirectoryPathTestInstance(),
                'directoryName',
                'return the expected Name.',
            ),
        );
    }

    /**
     * Test rootDirectoryPath returns the expected root directroy path.
     *
     * @return void
     *
     * @covers JsonStorageDirectoryPath->rootDirectoryPath()
     */
    public function test_rootDirectoryPath_returns_the_expectedRootDirectroyPath(): void {
        $this->assertEquals(
            $this->expectedRootDirectoryPath(),
            $this->jsonStorageDirectoryPathTestInstance()->rootDirectoryPath(),
            $this->testFailedMessage(
                $this->jsonStorageDirectoryPathTestInstance(),
                'rootDirectoryPath',
                'return the expected root directory path: ' .
                $this->expectedRootDirectoryPath(),
            ),
        );
    }

    /**
     * Test parentDirectoryPath returns the expected root directroy path.
     *
     * @return void
     *
     * @covers JsonStorageDirectoryPath->parentDirectoryPath()
     */
    public function test_parentDirectoryPath_returns_the_expectedParentDirectroyPath(): void {
        $this->assertEquals(
            $this->expectedParentDirectoryPath(),
            $this->jsonStorageDirectoryPathTestInstance()->parentDirectoryPath(),
            $this->testFailedMessage(
                $this->jsonStorageDirectoryPathTestInstance(),
                'parentDirectoryPath',
                'return the expected parent directory path: ' .
                $this->expectedParentDirectoryPath(),
            ),
        );
    }

    /**
     * Test storageDirectoryPath returns the expected root directroy path.
     *
     * @return void
     *
     * @covers JsonStorageDirectoryPath->storageDirectoryPath()
     */
    public function test_storageDirectoryPath_returns_the_expectedStorageDirectroyPath(): void {
        $this->assertEquals(
            $this->expectedStorageDirectoryPath(),
            $this->jsonStorageDirectoryPathTestInstance()->storageDirectoryPath(),
            $this->testFailedMessage(
                $this->jsonStorageDirectoryPathTestInstance(),
                'storageDirectoryPath',
                'return the expected storage directory path: ' .
                $this->expectedStorageDirectoryPath(),
            ),
        );
    }

    /**
     * Test __toString returns the expected root directroy path.
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
}

