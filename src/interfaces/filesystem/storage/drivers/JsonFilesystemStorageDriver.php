<?php

namespace Darling\PHPJsonStorageUtilities\interfaces\filesystem\storage\drivers;

use Darling\PHPJsonStorageUtilities\interfaces\collections\JsonFilePathCollection;
use \Darling\PHPJsonStorageUtilities\interfaces\collections\JsonCollection;
use \Darling\PHPJsonStorageUtilities\interfaces\filesystem\paths\JsonStorageDirectoryPath;
use \Darling\PHPJsonStorageUtilities\interfaces\filesystem\storage\queries\JsonFilesystemStorageQuery;
use \Darling\PHPJsonStorageUtilities\interfaces\named\identifiers\Location;
use \Darling\PHPJsonStorageUtilities\interfaces\named\identifiers\Owner;
use \Darling\PHPJsonUtilities\interfaces\decoders\JsonDecoder;
use \Darling\PHPJsonUtilities\interfaces\encoded\data\Json;
use \Darling\PHPTextTypes\interfaces\strings\Id;
use \Darling\PHPTextTypes\interfaces\strings\Name;

/**
 * A JsonFilesystemStorgeDriver can be used to read, write, and
 * delete json from storage.
 *
 */
interface JsonFilesystemStorageDriver
{

    /**
     * Return an instance of a JsonDecoder.
     *
     * @return JsonDecoder
     *
     */
    public function jsonDecoder(): JsonDecoder;


    /**
     * Write the specified Json to storage.
     *
     * Returns true if the Json was written, false otherwise.
     *
     * @param Json $json The Json to write.
     *
     * @param JsonStorageDirectoryPath $jsonStorageDirectoryPath
     *                                 The JsonStorageDirectoryPath
     *                                 to write to.
     *
     * @param Location $location The Location to write to.
     *
     * @param Owner $owner The Owner of the Json.
     *
     * @param Name $name The name that will identify the Json in
     *                   storage.
     *
     * @param Id $id The id that will identify the Json in storage.
     *
     * @return bool
     *
     */
    public function write(
        Json $json,
        JsonStorageDirectoryPath $jsonStorageDirectoryPath,
        Location $location,
        Owner $owner,
        Name $name,
        Id $id,
    ): bool;

    /**
     * Return a JsonCollection of Json instances read from storage
     * based on the specified JsonFilesystemStorageQuery.
     *
     * Note: An empty JsonFilesystemStorageQuery will result in
     * a JsonCollection that is comprised of all of the Json in
     * storage.
     *
     * @param JsonFilesystemStorageQuery $jsonFilesystemStorageQuery
     *                                  The JsonFilesystemStorageQuery
     *                                  that will determine what Json
     *                                  is read from storage and
     *                                  included in the returned
     *                                  JsonCollection.
     *
     * @return JsonCollection
     *
     */
    public function read(
        JsonFilesystemStorageQuery $jsonFilesystemStorageQuery
    ): JsonCollection;

    /**
     * Return a JsonFilePathCollection of JsonFilePath
     * instances for each of the json files in storage
     * that match the specified JsonFilesystemStorageQuery.
     *
     * @param JsonFilesystemStorageQuery $jsonFilesystemStorageQuery
     *                                 The JsonFilesystemStorageQuery
     *                                 that will determine what
     *                                 JsonFilePaths are included
     *                                 in the returned
     *                                 JsonFilePathCollection.
     *
     * @return JsonFilePathCollection
     */
    public function storedJsonFilePaths(
        JsonFilesystemStorageQuery $jsonFilesystemStorageQuery
    ): JsonFilePathCollection;

    /**
     * Delete any stored json that matches the specified
     * JsonFilesystemStorageQuery.
     *
     * Returns true if the matching Json was deleted, false otherwise.
     *
     * WARNING: An empty JsonFilesystemStorageQuery will result in
     * the DELETION OF ALL OF THE Json IN STORAGE!
     *
     * @param JsonFilesystemStorageQuery $jsonFilesystemStorageQuery
     *
     * @return bool
     *
     */
    public function delete(
        JsonFilesystemStorageQuery $jsonFilesystemStorageQuery
    ): bool;

}

