# PHPJsonStorageUtilities

This library provides classes for storing and
retrieving data that was encoded as Json by a
\Darling\PHPJsonUtilities\classes\encoded\data\Json
instance.

- [Installation](#installation)

- [Classes](#classes)

  - [ContainerCollection](#darlingphpjsonstorageutilitiesclassescollectionscontainercollection)

  - [IdCollection](#darlingphpjsonstorageutilitiesclassescollectionsidcollection)

  - [JsonCollection](#darlingphpjsonstorageutilitiesclassescollectionsjsoncollection)

  - [JsonFilePathCollection](#darlingphpjsonstorageutilitiesclassescollectionsjsonfilepathcollection)

  - [JsonStorageDirectoryPathCollection](#darlingphpjsonstorageutilitiesclassescollectionsjsonstoragedirectorypathcollection)

  - [LocationCollection](#darlingphpjsonstorageutilitiesclassescollectionslocationcollection)

  - [NameCollection](#darlingphpjsonstorageutilitiesclassescollectionsnamecollection)

  - [OwnerCollection](#darlingphpjsonstorageutilitiesclassescollectionsownercollection)

  - [JsonFilePath](#darlingphpjsonstorageutilitiesclassesfilesystempathsjsonfilepath)

  - [JsonStorageDirectoryPath](#darlingphpjsonstorageutilitiesclassesfilesystempathsjsonstoragedirectorypath)

  - [JsonFilesystemStorageDriver](#darlingphpjsonstorageutilitiesclassesfilesystemstoragedriversjsonfilesystemstoragedriver)

  - [JsonFilesystemStorageQuery](#darlingphpjsonstorageutilitiesclassesfilesystemstoragequeriesjsonfilesystemstoragequery)

  - [Container](#darlingphpjsonstorageutilitiesclassesnamedidentifierscontainer)

  - [Location](#darlingphpjsonstorageutilitiesclassesnamedidentifierslocation)

  - [NamedIdentifier](#darlingphpjsonstorageutilitiesclassesnamedidentifiersnamedidentifier)

  - [Owner](#darlingphpjsonstorageutilitiesclassesnamedidentifiersowner)

  - [Type](#darlingenumerationstype)


# Installation

```
composer require darling/php-json-storage-utilities
```
This library is meant to be used in conjunction with the
[PHPJsonUtilities](https://github.com/sevidmusic/PHPJsonUtilities)
library.

### Classes

### \Darling\PHPJsonStorageUtilities\classes\collections\ContainerCollection

```
<?php

/**
 * This file demonstrates the usage of a ContainerCollection.
 */

namespace Darling\PHPJsonStorageUtilities\examples;

include(
    dirname(__DIR__, 1) .
    DIRECTORY_SEPARATOR .
    'vendor' .
    DIRECTORY_SEPARATOR .
    'autoload.php'
);

use \Darling\PHPJsonStorageUtilities\classes\collections\ContainerCollection;
use \Darling\PHPJsonStorageUtilities\classes\named\identifiers\Container;
use \Darling\PHPJsonStorageUtilities\enumerations\Type;
use \Darling\PHPJsonStorageUtilities\tests\IntegrationTestUtilities;
use \Darling\PHPTextTypes\classes\strings\ClassString;

$containerCollection = new ContainerCollection(
    new Container(Type::Bool),
    new Container(Type::String),
    new Container(Type::Int),
    new Container(Type::Float),
    new Container(new ClassString(ContainerCollection::class)),
    new Container(Type::Array),
);

foreach($containerCollection->collection() as $index => $container) {
    echo PHP_EOL . 'Container[' . strval($index) . ']: ' .
        IntegrationTestUtilities::applyANSIColor(
            $container->__toString(),
            rand(1, 231)
        );
}

```

### \Darling\PHPJsonStorageUtilities\classes\collections\IdCollection
### \Darling\PHPJsonStorageUtilities\classes\collections\JsonCollection
### \Darling\PHPJsonStorageUtilities\classes\collections\JsonFilePathCollection
### \Darling\PHPJsonStorageUtilities\classes\collections\JsonStorageDirectoryPathCollection
### \Darling\PHPJsonStorageUtilities\classes\collections\LocationCollection
### \Darling\PHPJsonStorageUtilities\classes\collections\NameCollection
### \Darling\PHPJsonStorageUtilities\classes\collections\OwnerCollection
### \Darling\PHPJsonStorageUtilities\classes\filesystem\paths\JsonFilePath
### \Darling\PHPJsonStorageUtilities\classes\filesystem\paths\JsonStorageDirectoryPath
### \Darling\PHPJsonStorageUtilities\classes\filesystem\storage\drivers\JsonFilesystemStorageDriver
### \Darling\PHPJsonStorageUtilities\classes\filesystem\storage\queries\JsonFilesystemStorageQuery
### \Darling\PHPJsonStorageUtilities\classes\named\identifiers\Container
### \Darling\PHPJsonStorageUtilities\classes\named\identifiers\Location
### \Darling\PHPJsonStorageUtilities\classes\named\identifiers\NamedIdentifier
### \Darling\PHPJsonStorageUtilities\classes\named\identifiers\Owner
### \Darling\enumerations\Type

