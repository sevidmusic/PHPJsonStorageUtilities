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

final class JsonFilesystemStorageQueryTest extends PHPJsonStorageUtilitiesTest
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
            new JsonStorageDirectoryPath(
                new Name(
                    new Text(
                        PHPJsonStorageUtilitiesTest::TEST_STORAGE_DIRECTORY_NAME
                    )
                )
            ),
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
        $locations = [
            new Location(new Name(new Text($this->randomChars()))),
            null
        ];
        $location = $locations[array_rand($locations)];
        $containers = [
            new Container(
                new ClassString(
                    $this->randomClassStringOrObjectInstance()
                )
            ),
            null
        ];
        $container = $containers[array_rand($containers)];
        $owners = [
            new Owner(new Name(new Text($this->randomChars()))),
            null
        ];
        $owner = $owners[array_rand($owners)];
        $names = [new Name(new Text($this->randomChars())), null];
        $name = $names[array_rand($names)];
        $ids = [new Id(), null];
        $id = $ids[array_rand($ids)];
        $this->setExpectedId($id);
        $this->setExpectedName($name);
        $this->setExpectedOwner($owner);
        $this->setExpectedContainer($container);
        $this->setExpectedJsonStorageDirectoryPath(
            $jsonStorageDirectoryPath
        );
        $this->setExpectedLocation($location);
        $this->setExpectedJsonFilePath($jsonFilePath);
        $query = new JsonFilesystemStorageQuery(
            jsonFilePath: $jsonFilePath,
            jsonStorageDirectoryPath: $jsonStorageDirectoryPath,
            location: $location,
            container: $container,
            owner: $owner,
            name: $name,
            id: $id
        );
        $this->setJsonFilesystemStorageQueryTestInstance($query);
    }
}

