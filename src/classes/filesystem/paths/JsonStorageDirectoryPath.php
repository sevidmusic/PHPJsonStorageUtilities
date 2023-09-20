<?php

namespace Darling\PHPJsonStorageUtilities\classes\filesystem\paths;

use \Darling\PHPJsonStorageUtilities\interfaces\filesystem\paths\JsonStorageDirectoryPath as JsonStorageDirectoryPathInterface;
use \Darling\PHPTextTypes\interfaces\strings\Name;

final class JsonStorageDirectoryPath implements JsonStorageDirectoryPathInterface
{

    private const HOME_DIRECTORY_PATH = 'dir';
    private const LOCAL_DIRECTORY_NAME = '.local';
    private const SHARE_DIRECTORY_NAME = 'share';
    private const DARLING_DIRECTORY_NAME = 'darling';
    private const DATA_DIRECTORY_NAME = 'data';
    private const TMP_DIRECTORY_PATH = DIRECTORY_SEPARATOR . 'tmp';

    /**
     * Instantiate a new instance of a JsonStorageDirectoryPath.
     *
     * @param Name $name
     *
     */
    public function __construct(private Name $name) {}

    public function name(): Name
    {
        return $this->name;
    }

    public function __toString(): string
    {
        return $this->dataDirectoryPath() .
            DIRECTORY_SEPARATOR .
            $this->name()->__toString();
    }

    private function dataDirectoryPath(): string
    {
        $userInfo = posix_getpwuid(posix_geteuid());
        if(
            is_array($userInfo)
            &&
            isset($userInfo[self::HOME_DIRECTORY_PATH])
        ) {
            $storageDirectoryPath = realpath(
                $userInfo[self::HOME_DIRECTORY_PATH] .
                DIRECTORY_SEPARATOR .
                self::LOCAL_DIRECTORY_NAME .
                DIRECTORY_SEPARATOR .
                self::SHARE_DIRECTORY_NAME
            );
        }
        return (
            isset($storageDirectoryPath)
            &&
            $storageDirectoryPath !== false
            &&
            is_writable($storageDirectoryPath)
            ? $storageDirectoryPath
            : self::TMP_DIRECTORY_PATH
        ) .
            DIRECTORY_SEPARATOR .
            self::DARLING_DIRECTORY_NAME .
            DIRECTORY_SEPARATOR .
            self::DATA_DIRECTORY_NAME;
    }

}

