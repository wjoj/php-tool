<?php

namespace Wjoj\Tool;

/**
 * system information
 * @author ccm wjoj
 * @copyright (c) 2023 01
 */
class OS
{
    /**
     * systematic name
     * @return string
     */
    public static function os()
    {
        return php_uname('s');
    }
    /**
     * windows or not
     * @return bool
     */
    public static function isOsWindows(): bool
    {
        return self::os() == 'Windows';
    }
    /**
     * Linux or not
     * @return bool
     */
    public static function isOsLinux(): bool
    {
        return self::os() == 'Linux';
    }
    /**
     * Mac or not
     * @return bool
     */
    public static function isOsMac(): bool
    {
        return self::os() == 'Darwin';
    }
}
