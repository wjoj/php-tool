<?php

namespace Wjoj\Tool;

class Convert
{
    /**
     * 保留n位小数并四舍五入
     *
     * @param int|float|string $value
     * @param int $decimal
     * @return float
     */
    public static function floatDecimal($value, int $decimal = 2): float
    {
        return (float)number_format((float)$value, $decimal, '.', '');
    }

    /**
     * 保留后位小数 不四舍五入
     *
     * @param string $value
     * @param int $decimal
     * @return float
     */
    public static function float2DecimalPad(string $value, int $decimal = 2): float
    {
        return (float)str_pad(substr($value, 0, strpos($value, '.') + 3),  $decimal, '0', STR_PAD_RIGHT);
    }

    /**
     * 地址解析
     *
     * @param string $address
     * @return \stdClass
     *         - province: 省
     *         - city: 市
     *         - area: 区|县|镇|乡|街道
     *         - address: 地址
     *      
     * @author Wjoj <wjoj@qq.com>
     * @since 2020-01-01
     */
    public static function addressResolution(string $address): \stdClass
    {
        preg_match('/(.*?(省|自治区|北京|天津|上海|重庆))/', $address, $matches);
        if (count($matches) > 1) {
            $province = $matches[count($matches) - 2];
            $address = preg_replace('/(.*?(省|自治区|北京|天津|上海|重庆))/', '', $address, 1);
        }
        preg_match('/(.*?(市|自治州|地区|区划|县))/', $address, $matches);
        if (count($matches) > 1) {
            $city = $matches[count($matches) - 2];
            $address = str_replace($city, '', $address);
        }
        preg_match('/(.*?(区|县|镇|乡|街道))/', $address, $matches);
        if (count($matches) > 1) {
            $area = $matches[count($matches) - 2];
            $address = str_replace($area, '', $address);
        }
        $obj = new \stdClass();
        $obj->province = isset($province) ? $province : '';
        $obj->city = isset($city) ? $city : '';
        $obj->area = isset($area) ? $area : '';
        $obj->address = $address;
        return $obj;
    }
}
