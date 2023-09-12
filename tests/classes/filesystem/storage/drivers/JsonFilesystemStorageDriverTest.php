<?php

namespace Darling\PHPJsonStorageUtilities\tests\classes\filesystem\storage\drivers;

use \Darling\PHPJsonStorageUtilities\classes\filesystem\storage\drivers\JsonFilesystemStorageDriver;
use \Darling\PHPJsonStorageUtilities\tests\PHPJsonStorageUtilitiesTest;
use \Darling\PHPJsonStorageUtilities\tests\interfaces\filesystem\storage\drivers\JsonFilesystemStorageDriverTestTrait;

use \Darling\PHPJsonStorageUtilities\classes\filesystem\paths\JsonFilePath;
use \Darling\PHPJsonStorageUtilities\classes\filesystem\paths\JsonStorageDirectoryPath;
use \Darling\PHPJsonStorageUtilities\classes\named\identifiers\Container;
use \Darling\PHPJsonStorageUtilities\classes\named\identifiers\Location;
use \Darling\PHPJsonStorageUtilities\classes\named\identifiers\Owner;
use \Darling\PHPJsonUtilities\classes\encoded\data\Json;
use \Darling\PHPTextTypes\classes\strings\Id;
use \Darling\PHPTextTypes\classes\strings\Name;
use \Darling\PHPTextTypes\classes\strings\Text;
use \RecursiveDirectoryIterator;
use \RecursiveIteratorIterator;
use \FilesystemIterator;

class JsonFilesystemStorageDriverTest extends PHPJsonStorageUtilitiesTest
{

    /**
     * The JsonFilesystemStorageDriverTestTrait defines
     * common tests for implementations of the
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
            $this->determineType($this->expectedJson())
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
    }

    public function tearDown(): void
    {
        $userInfo = posix_getpwuid(posix_geteuid());
        if(is_array($userInfo) && isset($userInfo['dir'])) {
            $usersHomeDirectoryPath = realpath(
                $userInfo['dir']
            );
        }
        $testStorageDirectoryParentDirectoryPath = $this->expectedJsonFilePath()->jsonStorageDirectoryPath()->__toString();
        if(
            $testStorageDirectoryParentDirectoryPath !== '/'
            &&
            $testStorageDirectoryParentDirectoryPath !== DIRECTORY_SEPARATOR
            &&
            isset($usersHomeDirectoryPath)
            &&
            $testStorageDirectoryParentDirectoryPath !== $usersHomeDirectoryPath
            &&
            $testStorageDirectoryParentDirectoryPath !== DIRECTORY_SEPARATOR . 'bin'
            &&
            $testStorageDirectoryParentDirectoryPath !== DIRECTORY_SEPARATOR . 'boot'
            &&
            $testStorageDirectoryParentDirectoryPath !== DIRECTORY_SEPARATOR . 'dev'
            &&
            $testStorageDirectoryParentDirectoryPath !== DIRECTORY_SEPARATOR . 'etc'
            &&
            $testStorageDirectoryParentDirectoryPath !== DIRECTORY_SEPARATOR . 'home'
            &&
            $testStorageDirectoryParentDirectoryPath !== DIRECTORY_SEPARATOR . 'lib'
            &&
            $testStorageDirectoryParentDirectoryPath !== DIRECTORY_SEPARATOR . 'lib32'
            &&
            $testStorageDirectoryParentDirectoryPath !== DIRECTORY_SEPARATOR . 'lib64'
            &&
            $testStorageDirectoryParentDirectoryPath !== DIRECTORY_SEPARATOR . 'libx32'
            &&
            $testStorageDirectoryParentDirectoryPath !== DIRECTORY_SEPARATOR . 'lost+found'
            &&
            $testStorageDirectoryParentDirectoryPath !== DIRECTORY_SEPARATOR . 'media'
            &&
            $testStorageDirectoryParentDirectoryPath !== DIRECTORY_SEPARATOR . 'mnt'
            &&
            $testStorageDirectoryParentDirectoryPath !== DIRECTORY_SEPARATOR . 'opt'
            &&
            $testStorageDirectoryParentDirectoryPath !== DIRECTORY_SEPARATOR . 'proc'
            &&
            $testStorageDirectoryParentDirectoryPath !== DIRECTORY_SEPARATOR . 'recovery'
            &&
            $testStorageDirectoryParentDirectoryPath !== DIRECTORY_SEPARATOR . 'root'
            &&
            $testStorageDirectoryParentDirectoryPath !== DIRECTORY_SEPARATOR . 'run'
            &&
            $testStorageDirectoryParentDirectoryPath !== DIRECTORY_SEPARATOR . 'sbin'
            &&
            $testStorageDirectoryParentDirectoryPath !== DIRECTORY_SEPARATOR . 'snap'
            &&
            $testStorageDirectoryParentDirectoryPath !== DIRECTORY_SEPARATOR . 'srv'
            &&
            $testStorageDirectoryParentDirectoryPath !== DIRECTORY_SEPARATOR . 'sys'
            &&
            $testStorageDirectoryParentDirectoryPath !== DIRECTORY_SEPARATOR . 'tmp'
            &&
            $testStorageDirectoryParentDirectoryPath !== DIRECTORY_SEPARATOR . 'usr'
            &&
            $testStorageDirectoryParentDirectoryPath !== DIRECTORY_SEPARATOR . 'var'
        ) {
            $this->deleteDarlingDataDirectory($testStorageDirectoryParentDirectoryPath);
        }
    }

    private function deleteDarlingDataDirectory(string $path) : void
    {
        $path = strval(realpath($path));
        if(
            $path !== '/'
            &&
            is_dir($path)
            &&
            is_writable($path)
            &&
            str_contains($path, 'darling' . DIRECTORY_SEPARATOR . 'data')
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
                /**
                 * @var \SplFileInfo $value
                 */
                if($value->isFile()) {
                    unlink($value);
                } else {
                    rmdir($value);
                }
            }
            rmdir($path);
        }
    }
}

