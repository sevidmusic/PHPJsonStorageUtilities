<?php

namespace Darling\PHPJsonStorageUtilities\interfaces\filesystem\storage\queries;

use \Darling\PHPJsonStorageUtilities\interfaces\filesystem\paths\JsonFilePath;
use \Darling\PHPJsonStorageUtilities\interfaces\filesystem\paths\JsonStorageDirectoryPath;
use \Darling\PHPJsonStorageUtilities\interfaces\named\identifiers\Container;
use \Darling\PHPJsonStorageUtilities\interfaces\named\identifiers\Location;
use \Darling\PHPJsonStorageUtilities\interfaces\named\identifiers\Owner;
use \Darling\PHPTextTypes\interfaces\strings\Id;
use \Darling\PHPTextTypes\interfaces\strings\Name;
use \Stringable;

/**
 * Defines a query that can be passed to a
 * \Darling\PHPJsonStorageUtilities\interfaces\filesystem\storage\drivers\JsonFilesystemStorageDriver
 * instance's read(), delete(), and storedJsonFiles() methods to determine
 * which json files will be read or deleted from storage.
 *
 */
interface JsonFilesystemStorageQuery extends \Stringable
{

    /**
     * Return the JsonStorageDirectoryPath instance that will
     * determine the path to the Json storage directory to query.
     *
     * @return JsonStorageDirectoryPath
     *
     */
    public function jsonStorageDirectoryPath(): JsonStorageDirectoryPath|null;

    /**
     * Return JsonFilePath instance that will determine the path to
     * the json file to query.
     *
     * @return JsonFilePath|null
     *
     */
    public function jsonFilePath(): JsonFilePath|null;

    /**
     * Return Location instance that will determine the storage
     * location to query.
     *
     * @return Location|null
     *
     */
    public function location(): Location|null;

    /**
     * Return Container instance that will determine the storage
     * container to query.
     *
     * @return Container|null
     *
     */
    public function container(): Container|null;

    /**
     * Return Owner instance that will determine the owner of the json
     * to query.
     *
     * @return Owner|null
     *
     */
    public function owner(): Owner|null;

    /**
     * Return Name instance that will determine the name of the json
     * to query.
     *
     * @return Name|null
     *
     */
    public function name(): Name|null;

    /**
     * Return Name instance that will determine the id of the json
     * to query.
     *
     * @return Id|null
     *
     */
    public function id(): Id|null;

    /**
     * Return the query string.
     *
     * @return string
     *
     */
    public function __toString(): string;

}

