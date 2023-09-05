<?php

namespace Darling\PHPJsonStorageUtilities\tests\interfaces\filesystem\storage\drivers;

use \Darling\PHPJsonStorageUtilities\enumerations\Type;
use \Darling\PHPJsonStorageUtilities\interfaces\filesystem\paths\JsonFilePath;
use \Darling\PHPJsonStorageUtilities\interfaces\filesystem\storage\drivers\JsonFilesystemStorageDriver;
use \Darling\PHPJsonUtilities\classes\decoders\JsonDecoder as JsonDecoderInstance;
use \Darling\PHPJsonUtilities\interfaces\decoders\JsonDecoder;
use \Darling\PHPJsonUtilities\interfaces\encoded\data\Json;
use \Darling\PHPTextTypes\classes\strings\ClassString as ClassStringInstance;
use \Darling\PHPTextTypes\interfaces\strings\ClassString;

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
     */
    private $expectedJsonFilePath;

    /**
     * @var Json $expectedJson
     */
    private $expectedJson;

    /**
     * Set up an instance of a JsonFilesystemStorageDriver implementation to test.
     *
     * This method must also set the JsonFilesystemStorageDriver implementation instance
     * to be tested via the setJsonFilesystemStorageDriverTestInstance() method.
     *
     * This method may also be used to perform any additional setup
     * required by the implementation being tested.
     *
     * @return void
     *
     * @example
     *
     * ```
     * protected function setUp(): void
     * {
     *     $this->setJsonFilesystemStorageDriverTestInstance(
     *         new \Darling\PHPJsonStorageUtilities\classes\filesystem\storage\drivers\JsonFilesystemStorageDriver()
     *     );
     * }
     *
     * ```
     *
     */
    abstract protected function setUp(): void;

    /**
     * Return the JsonFilesystemStorageDriver implementation instance to test.
     *
     * @return JsonFilesystemStorageDriver
     *
     */
    protected function jsonFilesystemStorageDriverTestInstance(): JsonFilesystemStorageDriver
    {
        return $this->jsonFilesystemStorageDriver;
    }

    /**
     * Set the JsonFilesystemStorageDriver implementation instance to test.
     *
     * @param JsonFilesystemStorageDriver $jsonFilesystemStorageDriverTestInstance
     *                              An instance of an
     *                              implementation of
     *                              the JsonFilesystemStorageDriver
     *                              interface to test.
     *
     * @return void
     *
     */
    protected function setJsonFilesystemStorageDriverTestInstance(
        JsonFilesystemStorageDriver $jsonFilesystemStorageDriverTestInstance
    ): void
    {
        $this->jsonFilesystemStorageDriver = $jsonFilesystemStorageDriverTestInstance;
    }

    /**
     * Set the JsonFilePath that the JsonFilesystemStorageDriver
     * instance being tested's write method is expected to write to.
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

    protected function determineType(Json $json): Type|ClassString
    {
        $jsonDecoder = new JsonDecoderInstance();
        $data = $jsonDecoder->decode($json);
        if(is_object($data)) {
            return new ClassStringInstance($data);
        }
        return match(gettype($data)) {
            Type::Array->value => Type::Array,
            Type::Bool->value => Type::Bool,
            Type::Float->value => Type::Float,
            Type::Int->value => Type::Int,
            Type::Null->value => Type::Null,
            Type::String->value => Type::String,
            Type::Object->value => Type::Object,
            Type::Resource->value => Type::Resource,
            Type::ResourceClosed->value => Type::ResourceClosed,
            Type::UnknownType->value => Type::UnknownType,
        };
    }

    /**
     * Return the JsonFilePath that the JsonFilesystemStorageDriver
     * instance being tested's write method is expected to write to.
     *
     * @return JsonFilePath
     *
     */
    protected function expectedJsonFilePath(): JsonFilePath
    {
        return $this->expectedJsonFilePath;
    }

    protected function setExpectedJson(Json $json): void
    {
        $this->expectedJson = $json;
    }

    protected function expectedJson(): Json
    {
        return $this->expectedJson;
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
     * Test write writes to the expected json file path.
     *
     * @return void
     *
     * @covers JsonFilesystemStorageDriver->write()
     *
     */
    public function test_write_writes_to_the_expected_json_file_path(): void
    {
        $this->jsonFilesystemStorageDriverTestInstance()->write(
            $this->expectedJson(),
            $this->expectedJsonFilePath()->jsonStorageDirectoryPath(),
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
    }

    /**
     * Test write writes the expected json to the expected json file path.
     *
     * @return void
     *
     * @covers JsonFilesystemStorageDriver->write()
     *
     */
    public function test_write_writes_the_expected_json_to_the_expected_json_file_path(): void
    {
        $this->jsonFilesystemStorageDriverTestInstance()->write(
            $this->expectedJson(),
            $this->expectedJsonFilePath()->jsonStorageDirectoryPath(),
            $this->expectedJsonFilePath->location(),
            $this->expectedJsonFilePath->owner(),
            $this->expectedJsonFilePath->name(),
            $this->expectedJsonFilePath()->id(),
        );
        $this->assertEquals(
            file_get_contents($this->expectedJsonFilePath()->__toString()),
            $this->expectedJson()->__toString(),
            $this->testFailedMessage(
                $this->jsonFilesystemStorageDriverTestInstance(),
                'write',
                'writes the expected Json to the expected JsonFilePath',
            ),
        );
    }

}

