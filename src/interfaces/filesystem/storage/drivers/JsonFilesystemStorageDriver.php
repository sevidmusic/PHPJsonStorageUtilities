<?php

namespace Darling\PHPJsonStorageUtilities\interfaces\filesystem\storage\drivers;

use \Darling\PHPJsonUtilities\interfaces\decoders\JsonDecoder;

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

}

