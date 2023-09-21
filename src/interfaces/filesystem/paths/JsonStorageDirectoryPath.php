<?php

namespace Darling\PHPJsonStorageUtilities\interfaces\filesystem\paths;

use \Darling\PHPTextTypes\interfaces\strings\Name;
use \Stringable;

/**
 * A JsonStorageDirectoryPath can be used to construct an appropriate
 * path to a json storage directory.
 *
 * The complete path to the json storage direcgtory can be obtained
 * via the __toString() method.
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
 * Note: The `/tmp/darling/data` directory will only be used if:
 *
 * 1. The path to `~/.local/share` cannot be determined.
 * 2. The path to `~/.local/share` does not exist.
 * 3. The path to `~/.local/share` exists but is not writable.
 *
 */
interface JsonStorageDirectoryPath extends \Stringable
{

   /**
    * The path to the json storage directory.
    *
    * @return string
    *
   */
    public function __toString(): string;

    /**
     * The json storage directory's name.
     *
     * @return Name
     *
     */
    public function name(): Name;

}

