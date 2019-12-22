<?php

use App\Core\ErrorHandler\ErrorHandler;

/**
 *
 * File-linkage functions
 *
 */

/**
 * Get an asset by it's relative path to assets folder
 *
 * @param $path
 * @return void
 *
 **/

if(!function_exists('assets')){
    function assets($path){
        return "./assets/".$path;
    }
}

/**
 * Get a layout by it's name
 *
 * @param string $name
 * @param array $datas
 * @return void
 *
 **/

if(!function_exists("layout")){
    function layout(string $name, array $datas = NULL){
        global $config;
        require_once $config['paths']['layouts'].$name.'.php';
        return;
    }
}

/**
 * Get a controller by it's name
 *
 * @param $name
 * @return void
 *
 **/

if(!function_exists("controller")){
    function controller($name){
        global $config;
        require_once $config['paths']['back'].$name.".php";
        return;
    }
}

/**
 * Get a module by it's name
 *
 * @param $name
 * @return void
 *
 **/

if(!function_exists("module")){
    function module($name){
        global $config;
        require_once $config['paths']['modules'].$name.".php";
        return;
    }
}

/**
 * Get all available routes
 *
 * @param string
 * @return array
 *
 **/

if(!function_exists("routes")){
    function routes(string $name = NULL){
        global $config;
        return require_once $config['paths']['routes']."routes.php";
    }
}