<?php

namespace Darling\PHPJsonStorageUtilities\tests\interfaces\named\identifiers;

use \Darling\PHPJsonStorageUtilities\interfaces\named\identifiers\NamedIdentifier;
use \Darling\PHPTextTypes\classes\strings\Name;

/**
 * The NamedIdentifierTestTrait defines common tests for
 * implementations of the NamedIdentifier interface.
 *
 * @see NamedIdentifier
 *
 */
trait NamedIdentifierTestTrait
{

    /**
     * @var NamedIdentifier $namedIdentifier
     *                              An instance of a
     *                              NamedIdentifier
     *                              implementation to test.
     */
    protected NamedIdentifier $namedIdentifier;

    private Name $expectedName;

    /**
     * Set up an instance of a NamedIdentifier implementation to test.
     *
     * This method must also set the NamedIdentifier implementation instance
     * to be tested via the setNamedIdentifierTestInstance() method.
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
     *     $this->setNamedIdentifierTestInstance(
     *         new \Darling\PHPJsonStorageUtilities\classes\named\identifiers\NamedIdentifier()
     *     );
     * }
     *
     * ```
     *
     */
    abstract protected function setUp(): void;

    /**
     * Return the NamedIdentifier implementation instance to test.
     *
     * @return NamedIdentifier
     *
     */
    protected function namedIdentifierTestInstance(): NamedIdentifier
    {
        return $this->namedIdentifier;
    }

    /**
     * Set the NamedIdentifier implementation instance to test.
     *
     * @param NamedIdentifier $namedIdentifierTestInstance
     *                              An instance of an
     *                              implementation of
     *                              the NamedIdentifier
     *                              interface to test.
     *
     * @return void
     *
     */
    protected function setNamedIdentifierTestInstance(
        NamedIdentifier $namedIdentifierTestInstance
    ): void
    {
        $this->namedIdentifier = $namedIdentifierTestInstance;
    }

    /**
     * Set the Name instance that is expected to be returned
     * by the NamedIdentifier implementation instance to test's
     * name() method.
     *
     * @param Name $name An instance of a Name.
     *
     * @return void
     *
     */
    protected function setExpectedName(
        Name $name
    ): void
    {
        $this->expectedName = $name;
    }

    private function expectedName(): Name
    {
        return $this->expectedName;
    }

    /**
     * Test that the name() method returns the expected
     * Name instance.
     *
     * @return void
     *
     * @covers NamedIdentifier->name()
     */
    public function test_name_returns_the_expected_name(): void
    {
        $this->assertEquals(
            $this->expectedName(),
            $this->namedIdentifierTestInstance()->name(),
            $this->testFailedMessage(
                $this->namedIdentifierTestInstance(),
                'name',
                'the expected ' . Name::class
            ),
        );
    }

    /**
     * Test that the __toString() method returns the same string
     * returned by the assigned Name instances __toString() method.
     *
     * @return void
     *
     * @covers NamedIdentifier->name()
     */
    public function test_that_the___toString_method_returns_the_same_string_returned_by_the_assigned_Name_instances___toString_method(): void
    {
        $this->assertEquals(
            $this->expectedName()->__toString(),
            $this->namedIdentifierTestInstance()->__toString(),
            $this->testFailedMessage(
                $this->namedIdentifierTestInstance(),
                '__toString',
                'the same string as the string returned by the expected ' . Name::class . '\'s __toString() method'
            ),
        );
    }
}

