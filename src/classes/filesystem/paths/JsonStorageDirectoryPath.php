<?php

namespace Darling\PHPJsonStorageUtilities\classes\filesystem\paths;

use \Darling\PHPJsonStorageUtilities\interfaces\filesystem\paths\JsonStorageDirectoryPath as JsonStorageDirectoryPathInterface;
use \Darling\PHPTextTypes\interfaces\strings\Name;
use \Darling\PHPTextTypes\classes\strings\Name as NameClass;
use \Darling\PHPTextTypes\interfaces\strings\Text;
use \Darling\PHPTextTypes\classes\strings\Text as TextClass;

class JsonStorageDirectoryPath implements JsonStorageDirectoryPathInterface
{

    public function __construct(private Name $directoryName) {}

    public function directoryName(): Name
    {
        return $this->directoryName;
    }

    public function __toString(): string
    {
        return $this->storageDirectoryPath();
    }

    public function rootDirectoryPath(): string
    {
        $userInfo = posix_getpwuid(posix_geteuid());
        $relativeRootDirectoryPath =
            '.local' .
            DIRECTORY_SEPARATOR .
            'share';
        return (
            is_array($userInfo)
            &&
            isset($userInfo['dir'])
            &&
            file_exists(
                $rootDirectoryPath = strval(
                    realpath($userInfo['dir'] .
                    DIRECTORY_SEPARATOR .
                    $relativeRootDirectoryPath
                    )
                )
            )
            ? $rootDirectoryPath
            : DIRECTORY_SEPARATOR .
            'tmp' .
            DIRECTORY_SEPARATOR .
            $relativeRootDirectoryPath
        );
    }

    public function parentDirectoryPath(): string
    {
        return $this->rootDirectoryPath() .
            DIRECTORY_SEPARATOR .
            'darling' .
            DIRECTORY_SEPARATOR .
            'data';

    }

    public function storageDirectoryPath(): string
    {
        return $this->parentDirectoryPath() .
            DIRECTORY_SEPARATOR .
            $this->directoryName();
    }

}

