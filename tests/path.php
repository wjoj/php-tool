<?php

require_once __DIR__ . '/../src/Path.php';

use Wjoj\Tool\Path;

$path = new Path('http://localhost/cde/cdd');
$path2 = $path->new('/test.php');
echo $path;
echo $path->isDir() . "\n";
echo $path->isFile() . "\n";
echo $path2  . "\n";
echo $path2->isFile() . "\n";
echo $path->newAdd('/testc.php') . "\n";
