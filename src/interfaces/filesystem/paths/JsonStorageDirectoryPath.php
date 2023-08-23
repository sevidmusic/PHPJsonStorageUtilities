<?php

namespace Darling\PHPJsonStorageUtilities\interfaces\filesystem\paths;

use \Darling\PHPTextTypes\interfaces\strings\Name;
use \Stringable;

/**
 * The path to the directory used by implementations of the
 * \Darling\PHPJsonStorageUtilities\interfaces\drivers\storage\filesystem\JsonStorageDriver
 * interface to store `json` data.
 *
 * This path will either be:
 *
 * ```
 * ~/.local/share/darling/data
 * ```
 *
 * or:
 *
 * ```
 * /tmp/darling/data
 * ```
 *
 * The `/tmp/darling/data` directory will be used in the following
 * circumstances:
 *
 * 1. The path to `~/.local/share` cannot be determined.
 * 2. The path to `~/.local/share` does not exist.
 * 3. The path to `~/.local/share` exists but is not writable.
 * 4. The path to `~/.local/share/darling/data` does not exist and
 *    cannot be created.
 * 5. The path to `~/.local/share/darling/data` exists but is not
 *    writable.
 *
 * @example
 *
 * ```
 * $jsonStorageDirectoryPath = new JsonStorageDirectoryPath();
 *
 * var_dump($jsonStorageDirectoryPath);
 *
 * # If path to ~/.local/share/darling/data already exists, or can
 * # be created, then the path will be:
 * #
 * # /home/darling/.local/share/darling/data
 * #
 * # Otherwise it will be:
 * #
 * # /tmp/darling/data
 * #
 * ```
 */
interface JsonStorageDirectoryPath extends \Stringable
{

    public function __toString(): string;

    public function name(): Name;

}

