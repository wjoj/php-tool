<?php

namespace Wjoj\Tool;

/**
 * 删除文件夹和文件
 */
if (!function_exists("deleteDir")){
    function deleteDir(string $path)
    {
        if (!is_dir($path)) {
            if (is_file($path)) {
                @unlink($path);
            }
            return true;
        }
        $open = opendir($path);
        if (!$open) {
            return false;
        }
        while (($v = readdir($open)) !== false) {
            if ('.' == $v || '..' == $v) {
                continue;
            }
            $item = $path . '/' . $v;
    
            if (is_file($item)) {
                @unlink($item);
                continue;
            }
            deleteDir($item);
        }
        closedir($open);
        @rmdir($path);
        return true;
    }
}

/**
 * Summary of File
 * @author ccm wjoj
 * @copyright (c) 2023 01
 */
class File
{
    /**
     * Summary of deleteDir
     * @param string $path
     * @return bool
     */
    public static function deleteDir(string $path): bool
    {
        return deleteDir($path);
    }

    /**
     * 缓存文件后释放
     * @param string $name
     * @param mixed $content
     * @return string
     */
    public static function temporaryFile($name, $content): string
    {
        $file = DIRECTORY_SEPARATOR .
            trim(sys_get_temp_dir(), DIRECTORY_SEPARATOR) .
            DIRECTORY_SEPARATOR .
            ltrim($name, DIRECTORY_SEPARATOR);
            
       if (file_put_contents($file, $content)===false){
           throw new Error(error_get_last()["message"]);
       }

        register_shutdown_function(function () use ($file) {
            unlink($file);
        });

        return $file;
    }
}