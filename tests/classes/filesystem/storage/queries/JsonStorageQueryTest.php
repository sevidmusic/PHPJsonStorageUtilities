<?php

namespace Darling\PHPJsonStorageUtilities\tests\classes\filesystem\storage\queries;

use \Darling\PHPJsonStorageUtilities\classes\filesystem\paths\JsonStorageDirectoryPath;
use \Darling\PHPJsonStorageUtilities\classes\filesystem\storage\queries\JsonStorageQuery;
use \Darling\PHPJsonStorageUtilities\tests\PHPJsonStorageUtilitiesTest;
use \Darling\PHPJsonStorageUtilities\tests\interfaces\filesystem\storage\queries\JsonStorageQueryTestTrait;
use \Darling\PHPTextTypes\classes\strings\Name;
use \Darling\PHPTextTypes\classes\strings\Text;

class JsonStorageQueryTest extends PHPJsonStorageUtilitiesTest
{

    /**
     * The JsonStorageQueryTestTrait defines common tests for
     * implementations of the
     * Darling\PHPJsonStorageUtilities\interfaces\filesystem\storage\queries\JsonStorageQuery
     * interface.
     *
     * @see JsonStorageQueryTestTrait
     *
     */
    use JsonStorageQueryTestTrait;

    public function setUp(): void
    {
        $expectedJsonStorageDirectoryPaths = [
            new JsonStorageDirectoryPath(
                new Name(
                    new Text(
                        $this->randomChars()
                    )
                )
            ),
            new JsonStorageDirectoryPath(
                new Name(
                    new Text(
                        $this->randomChars()
                    )
                )
            ),
            new JsonStorageDirectoryPath(
                new Name(
                    new Text(
                        $this->randomChars()
                    )
                )
            ),
        ];
        $this->setExpectedJsonStorageDirectoryPaths(
            $expectedJsonStorageDirectoryPaths
        );
        $this->setJsonStorageQueryTestInstance(
            new JsonStorageQuery($expectedJsonStorageDirectoryPaths)
        );
    }
}

