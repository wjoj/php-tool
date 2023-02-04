<?php

namespace Wjoj\Tool;

class Format
{
    const REG_TIME = "/^\d{4}[\-](0?[1-9]|1[012])[\-](0?[1-9]|[12][0-9]|3[01])(\s{1}(0?[0-9]|1[0-9]|2[0-3])\:(0?[0-9]|[1-5][0-9])\:(0?[0-9]|[1-5][0-9])){1}$/";
    const REG_DATE = "/^\d{4}[\-](0?[1-9]|1[012])[\-](0?[1-9]|[12][0-9]|3[01])$/";
    const REG_CLOCK = "/^((0?[0-9]|1[0-9]|2[0-3])\:(0?[0-9]|[1-5][0-9])\:(0?[0-9]|[1-5][0-9])){1}$/";
    const REG_PHONE = "/^1[3456789]\\d{9}$/";
    const REG_EMAIL = "/^\\w+@[a-z0-9]+\\.[a-z]{2,4}$/";
    
    /**
     * 判断时间格式
     *
     * @param string $value
     * @return boolean
     */
    public static function isTime(string $value): bool
    {
        if (preg_match(self::REG_TIME, $value) !== 1) {
            return false;
        }
        return true;
    }
    /**
     * 日期格式
     *
     * @param string $value
     * @return boolean
     */
    public static function isDate(string $value): bool
    {
        if (preg_match(self::REG_DATE, $value) !== 1) {
            return false;
        }
        return true;
    }
    /**
     * 时钟格式
     *
     * @param string $value
     * @return boolean
     */
    public static function isClock(string $value): bool
    {
        if (preg_match(self::REG_CLOCK, $value) !== 1) {
            return false;
        }
        return true;
    }
    /**
     * 手机号格式
     *
     * @param string $value
     * @return boolean
     */
    public static function isPhone(string $value): bool
    {
        if (preg_match(self::REG_PHONE, $value) !== 1) {
            return false;
        }
        return true;
    }
    /**
     * 邮箱格式
     *
     * @param [type] $value
     * @return boolean
     */
    public static function isEmail(string $value): bool
    {
        if (preg_match(self::REG_EMAIL, $value) !== 1) {
            return false;
        }
        return true;
    }
}
