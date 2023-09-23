<?php

namespace Darling\PHPJsonStorageUtilities\tests\integration;

include(dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php');

$data = [new \Darling\PHPTextTypes\classes\strings\Id(), 'Foo', rand(PHP_INT_MIN, PHP_INT_MAX)];

$json = new \Darling\PHPJsonUtilities\classes\encoded\data\Json($data);

$jfsd = new \Darling\PHPJsonStorageUtilities\classes\filesystem\storage\drivers\JsonFilesystemStorageDriver();

$jsdp = new \Darling\PHPJsonStorageUtilities\classes\filesystem\paths\JsonStorageDirectoryPath(new \Darling\PHPTextTypes\classes\strings\Name(new \Darling\PHPTextTypes\classes\strings\Text('Data')));

$loc = new \Darling\PHPJsonStorageUtilities\classes\named\identifiers\Location(new \Darling\PHPTextTypes\classes\strings\Name(new \Darling\PHPTextTypes\classes\strings\Text('Location')));

$own = new \Darling\PHPJsonStorageUtilities\classes\named\identifiers\Owner(new \Darling\PHPTextTypes\classes\strings\Name(new \Darling\PHPTextTypes\classes\strings\Text('Owner')));

$name = new \Darling\PHPTextTypes\classes\strings\Name(new \Darling\PHPTextTypes\classes\strings\Text('Name'));

$id = new \Darling\PHPTextTypes\classes\strings\Id();

var_dump($jfsd->write($json, $jsdp, $loc, $own, $name, $id));

$conToQuery = new \Darling\PHPJsonStorageUtilities\classes\named\identifiers\Container(\Darling\PHPJsonStorageUtilities\enumerations\Type::Array);

$jfsq = new \Darling\PHPJsonStorageUtilities\classes\filesystem\storage\queries\JsonFilesystemStorageQuery(container: $conToQuery);

var_dump($jfsd->read($jfsq));

