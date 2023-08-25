<?php

namespace Darling\PHPJsonStorageUtilities\interfaces\filesystem\paths;

use \Darling\PHPJsonStorageUtilities\interfaces\named\identifiers\Container;
use \Darling\PHPJsonStorageUtilities\interfaces\named\identifiers\Location;
use \Darling\PHPJsonStorageUtilities\interfaces\named\identifiers\Owner;
use \Darling\PHPJsonStorageUtilities\tests\interfaces\filesystem\paths\JsonFilePathTestTrait;
use \Darling\PHPTextTypes\interfaces\strings\Id;
use \Darling\PHPTextTypes\interfaces\strings\Name;
use \Stringable;

interface JsonFilePath extends \Stringable
{
    public function jsonStorageDirectoryPath(): JsonStorageDirectoryPath;
    public function location(): Location;
    public function container(): Container;
    public function owner(): Owner;
    public function name(): Name;
    public function id(): Id;
#    public function __toString(): string;

}
