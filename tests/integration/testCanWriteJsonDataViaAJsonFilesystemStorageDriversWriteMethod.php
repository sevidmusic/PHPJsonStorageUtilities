<?php

namespace Darling\PHPJsonStorageUtilities\tests\integration;

include(dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php');

use \Darling\PHPTextTypes\classes\strings\Id;

use \Darling\PHPTextTypes\classes\strings\Name;

use \Darling\PHPJsonStorageUtilities\classes\named\identifiers\Owner;

use \Darling\PHPJsonStorageUtilities\classes\named\identifiers\Location;

use \Darling\PHPJsonStorageUtilities\classes\filesystem\paths\JsonStorageDirectoryPath;

use \Darling\PHPJsonStorageUtilities\classes\filesystem\storage\drivers\JsonFilesystemStorageDriver;

use \Darling\PHPJsonUtilities\classes\encoded\data\Json;

$data = [
    new \Darling\PHPTextTypes\classes\strings\Id(),
    'Foo',
    rand(PHP_INT_MIN, PHP_INT_MAX),
];

$json = new Json($data);

$jfsd = new JsonFilesystemStorageDriver();

$jsdp = new JsonStorageDirectoryPath(new \Darling\PHPTextTypes\classes\strings\Name(new \Darling\PHPTextTypes\classes\strings\Text('Data')));

$loc = new Location(new \Darling\PHPTextTypes\classes\strings\Name(new \Darling\PHPTextTypes\classes\strings\Text('Location')));

$own = new Owner(new \Darling\PHPTextTypes\classes\strings\Name(new \Darling\PHPTextTypes\classes\strings\Text('Owner')));

$name = new Name(new \Darling\PHPTextTypes\classes\strings\Text('Name'));

$id = new Id();

var_dump($jfsd->write($json, $jsdp, $loc, $own, $name, $id));

