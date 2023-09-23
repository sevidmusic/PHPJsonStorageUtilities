<?php

namespace Darling\PHPJsonStorageUtilities\tests\classes\filesystem\paths;

use \Darling\PHPJsonStorageUtilities\classes\filesystem\paths\JsonFilePath;
use \Darling\PHPJsonStorageUtilities\classes\filesystem\paths\JsonStorageDirectoryPath;
use \Darling\PHPJsonStorageUtilities\classes\named\identifiers\Container;
use \Darling\PHPJsonStorageUtilities\classes\named\identifiers\Location;
use \Darling\PHPJsonStorageUtilities\classes\named\identifiers\Owner;
use \Darling\PHPJsonStorageUtilities\tests\PHPJsonStorageUtilitiesTest;
use \Darling\PHPJsonStorageUtilities\tests\interfaces\filesystem\paths\JsonFilePathTestTrait;
use \Darling\PHPTextTypes\classes\strings\ClassString;
use \Darling\PHPTextTypes\classes\strings\Id;
use \Darling\PHPTextTypes\classes\strings\Name;
use \Darling\PHPTextTypes\classes\strings\Text;

final class JsonFilePathTest extends PHPJsonStorageUtilitiesTest
{

    /**
     * The JsonFilePathTestTrait defines
     * common tests for implementations of the
     * Darling\PHPJsonStorageUtilities\interfaces\filesystem\paths\JsonFilePath
     * interface.
     *
     * @see JsonFilePathTestTrait
     *
     */
    use JsonFilePathTestTrait;

    public function setUp(): void
    {
        $expectedJsonStorageDirectoryPath = new JsonStorageDirectoryPath(
            new Name(
                new Text(
                    $this->randomChars()
                )
            )
        );
        $expectedLocation = new Location(
            new Name(
                new Text(
                    $this->randomChars()
                )
            )
        );
        $expectedContainer = new Container(
            new ClassString(
                new Name(
                    new Text(
                        $this->randomChars()
                    )
                )
            )
        );
        $expectedOwner = new Owner(
            new Name(
                new Text(
                    $this->randomChars()
                )
            )
        );
        $expectedName = new Name(
            new Text(
                $this->randomChars()
            )
        );
        $expectedId = new Id();
        $this->setExpectedJsonStorageDirectoryPath($expectedJsonStorageDirectoryPath);
        $this->setExpectedLocation($expectedLocation);
        $this->setExpectedContainer($expectedContainer);
        $this->setExpectedOwner($expectedOwner);
        $this->setExpectedName($expectedName);
        $this->setExpectedId($expectedId);
        $this->setJsonFilePathTestInstance(
            new JsonFilePath(
                $expectedJsonStorageDirectoryPath,
                $expectedLocation,
                $expectedContainer,
                $expectedOwner,
                $expectedName,
                $expectedId,
            )
        );
    }
}

