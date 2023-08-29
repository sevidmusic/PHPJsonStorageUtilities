<?php

namespace Darling\PHPJsonStorageUtilities\tests\classes\named\identifiers;

use \Darling\PHPJsonStorageUtilities\classes\named\identifiers\Container;
use \Darling\PHPJsonStorageUtilities\enumerations\Type;
use \Darling\PHPJsonStorageUtilities\tests\PHPJsonStorageUtilitiesTest;
use \Darling\PHPJsonStorageUtilities\tests\interfaces\named\identifiers\ContainerTestTrait;
use \Darling\PHPTextTypes\classes\strings\ClassString;
use \Darling\PHPTextTypes\classes\strings\Name;
use \Darling\PHPTextTypes\classes\strings\Text;

final class ContainerTest extends PHPJsonStorageUtilitiesTest
{

    /**
     * The ContainerTestTrait defines common tests for
     * implementations of the
     * \Darling\PHPJsonStorageUtilities\interfaces\named\identifiers\Container
     * interface.
     *
     * @see ContainerTestTrait
     *
     */
    use ContainerTestTrait;

    public function setUp(): void
    {
        $types = [
            Type::Array,
            Type::Bool,
            Type::Float,
            Type::Int,
            Type::Null,
            Type::String,
            new ClassString(Name::class),
        ];
        $type = $types[array_rand($types)];
        $expectedName = new Name(
            new Text(
                $this->sha256hashType(
                    $type
                )
            )
        );
        $this->setExpectedName($expectedName);
        $container = new Container($type);
        $this->setNamedIdentifierTestInstance($container);
        $this->setContainerTestInstance(
            $container
        );
    }

}

