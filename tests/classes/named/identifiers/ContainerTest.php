<?php

namespace Darling\PHPJsonStorageUtilities\tests\classes\named\identifiers;

use \Darling\PHPJsonStorageUtilities\classes\named\identifiers\Container;
use \Darling\PHPJsonStorageUtilities\tests\PHPJsonStorageUtilitiesTest;
use \Darling\PHPJsonStorageUtilities\tests\interfaces\named\identifiers\ContainerTestTrait;
use \Darling\PHPTextTypes\classes\strings\Name;
use \Darling\PHPTextTypes\classes\strings\Text;

final class ContainerTest extends PHPJsonStorageUtilitiesTest
{

    /**
     * The ContainerTestTrait defines common tests for
     * implementations of the
     * Darling\PHPJsonStorageUtilities\interfaces\named\identifiers\Container
     * interface.
     *
     * @see ContainerTestTrait
     *
     */
    use ContainerTestTrait;

    public function setUp(): void
    {
        $expectedName = new Name(new Text($this->randomChars()));
        $container = new Container($expectedName);
        $this->setExpectedName($expectedName);
        $this->setNamedIdentifierTestInstance($container);
        $this->setContainerTestInstance(
            new Container($expectedName)
        );
    }
}

