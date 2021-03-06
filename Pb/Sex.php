<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: addressbook.proto

namespace Pb;

use UnexpectedValueException;

/**
 *性别
 *
 * Protobuf type <code>pb.Sex</code>
 */
class Sex
{
    /**
     * Generated from protobuf enum <code>MAN = 0;</code>
     */
    const MAN = 0;
    /**
     * Generated from protobuf enum <code>WOMAN = 1;</code>
     */
    const WOMAN = 1;

    private static $valueToName = [
        self::MAN => 'MAN',
        self::WOMAN => 'WOMAN',
    ];

    public static function name($value)
    {
        if (!isset(self::$valueToName[$value])) {
            throw new UnexpectedValueException(sprintf(
                    'Enum %s has no name defined for value %s', __CLASS__, $value));
        }
        return self::$valueToName[$value];
    }


    public static function value($name)
    {
        $const = __CLASS__ . '::' . strtoupper($name);
        if (!defined($const)) {
            throw new UnexpectedValueException(sprintf(
                    'Enum %s has no value defined for name %s', __CLASS__, $name));
        }
        return constant($const);
    }
}

