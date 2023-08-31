<?php

namespace Darling\PHPJsonStorageUtilities\tests\interfaces\collections;

use \Darling\PHPJsonStorageUtilities\interfaces\collections\ContainerCollection;
use \Darling\PHPJsonStorageUtilities\interfaces\named\identifiers\Container;

/**
 * The ContainerCollectionTestTrait defines common tests for
 * implementations of the ContainerCollection interface.
 *
 * @see ContainerCollection
 *
 */
trait ContainerCollectionTestTrait
{

    /**
     * @var ContainerCollection $containerLocation An instance of a
     *                                             ContainerCollection
     *                                             implementation to
     *                                             test.
     */
    protected ContainerCollection $containerLocation;

    /**
     * @var array<int, Container> The array of Container instances
     *                            that is expected to be returned
     *                            by the ContainerCollection instance
     *                            being tested's collection() method.
     */
    private array $expectedCollection = [];

    /**
     * Set up an instance of a ContainerCollection implementation to
     * test.
     *
     * This method must set the ContainerCollection
     * implementation instance to be tested via the
     * setContainerCollectionTestInstance() method.
     *
     * This method must also set the array of Container instances
     * that is expected to be returned by the ContainerCollection
     * instance being tested's collection() method via the
     * setExpectedCollection() method.
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
     *     $this->setExpectedCollection(
     *         [
     *             new Container(
     *                 new ClassString(Name::class),
     *             ),
     *             new Container(
     *                 new ClassString(Text::class),
     *             ),
     *             new Container(
     *                 new ClassString(ClassString::class),
     *             ),
     *             new Container(
     *                 new ClassString(ContainerCollection::class),
     *             ),
     *             new Container(
     *                 new ClassString(Container::class),
     *             ),
     *         ]
     *     );
     *     $this->setContainerCollectionTestInstance(
     *         new ContainerCollection(
     *             ...$this->expectedCollection(),
     *         )
     *     );
     * }
     *
     * ```
     *
     */
    abstract protected function setUp(): void;

    /**
     * Return the ContainerCollection implementation instance to test.
     *
     * @return ContainerCollection
     *
     */
    protected function containerLocationTestInstance(): ContainerCollection
    {
        return $this->containerLocation;
    }

    /**
     * Set the ContainerCollection implementation instance to test.
     *
     * @param ContainerCollection $containerLocationTestInstance
     *                                           An instance of an
     *                                           implementation of
     *                                           the
     *                                           ContainerCollection
     *                                           interface to test.
     *
     * @return void
     *
     */
    protected function setContainerCollectionTestInstance(
        ContainerCollection $containerLocationTestInstance
    ): void
    {
        $this->containerLocation = $containerLocationTestInstance;
    }

    /**
     * Set the array of Container instances that is expected to be
     * returned by the ContainerCollection instance being tested's
     * collection() method.
     *
     * @param array<int, Container> $collection
     *
     * @return void
     *
     */
    protected function setExpectedCollection(array $collection): void
    {
        $this->expectedCollection = $collection;
    }

    /**
     * Return the array of Container instances that is expected to be
     * returned by the ContainerCollection instance being tested's
     * collection() method.
     *
     * @return array<int, Container>
     *
     */
    protected function expectedCollection(): array
    {
        return $this->expectedCollection;
    }

    /**
     * Test collection() returns the expected array of Container
     * instances.
     *
     * @return void
     *
     * @covers ContainerCollection->collection()
     *
     */
    public function test_collection_returns_the_expected_array_of_Container_instances(): void
    {
        $this->assertEquals(
            $this->expectedCollection(),
            $this->containerLocationTestInstance()->collection(),
            $this->testFailedMessage(
                $this->containerLocationTestInstance(),
                'collection',
                'return the expected array of Container instances'
            ),
        );
    }

}

