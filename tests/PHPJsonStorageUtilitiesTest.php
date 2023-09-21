<?php

namespace Darling\PHPJsonStorageUtilities\tests;

use \Darling\PHPUnitTestUtilities\traits\PHPUnitConfigurationTests;
use \Darling\PHPUnitTestUtilities\traits\PHPUnitRandomValues;
use \Darling\PHPUnitTestUtilities\traits\PHPUnitTestMessages;
use \PHPUnit\Framework\TestCase;

/**
 * Defines common methods that may be useful to all
 * PHPJsonStorageUtilities test classes.
 *
 * This class makes use of the traits provided by the
 * https://github.com/sevidmusic/PHPUnitTestUtilities
 * library which provides traits that define methods
 * to aide in the implementation of phpunit tests.
 *
 * All PHPJsonStorageUtilities test classes must extend
 * from this class.
 *
 */
class PHPJsonStorageUtilitiesTest extends TestCase
{
    use PHPUnitConfigurationTests;
    use PHPUnitTestMessages;
    use PHPUnitRandomValues;

    protected const TEST_STORAGE_DIRECTORY_NAME = 'PHPJsonStorageUtiltitiesTestData';

}

