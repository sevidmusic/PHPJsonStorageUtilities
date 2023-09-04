<?php

namespace Darling\PHPJsonStorageUtilities\tests\interfaces\filesystem\storage\queries;

use \Darling\PHPJsonStorageUtilities\interfaces\filesystem\paths\JsonFilePath;
use \Darling\PHPJsonStorageUtilities\interfaces\filesystem\paths\JsonStorageDirectoryPath;
use \Darling\PHPJsonStorageUtilities\interfaces\filesystem\storage\queries\JsonFilesystemStorageQuery;
use \Darling\PHPJsonStorageUtilities\interfaces\named\identifiers\Container;
use \Darling\PHPJsonStorageUtilities\interfaces\named\identifiers\Location;
use \Darling\PHPJsonStorageUtilities\interfaces\named\identifiers\Owner;
use \Darling\PHPTextTypes\interfaces\strings\Id;
use \Darling\PHPTextTypes\interfaces\strings\Name;
use \Darling\PHPTextTypes\classes\strings\Name as NameInstance;
use \Darling\PHPTextTypes\classes\strings\Text;
use \Darling\PHPJsonStorageUtilities\classes\filesystem\paths\JsonStorageDirectoryPath as JsonStorageDirectoryPathInstance;

/**
 * The JsonFilesystemStorageQueryTestTrait defines common tests for
 * implementations of the JsonFilesystemStorageQuery interface.
 *
 * @see JsonFilesystemStorageQuery
 *
 */
trait JsonFilesystemStorageQueryTestTrait
{

    /**
     * @var JsonFilesystemStorageQuery $jsonFilesystemStorageQuery
     *                                 An instance of a
     *                                 JsonFilesystemStorageQuery
     *                                 implementation to test.
     */
    protected JsonFilesystemStorageQuery $jsonFilesystemStorageQuery;

    /**
     * @var JsonFilePath $jsonFilePath The JsonFilePath instance
     *                                 that is expected to be
     *                                 returned by the
     *                                 JsonFilesystemStorageQuery
     *                                 instance being tested's
     *                                 jsonFilePath() method.
     */
    protected JsonFilePath|null $expectedJsonFilePath = null;

    /**
     * @var JsonStorageDirectoryPath $jsonStorageDirectoryPath
     *                               The JsonStorageDirectoryPath
     *                               instance that is expected to be
     *                               returned by the
     *                               JsonFilesystemStorageQuery
     *                               instance being tested's
     *                               jsonStorageDirectoryPath()
     *                               method.
     */
    protected JsonStorageDirectoryPath|null $expectedJsonStorageDirectoryPath = null;

    /**
     * @var Location $expectedLocation The Location instance that is
     *                                 expected to be returned by the
     *                                 JsonFilesystemStorageQuery
     *                                 instance being tested's
     *                                 location() method.
     */
    protected Location|null $expectedLocation = null;

    /**
     * @var Container $expectedContainer The Container instance that
     *                                   is expected to be returned
     *                                   by the
     *                                   JsonFilesystemStorageQuery
     *                                   instance being tested's
     *                                   container() method.
     */
    protected Container|null $expectedContainer = null;

    /**
     * @var Owner $expectedOwner The Owner instance that is expected
     *                           to be returned by the
     *                           JsonFilesystemStorageQuery instance
     *                           being tested's owner() method.
     */
    protected Owner|null $expectedOwner = null;

    /**
     * @var Name $expectedName The Name instance that is expected to
     *                         be returned by the
     *                         JsonFilesystemStorageQuery instance
     *                         being tested's name() method.
     */
    protected Name|null $expectedName = null;

    /**
     * @var Id $expectedId The Id instance that is expected to be
     *                     returned by the JsonFilesystemStorageQuery
     *                     instance being tested's id() method.
     */
    protected Id|null $expectedId = null;

    /**
     * Set up an instance of a JsonFilesystemStorageQuery
     * implementation to test.
     *
     * This method must set the JsonFilesystemStorageQuery
     * implementation instance to be tested via the
     * setJsonFilesystemStorageQueryTestInstance()
     * method.
     *
     * This method must also set the JsonStorageDirectoryPath
     * instance that is expected to be returned by the
     * JsonFilesystemStorageQuery being tested's
     * jsonStorageDirectoryPath() method via the
     * setExpectedJsonStorageDirectoryPath()
     * method.
     *
     * This method must also set the JsonFilePath instance that is
     * expected to be returned by the JsonFilesystemStorageQuery
     * being tested's jsonFilePath() method via the
     * setExpectedJsonFilePath()
     * method.
     *
     * This method must also set the Location instance that is
     * expected to be returned by the JsonFilesystemStorageQuery
     * being tested's location() method via the setExpectedLocation()
     * method.
     *
     * This method must also set the Container instance that is
     * expected to be returned by the JsonFilesystemStorageQuery being
     * tested's container() method via the setExpectedContainer()
     * method.
     *
     * This method must also set the Owner instance that is expected
     * to be returned by the JsonFilesystemStorageQuery being tested's
     * owner() method via the setExpectedOwner() method.
     *
     * This method must also set the Name instance that is expected
     * to be returned by the JsonFilesystemStorageQuery being tested's
     * name() method via the setExpectedName() method.
     *
     * This method must also set the Id instance that is expected to
     * be returned by the JsonFilesystemStorageQuery being tested's
     * id() method via the setExpectedName() method.
     *
     * This method may also be used to perform any additional setup
     * required by the implementation being tested.
     *
     * @return void
     *
     * @example
     *
     * ```
     * public function setUp(): void
     * {
     *     $jsonStorageDirectoryPath = new JsonStorageDirectoryPath(
     *         new Name(
     *             new Text($this->randomChars())
     *         )
     *     );
     *     $this->setExpectedJsonStorageDirectoryPath($jsonStorageDirectoryPath);
     *     $location = new Location(new Name(new Text($this->randomChars())));
     *     $this->setExpectedLocation($location);
     *     $container = new Container(new ClassString($this->randomClassStringOrObjectInstance()));
     *     $this->setExpectedContainer($container);
     *     $owner = new Owner(new Name(new Text($this->randomChars())));
     *     $this->setExpectedOwner($owner);
     *     $name = new Name(new Text($this->randomChars()));
     *     $this->setExpectedName($name);
     *     $id = new Id();
     *     $this->setExpectedId($id);
     *     $jsonFilePath = new JsonFilePath(
     *         new JsonStorageDirectoryPath(new Name(new Text(self::TEST_STORAGE_DIRECTORY_NAME))),
     *         new Location(new Name(new Text($this->randomChars()))),
     *         new Container(new ClassString(Name::class)),
     *         new Owner(new Name(new Text($this->randomChars()))),
     *         new Name(new Text($this->randomChars())),
     *         new Id(),

     *     );
     *     $this->setExpectedJsonFilePath($jsonFilePath);
     *     $this->setJsonFilesystemStorageQueryTestInstance(
     *         new JsonFilesystemStorageQuery(
     *             jsonFilePath: $jsonFilePath,
     *             jsonStorageDirectoryPath: $jsonStorageDirectoryPath,
     *             location: $location,
     *             container: $container,
     *             owner: $owner,
     *             name: $name,
     *             id: $id,
     *         )
     *     );
     * }
     *
     * ```
     *
     */
    abstract protected function setUp(): void;

    /**
     * Return the JsonFilesystemStorageQuery implementation instance
     * to test.
     *
     * @return JsonFilesystemStorageQuery
     *
     */
    protected function jsonFilesystemStorageQueryTestInstance(): JsonFilesystemStorageQuery
    {
        return $this->jsonFilesystemStorageQuery;
    }

    /**
     * Set the JsonFilesystemStorageQuery implementation instance to
     * test.
     *
     * @param JsonFilesystemStorageQuery $jsonFilesystemStorageQueryTestInstance
     *                                  An instance of an
     *                                  implementation of
     *                                  the JsonFilesystemStorageQuery
     *                                  interface to test.
     *
     * @return void
     *
     */
    protected function setJsonFilesystemStorageQueryTestInstance(
        JsonFilesystemStorageQuery $jsonFilesystemStorageQueryTestInstance
    ): void
    {
        $this->jsonFilesystemStorageQuery = $jsonFilesystemStorageQueryTestInstance;
    }

    private function expectedQueryString(JsonFilesystemStorageQuery $query): string
    {
        $queryString =
        (
            is_null($query->jsonStorageDirectoryPath())
            ? dirname($this->jsonStorageDirectoryPathInstance()) .
            DIRECTORY_SEPARATOR . '*'
            : $query->jsonStorageDirectoryPath()
        ) .
        DIRECTORY_SEPARATOR .
        (is_null($query->location()) ? '*' : $query->location()) .
        DIRECTORY_SEPARATOR .
        (is_null($query->container()) ? '*' : $query->container()) .
        DIRECTORY_SEPARATOR .
        (is_null($query->owner()) ? '*' : $query->owner()) .
        DIRECTORY_SEPARATOR .
        (is_null($query->name()) ? '*' : $query->name()) .
        DIRECTORY_SEPARATOR .
        (
            is_null($query->id())
            ? '*' . DIRECTORY_SEPARATOR . '*'
            : $this->shardId($query->id()) . '.json'
        );
        return $queryString;
    }

    private function shardId(Id $id): string
    {
        $index = 3;
        $parentDir = substr($id->__toString(), 0, $index);
        $subDir = substr($id->__toString(), $index);
        return $parentDir . DIRECTORY_SEPARATOR . $subDir;
    }

    private function jsonStorageDirectoryPathInstance(): JsonStorageDirectoryPath
    {
        return new JsonStorageDirectoryPathInstance(new NameInstance(new Text('DEFAULT')));
    }

    /**
     * Set the JsonFilePath instance that is expected to be returned
     * by the JsonFilesystemStorageQuery being tested's jsonFilePath()
     * method.
     *
     * @return void
     *
     */
    protected function setExpectedJsonFilePath(
        JsonFilePath|null $jsonFilePath
    ): void
    {
        $this->expectedJsonFilePath = $jsonFilePath;
    }

    /**
     * Set the JsonStorageDirectoryPath instance that is expected to
     * be returned by the JsonFilesystemStorageQuery being tested's
     * jsonStorageDirectoryPath() method.
     *
     * @return void
     *
     */
    protected function setExpectedJsonStorageDirectoryPath(
        JsonStorageDirectoryPath|null $jsonStorageDirectoryPath
    ): void
    {
        $this->expectedJsonStorageDirectoryPath = $jsonStorageDirectoryPath;
    }

    /**
     * Set the Location instance that is expected to be returned
     * by the JsonFilesystemStorageQuery being tested's location()
     * method.
     *
     * @return void
     *
     */
    protected function setExpectedLocation(Location|null $location): void
    {
        $this->expectedLocation = $location;
    }

    /**
     * Set the Container instance that is expected to be returned
     * by the JsonFilesystemStorageQuery being tested's container()
     * method.
     *
     * @return void
     *
     */
    protected function setExpectedContainer(Container|null $container): void
    {
        $this->expectedContainer = $container;
    }

    /**
     * Set the Owner instance that is expected to be returned
     * by the JsonFilesystemStorageQuery being tested's owner()
     * method.
     *
     * @return void
     *
     */
    protected function setExpectedOwner(Owner|null $owner): void
    {
        $this->expectedOwner = $owner;
    }

    /**
     * Set the Name instance that is expected to be returned
     * by the JsonFilesystemStorageQuery being tested's name()
     * method.
     *
     * @return void
     *
     */
    protected function setExpectedName(Name|null $name): void
    {
        $this->expectedName = $name;
    }

    /**
     * Set the Id instance that is expected to be returned
     * by the JsonFilesystemStorageQuery being tested's id()
     * method.
     *
     * @return void
     *
     */
    protected function setExpectedId(Id|null $id): void
    {
        $this->expectedId = $id;
    }

    /**
     * Return the JsonFilePath that is expected to be returned by the
     * JsonFilesystemStorageQuery being tested's jsonFilePath() method.
     *
     * @return JsonFilePath|null
     *
     */
    protected function expectedJsonFilePath(): JsonFilePath|null
    {
        return $this->expectedJsonFilePath;
    }

    /**
     * Return the JsonStorageDirectoryPath that is expected to be
     * returned by the JsonFilesystemStorageQuery being tested's
     * jsonStorageDirectoryPath() method.
     *
     * @return JsonStorageDirectoryPath|null
     *
     */
    protected function expectedJsonStorageDirectoryPath(): JsonStorageDirectoryPath|null
    {
        return $this->expectedJsonStorageDirectoryPath;
    }

    /**
     * Return the Location that is expected to be returned by the
     * JsonFilesystemStorageQuery being tested's location() method.
     *
     * @return Location|null
     *
     */
    protected function expectedLocation(): Location|null
    {
        return $this->expectedLocation;
    }

    /**
     * Return the Container that is expected to be returned by the
     * JsonFilesystemStorageQuery being tested's container() method.
     *
     * @return Container|null
     *
     */
    protected function expectedContainer(): Container|null
    {
        return $this->expectedContainer;
    }

    /**
     * Return the Owner that is expected to be returned by the
     * JsonFilesystemStorageQuery being tested's owner() method.
     *
     * @return Owner|null
     *
     */
    protected function expectedOwner(): Owner|null
    {
        return $this->expectedOwner;
    }

    /**
     * Return the Name that is expected to be returned by the
     * JsonFilesystemStorageQuery being tested's name() method.
     *
     * @return Name|null
     *
     */
    protected function expectedName(): Name|null
    {
        return $this->expectedName;
    }

    /**
     * Return the Id that is expected to be returned by the
     * JsonFilesystemStorageQuery being tested's id() method.
     *
     * @return Id|null
     *
     */
    protected function expectedId(): Id|null
    {
        return $this->expectedId;
    }

    /**
     * Test JsonFilePath returns the expected JsonFilePath.
     *
     * @return void
     *
     * @covers JsonFilesystemStorageQuery->jsonFilePath()
     *
     */
    public function test_JsonFilePath_returns_the_expected_JsonFilePath(): void
    {
        $this->assertEquals(
            $this->expectedJsonFilePath(),
            $this->jsonFilesystemStorageQueryTestInstance()->jsonFilePath(),
            $this->testFailedMessage(
                $this->jsonFilesystemStorageQueryTestInstance(),
                'jsonFilePath',
                'return the expected JsonFilePath instance',
            ),
        );
    }

    /**
     * Test JsonStorageDirectoryPath returns the expected
     * JsonStorageDirectoryPath.
     *
     * @return void
     *
     * @covers JsonFilesystemStorageQuery->jsonStorageDirectoryPath()
     *
     */
    public function test_JsonStorageDirectoryPath_returns_the_expected_JsonStorageDirectoryPath(): void
    {
        $this->assertEquals(
            $this->expectedJsonStorageDirectoryPath(),
            $this->jsonFilesystemStorageQueryTestInstance()->jsonStorageDirectoryPath(),
            $this->testFailedMessage(
                $this->jsonFilesystemStorageQueryTestInstance(),
                'jsonStorageDirectoryPath',
                'return the expected JsonStorageDirectoryPath instance',
            ),
        );
    }

    /**
     * Test Location returns the expected Location.
     *
     * @return void
     *
     * @covers JsonFilesystemStorageQuery->location()
     *
     */
    public function test_Location_returns_the_expected_Location(): void
    {
        $this->assertEquals(
            $this->expectedLocation(),
            $this->jsonFilesystemStorageQueryTestInstance()->location(),
            $this->testFailedMessage(
                $this->jsonFilesystemStorageQueryTestInstance(),
                'location',
                'return the expected Location instance',
            ),
        );
    }

    /**
     * Test Container returns the expected Container.
     *
     * @return void
     *
     * @covers JsonFilesystemStorageQuery->container()
     *
     */
    public function test_Container_returns_the_expected_Container(): void
    {
        $this->assertEquals(
            $this->expectedContainer(),
            $this->jsonFilesystemStorageQueryTestInstance()->container(),
            $this->testFailedMessage(
                $this->jsonFilesystemStorageQueryTestInstance(),
                'container',
                'return the expected Container instance',
            ),
        );
    }

    /**
     * Test Owner returns the expected Owner.
     *
     * @return void
     *
     * @covers JsonFilesystemStorageQuery->owner()
     *
     */
    public function test_Owner_returns_the_expected_Owner(): void
    {
        $this->assertEquals(
            $this->expectedOwner(),
            $this->jsonFilesystemStorageQueryTestInstance()->owner(),
            $this->testFailedMessage(
                $this->jsonFilesystemStorageQueryTestInstance(),
                'owner',
                'return the expected Owner instance',
            ),
        );
    }

    /**
     * Test Name returns the expected Name.
     *
     * @return void
     *
     * @covers JsonFilesystemStorageQuery->name()
     *
     */
    public function test_Name_returns_the_expected_Name(): void
    {
        $this->assertEquals(
            $this->expectedName(),
            $this->jsonFilesystemStorageQueryTestInstance()->name(),
            $this->testFailedMessage(
                $this->jsonFilesystemStorageQueryTestInstance(),
                'name',
                'return the expected Name instance',
            ),
        );
    }

    /**
     * Test Id returns the expected Id.
     *
     * @return void
     *
     * @covers JsonFilesystemStorageQuery->id()
     *
     */
    public function test_Id_returns_the_expected_Id(): void
    {
        $this->assertEquals(
            $this->expectedId(),
            $this->jsonFilesystemStorageQueryTestInstance()->id(),
            $this->testFailedMessage(
                $this->jsonFilesystemStorageQueryTestInstance(),
                'id',
                'return the expected Id instance',
            ),
        );
    }

    /**
     * Test __toString() returns the expected query string.
     *
     * @return void
     *
     * @covers JsonFilesystemStorageQuery->__toString()
     *
     */
    public function test___toString_returns_expected_query_string(): void
    {
        $this->assertEquals(
            $this->expectedQueryString($this->jsonFilesystemStorageQueryTestInstance()),
            $this->jsonFilesystemStorageQueryTestInstance()->__toString(),
            $this->testFailedMessage(
                $this->jsonFilesystemStorageQueryTestInstance(),
                '__toString',
                'return the expected query string.'
            ),
        );
    }
}

