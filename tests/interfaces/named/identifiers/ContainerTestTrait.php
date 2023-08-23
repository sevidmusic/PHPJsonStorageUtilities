<?php

namespace Darling\PHPJsonStorageUtilities\tests\interfaces\named\identifiers;

use \Darling\PHPJsonStorageUtilities\interfaces\named\identifiers\Container;
use \Darling\PHPJsonStorageUtilities\tests\interfaces\named\identifiers\NamedIdentifierTestTrait;

/**
 * The ContainerTestTrait defines common tests for
 * implementations of the Container interface.
 *
 * @see Container
 *
 */
trait ContainerTestTrait
{

    use NamedIdentifierTestTrait;

    /**
     * @var Container $container An instance of a Container
     *                           implementation to test.
     */
    protected Container $container;

    /**
     * Set up an instance of a Container implementation to test.
     *
     * This method must set the Container implementation instance
     * to be tested via the setContainerTestInstance() method.
     *
     * This method must also set the Name that is expected to be
     * returned by the Container implementation instance being
     * tested's name() method via the setExpectedName() method.
     *
     * This method must also set the Container implementation
     * being tested as the NamedIdentifier implementation to
     * test via the setNamedIdentifierTestInstance() method.
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
     *     $expectedName = new Name(new Text($this->randomChars()));
     *     $location = new Container($expectedName);
     *     $this->setExpectedName($expectedName);
     *     $this->setNamedIdentifierTestInstance($location);
     *     $this->setContainerTestInstance(
     *         new Container($expectedName)
     *     );
     * }
     *
     * ```
     *
     */
    abstract protected function setUp(): void;

    /**
     * Return the Container implementation instance to test.
     *
     * @return Container
     *
     */
    protected function containerTestInstance(): Container
    {
        return $this->container;
    }

    /**
     * Set the Container implementation instance to test.
     *
     * @param Container $containerTestInstance
     *                              An instance of an
     *                              implementation of
     *                              the Container
     *                              interface to test.
     *
     * @return void
     *
     */
    protected function setContainerTestInstance(
        Container $containerTestInstance
    ): void
    {
        $this->container = $containerTestInstance;
    }

}

