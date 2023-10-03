<?php

namespace Wjoj\Tool;

class IdentityCard
{
    // 身份证对应的省份对照表 广西省
    const PROVINCE_CLASS_TABLE = [
        11 => '北京市', 12 =>  '天津市', 13 =>  '河北省', 14 => '山西省',
        15 => '内蒙古自治区', 21 => '辽宁省', 22 => '吉林省', 23 => '黑龙江省',
        31 => '上海市', 32 => '江苏省', 33 => '浙江省', 34 => '安徽省',
        35 =>  '福建省', 36 => '江西省', 37 => '山东省', 41 =>  '河南省',
        42 => '湖北省', 43 => '湖南省', 44 => '广东省', 45 =>  '广西壮族自治区',
        46 =>  '海南省', 50 => '重庆市', 51 =>  '四川省', 52 => '贵州省',
        53 => '云南省', 54 => '西藏自治区', 61 =>  '陕西省', 62 =>  '甘肃省',
        63 => '青海省', 64 =>  '宁夏回族自治区', 65 => '新疆维吾尔自治区', 71 => '台湾省',
        81 =>  '香港特别行政区', 82 => '澳门特别行政区'
    ];
    /**
     * 身份证获取省对于的类
     *
     * @param string $idcard
     * @return string|null
     */
    public static function getArea($idcard): string|null
    {
        return self::PROVINCE_CLASS_TABLE[substr($idcard, 0, 2)] ?? null;
    }
    /**
     * 身份证获取日期
     *
     * @param striong $id_card
     * @return string
     */
    public static function idcardBirthdate(string $idCard): string
    {
        $pattern = '/^(\d{6})(\d{4})(\d{2})(\d{2})(\d{3})(\d|x|X)$/'; // 用于匹配身份证号码的正则表达式
        if (preg_match($pattern, $idCard, $matches)) {
            $birthYear = $matches[2]; // 年份
            $birthMonth = $matches[3]; // 月份
            $birthDay = $matches[4]; // 日
            $birthDate = $birthYear . '-' . $birthMonth . '-' . $birthDay;
            return $birthDate;
        } else {
            return ''; // 身份证号码不匹配
        }
    }

    /**
     * 获取性别
     * 1:女 2:男
     * @param string $idCard
     * @return integer
     */
    public static function getGender(string $idCard): int
    {
        return (int)(substr($idCard, 16, 1) / 2) == 0 ? 1 : 2;
    }
}
