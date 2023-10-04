<?php

/**
 * This file demonstrates the usage of a Container.
 */

namespace Darling\PHPJsonStorageUtilities\examples;

include(
    dirname(__DIR__, 1) .
    DIRECTORY_SEPARATOR .
    'vendor' .
    DIRECTORY_SEPARATOR .
    'autoload.php'
);

use \Darling\PHPJsonStorageUtilities\classes\named\identifiers\Container;
use \Darling\PHPJsonStorageUtilities\tests\IntegrationTestUtilities;
use \Darling\PHPJsonStorageUtilities\enumerations\Type;

$types = Type::cases();

$container = new Container($types[array_rand($types)]);

echo PHP_EOL .
    'Container: ' .
    IntegrationTestUtilities::applyANSIColor(
        $container->__toString(),
        rand(1, 231),
    );

