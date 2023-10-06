<?php

namespace Darling\PHPJsonStorageUtilities\classes\named\identifiers;

use \Darling\PHPJsonStorageUtilities\classes\named\identifiers\NamedIdentifier;
use \Darling\PHPJsonStorageUtilities\enumerations\Type;
use \Darling\PHPJsonStorageUtilities\interfaces\named\identifiers\Container as ContainerInterface;
use \Darling\PHPTextTypes\classes\strings\Name;
use \Darling\PHPTextTypes\classes\strings\Text;
use \Darling\PHPTextTypes\interfaces\strings\ClassString;

final class Container extends NamedIdentifier implements ContainerInterface
{

    /**
     * Instantiate a new Container instance.
     *
     * @param Type|ClassString $type
     *
     */
    public function __construct(Type|ClassString $type)
    {
        parent::__construct(
            new Name(
                new Text(
                    $this->sha256hashType(
                        $type
                    )
                )
            )
        );
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
     * WARNING: This method is intended to be used outside the
     * internal scope of this method. It is also not safe for
     * use in security critical contexts, for instance, this
     * method would not be safe for use hashing a password.
     *
     * @return string
     *
     */
    protected function sha256hash(string $data): string
    {
        return hash('sha256', $data);
    }

}

