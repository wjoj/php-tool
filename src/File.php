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
    public static function deleteDir(string $path): bool
    {
        return deleteDir($path);
    }

    /**
     * Summary of temporaryFile
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

        file_put_contents($file, $content);

        register_shutdown_function(function () use ($file) {
            unlink($file);
        });

        return $file;
    }
}
