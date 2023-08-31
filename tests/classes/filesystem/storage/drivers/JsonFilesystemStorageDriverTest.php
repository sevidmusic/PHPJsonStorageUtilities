<?php

namespace Darling\PHPJsonStorageUtilities\tests\classes\filesystem\storage\drivers;

use \Darling\PHPJsonStorageUtilities\classes\filesystem\storage\drivers\JsonFilesystemStorageDriver;
use \Darling\PHPJsonStorageUtilities\tests\PHPJsonStorageUtilitiesTest;
use \Darling\PHPJsonStorageUtilities\tests\interfaces\filesystem\storage\drivers\JsonFilesystemStorageDriverTestTrait;

use \Darling\PHPJsonStorageUtilities\classes\filesystem\paths\JsonStorageDirectoryPath;
use \Darling\PHPJsonStorageUtilities\classes\named\identifiers\Container;
use \Darling\PHPJsonStorageUtilities\classes\named\identifiers\Location;
use \Darling\PHPJsonStorageUtilities\classes\named\identifiers\Owner;
use \Darling\PHPJsonUtilities\classes\decoders\JsonDecoder;
use \Darling\PHPJsonUtilities\classes\encoded\data\Json;
use \Darling\PHPTextTypes\classes\strings\ClassString;
use \Darling\PHPTextTypes\classes\strings\Id;
use \Darling\PHPTextTypes\classes\strings\Name;
use \Darling\PHPTextTypes\classes\strings\Text;

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
        $this->setExpectedJson(new Json($this->randomChars()));
        $this->setExpectedJsonFilePath(
            $this->expectedJson(),
            new JsonStorageDirectoryPath(
                new Name(new Text('JsonStorageDirectory' . ucfirst(substr($this->randomChars(), 0, 3))))
            ),
            new Location(new Name(new Text('Location' . ucfirst(substr($this->randomChars(), 0, 3))))),
            new Owner(new Name(new Text('Owner' . ucfirst(substr($this->randomChars(), 0, 3))))),
            new Name(new Text('Name' . ucfirst(substr($this->randomChars(), 0, 3)))),
            new Id(),
        );
        $this->setJsonFilesystemStorageDriverTestInstance(
            new JsonFilesystemStorageDriver()
        );
    }
}

