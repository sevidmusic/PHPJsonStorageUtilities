<?php

namespace Darling\PHPJsonStorageUtilities\tests\classes\filesystem\storage\queries;

use \Darling\PHPJsonStorageUtilities\classes\filesystem\paths\JsonFilePath;
use \Darling\PHPJsonStorageUtilities\classes\filesystem\paths\JsonStorageDirectoryPath;
use \Darling\PHPJsonStorageUtilities\classes\filesystem\storage\queries\JsonFilesystemStorageQuery;
use \Darling\PHPJsonStorageUtilities\classes\named\identifiers\Container;
use \Darling\PHPJsonStorageUtilities\classes\named\identifiers\Location;
use \Darling\PHPJsonStorageUtilities\classes\named\identifiers\Owner;
use \Darling\PHPJsonStorageUtilities\tests\PHPJsonStorageUtilitiesTest;
use \Darling\PHPJsonStorageUtilities\tests\interfaces\filesystem\storage\queries\JsonFilesystemStorageQueryTestTrait;
use \Darling\PHPTextTypes\classes\strings\ClassString;
use \Darling\PHPTextTypes\classes\strings\Id;
use \Darling\PHPTextTypes\classes\strings\Name;
use \Darling\PHPTextTypes\classes\strings\Text;

class JsonFilesystemStorageQueryTest extends PHPJsonStorageUtilitiesTest
{

    /**
     * The JsonFilesystemStorageQueryTestTrait defines
     * common tests for implementations of the
     * Darling\PHPJsonStorageUtilities\interfaces\filesystem\storage\queries\JsonFilesystemStorageQuery
     * interface.
     *
     * @see JsonFilesystemStorageQueryTestTrait
     *
     */
    use JsonFilesystemStorageQueryTestTrait;

    public function setUp(): void
    {
        $jsonFilePath = new JsonFilePath(
            new JsonStorageDirectoryPath(new Name(new Text(self::TEST_STORAGE_DIRECTORY_NAME))),
            new Location(new Name(new Text($this->randomChars()))),
            new Container(new ClassString(Name::class)),
            new Owner(new Name(new Text($this->randomChars()))),
            new Name(new Text($this->randomChars())),
            new Id(),

        );
        $jsonStorageDirectoryPath = new JsonStorageDirectoryPath(
            new Name(
                new Text($this->randomChars())
            )
        );
        $location = new Location(new Name(new Text($this->randomChars())));
        $container = new Container(new ClassString($this->randomClassStringOrObjectInstance()));
        $owner = new Owner(new Name(new Text($this->randomChars())));
        $name = new Name(new Text($this->randomChars()));
        $id = new Id();
        $this->setExpectedId($id);
        $this->setExpectedName($name);
        $this->setExpectedOwner($owner);
        $this->setExpectedContainer($container);
        $this->setExpectedJsonStorageDirectoryPath($jsonStorageDirectoryPath);
        $this->setExpectedLocation($location);
        $this->setExpectedJsonFilePath($jsonFilePath);
        $this->setJsonFilesystemStorageQueryTestInstance(
            new JsonFilesystemStorageQuery(
                jsonFilePath: $jsonFilePath,
                jsonStorageDirectoryPath: $jsonStorageDirectoryPath,
                location: $location,
                container: $container,
                owner: $owner,
                name: $name,
                id: $id,
            )
        );
    }
}

