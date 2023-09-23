<?php

namespace Darling\PHPJsonStorageUtilities\tests;

use \Darling\PHPJsonStorageUtilities\enumerations\Type;
use \Darling\PHPJsonStorageUtilities\interfaces\filesystem\paths\JsonStorageDirectoryPath;
use \Darling\PHPJsonUtilities\classes\decoders\JsonDecoder;
use \Darling\PHPJsonUtilities\classes\encoded\data\Json;
use \Darling\PHPTextTypes\classes\strings\ClassString;
use \FilesystemIterator;
use \RecursiveDirectoryIterator;
use \RecursiveIteratorIterator;
use \SplFileInfo;

final class IntegrationTestUtilities
{

    private const USERS_HOME_DIRECTORY_PATH_INDEX = 'dir';

    /**
     * Apply the specified ANSI $colorCode to the specified $string.
     *
     * @param string $string The string to apply color to.
     *
     * @param int $colorCode The
     *
     * @return string
     *
     */
    public static function applyANSIColor(string $string, int $colorCode): string {
        /**
         * \033[0m : reset color
         * \033[48;5;{$colorCode}m : set background color
         * \033[38;5;{$colorCode}m : set foreground color
         */
        return "\033[0m\033[48;5;" .
            strval($colorCode) .
            "m\033[38;5;0m " .
            $string .
            " \033[0m";
    }

    public static function determineType(Json $json, JsonDecoder $jsonDecoder): Type|ClassString
    {
        $data = $jsonDecoder->decode($json);
        if(is_object($data)) {
            return new ClassString($data);
        }
        return match(gettype($data)) {
            Type::Array->value => Type::Array,
            Type::Bool->value => Type::Bool,
            Type::Float->value => Type::Float,
            Type::Int->value => Type::Int,
            Type::Null->value => Type::Null,
            Type::String->value => Type::String,
            Type::Object->value => Type::Object,
            Type::Resource->value => Type::Resource,
            Type::ResourceClosed->value => Type::ResourceClosed,
            Type::UnknownType->value => Type::UnknownType,
        };
    }

    /**
     * Return the path to the current users home directory if it can
     * be determined, or null if it can't.
     *
     * return string|null
     *
     */
    public static function usersHomeDirectoryPathOrNull(): string|null
    {
        $userInfo = posix_getpwuid(posix_geteuid());
        if(
            is_array($userInfo)
            &&
            isset($userInfo[self::USERS_HOME_DIRECTORY_PATH_INDEX])
        ) {
            $usersHomeDirectoryPath = realpath(
                $userInfo[self::USERS_HOME_DIRECTORY_PATH_INDEX]
            );
        }
        return (
            isset($usersHomeDirectoryPath)
            &&
            $usersHomeDirectoryPath !== false
            ? $usersHomeDirectoryPath
            : null
        );
    }

    /**
     * Delete the test json storage directory.
     *
     * @return void
     *
     */
    public static function deleteTestJsonStorageDirectory(JsonStorageDirectoryPath $jsonStorageDirectoryPath) : void
    {
        $path = strval(realpath($jsonStorageDirectoryPath));
        if(
            $path !== '/'
            &&
            $path !== DIRECTORY_SEPARATOR
            &&
            self::usersHomeDirectoryPathOrNull() !== null
            &&
            $path !== self::usersHomeDirectoryPathOrNull()
            &&
            $path !== DIRECTORY_SEPARATOR . 'bin'
            &&
            $path !== DIRECTORY_SEPARATOR . 'boot'
            &&
            $path !== DIRECTORY_SEPARATOR . 'dev'
            &&
            $path !== DIRECTORY_SEPARATOR . 'etc'
            &&
            $path !== DIRECTORY_SEPARATOR . 'home'
            &&
            $path !== DIRECTORY_SEPARATOR . 'lib'
            &&
            $path !== DIRECTORY_SEPARATOR . 'lib32'
            &&
            $path !== DIRECTORY_SEPARATOR . 'lib64'
            &&
            $path !== DIRECTORY_SEPARATOR . 'libx32'
            &&
            $path !== DIRECTORY_SEPARATOR . 'lost+found'
            &&
            $path !== DIRECTORY_SEPARATOR . 'media'
            &&
            $path !== DIRECTORY_SEPARATOR . 'mnt'
            &&
            $path !== DIRECTORY_SEPARATOR . 'opt'
            &&
            $path !== DIRECTORY_SEPARATOR . 'proc'
            &&
            $path !== DIRECTORY_SEPARATOR . 'recovery'
            &&
            $path !== DIRECTORY_SEPARATOR . 'root'
            &&
            $path !== DIRECTORY_SEPARATOR . 'run'
            &&
            $path !== DIRECTORY_SEPARATOR . 'sbin'
            &&
            $path !== DIRECTORY_SEPARATOR . 'snap'
            &&
            $path !== DIRECTORY_SEPARATOR . 'srv'
            &&
            $path !== DIRECTORY_SEPARATOR . 'sys'
            &&
            $path !== DIRECTORY_SEPARATOR . 'tmp'
            &&
            $path !== DIRECTORY_SEPARATOR . 'usr'
            &&
            $path !== DIRECTORY_SEPARATOR . 'var'
            &&
            is_dir($path)
            &&
            is_writable($path)
            &&
            str_contains(
                $path, 'darling' . DIRECTORY_SEPARATOR . 'data'
            )
        ) {
            foreach(
                new RecursiveIteratorIterator(
                    new RecursiveDirectoryIterator(
                        $path,
                        FilesystemIterator::SKIP_DOTS
                        | FilesystemIterator::UNIX_PATHS
                    ),
                    RecursiveIteratorIterator::CHILD_FIRST
                )
                as
                $value
            ) {
                if(
                    $value instanceof SplFileInfo
                ) {
                    if($value->isFile()) {
                        unlink($value);
                    } elseif($value->isDir()) {
                        rmdir($value);
                    }
                }
            }
            rmdir($path);
        }
    }
}

