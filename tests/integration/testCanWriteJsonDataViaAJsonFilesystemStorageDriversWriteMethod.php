<?php

namespace Darling\PHPJsonStorageUtilities\tests\integration;

include(dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php');

use \Darling\PHPJsonStorageUtilities\classes\filesystem\paths\JsonStorageDirectoryPath;
use \Darling\PHPJsonStorageUtilities\classes\filesystem\storage\drivers\JsonFilesystemStorageDriver;
use \Darling\PHPJsonStorageUtilities\classes\named\identifiers\Location;
use \Darling\PHPJsonStorageUtilities\classes\named\identifiers\Owner;
use \Darling\PHPJsonUtilities\classes\encoded\data\Json;
use \Darling\PHPTextTypes\classes\strings\Id;
use \Darling\PHPTextTypes\classes\strings\Name;
use \Darling\PHPTextTypes\classes\strings\Text;

/**
 * Apply the specified ANSI $colorCode to the specified $string.
 *
 * @param string $string The string to apply color to.
 *
 * @param int $colorCode The
 *
 * @return string
 *
 */
function applyANSIColor(string $string, int $colorCode): string {
    /**
     * \033[0m : reset color
     * \033[48;5;{$colorCode}m : set background color
     * \033[38;5;{$colorCode}m : set foreground color
     */
    return "\033[0m\033[48;5;" .
        strval($colorCode) .
        "m\033[38;5;0m " .
        $string .
        " \033[0m";
}

$data = [
    new \Darling\PHPTextTypes\classes\strings\Id(),
    'Foo' . strval(rand(PHP_INT_MIN, PHP_INT_MAX)),
    rand(PHP_INT_MIN, PHP_INT_MAX),
];

$json = new Json($data);

$jfsd = new JsonFilesystemStorageDriver();

$jsdp = new JsonStorageDirectoryPath(new Name(new Text('Data')));

$loc = new Location(new Name(new Text('Location')));

$own = new Owner(new Name(new Text('Owner')));

$name = new Name(new Text('Name'));

$id = new Id();

echo match($jfsd->write($json, $jsdp, $loc, $own, $name, $id)) {
    true => applyANSIColor('Json was written successfully', 1),
    false => applyANSIColor('Failed to write Json', 2)
};

