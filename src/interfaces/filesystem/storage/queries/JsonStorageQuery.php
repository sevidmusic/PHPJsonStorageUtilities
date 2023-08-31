<?php

namespace Darling\PHPJsonStorageUtilities\interfaces\filesystem\storage\queries;

use \Darling\PHPJsonStorageUtilities\interfaces\filesystem\paths\JsonStorageDirectoryPath;
use \Darling\PHPJsonStorageUtilities\interfaces\filesystem\paths\JsonFilePath;
use \Darling\PHPJsonStorageUtilities\interfaces\named\identifiers\Location;
use \Darling\PHPJsonStorageUtilities\interfaces\named\identifiers\Owner;
use \Darling\PHPJsonStorageUtilities\interfaces\named\identifiers\Container;
use \Darling\PHPTextTypes\interfaces\strings\Name;
use \Darling\PHPTextTypes\interfaces\strings\Id;

/**
 * Description of this interface.
 *
 * @example
 *
 * ```
 *
 * ```
 */
interface JsonStorageQuery
{


    /**
     * Return an array of JsonStorageDirectoryPath instances that
     * will determine which Json storage directories will be queried.
     *
     * @return array<int, JsonStorageDirectoryPath>
     *
     */
    public function jsonStorageDirectoryPaths(): array;

    /**
     * Return an array of JsonFilePath instances that will determine
     * which JsonFilePaths will be queried.
     *
     * @return array<int, JsonFilePath>
     *
     */
    public function jsonFilePaths(): array;

    /**
     * Return an array of Location instances that will determine
     * which locations will be queried.
     *
     * @return array<int, Location>
     *
     */
    public function locations(): array;

    /**
     * Return an array of Container instances that will determine
     * which containers will be queried.
     *
     * @return array<int, Container>
     *
     */
    public function containers(): array;

    /**
     * Return an array of Owner instances that will determine
     * which owners will be queried.
     *
     * @return array<int, Owner>
     *
     */
    public function owners(): array;

    /**
     * Return an array of Name instances that will determine
     * which names will be queried.
     *
     * @return array<int, Name>
     *
     */
    public function names(): array;

    /**
     * Return an array of Id instances that will determine
     * which ids will be queried.
     *
     * @return array<int, Id>
     *
     */
    public function ids(): array;
}

