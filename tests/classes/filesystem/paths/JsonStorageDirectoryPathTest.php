<?php

namespace Darling\PHPJsonStorageUtilities\tests\classes\filesystem\paths;

use \Darling\PHPJsonStorageUtilities\classes\filesystem\paths\JsonStorageDirectoryPath;
use \Darling\PHPJsonStorageUtilities\tests\PHPJsonStorageUtilitiesTest;
use \Darling\PHPJsonStorageUtilities\tests\interfaces\filesystem\paths\JsonStorageDirectoryPathTestTrait;
use \Darling\PHPTextTypes\classes\strings\Name;
use \Darling\PHPTextTypes\classes\strings\Text;

final class JsonStorageDirectoryPathTest extends PHPJsonStorageUtilitiesTest
{

    /**
     * The JsonStorageDirectoryPathTestTrait defines common tests for
     * implementations of the
     * \Darling\PHPJsonStorageUtilities\interfaces\filesystem\paths\JsonStorageDirectoryPath interface.
     *
     * @see JsonStorageDirectoryPathTestTrait
     *
     */
    use JsonStorageDirectoryPathTestTrait;

    public function setUp(): void
    {
        $expectedName = new Name(new Text($this->randomChars()));
        $this->setExpectedName($expectedName);
        $this->setJsonStorageDirectoryPathTestInstance(
            new JsonStorageDirectoryPath($expectedName)
        );
    }
}

