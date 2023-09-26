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
use \FilesystemIterator;
use \RecursiveDirectoryIterator;
use \RecursiveIteratorIterator;
use \SplFileInfo;
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
        $this->deleteTestJsonStorageDirectory(
            $this->expectedJsonFilePath()
                 ->jsonStorageDirectoryPath()
                 ->__toString()
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
        $this->deleteTestJsonStorageDirectory(
            $this->expectedJsonFilePath()
                 ->jsonStorageDirectoryPath()
                 ->__toString()
            );
    }

    /**
     * Delete the test json storage directory.
     *
     * @return void
     *
     */
    private function deleteTestJsonStorageDirectory(string $path) : void
    {
        $path = strval(realpath($path));
        if(
            $path !== '/'
            &&
            $path !== DIRECTORY_SEPARATOR
            &&
            $this->usersHomeDirectoryPathOrNull() !== null
            &&
            $path !== $this->usersHomeDirectoryPathOrNull()
            &&
            $path !== DIRECTORY_SEPARATOR . 'bin'
            &&
            $path !== DIRECTORY_SEPARATOR . 'boot'
            &&
            $path !== DIRECTORY_SEPARATOR . 'dev'
            &&
            $path !== DIRECTORY_SEPARATOR . 'etc'
            &&
            $path !== DIRECTORY_SEPARATOR . 'home'
            &&
            $path !== DIRECTORY_SEPARATOR . 'lib'
            &&
            $path !== DIRECTORY_SEPARATOR . 'lib32'
            &&
            $path !== DIRECTORY_SEPARATOR . 'lib64'
            &&
            $path !== DIRECTORY_SEPARATOR . 'libx32'
            &&
            $path !== DIRECTORY_SEPARATOR . 'lost+found'
            &&
            $path !== DIRECTORY_SEPARATOR . 'media'
            &&
            $path !== DIRECTORY_SEPARATOR . 'mnt'
            &&
            $path !== DIRECTORY_SEPARATOR . 'opt'
            &&
            $path !== DIRECTORY_SEPARATOR . 'proc'
            &&
            $path !== DIRECTORY_SEPARATOR . 'recovery'
            &&
            $path !== DIRECTORY_SEPARATOR . 'root'
            &&
            $path !== DIRECTORY_SEPARATOR . 'run'
            &&
            $path !== DIRECTORY_SEPARATOR . 'sbin'
            &&
            $path !== DIRECTORY_SEPARATOR . 'snap'
            &&
            $path !== DIRECTORY_SEPARATOR . 'srv'
            &&
            $path !== DIRECTORY_SEPARATOR . 'sys'
            &&
            $path !== DIRECTORY_SEPARATOR . 'tmp'
            &&
            $path !== DIRECTORY_SEPARATOR . 'usr'
            &&
            $path !== DIRECTORY_SEPARATOR . 'var'
            &&
            is_dir($path)
            &&
            is_writable($path)
            &&
            str_contains(
                $path, 'darling' . DIRECTORY_SEPARATOR . 'data'
            )
        ) {
            foreach(
                new RecursiveIteratorIterator(
                    new RecursiveDirectoryIterator(
                        $path,
                        FilesystemIterator::SKIP_DOTS
                        | FilesystemIterator::UNIX_PATHS
                    ),
                    RecursiveIteratorIterator::CHILD_FIRST
                )
                as
                $value
            ) {
                if(
                    $value instanceof SplFileInfo
                ) {
                    if($value->isFile()) {
                        unlink($value);
                    } elseif($value->isDir()) {
                        rmdir($value);
                    }
                }
            }
            rmdir($path);
        }
    }
}

