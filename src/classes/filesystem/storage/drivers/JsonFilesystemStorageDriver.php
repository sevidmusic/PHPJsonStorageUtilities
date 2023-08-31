<?php

namespace Darling\PHPJsonStorageUtilities\classes\filesystem\storage\drivers;

use \Darling\PHPJsonUtilities\classes\decoders\JsonDecoder;
use \Darling\PHPJsonStorageUtilities\interfaces\filesystem\storage\drivers\JsonFilesystemStorageDriver as JsonFilesystemStorageDriverInterface;

class JsonFilesystemStorageDriver implements JsonFilesystemStorageDriverInterface
{

    public function JsonDecoder(): JsonDecoder
    {
        return new JsonDecoder();
    }

}

