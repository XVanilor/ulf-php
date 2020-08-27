<?php

//Only load App classes, composer will load himself vendor classes
spl_autoload_register(function ($class){
    if(strpos($class, "App") !== false)
        include_once "../" . str_replace("\\", "/", $class) . ".php";
});

//Loads Composer vendor
require_once '../vendor/autoload.php';

$core = new \ULF\Core\ULF();
$core->run();