<?php

use App\Core\Helper;

/**
 *
 * File-linkage functions
 *
 */

/**
 * Get an asset by it's relative path to assets folder
 *
 * @param string $path
 *
 * @return void
 *
 **/

if(!function_exists('assets')){
    function assets(string $path){
        return Helper::getRelativeRoot()."assets/".$path;
    }
}

/**
 * Get a layout by it's name
 *
 * @param string $name
 * @param array $datas
 *
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
 * @param string $name
 *
 * @return void
 *
 **/

if(!function_exists("controller")){
    function controller(string $name){
        global $config;
        include $config['paths']['controllers'].$name.".php";
        return;
    }
}

/**
 * Get a module by it's name
 *
 * @param string $name
 *
 * @return void
 *
 **/

if(!function_exists("module")){
    function module(string $name){
        global $config;
        require_once $config['paths']['modules'].$name.".php";
        return;
    }
}

/**
 * Get all available routes
 *
 * @param string $name
 *
 * @return array
 *
 **/

if(!function_exists("routes")){
    function routes(string $name = NULL){
        global $config;
        return require_once $config['paths']['routes']."routes.php";
    }
}

/**
 * Retrieve a view by it's name/relative path to view path configured in config/config.php
 *
 * @param string $name
 * @param array $datas
 *
 * @return string
 */
if(!function_exists("view")){
    function view(string $name, array $datas = NULL){
        global $config;
        if($datas)
            extract($datas);

        require_once $config['paths']['views'].$name.".php" ;
        return;
    }
}

/**
 *
 * This function secures a string before displaying into views, avoiding
 * common vulnerabilities such as XSS injection.
 * ALWAYS use it when you have to render ANY USER DATA or NON-DEV DATA
 *
 * @param string $string
 *
 * @return string
 *
 */
if(!function_exists("sec")){

    function sec(string $string){

        return htmlentities($string, ENT_QUOTES | ENT_HTML5, 'UTF-8');

    }

}

if(!function_exists("dd")){

    function dd($var){

        var_dump($var);
        die;

    }

}