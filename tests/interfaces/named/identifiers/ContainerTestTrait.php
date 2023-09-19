<?php

namespace Darling\PHPJsonStorageUtilities\tests\interfaces\named\identifiers;

use \Darling\PHPJsonStorageUtilities\enumerations\Type;
use \Darling\PHPJsonStorageUtilities\interfaces\named\identifiers\Container;
use \Darling\PHPJsonStorageUtilities\tests\interfaces\named\identifiers\NamedIdentifierTestTrait;
use \Darling\PHPTextTypes\classes\strings\ClassString;

/**
 * The ContainerTestTrait defines common tests for implementations of
 * the Container interface.
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
     * The expected Name should be constructed from a hash of a
     * valid Type or ClassString.
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
     * public function setUp(): void
     * {
     *     $types = [
     *         Type::Array,
     *         Type::Bool,
     *         Type::Float,
     *         Type::Int,
     *         Type::Null,
     *         Type::String,
     *         new ClassString(Name::class),
     *     ];
     *     $type = $types[array_rand($types)];
     *     $expectedName = new Name(
     *         new Text(
     *             $this->sha256hashType(
     *                 $type
     *             )
     *         )
     *     );
     *     $this->setExpectedName($expectedName);
     *     $container = new Container($type);
     *     $this->setNamedIdentifierTestInstance($container);
     *     $this->setContainerTestInstance(
     *         $container
     *     );
     * }
     *
     * ```
     *
     */
    abstract protected function setUp(): void;

    /**
     * Set the Container implementation instance to test.
     *
     * @param Container $containerTestInstance An instance of an
     *                                         implementation of
     *                                         the Container interface
     *                                         to test.
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

    /**
     * Create a hash of the specified Type or ClassString.
     *
     * @return string
     *
     */
    protected function sha256hashType(Type|ClassString $type): string
    {
        $type = (
            $type instanceof ClassString
            ? $type->__toString()
            : $type->value

        );
        return $this->sha256hash($type);
    }

    /**
     * Generate a hash of the specified data.
     *
     * Currently, this method uses the sha256 algorithm. This may
     * change in the future.
     *
     * WARNING: This method is not safe for use in security critical
     * contexts. For example, it is not safe to use this method to
     * hash a password. The hash generated by this method is only
     * meant to be used for data comparison. It is not meant to
     * provide any form of data security.
     *
     * @return string
     *
     */
    protected function sha256hash(string $data): string
    {
        return hash('sha256', $data);
    }

}

