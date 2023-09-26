<?php

namespace Darling\PHPJsonStorageUtilities\tests\classes\filesystem\storage\drivers;

use \Darling\PHPJsonStorageUtilities\classes\filesystem\paths\JsonFilePath;
use \Darling\PHPJsonStorageUtilities\classes\filesystem\paths\JsonStorageDirectoryPath;
use \Darling\PHPJsonStorageUtilities\classes\filesystem\storage\drivers\JsonFilesystemStorageDriver;
use \Darling\PHPJsonStorageUtilities\classes\named\identifiers\Container;
use \Darling\PHPJsonStorageUtilities\classes\named\identifiers\Location;
use \Darling\PHPJsonStorageUtilities\classes\named\identifiers\Owner;
use \Darling\PHPJsonStorageUtilities\tests\PHPJsonStorageUtilitiesTest;
use \Darling\PHPJsonStorageUtilities\tests\interfaces\filesystem\storage\drivers\JsonFilesystemStorageDriverTestTrait;
use \Darling\PHPJsonUtilities\classes\encoded\data\Json;
use \Darling\PHPTextTypes\classes\strings\Id;
use \Darling\PHPTextTypes\classes\strings\Name;
use \Darling\PHPTextTypes\classes\strings\Text;
use \Darling\PHPJsonStorageUtilities\tests\IntegrationTestUtilities;

final class JsonFilesystemStorageDriverTest extends PHPJsonStorageUtilitiesTest
{

    private const USERS_HOME_DIRECTORY_PATH_INDEX = 'dir';

    /**
     * The JsonFilesystemStorageDriverTestTrait defines common tests
     * for implementations of the
     * Darling\PHPJsonStorageUtilities\interfaces\filesystem\storage\drivers\JsonFilesystemStorageDriver
     * interface.
     *
     * @see JsonFilesystemStorageDriverTestTrait
     *
     */
    use JsonFilesystemStorageDriverTestTrait;

    public function setUp(): void
    {
        $testData = [
            $this->randomChars(),
            $this->randomClassStringOrObjectInstance(),
            $this->randomFloat(),
            $this->randomObjectInstance(),
            $this->prefixedRandomName($this->randomChars()),
        ];
        $json = new Json($testData[array_rand($testData)]);
        $this->setExpectedJson($json);
        $container = new Container(
            IntegrationTestUtilities::determineType($this->expectedJson())
        );
        $jsonFilePath = new JsonFilePath(
            new JsonStorageDirectoryPath(
                new Name(new Text(self::TEST_STORAGE_DIRECTORY_NAME)),
            ),
            new Location($this->prefixedRandomName('Location')),
            $container,
            new Owner($this->prefixedRandomName('Owner')),
            $this->prefixedRandomName('Name'),
            new Id(),
        );
        $this->setExpectedJsonFilePath($jsonFilePath);
        $this->setJsonFilesystemStorageDriverTestInstance(
            new JsonFilesystemStorageDriver()
        );
        IntegrationTestUtilities::deleteTestJsonStorageDirectory(
            $this->expectedJsonFilePath()
                 ->jsonStorageDirectoryPath()
        );
    }

    /**
     * Return the path to the current users home directory if it can
     * be determined, or null if it can't.
     *
     * return string|null
     *
     */
    protected function usersHomeDirectoryPathOrNull(): string|null
    {
        $userInfo = posix_getpwuid(posix_geteuid());
        if(
            is_array($userInfo)
            &&
            isset($userInfo[self::USERS_HOME_DIRECTORY_PATH_INDEX])
        ) {
            $usersHomeDirectoryPath = realpath(
                $userInfo[self::USERS_HOME_DIRECTORY_PATH_INDEX]
            );
        }
        return (
            isset($usersHomeDirectoryPath)
            &&
            $usersHomeDirectoryPath !== false
            ? $usersHomeDirectoryPath
            : null
        );
    }

    /**
     * Clean up after tests:
     *
     * - Delete the test json storage directory.
     *
     * @return void
     *
     */
    public function tearDown(): void
    {
        IntegrationTestUtilities::deleteTestJsonStorageDirectory(
            $this->expectedJsonFilePath()
                 ->jsonStorageDirectoryPath()
            );
    }

}

