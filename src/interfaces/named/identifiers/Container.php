<?php

namespace Darling\PHPJsonStorageUtilities\interfaces\named\identifiers;

use \Darling\PHPJsonStorageUtilities\interfaces\named\identifiers\NamedIdentifier;

/**
 * A Container is a NamedIdentifier that can be used to identify
 * stored Json.
 *
 * A Container's Name will either be a hash of the value of a
 * \Darling\PHPJsonStorageUtilities\enumerations\Type, or a
 * hash of the value returned by a
 * \Darling\PHPTextTypes\classes\strings\ClassString intance's
 * __toString() method.
 *
 */
interface Container extends NamedIdentifier
{

}

