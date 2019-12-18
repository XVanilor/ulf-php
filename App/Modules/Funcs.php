<?php

/**
 *
 * File-linkage functions
 *
 */

if(!function_exists('assets')){
    function assets($path){
        return "./assets/".$path;
    }
}

if(!function_exists("layout")){
    function layout($name){
        global $config;
        require_once $config['paths']['layouts'].$name.'.php';
        return;
    }
}

if(!function_exists("controller")){
    function controller($name){
        global $config;
        require_once $config['paths']['back'].$name.".php";
        return;
    }
}

if(!function_exists("module")){
    function module($name){
        global $config;
        require_once $config['paths']['modules'].$name.".php";
        return;
    }
}

if(!function_exists("routes")){
    function routes(){
        global $config;
        return require_once $config['paths']['routes']."routes.php";
    }
}