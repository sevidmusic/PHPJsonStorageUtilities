<?php

namespace Darling\PHPJsonStorageUtilities\interfaces\filesystem\paths;

use \Darling\PHPJsonStorageUtilities\interfaces\named\identifiers\Container;
use \Darling\PHPJsonStorageUtilities\interfaces\named\identifiers\Location;
use \Darling\PHPJsonStorageUtilities\interfaces\named\identifiers\Owner;
use \Darling\PHPJsonStorageUtilities\tests\interfaces\filesystem\paths\JsonFilePathTestTrait;
use \Darling\PHPTextTypes\interfaces\strings\Id;
use \Darling\PHPTextTypes\interfaces\strings\Name;
use \Stringable;

/**
 * A JsonFilePath can be used to construct an appropriate path to a
 * json file.
 *
 * The complete path to the json file can be obtained via the
 * __toString() method.
 *
 * The path will be constructed as follows:
 *
 * ```
 * $this->jsonStorageDirectoryPath()->__toString() .
 * DIRECTORY_SEPARATOR .
 * $this->location()->__toString() .
 * DIRECTORY_SEPARATOR .
 * $this->container()->__toString() .
 * DIRECTORY_SEPARATOR .
 * $this->owner()->__toString() .
 * DIRECTORY_SEPARATOR .
 * $this->name()->__toString() .
 * DIRECTORY_SEPARATOR .
 * $this->shardId($this->id()) .
 * '.json';
 *
 * ```
 *
 */
interface JsonFilePath extends \Stringable
{
    public function jsonStorageDirectoryPath(): JsonStorageDirectoryPath;
    public function location(): Location;
    public function container(): Container;
    public function owner(): Owner;
    public function name(): Name;
    public function id(): Id;
    public function __toString(): string;
}
