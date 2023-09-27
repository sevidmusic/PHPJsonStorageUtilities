<?php

namespace Darling\PHPJsonStorageUtilities\examples;

include(dirname(__DIR__, 1) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php');

use \Darling\PHPJsonStorageUtilities\classes\filesystem\paths\JsonStorageDirectoryPath;
use \Darling\PHPJsonStorageUtilities\tests\IntegrationTestUtilities;
use \Darling\PHPTextTypes\classes\strings\Name;
use \Darling\PHPTextTypes\classes\strings\Text;

/**
 * This file demonstrates the usage of a JsonStorageDirectoryPath.
 */

$jsonStorageDirectoryPath = new JsonStorageDirectoryPath(
    new Name(
        new Text('JsonStorageDirectoryPath' . strval(rand(1, 100)))
    )
);

echo PHP_EOL .
    'JsonStorageDirectoryPath:' .
    IntegrationTestUtilities::applyANSIColor(
        $jsonStorageDirectoryPath->__toString(), rand(1, 231)
    );

