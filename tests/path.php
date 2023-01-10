<?php

spl_autoload_register(function ($class_name) {
    $cnames = explode(DIRECTORY_SEPARATOR, $class_name);
    require_once __DIR__ . '/../src/' .  $cnames[count($cnames) - 1] . '.php';
});


use Wjoj\Tool\Path;

function temporaryFile($name, $content)
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
$tempfile = tmpfile();
fseek($tempfile, 0);
$path = stream_get_meta_data($tempfile);
var_dump($path);
fclose($tempfile);
echo tmpfile() . "\n";
echo sys_get_temp_dir() . "\n";
echo tempnam(sys_get_temp_dir(), 'td') . "\n";

register_shutdown_function(function () {
    echo "完成踩踩踩";
});


$path = new Path('http://localhost/cde/cdd');
$path2 = $path->new('/test.php');
echo $path;
echo $path->isDir() . "\n";
echo $path->isFile() . "\n";
echo $path2  . "\n";
echo $path2->isFile() . "\n";
echo $path->newAdd('/testc.php') . "\n";
