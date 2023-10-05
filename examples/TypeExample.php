<?php

/**
 * This file demonstrates the usage the Type enum.
 */

namespace Darling\PHPJsonStorageUtilities\examples;

use \Darling\PHPJsonStorageUtilities\enumerations\Type;
use \Darling\PHPJsonStorageUtilities\tests\IntegrationTestUtilities;

include(
    dirname(__DIR__, 1) .
    DIRECTORY_SEPARATOR .
    'vendor' .
    DIRECTORY_SEPARATOR .
    'autoload.php'
);

$values = ['foo', 1, 23.45, true];

// @var mixed $value
$value = $values[array_rand($values)];

echo IntegrationTestUtilities::applyANSIColor('Type:', rand(1, 231));

echo IntegrationTestUtilities::applyANSIColor(
    match(gettype($value)) {
        Type::String->value => Type::String->value,
        Type::Bool->value => Type::Bool->value,
        Type::Int->value => Type::Int->value,
        Type::Float->value => Type::Float->value,
    },
    rand(1, 231),
);

