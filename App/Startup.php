<?php

//Only load App classes, composer will load himself vendor classes
spl_autoload_register(function ($class){
    if(strpos($class, "App") !== false)
        include_once "..\\" . $class . ".php";
});

//Loads Composer vendor
require_once '../vendor/autoload.php';

//Global variables & Functions
require_once "../App/Core/GlobalVars.php";