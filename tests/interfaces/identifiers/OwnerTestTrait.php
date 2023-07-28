<?php

namespace Darling\PHPJsonStorageUtilities\tests\interfaces\identifiers;

use Darling\PHPJsonStorageUtilities\interfaces\identifiers\Owner;

/**
 * The OwnerTestTrait defines common tests for
 * implementations of the Owner interface.
 *
 * @see Owner
 *
 */
trait OwnerTestTrait
{

    /**
     * @var Owner $owner
     *                              An instance of a
     *                              Owner
     *                              implementation to test.
     */
    protected Owner $owner;

    /**
     * Set up an instance of a Owner implementation to test.
     *
     * This method must also set the Owner implementation instance
     * to be tested via the setOwnerTestInstance() method.
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
     *     $this->setOwnerTestInstance(
     *         new \Darling\PHPJsonStorageUtilities\classes\identifiers\Owner()
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

