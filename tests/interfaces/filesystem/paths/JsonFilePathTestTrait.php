<?php

namespace Darling\PHPJsonStorageUtilities\tests\interfaces\filesystem\paths;

use \Darling\PHPJsonStorageUtilities\interfaces\filesystem\paths\JsonFilePath;
use \Darling\PHPJsonStorageUtilities\interfaces\filesystem\paths\JsonStorageDirectoryPath;
use \Darling\PHPJsonStorageUtilities\interfaces\named\identifiers\Container;
use \Darling\PHPJsonStorageUtilities\interfaces\named\identifiers\Location;
use \Darling\PHPJsonStorageUtilities\interfaces\named\identifiers\Owner;
use \Darling\PHPTextTypes\interfaces\strings\Id;
use \Darling\PHPTextTypes\interfaces\strings\Name;

/**
 * The JsonFilePathTestTrait defines common tests for
 * implementations of the JsonFilePath interface.
 *
 * @see JsonFilePath
 *
 */
trait JsonFilePathTestTrait
{

    /**
     * @var JsonFilePath $jsonFilePath An instance of a JsonFilePath
     *                                 implementation to test.
     */
    protected JsonFilePath $jsonFilePath;

    /**
     * @var JsonStorageDirectoryPath $expectedJsonStorageDirectoryPath
     *                               The JsonStorageDirectoryPath
     *                               instance that is expected to be
     *                               returned by the JsonFilePath to
     *                               test's jsonStorageDirectoryPath()
     *                               method.
     */
    private JsonStorageDirectoryPath $expectedJsonStorageDirectoryPath;

    /**
     * @var Location $expectedLocation The Location instance that is
     *                                 expected to be returned by the
     *                                 JsonFilePath to test's
     *                                 location() method.
     */
    private Location $expectedLocation;

    /**
     * @var Container $expectedContainer The Container instance that
     *                                   is expected to be returned by
     *                                   the JsonFilePath to test's
     *                                   container() method.
     */
    private Container $expectedContainer;

    /**
     * @var Owner $expectedOwner The Owner instance that is expected
     *                           to be returned by the JsonFilePath
     *                           to test's owner() method.
     */
    private Owner $expectedOwner;

    /**
     * @var Name $expectedName The Name instance that is expected to
     *                         be returned by the JsonFilePath to
     *                         test's name() method.
     */
    private Name $expectedName;

    /**
     * @var Id $expectedId The Id instance that is expected to
     *                         be returned by the JsonFilePath to
     *                         test's id() method.
     */
    private Id $expectedId;

    /**
     * Set up an instance of a JsonFilePath implementation to test.
     *
     * This method must also set the JsonFilePath implementation instance
     * to be tested via the setJsonFilePathTestInstance() method.
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
     *     $this->setJsonFilePathTestInstance(
     *         new \Darling\PHPJsonStorageUtilities\classes\filesystem\paths\JsonFilePath()
     *     );
     * }
     *
     * ```
     *
     */
    abstract protected function setUp(): void;

    /**
     * Set the JsonFilePath implementation instance to test.
     *
     * @param JsonFilePath $jsonFilePathTestInstance An instance of an
     *                                               implementation of
     *                                               the JsonFilePath
     *                                               interface to test.
     *
     * @return void
     *
     */
    protected function setJsonFilePathTestInstance(
        JsonFilePath $jsonFilePathTestInstance
    ): void
    {
        $this->jsonFilePath = $jsonFilePathTestInstance;
    }

    /**
     * Return the JsonFilePath implementation instance to test.
     *
     * @return JsonFilePath
     *
     */
    protected function jsonFilePathTestInstance(): JsonFilePath
    {
        return $this->jsonFilePath;
    }

    /**
     * Set the JsonStorageDirectoryPath instance that is
     * expected to be returned by the JsonFilePath to test's
     * jsonStorageDiectoryPath() method.
     *
     * @return void
     *
     */
    protected function setExpectedJsonStorageDirectoryPath(JsonStorageDirectoryPath $jsonStorageDirectoryPath): void
    {
        $this->expectedJsonStorageDirectoryPath = $jsonStorageDirectoryPath;
    }

    /**
     * Return the JsonStorageDirectoryPath instance that is
     * expected to be returned by the JsonFilePath to test's
     * jsonStorageDirectoryPath() method.
     *
     * @return JsonStorageDirectoryPath
     *
     */
    protected function expectedJsonStorageDirectoryPath(): JsonStorageDirectoryPath
    {
        return $this->expectedJsonStorageDirectoryPath;
    }

    /**
     * Set the location instance that is expected to be returned by
     * the JsonFilePath to test's location() method.
     *
     * @return void
     *
     */
    protected function setExpectedLocation(Location $location): void
    {
        $this->expectedLocation = $location;
    }

    /**
     * Return the location instance that is expected to be returned
     * by the JsonFilePath to test's location() method.
     *
     * @return Location
     *
     */
    protected function expectedLocation(): Location
    {
        return $this->expectedLocation;
    }

    /**
     * Set the Container instance that is expected to be returned by
     * the JsonFilePath to test's container() method.
     *
     * @return void
     *
     */
    protected function setExpectedContainer(Container $container): void
    {
        $this->expectedContainer = $container;
    }

    /**
     * Return the Container instance that is expected to be returned
     * by the JsonFilePath to test's container() method.
     *
     * @return Container
     *
     */
    protected function expectedContainer(): Container
    {
        return $this->expectedContainer;
    }

    /**
     * Set the Owner instance that is expected to be returned by
     * the JsonFilePath to test's owner() method.
     *
     * @return void
     *
     */
    protected function setExpectedOwner(Owner $owner): void
    {
        $this->expectedOwner = $owner;
    }

    /**
     * Return the Owner instance that is expected to be returned
     * by the JsonFilePath to test's owner() method.
     *
     * @return Owner
     *
     */
    protected function expectedOwner(): Owner
    {
        return $this->expectedOwner;
    }

    /**
     * Set the Name instance that is expected to be returned by
     * the JsonFilePath to test's name() method.
     *
     * @return void
     *
     */
    protected function setExpectedName(Name $name): void
    {
        $this->expectedName = $name;
    }

    /**
     * Return the Name instance that is expected to be returned
     * by the JsonFilePath to test's name() method.
     *
     * @return Name
     *
     */
    protected function expectedName(): Name
    {
        return $this->expectedName;
    }

    /**
     * Set the Id instance that is expected to be returned by
     * the JsonFilePath to test's id() method.
     *
     * @return void
     *
     */
    protected function setExpectedId(Id $id): void
    {
        $this->expectedId = $id;
    }

    /**
     * Return the Id instance that is expected to be returned
     * by the JsonFilePath to test's id() method.
     *
     * @return Id
     *
     */
    protected function expectedId(): Id
    {
        return $this->expectedId;
    }

    private function expectedJsonFilePath(): string
    {
        return $this->expectedJsonStorageDirectoryPath()->__toString() .
            DIRECTORY_SEPARATOR .
            $this->expectedLocation()->__toString() .
            DIRECTORY_SEPARATOR .
            $this->expectedContainer()->__toString() .
            DIRECTORY_SEPARATOR .
            $this->expectedOwner()->__toString() .
            DIRECTORY_SEPARATOR .
            $this->expectedName()->__toString() .
            DIRECTORY_SEPARATOR .
            $this->shardId($this->expectedId());
    }

    private function shardId(Id $id): string
    {
        $index = rand(2, 3);
        $parentDir = substr($id->__toString(), 0, $index);
        $subDir = substr($id->__toString(), $index);
        return $parentDir . DIRECTORY_SEPARATOR . $subDir . '.json';
    }

    /**
     * Test that the jsonStorageDirectoryPath() method returns the
     * expected JsonStorageDiectoryPath.
     *
     * @return void
     *
     * @covers JsonFilePath->jsonStorageDirectoryPath()
     */
    public function test_jsonStorageDirectoryPath_returns_the_expected_JsonStorageDiectoryPath(): void
    {
        $this->assertEquals(
            $this->expectedJsonStorageDirectoryPath(),
            $this->jsonFilePathTestInstance()->jsonStorageDirectoryPath(),
            $this->testFailedMessage(
                $this->jsonFilePathTestInstance(),
                'jsonStorageDirectoryPath',
                'return the expected JsonStorageDirectoryPath'
            )
        );
    }

    /**
     * Test that the location() method returns the expected Location.
     *
     * @return void
     *
     * @covers JsonFilePath->location()
     */
    public function test_location_returns_the_expected_Location(): void
    {
        $this->assertEquals(
            $this->expectedLocation(),
            $this->jsonFilePathTestInstance()->location(),
            $this->testFailedMessage(
                $this->jsonFilePathTestInstance(),
                'location',
                'return the expected Location'
            )
        );
    }

    /**
     * Test that the container() method returns the expected Container.
     *
     * @return void
     *
     * @covers JsonFilePath->container()
     */
    public function test_container_returns_the_expected_Container(): void
    {
        $this->assertEquals(
            $this->expectedContainer(),
            $this->jsonFilePathTestInstance()->container(),
            $this->testFailedMessage(
                $this->jsonFilePathTestInstance(),
                'container',
                'return the expected Container'
            )
        );
    }

    /**
     * Test that the owner() method returns the expected Owner.
     *
     * @return void
     *
     * @covers JsonFilePath->owner()
     */
    public function test_owner_returns_the_expected_Owner(): void
    {
        $this->assertEquals(
            $this->expectedOwner(),
            $this->jsonFilePathTestInstance()->owner(),
            $this->testFailedMessage(
                $this->jsonFilePathTestInstance(),
                'owner',
                'return the expected Owner'
            )
        );
    }

    /**
     * Test that the name() method returns the expected Name.
     *
     * @return void
     *
     * @covers JsonFilePath->name()
     */
    public function test_name_returns_the_expected_Name(): void
    {
        $this->assertEquals(
            $this->expectedName(),
            $this->jsonFilePathTestInstance()->name(),
            $this->testFailedMessage(
                $this->jsonFilePathTestInstance(),
                'name',
                'return the expected Name'
            )
        );
    }

    /**
     * Test that the id() method returns the expected Id.
     *
     * @return void
     *
     * @covers JsonFilePath->id()
     */
    public function test_id_returns_the_expected_Id(): void
    {
        $this->assertEquals(
            $this->expectedId(),
            $this->jsonFilePathTestInstance()->id(),
            $this->testFailedMessage(
                $this->jsonFilePathTestInstance(),
                'id',
                'return the expected Id'
            )
        );
    }

    /**
     * Test that the __toString() method returns the expected Id.
     *
     * @return void
     *
     * @covers JsonFilePath->id()
     */
    public function test___toString_returns_the_expected_json_file_path(): void
    {
        $this->assertEquals(
            $this->expectedJsonFilePath(),
            $this->jsonFilePathTestInstance()->__toString(),
            $this->testFailedMessage(
                $this->jsonFilePathTestInstance(),
                '__toString',
                'return the expected json file path'
            )
        );
    }
}

