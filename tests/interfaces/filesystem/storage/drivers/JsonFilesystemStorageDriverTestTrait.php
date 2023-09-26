<?php

namespace Darling\PHPJsonStorageUtilities\tests\interfaces\filesystem\storage\drivers;

use \Darling\PHPJsonStorageUtilities\classes\collections\JsonCollection as JsonCollectionInstance;
use \Darling\PHPJsonStorageUtilities\classes\collections\JsonFilePathCollection as JsonFilePathCollectionInstance;
use \Darling\PHPJsonStorageUtilities\classes\filesystem\paths\JsonFilePath as JsonFilePathInstance;
use \Darling\PHPJsonStorageUtilities\classes\filesystem\paths\JsonStorageDirectoryPath;
use \Darling\PHPJsonStorageUtilities\classes\filesystem\storage\queries\JsonFilesystemStorageQuery;
use \Darling\PHPJsonStorageUtilities\classes\named\identifiers\Container;
use \Darling\PHPJsonStorageUtilities\classes\named\identifiers\Location;
use \Darling\PHPJsonStorageUtilities\classes\named\identifiers\Owner;
use \Darling\PHPJsonStorageUtilities\enumerations\Type;
use \Darling\PHPJsonStorageUtilities\interfaces\filesystem\paths\JsonFilePath;
use \Darling\PHPJsonStorageUtilities\interfaces\filesystem\storage\drivers\JsonFilesystemStorageDriver;
use \Darling\PHPJsonUtilities\classes\decoders\JsonDecoder as JsonDecoderInstance;
use \Darling\PHPJsonUtilities\classes\encoded\data\Json as JsonInstance;
use \Darling\PHPJsonUtilities\interfaces\decoders\JsonDecoder;
use \Darling\PHPJsonUtilities\interfaces\encoded\data\Json;
use \Darling\PHPTextTypes\classes\strings\AlphanumericText;
use \Darling\PHPTextTypes\classes\strings\ClassString as ClassStringInstance;
use \Darling\PHPTextTypes\classes\strings\Id;
use \Darling\PHPTextTypes\classes\strings\Name;
use \Darling\PHPTextTypes\classes\strings\Text;
use \Darling\PHPTextTypes\interfaces\strings\ClassString;
use \ReflectionObject;
use \Darling\PHPJsonStorageUtilities\tests\IntegrationTestUtilities;


/**
 * The JsonFilesystemStorageDriverTestTrait defines common tests for
 * implementations of the JsonFilesystemStorageDriver interface.
 *
 * @see JsonFilesystemStorageDriver
 *
 */
trait JsonFilesystemStorageDriverTestTrait
{

    /**
     * @var JsonFilesystemStorageDriver $jsonFilesystemStorageDriver
     *                              An instance of a
     *                              JsonFilesystemStorageDriver
     *                              implementation to test.
     */
    protected JsonFilesystemStorageDriver $jsonFilesystemStorageDriver;

    /**
     * @var JsonFilePath $expectedJsonFilePath
     *                                The JsonFilePath that
     *                                will be used to test
     *                                the JsonFilesystemStorageDriver
     *                                being tested's methods.
     */
    private $expectedJsonFilePath;

    /**
     * @var Json $expectedJson The Json that will be used to test the
     *                         JsonFilesystemStorageDriver being
     *                         tested's methods.
     */
    private $expectedJson;

    /**
     * Set up an instance of a JsonFilesystemStorageDriver
     * implementation to test.
     *
     * This method must set the JsonFilesystemStorageDriver
     * implementation instance to be tested via the
     * setJsonFilesystemStorageDriverTestInstance() method.
     *
     * This method must also set the JsonFilePath instance that will
     * be used for testing.
     *
     * This method may also be used to perform any additional
     * setup required by the implementation being tested.
     *
     * @return void
     *
     * @example
     *
     * ```
     * public function setUp(): void
     * {
     *     $testData = [
     *         $this->randomChars(),
     *         $this->randomClassStringOrObjectInstance(),
     *         $this->randomFloat(),
     *         $this->randomObjectInstance(),
     *         $this->prefixedRandomName($this->randomChars()),
     *     ];
     *     $json = new Json($testData[array_rand($testData)]);
     *     $this->setExpectedJson($json);
     *     $container = new Container(
     *         IntegrationTestUtilities::determineType($this->expectedJson())
     *     );
     *     $jsonFilePath = new JsonFilePath(
     *         new JsonStorageDirectoryPath(
     *             new Name(new Text(self::TEST_STORAGE_DIRECTORY_NAME)),
     *         ),
     *         new Location($this->prefixedRandomName('Location')),
     *         $container,
     *         new Owner($this->prefixedRandomName('Owner')),
     *         $this->prefixedRandomName('Name'),
     *         new Id(),
     *     );
     *     $this->setExpectedJsonFilePath($jsonFilePath);
     *     $this->setJsonFilesystemStorageDriverTestInstance(
     *         new JsonFilesystemStorageDriver()
     *     );
     *     $this->deleteTestJsonStorageDirectory(
     *         $this->expectedJsonFilePath()
     *              ->jsonStorageDirectoryPath()
     *              ->__toString()
     *     );
     * }
     *
     * ```
     *
     */
    abstract protected function setUp(): void;

    /**
     * Return the JsonFilesystemStorageDriver implementation instance
     * to test.
     *
     * @return JsonFilesystemStorageDriver
     *
     */
    protected function jsonFilesystemStorageDriverTestInstance(): JsonFilesystemStorageDriver
    {
        return $this->jsonFilesystemStorageDriver;
    }

    /**
     * Set the JsonFilesystemStorageDriver implementation instance to
     * test.
     *
     * @param JsonFilesystemStorageDriver $jsonFilesystemStorageDriverTestInstance
     *                                 An instance of an
     *                                 implementation of
     *                                 the JsonFilesystemStorageDriver
     *                                 interface to test.
     *
     * @return void
     *
     */
    protected function setJsonFilesystemStorageDriverTestInstance(
        JsonFilesystemStorageDriver $jsonFilesystemStorageDriverTestInstance
    ): void
    {
        $this->jsonFilesystemStorageDriver =
            $jsonFilesystemStorageDriverTestInstance;
    }

    /**
     * Set the JsonFilePath that the JsonFilesystemStorageDriver
     * instance being tested is expected to read from, write to,
     * and delete.
     *
     * @return void
     *
     */
    protected function setExpectedJsonFilePath(
        JsonFilePath $jsonFilePath
    ): void
    {
        $this->expectedJsonFilePath = $jsonFilePath;
    }

    /**
     * Return the JsonFilePath that the JsonFilesystemStorageDriver
     * instance being tested is expected to read from, write to,
     * and delete.
     *
     * @return JsonFilePath
     *
     */
    protected function expectedJsonFilePath(): JsonFilePath
    {
        return $this->expectedJsonFilePath;
    }

    /**
     * Set the Json that the JsonFilesystemStorageDriver instance
     * being tested is expected to read, write, and delete.
     *
     * @return void
     *
     */
    protected function setExpectedJson(Json $json): void
    {
        $this->expectedJson = $json;
    }

    /**
     * Return the Json that the JsonFilesystemStorageDriver instance
     * being tested is expected to read, write, and delete.
     *
     * @return Json
     *
     */
    protected function expectedJson(): Json
    {
        return $this->expectedJson;
    }

    /**
     * Return a Name instance whose name is prefixed by
     * the specified $prefix.
     *
     * @param string $prefix The prefix to use.
     *
     * @return Name
     *
     */
    protected function prefixedRandomName(string $prefix): Name
    {
        return new Name(
            new Text(
                $prefix .
                ucfirst(substr($this->randomChars(), 0, 3))
            )
        );
    }

    /**
     * Return a JsonCollection instance that is assigned a collection
     * of Json instances that should be matched by the specified
     * $jsonFilesystemStorageQuery.
     *
     * @param JsonFilesystemStorageQuery $jsonFilesystemStorageQuery
     *                                  The JsonFilesystemStorageQuery
     *                                  that will determine which
     *                                  Json instances are included
     *                                  in the returned
     *                                  JsonCollection.
     *
     * @return JsonCollectionInstance
     *
     */
    private function expectedJsonFilesystemStorageQueryResults(
        JsonFilesystemStorageQuery $jsonFilesystemStorageQuery
    ): JsonCollectionInstance
    {
        $jsonDecoder = $this->jsonFilesystemStorageDriverTestInstance()
                            ->jsonDecoder();
        $jsonFilePath = $jsonFilesystemStorageQuery->jsonFilePath();
        if($jsonFilePath instanceof JsonFilePath && file_exists($jsonFilePath->__toString())) {
            return new JsonCollectionInstance(
                new JsonInstance(
                    $jsonDecoder->decodeJsonString(
                        strval(
                            file_get_contents(
                                $jsonFilePath->__toString()
                            )
                        )
                    )
                )
            );
        }
        $files = glob($jsonFilesystemStorageQuery->__toString());
        $data = [];
        if(is_array($files)) {
            foreach($files as $file) {
                if(file_exists($file)) {
                    $data[] = new JsonInstance(
                        $jsonDecoder->decodeJsonString(
                            strval(file_get_contents($file))
                        )
                    );
                }
            }
        }
        return new JsonCollectionInstance(...$data);
    }

    /**
     * Return a JsonFilePathCollection instance that is assigned a
     * collection of JsonFilePath instances that should be matched
     * by the specified $jsonFilesystemStorageQuery.
     *
     * @param JsonFilesystemStorageQuery $jsonFilesystemStorageQuery
     *                                  The JsonFilesystemStorageQuery
     *                                  that will determine which
     *                                  JsonFilePath instances are
     *                                  included in the returned
     *                                  JsonFilePathCollection.
     *
     * @return JsonFilePathCollectionInstance
     *
     */
    private function expectedStoredJsonFilePathQueryResults(
        JsonFilesystemStorageQuery $jsonFilesystemStorageQuery
    ): JsonFilePathCollectionInstance
    {
        $jsonDecoder = $this->jsonFilesystemStorageDriverTestInstance()
                            ->jsonDecoder();
        $jsonFilePath = $jsonFilesystemStorageQuery->jsonFilePath();
        if($jsonFilePath instanceof JsonFilePath) {
            return new JsonFilePathCollectionInstance($jsonFilePath);
        }
        $files = glob($jsonFilesystemStorageQuery->__toString());
        /** @var array<int, JsonFilePath> $data */
        $data = [];
        if(is_array($files)) {
            foreach($files as $file) {
                $pathParts = explode(DIRECTORY_SEPARATOR, $file);
                $data[] = new JsonFilePathInstance(
                    new JsonStorageDirectoryPath(
                        new Name(new Text($pathParts[7] ?? ''))
                    ),
                    new Location(
                        new Name(new Text($pathParts[8] ?? ''))
                    ),
                    new Container(
                        IntegrationTestUtilities::determineType(
                            new JsonInstance(
                                $jsonDecoder->decodeJsonString(
                                    strval(file_get_contents($file))
                                )
                            )
                        )
                    ),
                    new Owner(
                        new Name(new Text($pathParts[10] ?? ''))
                    ),
                    new Name(new Text($pathParts[11] ?? '')),
                    $this->determineIdFromFilePath($file),
                );
            }
        }
        return new JsonFilePathCollectionInstance(...$data);
    }


    /**
     * Derive an Id from a $filePath.
     *
     * @param string $filePath The file path.
     *
     * @return Id
     *
     */
    private function determineIdFromFilePath(string $filePath) : Id
    {
        $pathParts = explode(DIRECTORY_SEPARATOR, $filePath);
        $id = new \Darling\PHPTextTypes\classes\strings\Id();
        $reflectionClass = new ReflectionObject($id);
        if(
            $reflectionClass !== false
            &&
            isset($pathParts[12])
            &&
            isset($pathParts[13])
        ) {
            $reflectionClass = $reflectionClass->getParentClass();
            if($reflectionClass !== false) {
                $reflectionClass = $reflectionClass->getParentClass();
                if($reflectionClass !== false) {
                    $reconstructedId = str_replace(
                        '.json',
                        '',
                        $pathParts[12] . $pathParts[13]
                    );
                    $property =
                        $reflectionClass->getProperty(
                            'text'
                        );
                    $property->setAccessible(true);
                    $property->setValue(
                        $id,
                        new AlphanumericText(
                            new Text($reconstructedId)
                        )
                    );
                    $reflectionClass = $reflectionClass->getParentClass();
                    if($reflectionClass !== false) {
                        $property =
                            $reflectionClass->getProperty(
                                'string'
                            );
                        $property->setAccessible(true);
                        $property->setValue(
                            $id,
                            $reconstructedId
                        );
                        return $id;
                    }
                }
            }
        }
        return new Id();
    }

    /**
     * Test jsonDecoder() returns an instance of a JsonDecoder.
     *
     * @return void
     *
     * @covers JsonFilesystemStorageDriver->jsonDecoder()
     */
    public function test_jsonDecoder_returns_an_instance_of_a_JsonDecoder(): void
    {
        $this->assertTrue(
            $this->jsonFilesystemStorageDriverTestInstance()
                 ->jsonDecoder() instanceof JsonDecoder,
            $this->testFailedMessage(
                $this->jsonFilesystemStorageDriverTestInstance(),
                'jsonDecoder',
                'return an instance of a JsonDecoder',
            ),
        );
    }

    /**
     * Test write() writes to the expected JsonFilePath.
     *
     * @return void
     *
     * @covers JsonFilesystemStorageDriver->write()
     *
     */
    public function test_write_writes_to_the_expected_json_file_path(): void
    {
        $status = $this->jsonFilesystemStorageDriverTestInstance()
                       ->write(
                           $this->expectedJson(),
                           $this->expectedJsonFilePath()
                                ->jsonStorageDirectoryPath(),
                           $this->expectedJsonFilePath->location(),
                           $this->expectedJsonFilePath->owner(),
                           $this->expectedJsonFilePath->name(),
                           $this->expectedJsonFilePath()->id(),
                       );
        $this->assertTrue(
            file_exists(
                $this->expectedJsonFilePath()->__toString()
            ),
            $this->testFailedMessage(
                $this->jsonFilesystemStorageDriverTestInstance(),
                'write',
                'write to the expected JsonFilePath:' .
                PHP_EOL .
                PHP_EOL .
                $this->expectedJsonFilePath() .
                PHP_EOL .
                PHP_EOL,
            ),
        );
        $this->assertTrue(
            $status,
            $this->testFailedMessage(
                $this->jsonFilesystemStorageDriverTestInstance(),
                'write',
                'write returns true if a file was written to the ' .
                'expected JsonFilePath',
            ),
        );
    }

    /**
     * Test write() writes the expected json to the expected
     * JsonFilePath.
     *
     * @return void
     *
     * @covers JsonFilesystemStorageDriver->write()
     *
     */
    public function test_write_writes_the_expected_json_to_the_expected_json_file_path(): void
    {
        $status = $this->jsonFilesystemStorageDriverTestInstance()
                       ->write(
                           $this->expectedJson(),
                           $this->expectedJsonFilePath()
                                ->jsonStorageDirectoryPath(),
                           $this->expectedJsonFilePath->location(),
                           $this->expectedJsonFilePath->owner(),
                           $this->expectedJsonFilePath->name(),
                           $this->expectedJsonFilePath()->id(),
                       );
        $this->assertEquals(
            $this->expectedJson()->__toString(),
            file_get_contents(
                $this->expectedJsonFilePath()->__toString()
            ),
            $this->testFailedMessage(
                $this->jsonFilesystemStorageDriverTestInstance(),
                'write',
                'writes the expected Json to the expected ' .
                'JsonFilePath',
            ),
        );
        $this->assertTrue(
            $status,
            $this->testFailedMessage(
                $this->jsonFilesystemStorageDriverTestInstance(),
                'write',
                'write returns true if the expected Json was ' .
                'written to the expected JsonFilePath',
            ),
        );
    }

    /**
     * Test write() does not overwrite previously stored data.
     *
     * @return void
     *
     * @covers JsonFilesystemStorageDriver->write()
     *
     */
    public function test_write_does_not_overwrite_previously_stored_data(): void
    {
        /** Clear file status cache @see https://www.php.net/manual/en/function.clearstatcache.php */
        clearstatcache();
        $status = $this->jsonFilesystemStorageDriverTestInstance()
                       ->write(
                           $this->expectedJson(),
                           $this->expectedJsonFilePath()->jsonStorageDirectoryPath(),
                           $this->expectedJsonFilePath->location(),
                           $this->expectedJsonFilePath->owner(),
                           $this->expectedJsonFilePath->name(),
                           $this->expectedJsonFilePath()->id(),
                       );
        clearstatcache();
        /**
         * Sleep between writes to allow file modification time to
         * change if original file is overwritten
         */
        sleep(1);
        $initialModificationTime = filemtime(
            $this->expectedJsonFilePath()->__toString()
        );
        $status = $this->jsonFilesystemStorageDriverTestInstance()
                       ->write(
                           $this->expectedJson(),
                           $this->expectedJsonFilePath()
                                ->jsonStorageDirectoryPath(),
                           $this->expectedJsonFilePath->location(),
                           $this->expectedJsonFilePath->owner(),
                           $this->expectedJsonFilePath->name(),
                           $this->expectedJsonFilePath()->id(),
                       );
        clearstatcache();
        $lastModificationTime = filemtime(
            $this->expectedJsonFilePath()->__toString()
        );
        $this->assertEquals(
            $initialModificationTime,
            $lastModificationTime,
            $this->testFailedMessage(
                $this->jsonFilesystemStorageDriverTestInstance(),
                'write',
                'must not overwrite previsouly stored Json'
            ),
        );
        $this->assertFalse(
            $status,
            $this->testFailedMessage(
                $this->jsonFilesystemStorageDriverTestInstance(),
                'write',
                'return false if the expected Json was not ' .
                'written to the expected JsonFilePath',
            ),
        );
    }

    /**
     * Test read() returns an empty JsonCollection if there is nothing
     * in storage.
     *
     * @return void
     *
     * @covers JsonFilesystemStorageDriver->read()
     *
     */
    public function test_read_returns_an_empty_JsonCollection_if_there_is_nothing_in_storage(): void
    {
        $expectedCollection = new JsonCollectionInstance();
        $jsonFilesystemStorageQuery = new JsonFilesystemStorageQuery();
        $this->assertEquals(
            [],
            $this->jsonFilesystemStorageDriverTestInstance()
                 ->read($jsonFilesystemStorageQuery)
                 ->collection(),
            $this->testFailedMessage(
                $this->jsonFilesystemStorageDriverTestInstance(),
                'read',
                'returns an empty JsonCollection there is nothing ' .
                'in storage',
            ),
        );
    }

    /**
     * Test read() returns an empty array if JsonFilesystemStorageQuery does not produce
     * any matches.
     *
     * @return void
     *
     * @covers JsonFilesystemStorageDriver->read()
     *
     */
    public function test_read_returns_an_empty_JsonCollection_if_JsonFilesystemStorageQuery_does_not_produce_any_matches(): void
    {
        $randomData = [
            $this->randomClassStringOrObjectInstance(),
            $this->randomChars(),
            rand(PHP_INT_MIN, PHP_INT_MAX),
            floatval(strval(rand(0, 100)) . strval(rand(0, 100))),
        ];
        for(
            $numberOfJsonInstancesWrittenToStorage = 0;
            $numberOfJsonInstancesWrittenToStorage < rand(10, 20);
            $numberOfJsonInstancesWrittenToStorage++
        ) {
            $this->jsonFilesystemStorageDriverTestInstance()->write(
                new JsonInstance($randomData[array_rand($randomData)]),
                $this->expectedJsonFilePath->jsonStorageDirectoryPath(),
                new Location(new Name(new Text($this->randomChars()))),
                new Owner(new Name(new Text($this->randomChars()))),
                $this->prefixedRandomName(
                    'ReadReturnsEmptyJsonCollectionIfQueryDoesNotMatch'
                ),
                new Id(),
            );
        }
        $jsonFilesystemStorageQuery = new JsonFilesystemStorageQuery(
            id: new Id(),
            name: $this->prefixedRandomName(
                'NameForTestReadReturnsEmptyJsonCollectionIfQueryDoesNotMatch'
            ),
            owner: new Owner(
                $this->prefixedRandomName(
                    'OwnerForTestReadReturnsEmptyJsonCollectionIfQueryDoesNotMatch'
                )
            ),
        );
        $this->assertEquals(
            [],
            $this->jsonFilesystemStorageDriverTestInstance()
                 ->read($jsonFilesystemStorageQuery)->collection(),
            $this->testFailedMessage(
                $this->jsonFilesystemStorageDriverTestInstance(),
                'read',
                'returns an empty JsonCollection if JsonFilesystemStorageQuery does not ' .
                'produce any matches',
            ),
        );
    }

    /**
     * Test read() returns a JsonCollection that contains all of the
     * Json in storage if the JsonFilesystemStorageQuery is empty.
     *
     * @return void
     *
     * @covers JsonFilesystemStorageDriver->read()
     *
     */
    public function test_read_returns_a_JsonCollection_that_contains_all_of_the_Json_in_storage_if_the_JsonFilesystemStorageQuery_is_empty(): void
    {
        $randomData = [
            $this->randomClassStringOrObjectInstance(),
            $this->randomChars(),
            rand(PHP_INT_MIN, PHP_INT_MAX),
            floatval(strval(rand(0, 100)) . strval(rand(0, 100))),
        ];
        for(
            $numberOfJsonInstancesWrittenToStorage = 0;
            $numberOfJsonInstancesWrittenToStorage < rand(10, 20);
            $numberOfJsonInstancesWrittenToStorage++
        ) {
            $this->jsonFilesystemStorageDriverTestInstance()->write(
                new JsonInstance($randomData[array_rand($randomData)]),
                $this->expectedJsonFilePath->jsonStorageDirectoryPath(),
                new Location(new Name(new Text($this->randomChars()))),
                new Owner(new Name(new Text($this->randomChars()))),
                $this->prefixedRandomName(
                    'ReadReturnsJsonCollectionContaingAllStoredJsonIfQueryIsEmpty'
                ),
                new Id(),
            );
        }
        $jsonFilesystemStorageQuery = new JsonFilesystemStorageQuery();
        $actualQueryResults = $this->jsonFilesystemStorageDriverTestInstance()
                             ->read($jsonFilesystemStorageQuery);
        $this->assertEquals(
            $this->expectedJsonFilesystemStorageQueryResults(
                $jsonFilesystemStorageQuery
            ),
            $actualQueryResults,
            $this->testFailedMessage(
                $this->jsonFilesystemStorageDriverTestInstance(),
                'read',
                'return all stored Json if ' .
                'JsonFilesystemStorageQuery is empty',
            ),
        );
        $this->assertEquals(
            $numberOfJsonInstancesWrittenToStorage,
            count($actualQueryResults->collection()),
            $this->testFailedMessage(
                $this->jsonFilesystemStorageDriverTestInstance(),
                'read',
                'return all stored Json if JsonFilesystemStorageQuery'
                . 'is empty.' .
                'Expected ' .
                $numberOfJsonInstancesWrittenToStorage .
                ' items in the returned JsonCollection ' .
                'but there are only' .
                count($actualQueryResults->collection()) . ' items ' .
                'in the returned JsonCollection',
            ),
        );
    }

    /**
     * Test read() returns a JsonCollection that only contains a
     * single Json instance read from the specified JsonFilePath if
     * the specified JsonFilesystemStorageQuery specifies a
     * JsonFilePath.
     *
     * @return void
     *
     * @covers JsonFilesystemStorageDriver->read()
     *
     */
    public function test_read_returns_a_JsonCollection_that_only_contains_a_single_Json_instance_read_from_the_specified_JsonFilePath_if_the_specified_JsonFilesystemStorageQuery_specifies_a_JsonFilePath(): void
    {
        $randomData = [
            $this->randomClassStringOrObjectInstance(),
            $this->randomChars(),
            rand(PHP_INT_MIN, PHP_INT_MAX),
            floatval(strval(rand(0, 100)) . strval(rand(0, 100))),
        ];
        /** @var array<int, JsonFilePath> $jsonFilePaths */
        $jsonFilePaths = [];
        for(
            $numberOfJsonInstancesWrittenToStorage = 0;
            $numberOfJsonInstancesWrittenToStorage < rand(10, 20);
            $numberOfJsonInstancesWrittenToStorage++
        ) {
            $jsonInstance = new JsonInstance(
                $randomData[array_rand($randomData)]
            );
            $jsonFilesystemStorageDirectoryPath =
                $this->expectedJsonFilePath
                     ->jsonStorageDirectoryPath();
            $location = new Location(
                new Name(new Text($this->randomChars()))
            );
            $container = new Container(
                IntegrationTestUtilities::determineType($jsonInstance)
            );
            $owner = new Owner(
                new Name(new Text($this->randomChars()))
            );
            $name = $this->prefixedRandomName(
                'ReadOnlyReturnsTheJsoneReadFromSpecifiedJsonFilePathIfJsonFilePathIsQueried'
            );
            $id = new Id();
            $this->jsonFilesystemStorageDriverTestInstance()->write(
                $jsonInstance,
                $jsonFilesystemStorageDirectoryPath,
                $location,
                $owner,
                $name,
                $id,
            );
            $jsonFilePaths[] = new JsonFilePathInstance(
                $jsonFilesystemStorageDirectoryPath,
                $location,
                $container,
                $owner,
                $name,
                $id
            );
        }
        $jsonFilesystemStorageQuery = new JsonFilesystemStorageQuery(
            jsonFilePath: $jsonFilePaths[array_rand($jsonFilePaths)]
        );
        $expectedQueryResults = $this->expectedJsonFilesystemStorageQueryResults(
            $jsonFilesystemStorageQuery
        );
        $actualQueryResults = $this->jsonFilesystemStorageDriverTestInstance()
                                   ->read($jsonFilesystemStorageQuery);
        $this->assertEquals(
            $expectedQueryResults,
            $actualQueryResults,
            $this->testFailedMessage(
                $this->jsonFilesystemStorageDriverTestInstance(),
                'read',
                'return only the Json stored at the specified ' .
                'JsonFilePath if the JsonFilesystemStorageQuery ' .
                'specifies a JsonFilePath',
            ),
        );
    }

    /**
     * Test read() returns a JsonCollection that contains the expected
     * Json intances based on a JsonFilesystemStorageQuery.
     *
     * @return void
     *
     * @covers JsonFilesystemStorageDriver->read()
     *
     */
    public function test_read_returns_a_JsonCollection_that_contains_the_expected_Json_intances_based_on_a_JsonFilesystemStorageQuery(): void
    {
        $randomData = [
            $this->randomClassStringOrObjectInstance(),
            $this->randomChars(),
            rand(PHP_INT_MIN, PHP_INT_MAX),
            floatval(strval(rand(0, 100)) . strval(rand(0, 100))),
        ];
        /** @var array<int, JsonFilesystemStorageQuery> $completeQueries */
        $completeQueries = [];
        /** @var array<int, JsonFilesystemStorageQuery> $incompleteQueries  */
        $incompleteQueries = [];
        /** @var array<int, JsonFilesystemStorageQuery> $jsonFilePathQueries */
        $jsonFilePathQueries = [];
        for(
            $numberOfJsonInstancesWrittenToStorage = 0;
            $numberOfJsonInstancesWrittenToStorage < rand(10, 20);
            $numberOfJsonInstancesWrittenToStorage++
        ) {
            $jsonInstance = new JsonInstance(
                $randomData[array_rand($randomData)]
            );
            $jsonFilesystemStorageDirectoryPath =
                $this->expectedJsonFilePath
                     ->jsonStorageDirectoryPath();
            $location = new Location(
                new Name(new Text($this->randomChars()))
            );
            $container = new Container(
                IntegrationTestUtilities::determineType($jsonInstance)
            );
            $owner = new Owner(
                new Name(new Text($this->randomChars()))
            );
            $name = $this->prefixedRandomName(
                'ReadOnlyReturnsTheJsoneReadFromSpecifiedJsonFilePathIfJsonFilePathIsQueried'
            );
            $id = new Id();
            $this->jsonFilesystemStorageDriverTestInstance()->write(
                $jsonInstance,
                $jsonFilesystemStorageDirectoryPath,
                $location,
                $owner,
                $name,
                $id,
            );
            $completeQueries[] = new JsonFilesystemStorageQuery(
                jsonStorageDirectoryPath: $jsonFilesystemStorageDirectoryPath,
                location: $location,
                container: $container,
                owner: $owner,
                name: $name,
                id: $id,
            );
            $incompleteQueries[] = new JsonFilesystemStorageQuery(
                jsonStorageDirectoryPath: (
                    rand(0, 1) === 0
                    ? $jsonFilesystemStorageDirectoryPath
                    : null
                ),
                location: (rand(0, 1) === 0 ? $location : null),
                container: (rand(0, 1) === 0 ? $container : null),
                owner: (rand(0, 1) === 0 ? $owner : null),
                name: (rand(0, 1) === 0 ? $name : null),
                id: (rand(0, 1) === 0 ? $id : null),
            );
            $jsonFilePath = new JsonFilePathInstance(
                $jsonFilesystemStorageDirectoryPath,
                $location,
                $container,
                $owner,
                $name,
                $id
            );
            $jsonFilePathQueries[] = new JsonFilesystemStorageQuery(
                jsonFilePath: $jsonFilePath,
            );
        }
        $completeJsonFilesystemStorageQuery =
            $completeQueries[array_rand($completeQueries)];
        $expectedQueryResults =
            $this->expectedJsonFilesystemStorageQueryResults(
                $completeJsonFilesystemStorageQuery
            );
        $actualQueryResults =
            $this->jsonFilesystemStorageDriverTestInstance()
                 ->read($completeJsonFilesystemStorageQuery);
        $this->assertEquals(
            $expectedQueryResults,
            $actualQueryResults,
            $this->testFailedMessage(
                $this->jsonFilesystemStorageDriverTestInstance(),
                'read',
                'return only the Json stored at the specified ' .
                'JsonFilePath if the JsonFilesystemStorageQuery ' .
                'specifies a JsonFilePath',
            ),
        );
        $incompleteJsonFilesystemStorageQuery =
            $incompleteQueries[array_rand($incompleteQueries)];
        $expectedQueryResults =
        $this->expectedJsonFilesystemStorageQueryResults(
            $incompleteJsonFilesystemStorageQuery
        );
        $actualQueryResults =
            $this->jsonFilesystemStorageDriverTestInstance()
                 ->read($incompleteJsonFilesystemStorageQuery);
        $this->assertEquals(
            $expectedQueryResults,
            $actualQueryResults,
            $this->testFailedMessage(
                $this->jsonFilesystemStorageDriverTestInstance(),
                'read',
                'return only the Json stored at the specified ' .
                'JsonFilePath if the JsonFilesystemStorageQuery ' .
                'specifies a JsonFilePath',
            ),
        );
        $jsonFilePathJsonFilesystemStorageQuery =
            $jsonFilePathQueries[array_rand($jsonFilePathQueries)];
        $expectedQueryResults =
        $this->expectedJsonFilesystemStorageQueryResults(
            $jsonFilePathJsonFilesystemStorageQuery
        );
        $actualQueryResults =
            $this->jsonFilesystemStorageDriverTestInstance()
                 ->read($jsonFilePathJsonFilesystemStorageQuery);
        $this->assertEquals(
            $expectedQueryResults,
            $actualQueryResults,
            $this->testFailedMessage(
                $this->jsonFilesystemStorageDriverTestInstance(),
                'read',
                'return only the Json stored at the specified ' .
                'JsonFilePath if the JsonFilesystemStorageQuery ' .
                'specifies a JsonFilePath',
            ),
        );
    }

    /**
     * Test storedJsonFilePaths() returns an empty
     * JsonFilePathCollection if there is nothing in storage.
     *
     * @return void
     *
     * @covers JsonFilesystemStorageDriver->storedJsonFilePaths()
     *
     */
    public function test_storedJsonFilePaths_returns_an_empty_JsonFilePathCollection_if_there_is_nothing_in_storage(): void
    {
        $jsonFilesystemStorageQuery = new JsonFilesystemStorageQuery(
            id: new Id(),
            name: $this->prefixedRandomName(
                'NameForTeststoredJsonFilePathsReturnsEmptyJsonFilePathCollectionIfThereIsNothingInStorage'
            ),
            owner: new Owner(
                $this->prefixedRandomName(
                    'OwnerForTeststoredJsonFilePathsReturnsEmptyJsonFilePathCollectionIfThereIsNothingInStorage'
                )
            ),
        );
        $this->assertEquals(
            [],
            $this->jsonFilesystemStorageDriverTestInstance()
                 ->storedJsonFilePaths($jsonFilesystemStorageQuery)
                 ->collection(),
            $this->testFailedMessage(
                $this->jsonFilesystemStorageDriverTestInstance(),
                'storedJsonFilePaths',
                'returns an empty JsonFilePathCollection there ' .
                'is nothing in storage',
            ),
        );
    }


    /**
     * Test storedJsonFilePaths() returns an empty array if
     * JsonFilesystemStorageQuery does not produce any matches.
     *
     * @return void
     *
     * @covers JsonFilesystemStorageDriver->storedJsonFilePaths()
     *
     */
    public function test_storedJsonFilePaths_returns_an_empty_JsonFilePathCollection_if_JsonFilesystemStorageQuery_does_not_produce_any_matches(): void
    {
        $randomData = [
            $this->randomClassStringOrObjectInstance(),
            $this->randomChars(),
            rand(PHP_INT_MIN, PHP_INT_MAX),
            floatval(strval(rand(0, 100)) . strval(rand(0, 100))),
        ];
        for(
            $numberOfJsonInstancesWrittenToStorage = 0;
            $numberOfJsonInstancesWrittenToStorage < rand(10, 20);
            $numberOfJsonInstancesWrittenToStorage++
        ) {
            $this->jsonFilesystemStorageDriverTestInstance()->write(
                new JsonInstance($randomData[array_rand($randomData)]),
                $this->expectedJsonFilePath->jsonStorageDirectoryPath(),
                new Location(new Name(new Text($this->randomChars()))),
                new Owner(new Name(new Text($this->randomChars()))),
                $this->prefixedRandomName(
                    'storedJsonFilePathsReturnsEmptyJsonFilePathCollectionIfQueryDoesNotMatch'
                ),
                new Id(),
            );
        }
        $jsonFilesystemStorageQuery = new JsonFilesystemStorageQuery(
            id: new Id(),
            name: $this->prefixedRandomName(
                'NameForTeststoredJsonFilePathsReturnsEmptyJsonFilePathCollectionIfQueryDoesNotMatch'
            ),
            owner: new Owner(
                $this->prefixedRandomName(
                    'OwnerForTeststoredJsonFilePathsReturnsEmptyJsonFilePathCollectionIfQueryDoesNotMatch'
                )
            ),
        );
        $this->assertEquals(
            [],
            $this->jsonFilesystemStorageDriverTestInstance()
                 ->storedJsonFilePaths($jsonFilesystemStorageQuery)->collection(),
            $this->testFailedMessage(
                $this->jsonFilesystemStorageDriverTestInstance(),
                'storedJsonFilePaths',
                'returns an empty JsonFilePathCollection if ' .
                'JsonFilesystemStorageQuery does not produce ' .
                'any matches',
            ),
        );
    }

    /**
     * Test storedJsonFilePaths() returns a JsonFilePathCollection
     * that only contains a single JsonFilePath instance that
     * matches the specified JsonFilePath if the specified
     * JsonFilesystemStorageQuery specifies a JsonFilePath.
     *
     * @return void
     *
     * @covers JsonFilesystemStorageDriver->storedJsonFilePaths()
     *
     */
    public function test_storedJsonFilePaths_returns_a_JsonFilePathCollection_that_only_contains_a_single_JsonFilePath_instance_that_matches_the_specified_JsonFilePath_if_the_specified_JsonFilesystemStorageQuery_specifies_a_JsonFilePath(): void
    {
        $randomData = [
            $this->randomClassStringOrObjectInstance(),
            $this->randomChars(),
            rand(PHP_INT_MIN, PHP_INT_MAX),
            floatval(strval(rand(0, 100)) . strval(rand(0, 100))),
        ];
        /** @var array<int, JsonFilePath> $jsonFilePaths */
        $jsonFilePaths = [];
        for(
            $numberOfJsonInstancesWrittenToStorage = 0;
            $numberOfJsonInstancesWrittenToStorage < rand(10, 20);
            $numberOfJsonInstancesWrittenToStorage++
        ) {
            $jsonInstance = new JsonInstance(
                $randomData[array_rand($randomData)]
            );
            $jsonFilesystemStorageDirectoryPath =
                $this->expectedJsonFilePath->jsonStorageDirectoryPath();
            $location = new Location(
                new Name(new Text($this->randomChars()))
            );
            $container = new Container(
                IntegrationTestUtilities::determineType($jsonInstance)
            );
            $owner = new Owner(
                new Name(new Text($this->randomChars()))
            );
            $name = $this->prefixedRandomName(
                'storedJsonFilePathsOnlyReturnsTheJsonestoredJsonFilePathsFromSpecifiedJsonFilePathIfJsonFilePathIsQueried'
            );
            $id = new Id();
            $this->jsonFilesystemStorageDriverTestInstance()->write(
                $jsonInstance,
                $jsonFilesystemStorageDirectoryPath,
                $location,
                $owner,
                $name,
                $id,
            );
            $jsonFilePaths[] = new JsonFilePathInstance(
                $jsonFilesystemStorageDirectoryPath,
                $location,
                $container,
                $owner,
                $name,
                $id
            );
        }
        $jsonFilesystemStorageQuery = new JsonFilesystemStorageQuery(
            jsonFilePath: $jsonFilePaths[array_rand($jsonFilePaths)]
        );
        $expectedQueryResults =
        $this->expectedStoredJsonFilePathQueryResults(
            $jsonFilesystemStorageQuery
        );
        $actualQueryResults =
            $this->jsonFilesystemStorageDriverTestInstance()
                 ->storedJsonFilePaths($jsonFilesystemStorageQuery);
        $this->assertEquals(
            $expectedQueryResults,
            $actualQueryResults,
            $this->testFailedMessage(
                $this->jsonFilesystemStorageDriverTestInstance(),
                'storedJsonFilePaths',
                'return only the Json stored at the specified ' .
                'JsonFilePath if the JsonFilesystemStorageQuery ' .
                'specifies a JsonFilePath',
            ),
        );
    }

    /**
     * Test storedJsonFilePaths() returns a JsonCollection that
     * contains all of the Json in storage if the
     * JsonFilesystemStorageQuery is empty.
     *
     * @return void
     *
     * @covers JsonFilesystemStorageDriver->storedJsonFilePaths()
     *
     */
    public function test_storedJsonFilePaths_returns_a_JsonCollection_that_contains_all_of_the_Json_in_storage_if_the_JsonFilesystemStorageQuery_is_empty(): void
    {
        $randomData = [
            $this->randomClassStringOrObjectInstance(),
            $this->randomChars(),
            rand(PHP_INT_MIN, PHP_INT_MAX),
            floatval(strval(rand(0, 100)) . strval(rand(0, 100))),
        ];
        for(
            $numberOfJsonInstancesWrittenToStorage = 0;
            $numberOfJsonInstancesWrittenToStorage < rand(10, 20);
            $numberOfJsonInstancesWrittenToStorage++
        ) {
            $this->jsonFilesystemStorageDriverTestInstance()->write(
                new JsonInstance($randomData[array_rand($randomData)]),
                $this->expectedJsonFilePath->jsonStorageDirectoryPath(),
                new Location(new Name(new Text($this->randomChars()))),
                new Owner(new Name(new Text($this->randomChars()))),
                $this->prefixedRandomName(
                    'storedJsonFilePathsReturnsJsonCollectionContaingAllStoredJsonIfQueryIsEmpty'
                ),
                new Id(),
            );
        }
        $jsonFilesystemStorageQuery = new JsonFilesystemStorageQuery();
        $actualQueryResults = $this->jsonFilesystemStorageDriverTestInstance()
                             ->storedJsonFilePaths($jsonFilesystemStorageQuery);
        $this->assertEquals(
            $this->expectedStoredJsonFilePathQueryResults(
                $jsonFilesystemStorageQuery
            ),
            $actualQueryResults,
            $this->testFailedMessage(
                $this->jsonFilesystemStorageDriverTestInstance(),
                'storedJsonFilePaths',
                'return a JsonFilePathCollection that contains all ' .
                'of the JsonFilePaths that exist in storage if ' .
                'JsonFilesystemStorageQuery is empty.',
            ),
        );
        $this->assertEquals(
            $numberOfJsonInstancesWrittenToStorage,
            count($actualQueryResults->collection()),
            $this->testFailedMessage(
                $this->jsonFilesystemStorageDriverTestInstance(),
                'storedJsonFilePaths',
                'return a JsonFilePathCollection that contains all ' .
                'of the JsonFilePaths that exist in storage if ' .
                'JsonFilesystemStorageQuery is empty.' .
                'Expected ' .
                $numberOfJsonInstancesWrittenToStorage .
                ' items in the returned JsonCollection ' .
                'but there are only' .
                count($actualQueryResults->collection()) .
                ' items in the returned JsonCollection',
            ),
        );
    }

    /**
     * Test storedJsonFilePaths() returns a JsonFilePathCollection
     * that contains the expected JsonFilePath intances based on a
     * JsonFilesystemStorageQuery.
     *
     * @return void
     *
     * @covers JsonFilesystemStorageDriver->storedJsonFilePaths()
     *
     */
    public function test_storedJsonFilePaths_returns_a_JsonFilePathCollection_that_contains_the_expected_JsonFilePath_intances_based_on_a_JsonFilesystemStorageQuery(): void
    {
        $randomData = [
            $this->randomClassStringOrObjectInstance(),
            $this->randomChars(),
            rand(PHP_INT_MIN, PHP_INT_MAX),
            floatval(strval(rand(0, 100)) . strval(rand(0, 100))),
        ];
        /** @var array<int, JsonFilesystemStorageQuery> $completeQueries */
        $completeQueries = [];
        /** @var array<int, JsonFilesystemStorageQuery> $incompleteQueries  */
        $incompleteQueries = [];
        /** @var array<int, JsonFilesystemStorageQuery> $jsonFilePathQueries */
        $jsonFilePathQueries = [];
        for(
            $numberOfJsonInstancesWrittenToStorage = 0;
            $numberOfJsonInstancesWrittenToStorage < rand(10, 20);
            $numberOfJsonInstancesWrittenToStorage++
        ) {
            $jsonInstance = new JsonInstance(
                $randomData[array_rand($randomData)]
            );
            $jsonFilesystemStorageDirectoryPath =
                $this->expectedJsonFilePath->jsonStorageDirectoryPath();
            $location = new Location(
                new Name(new Text($this->randomChars()))
            );
            $container = new Container(
                IntegrationTestUtilities::determineType($jsonInstance)
            );
            $owner = new Owner(
                new Name(new Text($this->randomChars()))
            );
            $name = $this->prefixedRandomName(
                'storedJsonFilePathsOnlyReturnsTheJsonestoredJsonFilePathsFromSpecifiedJsonFilePathIfJsonFilePathIsQueried'
            );
            $id = new Id();
            $this->jsonFilesystemStorageDriverTestInstance()->write(
                $jsonInstance,
                $jsonFilesystemStorageDirectoryPath,
                $location,
                $owner,
                $name,
                $id,
            );
            $completeQueries[] = new JsonFilesystemStorageQuery(
                jsonStorageDirectoryPath: $jsonFilesystemStorageDirectoryPath,
                location: $location,
                container: $container,
                owner: $owner,
                name: $name,
                id: $id,
            );
            $incompleteQueries[] = new JsonFilesystemStorageQuery(
                jsonStorageDirectoryPath: (
                    rand(0, 1) === 0
                    ? $jsonFilesystemStorageDirectoryPath
                    : null
                ),
                location: (rand(0, 1) === 0 ? $location : null),
                container: (rand(0, 1) === 0 ? $container : null),
                owner: (rand(0, 1) === 0 ? $owner : null),
                name: (rand(0, 1) === 0 ? $name : null),
                id: (rand(0, 1) === 0 ? $id : null),
            );
            $jsonFilePath = new JsonFilePathInstance(
                $jsonFilesystemStorageDirectoryPath,
                $location,
                $container,
                $owner,
                $name,
                $id
            );
            $jsonFilePathQueries[] = new JsonFilesystemStorageQuery(
                jsonFilePath: $jsonFilePath,
            );
        }
        $completeJsonFilesystemStorageQuery =
            $completeQueries[array_rand($completeQueries)];
        $expectedQueryResults =
        $this->expectedStoredJsonFilePathQueryResults(
            $completeJsonFilesystemStorageQuery
        );
        $actualQueryResults =
            $this->jsonFilesystemStorageDriverTestInstance()
                 ->storedJsonFilePaths(
                     $completeJsonFilesystemStorageQuery
                 );
        $this->assertEquals(
            $expectedQueryResults,
            $actualQueryResults,
            $this->testFailedMessage(
                $this->jsonFilesystemStorageDriverTestInstance(),
                'storedJsonFilePaths',
                'return only the Json stored at the specified ' .
                'JsonFilePath if the JsonFilesystemStorageQuery ' .
                'specifies a JsonFilePath',
            ),
        );
        $incompleteJsonFilesystemStorageQuery =
            $incompleteQueries[array_rand($incompleteQueries)];
        $expectedQueryResults =
        $this->expectedStoredJsonFilePathQueryResults(
            $incompleteJsonFilesystemStorageQuery
        );
        $actualQueryResults =
            $this->jsonFilesystemStorageDriverTestInstance()
                 ->storedJsonFilePaths(
                     $incompleteJsonFilesystemStorageQuery
                 );
        $this->assertEquals(
            $expectedQueryResults,
            $actualQueryResults,
            $this->testFailedMessage(
                $this->jsonFilesystemStorageDriverTestInstance(),
                'storedJsonFilePaths',
                'return only the Json stored at the specified ' .
                'JsonFilePath if the JsonFilesystemStorageQuery ' .
                'specifies a JsonFilePath',
            ),
        );
        $jsonFilePathJsonFilesystemStorageQuery =
            $jsonFilePathQueries[array_rand($jsonFilePathQueries)];
        $expectedQueryResults =
        $this->expectedStoredJsonFilePathQueryResults(
            $jsonFilePathJsonFilesystemStorageQuery
        );
        $actualQueryResults =
            $this->jsonFilesystemStorageDriverTestInstance()
                 ->storedJsonFilePaths(
                     $jsonFilePathJsonFilesystemStorageQuery
                 );
        $this->assertEquals(
            $expectedQueryResults,
            $actualQueryResults,
            $this->testFailedMessage(
                $this->jsonFilesystemStorageDriverTestInstance(),
                'storedJsonFilePaths',
                'return only the Json stored at the specified ' .
                'JsonFilePath if the JsonFilesystemStorageQuery ' .
                'specifies a JsonFilePath',
            ),
        );
    }

    /**
     * Test delete() returns false if there is nothing in storage.
     *
     * @return void
     *
     * @covers JsonFilesystemStorageDriver->delete()
     *
     */
    public function test_delete_returns_false_if_there_is_nothing_in_storage(): void
    {
        $jsonFilesystemStorageQuery = new JsonFilesystemStorageQuery();
        $this->assertFalse(
            $this->jsonFilesystemStorageDriverTestInstance()
                 ->delete($jsonFilesystemStorageQuery),
            $this->testFailedMessage(
                $this->jsonFilesystemStorageDriverTestInstance(),
                'delete',
                'returns false if there is nothing in storage',
            ),
        );
    }

    /**
     * Test delete() does not delete anything if JsonFilesystemStorageQuery does not
     * produce any matches.
     *
     * @return void
     *
     * @covers JsonFilesystemStorageDriver->delete()
     *
     */
    public function test_delete_does_not_delete_anything_if_JsonFilesystemStorageQuery_does_not_produce_any_matches(): void
    {
        $randomData = [
            $this->randomClassStringOrObjectInstance(),
            $this->randomChars(),
            rand(PHP_INT_MIN, PHP_INT_MAX),
            floatval(strval(rand(0, 100)) . strval(rand(0, 100))),
        ];
        for(
            $numberOfJsonInstancesWrittenToStorage = 0;
            $numberOfJsonInstancesWrittenToStorage < rand(10, 20);
            $numberOfJsonInstancesWrittenToStorage++
        ) {
            $this->jsonFilesystemStorageDriverTestInstance()->write(
                new JsonInstance($randomData[array_rand($randomData)]),
                $this->expectedJsonFilePath->jsonStorageDirectoryPath(),
                new Location(new Name(new Text($this->randomChars()))),
                new Owner(new Name(new Text($this->randomChars()))),
                $this->prefixedRandomName(
                    'DeleteDoesNotDeleteAnythingIfQueryDoesNotProduceAnyMatches'
                ),
                new Id(),
            );
        }
        $jsonFilesystemStorageQuery = new JsonFilesystemStorageQuery(
            id: new Id(),
            name: new Name(new Text($this->randomChars())),
        );
        $numberOfStoredJsonFilesBeforeDelete = count(
            $this->jsonFilesystemStorageDriverTestInstance()
                 ->read($jsonFilesystemStorageQuery)
                 ->collection()
        );
        $deleteStatus =
            $this->jsonFilesystemStorageDriverTestInstance()
                 ->delete($jsonFilesystemStorageQuery);
        $numberOfStoredJsonFilesAfterDelete = count(
            $this->jsonFilesystemStorageDriverTestInstance()
                 ->read($jsonFilesystemStorageQuery)
                 ->collection()
        );
        $this->assertEquals(
            $numberOfStoredJsonFilesBeforeDelete,
            $numberOfStoredJsonFilesAfterDelete,
            $this->testFailedMessage(
                $this->jsonFilesystemStorageDriverTestInstance(),
                'delete',
                'does not delete anything if ' .
                'JsonFilesystemStorageQuery does not produce any ' .
                'matches',
            ),
        );
        $this->assertFalse(
            $deleteStatus,
            $this->testFailedMessage(
                $this->jsonFilesystemStorageDriverTestInstance(),
                'delete',
                'returns false if JsonFilesystemStorageQuery does ' .
                'not produce any matches',
            ),
        );
    }

    /**
     * Test delete() only deletes a the json file at the specified
     * JsonFilePath if the specified JsonFilesystemStorageQuery
     * specifies a JsonFilePath.
     *
     * @return void
     *
     * @covers JsonFilesystemStorageDriver->delete()
     *
     */
    public function test_delete_only_deletes_a_the_json_file_at_the_specified_JsonFilePath_if_the_specified_JsonFilesystemStorageQuery_specifies_a_JsonFilePath(): void
    {
        $randomData = [
            $this->randomClassStringOrObjectInstance(),
            $this->randomChars(),
            rand(PHP_INT_MIN, PHP_INT_MAX),
            floatval(strval(rand(0, 100)) . strval(rand(0, 100))),
        ];
        /** @var array<int, JsonFilePath> $jsonFilePaths */
        $jsonFilePaths = [];
        for(
            $numberOfJsonInstancesWrittenToStorage = 0;
            $numberOfJsonInstancesWrittenToStorage < rand(10, 20);
            $numberOfJsonInstancesWrittenToStorage++
        ) {
            $jsonInstance = new JsonInstance(
                $randomData[array_rand($randomData)]
            );
            $jsonFilesystemStorageDirectoryPath =
                $this->expectedJsonFilePath
                     ->jsonStorageDirectoryPath();
            $location = new Location(
                new Name(new Text($this->randomChars()))
            );
            $container = new Container(
                IntegrationTestUtilities::determineType($jsonInstance)
            );
            $owner = new Owner(
                new Name(new Text($this->randomChars()))
            );
            $name = $this->prefixedRandomName(
                'deleteOnlyReturnsTheJsonedeleteFromSpecifiedJsonFilePathIfJsonFilePathIsQueried'
            );
            $id = new Id();
            $this->jsonFilesystemStorageDriverTestInstance()->write(
                $jsonInstance,
                $jsonFilesystemStorageDirectoryPath,
                $location,
                $owner,
                $name,
                $id,
            );
            $jsonFilePaths[] = new JsonFilePathInstance(
                $jsonFilesystemStorageDirectoryPath,
                $location,
                $container,
                $owner,
                $name,
                $id
            );
        }
        $jsonFilePath = $jsonFilePaths[array_rand($jsonFilePaths)];
        $jsonFilesystemStorageQuery = new JsonFilesystemStorageQuery(
            jsonFilePath: $jsonFilePath
        );
        $resultsBeforeDelete = count(
            $this->jsonFilesystemStorageDriverTestInstance()
            ->read($jsonFilesystemStorageQuery)
            ->collection()
        );
        $deleteStatus = $this->jsonFilesystemStorageDriverTestInstance()
                             ->delete($jsonFilesystemStorageQuery);
        $resultsAfterDelete = count(
            $this->jsonFilesystemStorageDriverTestInstance()
                 ->read($jsonFilesystemStorageQuery)
                 ->collection()
        );
        $this->assertLessThan(
            $resultsBeforeDelete,
            $resultsAfterDelete,
            $this->testFailedMessage(
                $this->jsonFilesystemStorageDriverTestInstance(),
                'delete',
                'test delete() only deletes a the json file at ' .
                'the specified JsonFilePath if the specified ' .
                'JsonFilesystemStorageQuery specifies a JsonFilePath',
            ),
        );
        $this->assertTrue(
            $deleteStatus,
            $this->testFailedMessage(
                $this->jsonFilesystemStorageDriverTestInstance(),
                'delete',
                'test delete() only deletes a the json file at ' .
                'the specified JsonFilePath if the specified ' .
                'JsonFilesystemStorageQuery specifies a JsonFilePath',
            ),
        );
    }

    /**
     * Test delete() deletes all the json files in storage if the
     * specified JsonFilesystemStorageQuery is empty.

     * @return void
     *
     * @covers JsonFilesystemStorageDriver->delete()
     *
     */
    public function test_delete_deletes_all_the_json_files_in_storage_if_the_specified_JsonFilesystemStorageQuery_is_empty(): void
    {
        $randomData = [
            $this->randomClassStringOrObjectInstance(),
            $this->randomChars(),
            rand(PHP_INT_MIN, PHP_INT_MAX),
            floatval(strval(rand(0, 100)) . strval(rand(0, 100))),
        ];
        for(
            $numberOfJsonInstancesWrittenToStorage = 0;
            $numberOfJsonInstancesWrittenToStorage < rand(10, 20);
            $numberOfJsonInstancesWrittenToStorage++
        ) {
            $jsonInstance = new JsonInstance(
                $randomData[array_rand($randomData)]
            );
            $jsonFilesystemStorageDirectoryPath =
                $this->expectedJsonFilePath
                     ->jsonStorageDirectoryPath();
            $location = new Location(
                new Name(new Text($this->randomChars()))
            );
            $container = new Container(
                IntegrationTestUtilities::determineType($jsonInstance)
            );
            $owner = new Owner(
                new Name(new Text($this->randomChars()))
            );
            $name = $this->prefixedRandomName(
                'deleteOnlyReturnsTheJsonedeleteFromSpecifiedJsonFilePathIfJsonFilePathIsQueried'
            );
            $id = new Id();
            $this->jsonFilesystemStorageDriverTestInstance()->write(
                $jsonInstance,
                $jsonFilesystemStorageDirectoryPath,
                $location,
                $owner,
                $name,
                $id,
            );
        }
        $jsonFilesystemStorageQuery = new JsonFilesystemStorageQuery();
        $resultsBeforeDelete = count(
            $this->jsonFilesystemStorageDriverTestInstance()
                 ->read($jsonFilesystemStorageQuery)
                 ->collection()
        );
        $deleteStatus = $this->jsonFilesystemStorageDriverTestInstance()
                             ->delete($jsonFilesystemStorageQuery);
        $resultsAfterDelete = count(
            $this->jsonFilesystemStorageDriverTestInstance()
                 ->read($jsonFilesystemStorageQuery)
                 ->collection()
            );
        $this->assertLessThan(
            $resultsBeforeDelete,
            $resultsAfterDelete,
            $this->testFailedMessage(
                $this->jsonFilesystemStorageDriverTestInstance(),
                'delete',
                'test delete() deletes all the json files in storage ' .
                'if the specified JsonFilesystemStorageQuery is ' .
                'empty',
            ),
        );
        $this->assertTrue(
            $deleteStatus,
            $this->testFailedMessage(
                $this->jsonFilesystemStorageDriverTestInstance(),
                'delete',
                'test delete() deletes all the json files in storage ' .
                'if the specified JsonFilesystemStorageQuery is empty',
            ),
        );
    }

    /**
     * Test delete deletes the appropriate json files from storage
     * based on a JsonFilesystemStorageQuery.
     *
     * @return void
     *
     * @covers JsonFilesystemStorageDriver->delete()
     *
     */
    public function test_delete_deletes_the_appropriate_json_files_from_storage_based_on_a_JsonFilesystemStorageQuery(): void
    {
        $randomData = [
            $this->randomClassStringOrObjectInstance(),
            $this->randomChars(),
            rand(PHP_INT_MIN, PHP_INT_MAX),
            floatval(strval(rand(0, 100)) . strval(rand(0, 100))),
        ];
        /** @var array<int, JsonFilesystemStorageQuery> $completeQueries */
        $completeQueries = [];
        /** @var array<int, JsonFilesystemStorageQuery> $incompleteQueries  */
        $incompleteQueries = [];
        /** @var array<int, JsonFilesystemStorageQuery> $jsonFilePathQueries */
        $jsonFilePathQueries = [];
        for(
            $numberOfJsonInstancesWrittenToStorage = 0;
            $numberOfJsonInstancesWrittenToStorage < rand(10, 20);
            $numberOfJsonInstancesWrittenToStorage++
        ) {
            $jsonInstance = new JsonInstance(
                $randomData[array_rand($randomData)]
            );
            $jsonFilesystemStorageDirectoryPath =
                $this->expectedJsonFilePath
                     ->jsonStorageDirectoryPath();
            $location = new Location(
                new Name(new Text($this->randomChars()))
            );
            $container = new Container(
                IntegrationTestUtilities::determineType($jsonInstance)
            );
            $owner = new Owner(
                new Name(new Text($this->randomChars()))
            );
            $name = $this->prefixedRandomName(
                'deleteOnlyReturnsTheJsonedeleteFromSpecifiedJsonFilePathIfJsonFilePathIsQueried'
            );
            $id = new Id();
            $this->jsonFilesystemStorageDriverTestInstance()->write(
                $jsonInstance,
                $jsonFilesystemStorageDirectoryPath,
                $location,
                $owner,
                $name,
                $id,
            );
            $completeQueries[] = new JsonFilesystemStorageQuery(
                jsonStorageDirectoryPath: $jsonFilesystemStorageDirectoryPath,
                location: $location,
                container: $container,
                owner: $owner,
                name: $name,
                id: $id,
            );
            $incompleteQueries[] = new JsonFilesystemStorageQuery(
                jsonStorageDirectoryPath: (
                    rand(0, 1) === 0
                    ? $jsonFilesystemStorageDirectoryPath
                    : null
                ),
                location: (rand(0, 1) === 0 ? $location : null),
                container: (rand(0, 1) === 0 ? $container : null),
                owner: (rand(0, 1) === 0 ? $owner : null),
                name: (rand(0, 1) === 0 ? $name : null),
                id: (rand(0, 1) === 0 ? $id : null),
            );
            $jsonFilePath = new JsonFilePathInstance(
                $jsonFilesystemStorageDirectoryPath,
                $location,
                $container,
                $owner,
                $name,
                $id
            );
            $jsonFilePathQueries[] = new JsonFilesystemStorageQuery(
                jsonFilePath: $jsonFilePath,
            );
        }
        $completeJsonFilesystemStorageQuery =
            $completeQueries[array_rand($completeQueries)];
        $this->jsonFilesystemStorageDriverTestInstance()
             ->delete($completeJsonFilesystemStorageQuery);
        $this->assertEmpty(
            $this->jsonFilesystemStorageDriverTestInstance()
                 ->read($completeJsonFilesystemStorageQuery)
                 ->collection(),
            $this->testFailedMessage(
                $this->jsonFilesystemStorageDriverTestInstance(),
                'delete',
                'deletes the expected json files',
            ),
        );
        $incompleteJsonFilesystemStorageQuery =
            $incompleteQueries[array_rand($incompleteQueries)];
        $this->jsonFilesystemStorageDriverTestInstance()
             ->delete($incompleteJsonFilesystemStorageQuery);
        $this->assertEmpty(
            $this->jsonFilesystemStorageDriverTestInstance()
                 ->read($incompleteJsonFilesystemStorageQuery)
                 ->collection(),
            $this->testFailedMessage(
                $this->jsonFilesystemStorageDriverTestInstance(),
                'delete',
                'deletes the expected json files',
            ),
        );
        $jsonFilePathJsonFilesystemStorageQuery =
            $jsonFilePathQueries[array_rand($jsonFilePathQueries)];
        $this->jsonFilesystemStorageDriverTestInstance()
             ->delete($jsonFilePathJsonFilesystemStorageQuery);
        $this->assertEmpty(
            $this->jsonFilesystemStorageDriverTestInstance()
                 ->read($jsonFilePathJsonFilesystemStorageQuery)
                 ->collection(),
            $this->testFailedMessage(
                $this->jsonFilesystemStorageDriverTestInstance(),
                'delete',
                'deletes the expected json files',
            ),
        );
    }

    abstract protected function randomChars(): string;
    abstract protected function randomClassStringOrObjectInstance(): string|object;
    abstract protected function testFailedMessage(object $object, string $method, string $message): string;
    abstract protected static function assertEmpty(mixed $dataHolder, string $message = ''): void;
    abstract protected static function assertEquals(mixed $expected, mixed $actual, string $message = ''): void;
    abstract protected static function assertFalse(bool $condition, string $message = ''): void;
    abstract protected static function assertLessThan(int $expected, int $actual, string $message = ''): void;
    abstract protected static function assertTrue(bool $condition, string $message = ''): void;

}

