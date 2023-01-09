<?php
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
    public static function deleteDir(string $path)
    {
        return deleteDir($path);
    }
}
