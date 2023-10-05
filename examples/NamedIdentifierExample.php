<?php

/**
 * This file demonstrates the usage of a NamedIdentifier.
 */

namespace Darling\PHPJsonStorageUtilities\examples;

include(
    dirname(__DIR__, 1) .
    DIRECTORY_SEPARATOR .
    'vendor' .
    DIRECTORY_SEPARATOR .
    'autoload.php'
);

use \Darling\PHPJsonStorageUtilities\classes\named\identifiers\NamedIdentifier;
use \Darling\PHPJsonStorageUtilities\tests\IntegrationTestUtilities;
use \Darling\PHPTextTypes\classes\strings\Name;
use \Darling\PHPTextTypes\classes\strings\Text;

$namedIdentifier = new NamedIdentifier(new Name(new Text('NamedIdentifier' . strval(rand(1, 100)))));

echo PHP_EOL .
    'NamedIdentifier:' .
    IntegrationTestUtilities::applyANSIColor(
        $namedIdentifier->__toString(), rand(1, 231)
    );

