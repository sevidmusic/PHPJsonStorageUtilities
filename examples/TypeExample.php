<?php

/**
 * This file demonstrates the usage the Type enum.
 */

namespace Darling\PHPJsonStorageUtilities\examples;

use \Darling\PHPJsonStorageUtilities\enumerations\Type;
use \Darling\PHPJsonStorageUtilities\tests\IntegrationTestUtilities;
use \stdClass;

include(
    dirname(__DIR__, 1) .
    DIRECTORY_SEPARATOR .
    'vendor' .
    DIRECTORY_SEPARATOR .
    'autoload.php'
);

/** Open a resource */
$openResource = tmpfile();

/** Open and close a resource */
$closedResource = fopen(DIRECTORY_SEPARATOR . 'tmp', 'r');
if(is_resource($closedResource) && $closedResource !== false) {
    fclose($closedResource);
}

/**
 * Define an array of values of various types.
 */
$values = [
    'foo',
    1,
    23.45,
    true,
    function (): void {},
    [1, 2, ['3']],
    null,
    false,
    new stdClass(),
    $openResource,
    $closedResource,
];

/**
 * Pick a random value from the array of $values.
 *
 * @var mixed $value
 */
$value = $values[array_rand($values)];

/**
 * Echo out the Type case that matches the $value's type.
 */
echo IntegrationTestUtilities::applyANSIColor('Type:', rand(1, 231));
echo IntegrationTestUtilities::applyANSIColor(
    match(gettype($value)) {
        Type::String->value => Type::String->value,
        Type::Bool->value => Type::Bool->value,
        Type::Int->value => Type::Int->value,
        Type::Float->value => Type::Float->value,
        Type::Array->value => Type::Array->value,
        Type::Null->value => Type::Null->value,
        Type::Object->value => Type::Object->value,
        Type::Resource->value => Type::Resource->value,
        Type::ResourceClosed->value => Type::ResourceClosed->value,
        Type::UnknownType->value => Type::UnknownType->value,
    },
    rand(1, 231),
);

