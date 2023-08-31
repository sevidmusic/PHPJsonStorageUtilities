<?php

namespace Darling\PHPJsonStorageUtilities\tests\classes\filesystem\storage\queries;

use \Darling\PHPJsonStorageUtilities\classes\collections\ContainerCollection;
use \Darling\PHPJsonStorageUtilities\classes\collections\OwnerCollection;
use \Darling\PHPJsonStorageUtilities\classes\collections\IdCollection;
use \Darling\PHPJsonStorageUtilities\classes\collections\JsonStorageDirectoryPathCollection;
use \Darling\PHPJsonStorageUtilities\classes\collections\NameCollection;
use \Darling\PHPJsonStorageUtilities\classes\filesystem\paths\JsonFilePath;
use \Darling\PHPJsonStorageUtilities\classes\filesystem\paths\JsonStorageDirectoryPath;
use \Darling\PHPJsonStorageUtilities\classes\filesystem\storage\queries\JsonStorageQuery;
use \Darling\PHPJsonStorageUtilities\classes\named\identifiers\Container;
use \Darling\PHPJsonStorageUtilities\classes\named\identifiers\Location;
use \Darling\PHPJsonStorageUtilities\classes\named\identifiers\Owner;
use \Darling\PHPJsonStorageUtilities\tests\PHPJsonStorageUtilitiesTest;
use \Darling\PHPJsonStorageUtilities\tests\interfaces\filesystem\storage\queries\JsonStorageQueryTestTrait;
use \Darling\PHPTextTypes\classes\strings\ClassString;
use \Darling\PHPTextTypes\classes\strings\Id;
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
        $expectedJsonStorageDirectoryPaths =
            new JsonStorageDirectoryPathCollection(
                new JsonStorageDirectoryPath(
                    new Name(new Text($this->randomChars()))
                ),
                new JsonStorageDirectoryPath(
                    new Name(new Text($this->randomChars()))
                ),
                new JsonStorageDirectoryPath(
                    new Name(new Text($this->randomChars()))
                ),
            );
        $this->setExpectedJsonStorageDirectoryPaths(
            $expectedJsonStorageDirectoryPaths
        );
        $expectedJsonFilePaths = [
            new JsonFilePath(
                new JsonStorageDirectoryPath(
                    new Name(
                        new Text(
                            $this->randomChars()
                        )
                    )
                ),
                new Location(new Name(new Text($this->randomChars()))),
                new Container(new ClassString(Name::class)),
                new Owner(new Name(new Text($this->randomChars()))),
                new Name(new Text($this->randomChars())),
                new Id(),
            ),
        ];
        $this->setExpectedJsonFilePaths($expectedJsonFilePaths);
        $expectedLocations = [
            new Location(new Name(new Text($this->randomChars()))),
            new Location(new Name(new Text($this->randomChars()))),
            new Location(new Name(new Text($this->randomChars()))),
        ];
        $this->setExpectedLocations($expectedLocations);
        $expectedContainers = new ContainerCollection(
            new Container(new ClassString(Name::class)),
            new Container(new ClassString(Text::class)),
            new Container(new ClassString(Id::class)),
        );
        $this->setExpectedContainers($expectedContainers);
        $expectedOwners = new OwnerCollection(
            new Owner(new Name(new Text($this->randomChars()))),
            new Owner(new Name(new Text($this->randomChars()))),
            new Owner(new Name(new Text($this->randomChars()))),
        );
        $this->setExpectedOwners($expectedOwners);
        $expectedNames = new NameCollection(
            new Name(new Text($this->randomChars())),
            new Name(new Text($this->randomChars())),
            new Name(new Text($this->randomChars())),
        );
        $this->setExpectedNames($expectedNames);
        $expectedIds = new IdCollection(
            new Id(),
            new Id(),
            new Id(),
        );
        $this->setExpectedIds($expectedIds);
        $this->setJsonStorageQueryTestInstance(
            new JsonStorageQuery(
                jsonStorageDirectoryPaths: $expectedJsonStorageDirectoryPaths,
                jsonFilePaths: $expectedJsonFilePaths,
                locations: $expectedLocations,
                containers: $expectedContainers,
                owners: $expectedOwners,
                names: $expectedNames,
                ids: $expectedIds,
            )
        );
    }
}

