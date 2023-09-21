<?php

namespace Darling\PHPJsonStorageUtilities\interfaces\filesystem\paths;

use \Darling\PHPJsonStorageUtilities\interfaces\named\identifiers\Container;
use \Darling\PHPJsonStorageUtilities\interfaces\named\identifiers\Location;
use \Darling\PHPJsonStorageUtilities\interfaces\named\identifiers\Owner;
use \Darling\PHPTextTypes\interfaces\strings\Id;
use \Darling\PHPTextTypes\interfaces\strings\Name;
use \Stringable;

/**
 * A JsonFilePath can be used to construct an appropriate path to a
 * json file in a storage directory.
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
 * # shardId() is not public, yet, see issue #31.
 * # https://github.com/sevidmusic/PHPJsonStorageUtilities/issues/31
 * $this->shardId($this->id()) .
 * '.json';
 *
 * ```
 *
 */
interface JsonFilePath extends \Stringable
{

    /**
     * Return an instance of a JsonStorageDirectoryPath.
     *
     * @return JsonStorageDirectoryPath
     *
     */
    public function jsonStorageDirectoryPath(): JsonStorageDirectoryPath;


    /**
     * Return an instance of a Location.
     *
     * @return Location
     *
     */
    public function location(): Location;


    /**
     * Return an instance of a Container.
     *
     * @return Container
     *
     */
    public function container(): Container;


    /**
     * Return an instance of an Owner.
     *
     * @return Owner
     *
     */
    public function owner(): Owner;


    /**
     * Return an instance of a Name.
     *
     * @return Name
     *
     */
    public function name(): Name;


    /**
     * Return an instance of an Id.
     *
     * @return Id
     *
     */
    public function id(): Id;

    /**
     * Return the complete json file path.
     *
     * The json file path will be constructed as follows:
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
     * # shardId() is not public, yet, see issue #31.
     * # https://github.com/sevidmusic/PHPJsonStorageUtilities/issues/31
     * $this->shardId($this->id()) .
     * '.json';
     *
     * ```
     *
     * @return string
     *
     */
    public function __toString(): string;
}

