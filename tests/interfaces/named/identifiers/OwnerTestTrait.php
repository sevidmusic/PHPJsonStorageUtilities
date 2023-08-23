<?php

namespace Darling\PHPJsonStorageUtilities\tests\interfaces\named\identifiers;

use \Darling\PHPJsonStorageUtilities\interfaces\named\identifiers\Owner;
use \Darling\PHPJsonStorageUtilities\tests\interfaces\named\identifiers\NamedIdentifierTestTrait;

/**
 * The OwnerTestTrait defines common tests for implementations of the
 * Owner interface.
 *
 * @see Owner
 *
 */
trait OwnerTestTrait
{

    use NamedIdentifierTestTrait;

    /**
     * @var Owner $owner An instance of a Owner implementation
     *                   to test.
     */
    protected Owner $owner;

    /**
     * Set up an instance of a Owner implementation to test.
     *
     * This method must set the Owner implementation instance
     * to be tested via the setOwnerTestInstance() method.
     *
     * This method must also set the Name that is expected to be
     * returned by the Owner implementation instance being
     * tested's name() method via the setExpectedName() method.
     *
     * This method must also set the Owner implementation
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
     *     $location = new Owner($expectedName);
     *     $this->setExpectedName($expectedName);
     *     $this->setNamedIdentifierTestInstance($location);
     *     $this->setOwnerTestInstance(
     *         new Owner($expectedName)
     *     );
     * }
     *
     * ```
     *
     */
    abstract protected function setUp(): void;

    /**
     * Return the Owner implementation instance to test.
     *
     * @return Owner
     *
     */
    protected function ownerTestInstance(): Owner
    {
        return $this->owner;
    }

    /**
     * Set the Owner implementation instance to test.
     *
     * @param Owner $ownerTestInstance
     *                              An instance of an
     *                              implementation of
     *                              the Owner
     *                              interface to test.
     *
     * @return void
     *
     */
    protected function setOwnerTestInstance(
        Owner $ownerTestInstance
    ): void
    {
        $this->owner = $ownerTestInstance;
    }

}

