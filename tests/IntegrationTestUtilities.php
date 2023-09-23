<?php

namespace Darling\PHPJsonStorageUtilities\tests;

use \Darling\PHPJsonStorageUtilities\enumerations\Type;
use \Darling\PHPJsonUtilities\classes\decoders\JsonDecoder;
use \Darling\PHPJsonUtilities\classes\encoded\data\Json;
use \Darling\PHPTextTypes\classes\strings\ClassString;

final class IntegrationTestUtilities
{

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

}

