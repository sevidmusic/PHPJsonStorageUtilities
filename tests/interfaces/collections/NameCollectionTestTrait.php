<?php

namespace Darling\PHPJsonStorageUtilities\tests\interfaces\collections;

use \Darling\PHPJsonStorageUtilities\interfaces\collections\NameCollection;
use \Darling\PHPTextTypes\classes\strings\Name;

/**
 * The NameCollectionTestTrait defines common tests for
 * implementations of the NameCollection interface.
 *
 * @see NameCollection
 *
 */
trait NameCollectionTestTrait
{

    /**
     * @var NameCollection $nameCollection An instance of a
     *                                     NameCollection
     *                                     implementation to test.
     */
    protected NameCollection $nameCollection;

    /**
     * @var array<int, Name> The array of Name instances that is
     *                       expected to be returned by the
     *                       NameCollection instance being tested's
     *                       collection() method.
     */
    private array $expectedCollection = [];

    /**
     * Set up an instance of a NameCollection implementation to test.
     *
     * This method must set the NameCollection implementation
     * instance to be tested via the setNameCollectionTestInstance()
     * method.
     *
     * This method must also set the array of Name instances that is
     * expected to be returned by the NameCollection instance being
     * tested's collection() method via the setExpectedCollection()
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
     * public function setUp(): void
     * {
     *     $this->setExpectedCollection(
     *         [
     *             new Name(new Name(new Text($this->randomChars()))),
     *             new Name(new Name(new Text($this->randomChars()))),
     *             new Name(new Name(new Text($this->randomChars()))),
     *             new Name(new Name(new Text($this->randomChars()))),
     *             new Name(new Name(new Text($this->randomChars()))),
     *         ]
     *     );
     *     $this->setNameCollectionTestInstance(
     *         new NameCollection(
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
     * Return the NameCollection implementation instance to test.
     *
     * @return NameCollection
     *
     */
    protected function nameCollectionTestInstance(): NameCollection
    {
        return $this->nameCollection;
    }

    /**
     * Set the NameCollection implementation instance to test.
     *
     * @param NameCollection $nameCollectionTestInstance An instance
     *                                                  of an
     *                                                  implementation
     *                                                  of the
     *                                                  NameCollection
     *                                                  interface to
     *                                                  test.
     *
     * @return void
     *
     */
    protected function setNameCollectionTestInstance(
        NameCollection $nameCollectionTestInstance
    ): void
    {
        $this->nameCollection = $nameCollectionTestInstance;
    }

    /**
     * Set the array of Name instances that is expected to be
     * returned by the NameCollection instance being tested's
     * collection() method.
     *
     * @param array<int, Name> $collection
     *
     * @return void
     *
     */
    protected function setExpectedCollection(array $collection): void
    {
        $this->expectedCollection = $collection;
    }

    /**
     * Return the array of Name instances that is expected to be
     * returned by the NameCollection instance being tested's
     * collection() method.
     *
     * @return array<int, Name>
     *
     */
    protected function expectedCollection(): array
    {
        return $this->expectedCollection;
    }

    /**
     * Test collection() returns the expected array of Name instances.
     *
     * @return void
     *
     * @covers NameCollection->collection()
     *
     */
    public function test_collection_returns_the_expected_array_of_Name_instances(): void
    {
        $this->assertEquals(
            $this->expectedCollection(),
            $this->nameCollectionTestInstance()->collection(),
            $this->testFailedMessage(
                $this->nameCollectionTestInstance(),
                'collection',
                'return the expected array of Name instances'
            ),
        );
    }

}

