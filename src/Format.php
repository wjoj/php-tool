<?php

namespace Wjoj\Tool;

class Format
{
    const REG_TIME = "/^\d{4}[\-](0?[1-9]|1[012])[\-](0?[1-9]|[12][0-9]|3[01])(\s{1}(0?[0-9]|1[0-9]|2[0-3])\:(0?[0-9]|[1-5][0-9])\:(0?[0-9]|[1-5][0-9])){1}$/";
    const REG_DATE = "/^\d{4}[\-](0?[1-9]|1[012])[\-](0?[1-9]|[12][0-9]|3[01])$/";
    const REG_CLOCK = "/^((0?[0-9]|1[0-9]|2[0-3])\:(0?[0-9]|[1-5][0-9])\:(0?[0-9]|[1-5][0-9])){1}$/";
    const REG_PHONE = "/^1[3456789]\\d{9}$/";
    const REG_EMAIL = "/^\\w+@[a-z0-9]+\\.[a-z]{2,4}$/";
    public static function isTime($value): bool
    {
        if (preg_match(self::REG_TIME, $value) !== 1) {
            return false;
        }
        return true;
    }
    public static function isDate($value): bool
    {
        if (preg_match(self::REG_DATE, $value) !== 1) {
            return false;
        }
        return true;
    }
    public static function isClock($value): bool
    {
        if (preg_match(self::REG_CLOCK, $value) !== 1) {
            return false;
        }
        return true;
    }
    public static function isPhone($value): bool
    {
        if (preg_match(self::REG_PHONE, $value) !== 1) {
            return false;
        }
        return true;
    }
    public static function isEmail($value): bool
    {
        if (preg_match(self::REG_EMAIL, $value) !== 1) {
            return false;
        }
        return true;
    }
}
