<?php

namespace Darling\PHPJsonStorageUtilities\tests\classes\collections;

use \Darling\PHPJsonStorageUtilities\classes\named\identifiers\Owner;
use \Darling\PHPJsonStorageUtilities\classes\named\identifiers\Location;
use \Darling\PHPJsonStorageUtilities\classes\named\identifiers\Container;
use \Darling\PHPJsonStorageUtilities\classes\collections\JsonFilePathCollection;
use \Darling\PHPJsonStorageUtilities\classes\filesystem\paths\JsonFilePath;
use \Darling\PHPJsonStorageUtilities\classes\filesystem\paths\JsonStorageDirectoryPath;
use \Darling\PHPJsonStorageUtilities\tests\PHPJsonStorageUtilitiesTest;
use \Darling\PHPJsonStorageUtilities\tests\interfaces\collections\JsonFilePathCollectionTestTrait;
use \Darling\PHPTextTypes\classes\strings\Name;
use \Darling\PHPTextTypes\classes\strings\Id;
use \Darling\PHPTextTypes\classes\strings\Text;
use \Darling\PHPTextTypes\classes\strings\ClassString;

class JsonFilePathCollectionTest extends PHPJsonStorageUtilitiesTest
{

    /**
     * The JsonFilePathCollectionTestTrait defines
     * common tests for implementations of the
     * Darling\PHPJsonStorageUtilities\interfaces\collections\JsonFilePathCollection
     * interface.
     *
     * @see JsonFilePathCollectionTestTrait
     *
     */
    use JsonFilePathCollectionTestTrait;

    public function setUp(): void
    {
        $this->setExpectedCollection(
            [
                new JsonFilePath(
                    new JsonStorageDirectoryPath(new Name(new Text($this->randomChars()))),
                    new Location(new Name(new Text($this->randomChars()))),
                    new Container(new ClassString(Id::class)),
                    new Owner(new Name(new Text($this->randomChars()))),
                    new Name(new Text($this->randomChars())),
                    new Id(),
                ),
            ]
        );
        $this->setJsonFilePathCollectionTestInstance(
            new JsonFilePathCollection(
                ...$this->expectedCollection(),
            )
        );
    }

}

