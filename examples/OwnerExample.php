<?php

/**
 * This file demonstrates the usage of a Owner.
 */

namespace Darling\PHPJsonStorageUtilities\examples;

include(
    dirname(__DIR__, 1) .
    DIRECTORY_SEPARATOR .
    'vendor' .
    DIRECTORY_SEPARATOR .
    'autoload.php'
);

use \Darling\PHPJsonStorageUtilities\classes\named\identifiers\Owner;
use \Darling\PHPJsonStorageUtilities\tests\IntegrationTestUtilities;
use \Darling\PHPTextTypes\classes\strings\Name;
use \Darling\PHPTextTypes\classes\strings\Text;

$owner = new Owner(
    new Name(new Text('Owner' . strval(rand(1, 100))))
);

echo PHP_EOL .
    'Owner: ' .
    IntegrationTestUtilities::applyANSIColor(
        $owner->__toString(),
        rand(1, 231),
    );

