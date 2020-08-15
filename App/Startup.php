<?php

//Only load App classes, composer will load himself vendor classes
spl_autoload_register(function ($class){
    if(strpos($class, "App") !== false)
        include_once "../" . str_replace("\\", "/", $class) . ".php";
});

//Loads Composer vendor
require_once '../vendor/autoload.php';

//Global variables & Functions
require_once "../App/Core/GlobalVars.php";

/**
 * Retrieve all modules dirs
 */
$modules = [];
foreach(glob($path = $config['paths']['modules']."*", GLOB_ONLYDIR) as $dir) {
    array_push($modules, $config['paths']['modules'].basename($dir));
}
$modules = array_diff($modules, [$config['paths']['modules']."Functions"]);


/**
 * Retrieve all modules functions
 */

foreach ($modules as $module) {

    if (file_exists( $funcs = $module . "/Functions.php")) {
        include_once $funcs;
    }
}


/**
 * @TODO
 * Improve custom functions inclusion
 */
$customFunctions = array_diff(scandir($config['paths']['modules']."Functions/"), array(".", ".."));
foreach($customFunctions as $customFunction)
    include_once $config['paths']['modules']."Functions/".$customFunction;
