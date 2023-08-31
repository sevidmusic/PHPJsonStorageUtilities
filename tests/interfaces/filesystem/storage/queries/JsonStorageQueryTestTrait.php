<?php

namespace Darling\PHPJsonStorageUtilities\tests\interfaces\filesystem\storage\queries;

use \Darling\PHPJsonStorageUtilities\interfaces\filesystem\paths\JsonFilePath;
use \Darling\PHPJsonStorageUtilities\interfaces\filesystem\paths\JsonStorageDirectoryPath;
use \Darling\PHPJsonStorageUtilities\interfaces\filesystem\storage\queries\JsonStorageQuery;
use \Darling\PHPJsonStorageUtilities\interfaces\named\identifiers\Container;
use \Darling\PHPJsonStorageUtilities\interfaces\named\identifiers\Location;
use \Darling\PHPJsonStorageUtilities\interfaces\named\identifiers\Owner;
use \Darling\PHPTextTypes\interfaces\strings\Id;
use \Darling\PHPTextTypes\interfaces\strings\Name;

/**
 * The JsonStorageQueryTestTrait defines common tests for
 * implementations of the JsonStorageQuery interface.
 *
 * @see JsonStorageQuery
 *
 */
trait JsonStorageQueryTestTrait
{

    /**
     * @var JsonStorageQuery $jsonStorageQuery An instance of a
     *                                         JsonStorageQuery
     *                                         implementation to
     *                                         test.
     */
    protected JsonStorageQuery $jsonStorageQuery;

    /**
     * @var array<int, JsonStorageDirectoryPath> The array of
     *                                           JsonStorageDirectoryPath
     *                                           instances that is
     *                                           expected to be
     *                                           returned by the
     *                                           JsonStorageQuery
     *                                           being tested's
     *                                           jsonStorageDirectoryPaths()
     *                                           method.
     */
    private array $expectedJsonStorageDirectoryPaths;

    /**
     * @var array<int, Id> The array of
     *                                           Id
     *                                           instances that is
     *                                           expected to be
     *                                           returned by the
     *                                           JsonStorageQuery
     *                                           being tested's
     *                                           ids()
     *                                           method.
     */
    private array $expectedIds;

    /**
     * @var array<int, Name> The array of
     *                                           Name
     *                                           instances that is
     *                                           expected to be
     *                                           returned by the
     *                                           JsonStorageQuery
     *                                           being tested's
     *                                           names()
     *                                           method.
     */
    private array $expectedNames;

    /**
     * @var array<int, Owner> The array of Owner instances that is
     *                        expected to be returned by the
     *                        JsonStorageQuery being tested's owners()
     *                        method.
     */
    private array $expectedOwners;

    /**
     * @var array<int, Container> The array of Container instances
     *                            that is expected to be returned by
     *                            the JsonStorageQuery being tested's
     *                            containers() method.
     */
    private array $expectedContainers;

    /**
     * @var array<int, Location> The array of Location instances that
     *                           is expected to be returned by the
     *                           JsonStorageQuery being tested's
     *                           locations() method.
     */
    private array $expectedLocations;

    /**
     * @var array<int, JsonFilePath> The array of JsonFilePath
     *                               instances that is expected to be
     *                               returned by the JsonStorageQuery
     *                               being tested's jsonFilePaths()
     *                               method.
     */
    private array $expectedJsonFilePaths;

    /**
     * Return the array of JsonStorageDirectoryPath instances
     * that is expected to be returned by the JsonStorageQuery
     * instance being tested's jsonStorageDirectoryPaths() method.
     *
     * @return array<int, JsonStorageDirectoryPath>
     *
     */
    protected function expectedJsonStorageDirectoryPaths(): array
    {
        return $this->expectedJsonStorageDirectoryPaths;
    }

    /**
     * Return the array of Id instances that is expected to be
     * returned by the JsonStorageQuery instance being tested's
     * ids() method.
     *
     * @return array<int, Id>
     *
     */
    protected function expectedIds(): array
    {
        return $this->expectedIds;
    }

    /**
     * Return the array of Name instances that is expected to be
     * returned by the JsonStorageQuery instance being tested's
     * names() method.
     *
     * @return array<int, Name>
     *
     */
    protected function expectedNames(): array
    {
        return $this->expectedNames;
    }

    /**
     * Return the array of Owner instances that is expected to be
     * returned by the JsonStorageQuery instance being tested's
     * owners() method.
     *
     * @return array<int, Owner>
     *
     */
    protected function expectedOwners(): array
    {
        return $this->expectedOwners;
    }

    /**
     * Return the array of Container instances that is expected to be
     * returned by the JsonStorageQuery instance being tested's
     * containers() method.
     *
     * @return array<int, Container>
     *
     */
    protected function expectedContainers(): array
    {
        return $this->expectedContainers;
    }

    /**
     * Return the array of Location instances that is expected to be
     * returned by the JsonStorageQuery instance being tested's
     * locations() method.
     *
     * @return array<int, Location>
     *
     */
    protected function expectedLocations(): array
    {
        return $this->expectedLocations;
    }

    /**
     * Return the array of JsonFilePath instances that is expected to
     * be returned by the JsonStorageQuery instance being tested's
     * jsonFilePaths() method.
     *
     * @return array<int, JsonFilePath>
     *
     */
    protected function expectedJsonFilePaths(): array
    {
        return $this->expectedJsonFilePaths;
    }

    /**
     * Set up an instance of a JsonStorageQuery implementation to
     * test.
     *
     * This method must also set the JsonStorageQuery implementation
     * instance to be tested via the setJsonStorageQueryTestInstance()
     * method.
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
     *     $this->setJsonStorageQueryTestInstance(
     *         new \Darling\PHPJsonStorageUtilities\classes\filesystem\storage\queries\JsonStorageQuery()
     *     );
     * }
     *
     * ```
     *
     */
    abstract protected function setUp(): void;

    /**
     * Return the JsonStorageQuery implementation instance to test.
     *
     * @return JsonStorageQuery
     *
     */
    protected function jsonStorageQueryTestInstance(): JsonStorageQuery
    {
        return $this->jsonStorageQuery;
    }

    /**
     * Set the JsonStorageQuery implementation instance to test.
     *
     * @param JsonStorageQuery $jsonStorageQueryTestInstance
     *                              An instance of an
     *                              implementation of
     *                              the JsonStorageQuery
     *                              interface to test.
     *
     * @return void
     *
     */
    protected function setJsonStorageQueryTestInstance(
        JsonStorageQuery $jsonStorageQueryTestInstance
    ): void
    {
        $this->jsonStorageQuery = $jsonStorageQueryTestInstance;
    }

    /**
     * Set the array of JsonStorageDirectoryPath instances
     * that is expected to be returned by the JsonStorageQuery
     * instance being tested's jsonStorageDirectoryPaths() method.
     *
     * @param array<int, JsonStorageDirectoryPath> $jsonStorageDirectoryPaths
     *
     */
    protected function setExpectedJsonStorageDirectoryPaths(
        array $jsonStorageDirectoryPaths
    ): void
    {
        $this->expectedJsonStorageDirectoryPaths = $jsonStorageDirectoryPaths;
    }


    /**
     * Set the array of Id instances that is expected to be returned
     * by the JsonStorageQuery instance being tested's ids() method.
     *
     * @param array<int, Id> $ids
     *
     */
    protected function setExpectedIds(
        array $ids
    ): void
    {
        $this->expectedIds = $ids;
    }


    /**
     * Set the array of Name instances that is expected to be
     * returned by the JsonStorageQuery instance being tested's
     * names() method.
     *
     * @param array<int, Name> $names
     *
     */
    protected function setExpectedNames(
        array $names
    ): void
    {
        $this->expectedNames = $names;
    }


    /**
     * Set the array of Owner instances that is expected to be
     * returned by the JsonStorageQuery instance being tested's
     * owners() method.
     *
     * @param array<int, Owner> $owners
     *
     */
    protected function setExpectedOwners(
        array $owners
    ): void
    {
        $this->expectedOwners = $owners;
    }


    /**
     * Set the array of Container instances that is expected to be
     * returned by the JsonStorageQuery instance being tested's
     * containers() method.
     *
     * @param array<int, Container> $containers
     *
     */
    protected function setExpectedContainers(
        array $containers
    ): void
    {
        $this->expectedContainers = $containers;
    }


    /**
     * Set the array of Location instances that is expected to be
     * returned by the JsonStorageQuery instance being tested's
     * locations() method.
     *
     * @param array<int, Location> $locations
     *
     */
    protected function setExpectedLocations(
        array $locations
    ): void
    {
        $this->expectedLocations = $locations;
    }


    /**
     * Set the array of JsonFilePath instances that is expected to be
     * returned by the JsonStorageQuery instance being tested's
     * jsonFilePaths() method.
     *
     * @param array<int, JsonFilePath> $jsonFilePaths
     *
     */
    protected function setExpectedJsonFilePaths(
        array $jsonFilePaths
    ): void
    {
        $this->expectedJsonFilePaths = $jsonFilePaths;
    }


    /**
     * Test that the jsonStorageDirectoryPaths() method returns the
     * expected array of JsonStorageDirectoryPath instances.
     *
     * @return void
     *
     * @covers JsonStorageQuery->jsonStorageDirectoryPaths()
     *
     */
    public function test_jsonStorageDirectoryPaths_returns_an_array_of_the_expected_JsonStorageDirectoryPath_instances(): void
    {
        $this->assertEquals(
            $this->expectedJsonStorageDirectoryPaths(),
            $this->jsonStorageQueryTestInstance()->jsonStorageDirectoryPaths(),
            $this->testFailedMessage(
                $this->jsonStorageQueryTestInstance(),
                'jsonStorageDirectoryPaths',
                'return an array of the expected ' .
                'JsonStorageDirectoryPath instances'
            ),
        );
    }



    /**
     * Test that the ids() method returns the expected array of Id
     * instances.
     *
     * @return void
     *
     * @covers JsonStorageQuery->ids()
     *
     */
    public function test_ids_returns_an_array_of_the_expected_Id_instances(): void
    {
        $this->assertEquals(
            $this->expectedIds(),
            $this->jsonStorageQueryTestInstance()->ids(),
            $this->testFailedMessage(
                $this->jsonStorageQueryTestInstance(),
                'ids',
                'return an array of the expected ' .
                'Id instances'
            ),
        );
    }



    /**
     * Test that the names() method returns the expected array of Name
     * instances.
     *
     * @return void
     *
     * @covers JsonStorageQuery->names()
     *
     */
    public function test_names_returns_an_array_of_the_expected_Name_instances(): void
    {
        $this->assertEquals(
            $this->expectedNames(),
            $this->jsonStorageQueryTestInstance()->names(),
            $this->testFailedMessage(
                $this->jsonStorageQueryTestInstance(),
                'names',
                'return an array of the expected ' .
                'Name instances'
            ),
        );
    }



    /**
     * Test that the owners() method returns the expected array of
     * Owner instances.
     *
     * @return void
     *
     * @covers JsonStorageQuery->owners()
     *
     */
    public function test_owners_returns_an_array_of_the_expected_Owner_instances(): void
    {
        $this->assertEquals(
            $this->expectedOwners(),
            $this->jsonStorageQueryTestInstance()->owners(),
            $this->testFailedMessage(
                $this->jsonStorageQueryTestInstance(),
                'owners',
                'return an array of the expected ' .
                'Owner instances'
            ),
        );
    }



    /**
     * Test that the containers() method returns the expected array
     * of Container instances.
     *
     * @return void
     *
     * @covers JsonStorageQuery->containers()
     *
     */
    public function test_containers_returns_an_array_of_the_expected_Container_instances(): void
    {
        $this->assertEquals(
            $this->expectedContainers(),
            $this->jsonStorageQueryTestInstance()->containers(),
            $this->testFailedMessage(
                $this->jsonStorageQueryTestInstance(),
                'containers',
                'return an array of the expected ' .
                'Container instances'
            ),
        );
    }



    /**
     * Test that the locations() method returns the expected array of
     * Location instances.
     *
     * @return void
     *
     * @covers JsonStorageQuery->locations()
     *
     */
    public function test_locations_returns_an_array_of_the_expected_Location_instances(): void
    {
        $this->assertEquals(
            $this->expectedLocations(),
            $this->jsonStorageQueryTestInstance()->locations(),
            $this->testFailedMessage(
                $this->jsonStorageQueryTestInstance(),
                'locations',
                'return an array of the expected ' .
                'Location instances'
            ),
        );
    }



    /**
     * Test that the jsonFilePaths() method returns the expected array
     * of JsonFilePath instances.
     *
     * @return void
     *
     * @covers JsonStorageQuery->jsonFilePaths()
     *
     */
    public function test_jsonFilePaths_returns_an_array_of_the_expected_JsonFilePath_instances(): void
    {
        $this->assertEquals(
            $this->expectedJsonFilePaths(),
            $this->jsonStorageQueryTestInstance()->jsonFilePaths(),
            $this->testFailedMessage(
                $this->jsonStorageQueryTestInstance(),
                'jsonFilePaths',
                'return an array of the expected ' .
                'JsonFilePath instances'
            ),
        );
    }

}

