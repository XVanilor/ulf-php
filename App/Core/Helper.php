<?php

namespace App\Core;

/**
 * Class Helper
 * @package App\Core
 *
 * TODO
 * Use static for each methods instead of using object context
 */

class Helper
{

    protected $config;
    protected static $configPath = self::getRelativeRoot()."config/";

    public static function getEnv($var = NULL){

        $env = json_decode(file_get_contents(self::getRelativeRoot()."App/env.json"), true);

        if(!$var)
            return $env;
        else {
            $vPath = explode(".", strtoupper($var));
            $vPathLenght = count($vPath);

            $requested_param = $env;
            for($i = 0; $i < $vPathLenght; $i++)
                $requested_param = $requested_param[$vPath[$i]];

            return $requested_param;
        }

    }

    /**
     *
     * Throws a HTTP 301 redirection request
     *
     * @param string $url
     *
     * @return void
     *
     */
    public static function redirect(string $url){

        header("Location: " . $url);
        return;
    }

    /**
     * TODO
     * Create setConfigPath and getConfigPath methods
     *
     * @return mixed
     */
    public static function getConfig(){
        global $config;
        if (!$config) {
            self::$config = self::mergeConfigs();
        }
        return $config;
    }

    /**
     * Merges all configuration files into global $config
     * and returns it as new config
     *
     * @global array $config
     *
     * @return array
     *
     */
    private static function mergeConfigs(){

        global $config;
        if(!$config)
            $config = array();

        $configFiles = array_diff(scandir(self::$configPath), array(".",".."));

        foreach($configFiles as $configFile)
            if(is_array($configContent = include_once $this->configPath.$configFile))
                foreach ($configContent as $key => $item)
                        $config[$key] = $item;

        return $config;
    }

    /**
     * TODO
     * Create getRoutes and setRoute functions
     *
     * @return mixed
     */
    public static function Throw404(){
        return include_once '../pages/front/errors/404.php';
    }

    public static function getAbsoluteRoot(){
        return str_replace("\\", "/", dirname(dirname(__DIR__)))."/";
    }

    public static function getRelativeRoot(){
        return "../";
    }
}