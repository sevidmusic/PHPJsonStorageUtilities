<?php

namespace Darling\PHPJsonStorageUtilities\enumerations;

/**
 * The Type enum can be used to identify different types of data.
 *
 * @example
 *
 * ```
 * $values = ['foo', 1, 23.45, true];
 * // @var mixed $value
 * $value = $values[array_rand($values)];
 * echo match(gettype($value)) {
 *     Type::String->value => 'value is a string',
 *     Type::Bool->value => 'value is a bool',
 *     Type::Int->value => 'value is an int',
 *     Type::Float->value => 'value is a float',
 * };
 * // example output: value is a float
 * var_dump($value);
 * // example output: double(23.45)
 *
 * ```
 *
 */
enum Type: string {

    case Array = 'array';
    case Bool = 'boolean';
    case Float = 'double';
    case Int = 'integer';
    case Null = 'NULL';
    case Object = 'object';
    case Resource = 'resource';
    case ResourceClosed = 'resource (closed)';
    case String = 'string';
    case UnknownType = 'unknown type';

}

