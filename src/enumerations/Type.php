<?php

namespace Darling\PHPJsonStorageUtilities\enumerations;

enum Type: string {

    case Array = 'array';
    case Bool = 'boolean';
    case Float = 'double';
    case Int = 'integer';
    case Null = 'NULL';
    case String = 'string';
    case Object = 'object';
    case Resource = 'resource';
    case ResourceClosed = 'resource (closed)';
    case UnknownType = 'unknown type';

}
