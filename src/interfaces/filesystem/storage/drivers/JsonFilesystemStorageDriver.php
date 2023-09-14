<?php

namespace Darling\PHPJsonStorageUtilities\interfaces\filesystem\storage\drivers;

use Darling\PHPJsonStorageUtilities\interfaces\collections\JsonFilePathCollection;
use \Darling\PHPJsonStorageUtilities\interfaces\collections\JsonCollection;
use \Darling\PHPJsonUtilities\interfaces\decoders\JsonDecoder;
use \Darling\PHPJsonStorageUtilities\interfaces\filesystem\storage\queries\JsonFilesystemStorageQuery;
use \Darling\PHPJsonStorageUtilities\interfaces\filesystem\paths\JsonStorageDirectoryPath;
use \Darling\PHPJsonStorageUtilities\interfaces\named\identifiers\Location;
use \Darling\PHPJsonStorageUtilities\interfaces\named\identifiers\Owner;
use \Darling\PHPJsonUtilities\interfaces\encoded\data\Json;
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
interface JsonFilesystemStorageDriver
{

    public function jsonDecoder(): JsonDecoder;

    public function write(
        Json $json,
        JsonStorageDirectoryPath $jsonStorageDirectoryPath,
        Location $location,
        Owner $owner,
        Name $name,
        Id $id,
    ): bool;

    /**
     * @return JsonCollection
     */
    public function read(JsonFilesystemStorageQuery $jsonFilesystemStorageQuery): JsonCollection;

    /**
     * @return JsonFilePathCollection
     */
    public function storedJsonFilePaths(JsonFilesystemStorageQuery $jsonFilesystemStorageQuery): JsonFilePathCollection;

}

