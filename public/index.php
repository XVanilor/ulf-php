<?php

require_once "../App/Startup.php";

//Start session
if(!session_id())
    session_start();

//$uri = strtok(strtok(strip_tags($_SERVER['REQUEST_URI']), "?"), "&");
$uri = strtok(strtok(strip_tags($_SERVER['REQUEST_URI']), "?"), "&");

//Remove the end / if so
if(substr($uri, -1, 1) === "/")
    $uri = substr($uri, 0, strlen($uri)-1);

array_key_exists($uri, $routes) ? include_once $config["paths"]['controllers'].$routes[$uri].".php" : include_once $config["paths"]["controllers"].$routes["/404"].".php";