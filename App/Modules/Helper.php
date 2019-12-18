<?php

namespace App\Modules;

class Helper
{

    protected $config;
    protected $configPath;

    public function __construct()
    {
        $this->configPath = self::getRoot()."/config/";
        $this->config = include_once $this->configPath."config.php";
    }

    public static function getEnv($var = NULL){

        $env = json_decode(file_get_contents("../App/env.json"), true);

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

    public static function redirect(string $url){
        header("Location: ".$url."");
    }

    /**
     * TODO
     * Create setConfigPath and getConfigPath methods
     *
     * @return mixed
     */
    public function getConfig(){
        global $config;
        if (!$config) {
            return $this->config;
        }
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

    public static function getRoot(){
        return str_replace("\\", "/", dirname(dirname(__DIR__)))."/";
    }

}