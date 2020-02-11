<?php

//Start session
if(!session_id())
    session_start();

require_once "../App/Startup.php";


//$uri = strtok(strtok(strip_tags($_SERVER['REQUEST_URI']), "?"), "&");
$uri = strtok(strtok(strip_tags($_SERVER['REQUEST_URI']), "?"), "&");

array_key_exists($uri, $routes) ? include_once $config["paths"]['controllers'].$routes[$uri].".php" : include_once $config["paths"]["controllers"].$routes["/404"].".php";