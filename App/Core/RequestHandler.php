<?php


namespace App\Core;


class RequestHandler
{

    private static $error404Path;
    private static $routesIdentifier;
    private static $final;
    private static $URIRoot;

   /* public static function router(){

        global $config, $routes;
        self::$error404Path =  $config["paths"]["views"].$routes["/404"].".php";
        self::$routesIdentifier = "uris";

        $tmpRoutes = $routes['uris'];
        $controllerPath = "";
        self::$URIRoot = "";


        $requestedURI = array_diff(
                    explode("/",
                        strtok(strtok(strip_tags($_SERVER['REQUEST_URI']), "?"), "&")
                    )
                    ,
                    array("")
        );

        /*
        * Going deepest into the route tree
        *
        self::$final = end($requestedURI);
        $controllerPath = self::getRoute($tmpRoutes, $requestedURI);


        var_dump($controllerPath);

        include_once $config["paths"]['controllers'].$routes[$uri].".php";

    } */

    private static function getRoute($routes, $requestedURI){

        foreach($requestedURI as $key => $item){

            if(array_key_exists($item, $routes)) {
                if (isset($routes['uris'])){
                    unset($requestedURI[0]);
                    return self::getRoute($routes['uris'][$item], array_values($requestedURI));
                }
                if($item === self::$final)
                    if(isset($routes[$item]))
                        return $routes[$item];
                    else
                        return $routes[self::$URIRoot];
            }

        }

        return NULL;

    }

    private static function authorize(){
        global $config;
    }
}