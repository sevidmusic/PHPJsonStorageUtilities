<?php

namespace Darling\PHPJsonStorageUtilities\interfaces\filesystem\paths;

use \Darling\PHPTextTypes\interfaces\strings\Name;
use \Stringable;

/**
 * Description of this interface.
 *
 * @example
 *
 * ```
 *
 * ```
 */
interface JsonStorageDirectoryPath extends \Stringable
{

    public function directoryName(): Name;

    public function rootDirectoryPath(): string;

    public function parentDirectoryPath(): string;

    public function storageDirectoryPath(): string;

}

