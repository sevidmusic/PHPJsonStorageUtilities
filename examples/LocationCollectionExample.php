<?php

namespace Darling\PHPJsonStorageUtilities\examples;

include(dirname(__DIR__, 1) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php');

use \Darling\PHPJsonStorageUtilities\classes\filesystem\storage\drivers\JsonFilesystemStorageDriver;

/**
 * This file demonstrates the usage of a LocationCollection.
 */

$jsonFilesystemStorageDriver = new JsonFilesystemStorageDriver();

