<?php

namespace Darling\PHPJsonStorageUtilities\classes\filesystem\paths;

use \Darling\PHPJsonStorageUtilities\interfaces\filesystem\paths\JsonStorageDirectoryPath as JsonStorageDirectoryPathInterface;
use \Darling\PHPTextTypes\interfaces\strings\Name;
use \Darling\PHPTextTypes\classes\strings\Name as NameClass;
use \Darling\PHPTextTypes\interfaces\strings\Text;
use \Darling\PHPTextTypes\classes\strings\Text as TextClass;

class JsonStorageDirectoryPath implements JsonStorageDirectoryPathInterface
{

    /**
     * Instantiate a new instance of a JsonStorageDirectoryPath.
     *
     * @example
     *
     * ```
     * $jsonStorageDirectoryPath = new JsonStorageDirectoryPath(
     *     new Name('FooBarBaz')
     * );
     *
     * ```
     *
     */
    public function __construct(private Name $name) {}

    public function name(): Name
    {
        return $this->name;
    }

    public function __toString(): string
    {
        $userInfo = posix_getpwuid(posix_geteuid());
        if(is_array($userInfo) && isset($userInfo['dir'])) {
            $storageDirectoryPath = realpath(
                $userInfo['dir'] .
                DIRECTORY_SEPARATOR .
                '.local' .
                DIRECTORY_SEPARATOR .
                'share'
            );
        }
        return (
            isset($storageDirectoryPath)
            &&
            $storageDirectoryPath !== false
            &&
            is_writable($storageDirectoryPath)
            ? $storageDirectoryPath
            : DIRECTORY_SEPARATOR . 'tmp'
        ) .
        DIRECTORY_SEPARATOR .
        'darling' .
        DIRECTORY_SEPARATOR .
        'data' .
        DIRECTORY_SEPARATOR .
        $this->name()->__toString();
    }

}

