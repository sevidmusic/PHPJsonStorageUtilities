<?php

namespace Darling\PHPJsonStorageUtilities\interfaces\filesystem\paths;

use \Darling\PHPTextTypes\interfaces\strings\Name;
use \Stringable;

/**
 * A JsonStorageDirectoryPath is the path to the directory where json
 * files will be stored.
 *
 */
interface JsonStorageDirectoryPath extends \Stringable
{

   /**
    * The path to the directory where json files will be stored.
    *
    * This path will either be:
    *
    * ```
    * ~/.local/share/darling/data/$this->name()->__toString()
    * ```
    *
    * or:
    *
    * ```
    * /tmp/darling/data/$this->name()->__toString()
    * ```
    *
    * The `/tmp/darling/data` directory will be used in the following
    * circumstances:
    *
    * 1. The path to `~/.local/share` cannot be determined.
    * 2. The path to `~/.local/share` does not exist.
    * 3. The path to `~/.local/share` exists but is not writable.
    *
    * @example
    *
    * ```
    * $jsonStorageDirectoryPath = new JsonStorageDirectoryPath();
    *
    * var_dump($jsonStorageDirectoryPath);
    *
    * # If path to ~/.local/share/ exists and is writable then the path
    * # will be:
    * #
    * # ~/.local/share/darling/data/$jsonStorageDirectoryPath->name()
    * #
    * # Otherwise it will be:
    * #
    * # /tmp/darling/data/$jsonStorageDirectoryPath->name()
    * #
    * ```
    */
    public function __toString(): string;

    /**
     * The name of the directory located at the JsonStorageDirectoryPath.
     *
     * @return Name
     *
     */
    public function name(): Name;

}

