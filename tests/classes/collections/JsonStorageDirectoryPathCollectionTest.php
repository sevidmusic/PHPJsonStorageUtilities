<?php

namespace Darling\PHPJsonStorageUtilities\tests\classes\collections;

use \Darling\PHPJsonStorageUtilities\classes\collections\JsonStorageDirectoryPathCollection;
use \Darling\PHPJsonStorageUtilities\classes\filesystem\paths\JsonStorageDirectoryPath;
use \Darling\PHPJsonStorageUtilities\tests\PHPJsonStorageUtilitiesTest;
use \Darling\PHPJsonStorageUtilities\tests\interfaces\collections\JsonStorageDirectoryPathCollectionTestTrait;
use \Darling\PHPTextTypes\classes\strings\Name;
use \Darling\PHPTextTypes\classes\strings\Text;

class JsonStorageDirectoryPathCollectionTest extends PHPJsonStorageUtilitiesTest
{

    /**
     * The JsonStorageDirectoryPathCollectionTestTrait defines common
     * tests for implementations of the
     * Darling\PHPJsonStorageUtilities\interfaces\collections\JsonStorageDirectoryPathCollection
     * interface.
     *
     * @see JsonStorageDirectoryPathCollectionTestTrait
     *
     */
    use JsonStorageDirectoryPathCollectionTestTrait;

    public function setUp(): void
    {
        $this->setExpectedCollection(
            [
                new JsonStorageDirectoryPath(
                    new Name(new Text($this->randomChars())),
                ),
                new JsonStorageDirectoryPath(
                    new Name(new Text($this->randomChars())),
                ),
                new JsonStorageDirectoryPath(
                    new Name(new Text($this->randomChars())),
                ),
                new JsonStorageDirectoryPath(
                    new Name(new Text($this->randomChars())),
                ),
                new JsonStorageDirectoryPath(
                    new Name(new Text($this->randomChars())),
                ),
            ]
        );
        $this->setJsonStorageDirectoryPathCollectionTestInstance(
            new JsonStorageDirectoryPathCollection(
                ...$this->expectedCollection(),
            )
        );
    }

}

