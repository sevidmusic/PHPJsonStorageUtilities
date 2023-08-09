<?php

namespace Darling\PHPJsonStorageUtilities\classes\filesystem\paths;

use \Darling\PHPJsonStorageUtilities\interfaces\filesystem\paths\JsonStorageDirectoryPath as JsonStorageDirectoryPathInterface;
use \Darling\PHPTextTypes\interfaces\strings\Name;
use \Darling\PHPTextTypes\classes\strings\Name as NameClass;
use \Darling\PHPTextTypes\interfaces\strings\Text;
use \Darling\PHPTextTypes\classes\strings\Text as TextClass;

class JsonStorageDirectoryPath implements JsonStorageDirectoryPathInterface
{

    public function __construct() {}

    public function __toString(): string
    {
        return $this->storageDirectoryPath();
    }

    public function storageDirectoryPath(): string
    {
        $userInfo = posix_getpwuid(posix_geteuid());
        $relativeRootDirectoryPath =
            '.local' .
            DIRECTORY_SEPARATOR .
            'share';
        $storageDirectoryPath = (
            is_array($userInfo)
            &&
            isset($userInfo['dir'])
            &&
            file_exists(
                $storageDirectoryPath = strval(
                    realpath($userInfo['dir'] .
                    DIRECTORY_SEPARATOR .
                    $relativeRootDirectoryPath
                    )
                )
            )
            ? $storageDirectoryPath
            : DIRECTORY_SEPARATOR .
            'tmp' .
            DIRECTORY_SEPARATOR .
            $relativeRootDirectoryPath
        );
        return $storageDirectoryPath .
            DIRECTORY_SEPARATOR .
            'darling' .
            DIRECTORY_SEPARATOR .
            'data';
    }

}

