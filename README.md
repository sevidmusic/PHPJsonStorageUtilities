# PHPJsonStorageUtilities

This library provides classes for storing and
retrieving data that was encoded as Json by a
\Darling\PHPJsonUtilities\classes\encoded\data\Json
instance.

- [Installation](#installation)

- [Classes](#classes)

  - [ContainerCollection](#darlingphpjsonstorageutilitiesclassescollectionscontainercollection)

  - [JsonCollection](#darlingphpjsonstorageutilitiesclassescollectionsjsoncollection)

  - [JsonFilePathCollection](#darlingphpjsonstorageutilitiesclassescollectionsjsonfilepathcollection)

  - [JsonStorageDirectoryPathCollection](#darlingphpjsonstorageutilitiesclassescollectionsjsonstoragedirectorypathcollection)

  - [LocationCollection](#darlingphpjsonstorageutilitiesclassescollectionslocationcollection)

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

# Classes

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

### \Darling\PHPJsonStorageUtilities\classes\collections\JsonCollection

```
<?php

/**
 * This file demonstrates the usage of a JsonCollection.
 */

namespace Darling\PHPJsonStorageUtilities\examples;

include(
    dirname(__DIR__, 1) .
    DIRECTORY_SEPARATOR .
    'vendor' .
    DIRECTORY_SEPARATOR .
    'autoload.php'
);

use \Darling\PHPJsonStorageUtilities\classes\collections\JsonCollection;
use \Darling\PHPJsonStorageUtilities\tests\IntegrationTestUtilities;
use \Darling\PHPJsonUtilities\classes\encoded\data\Json;
use \Darling\PHPTextTypes\classes\strings\Id;

$jsonCollection = new JsonCollection(
    new Json(new Id()),
    new Json([1, 2, 3]),
    new Json(456.789),
    new Json(10),
    new Json(true),
    new Json(false),
    new Json(null),
    new Json('string'),
    new Json(json_encode('json string')),
);

foreach($jsonCollection->collection() as $index => $json) {
    echo PHP_EOL . 'Json[' . strval($index) . ']: ' .
        IntegrationTestUtilities::applyANSIColor(
            $json->__toString(),
            rand(1, 231)
        );
}

```

### \Darling\PHPJsonStorageUtilities\classes\collections\JsonFilePathCollection

```
<?php

/**
 * This file demonstrates the usage of a JsonFilePathCollection.
 */

namespace Darling\PHPJsonFilePathStorageUtilities\examples;

include(
    dirname(__DIR__, 1) .
    DIRECTORY_SEPARATOR .
    'vendor' .
    DIRECTORY_SEPARATOR .
    'autoload.php'
);

use Darling\PHPJsonStorageUtilities\classes\filesystem\paths\JsonFilePath;
use Darling\PHPJsonStorageUtilities\classes\filesystem\paths\JsonStorageDirectoryPath;
use Darling\PHPJsonStorageUtilities\classes\named\identifiers\Container;
use Darling\PHPJsonStorageUtilities\classes\named\identifiers\Location;
use Darling\PHPJsonStorageUtilities\classes\named\identifiers\Owner;
use Darling\PHPJsonStorageUtilities\enumerations\Type;
use \Darling\PHPJsonStorageUtilities\classes\collections\JsonFilePathCollection;
use \Darling\PHPJsonStorageUtilities\tests\IntegrationTestUtilities;
use \Darling\PHPTextTypes\classes\strings\Id;
use \Darling\PHPTextTypes\classes\strings\Name;
use \Darling\PHPTextTypes\classes\strings\Text;

$jsonFilePathCollection = new JsonFilePathCollection(
    new JsonFilePath(
        new JsonStorageDirectoryPath(
            new Name(
                new Text(
                    'StorageDirectoryPathName' . strval(rand(1, 100))
                )
            )
        ),
        new Location(
            new Name(new Text('Location' . strval(rand(1, 100))))
        ),
        new Container(Type::Array),
        new Owner(new Name(new Text('Owner' . strval(rand(1, 100))))),
        new Name(new Text('Name' . strval(rand(1, 100)))),
        new Id(),
    ),
    new JsonFilePath(
        new JsonStorageDirectoryPath(
            new Name(
                new Text(
                    'StorageDirectoryPathName' . strval(rand(1, 100))
                )
            )
        ),
        new Location(
            new Name(new Text('Location' . strval(rand(1, 100))))
        ),
        new Container(Type::Bool),
        new Owner(new Name(new Text('Owner' . strval(rand(1, 100))))),
        new Name(new Text('Name' . strval(rand(1, 100)))),
        new Id(),
    ),
    new JsonFilePath(
        new JsonStorageDirectoryPath(
            new Name(
                new Text(
                    'StorageDirectoryPathName' . strval(rand(1, 100))
                )
            )
        ),
        new Location(
            new Name(new Text('Location' . strval(rand(1, 100))))
        ),
        new Container(Type::Float),
        new Owner(new Name(new Text('Owner' . strval(rand(1, 100))))),
        new Name(new Text('Name' . strval(rand(1, 100)))),
        new Id(),
    ),
    new JsonFilePath(
        new JsonStorageDirectoryPath(
            new Name(
                new Text(
                    'StorageDirectoryPathName' . strval(rand(1, 100))
                )
            )
        ),
        new Location(
            new Name(new Text('Location' . strval(rand(1, 100))))
        ),
        new Container(Type::Int),
        new Owner(new Name(new Text('Owner' . strval(rand(1, 100))))),
        new Name(new Text('Name' . strval(rand(1, 100)))),
        new Id(),
    ),
    new JsonFilePath(
        new JsonStorageDirectoryPath(
            new Name(
                new Text(
                    'StorageDirectoryPathName' . strval(rand(1, 100))
                )
            )
        ),
        new Location(
            new Name(new Text('Location' . strval(rand(1, 100))))
        ),
        new Container(Type::Null),
        new Owner(new Name(new Text('Owner' . strval(rand(1, 100))))),
        new Name(new Text('Name' . strval(rand(1, 100)))),
        new Id(),
    ),
    new JsonFilePath(
        new JsonStorageDirectoryPath(
            new Name(
                new Text(
                    'StorageDirectoryPathName' . strval(rand(1, 100))
                )
            )
        ),
        new Location(
            new Name(new Text('Location' . strval(rand(1, 100))))
        ),
        new Container(Type::Object),
        new Owner(new Name(new Text('Owner' . strval(rand(1, 100))))),
        new Name(new Text('Name' . strval(rand(1, 100)))),
        new Id(),
    ),
    new JsonFilePath(
        new JsonStorageDirectoryPath(
            new Name(
                new Text(
                    'StorageDirectoryPathName' . strval(rand(1, 100))
                )
            )
        ),
        new Location(
            new Name(new Text('Location' . strval(rand(1, 100))))
        ),
        new Container(Type::Resource),
        new Owner(new Name(new Text('Owner' . strval(rand(1, 100))))),
        new Name(new Text('Name' . strval(rand(1, 100)))),
        new Id(),
    ),
    new JsonFilePath(
        new JsonStorageDirectoryPath(
            new Name(
                new Text(
                    'StorageDirectoryPathName' . strval(rand(1, 100))
                )
            )
        ),
        new Location(
            new Name(new Text('Location' . strval(rand(1, 100))))
        ),
        new Container(Type::ResourceClosed),
        new Owner(new Name(new Text('Owner' . strval(rand(1, 100))))),
        new Name(new Text('Name' . strval(rand(1, 100)))),
        new Id(),
    ),
    new JsonFilePath(
        new JsonStorageDirectoryPath(
            new Name(
                new Text(
                    'StorageDirectoryPathName' . strval(rand(1, 100))
                )
            )
        ),
        new Location(
            new Name(new Text('Location' . strval(rand(1, 100))))
        ),
        new Container(Type::String),
        new Owner(new Name(new Text('Owner' . strval(rand(1, 100))))),
        new Name(new Text('Name' . strval(rand(1, 100)))),
        new Id(),
    ),
    new JsonFilePath(
        new JsonStorageDirectoryPath(
            new Name(
                new Text(
                    'StorageDirectoryPathName' . strval(rand(1, 100))
                )
            )
        ),
        new Location(
            new Name(new Text('Location' . strval(rand(1, 100))))
        ),
        new Container(Type::UnknownType),
        new Owner(new Name(new Text('Owner' . strval(rand(1, 100))))),
        new Name(new Text('Name' . strval(rand(1, 100)))),
        new Id(),
    ),
);

foreach(
    $jsonFilePathCollection->collection() as $index => $jsonFilePath
) {
    echo PHP_EOL . 'JsonFilePath[' . strval($index) . ']: ' .
        IntegrationTestUtilities::applyANSIColor(
            $jsonFilePath->__toString(),
            rand(1, 231)
        );
}

```

### \Darling\PHPJsonStorageUtilities\classes\collections\JsonStorageDirectoryPathCollection

```
<?php

/**
 * This file demonstrates the usage of a JsonStorageDirectoryPathCollection.
 */

namespace Darling\PHPJsonStorageDirectoryPathStorageUtilities\examples;

include(
    dirname(__DIR__, 1) .
    DIRECTORY_SEPARATOR .
    'vendor' .
    DIRECTORY_SEPARATOR .
    'autoload.php'
);

use Darling\PHPJsonStorageUtilities\classes\filesystem\paths\JsonStorageDirectoryPath;
use \Darling\PHPJsonStorageUtilities\classes\collections\JsonStorageDirectoryPathCollection;
use \Darling\PHPTextTypes\classes\strings\Name;
use \Darling\PHPTextTypes\classes\strings\Text;
use \Darling\PHPJsonStorageUtilities\tests\IntegrationTestUtilities;

$jsonStorageDirectoryPathCollection = new JsonStorageDirectoryPathCollection(
    new JsonStorageDirectoryPath(
        new Name(new Text('Name' . strval(rand(1, 100))))
    ),
    new JsonStorageDirectoryPath(
        new Name(new Text('Name' . strval(rand(1, 100))))
    ),
    new JsonStorageDirectoryPath(
        new Name(new Text('Name' . strval(rand(1, 100))))
    ),
    new JsonStorageDirectoryPath(
        new Name(new Text('Name' . strval(rand(1, 100))))
    ),
    new JsonStorageDirectoryPath(
        new Name(new Text('Name' . strval(rand(1, 100))))
    ),
    new JsonStorageDirectoryPath(
        new Name(new Text('Name' . strval(rand(1, 100))))
    ),
    new JsonStorageDirectoryPath(
        new Name(new Text('Name' . strval(rand(1, 100))))
    ),
);

foreach(
    $jsonStorageDirectoryPathCollection->collection()
    as
    $index => $jsonStorageDirectoryPath
) {
    echo PHP_EOL . 'JsonStorageDirectoryPath[' . strval($index) . ']: ' .
        IntegrationTestUtilities::applyANSIColor(
            $jsonStorageDirectoryPath->__toString(),
            rand(1, 231)
        );
}

```

### \Darling\PHPJsonStorageUtilities\classes\collections\LocationCollection

```
<?php

/**
 * This file demonstrates the usage of a LocationCollection.
 */

namespace Darling\PHPJsonStorageUtilities\examples;

include(
    dirname(__DIR__, 1) .
    DIRECTORY_SEPARATOR .
    'vendor' .
    DIRECTORY_SEPARATOR .
    'autoload.php'
);

use \Darling\PHPJsonStorageUtilities\classes\collections\LocationCollection;
use \Darling\PHPJsonStorageUtilities\classes\named\identifiers\Location;
use \Darling\PHPJsonStorageUtilities\tests\IntegrationTestUtilities;
use \Darling\PHPTextTypes\classes\strings\Name;
use \Darling\PHPTextTypes\classes\strings\Text;

$locationCollection = new LocationCollection(
    new Location(new Name(new Text('Location' . strval(rand(1, 100))))),
    new Location(new Name(new Text('Location' . strval(rand(1, 100))))),
    new Location(new Name(new Text('Location' . strval(rand(1, 100))))),
    new Location(new Name(new Text('Location' . strval(rand(1, 100))))),
    new Location(new Name(new Text('Location' . strval(rand(1, 100))))),
    new Location(new Name(new Text('Location' . strval(rand(1, 100))))),
);

foreach($locationCollection->collection() as $index => $location) {
    echo PHP_EOL . 'Location[' . strval($index) . ']: ' .
        IntegrationTestUtilities::applyANSIColor(
            $location->__toString(),
            rand(1, 231)
        );
}

```

### \Darling\PHPJsonStorageUtilities\classes\collections\OwnerCollection

```
<?php

/**
 * This file demonstrates the usage of a OwnerCollection.
 */

namespace Darling\PHPJsonStorageUtilities\examples;

include(
    dirname(__DIR__, 1) .
    DIRECTORY_SEPARATOR .
    'vendor' .
    DIRECTORY_SEPARATOR .
    'autoload.php'
);

use \Darling\PHPJsonStorageUtilities\classes\collections\OwnerCollection;
use \Darling\PHPJsonStorageUtilities\classes\named\identifiers\Owner;
use \Darling\PHPJsonStorageUtilities\tests\IntegrationTestUtilities;
use \Darling\PHPTextTypes\classes\strings\Name;
use \Darling\PHPTextTypes\classes\strings\Text;

$ownerCollection = new OwnerCollection(
    new Owner(new Name(new Text('Owner' . strval(rand(1, 100))))),
    new Owner(new Name(new Text('Owner' . strval(rand(1, 100))))),
    new Owner(new Name(new Text('Owner' . strval(rand(1, 100))))),
    new Owner(new Name(new Text('Owner' . strval(rand(1, 100))))),
    new Owner(new Name(new Text('Owner' . strval(rand(1, 100))))),
    new Owner(new Name(new Text('Owner' . strval(rand(1, 100))))),
);

foreach($ownerCollection->collection() as $index => $owner) {
    echo PHP_EOL . 'Owner[' . strval($index) . ']: ' .
        IntegrationTestUtilities::applyANSIColor(
            $owner->__toString(),
            rand(1, 231)
        );
}

```

### \Darling\PHPJsonStorageUtilities\classes\filesystem\paths\JsonFilePath

```
<?php

/**
 * This file demonstrates the usage of a JsonFilePath.
 */

namespace Darling\PHPJsonStorageUtilities\examples;

include(
    dirname(__DIR__, 1) .
    DIRECTORY_SEPARATOR .
    'vendor' .
    DIRECTORY_SEPARATOR .
    'autoload.php'
);

use \Darling\PHPJsonStorageUtilities\classes\filesystem\paths\JsonFilePath;
use \Darling\PHPJsonStorageUtilities\classes\filesystem\paths\JsonStorageDirectoryPath;
use \Darling\PHPJsonStorageUtilities\classes\named\identifiers\Container;
use \Darling\PHPJsonStorageUtilities\classes\named\identifiers\Location;
use \Darling\PHPJsonStorageUtilities\classes\named\identifiers\Owner;
use \Darling\PHPJsonStorageUtilities\enumerations\Type;
use \Darling\PHPJsonStorageUtilities\tests\IntegrationTestUtilities;
use \Darling\PHPTextTypes\classes\strings\Id;
use \Darling\PHPTextTypes\classes\strings\Name;
use \Darling\PHPTextTypes\classes\strings\Text;

$jsonFilePath = new JsonFilePath(
    new JsonStorageDirectoryPath(
        new Name(
            new Text(
                'StorageDirectoryPathName' . strval(rand(1, 100))
            )
        )
    ),
    new Location(
        new Name(new Text('Location' . strval(rand(1, 100))))
    ),
    new Container(Type::UnknownType),
    new Owner(new Name(new Text('Owner' . strval(rand(1, 100))))),
    new Name(new Text('Name' . strval(rand(1, 100)))),
    new Id(),
);

echo PHP_EOL .
    'JsonFilePath:' .
    IntegrationTestUtilities::applyANSIColor(
        $jsonFilePath->__toString(), rand(1, 231)
    );

```

### \Darling\PHPJsonStorageUtilities\classes\filesystem\paths\JsonStorageDirectoryPath

```
<?php

/**
 * This file demonstrates the usage of a JsonStorageDirectoryPath.
 */

namespace Darling\PHPJsonStorageUtilities\examples;

include(
    dirname(__DIR__, 1) .
    DIRECTORY_SEPARATOR .
    'vendor' .
    DIRECTORY_SEPARATOR .
    'autoload.php'
);

use \Darling\PHPJsonStorageUtilities\classes\filesystem\paths\JsonStorageDirectoryPath;
use \Darling\PHPJsonStorageUtilities\tests\IntegrationTestUtilities;
use \Darling\PHPTextTypes\classes\strings\Name;
use \Darling\PHPTextTypes\classes\strings\Text;

$jsonStorageDirectoryPath = new JsonStorageDirectoryPath(
    new Name(
        new Text('JsonStorageDirectoryPath' . strval(rand(1, 100)))
    )
);

echo PHP_EOL .
    'JsonStorageDirectoryPath:' .
    IntegrationTestUtilities::applyANSIColor(
        $jsonStorageDirectoryPath->__toString(), rand(1, 231)
    );

```

### \Darling\PHPJsonStorageUtilities\classes\filesystem\storage\drivers\JsonFilesystemStorageDriver

```
<?php

/**
 * This file demonstrates how to use a JsonFilesystemStorageDriver
 * to write and read Json to and from storage.
 */

namespace Darling\PHPJsonStorageUtilities\examples;

include(
    dirname(__DIR__, 1) .
    DIRECTORY_SEPARATOR .
    'vendor' .
    DIRECTORY_SEPARATOR .
    'autoload.php'
);

use \Darling\PHPJsonStorageUtilities\classes\filesystem\paths\JsonFilePath;
use \Darling\PHPJsonStorageUtilities\classes\filesystem\paths\JsonStorageDirectoryPath;
use \Darling\PHPJsonStorageUtilities\classes\filesystem\storage\drivers\JsonFilesystemStorageDriver;
use \Darling\PHPJsonStorageUtilities\classes\filesystem\storage\queries\JsonFilesystemStorageQuery;
use \Darling\PHPJsonStorageUtilities\classes\named\identifiers\Container;
use \Darling\PHPJsonStorageUtilities\classes\named\identifiers\Location;
use \Darling\PHPJsonStorageUtilities\classes\named\identifiers\Owner;
use \Darling\PHPJsonStorageUtilities\tests\IntegrationTestUtilities;
use \Darling\PHPJsonUtilities\classes\encoded\data\Json;
use \Darling\PHPTextTypes\classes\strings\Id;
use \Darling\PHPTextTypes\classes\strings\Name;
use \Darling\PHPTextTypes\classes\strings\Text;
use \stdClass;

/**
 * Instantiate a new JsonFilesystemStorageDriver
 */
$jsonFilesystemStorageDriver = new JsonFilesystemStorageDriver();

/**
 * Create an array of data.
 */
$data = [
    new Id(),
    'Foo' . strval(rand(1, 100)),
    rand(PHP_INT_MIN, PHP_INT_MAX),
    function () : void {},
    new stdClass(),
    new Json('Encoded Json Instance' . strval(rand(1, 100))),
    json_encode('json string ' . strval(rand(1, 100))),
    floatval(
        strval(rand(0, 100)) .
        '.' .
        strval(rand(1, 100))
    ),
    [
        "Id" => new Id(),
        "string" => 'Foo' . strval(rand(1, 100)),
        "int" => rand(PHP_INT_MIN, PHP_INT_MAX),
        "closure" => function () : void {},
        "object" => new stdClass(),
        "Json Instance" => new Json('Encoded Json Instance' . strval(rand(1, 100))),
        "json string" => json_encode('json string ' . strval(rand(1, 100))),
        "float" => floatval(
            strval(rand(0, 100)) .
            '.' .
            strval(rand(1, 100))
        ),
    ],
];

/**
 * Randomly select some data from the $data array and encode
 * it as Json.
 */
$json = new Json($data[array_rand($data)]);

/**
 * Instantiate a new JsonFilePath to emulate the path to the json file
 * that the Json is expected to be written to. This will be used to
 * query storage later.
 */
$expectedJsonFilePath = new JsonFilePath(
    jsonStorageDirectoryPath: new JsonStorageDirectoryPath(
        new Name(
            new Text(
                'JsonStorageDirectoryName' . strval(rand(1, 100))
            )
        )
    ),
    location: new Location(
        new Name(new Text('Location' . strval(rand(1, 100))))
    ),
    container: new Container(
        /**
         * In the future Container::determineType(Json $json) should
         * be used to determine Type for Container.
         *
         * @see https://github.com/sevidmusic/PHPJsonStorageUtilities/issues/34
         *
         */
        IntegrationTestUtilities::determineType($json),
    ),
    owner: new Owner(new Name(new Text('Owner' . strval(rand(1, 100))))),
    name: new Name(new Text('Name' . strval(rand(1, 100)))),
    id: new Id(),
);

/**
 * Write the json to storage
 */
$jsonFilesystemStorageDriver->write(
    $json,
    $expectedJsonFilePath->jsonStorageDirectoryPath(),
    $expectedJsonFilePath->location(),
    $expectedJsonFilePath->owner(),
    $expectedJsonFilePath->name(),
    $expectedJsonFilePath->id(),
);

/**
 * Instantiate a JsonFilesystemStorageQuery that will be passed to
 * the $jsonFilesystemStorageDriver->read() method to query the Json
 * in storage.
 *
 * In this example the JsonFilesystemStorageQuery will only specify a
 * single query parameter:
 *
 * @param JsonFilePath|null $jsonFilePath
 *
 * Though any combination of the following parameters is possible:
 *
 * @param JsonFilePath|null $jsonFilePath
 * @param JsonStorageDirectoryPath|null $jsonStorageDirectoryPath
 * @param Location|null $location
 * @param Container|null $container
 * @param Owner|null $owner
 * @param Name|null $name
 * @param Id|null $id
 *
 * If specified, the jsonFilePath parameter will always take
 * precedence over the other parameters.
 *
 */
$jsonFilesystemStorageQuery = new JsonFilesystemStorageQuery(
    jsonFilePath: $expectedJsonFilePath
);

/**
 * Call JsonFilesystemStorageDriver->read() to obtain a
 * JsonCollection of the Json in storage that matches the
 * specified JsonFilesystemStorageQuery.
 *
 * The JsonFilesystemStorageQuery in this example only specifies a
 * jsonFilePath.
 *
 * If a json file exists at the path that matches the specified
 * JsonFilePath, then it's Json will be the only Json included
 * in the JsonCollection returned by read().
 *
 * If a json file does not exist at the path that matches the
 * specified JsonFilePath then an empty JsonCollection will be
 * returned by read().
 */
$jsonCollection = $jsonFilesystemStorageDriver->read(
    $jsonFilesystemStorageQuery
);

/**
 * Echo any stored Json that matched the JsonFilesystemStorageQuery
 * that was passed to $jsonFilesystemStorageDriver->read()
 */
foreach($jsonCollection->collection() as $index => $json) {
    echo PHP_EOL .
        PHP_EOL .
        IntegrationTestUtilities::applyANSIColor(
            'Path to json file:', rand(1, 231)
        ) .
        IntegrationTestUtilities::applyANSIColor(
            (
                $jsonFilesystemStorageQuery->jsonFilePath()?->__toString()
                ??
                'path is unknown'
            ),
            rand(1, 231)
        ) .
        PHP_EOL .
        PHP_EOL .
        IntegrationTestUtilities::applyANSIColor(
            'Json: ', rand(1, 231)
        ) .
        IntegrationTestUtilities::applyANSIColor(
            $json->__toString(),
            rand(1, 231)
        ) .
        PHP_EOL;
}

/**
 * Instantiate a JsonFilesystemStorageQuery that will be used to
 * delete the entire JsonStorageDirectory that was used in this
 * example.
 */
$jsonFilesystemStorageQuery = new JsonFilesystemStorageQuery(
    jsonStorageDirectoryPath: $expectedJsonFilePath->jsonStorageDirectoryPath()
);

/**
 * Delete the JsonStorageDirectory that the Json in this example was
 * written to.
 */
$jsonFilesystemStorageDriver->delete(
    $jsonFilesystemStorageQuery
);

```

### \Darling\PHPJsonStorageUtilities\classes\filesystem\storage\queries\JsonFilesystemStorageQuery

```
<?php

/**
 * This file demonstrates how to use the JsonFilesystemStorageQuery
 * in conjunction with a JsonFilesystemStorageDriver to query Json
 * that exists in storage.
 */
namespace Darling\PHPJsonStorageUtilities\examples;

include(
    dirname(__DIR__, 1) .
    DIRECTORY_SEPARATOR .
    'vendor' .
    DIRECTORY_SEPARATOR .
    'autoload.php'
);

use \Darling\PHPJsonStorageUtilities\classes\filesystem\paths\JsonFilePath;
use \Darling\PHPJsonStorageUtilities\classes\filesystem\paths\JsonStorageDirectoryPath;
use \Darling\PHPJsonStorageUtilities\classes\filesystem\storage\drivers\JsonFilesystemStorageDriver;
use \Darling\PHPJsonStorageUtilities\classes\filesystem\storage\queries\JsonFilesystemStorageQuery;
use \Darling\PHPJsonStorageUtilities\classes\named\identifiers\Container;
use \Darling\PHPJsonStorageUtilities\classes\named\identifiers\Location;
use \Darling\PHPJsonStorageUtilities\classes\named\identifiers\Owner;
use \Darling\PHPJsonStorageUtilities\tests\IntegrationTestUtilities;
use \Darling\PHPJsonUtilities\classes\encoded\data\Json;
use \Darling\PHPTextTypes\classes\strings\Id;
use \Darling\PHPTextTypes\classes\strings\Name;
use \Darling\PHPTextTypes\classes\strings\Text;
use \Darling\PHPTextTypes\classes\strings\ClassString;
use \stdClass;

/**
 * Instantiate a new JsonStorageDirectoryPath which will determine
 * the path to the Json storage directory that all of the Json in
 * this example will be written to.
 */
$jsonStorageDirectoryPath = new JsonStorageDirectoryPath(
    new Name(
        new Text('JsonStorageDirectoryName' . strval(rand(1, 100)))
    )
);

/**
 * Instantiate a JsonFilesystemStorageQuery that will be used to
 * query the Json in storage.
 *
 * In this example the JsonFilesystemStorageQuery will only specify
 * two query parameters:
 *
 * @param JsonStorageDirectoryPath|null $jsonStorageDirectoryPath
 * @param Container|null $container
 *
 * Though any combination of the following parameters is possible:
 *
 * @param JsonFilePath|null $jsonFilePath
 * @param JsonStorageDirectoryPath|null $jsonStorageDirectoryPath
 * @param Location|null $location
 * @param Container|null $container
 * @param Owner|null $owner
 * @param Name|null $name
 * @param Id|null $id
 *
 * By specifying a JsonStorageDirectoryPath and a Container, this
 * query will target all of the Json in storage that exists in
 * the specified JsonStorageDirectoryPath whose Container
 * matches the specified Container.
 *
 */
$jsonFilesystemStorageQuery = new JsonFilesystemStorageQuery(
    jsonStorageDirectoryPath: $jsonStorageDirectoryPath,
    container: new Container(new ClassString(Id::class)),
);

/**
 * Instantiate a new JsonFilesystemStorageDriver which will be used
 * to write Json to storage.
 */
$jsonFilesystemStorageDriver = new JsonFilesystemStorageDriver();

/**
 * Create an array of data.
 */
$data = [
    new Id(),
    'Foo' . strval(rand(1, 100)),
    rand(PHP_INT_MIN, PHP_INT_MAX),
    function () : void {},
    new stdClass(),
    new Json('Encoded Json Instance' . strval(rand(1, 100))),
    json_encode('json string ' . strval(rand(1, 100))),
    floatval(
        strval(rand(0, 100)) .
        '.' .
        strval(rand(1, 100))
    ),
    [
        "Id" => new Id(),
        "string" => 'Foo' . strval(rand(1, 100)),
        "int" => rand(PHP_INT_MIN, PHP_INT_MAX),
        "closure" => function () : void {},
        "object" => new stdClass(),
        "Json Instance" => new Json(
            'Encoded Json Instance' . strval(rand(1, 100))
        ),
        "json string" => json_encode(
            'json string ' . strval(rand(1, 100))
        ),
        "float" => floatval(
            strval(rand(0, 100)) .
            '.' .
            strval(rand(1, 100))
        ),
    ],
];

/**
 * Write a bunch of Json to storage.
 */
for($writes = 0; $writes <= rand(10, 20); $writes++) {

    /**
     * Randomly select some data from the $data array and encode
     * it as Json.
     */
    $json = new Json($data[array_rand($data)]);

    /**
     * Write the Json to storage
     */
    $jsonFilesystemStorageDriver->write(
        $json,
        $jsonStorageDirectoryPath,
        new Location(
            new Name(new Text('Location' . strval($writes)))
        ),
        new Owner(
            new Name(new Text('Owner' . strval($writes)))
        ),
        new Name(new Text('Name' . strval($writes))),
        new Id(),
    );

}

/**
 * Call JsonFilesystemStorageDriver->storedJsonFilePaths() to obtain
 * a JsonFilePathCollection of JsonFilePaths for the Json in storage
 * that matches the specified JsonFilesystemStorageQuery.
 *
 * In this example the JsonFilesystemStorageQuery speicifes a
 * JsonStorageDirectoryPath and a Container. This will target
 * all of the Json in storage that exists in the specified
 * JsonStorageDirectoryPath whose Container matches the
 * specified Container.
 */
$jsonFilePathCollection = $jsonFilesystemStorageDriver->storedJsonFilePaths(
    $jsonFilesystemStorageQuery
);

echo PHP_EOL .
    IntegrationTestUtilities::applyANSIColor(
    'The following query:', rand(1, 231)
    ) .
    PHP_EOL;

echo PHP_EOL .
    IntegrationTestUtilities::applyANSIColor(
    $jsonFilesystemStorageQuery->__toString(), rand(1, 231)
    ) .
    PHP_EOL;

echo PHP_EOL .
    IntegrationTestUtilities::applyANSIColor(
    'Produced the following matches:', rand(1, 231)
    ) .
    PHP_EOL;

/**
 * Echo the JsonFilePath and Json for any stored Json that
 * matched the JsonFilesystemStorageQuery that was passed to
 * the $jsonFilesystemStorageDriver->storedJsonFilePaths()
 * method.
 */
foreach($jsonFilePathCollection->collection() as $jsonFilePath) {
    $jsonFilesystemStorageQuery = new JsonFilesystemStorageQuery(
        jsonFilePath: $jsonFilePath
    );
    echo PHP_EOL . 'Json File Path: ' .
        IntegrationTestUtilities::applyANSIColor(
            $jsonFilePath->__toString(),
            rand(1, 231)
        );
    echo PHP_EOL .
        'Json: ' .
        IntegrationTestUtilities::applyANSIColor(
            (
                $jsonFilesystemStorageDriver->read(
                    jsonFilesystemStorageQuery: $jsonFilesystemStorageQuery
                )->collection()[0] ?? ''
            ),
            rand(1, 231)
        ) .
        PHP_EOL .
        PHP_EOL;
}

/**
 * Delete the JsonStorageDirectory that the Json in this example was
 * written to.
 */
$jsonFilesystemStorageDriver->delete(
    $jsonFilesystemStorageQuery
);

```

### \Darling\PHPJsonStorageUtilities\classes\named\identifiers\Container

```
<?php

/**
 * This file demonstrates the usage of a Container.
 *
 * A Container is used to identify Json in storage, and will
 * typically be used in conjunction with a JsonFilePath or a
 * JsonFilesystemStorageQuery.
 *
 * A Container's value is a hash of either the value returned by
 * a ClassString instance's __toString() method, or a hash of
 * one of the Type enumeration's cases.
 *
 */

namespace Darling\PHPJsonStorageUtilities\examples;

include(
    dirname(__DIR__, 1) .
    DIRECTORY_SEPARATOR .
    'vendor' .
    DIRECTORY_SEPARATOR .
    'autoload.php'
);

use \Darling\PHPJsonStorageUtilities\classes\filesystem\paths\JsonFilePath;
use \Darling\PHPJsonStorageUtilities\classes\filesystem\paths\JsonStorageDirectoryPath;
use \Darling\PHPJsonStorageUtilities\classes\filesystem\storage\queries\JsonFilesystemStorageQuery;
use \Darling\PHPJsonStorageUtilities\classes\named\identifiers\Container;
use \Darling\PHPJsonStorageUtilities\classes\named\identifiers\Owner;
use \Darling\PHPJsonStorageUtilities\classes\named\identifiers\Location;
use \Darling\PHPJsonStorageUtilities\enumerations\Type;
use \Darling\PHPJsonStorageUtilities\tests\IntegrationTestUtilities;
use \Darling\PHPTextTypes\classes\strings\Id;
use \Darling\PHPTextTypes\classes\strings\Name;
use \Darling\PHPTextTypes\classes\strings\Text;

/*
 * Define an array of the possible cases defined by the
 * Type enumeration.
 */
$types = Type::cases();

/**
 * Instantiate a new Container using a randomly selected Type.
 */
$container = new Container($types[array_rand($types)]);

/**
 * Use the Container as part of the definition of a JsonFilePath.
 */
$jsonFilePath = new JsonFilePath(
    new JsonStorageDirectoryPath(
        new Name(
            new Text(
                'StorageDirectoryPathName' . strval(rand(1, 100))
            )
        )
    ),
    new Location(new Name(new Text('Owner' . strval(rand(1, 100))))),
    $container,
    new Owner(new Name(new Text('Owner' . strval(rand(1, 100))))),
    new Name(new Text('Name' . strval(rand(1, 100)))),
    new Id(),
);


/**
 * Use the Container as a JsonFilesystemStorageQuery parameter.
 */
$jsonFilesystemStorageQuery = new JsonFilesystemStorageQuery(
    container: $container,
);

/**
 * Echo the Container.
 */
echo PHP_EOL . IntegrationTestUtilities::applyANSIColor(
    'Container: ', rand(1, 231)
);

echo IntegrationTestUtilities::applyANSIColor(
        $container->__toString(),
        rand(1, 231),
    );

/**
 * Echo the JsonFilePath that included the Container in it's definition.
 */
echo PHP_EOL . IntegrationTestUtilities::applyANSIColor(
    'Json File Path that uses specified $container: ', rand(1, 231)
);

echo IntegrationTestUtilities::applyANSIColor(
        $jsonFilePath->__toString(),
        rand(1, 231),
    );

/**
 * Echo the JsonFilesystemStorageQuery that the Container was passed
 * to as a query parameter.
 */
echo PHP_EOL . IntegrationTestUtilities::applyANSIColor(
    'JsonFilesystemStorageQuery that uses specified $container: ',
    rand(1, 231)
);

echo IntegrationTestUtilities::applyANSIColor(
        $jsonFilesystemStorageQuery->__toString(),
        rand(1, 231),
    );

```

### \Darling\PHPJsonStorageUtilities\classes\named\identifiers\Location

```
<?php

/**
 * This file demonstrates the usage of a Location.
 *
 * A Location is used to identify Json in storage, and will
 * typically be used in conjunction with a JsonFilePath or a
 * JsonFilesystemStorageQuery.
 *
 */

namespace Darling\PHPJsonStorageUtilities\examples;

include(
    dirname(__DIR__, 1) .
    DIRECTORY_SEPARATOR .
    'vendor' .
    DIRECTORY_SEPARATOR .
    'autoload.php'
);

use \Darling\PHPJsonStorageUtilities\classes\filesystem\paths\JsonFilePath;
use \Darling\PHPJsonStorageUtilities\classes\filesystem\paths\JsonStorageDirectoryPath;
use \Darling\PHPJsonStorageUtilities\classes\filesystem\storage\queries\JsonFilesystemStorageQuery;
use \Darling\PHPJsonStorageUtilities\classes\named\identifiers\Container;
use \Darling\PHPJsonStorageUtilities\classes\named\identifiers\Location;
use \Darling\PHPJsonStorageUtilities\classes\named\identifiers\Owner;
use \Darling\PHPJsonStorageUtilities\enumerations\Type;
use \Darling\PHPJsonStorageUtilities\tests\IntegrationTestUtilities;
use \Darling\PHPTextTypes\classes\strings\Id;
use \Darling\PHPTextTypes\classes\strings\Name;
use \Darling\PHPTextTypes\classes\strings\Text;

/**
 * Instantiate a new Location.
 */
$location = new Location(
    new Name(new Text('Location' . strval(rand(1, 100))))
);


/**
 * Use the Location as part of the definition of a JsonFilePath.
 */
$jsonFilePath = new JsonFilePath(
    new JsonStorageDirectoryPath(
        new Name(
            new Text(
                'StorageDirectoryPathName' . strval(rand(1, 100))
            )
        )
    ),
    $location,
    new Container(Type::Array),
    new Owner(new Name(new Text('Owner' . strval(rand(1, 100))))),
    new Name(new Text('Name' . strval(rand(1, 100)))),
    new Id(),
);


/**
 * Use the Location as a JsonFilesystemStorageQuery parameter.
 */
$jsonFilesystemStorageQuery = new JsonFilesystemStorageQuery(
    location: $location,
);

/**
 * Echo the Location.
 */
echo PHP_EOL . IntegrationTestUtilities::applyANSIColor(
    'Location: ', rand(1, 231)
);

echo IntegrationTestUtilities::applyANSIColor(
        $location->__toString(),
        rand(1, 231),
    );

/**
 * Echo the JsonFilePath that included the Location in it's definition.
 */
echo PHP_EOL . IntegrationTestUtilities::applyANSIColor(
    'Json File Path that uses specified $location: ', rand(1, 231)
);

echo IntegrationTestUtilities::applyANSIColor(
        $jsonFilePath->__toString(),
        rand(1, 231),
    );

/**
 * Echo the JsonFilesystemStorageQuery that the Location was passed
 * to as a query parameter.
 */
echo PHP_EOL . IntegrationTestUtilities::applyANSIColor(
    'JsonFilesystemStorageQuery that uses specified $location: ',
    rand(1, 231)
);

echo IntegrationTestUtilities::applyANSIColor(
        $jsonFilesystemStorageQuery->__toString(),
        rand(1, 231),
    );

```

### \Darling\PHPJsonStorageUtilities\classes\named\identifiers\NamedIdentifier

```
<?php

/**
 * This file demonstrates the usage of a NamedIdentifier.
 */

namespace Darling\PHPJsonStorageUtilities\examples;

include(
    dirname(__DIR__, 1) .
    DIRECTORY_SEPARATOR .
    'vendor' .
    DIRECTORY_SEPARATOR .
    'autoload.php'
);

use \Darling\PHPJsonStorageUtilities\classes\named\identifiers\NamedIdentifier;
use \Darling\PHPJsonStorageUtilities\tests\IntegrationTestUtilities;
use \Darling\PHPTextTypes\classes\strings\Name;
use \Darling\PHPTextTypes\classes\strings\Text;

$namedIdentifier = new NamedIdentifier(
    new Name(new Text('NamedIdentifier' . strval(rand(1, 100))))
);

echo PHP_EOL .
    'NamedIdentifier:' .
    IntegrationTestUtilities::applyANSIColor(
        $namedIdentifier->__toString(), rand(1, 231)
    );

```

### \Darling\PHPJsonStorageUtilities\classes\named\identifiers\Owner

```
<?php

/**
 * This file demonstrates the usage of a Owner.
 *
 * A Owner is used to identify Json in storage, and will
 * typically be used in conjunction with a JsonFilePath or a
 * JsonFilesystemStorageQuery.
 *
 */

namespace Darling\PHPJsonStorageUtilities\examples;

include(
    dirname(__DIR__, 1) .
    DIRECTORY_SEPARATOR .
    'vendor' .
    DIRECTORY_SEPARATOR .
    'autoload.php'
);

use \Darling\PHPJsonStorageUtilities\classes\filesystem\paths\JsonFilePath;
use \Darling\PHPJsonStorageUtilities\classes\filesystem\paths\JsonStorageDirectoryPath;
use \Darling\PHPJsonStorageUtilities\classes\filesystem\storage\queries\JsonFilesystemStorageQuery;
use \Darling\PHPJsonStorageUtilities\classes\named\identifiers\Container;
use \Darling\PHPJsonStorageUtilities\classes\named\identifiers\Owner;
use \Darling\PHPJsonStorageUtilities\classes\named\identifiers\Location;
use \Darling\PHPJsonStorageUtilities\enumerations\Type;
use \Darling\PHPJsonStorageUtilities\tests\IntegrationTestUtilities;
use \Darling\PHPTextTypes\classes\strings\Id;
use \Darling\PHPTextTypes\classes\strings\Name;
use \Darling\PHPTextTypes\classes\strings\Text;

/**
 * Instantiate a new Owner.
 */
$owner = new Owner(
    new Name(new Text('Owner' . strval(rand(1, 100))))
);


/**
 * Use the Owner as part of the definition of a JsonFilePath.
 */
$jsonFilePath = new JsonFilePath(
    new JsonStorageDirectoryPath(
        new Name(
            new Text(
                'StorageDirectoryPathName' . strval(rand(1, 100))
            )
        )
    ),
    new Location(
        new Name(new Text('Location' . strval(rand(1, 100))))
    ),
    new Container(Type::Array),
    $owner,
    new Name(new Text('Name' . strval(rand(1, 100)))),
    new Id(),
);


/**
 * Use the Owner as a JsonFilesystemStorageQuery parameter.
 */
$jsonFilesystemStorageQuery = new JsonFilesystemStorageQuery(
    owner: $owner,
);

/**
 * Echo the Owner.
 */
echo PHP_EOL . IntegrationTestUtilities::applyANSIColor(
    'Owner: ', rand(1, 231)
);

echo IntegrationTestUtilities::applyANSIColor(
        $owner->__toString(),
        rand(1, 231),
    );

/**
 * Echo the JsonFilePath that included the Owner in it's definition.
 */
echo PHP_EOL . IntegrationTestUtilities::applyANSIColor(
    'Json File Path that uses specified $owner: ', rand(1, 231)
);

echo IntegrationTestUtilities::applyANSIColor(
        $jsonFilePath->__toString(),
        rand(1, 231),
    );

/**
 * Echo the JsonFilesystemStorageQuery that the Owner was passed
 * to as a query parameter.
 */
echo PHP_EOL . IntegrationTestUtilities::applyANSIColor(
    'JsonFilesystemStorageQuery that uses specified $owner: ',
    rand(1, 231)
);

echo IntegrationTestUtilities::applyANSIColor(
        $jsonFilesystemStorageQuery->__toString(),
        rand(1, 231),
    );

```

### \Darling\enumerations\Type

```
<?php

/**
 * This file demonstrates the usage the Type enum.
 *
 * The Type enum is typically used in conjunction with the
 * gettype() function to match a values type.
 *
 */

namespace Darling\PHPJsonStorageUtilities\examples;

use \Darling\PHPJsonStorageUtilities\enumerations\Type;
use \Darling\PHPJsonStorageUtilities\tests\IntegrationTestUtilities;
use \Darling\PHPTextTypes\classes\strings\Id;
use \stdClass;

include(
    dirname(__DIR__, 1) .
    DIRECTORY_SEPARATOR .
    'vendor' .
    DIRECTORY_SEPARATOR .
    'autoload.php'
);

/** Open a resource */
$openResource = tmpfile();

/** Open and close a resource */
$closedResource = fopen(DIRECTORY_SEPARATOR . 'tmp', 'r');
if(is_resource($closedResource) && $closedResource !== false) {
    fclose($closedResource);
}

/**
 * Define an array of values of various types.
 */
$values = [
    'foo',
    1,
    23.45,
    true,
    function (): void {},
    [1, 2, ['3']],
    null,
    false,
    new stdClass(),
    $openResource,
    $closedResource,
    new Id(),
];

/**
 * Pick a random value from the array of $values.
 *
 * @var mixed $value
 */
$value = $values[array_rand($values)];

/**
 * Echo out the Type case that matches the $value's type.
 */
echo IntegrationTestUtilities::applyANSIColor('Type:', rand(1, 231));
echo IntegrationTestUtilities::applyANSIColor(
    match(gettype($value)) {
        Type::String->value => Type::String->value,
        Type::Bool->value => Type::Bool->value,
        Type::Int->value => Type::Int->value,
        Type::Float->value => Type::Float->value,
        Type::Array->value => Type::Array->value,
        Type::Null->value => Type::Null->value,
        Type::Object->value => Type::Object->value,
        Type::Resource->value => Type::Resource->value,
        Type::ResourceClosed->value => Type::ResourceClosed->value,
        Type::UnknownType->value => Type::UnknownType->value,
    },
    rand(1, 231),
);

```

